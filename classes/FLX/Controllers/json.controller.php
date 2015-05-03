<?php

/**
 * FILELOGIX AJAX CLASS
 *  
 * @author Wes Benwick
 * @link http://www.filelogix.com
 * @license Part of Filelogix usage license
 */ 
 
namespace FLX\Controllers;

class json extends \controller
{  
    // Will store database connection here
	private $db;

	/**
  	 * Create instance, load current info based on session info
  	 *
  	 * @return bool
  	 */
	
	public function __construct($db, $sessionID, $userID, $request) {
	  $this->db = $db;
	  $this->sessionID = $sessionID;
	  $this->userID = $userID;
	  $this->request = $request;
	  $this->view = "CAL_RESULTS_JSON";
	  
	  header('Content-Type: application/json');
	 

	  
	}
	
	/**
  	 * Opens the controller - responsible for authentication and loading defaults
  	 *
  	 * @return bool true if success, false if failure
  	 */
	
	public function open() {
/*
	  $this->users=$this->db->query("select * from connections");
	  foreach ($this->users as $row) {
		  $this->userID = $row['userID'];
		  $this->username = $row['username'];
		  $this->emailAddress = $row['emailAddress'];
      }
      
    
*/	
	
	}
	
	
	/**
  	 * Loads the controller, handles any templating and pre-display logic for the requested view
  	 *
  	 * @return bool
  	 */
	
	public function load($view) {


	}

	public function dflt() {
	  if ($this->auth->validate($this->userID)) {

		
		return true;		
	  }
	  else {
		 return false;
	  }
	}
	
	public function players() {
		
	if ($this->auth->validate($this->userID)) {
	
		
		return true;
	 }
	 else {
		return false;
	 }
	}

	public function search($params) {
		

		   $calendar = new \CAL\calendar($this->db);
		   $this->view = "CAL_RESULTS_JSON";

		   $events = $calendar->getAllEventsByDateRange(1, "2013-08-01", "2013-10-02");

		   $this->vars["events"]=$events; 		

						   
		   return true;

	}
	
	
	public function calendar($params) {
		
		if ($params[4]=="feed") {
			
	
			if($_GET["start"]) {
				if (is_numeric(urldecode($_GET["start"]))) {
					$fromDate = date("Y-m-d", urldecode($_GET["start"]));		
				}
				else {
					$fromDate = date("Y-m-d", strtotime(urldecode($_GET["start"])));						
				}
			}
			else {
				$fromDate = date("Y-m-d", strtotime("now"));
			}
			
			if($_GET["end"]) {
				if (is_numeric(urldecode($_GET["end"]))) {
					$toDate = date("Y-m-d", urldecode($_GET["end"]));		
				}
				else {				
					$toDate = date("Y-m-d", strtotime(urldecode($_GET["end"])));		
				}
			}
			else {
				$toDate = date("Y-m-d", strtotime("+6 weeks"));	
			}	
			
			if ($_GET["category"]) {
				$categoryID=urldecode($_GET["category"]);
				if ($categoryID==99) {
					$categoryID="";
				}
			}	
			else {
				$categoryID="";
			}
			
			if ($_GET["area"]) {
				$areaID=urldecode($_GET["area"]);
	
			}	
			else {
				$areaID="";
			}
					
			if ($_GET["keywords"]) {
				$keywords=urldecode($_GET["keywords"]);
			}	
			else {
				$keywords="";
			}
	
			$calendar = new \CAL\calendar($this->db);
	
			$events = $calendar->getAllEventsByDateRange(1, $fromDate, $toDate, $categoryID, $keywords, $areaID);
			$this->vars["events"]=$events; 
	
			$this->view="CAL_FEED_JSON";
		
			return true;
			
		}
 		else {

		   $calendar = new \CAL\calendar($this->db);
		   $this->view = "CAL_RESULTS_JSON";

		   $events = $calendar->getAllEventsByDateRange(1, "2013-08-01", "2013-10-02");

		   $this->vars["events"]=$events; 		

		   return true;
		}
	}

	
	public function data() {
		
		return $this->vars;
	}


	public function view() {
	
		if ($_GET["mobile"] == "yes") {
			return "mobile";
		}
		else {			
			return $this->view;
		}
	}
	
	public function transfer() {
		
		return $this->transfer;
	}



}
?>
