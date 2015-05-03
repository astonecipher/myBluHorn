<?php

/**
 * BLUHORN ACTIVITY CLASS
 *  
 * @author Wes Benwick
 * @link http://www.filelogix.com
 * @license Part of Filelogix usage license
 */ 
  
namespace BH;

class activity
{  
    // Will store database connection here
	private $db;
	private $sessionID;
	private $agencyID;
	private $activityID;
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


	public function logActivity($activity = array()) {
	  
	  if (!$this->userID) {
		  
		  return false;
	  }
	  
	  else {
		  
		  $activity["agencyID"] = $this->agencyID;
		  $activity["userID"] = $this->userID;
		  $activity["activityStamp"] = date("Y-m-d h:i:s",strtotime("now"));
		  
		  $this->activityID = $this->db->insert("BH_HISTORY", $activity);
		  
		  error_log("Log Activity: " . $this->db->lastQuery());
		  
		  return $this->clientID;
	  }
				
	  return true;

		
	}
	
}