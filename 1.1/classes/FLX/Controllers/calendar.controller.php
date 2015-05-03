<?php

/**
 * FILELOGIX CALENDAR CLASS
 *  
 * @author Wes Benwick
 * @link http://www.filelogix.com
 * @license Part of Filelogix usage license
 */ 
 
namespace FLX\Controllers;

require_once('/var/www/html/lib/recaptcha/recaptchalib.php');

class calendar
{  
    // Will store database connection here
	private $db;
	private $connID;
	private $sessionID;
	private $userID;
	private $view = "CAL_LARGE_WRAPPER";
	private $auth;
	private $vars = array();
	private $lists;
	private $registration;
	private $transfer = false;
	private $calendar;

	/**
  	 * Create instance, load current info based on session info
  	 *
  	 * @return bool
  	 */
	
	public function __construct($db, $sessionID, $userID) {
	  $this->db = $db;
	  $this->sessionID = $sessionID;
	  $this->auth = new \auth($db);
	  $this->userID = $this->auth->getUserID();

	  $this->lists = new \lists($this->db);
	  	
	  $this->calendar = new \CAL\calendar($this->db);	 
	  	 
  	  $this->vars["categories"]=$this->calendar->getAllCategories();
  	  $this->vars["areas"]=$this->calendar->getAllAreas(1);

	  $this->vars["events"] = $this->calendar->getTopEvents(1, "2013-09-30", "2013-10-04", 3);

	  $this->search();

	  	 
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
/*
	  $this->users=$this->db->query("select * from connections");
	  foreach ($this->users as $row) {
		  $this->userID = $row['userID'];
		  $this->username = $row['username'];
		  $this->emailAddress = $row['emailAddress'];
      }
      
*/
//        $this->vars["loginAlert"]="<div class=\"alert alert-error\"><button type=\"button\" class=\"close\" style=\"text-indent: 0px; height: 100%;\" data-dismiss=\"alert\">&times;</button> <strong>Warning!</strong> Invalid username or password.</div>";

		$this->vars["loginUsername"]="wbenwick@filelogix.net";


		$this->vars["dropdowns"] = $this->lists->retrieveByID("1");
		
	}
	
	public function add($params) {

	  $this->vars["returnURL"] = "calendar/manage";
	  
	  $calendar = new \CAL\calendar($this->db);

	  if ($this->auth->validate($this->userID)) {

		if (($_POST["submit"] == "Create") or ($_POST["submit"] == "Save")) {

			$eventTitle = $_POST["eventTitle"];
			$category = $_POST["category"];
			$startDateTime = $_POST["startDateTime"];
			$endDateTime = $_POST["endDateTime"];
			$repeatFreq = $_POST["repeatFreq"];
			$repeatWhen = $_POST["repeatWhen"];
			$repeatDay = $_POST["repeatDay"];
			$stopRepeating = $_POST["stopRepeating"];
			$eventLocation = $_POST["eventLocation"];
			$newLocation = $_POST["newLocation"];
			$description = $_POST["description"];
			$eventCost = $_POST["eventCost"];
			$ticketURL = $_POST["ticketURL"];
			$eventDescription = $_POST["eventDescription"];
			$eventDetails = $_POST["eventDetails"];
			$eventLink = $_POST["eventLink"];
			$eventTicketed = $_POST["eventTicketed"];
			$eventRepeats = $_POST["eventRepeats"];

			
			$startDateTimeStr = date("Y-m-d H:i", strtotime($startDateTime));
			$endDateTimeStr = date("Y-m-d H:i", strtotime($endDateTime));
			
			foreach ($_POST as $postkey => $postvalue) {
    			$this->vars[$postkey]=$postvalue;
			}
						
			if ($category == "") {
				$this->vars["alertError"]=true;
				$this->vars["errorMsg"]="Please select an Event Category.";				
			}
			
			else if ($eventTitle == "") {
				$this->vars["alertError"]=true;
				$this->vars["errorMsg"]="Please enter an Event Title.";				
			}

			else if ($startDateTimeStr == "") {
				$this->vars["alertError"]=true;
				$this->vars["errorMsg"]="Please choose an Starting Date & Time.";				
			}

			else if ($endDateTimeStr == "") {
				$this->vars["alertError"]=true;
				$this->vars["errorMsg"]="Please choose an Ending Date & Time.";				
			}	
			
			else if ($eventDetails == "") {
				$this->vars["alertError"]=true;
				$this->vars["errorMsg"]="Please provide details about the event.";				
			}	
			
			else if ($eventDescription == "") {
				$this->vars["alertError"]=true;
				$this->vars["errorMsg"]="Please provide a description about this event.";				
			}	
			else if (strtotime($startDateTimeStr) > strtotime($endDateTimeStr)) {
				$this->vars["alertError"]=true;
				$this->vars["errorMsg"]="Please correct your Start and Ending times.";					
			}
			else {
				
				if ($eventLocation == "new") {
					if ($newLocation == "") {
						$this->vars["alertError"]=true;
						$this->vars["errorMsg"]="Please enter an Event Location.";								
					}
					else {
						$city = "";
						$state = "";
						$zip = "";
						$address = $newLocation;
						$name = strtok($newLocation, "\n");
						$locationID = $calendar->createLocation($name,$address,$city,$state,$zip);		
						$eventLocation = $locationID;
					}
				}
				else {
					$locationID = $eventLocation;
				}	
				
				$categoryName = $calendar->getCategoryByID($category);
					
				if (!$categoryName){
					$this->vars["alertError"]=true;
					$this->vars["errorMsg"]="Please select a category.";								

				}

				$locationName = $calendar->getLocationByID($eventLocation);
					
				if (!$locationName){
					$this->vars["alertError"]=true;
					$this->vars["errorMsg"]="Please select a location. (404)";								

				}
				
				else {
				
					if ($_POST["submit"] == "Create") {
						$eventID = $calendar->createEvent("1", $eventTitle, $eventDescription, $eventDetails, $category, $startDateTimeStr, $endDateTimeStr, $eventLocation, $eventLink, $eventRepeats);
						$this->vars["successMsg"]="Your new event was successfully added to the calendar.";	
					}
					else if ($_POST["submit"] == "Save") {
						$eventID = $_POST["eventID"];
						$eventID = $calendar->updateEvent($eventID, "1", $eventTitle, $eventDescription, $eventDetails, $category, $startDateTimeStr, $endDateTimeStr, $eventLocation, $eventLink, $eventRepeats);						
						$this->vars["successMsg"]="Your new event was saved and the calendar has been updated.";	
					}
						
					error_log("Event Saved: "  . $eventID);
	
					if ($eventID>0) {
						
						$this->vars["alertSuccess"]=true;
								
						return $this->manage($params);

					}
					
					else {
						$this->vars["alertError"]=true;
						$this->vars["errorMsg"]="An error occurred while saving this event.  Please try again.";							
					}
				}
			}
		}
		
		else {
		
			$this->view="CAL_NEW_EVENT_V2";
			$this->vars["navCreateActive"]=true;
//			$this->vars["alertInfo"]=true;
//			$this->vars["infoMsg"]="The event was not saved, please try again.";
			
		}
		
		$this->vars["action"] = "Create";
		$this->vars["locations"]=$calendar->getLocations();
		$this->vars["categories"]=$calendar->getAllCategories();
   	    $this->vars["areas"]=$this->calendar->getAllAreas(1);
		$this->view = "CAL_NEW_EVENT_V2";
		$this->vars["navCreateActive"]=true;
		
		return true;
	  }
	  
	  else {

		$this->view="CAL_LOGIN";
		$this->vars["navHomeActive"]=false;
		
		return true;		  
		  
	  }

	}

