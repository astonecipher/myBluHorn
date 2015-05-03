<?php

/**
 * FILELOGIX CALENDAR CLASS
 *  
 * @author Wes Benwick
 * @link http://www.filelogix.com
 * @license Part of Filelogix usage license
 */ 
  
namespace CAL;

class calendar
{  
    // Will store database connection here
	private $db;
	private $sessionID;

	
	public function __construct($db) {
	  $this->db = $db;
	  $this->sessionID = session_id();
		
	}

	public function getCalendars() {
	  
	  $r=$this->db->query("select * from CAL_MASTER where bActive is TRUE");
      $results=$r->fetchAll();

	  error_log($this->db->lastQuery());
		
	  return $results;

		
	}	

	public function getAllEvents() {
	  
	  $r=$this->db->query("select * from CAL_EVENT where bActive is TRUE");
      $results=$r->fetchAll();

	  error_log($this->db->lastQuery());
		
	  return $results;

		
	}	
	
	public function createEvent($calendarID, $title, $description, $details, $categoryID, $startStamp, $endStamp, $locationID, $eventLink, $isRecurring, $areaID) {
		
		$params = array();

		$userID = $_SESSION["userID"];

		$eventsID = $this->db->insert("CAL_EVENTS", array("kCalendarID"=>"1", "bRepeat"=>$isRecurring, "sName"=>$title, "kAuthorID"=>$userID));
		
		$params["kCalendarID"] = 1;
		
		$params["sTitle"] = $title; 
		$params["sDescription"] = $description;
		$params["sDetails"] = $details;
		$params["kCategoryID"] = $categoryID; 
		$params["kAreaID"] = $areaID; 
		$params["tStart"] = $startStamp;
		$params["tEnd"] = $endStamp; 
		$params["kLocationID"] = $locationID; 
		$params["sURL"] = $eventLink; 
		$params["kEventID"] = $eventsID; 
		
		
		$eventID = $this->db->insert("CAL_EVENT", $params);

//		error_log("Create Event: " . $this->db->lastQuery());
			
		return $eventID;
	}

	public function newEvent($calendarID, $isRecurring, $title, $authorID, $params = array(), $repeat = array()) {
		

		$eventsID = $this->db->insert("CAL_EVENTS", array("kCalendarID"=>$calendarID, "bRepeat"=>$isRecurring, "sName"=>$title, "sTitle"=>$title, "kAuthorID"=>$authorID, "zKeywords"=>$params["keywords"]));	

		$daysOfWeek = array('Sun'=>"1", 'Mon'=>"2", 'Tue'=>"3", 'Wed'=>"4", 'Thu'=>"5", 'Fri'=>"6", 'Sat'=>"7");

		$params["kEventID"] = $eventsID; 
		$params["kParentID"] = $eventsID; 
		
		$eventID = $this->db->insert("CAL_EVENT", $params);

//		error_log("Create Event: " . $this->db->lastQuery());

		if ($isRecurring) {
				
				$maxDate = "2016-01-01";
				$repeatWeekly = "";
				$repeatWeekDays = "0";
				$repeatMonthDays = array();
				$repeatMonthly = "";
				$repeatAnnually = "";
				$repeatStart = $repeat["startDate"];					
				$repeatEnd = $repeat["endDate"];
				
				$days=0;
					
				
				if($repeat["weekDays"]) {	
					if (is_array($repeat["weekDays"])) {
						foreach ($repeat["weekDays"] as $day) {
							if (is_numeric($day)) {
								$days += $day;
							}
							else {
								$day += $daysOfWeek[$day];
							}
						}
					}
					else {
						if (is_numeric($repeat["weekDays"])) {
							$days += $repeat["weekDays"];	
						}
						else {
							$days = $daysOfWeek[$repeat["weekDays"]];
						}
					}
					$repeatWeekDays = strval($days);
				}
				else {
					$repeatWeekDays = "0";
				}

				if($repeat["monthDays"]) {	
					if (is_array($repeat["monthDays"])) {
						foreach ($repeat["monthDays"] as $day) {
							if (is_numeric($day)) {
								array_push($repeatMonthDays, $day);
							}
							else {
								array_push($repeatMonthDays, $day);
							}
						}
					}
					else {
						array_push($repeatMonthDays, $repeat["monthDays"]);
					}
				}
								
				if(($repeat["frequency"] == "Daily") or ($repeat["frequency"] == "Every Day")) {
					$repeatWeekly="1";
				}
				else if($repeat["frequency"] == "Every Week") {
					$repeatWeekly="1";
				}
				else if($repeat["frequency"] == "Every Other Week") {
					$repeatWeekly="2";					
				}			
				else if($repeat["frequency"] == "Every Third Week") {
					$repeatWeekly="3";					
				}
				else if($repeat["frequency"] == "Every Fourth Week") {
					$repeatWeekly="4";					
				}				
				else if($repeat["frequency"] == "Every Month") {
					$repeatMonthly="1";					
				}
				else if($repeat["frequency"] == "Every Other Month") {
					$repeatMonthly="2";					
				}
				else if(($repeat["frequency"] == "Every Third Month") or ($repeat["frequency"] == "Quarterly")) {
					$repeatMonthly="3";					
				}
				else if($repeat["frequency"] == "Every Fourth Month") {
					$repeatMonthly="4";					
				}
				else if(($repeat["frequency"] == "Semi-Annually") or ($repeat["frequency"] == "Twice Per Year")) {
					$repeatMonthly="6";					
				}
				else if($repeat["frequency"] == "Annually") {
					$repeatMonthly="12";					
				}
								
				$repeatParams = array();
				
				$repeatParams["kEventID"] = $eventID;
				$repeatParams["kTemplateID"] = $eventsID;
				$repeatParams["bActive"] = TRUE;
				$repeatParams["dStartDate"] = date('Y-m-d', strtotime($params["tStart"]));
				$repeatParams["dEndDate"] = date('Y-m-d', strtotime($params["tEnd"]));;
				$repeatParams["eFrequency"] = $repeat["frequency"];
				$repeatParams["iWeekly"] = $repeatWeekly;
				$repeatParams["iMonthly"] = $repeatMonthly;
				$repeatParams["iAnnually"] = $repeatAnnually;
				$repeatParams["iWeekDays"] = $repeatWeekDays;
				$repeatParams["iMonthDays"] = serialize($repeatMonthDays);
								
				$this->db->insert("CAL_REPEAT", $repeatParams);
	
				error_log("RepeatWeekDays: $repeatWeekDays");
				
				$repeatingDates = $this->repeatingDates($repeatWeekDays, $repeatWeekly, $repeatMonthDays, $repeatMonthly, $repeatAnnually, $repeatStart, $repeatEnd);

				$parentStart = $params["tStart"];
				$parentEnd = $params["tEnd"];
	
				foreach ($repeatingDates as $repeatingDate) {

						$params["kParentID"] = $eventsID;
						$params["bRepeating"] = TRUE;

						if ($params["fDuration"]>0) { // if we know duration, we can take repeating date and solve for repeat ending date stamp					
	
							$parentDuration = $params["fDuration"];
	
							list($repeatHour,$repeatMinute) = explode(".", $parentDuration,2);
	
							$repeatDurationStr = "+" . $repeatHour . " hours " . "+" . $repeatMinute . " minutes";
			
							$parentTimeStart = date('H:i:s', strtotime($parentStart));
	
							$params["tStart"] = $repeatingDate . " " . $parentTimeStart;
	
							$params["tEnd"] = date('Y-m-d H:i:s', strtotime($repeatDurationStr, strtotime($params["tStart"])));
						}
						else { // if we don't know duration, we have to look at previous event difference between start and end time stamps

							$parentTimeStart = date('H:i:s', strtotime($parentStart));
							$parentTimeDiff = strtotime($parentEnd) - strtotime($parentStart);

							$params["tStart"] = $repeatingDate . " " . $parentTimeStart;
							
							$params["tEnd"] = date('Y-m-d H:i:s', strtotime($params["tStart"]) + $parentTimeDiff);

						}
						
						// check excluded dates
											
						if ((!in_array($repeatingDate, $repeat["excludeDates"])) and (!in_array($daysOfWeek[date('D',strtotime($repeatingDate))], $repeat["excludeDays"]))){
								$repeatingEventID = $this->db->insert("CAL_EVENT", $params);
						}
						error_log("Repeating Event: ($repeatingEventID) for $repeatingDate");

				}
		}
			
		return $eventID;
	}

