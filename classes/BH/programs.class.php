<?php

/**
 * BLUHORN PROGRAMS (AVAILS) CLASS
 *  
 * @author Wes Benwick
 * @link http://www.filelogix.com
 * @license Part of Filelogix usage license
 */ 
  
namespace BH;

class programs
{  
    // Will store database connection here
	private $db;
	private $sessionID;
	private $programID;
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

	public function getClientID() {
		return $this->clientID;
	}

	public function addClient($client = array()) {
	  
	  if ($this->exists($client)) {
		  
		  return false;
	  }
	  
	  else {
		  
		  $client["isActive"] = true;
		  $client["agencyID"] = $this->agencyID;
		  
		  $this->clientID = $this->db->insert("BH_CLIENTS", $client);
		  
		  error_log("Add Client: " . $this->db->lastQuery());

		  return $this->clientID;
	  }
				
	  return $results;

		
	}
	
	public function deleteClient($clientID, $client) {

	  if ($this->agencyID == $this->getAgency($clientID)) {
	  
		  if ($clientID>0) {
				if ($client["agencyID"] == $this->agencyID) {
					$result = $this->db->update("BH_CLIENTS", "id", $clientID,  array("isDeleted"=>true));		
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
	
	public function saveClient($clientID, $client = array()) {

	  if ($this->unique($clientID, $client)) {
	  
		  if ($clientID>0) {
				if ($client["agencyID"] == $this->agencyID) {
					$result = $this->db->update("BH_CLIENTS", "id", $clientID,  $client);		
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
	
	public function export() {
		
		$programs = $this->getAllPrograms();

		foreach ($programs as $id=>$program) {
			
				$programs["id"]["rates"] = $this->getRatesByProgram($program["id"]);
				$programs["id"]["ratings"] = $this->getRatingsByProgram($program["id"]);
			
		}
		
		return $programs;

	}
	
	
	public function getProgram($programID) {
		$programIDStr = $this->db->quote($programID);
		
		$r=$this->db->query("select * from BH_AVAILS where id = $programIDStr and agencyID = \"$this->agencyID\"");
		 
		$results=$r->fetch(\PDO::FETCH_ASSOC);

		error_log("Program Exists: " . $this->db->lastQuery());

		if ($results["id"]) {
				$this->programID = $results["id"];
				return $results;
		}
		else {
			return false;
		}
		
	}	

	public function getAgency($clientID) {
		$clientIDStr = $this->db->quote($clientID);
		
		$r=$this->db->query("select agencyID from BH_CLIENTS where id = $clientIDStr and agencyID = \"$this->agencyID\"");
		 
		$results=$r->fetch(\PDO::FETCH_ASSOC);


		if ($results["agencyID"]) {
				return $results["agencyID"];
		}
		else {
			return false;
		}
		
	}
	
	public function unique($clientID, $client = array()) {
		
		$clientNameStr = $this->db->quote($client["name"]);
		$clientIDStr = $this->db->quote($clientID);
		
		$r=$this->db->query("select * from BH_CLIENTS where name = $clientNameStr and id != $clientIDStr and agencyID = '$this->agencyID' and isDeleted is FALSE");
		 
		$results=$r->fetch(\PDO::FETCH_ASSOC);

		error_log("Client Name Unique?: " . $this->db->lastQuery());

		if ($results["name"] == $client["name"]) {
				return false;
		}
		else {
			return true;
		}

	}

	public function exists($client = array()) {
		
		$clientNameStr = $this->db->quote($client["name"]);

		if (($client["source"] != "") and ($client["refID"] > 0)) {
			$sourceStr = $this->db->quote($client["source"]);
			$refIDStr = $this->db->quote($client["refID"]);
			
			$sourceRefIDStr = " and source = $sourceStr and refID = $refIDStr ";	
		}	
		else {
			$sourceRefIDStr = "";
		}
		
		$r=$this->db->query("select * from BH_CLIENTS where name = $clientNameStr and agencyID = '$this->agencyID' $sourceRefIDStr and isDeleted is FALSE");
		 
		$results=$r->fetch(\PDO::FETCH_ASSOC);

		error_log("Client Exists: " . $this->db->lastQuery());

		if ($results["name"] == $client["name"]) {
				$this->clientID = $results["id"];
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
	
	public function getAllPrograms() {
		
		  $agencyIDStr = $this->db->quote($this->agencyID);
				  
		  $r=$this->db->query("select BH_AVAILS.*,BH_VENDORS.name as vendor from BH_AVAILS left join BH_VENDORS on (BH_VENDORS.id = BH_AVAILS.vendorID) where BH_AVAILS.agencyID = $agencyIDStr and BH_AVAILS.isDeleted is FALSE order by BH_AVAILS.name asc");
	      $results=$r->fetchAll();
	
		  error_log($this->db->lastQuery());
			
		  return $results;
	  
	  
	}

	public function getAllProgramsByVendor($vendorID) {
		
		  $agencyIDStr = $this->db->quote($this->agencyID);
		  $vendorIDStr = $this->db->quote($vendorID);
				  
		  $r=$this->db->query("select * from BH_AVAILS where agencyID = $agencyIDStr and vendorID = $vendorIDStr and isDeleted is FALSE order by name asc");
	      $results=$r->fetchAll();
	
		  error_log($this->db->lastQuery());
			
		  return $results;
	  
	  
	}

	public function getAllProgramsByVendorAndDemo($vendorID, $demoID) {
		
		  $agencyIDStr = $this->db->quote($this->agencyID);
		  $vendorIDStr = $this->db->quote($vendorID);
		  $demoIDStr = $this->db->quote($demoID);
				  
		  $r=$this->db->query("select BH_AVAILS.*, BH_AVAIL_RATINGS.aqhRating as aqhRating, BH_AVAIL_RATINGS.impressions as impressions from BH_AVAILS left join BH_AVAIL_RATINGS on (BH_AVAILS.id = BH_AVAIL_RATINGS.availID) where agencyID = $agencyIDStr and vendorID = $vendorIDStr and BH_AVAIL_RATINGS.demographicID = $demoIDStr and isDeleted is FALSE order by name asc");
	      $results=$r->fetchAll();
	
		  error_log($this->db->lastQuery());
			
		  return $results;
	  
	}

	public function getRatesByProgram($availID) {
		
		  $agencyIDStr = $this->db->quote($this->agencyID);
		  $availIDStr = $this->db->quote($availID);
				  
		  $r=$this->db->query("select * from BH_AVAILS left join BH_AVAIL_RATES on (BH_AVAILS.id = BH_AVAIL_RATES.availID) where agencyID = $agencyIDStr and BH_AVAILS.id = $availIDStr and isDeleted is FALSE order by rate asc");
	      $results=$r->fetchAll();
	
		  error_log($this->db->lastQuery());
			
		  return $results;
	  
	}

	public function getRatingsByProgram($availID) {
		
		  $agencyIDStr = $this->db->quote($this->agencyID);
		  $availIDStr = $this->db->quote($availID);
				  
		  $r=$this->db->query("select * from BH_AVAILS left join BH_AVAIL_RATINGS on (BH_AVAILS.id = BH_AVAIL_RATINGS.availID) left join BH_DEMOGRAPHIC on (BH_DEMOGRAPHIC.id = BH_AVAIL_RATINGS.demographicID) where agencyID = $agencyIDStr and BH_AVAILS.id = $availIDStr and isDeleted is FALSE order by aqhRating asc");
	      $results=$r->fetchAll();
	
		  error_log($this->db->lastQuery());
			
		  return $results;
	  
	}

	public function getRatingByProgramAndDemo($availID, $demoID) {
		
		  $agencyIDStr = $this->db->quote($this->agencyID);
		  $availIDStr = $this->db->quote($availID);
		  $demoIDStr = $this->db->quote($demoID);
				  
		  $r=$this->db->query("select * from BH_AVAILS left join BH_AVAIL_RATINGS on (BH_AVAILS.id = BH_AVAIL_RATINGS.availID) left join BH_DEMOGRAPHIC on (BH_DEMOGRAPHIC.id = BH_AVAIL_RATINGS.demographicID) where agencyID = $agencyIDStr and BH_AVAILS.id = $availIDStr and BH_AVAILS.isDeleted is FALSE and BH_AVAIL_RATINGS.demographicID = $demoIDStr order by aqhRating asc");
		  $results=$r->fetch(\PDO::FETCH_ASSOC);
	
		  error_log($this->db->lastQuery());
			
		  return $results;
	  
	}
	
}