<?php

/**
 * FILELOGIX SUBSCRIPTION CLASS
 *  
 * @author Wes Benwick
 * @link http://www.filelogix.com
 * @license Part of Filelogix usage license
 *
 *
 * @description This class handles the selection and confirmation of subscriptions (plans)
 *
 */ 
 
class subscribe
{  
    // Will store database connection here
	private $db;
	private $sessionID;
	private $userID;
	
	public function __construct($db) {

		  $this->db = $db;
		  $this->sessionID = $sessionID;
		  $this->userID = $userID;
		  
	}


	public function subscribe($params) {
		
	}
	
	public function plans($isPublic = true) {
	
		if ($isPublic == true) {
			$isPublicStr = "isPublic is TRUE";
		}
		else {
			$isPublicStr = "isPublic is FALSE";			
		}
		
		$r=$this->db->query("select * from FLX_PLANS where $isPublicStr order by rate asc");
		
		error_log("Subscribe: " . $this->db->lastQuery());
		 
		$results=$r->fetchAll();
		
		return $results;
	}
	
}

?>