	public function repeatingDates($weekDays, $weekly, $monthDays, $monthly, $annually, $startDate, $endDate) { // weekly determines how many weeks to skip, could be 1 - 52(annually), $annually is actually how many times per year, and is a 12 bit string indicating months the event repeats in and monthly is like weekly, 1 is every month, 2 is every other, 3 is once per quarter, 6 would be twice per year, 12 would be annually, 24 would be biannually

		
		$datesArray = array();
		$weekDaysArray = array();
		$monthsArray = array();
		
		$currentDay = date("d",strtotime($startDate));;
		$currentWeek = date("w",strtotime($startDate));;
		$currentYear = date("Y",strtotime($startDate));;
		$currentMonth = date("m",strtotime($startDate));;
		$currentDate = $startDate;

		$daysOfWeek = array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat');

		$maxDate = "2016-01-01";
		
		if ($endDate == "0000-00-00") {
			$stopDate = $maxDate;
		}
		else {
			if(checkdate(date('m',strtotime($endDate)), date('d',strtotime($endDate)),date('Y',strtotime($endDate)))) {
				$stopDate = $endDate;
			}
			else {
				$stopDate = $maxDate;
			}
		}
		
		if ($weekDays>7) { // if weekdays is greater than 7, this would indicate it is actually more than one day per week and needs to be converted to binary and mapped into an array of dates
			error_log("Week Days (if): $weekDays");
			$daysArray = str_split(str_pad(strrev(decbin($weekDays)),7, "0", STR_PAD_RIGHT),1);

			error_log("Days Array: From(" . decbin($weekDays) . ") to " . $daysArray);
			
			$daysCounter = 1; // This will increment from 1 to 7
			foreach ($daysArray as $day) {
				error_log("Days Array: " . $daysOfWeek[$daysCounter-1]);
				if ($day) {
					array_push($weekDaysArray, $daysCounter);					
					error_log("Week Days Array: $weekDays");
				}
				$daysCounter++;
			}
		}
		
		else { // weekDaysArray will just contain a single day number
			array_push($weekDaysArray, $weekDays);
			error_log("Week Days Array: $weekDays");
		}

		
		if ($annually>0) { // if it is greater than 0, it means that there are repeating months, but it isn't necessarily every other, it may only be specific months of the year represented as a 12 bit array, similar to weekDays
			$months = str_split(str_pad(strrev(decbin($annually)),12, "0", STR_PAD_LEFT),1);
			
			error_log("Months Array: " . str_pad(strrev(decbin($annually)),12, "0", STR_PAD_LEFT));

			$monthsCounter = 1; // This will increment from 1 to 12

			foreach ($months as $month) {
				if ($month) {
					error_log("Adding Annual Month: $monthsCounter");
					array_push($monthsArray, $monthsCounter);					
				}
				$monthsCounter++;
			}

		}
		
		// There could be values of weekly, monthly and annually.  All could exist, although unlikely.  A "0" or null value would indicate it is skipped.  As an example, an event could repeat every other week, as well as on the first of every month
		
		// The order will be weekly, then monthly, then annually

		if ($weekly > 0) { // 1 would be every week, 2 would be every other week...
			
//			$currentDate = date('Y-m-d', strtotime("+" . $weekly . " weeks",strtotime($currentDate))); // This will handle the month increments and will end once the maxDate is reached.

			while (strtotime($currentDate) <= min(strtotime($maxDate),strtotime($stopDate))) {

				error_log("Weekly: " . $currentDate . " " . strtotime($currentDate) . " <= " . strtotime($maxDate) . " or " . strtotime($endDate));

				$currentDay = date("d",strtotime($startDate));
				$currentWeek = date("w",strtotime($startDate));
				$currentYear = date("Y",strtotime($startDate));
				$currentMonth = date("m",strtotime($startDate));
						
				
			    foreach ($weekDaysArray as $weekDay) { // Need to handle ordering here depending on start date
					if ($weekDay) { // just checking this to be sure there wasn't an array of weekdays and 0 was one of them.
						$nextDate = date('Y-m-d', strtotime("next " . $daysOfWeek[$weekDay-1],strtotime($currentDate)));  // Subtracting 1 from weekDay due to array numbering 0 is Sunday, 6 is Saturday, monthDay could be first, second, third, fourth, or last

						if(!in_array($nextDate, $datesArray, true)) {
							if (strtotime($nextDate) <= min(strtotime($maxDate),strtotime($stopDate))) {
								error_log("Adding Weekly Date Array: " . $nextDate . " " . "is next " . $daysOfWeek[$weekDay-1] );
    							array_push($datesArray, $nextDate);							
							}
						}
					}
					else {
							// shouldn't ever happen
					}								
				}

				$currentDate = date('Y-m-d', strtotime("+" . $weekly . " weeks",strtotime($currentDate))); // This will handle the month increments and will end once the maxDate is reached.

			}


		}
		
		$currentDate = $startDate;  // reset current date for monthly logic
		
		if ($monthly > 0) { // 1 would be every month, 2 would be every other month...
		
			$currentDate = date('Y-m-d', strtotime("+" . $monthly . " months",strtotime($currentDate))); // This will handle the month increments and will end once the maxDate is reached.
			
			$loopCounter = 0;
			
			while ((strtotime($currentDate) <= min(strtotime($maxDate),strtotime($stopDate))) and (date("Y",strtotime($currentDate) > strtotime("now")))) {

				$loopCounter++;

				error_log("Current Monthly $loopCounter: " . $currentDate);

				$currentDay = date("d",strtotime($currentDate));
				$currentWeek = date("w",strtotime($currentDate));
				$currentYear = date("Y",strtotime($currentDate));
				$currentMonth = date("m",strtotime($currentDate));
				
				if (($weekDays == 0) or ($weekDays == "")) {  // This indicates that the event occurs on specific days of a month, rather than specific week days

					error_log("Week Days Monthly: " . $weekDays);
					
					foreach ($monthDays as $monthDay) {
	
						error_log("Monthly: " . $monthDay);

						if ((intval($monthDay)>=1) and (intval($monthDay)<=31)) { // This indicates it is a number 1 - 31 	 
		
							error_log("Current Date By Day of Monthly $loopCounter: $currentDate $currentYear-$currentMonth-$monthDay");	

							if (checkdate($currentMonth, $monthDay, $currentYear))	{ // Checks to be sure date is valid before including- specifically applies to the last days of months, 30,31 or in February's case, 28, unless leap year, 29.

								$currentDate = $currentYear . "-" . $currentMonth . "-" . str_pad($monthDay, 2, "0", STR_PAD_LEFT); 

								if(!in_array($currentDate, $datesArray, true)) {
									if (strtotime($currentDate) <= min(strtotime($maxDate),strtotime($stopDate))) {
										error_log("Adding Monthly Date Array: " . $currentDate );
	    								array_push($datesArray, $currentDate);							
									}
								}
							}
							else {
								// do nothing- day of week requested isn't valid - optionally, we could automatically turn this into the last day of the month as that is likely what the user intended
							}	
	
						}
						else {  // This indicates its a logical expression, first or last are the only expected values currently
							if (($monthDay == "first") or ($monthDay == "last")) {
								$monthName = date("F", mktime(0, 0, 0, $currentMonth, 10));
								
								error_log("Current Date of Monthly $loopCounter: $currentDate - $monthDay day of this $monthName");	

								$currentDate = date('Y-m-d', strtotime("$monthDay day of this month",strtotime($currentDate)));
																		
								error_log("Current Date of Monthly $loopCounter: $currentDate - $monthDay day of this $monthName");	

																		
								if(!in_array($currentDate, $datesArray, true)) {
									if (strtotime($currentDate) <= min(strtotime($maxDate),strtotime($stopDate))) {
										error_log("Adding Monthly Date Array: " . $currentDate );
										array_push($datesArray, $currentDate);
									}
								}
							}
							
							else {
								// ignoring anything other than first or last because it would not work
							}
						}
					}
					
				}
				
				else { // This indicates that the event occurs on specific, repeating days of the week
					
					foreach ($monthDays as $monthDay) {
						foreach ($weekDaysArray as $weekDay) { // Need to handle ordering here depending on start date
							if ($weekDay>0) { // just checking this to be sure there wasn't an array of weekdays and 0 wasnt one of them.
								if ($daysOfWeek[$weekDay-1] == "") {
									$currentDate = date('Y-m-d', strtotime("$monthDay " . " day " . " of $monthName",strtotime($currentDate)));  // Subtracting 1 from weekDay due to array numbering 0 is Sunday, 6 is Saturday, monthDay could be first, second, third, fourth, or last									
								}
								else {
									$currentDate = date('Y-m-d', strtotime("$monthDay " . $daysOfWeek[$weekDay-1] . " of $monthName",strtotime($currentDate)));  // Subtracting 1 from weekDay due to array numbering 0 is Sunday, 6 is Saturday, monthDay could be first, second, third, fourth, or last
								}
								if(!in_array($currentDate, $datesArray, true)) {
									if (strtotime($currentDate) <= min(strtotime($maxDate),strtotime($stopDate))) {
										error_log("Adding Monthly Date Array: " . $currentDate );
										array_push($datesArray, $currentDate);
									}
								}
							}
							else {
								// shouldn't ever happen
							}
						}
					}
				}

				error_log("Monthly: " . "+" . $monthly . " months " . (strtotime($currentDate)));
				
				$currentDate = date('Y-m-d', strtotime("first day of +" . $monthly . " months",strtotime($currentDate))); // This will handle the month increments and will end once the maxDate is reached.

			}
		}
		
		$currentDate = $startDate;  // reset current date for annual logic	
		
		if ($annually > 0) { // could be a number from 1 to 4096.  1 actually indicates December because it is the last month in a 12 bit array of 0's and 1's.  Like weekDays it needs to be converted to an array.  Hints: 1365 would be every even month, 2730 would be every odd month

// need to determine next month after starting month in order to start this loop

			$currentDate = date('Y-m-d', strtotime("first day of next month",strtotime($currentDate))); // This will handle the month increments and will end once the maxDate is reached.

			while ((strtotime($currentDate) <= min(strtotime($maxDate),strtotime($stopDate))) and (date("Y",strtotime($currentDate) > strtotime("now")))) {

				error_log("Annually: " . $currentDate . " " . $months);
	
				$currentDay = date("d",strtotime($currentDate));
				$currentWeek = date("w",strtotime($currentDate));
				$currentYear = date("Y",strtotime($currentDate));
				$currentMonth = date("m",strtotime($currentDate));
			
				foreach ($monthsArray as $month) {
					
					$currentMonth = str_pad($month, 2, "0", STR_PAD_LEFT);

					error_log("Annually: Month: " . $currentMonth);
					
					if ($weekDays == 0) {  // This indicates that the event occurs on specific days of a month, rather than specific week days
	
						error_log("Week Days Annually: " . $weekDays);
						
						foreach ($monthDays as $monthDay) {
		
							error_log("Annually: " . $monthDay);
	
							if ((intval($monthDay)>=1) and (intval($monthDay)<=31)) { // This indicates it is a number 1 - 31 	 
			
								error_log("Current Date By Day of Annually: $loopCounter: $currentDate $currentYear-$currentMonth-$monthDay");	
	
								if (checkdate($currentMonth, $monthDay, $currentYear))	{ // Checks to be sure date is valid before including- specifically applies to the last days of months, 30,31 or in February's case, 28, unless leap year, 29.
	
									$currentDate = $currentYear . "-" . $currentMonth . "-" . str_pad($monthDay, 2, "0", STR_PAD_LEFT); 
	
									if(!in_array($currentDate, $datesArray, true)) {
										if (strtotime($currentDate) <= min(strtotime($maxDate),strtotime($stopDate))) {
											error_log("Adding Monthly Date Array: " . $currentDate );
		    								array_push($datesArray, $currentDate);							
										}
									}
								}
								else {
									// do nothing- day of week requested isn't valid - optionally, we could automatically turn this into the last day of the month as that is likely what the user intended
								}	
		
							}
							else {  // This indicates its a logical expression, first or last are the only expected values currently
								if (($monthDay == "first") or ($monthDay == "last")) {
									$monthName = date("F", mktime(0, 0, 0, $currentMonth, 10));
									
									error_log("Current Date of Annually: Monthly: $loopCounter: $currentDate - $monthName");	
	
									$currentDate = date('Y-m-d', strtotime("$monthDay day of this month",strtotime($currentDate)));
										
									error_log("Current Date of Annually: Monthly $loopCounter: $currentDate - $monthDay of $monthName");	
										
									if(!in_array($currentDate, $datesArray, true)) {
										if (strtotime($currentDate) <= min(strtotime($maxDate),strtotime($stopDate))) {
											error_log("Adding Monthly Date Array: " . $currentDate );
											array_push($datesArray, $currentDate);
										}
									}
								}
								
								else {
									// ignoring anything other than first or last because it would not work
								}
							}
						}
						
					}
					
					else { // This indicates that the event occurs on specific, repeating days of the week
						
						foreach ($monthDays as $monthDay) {
							foreach ($weekDaysArray as $weekDay) { // Need to handle ordering here depending on start date
								if ($weekDay>0) { // just checking this to be sure there wasn't an array of weekdays and 0 wasnt one of them.
									$monthName = date("F", mktime(0, 0, 0, $currentMonth, 10));
									if ($daysOfWeek[$weekDay-1] == "") {
										$currentDate = date('Y-m-d', strtotime("$monthDay " . " day " . " of $monthName",strtotime($currentDate)));  // Subtracting 1 from weekDay due to array numbering 0 is Sunday, 6 is Saturday, monthDay could be first, second, third, fourth, or last
									}
									else {			
										$currentDate = date('Y-m-d', strtotime("$monthDay " . $daysOfWeek[$weekDay-1] . " of $monthName",strtotime($currentDate)));  // Subtracting 1 from weekDay due to array numbering 0 is Sunday, 6 is Saturday, monthDay could be first, second, third, fourth, or last
									}
									if(!in_array($currentDate, $datesArray, true)) {
										if (strtotime($currentDate) <= min(strtotime($maxDate),strtotime($stopDate))) {
											error_log("Adding Annually: Monthly Date Array: " . $currentDate );
											array_push($datesArray, $currentDate);
										}
									}
								}
								else {
									// shouldn't ever happen
								}
							}
						}
					}				

				}
				
				$currentDate = date('Y-m-d', strtotime("first day of next year",strtotime($currentDate))); // This will handle the month increments and will end once the maxDate is reached.

			}
		}
		
		error_log("Repeated " . count($datesArray) . " dates.");

		return $datesArray;	
	}

	
	public function getEventIDfromEvent($eventID) {
	  $eventIDStr = $this->db->quote($eventID);
		
	  $r=$this->db->query("select * from CAL_EVENT where id=$eventIDStr");
	  $results=$r->fetch(\PDO::FETCH_ASSOC);

	  error_log($this->db->lastQuery());
		
	  return $results["kEventID"];
		
	}


