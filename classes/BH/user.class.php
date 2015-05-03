<?php

/**
 * BLUHORN USER CLASS
 *  
 * @author Wes Benwick
 * @link http://www.filelogix.com
 * @license Part of Filelogix usage license
 */ 
  
namespace BH;

class user
{  
    // Will store database connection here
	private $db;
	private $sessionID;
	private $agencyID;
	private $userID;

	
	public function __construct($db, $userID) {
	  $this->db = $db;
	  $this->userID = $userID;
	  $this->sessionID = session_id();
	  
	  error_log("BH User:" . $userID);
	  
	  if (!$userID) {
		  return false;
	  }
	  
	  $this->getAgencyID();
		
	}

	public function addUser($userID, $agencyID) {
	  
	  if ((intval($userID) > 0) and (intval($agencyID)>0)){
		  
		  $user = array();
		  
		  $user["userID"] = intval($userID);
		  $user["agencyID"] = intval($agencyID);
		  $user["isActive"] = true;
		  
		  $this->userID = $this->db->upsert("BH_USERS", $user);
		  
		  error_log("Add BluHorn User: " . $this->db->lastQuery());

		  return $this->userID;
	  }
				
	  return $results;

		
	}

	public function set($userID, $setting, $status) {

	  $results = $this->db->update("BH_USERS", "id", $userID, array($setting=>$status));

	  return $results;

		
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

	public function getUser($userID) {
		
		$userIDStr = $this->db->quote($userID);
		
		$r=$this->db->query("select * from FLX_USERS where userID = $userIDStr");

		error_log("BH getUser: " . $this->db->lastQuery());
		 
		$results=$r->fetch(\PDO::FETCH_ASSOC);

		return $results;
		
	}

	public function getAgencyByCustomerID($customerID) {
		
		$customerIDStr = $this->db->quote($customerID);
		
		$r=$this->db->query("select * from BH_AGENCIES where customerID = $customerIDStr");
		 
		$results=$r->fetch(\PDO::FETCH_ASSOC);

		return $results;
		
	}

	public function getAgencyUser($userID, $agencyID) {
		
		$userIDStr = $this->db->quote($userID);
		$agencyIDStr = $this->db->quote($agencyID);
		
		$r=$this->db->query("select * from BH_USERS left join FLX_USERS using (userID) where BH_USERS.userID = $userIDStr and BH_USERS.agencyID = $agencyIDStr ");

		error_log("BH getUser: " . $this->db->lastQuery());
		 
		$results=$r->fetch(\PDO::FETCH_ASSOC);

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

	public function getEmailAddress() {
		
		$userIDStr = $this->db->quote($this->userID);
		
		$r=$this->db->query("select emailAddress from FLX_USERS where userID = $userIDStr");
		 
		$results=$r->fetch(\PDO::FETCH_ASSOC);

		if ($results["emailAddress"]) {
				return $results["emailAddress"];
		}
		else {
			return false;
		}
		
	}

	public function isAdmin() {
		
		$userIDStr = $this->db->quote($this->userID);
		
		$r=$this->db->query("select isAgencyAdmin, isSupport from BH_USERS where BH_USERS.userID = $userIDStr");
		 
		$results=$r->fetch(\PDO::FETCH_ASSOC);

		if ($results["isAgencyAdmin"] == 1) {
			return true;
		}
		else if ($results["isSupport"] == 1) {
			return true;
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
		
}