	public function event($params) {

	  if ($this->auth->validate($this->userID)) {

			$calendar = new \CAL\calendar($this->db);

			$this->vars["locations"]=$calendar->getLocations();
			$this->vars["categories"]=$calendar->getAllCategories();
			$this->vars["areas"]=$this->calendar->getAllAreas(1);
		
			$this->view="CAL_NEW_EVENT_V2";
			$this->vars["navManageActive"]=true;

			$event = $calendar->getEventByID($params[4]);

			$this->vars["eventTitle"] = $event["sTitle"];
			$this->vars["category"] = $event["kCategoryID"];
			$this->vars["startDateTime"] = $event["startStr"];
			$this->vars["endDateTime"] = $event["endStr"];
			$this->vars["repeatFreq"] = $event["repeatFreq"];
			$this->vars["repeatWhen"] = $event["repeatWhen"];
			$this->vars["repeatDay"] = $event["repeatDay"];
			$this->vars["stopRepeating"] = $event["stopRepeating"];
			$this->vars["eventLocation"] = $event["kLocationID"];
			$this->vars["newLocation"] = $event["zAddress"];
			$this->vars["description"] = $event["sDescription"];
			$this->vars["eventCost"] = $event["eventCost"];
			$this->vars["ticketURL"] = $event["sURL"];
			$this->vars["eventDescription"] = $event["sDescription"];
			$this->vars["eventDetails"] = $event["sDetails"];
			$this->vars["eventLink"] = $event["sURL"];
			$this->vars["eventTicketed"] = $event["bTicketed"];
			$this->vars["eventRepeats"] = $event["bRepeats"];
			$this->vars["eventID"] = $event["eventID"];
			$this->vars["locationID"] = $event["locationID"];
			$this->vars["categoryID"] = $event["categoryID"];

			$this->vars["locationDisabled"] = "";
			$this->vars["locationReadOnly"] = "readonly";
			$this->vars["returnURL"] = "calendar/manage";

			$this->vars["action"] = "Save";
			$this->vars["formAction"] = "update";

		
			return true;
		  	
	  }
	  
	  else {

		$this->view="CAL_LOGIN";
		$this->vars["navHomeActive"]=false;
		
		return true;		  
		  
	  }
		
		
		
	}


	public function update($params) {
		
		return $this->add($params);
	}


	public function create($params) {

	  if ($this->auth->validate($this->userID)) {
		
		if ($_POST["submit"] == "Create") {
		
			return $this->add($params);
		
		}
		
		else {
		
			$this->view="CAL_NEW_EVENT_V2";
			$this->vars["navCreateActive"]=true;
			$this->vars["alertWarning"]=true;
			$this->vars["warningMsg"]="The event was not saved, please try again.";
			
		}

		return true;
	  }
	  
	  else {

		$this->view="CAL_LOGIN";
		$this->vars["navHomeActive"]=false;
		
		return true;		  
		  
	  }

	}


	public function results($params) {

		$calendar = new \CAL\calendar($this->db);

		$categoryID = $_POST["category"];

		if (($_POST["fromDate"] == "") or ($_POST["toDate"] == "")) {
			
			$fromDate = date("Y/m/d", strtotime("now"));
			$toDate = date("Y/m/d", strtotime("+1 week"));			
			
		}
		
		else {	
		
			$fromDate = date("Y/m/d", strtotime($_POST["fromDate"]));
			$toDate = date("Y/m/d", strtotime($_POST["toDate"]));

		}

		$days = $calendar->getAllDaysByDateRange(1, $fromDate, $toDate);
		$events = $calendar->getAllEventsByDateRange(1, $fromDate, $toDate, $categoryID, $keywords, $areaID);

		$this->vars["calDays"]=$days; 		
		$this->vars["events"]=$events; 		

		error_log("Dates: " . $fromDate . " " . $toDate);
			
//		$fromDateStr = new DateTime($fromDate);
//		$toDateStr = new DateTime($toDate);

		$this->vars["fromDate"]=date("m/d/y", strtotime($fromDate));
		$this->vars["toDate"]=date("m/d/y", strtotime($toDate));
		$this->vars["categoryID"]=$categoryID; 		
		
		$this->view="CAL_RESULTS";
		
		return true;		  
		  
	}

	public function search($params) {

		$calendar = new \CAL\calendar($this->db);

		$categoryID = $_POST["category"];

		if ($params[4] == "day") {
			
				$fromDate = date("Y/m/d", strtotime($params[5] . " -3 days"));
				$beginDate = date("Y/m/d", strtotime($params[5]));
				$endDate = date("Y/m/d", strtotime($params[5] . " +23:59 hours"));
				$toDate = date("Y/m/d", strtotime($params[5] . " +3 days"));
				
				$endDate = $beginDate . " 23:59";


				$days = $calendar->getAllDaysByDateRange(1, $fromDate, $toDate);
				$events = $calendar->getAllEventsByDateRange(1, $beginDate, $endDate, $categoryID, $keywords, $areaID);
		
				$this->vars["calDays"]=$days; 		
				$this->vars["events"]=$events; 

				$_POST["fromDate"] = $fromDate;
				$_POST["toDate"] = $toDate;

				$this->vars["fromDate"]=date("m/d/y", strtotime($beginDate));
				$this->vars["toDate"]=date("m/d/y", strtotime($beginDate));
				$this->vars["categoryID"]=$categoryID; 		
		
				$this->view="CAL_RESULTS";

				return true;
		}
		
		else if ($params[4] == "next-week") {
			
				$fromDate = date("Y/m/d", strtotime("+7 days"));
				$toDate = date("Y/m/d", strtotime("+14 days"));

				error_log("Next Week: " . $fromDate . " " . $toDate);

				$_POST["fromDate"] = $fromDate;
				$_POST["toDate"] = $toDate;

				return $this->results($params);
		}

		else if ($params[4] == "next-month") {
			
				$fromDate = date("Y/m/d", strtotime("first day of next month"));
				$toDate = date("Y/m/d", strtotime("last day of next month"));

				$_POST["fromDate"] = $fromDate;
				$_POST["toDate"] = $toDate;

				return $this->results($params);
		}

		else if ($params[4] == "this-month") {
			
				$fromDate = date("Y/m/d", strtotime("first day of this month"));
				$toDate = date("Y/m/d", strtotime("last day of this month"));

				error_log("This Month: " . $fromDate . " " . $toDate);

				$_POST["fromDate"] = $fromDate;
				$_POST["toDate"] = $toDate;

				return $this->results($params);
		}
		
		else if ($params[4] == "upcoming") {
			
				$fromDate = date("Y/m/d", strtotime("now"));
				$toDate = date("Y/m/d", strtotime("+14 days"));

				error_log("Upcoming: " . $fromDate . " " . $toDate);

				$_POST["fromDate"] = $fromDate;
				$_POST["toDate"] = $toDate;

				return $this->results($params);
		}
				
		else {

			if (($_POST["fromDate"] == "") or ($_POST["toDate"] == "")) {
				
				$fromDate = date("Y/m/d", strtotime("now"));
				$toDate = date("Y/m/d", strtotime("+1 week"));			
				
			}
			
			else {	
			
//				$fromDate = date("Y/m/d", strtotime($_POST["fromDate"]));
//				$toDate = date("Y/m/d", strtotime($_POST["toDate"]));
	
			}

			error_log("Search: " . $fromDate . " " . $toDate);

			$days = $calendar->getAllDaysByDateRange(1, $fromDate, $toDate);
			$events = $calendar->getTopEvents(1, $fromDate, $toDate);
	
			$this->vars["fromDate"]=date("m/d/y", strtotime($fromDate));
			$this->vars["toDate"]=date("m/d/y", strtotime($toDate));
			$this->vars["categoryID"]=$categoryID; 		

	
			$this->vars["calDays"]=$days; 		
			$this->vars["events"]=$events; 		
	
			$this->view="CAL_LARGE_WRAPPER";

			return true;

		}
				  
	}


	public function results2($params) {

		$calendar = new \CAL\calendar($this->db);

		$days = $calendar->getAllDaysByDateRange(1, "2013-08-30", "2013-10-04");
		$events = $calendar->getAllEventsByDateRange(1, "2013-09-30", "2014-10-04", $categoryID, $keywords, $areaID);

		$this->vars["events"]=$events; 		

		$this->view="CAL_RESULTS_NEW";
		
		return true;		  
		  
	}


	public function js($params) {

		$calendar = new \CAL\calendar($this->db);

#		$days = $calendar->getAllDaysByDateRange(1, "2013-08-30", "2013-10-04");
#		$events = $calendar->getAllEventsByDateRange(1, "2013-09-30", "2014-10-04", $categoryID);

#		$this->vars["events"]=$events; 		

		$this->vars["calendarView"]=$params[5]; 		

		if ($params[5] == '') {
			$this->vars["calendarView"]='large'; 					
		}
		
		if ($params[4] == "widget") {
			$this->view="CAL_JS_WIDGET";				
		}
		else if ($params[4] == "popup") {
			$this->view="CAL_JS_POPUP";				

		}
		else {
			$this->view="CAL_JS_WIDGET";				

		}
		$dates = $calendar->repeatingDates("0", "", array("15"), "12", "", "2013-12-15", "2014-12-31");		

//		$dates = $calendar->repeatingDates("", "", array("1","15"), "2", "", "2013-10-30", "2014-12-31");		

		sort($dates, SORT_STRING);
	
		foreach($dates as $date) {
			error_log("Repeating Dates: $date " . date('D d M Y',strtotime($date)));
		}
	

		return true;		  
		  
	}