	public function updateEvent($eventID, $calendarID, $title, $description, $details, $categoryID, $startStamp, $endStamp, $locationID, $eventLink, $isRecurring) {
		
		$params = array();

		$userID = $_SESSION["userID"];

		$eventsID = $this->getEventIDfromEvent($eventID);

		$eventsID = $this->db->update("CAL_EVENTS", "id", $eventsID, array("kCalendarID"=>"1", "bRepeat"=>$isRecurring, "sName"=>$title, "kAuthorID"=>$userID));
		
		$params["kCalendarID"] = 1;
		
		$params["sTitle"] = $title; 
		$params["sDescription"] = $description;
		$params["sDetails"] = $details;
		$params["kCategoryID"] = $categoryID; 
		$params["tStart"] = $startStamp;
		$params["tEnd"] = $endStamp; 
		$params["kLocationID"] = $locationID; 
		$params["sURL"] = $eventLink; 
		$params["kEventID"] = $eventsID; 
		
		
		$eventID = $this->db->update("CAL_EVENT", "id", $eventID, $params);

		error_log("Update Event: " . $this->db->lastQuery());
			
		return $eventID;
	}
		
	public function createLocation($name, $address, $city, $state, $zipcode, $contact, $website, $area, $region, $areaID, $regionID, $lat, $lon) {
		
		// Check to see if location exists by findLocation first
		
		$locationID = $this->findLocation($address, $city, $state, $zipcode);
			
		if ($locationID > 0) {
			
			return $locationID;
			
		}

		if (($lat>0) or ($lon>0)) {

			$locationID = $this->findLocationLatLon($lat, $lon);
			
			if ($locationID > 0) {
			
				return $locationID;
		
			}
		}

		// or create a new one

		$locationID = $this->db->insert("CAL_LOCATION", array("sName"=>$name, "kLocationID"=>"1", "zAddress"=>$address, "sCity"=>$city, "sState"=>$state, "sZipcode"=>$zipcode, "sLat"=>$sLat, "sLon"=>$sLon, "uWebsite"=>$website, "zContact"=>$contact, "sArea"=>$area, "sRegion"=>$region, "kAreaID"=>$areaID, "kRegionID"=>$regionID));

		error_log($this->db->lastQuery());
		
		return $locationID;
		
	}
	
