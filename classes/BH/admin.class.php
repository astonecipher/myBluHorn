<?php

/**
 * BLUHORN ADMIN CLASS
 *  
 * @author Wes Benwick
 * @link http://www.filelogix.com
 * @license Part of Filelogix usage license
 */ 
  
namespace BH;

class admin
{  
    // Will store database connection here
	private $db;
	private $sessionID;
	private $agencyID;
	private $userID;

	
	public function __construct($db, $userID, $agencyID) {
	  $this->db = $db;
	  $this->userID = $userID;
	  $this->agencyID = $agencyID;
	  $this->sessionID = session_id();
	  
	  error_log("BH User:" . $userID);
	  
	  if (!$userID) {
		  return false;
	  }
	  
	  $this->getAgencyID();
		
	}
	
	public function getAgencyID() {
		
		$userIDStr = $this->db->quote($this->userID);
		
		$r=$this->db->query("select agencyID from BH_USERS where userID = $userIDStr and isSelected is TRUE");
		 
		$results=$r->fetch(\PDO::FETCH_ASSOC);

		error_log("BH getAgencyID: " . $this->db->lastQuery());

		if ($results["agencyID"]) {
				$this->agencyID= $results["agencyID"];
				return $this->agencyID;
		}
		else {
			return false;
		}
		
	}

	public function getAllUsers() {
		
		$userIDStr = $this->db->quote($userID);
		
		  $r=$this->db->query("select * from BH_USERS left join BH_AGENCIES on (BH_USERS.agencyID = BH_AGENCIES.id) left join FLX_USERS on (FLX_USERS.userID = BH_USERS.userID) group by FLX_USERS.userID order by FLX_USERS.lastName asc, FLX_USERS.firstName asc");
	      $results=$r->fetchAll();
	
		  error_log($this->db->lastQuery());
			
		  return $results;

	}

	public function getAllAgenciesWithStats() {
		
		$agency = new \BH\agency($this->db, $this->userID, $this->agencyID); 
		$campaign = new \BH\campaign($this->db, $this->userID, $this->agencyID); 
		$worksheet = new \BH\worksheet($this->db, $this->userID, $this->agencyID); 

		$agencies = $agency->getAllAgencies();

		$index = 0;

		foreach ($agencies as $agency) {
		  		  		
		  $agencies[$index]["campaignCount"] =  $campaign->countCampaignsByAgencyID($agency["id"]);
		  $agencies[$index]["worksheetCount"] =  $worksheet->countWorksheetsByAgencyID($agency["id"]);

		  $index++;
		  
		}
		  
		return $agencies;

	}

	public function getPendingUsers() {
		
		$userIDStr = $this->db->quote($userID);
		
		  $r=$this->db->query("select * from FLX_USERS where FLX_USERS.status = 'pending' group by FLX_USERS.userID order by FLX_USERS.lastName asc, FLX_USERS.firstName asc");
	      $results=$r->fetchAll();
	
		  error_log($this->db->lastQuery());
			
		  return $results;

	}

	public function getFullName() {
		
		$userIDStr = $this->db->quote($this->userID);
		
		$r=$this->db->query("select name from FLX_USERS where userID = $userIDStr");
		 
		$results=$r->fetch(\PDO::FETCH_ASSOC);

		error_log("BH getAgencyID: " . $this->db->lastQuery());

		if ($results["name"]) {
				return $results["name"];
		}
		else {
			return false;
		}
		
	}
	
	public function showSideNav($status) {

  	    if (!$this->userID) {
		  
		  return false;
	    }
		
		$userIDStr = $this->db->quote($this->userID);
		$agencyIDStr = $this->db->quote($this->agencyID);

		if ($status != "") {
			if ($status == "open") {
				$this->updateSideNav(true);
			}		
			else {
				$this->updateSideNav(false);				
			}	
			
		}
			
		$r=$this->db->query("select showSideNav from BH_USERS where userID = $userIDStr and agencyID = $agencyIDStr limit 1 ");
		 
		$results=$r->fetch(\PDO::FETCH_ASSOC);

		if ($results["showSideNav"]) {
			return true;
		}
		else {
			return false;
		}
		
	}

	public function updateSideNav($status) {
	  
	  if (!$this->userID) {
		  
		  return false;
	  }
	  
	  else {

		  $this->db->update("BH_USERS", "userID", $this->userID, array("showSideNav"=>$status));
		  		  
	  }

	  error_log("BH_USERS showSideNav: " . $this->db->lastQuery());
				
	  return true;

		
	}
	
	public function selectAgencyByUserID($userID, $fromAgency, $toAgency) {

		$userIDStr = $this->db->quote($userID);
		$agencyIDStr = $this->db->quote($toAgency);
		
		$r=$this->db->query("update BH_USERS set isSelected = FALSE where userID = $userIDStr");
		$r=$this->db->query("update BH_USERS set isSelected = TRUE where userID = $userIDStr and agencyID = $agencyIDStr and isActive is TRUE");
			
		if($toAgency == $this->getAgencyID()) {
			return $toAgency;
		}
		
		else {
			$agencyIDStr = $this->db->quote($fromAgency);
			$r=$this->db->query("update BH_USERS set isSelected = TRUE where userID = $userIDStr and agencyID = $agencyIDStr and isActive is TRUE");
			return false;
		}

	}	

	public function saveAgency($agencyID, $agency = array()) {
	  
	  if ($agencyID>0) {
			$result = $this->db->update("BH_AGENCIES", "id", $agencyID,  $agency);		
			if ($result) {
				return true;	
			}	
			else {
				return false;
			}
	  }
	  else {
		  
		  return false;
		  	
	  }
	}

	public function addAgency($newAgency = array()) {
	  
	  $agency = new \BH\agency($this->db, $this->userID, $this->agencyID);
	  
	  if ($agency->exists($newAgency)) {
		  
		  return false;
	  }
	  
	  else {
		  
		  $client["isActive"] = true;
		  $client["agencyID"] = $this->agencyID;
		  
		  $agencyID = $this->db->insert("BH_AGENCIES", $newAgency);
		  
		  error_log("Add Agency: " . $this->db->lastQuery());

		  return $agencyID;
	  }
				
	  return $results;

		
	}
		
}