	public function js2($params) {

		$calendar = new \CAL\calendar($this->db);

#		$days = $calendar->getAllDaysByDateRange(1, "2013-08-30", "2013-10-04");
#		$events = $calendar->getAllEventsByDateRange(1, "2013-09-30", "2014-10-04", $categoryID);

#		$this->vars["events"]=$events; 		

		$this->vars["calendarView"]=$params[5]; 		

		if ($params[5] == '') {
			$this->vars["calendarView"]='large'; 					
		}
		
		if ($params[4] == "widget") {
			$this->view="CAL_JS_WIDGET2";				
		}
		else if ($params[4] == "popup") {
			$this->view="CAL_JS_POPUP";				

		}
		else {
			$this->view="CAL_JS_WIDGET2";				

		}
		$dates = $calendar->repeatingDates("0", "", array("15"), "12", "", "2013-12-15", "2014-12-31");		

//		$dates = $calendar->repeatingDates("", "", array("1","15"), "2", "", "2013-10-30", "2014-12-31");		

		sort($dates, SORT_STRING);
	
		foreach($dates as $date) {
			error_log("Repeating Dates: $date " . date('D d M Y',strtotime($date)));
		}
	

		return true;		  
		  
	}

	public function widget($params) {

		$calendar = new \CAL\calendar($this->db);

#		$days = $calendar->getAllDaysByDateRange(1, "2013-08-30", "2013-10-04");
#		$events = $calendar->getAllEventsByDateRange(1, "2013-09-30", "2014-10-04", $categoryID);

#		$this->vars["events"]=$events; 		

		error_log("From Date: " . $_GET["from"]);


		if($_GET["from"]) {
			$fromDate = date("Y/m/d", strtotime(urldecode($_GET["from"])));		
		}
		else {
			$fromDate = date("Y/m/d", strtotime("now"));
		}
		
		if($_GET["to"]) {
			$toDate = date("Y/m/d", strtotime(urldecode($_GET["to"])));		
		}
		else {
			$toDate = date("Y/m/d", strtotime("+2 week"));	
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
		
		if ($_GET["keywords"]) {
			$keywords=urldecode($_GET["keywords"]);
		}	
		else {
			$keywords="";
		}

		error_log("Search: " . $fromDate . " " . $toDate);
		
		$days = $calendar->getAllDaysByDateRange(1, $fromDate, $toDate);
		$events = $calendar->getTopEvents(1, $fromDate, $toDate);

	
		$this->vars["fromDate"]=date("m/d/y", strtotime($fromDate));
		$this->vars["toDate"]=date("m/d/y", strtotime($toDate));
		$this->vars["categoryID"]=$categoryID; 		

	
		$this->vars["calDays"]=$days; 		
		$this->vars["events"]=$events; 

		if($params[4]=="small") { 		

			$this->view="CAL_SMALL_BODY";				
			if ($params[5]=="event") {
				if ($params[6]=="id") {
					error_log("Show Event ID: " . $params[7]);
					$this->vars["eventID"] = $params[7]; 
					$this->vars["event"] = 	$calendar->getEventByID($params[7]);	
					$this->view="CAL_WIDGET_SMALL_DETAILS";									
				}
				else {
					$this->view="CAL_SMALL_BODY";								
				}
			}
			else if ($params[5]=="go") {
				$events = $calendar->getAllEventsByDateRange(1, $fromDate, $toDate, $categoryID, $keywords, $areaID);
				$this->vars["events"]=$events; 

				$days = $calendar->getAllDaysByDateRange(1, $fromDate, $toDate);
				$this->vars["calDays"]=$days; 

				$this->vars["previousTo"]=date("Y/m/d", strtotime("$fromDate - 1 day"));
				$this->vars["previousFrom"]=date("Y/m/d", strtotime("$fromDate - 1 day"));
				$this->vars["nextTo"]=date("Y/m/d", strtotime("$toDate + 1 day"));
				$this->vars["nextFrom"]=date("Y/m/d", strtotime("$toDate + 1 day"));
			
				
//				$this->view="CAL_WIDGET_SMALL_EVENT_LIST";													
				$this->view="CAL_WIDGET_SMALL_RESULT_LIST";													
			}
			else if ($params[5]=="day") {
				$fromDate = urldecode($params[6]);
				$toDate = urldecode($params[6]);
				$events = $calendar->getAllEventsByDateRange(1, $fromDate, $toDate, $categoryID, $keywords, $areaID);
				$this->vars["events"]=$events;  

				$this->vars["previousTo"]=date("Y/m/d", strtotime("$fromDate - 1 day"));
				$this->vars["previousFrom"]=date("Y/m/d", strtotime("$fromDate - 1 day"));
				$this->vars["nextTo"]=date("Y/m/d", strtotime("$toDate + 1 day"));
				$this->vars["nextFrom"]=date("Y/m/d", strtotime("$toDate + 1 day"));

				$this->vars["fromDate"]=date("m/d/Y",strtotime($fromDate));
				$this->vars["toDate"]=date("m/d/Y",strtotime($toDate));
								
				$this->view="CAL_WIDGET_SMALL_RESULT_LIST";													
			}

			else if ($params[5]=="days") {
				$fromDate = urldecode($params[6]);
				$toDate = urldecode($params[7]);
				$events = $calendar->getAllEventsByDateRange(1, $fromDate, $toDate, $categoryID, $keywords, $areaID);
				$this->vars["events"]=$events;  

				$this->vars["previousTo"]=date("Y/m/d", strtotime("$fromDate - 1 day"));
				$this->vars["previousFrom"]=date("Y/m/d", strtotime("$fromDate - 1 day"));
				$this->vars["nextTo"]=date("Y/m/d", strtotime("$toDate + 1 day"));
				$this->vars["nextFrom"]=date("Y/m/d", strtotime("$toDate + 1 day"));

				$this->vars["fromDate"]=date("m/d/Y",strtotime($fromDate));
				$this->vars["toDate"]=date("m/d/Y",strtotime($toDate));
								
				$this->view="CAL_WIDGET_SMALL_RESULT_LIST";													
			}

			else if ($params[5]=="next") {
				$fromDate = urldecode($params[6]);
				$toDate = urldecode($params[7]);
				$events = $calendar->getAllEventsByDateRange(1, $fromDate, $toDate, $categoryID, $keywords, $areaID);
				$this->vars["events"]=$events;  

				$this->vars["previousTo"]=date("Y/m/d", strtotime("$fromDate - 1 day"));
				$this->vars["previousFrom"]=date("Y/m/d", strtotime("$fromDate - 1 day"));
				$this->vars["nextTo"]=date("Y/m/d", strtotime("$toDate + 1 day"));
				$this->vars["nextFrom"]=date("Y/m/d", strtotime("$toDate + 1 day"));

				$this->vars["fromDate"]=date("m/d/Y",strtotime($fromDate));
				$this->vars["toDate"]=date("m/d/Y",strtotime($toDate));

				$this->view="CAL_WIDGET_SMALL_RESULT_LIST";													
			}
			
			else if ($params[5]=="previous") {
				$fromDate = urldecode($params[6]);
				$toDate = urldecode($params[7]);
				$events = $calendar->getAllEventsByDateRange(1, $fromDate, $toDate, $categoryID, $keywords, $areaID);
				$this->vars["events"]=$events;  

				$this->vars["previousTo"]=date("Y/m/d", strtotime("$fromDate - 1 day"));
				$this->vars["previousFrom"]=date("Y/m/d", strtotime("$fromDate - 1 day"));
				$this->vars["nextTo"]=date("Y/m/d", strtotime("$toDate + 1 day"));
				$this->vars["nextFrom"]=date("Y/m/d", strtotime("$toDate + 1 day"));

				$this->vars["fromDate"]=date("m/d/Y",strtotime($fromDate));
				$this->vars["toDate"]=date("m/d/Y",strtotime($toDate));
												
				$this->view="CAL_WIDGET_SMALL_RESULT_LIST";													
			}
						
			else if ($params[5]=="nextWeek") {
	
				$fromDate = date("Y/m/d", strtotime("+7 days"));
				$toDate = date("Y/m/d", strtotime("+14 days"));

//				error_log("Next Week: " . $fromDate . " " . $toDate);

				$_POST["fromDate"] = $fromDate;
				$_POST["toDate"] = $toDate;
	
				$events = $calendar->getAllEventsByDateRange(1, $fromDate, $toDate, $categoryID, $keywords, $areaID);
				$this->vars["events"]=$events; 

				$days = $calendar->getAllDaysByDateRange(1, $fromDate, $toDate);
				$this->vars["calDays"]=$days; 

				$this->vars["previousTo"]=date("Y/m/d", strtotime("last day of last week"));
				$this->vars["previousFrom"]=date("Y/m/d", strtotime("first day of last week"));
				$this->vars["nextTo"]=date("Y/m/d", strtotime("last day of next week"));
				$this->vars["nextFrom"]=date("Y/m/d", strtotime("first day of next week"));

				$this->vars["fromDate"]=date("m/d/Y",strtotime($fromDate));
				$this->vars["toDate"]=date("m/d/Y",strtotime($toDate));	
											
				$this->view="CAL_WIDGET_SMALL_RESULT_LIST";													
			}	

			else if ($params[5]=="nextMonth") {
	
				$fromDate = date("Y/m/d", strtotime("first day of next month"));
				$toDate = date("Y/m/d", strtotime("last day of next month"));

//				error_log("Next Week: " . $fromDate . " " . $toDate);

				$days = $calendar->getAllDaysByDateRange(1, $fromDate, $toDate);
				$this->vars["calDays"]=$days; 

				$_POST["fromDate"] = $fromDate;
				$_POST["toDate"] = $toDate;
	
				$events = $calendar->getAllEventsByDateRange(1, $fromDate, $toDate, $categoryID, $keywords, $areaID);
				$this->vars["events"]=$events; 

				$this->vars["previousTo"]=date("Y/m/d", strtotime("$toDate - 1 month"));
				$this->vars["previousFrom"]=date("Y/m/d", strtotime("$fromDate - 1 month"));
				$this->vars["nextTo"]=date("Y/m/d", strtotime("$toDate + 1 month"));
				$this->vars["nextFrom"]=date("Y/m/d", strtotime("$fromDate + 1 month"));

				$this->vars["fromDate"]=date("m/d/Y",strtotime($fromDate));
				$this->vars["toDate"]=date("m/d/Y",strtotime($toDate));	
											
				$this->view="CAL_WIDGET_SMALL_RESULT_LIST";													
			}	

			else if ($params[5]=="thisMonth") {
	
				$fromDate = date("Y/m/d", strtotime("first day of this month"));
				$toDate = date("Y/m/d", strtotime("last day of this month"));

				$days = $calendar->getAllDaysByDateRange(1, $fromDate, $toDate);
				$this->vars["calDays"]=$days; 
				
//				error_log("Next Week: " . $fromDate . " " . $toDate);

				$_POST["fromDate"] = $fromDate;
				$_POST["toDate"] = $toDate;

				$this->vars["previousTo"]=date("Y/m/d", strtotime("last day of last month"));
				$this->vars["previousFrom"]=date("Y/m/d", strtotime("first day of last month"));
				$this->vars["nextTo"]=date("Y/m/d", strtotime("last day of next month"));
				$this->vars["nextFrom"]=date("Y/m/d", strtotime("first day of next month"));
	
				$events = $calendar->getAllEventsByDateRange(1, $fromDate, $toDate, $categoryID, $keywords, $areaID);
				$this->vars["events"]=$events; 

				$this->vars["fromDate"]=date("m/d/Y",strtotime($fromDate));
				$this->vars["toDate"]=date("m/d/Y",strtotime($toDate));	
							
				$this->view="CAL_WIDGET_SMALL_RESULT_LIST";													
			}
			else {
				$this->vars["previousTo"]=date("Y/m/d", strtotime("yesterday"));
				$this->vars["previousFrom"]=date("Y/m/d", strtotime("yesterday"));
				$this->vars["nextTo"]=date("Y/m/d", strtotime("tomorrow"));
				$this->vars["nextFrom"]=date("Y/m/d", strtotime("tomorrow"));
				$events = $calendar->getAllEventsByDateRange(1, $fromDate, $toDate, $categoryID, $keywords, $areaID);
				$this->vars["events"]=$events; 
				$this->view="CAL_SMALL_BODY";				
			}

		}

		else if($params[4]=="medium") { 		

			$this->view="CAL_MEDIUM_BODY";				
			if ($params[5]=="event") {
				if ($params[6]=="id") {
					error_log("Show Event ID: " . $params[7]);
					$this->vars["eventID"] = $params[7]; 
					$this->vars["event"] = 	$calendar->getEventByID($params[7]);	
					$this->view="CAL_WIDGET_MEDIUM_DETAILS";									
				}
				else {
					$this->view="CAL_MEDIUM_BODY";								
				}
			}
			else if ($params[5]=="go") {
				$events = $calendar->getAllEventsByDateRange(1, $fromDate, $toDate, $categoryID, $keywords, $areaID);
				$this->vars["events"]=$events; 

				$days = $calendar->getAllDaysByDateRange(1, $fromDate, $toDate);
				$this->vars["calDays"]=$days; 

				$this->vars["previousTo"]=date("Y/m/d", strtotime("$fromDate - 1 day"));
				$this->vars["previousFrom"]=date("Y/m/d", strtotime("$fromDate - 1 day"));
				$this->vars["nextTo"]=date("Y/m/d", strtotime("$toDate + 1 day"));
				$this->vars["nextFrom"]=date("Y/m/d", strtotime("$toDate + 1 day"));
			
				
//				$this->view="CAL_WIDGET_SMALL_EVENT_LIST";													
				$this->view="CAL_WIDGET_MEDIUM_RESULT_LIST";													
			}

			else if ($params[5]=="add") {
												
				$this->view="CAL_WIDGET_MEDIUM_ADDEVENT_BODY";													
			}
			
			else if ($params[5]=="day") {
				$fromDate = urldecode($params[6]);
				$toDate = urldecode($params[6]);
				$events = $calendar->getAllEventsByDateRange(1, $fromDate, $toDate, $categoryID, $keywords, $areaID);
				$this->vars["events"]=$events;  

				$this->vars["previousTo"]=date("Y/m/d", strtotime("$fromDate - 1 day"));
				$this->vars["previousFrom"]=date("Y/m/d", strtotime("$fromDate - 1 day"));
				$this->vars["nextTo"]=date("Y/m/d", strtotime("$toDate + 1 day"));
				$this->vars["nextFrom"]=date("Y/m/d", strtotime("$toDate + 1 day"));

				$this->vars["fromDate"]=date("m/d/Y",strtotime($fromDate));
				$this->vars["toDate"]=date("m/d/Y",strtotime($toDate));
								
				$this->view="CAL_WIDGET_MEDIUM_RESULT_LIST";													
			}

			else if ($params[5]=="days") {
				$fromDate = urldecode($params[6]);
				$toDate = urldecode($params[7]);
				$events = $calendar->getAllEventsByDateRange(1, $fromDate, $toDate, $categoryID, $keywords, $areaID);
				$this->vars["events"]=$events;  

				$this->vars["previousTo"]=date("Y/m/d", strtotime("$fromDate - 1 day"));
				$this->vars["previousFrom"]=date("Y/m/d", strtotime("$fromDate - 1 day"));
				$this->vars["nextTo"]=date("Y/m/d", strtotime("$toDate + 1 day"));
				$this->vars["nextFrom"]=date("Y/m/d", strtotime("$toDate + 1 day"));

				$this->vars["fromDate"]=date("m/d/Y",strtotime($fromDate));
				$this->vars["toDate"]=date("m/d/Y",strtotime($toDate));
								
				$this->view="CAL_WIDGET_MEDIUM_RESULT_LIST";													
			}

			else if ($params[5]=="next") {
				$fromDate = urldecode($params[6]);
				$toDate = urldecode($params[7]);
				$events = $calendar->getAllEventsByDateRange(1, $fromDate, $toDate, $categoryID, $keywords, $areaID);
				$this->vars["events"]=$events;  

				$this->vars["previousTo"]=date("Y/m/d", strtotime("$fromDate - 1 day"));
				$this->vars["previousFrom"]=date("Y/m/d", strtotime("$fromDate - 1 day"));
				$this->vars["nextTo"]=date("Y/m/d", strtotime("$toDate + 1 day"));
				$this->vars["nextFrom"]=date("Y/m/d", strtotime("$toDate + 1 day"));

				$this->vars["fromDate"]=date("m/d/Y",strtotime($fromDate));
				$this->vars["toDate"]=date("m/d/Y",strtotime($toDate));

				$this->view="CAL_WIDGET_MEDIUM_RESULT_LIST";													
			}
			
			else if ($params[5]=="previous") {
				$fromDate = urldecode($params[6]);
				$toDate = urldecode($params[7]);
				$events = $calendar->getAllEventsByDateRange(1, $fromDate, $toDate, $categoryID, $keywords, $areaID);
				$this->vars["events"]=$events;  

				$this->vars["previousTo"]=date("Y/m/d", strtotime("$fromDate - 1 day"));
				$this->vars["previousFrom"]=date("Y/m/d", strtotime("$fromDate - 1 day"));
				$this->vars["nextTo"]=date("Y/m/d", strtotime("$toDate + 1 day"));
				$this->vars["nextFrom"]=date("Y/m/d", strtotime("$toDate + 1 day"));

				$this->vars["fromDate"]=date("m/d/Y",strtotime($fromDate));
				$this->vars["toDate"]=date("m/d/Y",strtotime($toDate));
												
				$this->view="CAL_WIDGET_MEDIUM_RESULT_LIST";													
			}
						
			else if ($params[5]=="nextWeek") {
	
				$fromDate = date("Y/m/d", strtotime("+7 days"));
				$toDate = date("Y/m/d", strtotime("+14 days"));

//				error_log("Next Week: " . $fromDate . " " . $toDate);

				$_POST["fromDate"] = $fromDate;
				$_POST["toDate"] = $toDate;
	
				$events = $calendar->getAllEventsByDateRange(1, $fromDate, $toDate, $categoryID, $keywords, $areaID);
				$this->vars["events"]=$events; 

				$days = $calendar->getAllDaysByDateRange(1, $fromDate, $toDate);
				$this->vars["calDays"]=$days; 

				$this->vars["previousTo"]=date("Y/m/d", strtotime("last day of last week"));
				$this->vars["previousFrom"]=date("Y/m/d", strtotime("first day of last week"));
				$this->vars["nextTo"]=date("Y/m/d", strtotime("last day of next week"));
				$this->vars["nextFrom"]=date("Y/m/d", strtotime("first day of next week"));

				$this->vars["fromDate"]=date("m/d/Y",strtotime($fromDate));
				$this->vars["toDate"]=date("m/d/Y",strtotime($toDate));	
											
				$this->view="CAL_WIDGET_MEDIUM_RESULT_LIST";													
			}	

			else if ($params[5]=="nextMonth") {
	
				$fromDate = date("Y/m/d", strtotime("first day of next month"));
				$toDate = date("Y/m/d", strtotime("last day of next month"));

//				error_log("Next Week: " . $fromDate . " " . $toDate);

				$days = $calendar->getAllDaysByDateRange(1, $fromDate, $toDate);
				$this->vars["calDays"]=$days; 

				$_POST["fromDate"] = $fromDate;
				$_POST["toDate"] = $toDate;
	
				$events = $calendar->getAllEventsByDateRange(1, $fromDate, $toDate, $categoryID, $keywords, $areaID);
				$this->vars["events"]=$events; 

				$this->vars["previousTo"]=date("Y/m/d", strtotime("$toDate - 1 month"));
				$this->vars["previousFrom"]=date("Y/m/d", strtotime("$fromDate - 1 month"));
				$this->vars["nextTo"]=date("Y/m/d", strtotime("$toDate + 1 month"));
				$this->vars["nextFrom"]=date("Y/m/d", strtotime("$fromDate + 1 month"));

				$this->vars["fromDate"]=date("m/d/Y",strtotime($fromDate));
				$this->vars["toDate"]=date("m/d/Y",strtotime($toDate));	
											
				$this->view="CAL_WIDGET_MEDIUM_RESULT_LIST";													
			}	

			else if ($params[5]=="thisMonth") {
	
				$fromDate = date("Y/m/d", strtotime("first day of this month"));
				$toDate = date("Y/m/d", strtotime("last day of this month"));

				$days = $calendar->getAllDaysByDateRange(1, $fromDate, $toDate);
				$this->vars["calDays"]=$days; 
				
//				error_log("Next Week: " . $fromDate . " " . $toDate);

				$_POST["fromDate"] = $fromDate;
				$_POST["toDate"] = $toDate;

				$this->vars["previousTo"]=date("Y/m/d", strtotime("last day of last month"));
				$this->vars["previousFrom"]=date("Y/m/d", strtotime("first day of last month"));
				$this->vars["nextTo"]=date("Y/m/d", strtotime("last day of next month"));
				$this->vars["nextFrom"]=date("Y/m/d", strtotime("first day of next month"));
	
				$events = $calendar->getAllEventsByDateRange(1, $fromDate, $toDate, $categoryID, $keywords, $areaID);
				$this->vars["events"]=$events; 

				$this->vars["fromDate"]=date("m/d/Y",strtotime($fromDate));
				$this->vars["toDate"]=date("m/d/Y",strtotime($toDate));	
							
				$this->view="CAL_WIDGET_MEDIUM_RESULT_LIST";													
			}
			else {
				$this->vars["previousTo"]=date("Y/m/d", strtotime("yesterday"));
				$this->vars["previousFrom"]=date("Y/m/d", strtotime("yesterday"));
				$this->vars["nextTo"]=date("Y/m/d", strtotime("tomorrow"));
				$this->vars["nextFrom"]=date("Y/m/d", strtotime("tomorrow"));
				$events = $calendar->getAllEventsByDateRange(1, $fromDate, $toDate, $categoryID, $keywords, $areaID);
				$this->vars["events"]=$events; 
				$this->view="CAL_MEDIUM_BODY";				
			}

		}


		else if($params[4]=="large") { 		
			if ($params[5]=="event") {
				if ($params[6]=="id") {
					error_log("Show Event ID: " . $params[7]);
					$this->vars["eventID"] = $params[7]; 
					$this->vars["event"] = 	$calendar->getEventByID($params[7]);	
					$this->view="CAL_WIDGET_LARGE_DETAILS";									
		
					$days = $calendar->getAllDaysByDateRange(1, $fromDate, $toDate);
					$this->vars["calDays"]=$days; 
					
					$this->vars["previousTo"]=date("Y/m/d", strtotime("$fromDate - 1 day"));
					$this->vars["previousFrom"]=date("Y/m/d", strtotime("$fromDate - 1 day"));
					$this->vars["nextTo"]=date("Y/m/d", strtotime("$toDate + 1 day"));
					$this->vars["nextFrom"]=date("Y/m/d", strtotime("$toDate + 1 day"));

//					$this->vars["address"] = urlencode($this->vars["event"]["locationName"] . " " . $this->vars["event"]["zAddress"] . " " . $this->vars["event"]["zipcode"]);
					$this->vars["address"] = urlencode($this->vars["event"]["zAddress"] . " " . $this->vars["event"]["sCity"] . "," . $this->vars["event"]["sState"] . "  " .$this->vars["event"]["zipcode"]);
					
					$this->vars["bGeocoded"] = $this->vars["event"]["bGeocoded"];
					$this->vars["sLat"] = $this->vars["event"]["sLat"];
					$this->vars["sLon"] = $this->vars["event"]["sLon"];
					
					$this->vars["fromDate"]=date("m/d/Y",strtotime($fromDate));
					$this->vars["toDate"]=date("m/d/Y",strtotime($toDate));	
									
				}
				else {
					$this->view="CAL_LARGE_BODY";								
				}
			}
			else if ($params[5]=="tell-a-friend") {
				$events = $calendar->getAllEventsByDateRange(1, $fromDate, $toDate, $categoryID, $keywords, $areaID);
				$this->vars["events"]=$events; 

				$days = $calendar->getAllDaysByDateRange(1, $fromDate, $toDate);
				$this->vars["calDays"]=$days; 

				$this->vars["previousTo"]=date("Y/m/d", strtotime("$fromDate - 1 day"));
				$this->vars["previousFrom"]=date("Y/m/d", strtotime("$fromDate - 1 day"));
				$this->vars["nextTo"]=date("Y/m/d", strtotime("$toDate + 1 day"));
				$this->vars["nextFrom"]=date("Y/m/d", strtotime("$toDate + 1 day"));
			
				
				$this->view="CAL_WIDGET_LARGE_TELL_A_FRIEND";													
			}			
			else if ($params[5]=="newsletter") {
				$events = $calendar->getAllEventsByDateRange(1, $fromDate, $toDate, $categoryID, $keywords, $areaID);
				$this->vars["events"]=$events; 

				$days = $calendar->getAllDaysByDateRange(1, $fromDate, $toDate);
				$this->vars["calDays"]=$days; 

				$this->vars["previousTo"]=date("Y/m/d", strtotime("$fromDate - 1 day"));
				$this->vars["previousFrom"]=date("Y/m/d", strtotime("$fromDate - 1 day"));
				$this->vars["nextTo"]=date("Y/m/d", strtotime("$toDate + 1 day"));
				$this->vars["nextFrom"]=date("Y/m/d", strtotime("$toDate + 1 day"));
			
				
				$this->view="CAL_WIDGET_LARGE_NEWSLETTER_SIGNUP";													
			}			
			else if ($params[5]=="go") {
				$events = $calendar->getAllEventsByDateRange(1, $fromDate, $toDate, $categoryID, $keywords, $areaID);
				$this->vars["events"]=$events; 

				$days = $calendar->getAllDaysByDateRange(1, $fromDate, $toDate);
				$this->vars["calDays"]=$days; 

				$this->vars["previousTo"]=date("Y/m/d", strtotime("$fromDate - 1 day"));
				$this->vars["previousFrom"]=date("Y/m/d", strtotime("$fromDate - 1 day"));
				$this->vars["nextTo"]=date("Y/m/d", strtotime("$toDate + 1 day"));
				$this->vars["nextFrom"]=date("Y/m/d", strtotime("$toDate + 1 day"));
			
				
				$this->view="CAL_WIDGET_LARGE_EVENT_LIST";													
			}
			else if ($params[5]=="day") {
				$fromDate = urldecode($params[6]);
				$toDate = urldecode($params[6]);
				$events = $calendar->getAllEventsByDateRange(1, $fromDate, $toDate, $categoryID, $keywords, $areaID);
				$this->vars["events"]=$events;  

				$this->vars["previousTo"]=date("Y/m/d", strtotime("$fromDate - 1 day"));
				$this->vars["previousFrom"]=date("Y/m/d", strtotime("$fromDate - 1 day"));
				$this->vars["nextTo"]=date("Y/m/d", strtotime("$toDate + 1 day"));
				$this->vars["nextFrom"]=date("Y/m/d", strtotime("$toDate + 1 day"));

				$this->vars["fromDate"]=date("m/d/Y",strtotime($fromDate));
				$this->vars["toDate"]=date("m/d/Y",strtotime($toDate));
								
				$this->view="CAL_WIDGET_LARGE_EVENT_LIST";													
			}

			else if ($params[5]=="days") {
				$fromDate = urldecode($params[6]);
				$toDate = urldecode($params[7]);
				$events = $calendar->getAllEventsByDateRange(1, $fromDate, $toDate, $categoryID, $keywords, $areaID);
				$this->vars["events"]=$events;  

				$this->vars["previousTo"]=date("Y/m/d", strtotime("$fromDate - 1 day"));
				$this->vars["previousFrom"]=date("Y/m/d", strtotime("$fromDate - 1 day"));
				$this->vars["nextTo"]=date("Y/m/d", strtotime("$toDate + 1 day"));
				$this->vars["nextFrom"]=date("Y/m/d", strtotime("$toDate + 1 day"));

				$this->vars["fromDate"]=date("m/d/Y",strtotime($fromDate));
				$this->vars["toDate"]=date("m/d/Y",strtotime($toDate));
								
				$this->view="CAL_WIDGET_LARGE_EVENT_LIST";													
			}

			else if ($params[5]=="next") {
				$fromDate = urldecode($params[6]);
				$toDate = urldecode($params[7]);
				$events = $calendar->getAllEventsByDateRange(1, $fromDate, $toDate, $categoryID, $keywords, $areaID);
				$this->vars["events"]=$events;  

				$this->vars["previousTo"]=date("Y/m/d", strtotime("$fromDate - 1 day"));
				$this->vars["previousFrom"]=date("Y/m/d", strtotime("$fromDate - 1 day"));
				$this->vars["nextTo"]=date("Y/m/d", strtotime("$toDate + 1 day"));
				$this->vars["nextFrom"]=date("Y/m/d", strtotime("$toDate + 1 day"));

				$this->vars["fromDate"]=date("m/d/Y",strtotime($fromDate));
				$this->vars["toDate"]=date("m/d/Y",strtotime($toDate));

				$this->view="CAL_WIDGET_LARGE_EVENT_LIST";													
			}
			
			else if ($params[5]=="previous") {
				$fromDate = urldecode($params[6]);
				$toDate = urldecode($params[7]);
				$events = $calendar->getAllEventsByDateRange(1, $fromDate, $toDate, $categoryID, $keywords, $areaID);
				$this->vars["events"]=$events;  

				$this->vars["previousTo"]=date("Y/m/d", strtotime("$fromDate - 1 day"));
				$this->vars["previousFrom"]=date("Y/m/d", strtotime("$fromDate - 1 day"));
				$this->vars["nextTo"]=date("Y/m/d", strtotime("$toDate + 1 day"));
				$this->vars["nextFrom"]=date("Y/m/d", strtotime("$toDate + 1 day"));

				$this->vars["fromDate"]=date("m/d/Y",strtotime($fromDate));
				$this->vars["toDate"]=date("m/d/Y",strtotime($toDate));
												
				$this->view="CAL_WIDGET_LARGE_EVENT_LIST";													
			}
						
			else if ($params[5]=="nextWeek") {
	
				$fromDate = date("Y/m/d", strtotime("+7 days"));
				$toDate = date("Y/m/d", strtotime("+14 days"));

//				error_log("Next Week: " . $fromDate . " " . $toDate);

				$_POST["fromDate"] = $fromDate;
				$_POST["toDate"] = $toDate;
	
				$events = $calendar->getAllEventsByDateRange(1, $fromDate, $toDate, $categoryID, $keywords, $areaID);
				$this->vars["events"]=$events; 

				$days = $calendar->getAllDaysByDateRange(1, $fromDate, $toDate);
				$this->vars["calDays"]=$days; 

				$this->vars["previousTo"]=date("Y/m/d", strtotime("last day of last week"));
				$this->vars["previousFrom"]=date("Y/m/d", strtotime("first day of last week"));
				$this->vars["nextTo"]=date("Y/m/d", strtotime("last day of next week"));
				$this->vars["nextFrom"]=date("Y/m/d", strtotime("first day of next week"));

				$this->vars["fromDate"]=date("m/d/Y",strtotime($fromDate));
				$this->vars["toDate"]=date("m/d/Y",strtotime($toDate));	
											
				$this->view="CAL_WIDGET_LARGE_EVENT_LIST";					
			}	

			else if ($params[5]=="nextMonth") {
	
				$fromDate = date("Y/m/d", strtotime("first day of next month"));
				$toDate = date("Y/m/d", strtotime("last day of next month"));

//				error_log("Next Week: " . $fromDate . " " . $toDate);

				$days = $calendar->getAllDaysByDateRange(1, $fromDate, $toDate);
				$this->vars["calDays"]=$days; 

				$_POST["fromDate"] = $fromDate;
				$_POST["toDate"] = $toDate;
	
				$events = $calendar->getAllEventsByDateRange(1, $fromDate, $toDate, $categoryID, $keywords, $areaID);
				$this->vars["events"]=$events; 

				$this->vars["previousTo"]=date("Y/m/d", strtotime("$toDate - 1 month"));
				$this->vars["previousFrom"]=date("Y/m/d", strtotime("$fromDate - 1 month"));
				$this->vars["nextTo"]=date("Y/m/d", strtotime("$toDate + 1 month"));
				$this->vars["nextFrom"]=date("Y/m/d", strtotime("$fromDate + 1 month"));

				$this->vars["fromDate"]=date("m/d/Y",strtotime($fromDate));
				$this->vars["toDate"]=date("m/d/Y",strtotime($toDate));	
											
				$this->view="CAL_WIDGET_LARGE_EVENT_LIST";					
			}	

			else if ($params[5]=="thisMonth") {
	
				$fromDate = date("Y/m/d", strtotime("first day of this month"));
				$toDate = date("Y/m/d", strtotime("last day of this month"));

				$days = $calendar->getAllDaysByDateRange(1, $fromDate, $toDate);
				$this->vars["calDays"]=$days; 
				
//				error_log("Next Week: " . $fromDate . " " . $toDate);

				$_POST["fromDate"] = $fromDate;
				$_POST["toDate"] = $toDate;

				$this->vars["previousTo"]=date("Y/m/d", strtotime("last day of last month"));
				$this->vars["previousFrom"]=date("Y/m/d", strtotime("first day of last month"));
				$this->vars["nextTo"]=date("Y/m/d", strtotime("last day of next month"));
				$this->vars["nextFrom"]=date("Y/m/d", strtotime("first day of next month"));
	
				$events = $calendar->getAllEventsByDateRange(1, $fromDate, $toDate, $categoryID, $keywords, $areaID);
				$this->vars["events"]=$events; 

				$this->vars["fromDate"]=date("m/d/Y",strtotime($fromDate));
				$this->vars["toDate"]=date("m/d/Y",strtotime($toDate));	
							
				$this->view="CAL_WIDGET_LARGE_EVENT_LIST";					
			}
			else {
				$this->vars["previousTo"]=date("Y/m/d", strtotime("yesterday"));
				$this->vars["previousFrom"]=date("Y/m/d", strtotime("yesterday"));
				$this->vars["nextTo"]=date("Y/m/d", strtotime("tomorrow"));
				$this->vars["nextFrom"]=date("Y/m/d", strtotime("tomorrow"));
				$events = $calendar->getAllEventsByDateRange(1, $fromDate, $toDate, $categoryID, $keywords, $areaID);
				$this->vars["events"]=$events; 
				$this->view="CAL_LARGE_BODY";				
			}
		}
		
		else if ($params[4]=="event") {
			if ($params[5]=="add") {
				$this->view="CAL_LARGE_ADDEVENT_BODY";					
			}
			else if ($params[5]=="details") {
					error_log("Show Event ID: " . $params[6]);
					$this->vars["eventID"] = $params[6]; 
					$this->vars["event"] = 	$calendar->getEventByID($params[6]);	
					$this->vars["address"] = urlencode($this->vars["event"]["zAddress"] . " " . $this->vars["event"]["sCity"] . "," . $this->vars["event"]["sState"] . "  " .$this->vars["event"]["zipcode"]);
					$this->vars["bGeocoded"] = $this->vars["event"]["bGeocoded"];
					$this->vars["sLat"] = $this->vars["event"]["sLat"];
					$this->vars["sLon"] = $this->vars["event"]["sLon"];
					$this->view="CAL_LARGE_DETAILS_BODY";					
			}
		}
		else if ($params[4]=="addEvent") {
			$this->view="CAL_LARGE_ADDEVENT_BODY";					
		}
		else if ($params[4]=="nextWeek") {

			$fromDate = date("Y/m/d", strtotime("next Monday"));
			$toDate = date("Y/m/d", strtotime("next Monday +7 days"));

			error_log("Next Week: " . $fromDate . " " . $toDate);

			$_POST["fromDate"] = $fromDate;
			$_POST["toDate"] = $toDate;			
			
			$events = $calendar->getAllEventsByDateRange(1, $fromDate, $toDate, $categoryID, $keywords, $areaID);

#			$this->vars["calDays"]=$days; 		
			$this->vars["events"]=$events; 
		
			$this->view="CAL_WIDGET_LARGE_EVENT_LIST";					
		}
		else {
			$events = $calendar->getAllEventsByDateRange(1, $fromDate, $toDate, $categoryID, $keywords, $areaID);
			$this->vars["events"]=$events; 
			$this->view="CAL_LARGE_BODY";					
		}
		
		return true;		  
		  
	}

	public function search2($params) {

		$calendar = new \CAL\calendar($this->db);

		$events = $calendar->getSponsoredEventsByDateRange(1, "2013-09-30", "2013-10-04");

		$this->vars["events"]=$events; 		

		$this->view="CAL_SEARCH_NEW";
		
		return true;		  
		  
	}

	public function manage($params) {

	  if ($this->auth->validate($this->userID)) {
		
		$this->view="CAL_MANAGE";
		$this->vars["navManageActive"]=true;

		$calendar = new \CAL\calendar($this->db);

		$events = $calendar->getAllEventsByCalendarID(1, date('Y-m-d',strtotime('now')));

		$this->vars["events"]=$events; 
		
		return true;
	  }
	  
	  else {

		$this->view="CAL_LOGIN";
		$this->vars["navHomeActive"]=false;
		
		return true;		  
		  
	  }

	}


	public function support($params) {

	  if ($this->auth->validate($this->userID)) {
		
		$this->view="CAL_HOME";
		$this->vars["navSupportActive"]=true;
		
		return true;
	  }
	  
	  else {

		$this->view="CAL_LOGIN";
		$this->vars["navHomeActive"]=false;
		
		return true;		  
		  
	  }

	}

	public function share($params) {

	  if ($this->auth->validate($this->userID)) {
		
		$this->view="CAL_SHARE";
		$this->vars["navShareActive"]=true;
		
		return true;
	  }
	  
	  else {

		$this->view="CAL_LOGIN";
		$this->vars["navShareActive"]=false;
		
		return true;		  
		  
	  }

	}


	public function home($params) {

	  if ($this->auth->validate($this->userID)) {
		
		$this->view="CAL_HOME";
		$this->vars["navHomeActive"]=true;
		
		$this->vars["events"] = $this->calendar->getAllEventsByAuthor("1", $_SESSION["userID"]);
		$this->vars["chartLeft"] = $this->calendar->getEventsComingUp(1);
		$this->vars["chartRight"] = $this->calendar->getRecentEvents(1);

		return true;
	  }
	  
	  else {

		$this->view="CAL_LOGIN";
		$this->vars["navHomeActive"]=false;
		
		return true;		  
		  
	  }
	}


	public function login($params) {

	  if ($this->auth->validate($this->userID)) {
		
		$this->view="CAL_HOME";
		$this->vars["navHomeActive"]=true;
		
		return $this->home($params);
	  }
	  
	  else {
	  
	  	error_log("Logging Calendar User In... " . $_POST["username"]);

		if (($_POST["username"] != "") and ($_POST["password"] != "")) {
			if ($this->auth->login($_POST["username"], $_POST["password"])) {

				$this->view="CAL_HOME";
				$this->vars["navHomeActive"]=true;
				return true;
			}
			else {
				$this->view="CAL_LOGIN";
				$this->vars["alertError"]=true;
				return true;
			}
		}
		$this->view="CAL_LOGIN";
		$this->vars["navHomeActive"]=false;
		
		return true;		  
		  
	  }
	}	

	public function verify($params) {
		
		  $privatekey = "6LeEtusSAAAAAKqDZmCMQ0-aVWL_F2SqA4jo-xGD";
		  $resp = recaptcha_check_answer ($privatekey,
		                                  $_SERVER["REMOTE_ADDR"],
		                                  $_POST["recaptcha_challenge_field"],
		                                  $_POST["recaptcha_response_field"]);
		
		  if (!$resp->is_valid) {
		  	  $this->vars["response"] = $resp;
			  $this->view="CAL_CAPTCHA_ERRROR";

		  } else {
		  	  $this->vars["response"] = $resp;
	  		  $this->view="CAL_CAPTCHA_SUCCESS";

		  }
		  
		  return true;
		  
	}


	public function logout($params) {

		$this->auth->logout();
			
		$this->view="CAL_LOGIN";
		$this->vars["navHomeActive"]=false;
		
		return true;		  
		  
	}	
	
	public function lookup($params) {
	  if ($this->auth->validate($this->userID)) {
//	    $this->vars["username"] = "@" . $this->auth->getShortName($this->userID);

	    $access["payments"] = $this->auth->getAccessByUserID($_SESSION["userID"],"Payments");
		$access["player"] = $this->auth->getAccessByUserID($_SESSION["userID"],"Player");	
		$access["confcode"] = $this->auth->getAccessByUserID($_SESSION["userID"],"Conf Code");	
						
		if ($access["payments"][0]["create"]) {
			$this->vars["acceptPayments"]=true;
		}

		if ($access["confcode"][0]["view"]) {
			$this->vars["confCode"]=true;
		}
		else {
			$this->vars["confCode"]=false;			
		}
		
		if ($access["player"][0]["delete"]) {
			$this->vars["deletePlayer"]=true;
		}
		else {
			$this->vars["deletePlayer"]=false;
		}
		if ($this->registration->isPlayerActive($params[2])) {
			$this->vars["playerIsActive"]=true;
		}
		else {
			$this->vars["playerIsActive"]=false;			
		}

		$player = $this->registration->getPlayer($params[2]);
		$payments = $this->registration->getPaymentHistory($params[2]);
		$invoices = $this->registration->getInvoicesByPlayer($params[2]);
		$parents = $this->registration->getParents();
		$sport = $this->registration->getSport($player["id"]);
		$sports =  $this->registration->getSports();
		$divisions =  $this->registration->getDivisions($sport["sportID"],$player["childID"]);
		$team = $this->registration->getTeam($player["teamID"]);
		
		
		
		$this->vars["parents"] = array();
		foreach ($parents as $parent) {
			array_push($this->vars["parents"], $this->registration->getParent($parent));
			

		}
		
//		error_log("Player: " . print_r($player));
		
		$this->vars["player"] = $player;
		$this->vars["payments"] = $payments;
		$this->vars["invoices"] = $invoices;
		$this->vars["sport"] = $sport;
		$this->vars["team"] = $team;
		$this->vars["sports"] = $sports;
		$this->vars["divisions"] = $divisions;
		$this->vars["userID"] = $_SESSION["userID"];
	
		$this->vars["playersActive"] = "class=active";
		
		$this->view = "player";
				
		$this->vars["editPlayer"] = $access["player"][0];
		
		return true;
	  }
	  else {
		  return false;
	  }
	}


	public function pay($params) {
	  if ($this->auth->validate($this->userID)) {

		  $access["payments"] = $this->auth->getAccessByUserID($_SESSION["userID"],"Payments");
		
			  if (($this->auth->validate($this->userID)) and ($access["payments"][0]["create"])) {

				  if ($_POST["action"]=="Save") {
				  		$this->registration->paymentByPlayer($_POST["source"], $_POST["invoice"], $_POST["refnum"], $_POST["amount"], 0, $this->userID);
				  		
				  		$this->view = "";
				  		$this->transfer = "/portal/player/lookup/" . $params[2];
				  		return true;
					  
				  }

				  else if ($_POST["action"]=="Cancel") {
				  		
				  		$this->view = "";
				  		$this->transfer = "/portal/player/lookup/" . $params[2];
				  		return true;
					  
				  }
				  
				  else {
				  
			
				    $this->vars["username"] = "@" . $this->auth->getShortName($this->userID);
							
					$player = $this->registration->getPlayer($params[2]);
					$payments = $this->registration->getPaymentHistory($params[2]);
					$invoices = $this->registration->getInvoicesByPlayer($params[2]);
					$openInvoices = $this->registration->getOpenInvoicesByPlayer($params[2]);
					$parents = $this->registration->getParents();
					$sport = $this->registration->getSport($player["id"]);
					$sports =  $this->registration->getSports();
					$divisions =  $this->registration->getDivisions($sport["sportID"],$player["childID"]);
					$team = $this->registration->getTeam($player["teamID"]);
							
					$invoiceNames = array();
					$invoiceIDs = array();
					


					foreach ($openInvoices as $invoice) {
						array_push($invoiceNames, $invoice["id"] . " - " . $invoice["title"] . " (" . $invoice["balance"] .")");
						array_push($invoiceIDs, $invoice["id"]);
					}
						
					if (count($invoiceIDs)<1) {
						$this->vars["acceptPaymentError"] = "There are no open invoices to pay at this time.";
					}

					$this->vars["parents"] = array();
					foreach ($parents as $parent) {
						array_push($this->vars["parents"], $this->registration->getParent($parent));
			
					}
					
			//		error_log("Player: " . print_r($player));
					
					$this->vars["player"] = $player;
					$this->vars["payments"] = $payments;
					$this->vars["invoices"] = $invoices;
					$this->vars["invoiceIDs"] = $invoiceIDs;
					$this->vars["invoiceNames"] = $invoiceNames;
					$this->vars["sport"] = $sport;
					$this->vars["team"] = $team;
					$this->vars["sports"] = $sports;
					$this->vars["divisions"] = $divisions;
					$this->vars["userID"] = $_SESSION["userID"];
				
					$this->vars["playersActive"] = "class=active";
					
					$this->view = "player-payment";
					
					$access["player"] = $this->auth->getAccessByUserID($_SESSION["userID"],"Player");
					
//					$this->vars["editPlayer"] = $access["editPlayer"][0];
					$this->vars["editPlayer"] = false;
					
					return true;
				}
			}
	  }
	  else {
		  return false;
	  }
	}
	
	public function forgot($params) {

	  if ($this->auth->validate($this->userID)) {

		return $this->home($params);
		  
	  }
	  
	  else {
	  
/*	  	error_log("Logging Calendar User In... " . $_POST["username"]);

		if (($_POST["username"] != "") and ($_POST["password"] != "")) {
			if ($this->auth->login($_POST["username"], $_POST["password"])) {

				return $this->home($params);

			}
			else {
				$this->view="CAL_LOGIN";
				$this->vars["alertError"]=true;
				return true;
			}
		}
*/

	    require_once('/var/www/html/lib/recaptchalib.php');
	    $publickey = "6Lc6tecSAAAAALevgROIwALgd4yT01iTrEDfqEuy"; 
	    $this->vars["captcha"] = recaptcha_get_html($publickey);

		$this->view="CAL_FORGOT";
		$this->vars["navHomeActive"]=false;
		
		return true;		  
		  
	  }
	}	


	public function signup($params) {

	  if ($this->auth->validate($this->userID)) {

		return $this->home($params);
		  
	  }
	  
	  else {
	  

	  	error_log("Signing up new user... " . $_POST["username"]);

	  	$users = new \users($this->db);

		if (($_POST["emailAddress"] != "") and ($_POST["firstName"] != "") and ($_POST["lastName"] != "")) {

			$this->auth->logout();

			if ($users->activate($_POST["emailAddress"])) {
				
				return $this->home($params);

			}
			else {
			
				$users->signup($_POST["emailAddress"], $_POST["firstName"], $_POST["lastName"]);
				$this->view="CAL_SIGNUP";
				$this->vars["alertSuccess"]=true;
				$this->vars["successMsg"]="Thank You! Your request is being reviewed.";
				$this->vars["signUpHide"]="hide";
				
				return true;
			}
		}
		
		else {

				$this->vars["alertInfo"]=true;
				$this->vars["errorMsg"]="Error! Please answer each field.";
							
		}

		$this->view="CAL_SIGNUP";
		$this->vars["navHomeActive"]=false;
		
		return true;		  
		  
	  }
	}	

	public function activate($params) {

	  if ($this->auth->validate($this->userID)) {

		return $this->home($params);
		  
	  }
	  
	  else {
	  
	  	error_log("Activating new user... " . $_POST["emailAddress"]);

	  	$users = new \users($this->db);

		if ($_POST["emailAddress"] != "") {
			$this->auth->logout();
			
			$username = $users->activate($_POST["emailAddress"], $_POST["password"]);
			if ($username) {

				$_POST["username"] = $username;

				error_log("User Activated.  Logging In Automatically...");

				return $this->login($params);
	
				return true;
			}
			else {
				$this->view="CAL_ACTIVATE";
				$this->vars["alertError"]=true;
				$this->vars["errorMsg"]="An error occurred. Please Try Again.";
				if (($_POST["emailAddress"] != "") and (strlen($_POST["password"]) < 6)) {
					$this->vars["email"] = $_POST["emailAddress"];
					$this->vars["errorMsg"]="Your password is too short.";				
				}
				$this->vars["emailAddress"]=$emailAddress;
				
				return true;
			}
		}

		$this->view="CAL_ACTIVATE";
		$this->vars["navHomeActive"]=false;
		$this->vars["emailAddress"]=$_POST["emailAddress"];
		
		return true;		  
		  
	  }
	}		

	public function data() {
		
		return $this->vars;
	}


	public function view() {
		
		return $this->view;
	}
	
	public function transfer() {
		
		return $this->transfer;
	}

}
?>