	public function findLocation($address, $city, $state, $zipcode) {

	  $addressStr = $this->db->quote("%" . trim($address) . "%");
	  $cityStr = $this->db->quote("%" . trim($city) . "%");
	  $stateStr = $this->db->quote("%" . trim($state) . "%");
	  $zipcodeStr = $this->db->quote("%" . trim($zipcode) . "%");
		
	  $location=$this->db->query("select * from CAL_LOCATION where zAddress like $addressStr and (sCity like $cityStr or sState like $stateStr or sZipcode like $zipcodeStr)");
	  $results=$location->fetch(\PDO::FETCH_ASSOC);

	  error_log("Location Search: " . $this->db->lastQuery());
		
	  $location = $results["id"];

	  if ($location>0) {
			
		  return $location;
	  }
	  
	  else {
		  return 0;
	  }
		
	}


	
	public function findLocationByLatLon($lat, $lon) {

	  $latStr = $this->db->quote(trim($lat));
	  $lonStr = $this->db->quote(trim($lon));

		
	  $location=$this->db->query("select * from CAL_LOCATION where sLat=$latStr and sLon=$lonStr and sLat>0 and sLon>0");
	  $results=$location->fetch(\PDO::FETCH_ASSOC);

	  error_log("Location Search: " . $this->db->lastQuery());
		
	  $location = $results["id"];

	  if ($location>0) {
			
		  return $location;
	  }
	  
	  else {
		  return 0;
	  }
		
	}

