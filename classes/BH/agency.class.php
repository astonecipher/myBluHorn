<?php

/**
 * BLUHORN AGENCY CLASS
 *  
 * @author Wes Benwick
 * @link http://www.filelogix.com
 * @license Part of Filelogix usage license
 */ 
  
namespace BH;

class agency
{  
    // Will store database connection here
	private $db;
	private $sessionID;
	private $clientID;
	private $agencyID;
	private $userID;

	
	public function __construct($db, $agencyID, $userID) {
	  $this->db = $db;
	  $this->agencyID = $agencyID;
	  $this->userID = $userID;
	  $this->sessionID = session_id();
	  
	  if (!$agencyID) {
		  return false;
	  }
	  
	  if (!$userID) {
		  return false;
	  }
		
	}

	public function getAgencyID() {
		return $this->agencyID;
	}

	public function addAgency($agency = array(), $autoRename = false) {
	  
	  if ($this->exists($agency)) {
		  
		  if ($autoRename) {
			  $agency["name"] = $agency["name"] . "-" . strtotime("now");  
		  }
		  else {
			  return false;
		  }
	  }
	   
	  $agency["isActive"] = true;
		  
	  $this->agencyID = $this->db->insert("BH_AGENCIES", $agency);
		  
	  error_log("Add Agency: " . $this->db->lastQuery());

	  return $this->agencyID;
		
	}
	
	public function deleteClient($clientID, $client) {

	  if ($this->agencyID == $this->getAgency($clientID)) {
	  
		  if ($clientID>0) {
				if ($client["agencyID"] == $this->agencyID) {
					$result = $this->db->update("BH_AGENCIES", "id", $clientID,  array("isDeleted"=>true));		
					if ($result) {
						return true;	
					}
					else {
						return false;
					}
				}
		  }
	  }
	  else {
		  
		  return false;
		  	
	  }
	}	
	
	public function saveAgency($agencyID, $agency = array()) {

	  if ($this->unique($agencyID, $agency)) {
	  
		  if ($agencyID>0) {
				if ($agency["id"] == $this->agencyID) {
					error_log("Saving Agency");
				
					$result = $this->db->update("BH_AGENCIES", "id", $agencyID,  $agency);		
					if ($result) {
						return true;	
					}
					else {
						return false;
					}
				}
		  }
	  }
	  else {
		  
		  return false;
		  	
	  }
	}	
	
	public function getAgency($agencyID) {
		$agencyIDStr = $this->db->quote($agencyID);
		
		$r=$this->db->query("select * from BH_AGENCIES where id = $agencyIDStr ");
		 
		$results=$r->fetch(\PDO::FETCH_ASSOC);

		error_log("Agency Exists: " . $this->db->lastQuery());

		if ($results["id"]) {
			return $results;
		}
		else {
			return false;
		}
		
	}	
	
	public function unique($agencyID, $agency = array()) {
		
		$agencyNameStr = $this->db->quote($agency["name"]);
		$agencyIDStr = $this->db->quote($agencyID);
		
		$r=$this->db->query("select * from BH_AGENCIES where name = $agencyNameStr and id != $agencyIDStr and isDeleted is FALSE");
		 
		$results=$r->fetch(\PDO::FETCH_ASSOC);

		error_log("Agency Name Unique?: " . $this->db->lastQuery());

		if ($results["name"] == $agency["name"]) {
				return false;
		}
		else {
			return true;
		}

	}

	public function exists($agency = array()) {
		
		$agencyNameStr = $this->db->quote($agency["name"]);

		if (($agency["source"] != "") and ($agency["refID"] > 0)) {
			$sourceStr = $this->db->quote($agency["source"]);
			$refIDStr = $this->db->quote($agency["refID"]);
			
			$sourceRefIDStr = " and source = $sourceStr and refID = $refIDStr ";	
		}	
		else {
			$sourceRefIDStr = "";
		}
		
		$r=$this->db->query("select * from BH_AGENCIES where name = $agencyNameStr $sourceRefIDStr and isDeleted is FALSE");
		 
		$results=$r->fetch(\PDO::FETCH_ASSOC);

		error_log("Agency Exists: " . $this->db->lastQuery());

		if ($results["name"] == $agency["name"]) {
				$this->agencyID = $results["id"];
				return true;
		}
		else {
			return false;
		}

	}	


	public function existsByRefID($source, $refID, $client = array()) {
		
		$sourceStr = $this->db->quote($source);
		$refIDStr = $this->db->quote($refID);
		$clientNameStr = $this->db->quote($client["name"]);
		$clientNameStr = $this->db->quote($client["name"]);
		
		$r=$this->db->query("select * from BH_CLIENTS where name = $clientNameStr and agencyID = '$this->agencyID' and source = $sourceStr and refID = $refIDStr ");
		 
		$results=$r->fetch(\PDO::FETCH_ASSOC);

		error_log("Client Exists By RefID: " . $this->db->lastQuery());

		if ($results["name"] == $client["name"]) {
				$this->clientID = $results["id"];
				return true;
		}
		else {
			return false;
		}

	}
	
	public function getAllAgencies() {
		
		  $agencyIDStr = $this->db->quote($this->agencyID);
				  
		  $r=$this->db->query("select * from BH_AGENCIES where  isActive is TRUE order by name asc");
	      $results=$r->fetchAll();
	
		  error_log($this->db->lastQuery());
			
		  return $results;
	  
	  
	}

	public function getAllAgenciesByUserID($userID) {
		
		  $agencyIDStr = $this->db->quote($this->agencyID);
		  $userIDStr = $this->db->quote($userID);
				  
		  $r=$this->db->query("select * from BH_USERS left join BH_AGENCIES on (BH_USERS.agencyID = BH_AGENCIES.id) where BH_USERS.userID = $userIDStr and BH_AGENCIES.isActive is TRUE order by BH_AGENCIES.name asc");
	      $results=$r->fetchAll();
	
		  error_log($this->db->lastQuery());
			
		  return $results;
	  
	  
	}

	public function getAllAgencyUsers($agencyID) {
		
		  $agencyIDStr = $this->db->quote($agencyID);
				  
		  $r=$this->db->query("select * from BH_USERS left join BH_AGENCIES on (BH_USERS.agencyID = BH_AGENCIES.id) left join FLX_USERS on (FLX_USERS.userID = BH_USERS.userID) where BH_USERS.agencyID = $agencyIDStr and BH_USERS.isActive is TRUE and BH_USERS.isSupport is FALSE order by FLX_USERS.lastName asc, FLX_USERS.firstName asc");
	      $results=$r->fetchAll();
	
		  error_log($this->db->lastQuery());
			
		  return $results;
	  
	  
	}
	
}