	public function getEventsComingUp($calendarID) {
		
	  $r=$this->db->query("select count(1) as count, month(tStart) as month, year(tStart) as year, day(tStart) as day from CAL_EVENT left join CAL_EVENTS on (CAL_EVENT.kEventID=CAL_EVENTS.id) where CAL_EVENTS.kCalendarID='$calendarID' and tStart>=now() and tStart<'2013-11-01' group by date(tStart) asc");    
      $results=$r->fetchAll();

	  error_log("Coming Up: " . $this->db->lastQuery());


      return $results;
	}	

	public function getRecentEvents($calendarID) {
		
	  $r=$this->db->query("select count(1) as count, month(tStart) as month, year(tStart) as year, day(tStart) as day from CAL_EVENT left join CAL_EVENTS on (CAL_EVENT.kEventID=CAL_EVENTS.id) where CAL_EVENTS.kCalendarID='$calendarID' and tStart>='2013-08-01' and tStart<now() group by date(tStart) asc");    
      $results=$r->fetchAll();

	  error_log("Recent Events: " . $this->db->lastQuery());


      return $results;
	}
		
	public function updateLocation($locationID, $params = array()) {
		
		
	}
	
	public function getLocationByID($locationID) {

	  $locationIDStr = $this->db->quote($locationID);
		
	  $r=$this->db->query("select * from CAL_LOCATION where id=$locationIDStr");
	  $results=$r->fetch(\PDO::FETCH_ASSOC);

	  error_log($this->db->lastQuery());
		
	  return $results["sName"];
		
	}

	public function getLocations() {
		
	  $locationIDStr = $this->db->quote($locationID);
		
	  $r=$this->db->query("select * from CAL_LOCATION where bActive is TRUE order by sName asc");
	  $results=$r->fetchAll();

	  error_log($this->db->lastQuery());
		
	  return $results;

		
	}
	
	public function getAllCategories() {
		
	  $r=$this->db->query("select *, CAL_CATEGORIES.sName as name from CAL_CATEGORIES where bActive is TRUE order by iOrder asc, sName asc");
	  $results=$r->fetchAll();

	  error_log($this->db->lastQuery());
		
	  return $results;
		
	}

	public function getAllAreas($regionID) {
		
	  $r=$this->db->query("select *, CAL_AREAS.sName as name from CAL_AREAS where bActive is TRUE and kRegionID='$regionID' order by iOrder asc, sName asc");
	  $results=$r->fetchAll();

	  error_log($this->db->lastQuery());
		
	  return $results;
		
	}

	public function getAllAreasByCalendarID($calendarID) {
		
	  $r=$this->db->query("select *, CAL_AREAS.sName as name from CAL_AREAS where bActive is TRUE and kCalendarID='$calendarID' order by iOrder asc, sName asc");
	  $results=$r->fetchAll();

	  error_log($this->db->lastQuery());
		
	  return $results;
		
	}
		
	public function addCategory($category) {
		
		
	}
	
	public function updateCategory($categoryID) {
		
		
	}
	
	public function removeCategory($categoryID) {
		
		
	}
	 
	public function getCategoryByID($categoryID) {

	  $categoryIDStr = $this->db->quote($categoryID);

	  $results=$this->db->query("select * from CAL_CATEGORIES where id=$categoryIDStr");
	  $category=$results->fetch(\PDO::FETCH_ASSOC);

	  error_log($this->db->lastQuery());
		
	  return $category["sName"];		
	}
	 
	public function findCategory($category) {

	  $categoryStr = $this->db->quote($categoryStr);

	  $results=$this->db->query("select * from CAL_CATEGORIES where sName=$categoryStr");
	  $category=$results->fetch(\PDO::FETCH_ASSOC);

	  error_log($this->db->lastQuery());
	  
	  if ($category) {
				
		  return $category["id"];		
	  }
	  else {
	  
		  return 0;

	  }
	  
	} 
	 
	public function getAllEventsByDate($from, $to) {
		
		
	}
	
	public function getAllEventsByLocation($location, $from, $to) {
		
		
	}
	
	function createDateRangeArray($strDateFrom,$strDateTo)
	{
	    // takes two dates formatted as YYYY-MM-DD and creates an
	    // inclusive array of the dates between the from and to dates.
	
	    // could test validity of dates here but I'm already doing
	    // that in the main script
	
	    $aryRange=array();
	
	    $iDateFrom=mktime(1,0,0,substr($strDateFrom,5,2),     substr($strDateFrom,8,2),substr($strDateFrom,0,4));
	    $iDateTo=mktime(1,0,0,substr($strDateTo,5,2),     substr($strDateTo,8,2),substr($strDateTo,0,4));

		$iDateFrom = strtotime($strDateFrom);
		$iDateTo = strtotime($strDateTo);

		$dateDiff = ($iDateTo-$iDateFrom)/(3600*24);
		error_log("days diff: " . $dateDiff);

		if (($iDateTo-$iDateFrom)<(3600/24*14)) {
			$iDateTo = strtotime("$strDateTo + 14 days");
			error_log("Adding Days");
		}

       	error_log("Date Range: " . $iDateFrom . $iDateTo);
	
	    if ($iDateTo>=$iDateFrom)
	    {
	        array_push($aryRange,date('Y-m-d',$iDateFrom)); // first entry
	        while ($iDateFrom<$iDateTo)
	        {
	        	error_log("Adding Date: " . $iDateFrom);
	        	
	            $iDateFrom+=86400; // add 24 hours
	            array_push($aryRange,date('Y-m-d',$iDateFrom));
	        }
	    }
	    return $aryRange;
	}

	public function getAllDaysByDateRange($calendar, $fromDate, $toDate) {
	
//	  $r=$this->db->query("");
//      $results=$r->fetchAll();

      error_log("Date Ranges: " . $fromDate . " " .  $toDate);

	  $dates = $this->createDateRangeArray($fromDate, $toDate);

	  $results = array();
	  
	  $i=0;
	  
	  foreach ($dates as $date) {
	  	  if (++$i>30) break;
	  	  $dayName = date('D', strtotime($date));
	  	  $dayNumber = date('d', strtotime($date));

	  	  error_log("Days: $date " . $dayName . " " . $dayNumber);
	  	  
		  array_push($results, array("dayName"=>$dayName, "dayNumber"=>$dayNumber, "dateYMD"=>$date));
	  }
		
	  return $results;
		
	}	

	public function getEventByID($eventID) {
	
	  $eventIDStr = $this->db->quote($eventID);
	
	  $r=$this->db->query("select CAL_EVENT.*,CAL_LOCATION.zAddress,CAL_LOCATION.bGeocoded as bGeocoded, CAL_LOCATION.sLat as sLat,CAL_LOCATION.sLon as sLon, DATE_FORMAT(tStart,'%b %d %Y %h:%i %p') as tStartStr, DATE_FORMAT(tEnd,'%b %d %Y %h:%i %p') as tEndStr, DATE_FORMAT(tStart,'%M %D, %Y') as tDateStr, DATE_FORMAT(tStart,'%m/%d/%Y') as tStartDate, DATE_FORMAT(tEnd,'%m/%d/%Y') as tEndDate,DATE_FORMAT(tStart,'%h:%i %p') as tStartTime, DATE_FORMAT(tEnd,'%h:%i %p') as tEndTime, CAL_EVENT.id as eventID, CAL_EVENT.kCategoryID as category, CAL_EVENT.kLocationID as location, left(CAL_EVENT.sTitle,50) as title, CAL_EVENT.tStart as startStr, CAL_EVENT.tEnd as endStr, CAL_LOCATION.id as locationID, CAL_LOCATION.zAddress as zAddress, CAL_LOCATION.sState as sState, CAL_LOCATION.sCity as sCity, CAL_EVENT.sURL as uWebsite, CAL_CATEGORIES.id as categoryID, CAL_CATEGORIES.squareImg as squareImg, CAL_CATEGORIES.rectImg as rectImg, CAL_LOCATION.sName as locationName, CAL_CATEGORIES.sName as categoryName from CAL_EVENT left join CAL_EVENTS on (CAL_EVENT.kEventID=CAL_EVENTS.id) left join CAL_LOCATION on (CAL_EVENT.kLocationID=CAL_LOCATION.id) left join CAL_CATEGORIES on (CAL_CATEGORIES.id=CAL_EVENT.kCategoryID) where CAL_EVENT.id=$eventIDStr");
	  $event=$r->fetch(\PDO::FETCH_ASSOC);

	  error_log($this->db->lastQuery());
		
	  return $event;
		
	}

	
	public function getAllEventsByCalendarID($calendar,$fromDate) {
	
	  if ($fromDate) {
		  $fromDateStr = " and tStart >= '$fromDate'";
	  }
	  else {
		  $fromDateStr = '';
	  }
	
	  $r=$this->db->query("select *, DATE_FORMAT(tStart,'%b %d %Y %h:%i %p') as tStartStr, DATE_FORMAT(tEnd,'%b %d %Y %h:%i %p') as tEndStr,CAL_EVENT.id as eventID, CAL_EVENT.kCategoryID as category, CAL_EVENT.kLocationID as location, left(CAL_EVENT.sTitle,50) as title, CAL_EVENT.tStart as startStr, CAL_EVENT.tEnd as endStr, CAL_LOCATION.sName as locationName, CAL_LOCATION.id as locationID, CAL_CATEGORIES.squareImg as squareImg, CAL_CATEGORIES.rectImg as rectImg, CAL_CATEGORIES.id as categoryID, CAL_CATEGORIES.sName as categoryName,CAL_LOCATION.zAddress as zAddress, CAL_LOCATION.sState as sState, CAL_LOCATION.sCity as sCity from CAL_EVENT left join CAL_EVENTS on (CAL_EVENT.kEventID=CAL_EVENTS.id) left join CAL_LOCATION on (CAL_EVENT.kLocationID=CAL_LOCATION.id) left join CAL_CATEGORIES on (CAL_CATEGORIES.id=CAL_EVENT.kCategoryID) where CAL_EVENT.sStatus='' and CAL_EVENT.sTitle!='' $fromDateStr order by tStart asc,CAL_EVENT.bRepeating asc limit 1000");
      $results=$r->fetchAll();

	  error_log($this->db->lastQuery());
		
	  return $results;
		
	}

	public function getAllEventsByDateRange($calendar, $fromDate, $toDate, $categoryID, $keywords, $areaID) {
	
	   $categoryIDStr = $this->db->quote($categoryID);

	   if ($areaID == "") {
		   	$areaID="%";
	   }
	   
	   $areaIDStr = $this->db->quote($areaID);

	   if ($keywords) {
		   $keywordsStr = " and (CAL_EVENT.zKeywords like " . str_replace(' ', '%', $this->db->quote("%" . $keywords . "%")) . " or CAL_EVENT.sDescription like " . str_replace(' ', '%', $this->db->quote("%" . $keywords . "%")) . " or CAL_EVENT.sTitle like " . str_replace(' ', '%', $this->db->quote("%" . $keywords . "%")) . " or CAL_LOCATION.sName like " . str_replace(' ', '%', $this->db->quote("%" . $keywords . "%")) . ")";
	   }
	   else {
		   $keywordsStr="";
	   }
	   if ($categoryIDStr == "''") {
		   $categoryIDStr="'%'";
	   }
	   
	  $r=$this->db->query("select *,CAL_EVENT.id as eventID, CAL_EVENT.id as id, date_format(CAL_EVENT.tStart, '%m/%d/%y') as stdDateStr, date_format(CAL_EVENT.tStart, '%m/%d/%Y') as dateStr, DATE_FORMAT(tStart,'%b %d %Y %h:%i %p') as tStartStr, DATE_FORMAT(tEnd,'%b %d %Y %h:%i %p') as tEndStr, CAL_EVENT.kCategoryID as categoryID,'All Categories' as category, CAL_EVENT.kLocationID as location, left(CAL_EVENT.sTitle,250) as title, substring(CAL_EVENT.sDescription,0,50) as description, concat('http://',CAL_EVENT.sURL) as website, CAL_EVENT.sDescription as description,CAL_EVENT.sContactEmail as emailAddress, date(tStart) as date, '904-555-1212' as phone, CAL_EVENT.tStart as startStr, CAL_EVENT.tEnd as endStr, CAL_LOCATION.sName as locationName, CAL_LOCATION.id as locationID, CAL_LOCATION.zAddress as zAddress, CAL_LOCATION.sState as sState, CAL_LOCATION.sCity as sCity, CAL_CATEGORIES.id as categoryID, CAL_CATEGORIES.squareImg as squareImg, CAL_CATEGORIES.rectImg as rectImg, CAL_CATEGORIES.sName as categoryName from CAL_EVENT left join CAL_EVENTS on (CAL_EVENT.kEventID=CAL_EVENTS.id) left join CAL_LOCATION on (CAL_EVENT.kLocationID=CAL_LOCATION.id) left join CAL_CATEGORIES on (CAL_CATEGORIES.id=CAL_EVENT.kCategoryID) where CAL_EVENT.sStatus='' and CAL_EVENT.sTitle!='' and CAL_EVENT.tStart>='$fromDate 00:00:00' and CAL_EVENT.tEnd<='$toDate 23:59:59' and kCategoryID like $categoryIDStr  $keywordsStr order by  tStart asc,CAL_EVENT.bRepeating asc limit 200");
      $results=$r->fetchAll();

	  error_log("All Events By Date Range: " . $this->db->lastQuery());
		
	  return $results;
		
	}	


	public function getTopEvents($calendar, $fromDate, $toDate, $limit) {
	
	  $limitStr = $this->db->quote($limit);
	  
	  $r=$this->db->query("select *,CAL_EVENT.id as eventID, date_format(CAL_EVENT.tStart, '%m/%d/%Y') as dateStr, DATE_FORMAT(tStart,'%b %d %Y %h:%i %p') as tStartStr, DATE_FORMAT(tEnd,'%b %d %Y %h:%i %p') as tEndStr, CAL_EVENT.kCategoryID as categoryID,'All Categories' as category, CAL_EVENT.kLocationID as location, left(CAL_EVENT.sTitle,100) as title, CAL_EVENT.sDescription as description, concat('http://',CAL_EVENT.sURL) as website, CAL_EVENT.sContactEmail as emailAddress, date(tStart) as date, '904-555-1212' as phone, CAL_EVENT.tStart as startStr, CAL_EVENT.tEnd as endStr, CAL_LOCATION.sName as locationName, CAL_LOCATION.zAddress as zAddress, CAL_LOCATION.sState as sState, CAL_LOCATION.sCity as sCity, CAL_CATEGORIES.squareImg as squareImg, CAL_CATEGORIES.rectImg as rectImg, CAL_LOCATION.id as locationID, CAL_CATEGORIES.id as categoryID, CAL_CATEGORIES.sName as categoryName from CAL_EVENT left join CAL_EVENTS on (CAL_EVENT.kEventID=CAL_EVENTS.id) left join CAL_LOCATION on (CAL_EVENT.kLocationID=CAL_LOCATION.id) left join CAL_CATEGORIES on (CAL_CATEGORIES.id=CAL_EVENT.kCategoryID) where CAL_EVENT.sStatus='' and CAL_EVENT.sTitle!='' and CAL_EVENT.tStart>=now() order by tStart asc,CAL_EVENT.bRepeating asc limit 3");
      $results=$r->fetchAll();

	  error_log($this->db->lastQuery());
		
	  return $results;
		
	}
	
	public function getAllEventsByAuthor($calendar, $authorID) {
	
	  $r=$this->db->query("select *, DATE_FORMAT(tStart,'%b %d %Y %h:%i %p') as tStartStr, DATE_FORMAT(tEnd,'%b %d %Y %h:%i %p') as tEndStr,CAL_EVENT.id as eventID, CAL_EVENT.kCategoryID as category, CAL_EVENT.kLocationID as location, left(CAL_EVENT.sTitle,50) as title, CAL_EVENT.tStart as startStr, CAL_EVENT.tEnd as endStr, CAL_LOCATION.sName as locationName, CAL_LOCATION.zAddress as zAddress, CAL_LOCATION.sState as sState, CAL_LOCATION.sCity as sCity, CAL_CATEGORIES.squareImg as squareImg, CAL_CATEGORIES.rectImg as rectImg, CAL_LOCATION.id as locationID, CAL_CATEGORIES.id as categoryID, CAL_CATEGORIES.sName as categoryName from CAL_EVENT left join CAL_EVENTS on (CAL_EVENT.kEventID=CAL_EVENTS.id) left join CAL_LOCATION on (CAL_EVENT.kLocationID=CAL_LOCATION.id) left join CAL_CATEGORIES on (CAL_CATEGORIES.id=CAL_EVENT.kCategoryID) where CAL_EVENT.sStatus='' and CAL_EVENT.sTitle!='' and CAL_EVENT.tStart>now() order by tStart asc limit 200");
      $results=$r->fetchAll();

	  error_log($this->db->lastQuery());
		
	  return $results;
		
	}

	public function getSponsoredEventsByDateRange($calendar, $fromDate, $toDate) {
	
	  $r=$this->db->query("select CAL_EVENT.id as eventID, CAL_EVENT.kCategoryID as categoryID,'All Categories' as category, CAL_EVENT.kLocationID as location, left(CAL_EVENT.sTitle,20) as title, CAL_EVENT.sDescription as description, concat('http://',CAL_EVENT.sURL) as website, CAL_EVENT.sContactEmail as emailAddress, date(tStart) as date, '904-555-1212' as phone, CAL_EVENT.tStart as startStr, CAL_EVENT.tEnd as endStr from CAL_EVENT left join CAL_EVENTS on (CAL_EVENT.kEventID=CAL_EVENTS.id) where CAL_EVENT.sStatus='' and CAL_EVENT.sTitle!='' and CAL_EVENT.tStart>='$fromDate' and CAL_EVENT.tEnd<='$toDate' order by date(tStart) asc,CAL_EVENT.bRepeating asc limit 3");
      $results=$r->fetchAll();

	  error_log($this->db->lastQuery());
		
	  return $results;
		
	}	
	
	
// OLD FUNCTIONS BELOW

	public function getEventsByAccount($accountID) {
	  
	  $events=$this->db->query("select *,CAL_EVENTS.title as eventTitle, CAL_EVENT.name as eventName, concat(CAL_EVENTS.title, ' ' , CAL_EVENT.name) as eventDescription, concat(REG_CHILD.firstName, ' ', REG_CHILD.lastName) as childName, CAL_EVENT.startStamp as eventDateTime from CAL_EVENT left join CAL_EVENTS on (CAL_EVENT.eventID=CAL_EVENTS.id) left join REG_PLAYERS on (CAL_EVENT.refID=REG_PLAYERS.id) left join REG_CHILD on (REG_CHILD.id=REG_PLAYERS.childID) where CAL_EVENT.source=\"REG_PLAYERS\" and REG_CHILD.accountID='$accountID'");

//	  $results=$events->fetchAll();
	  
	  error_log($this->db->lastQuery());
		
//	  return $results;
	  
	  return $events;
		
	}	

	public function getEventsByChild($childID) {
	  
	  $events=$this->db->query("select *,CAL_EVENTS.title as eventTitle, CAL_EVENT.name as eventName, concat(CAL_EVENTS.title, ' ' , CAL_EVENT.name) as eventDescription, concat(REG_CHILD.firstName, ' ', REG_CHILD.lastName) as childName, CAL_EVENT.startStamp as eventDateTime from CAL_EVENT left join CAL_EVENTS on (CAL_EVENT.eventID=CAL_EVENTS.id) left join REG_PLAYERS on (CAL_EVENT.refID=REG_PLAYERS.id) left join REG_CHILD on (REG_CHILD.id=REG_PLAYERS.childID) where CAL_EVENT.source=\"REG_PLAYERS\" and REG_CHILD.id='$childID'");

//	  $results=$events->fetchAll();
	  
	  error_log($this->db->lastQuery());
		
//	  return $results;
	  
	  return $events;
		
	}
		
	public function getEventTitle($eventID) {
	  
	  $r=$this->db->query("select * from CAL_EVENTS where id='$eventID'");

	  $results=$r->fetch(\PDO::FETCH_ASSOC);

	  error_log($this->db->lastQuery());
		
	  error_log("Title: " . $results["title"]);
	  	
	  return $results["title"];

		
	}

	public function getPaymentMessage($eventID) {
	  
	  $r=$this->db->query("select payMessage from CAL_EVENTS where id='$eventID'");

	  $results=$r->fetch(\PDO::FETCH_ASSOC);

	  error_log($this->db->lastQuery());
			  	
	  return $results["payMessage"];
		
	}
	
	public function getSlotName($slotID) {
	  
	  $r=$this->db->query("select * from CAL_EVENT where id='$slotID'");

	  $results=$r->fetch(\PDO::FETCH_ASSOC);

	  error_log($this->db->lastQuery());
			  	
	  return $results["name"];

		
	}
	
	public function getEventSourceBySlotID($slotID) {
	  
	  $r=$this->db->query("select CAL_EVENTS.source from CAL_EVENTS left join CAL_EVENT on (CAL_EVENT.eventID=CAL_EVENTS.id) where CAL_EVENT.id='$slotID'");

	  $results=$r->fetch(\PDO::FETCH_ASSOC);

	  error_log($this->db->lastQuery());
		
	  error_log("Source: " . $results["source"]);
	  	
	  return $results["source"];

		
	}

	public function getEventBySlot($slotID) {
	  
	  $r=$this->db->query("select CAL_EVENT.eventID from CAL_EVENTS left join CAL_EVENT on (CAL_EVENT.eventID=CAL_EVENTS.id) where CAL_EVENT.id='$slotID'");

	  $results=$r->fetch(\PDO::FETCH_ASSOC);

	  error_log($this->db->lastQuery());
			  	
	  return $results["eventID"];

		
	}

	public function getAmountBySlot($slotID) {
	  
	  $r=$this->db->query("select CAL_EVENT.cost from CAL_EVENTS left join CAL_EVENT on (CAL_EVENT.eventID=CAL_EVENTS.id) where CAL_EVENT.id='$slotID'");

	  $results=$r->fetch(\PDO::FETCH_ASSOC);

	  error_log($this->db->lastQuery());
		
	  	
	  return $results["cost"];

		
	}

	public function getSourceBySlot($slotID) {
	  
	  $r=$this->db->query("select CAL_EVENT.source from CAL_EVENT where CAL_EVENT.id='$slotID'");

	  $results=$r->fetch(\PDO::FETCH_ASSOC);

	  error_log($this->db->lastQuery());
			  	
	  return $results["source"];

		
	}
			
	public function getSlots($eventID) {
	  
	  $calendars=$this->db->query("select *,count(if(CAL_EVENT.status = '', CAL_EVENT.status,NULL)) as openCnt, count(if(CAL_EVENT.status != '', CAL_EVENT.status,NULL)) as usedCnt from CAL_EVENT left join CAL_EVENTS on (CAL_EVENT.eventID=CAL_EVENTS.id) where CAL_EVENT.eventID='$eventID' group by CAL_EVENT.name order by groupOrder asc, slotOrder asc, CAL_EVENT.startStamp asc");

	  error_log($this->db->lastQuery());
		
	  return $calendars;
	
	}

	public function getSlotByEvent($source, $refID, $eventID) {
	  
	  $slots=$this->db->query("select * from CAL_EVENT left join CAL_EVENTS on (CAL_EVENT.eventID=CAL_EVENTS.id) where CAL_EVENT.eventID='$eventID' and CAL_EVENT.source='$source' and CAL_EVENT.refID='$refID'");

	  error_log($this->db->lastQuery());
		
	  return $slots;
	
	}

	public function getSlotsByGroupName($eventID, $groupName) {
	  
	  $calendars=$this->db->query("select *,CAL_EVENT.id as SID, count(if(CAL_EVENT.status = '', CAL_EVENT.status,NULL)) as openCnt, count(if(CAL_EVENT.status != '', CAL_EVENT.status,NULL)) as usedCnt from CAL_EVENT left join CAL_EVENTS on (CAL_EVENT.eventID=CAL_EVENTS.id) where CAL_EVENT.eventID='$eventID' and CAL_EVENT.groupName='$groupName' group by CAL_EVENT.name order by slotOrder asc, CAL_EVENT.startStamp asc");

	  error_log($this->db->lastQuery());
		
	  return $calendars;
	
	}

		
	public function getSlotGroups($eventID) {
	  
	  $calendars=$this->db->query("select *,count(if(CAL_EVENT.status = '', CAL_EVENT.status,NULL)) as openCnt, count(if(CAL_EVENT.status != '', CAL_EVENT.status,NULL)) as usedCnt from CAL_EVENT left join CAL_EVENTS on (CAL_EVENT.eventID=CAL_EVENTS.id) where CAL_EVENT.eventID='$eventID' group by groupName order by groupOrder asc");

	  error_log($this->db->lastQuery());
		
	  return $calendars;

		
	}	
	
	public function reserve($slotID, $source, $sourceKey, $refID) {
								
	  if($refID>0) {							
								
			  $result = $this->db->updateWhere("CAL_EVENT", "id", $slotID, array("source"=>$source, "refID"=>$refID, "status"=>"open", "sourceKey"=>$sourceKey), " and refID='0'");	
		
			  error_log($this->db->lastQuery());
			  
			  $r=$this->db->query("select * from CAL_EVENT where id=\"$slotID\" and source=\"$source\" and sourceKey=\"$sourceKey\" and refID=\"$refID\" limit 1");
		
			  $results=$r->fetch(\PDO::FETCH_ASSOC);
		
			  error_log($this->db->lastQuery());
					  	
			  if ($results["refID"]==$refID) {
			  		if ($results["invoiceID"]>0) {
				  		error_log("Reserve: Inv Found");		  	
				  		return $results["invoiceID"];
			  		}
			  		else {
				  		error_log("Reserve: Inv Not Found");		  	
						return 0;	  
					}
			  }
	  }
	  
	  error_log("Reserve: Error");		  	
	 
	  return -1;
	  

	}

	public function addInvoice($slotID, $invoiceID) {
								
	  $result = $this->db->updateWhere("CAL_EVENT", "id", $slotID, array("invoiceID"=>$invoiceID), " and invoiceID=\"0\"");	

	  error_log($this->db->lastQuery());
	  
	  return $result;
	}
	
	
}
?>