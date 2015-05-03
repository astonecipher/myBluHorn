<?php

/**
 * FILELOGIX BLUHORN WORKSHEET CLASS
 *  
 * @author Wes Benwick
 * @link http://www.filelogix.com
 * @license Part of Filelogix usage license
 */ 
 
namespace FLX\Controllers;

class tv extends \controller
{  
    // Will store database connection here
	private $db;
	private $connID;
	private $sessionID;
	private $userID;
	private $view = "worksheet";
	private $auth;
	private $vars = array("activeSideBar"=>array("campaigns"=>"active"));
	private $lists;
	private $registration;
	private $request;
	private $editor;
	private $type;
	private $dayparts = array("none"=>"-", "em"=>"EM", "da"=>"DA", "ef"=>"EF", "en"=>"EN", "pa"=>"PA", "pr"=>"PR", "lf"=>"LF", "ln"=>"LN", "ov"=>"OV", "sp"=>"SP", "ro"=>"RO"); 
	private $fields = array("campaignID"=>"campaignID", "worksheetName"=>"name", "marketType"=>"typeID", "markets"=>"marketID", "agencyID"=>"agencyID", "useBroadcastWeeks"=>"useBroadcastWeeks", "commission"=>"commission");
	private $cols = array("agencyID"=>"agencyID", "worksheetID"=>"worksheetID", "lineNumber"=>"worksheetLine", "daypart"=>"daypart", "vendor"=>"vendorName", "vendorID"=>"vendorID", "station"=>"station", "timeOfDay"=>"timePeriod", "program"=>"programName", "mon"=>"isMonday", "tue"=>"isTuesday", "wed"=>"isWednesday", "thu"=>"isThursday", "fri"=>"isFriday", "sat"=>"isSaturday", "sun"=>"isSunday", "length"=>"seconds", "rate"=>"rate", "aqh"=>"aqhRating", "impact"=>"impact", "comments"=>"comments", "bold"=>"isBold", "cpp"=>"cpp", 
	"cpm"=>"cpm", "isIgnored"=>"isIgnored", "copy"=>"isCopy", "delete"=>"isDeleted", "isIgnored"=>"isIgnored");

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
	  $this->vars["userID"] = $this->userID;
	  $this->vars["dayparts"] = $this->dayparts;
	  $this->vars["sessionID"] = $this->sessionID;

	  error_log("Campaign Init");

	  $this->auth = new \auth($this->db);
	  
	  if (!$this->auth->validate($this->userID)) {
		  
		  $_SESSION["returnURL"] = $this->request->getRequest();
		
		  $this->view = "login";
		  
		  return;
	  }
	  
/*
	  $access = $this->auth->getAccessByUserID($this->userID, "Dashboard");
	  
	  if (!$access["read"]) {

		  $_SESSION["returnURL"] = $this->request->getRequest();

		  $this->view = "login";
		  
		  return;		  
		  
	  }	
*/  
	  
	  unset($_SESSION["returnURL"]);
	  
	  $this->lists = new \lists($this->db);
	  $this->editor = new \editor($this->db);
	 
	  $this->vars["sessionID"]=$this->sessionID;
	  $this->vars["sideNav"]="Dashboard";

	  $this->vars["username"] = "@" . $this->auth->getShortName($this->userID);
	  $this->vars["gravatar"] = md5( strtolower( trim( $this->auth->getEmailAddress($this->userID) ) ) );

	  $this->dflt();
	  		
//	  $this->db->insert("FLX_CONNECTIONS", array("type"=>$this->type, "sessionID"=>$this->sessionID, "httpHost"=>$this->httpHost, "ipAddress"=>$this->ipAddress, "userAgent"=>$this->userAgent, "fingerprint"=>$this->fingerprint, "requestURI"=>$this->requestURI, "_server"=>print_r($_SERVER,1), "_get"=>print_r($_GET,1), "_post"=>print_r($_POST,1)));	

//	  error_log($this->db->lastQuery());
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

		$this->vars["active"] = "dashboard";
	
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

		$this->vars["active"] = "dashboard";

		  $campaign = array();
		
		  $this->isSideNav();
		 		  
		  $this->topCharts();
		
		$this->view = "worksheet-tv-alt-simple";
		
		return true;		
	  }
	  else {
		 return false;
	  }
	}
	
	public function worksheet($params) {
	  if ($this->auth->validate($this->userID)) {


		$this->vars["active"] = "dashboard";

		
		$this->view = "worksheet";
		
		return true;		
	  }
	  else {
		 return false;
	  }
	}
	
	public function add($params) {
	  if ($this->auth->validate($this->userID)) {

		if (intval($params[3]) > 0) {
			$this->vars["active"] = "campaigns";
			
			
			$this->view = "worksheet-add";
		}
		else {
			$this->view = "campaigns-create";
			
		}
		
		return true;		
	  }
	  else {
		 return false;
	  }
	}
	
	public function template($params) {
//	  if ($this->auth->validate($this->userID)) {

		if ($params[2]=="summary") {
			if ($params[3] == "station") {
				if ($params[4] != "") {
						$this->vars["station"] = $params[4];
						$this->view = "worksheet-station-summary";
				}
			}
		}
		else {
			$this->view = "worksheet-station-summary";			
		}
			
		return true;		
//	  }
//	  else {
//		 return false;
//	  }
	}
	
	public function players() {
		
	if ($this->auth->validate($this->userID)) {
	
		
		return true;
	 }
	 else {
		 return false;
	 }
	}

	public function all() {
		
	if ($this->auth->validate($this->userID)) {
	
		$this->view = "campaigns";			

		return true;
	 }
	 else {
		 return false;
	 }
	}

	public function create() {
		
	if ($this->auth->validate($this->userID)) {
	
		$this->view = "campaign-create";			

		return true;
	 }
	 else {
		 return false;
	 }
	}
	
	public function edit($params) {
		
	if ($this->auth->validate($this->userID)) {
		
	    $this->isSideNav();

		$this->topCharts();
	
		$form = new \forms($this->db);
		
		$worksheetID = $params[2];	
								
	   	$updatedWorksheet = $form->map($this->fields, $_POST);
	   	  
		$bhUser = new \BH\user($this->db, $this->userID); 
		  
		$this->agencyID = $bhUser->getAgencyID();

		$this->vars["agencyID"] = $this->agencyID;
		$this->vars["worksheetID"] = $worksheetID;
		  
	    error_log("BH agencyID:" . $this->agencyID);

	    $activity = new \BH\activity($this->db, $this->agencyID, $this->userID);
	    

//	    $worksheet = new \BH\tv($this->db, $this->agencyID, $this->userID);
	    $worksheet = new \BH\tv($this->db, $this->agencyID, $this->userID);

		$wsType = $worksheet->type($worksheetID);

		if ( strtolower($wsType["type"]) != $params[0]) {
			
			$this->view = "error";
			return true;
		}
		
		$activity->logActivity(array("refID"=>$worksheetID, "activity"=>"BH_WORKSHEETS"));

		$this->vars["worksheet"] = $worksheet->getWorksheet($worksheetID);
		$this->vars["worksheet"]["sorting"] = $worksheet->getSortByWorksheetID($worksheetID);
		$this->vars["wsLines"] = $worksheet->getWorksheetLines($worksheetID);
		$worksheetWeeks = $worksheet->getWorksheetWeeks($worksheetID);

		// Convert to 2-D array

		$wsWeeks=array();

		foreach ($worksheetWeeks as $line) {
			$wsWeeks[$line["worksheetLine"]][$line["weekNumber"]]=$line["weekValue"];
		}

		$this->vars["wsWeeks"] = $wsWeeks;

	    $campaign = new \BH\campaign($this->db, $this->agencyID, $this->userID);	
	    $client = new \BH\client($this->db, $this->agencyID, $this->userID);	
	    $market = new \BH\market($this->db, $this->agencyID, $this->userID);	
	    $vendor = new \BH\vendor($this->db, $this->agencyID, $this->userID);	
	    $order = new \BH\order($this->db, $this->agencyID, $this->userID);

		$this->vars["orderInfo"] = $order->getLastOrderByWorksheetID($worksheetID);

		$this->vars["campaign"] = $campaign->getCampaign($this->vars["worksheet"]["campaignID"]);
		$this->vars["campaigns"] = $campaign->getAllCampaigns();
		$this->vars["marketTypes"] = $market->getMarketTypes();
		$this->vars["markets"] = $market->getAllMarkets(true);
		$this->vars["vendors"] = $vendor->getVendorsByWorksheetID($worksheetID);
		$this->vars["client"] = $client->getClient($this->vars["campaign"]["clientID"]);
		$this->vars["demographics"] = $worksheet->getDemographicsByWorksheetID($worksheetID);
	
		$this->vars["market"] = $market->getMarket($this->vars["worksheet"]["marketID"]);

		$mrktNames = $market->getMarketNames($worksheet->getMarkets($worksheetID));
		if (is_array($mrktNames)) {
			$marketName = implode(" ", $mrktNames);
		}
		else {
			$marketName = $mrktNames;
		}
		
		$this->vars["marketName"] = $marketName;
		
		$calendar  = new \CAL\calendar($this->db);
		
		$repeats = array();		

		error_log("Weeks:" . $this->vars["campaign"]["flightStart"] );

		$repeats["iWeekly"]=1;
		$repeats["iWeekDays"]=2;
		$repeats["dStartDate"]=$this->vars["campaign"]["flightStart"];
		$repeats["dEndDate"]=$this->vars["campaign"]["flightEnd"];

		$weeks = array();
		$month = array();
		$months = array();
		
		array_push($weeks, $this->vars["campaign"]["flightStart"]);

		$this->vars["weeks"] = array_merge($weeks,$calendar->createRepeatingDates($repeats,$this->vars["campaign"]["flightEnd"]));
		
//		error_log(print_r($weeks));

		$weekNames = array();
		$monthWeeks = array();

		$lastMonthWeek = "";
		
		$broadcastWeeks = $this->vars["worksheet"]["useBroadcastWeeks"];

		if (!$broadcastWeeks) {

			foreach ($this->vars["weeks"] as $week) {
				array_push($weekNames, date("M d", strtotime($week)));
				$month["name"]=	date("M", strtotime($week));
				if (!$month["weeks"]) {
					$month["weeks"] = array();
				}
				else { // if month changes, reset weeks array so they don't appear in other months
					if ($lastMonthWeek != date("M", strtotime($week))) {
						$month["weeks"] = array();
					}
				}
				$lastMonthWeek = date("M", strtotime($week));
				array_push($month["weeks"], date("M d", strtotime($week)));
				$months[date("m", strtotime($week))] = array("name"=>date("M", strtotime($week)), "weeks"=>$month["weeks"]);
			}
		}
		
		else {
		
			foreach ($this->vars["weeks"] as $week) {

				
				array_push($weekNames, date("M d", strtotime($week)));
				$month["name"]=	date("M", strtotime($week));

				if (!$month["weeks"]) {
					$month["weeks"] = array();
					$lastSundayOfMonth = strtotime("last sunday of this month", strtotime($week));
					$currentMonth = date("m",$lastSundayOfMonth);
					error_log("Broadcast Weeks Init - Last Sunday of this month:" . date("Y-m-d",$lastSundayOfMonth));
				}

				error_log("Broadcast Weeks - Last Sunday of this month:" . date("Y-m-d",$lastSundayOfMonth));
					error_log("Broadcast Weeks $week " . strtotime($week) . " " . $lastSundayOfMonth);
						
					if (strtotime($week) > $lastSundayOfMonth) {
						$month["weeks"] = array();
						error_log("Broadcast Weeks - New Month:" . date("Y-m-d",strtotime($week)) . " > " . date("Y-m-d",$lastSundayOfMonth));
						if (date("m",strtotime($week)) == date("m",$lastSundayOfMonth)) {
							$currentMonth = date("m",strtotime("+1 month", $lastSundayOfMonth));						
							$lastSundayOfMonth = strtotime("last sunday of next month", strtotime($week));
						}
						else {
							$lastSundayOfMonth = strtotime("last sunday of this month", strtotime($week));
						}
					}
					else {
						error_log("Broadcast Weeks - Same Month:" . date("Y-m-d",strtotime($week)) . " <= " . date("Y-m-d",$lastSundayOfMonth));						
					}
				$currentMonth = date("m",$lastSundayOfMonth);
		
				$lastMonthWeek = date("M", strtotime($week));
				array_push($month["weeks"], date("M d", strtotime($week)));
				error_log("Broadcast Weeks - Month: $currentMonth " . date("m", $lastSundayOfMonth) . " = " . date("M d", strtotime($week)));
				$months[$currentMonth] = array("name"=>date("M", $lastSundayOfMonth), "weeks"=>$month["weeks"]);	
			}		
		}

//		error_log("Months:" . print_r($months) );
		
		$numberOfWeeks = $worksheet->numberOfWeeks($worksheetID, count($weekNames));
		
		$worksheet->setActiveWeeks($worksheetID, 1, $numberOfWeeks);
		
		$worksheet->totalSpotsAndSpend($worksheetID);
		
		$this->vars["weekNames"] = $weekNames;
		$this->vars["months"] = $months;
		
		$maxLineNumber = $worksheet->getMaxLinesByWorksheetID($worksheetID);

		if ($maxLineNumber < 1) {
			$maxLineNumber = 1;
		}

		$this->vars["maxLineNumber"] = $maxLineNumber;
		
		$this->view = "worksheet-tv-alt-simple";			

		
if ($this->userID == 1) {

			$this->view = "worksheet-tv-alt-simple";			
			
		}


		return true;
	 }
	else {
		 return false;
	 }
	}

	
	public function edit2() {
		
	if ($this->auth->validate($this->userID)) {
	
		$this->view = "worksheet-tv-alt";			

		return true;
	 }
	 else {
		 return false;
	 }
	}
	
	public function pending() {
		
	if ($this->auth->validate($this->userID)) {
	
		
		return true;
	 }
	 else {
		 return false;
	 }
	}


	public function active() {
		
	if ($this->auth->validate($this->userID)) {
	
		
		return true;
	 }
	 else {
		 return false;
	 }
	}
	
	public function topCharts() {

		$bhUser = new \BH\user($this->db, $this->userID); 
		  
		$this->agencyID = $bhUser->getAgencyID();

		$this->vars["agencyID"] = $this->agencyID;
	
		$campaign = new \BH\campaign($this->db, $this->agencyID, $this->userID);		
	    $worksheet = new \BH\tv($this->db, $this->agencyID, $this->userID);		

		$fromDate = date("Y-m-d",strtotime());

		$campaignCounts = $campaign->countCampaignsByMonth($fromDate,15);
		$buysCounts = $worksheet->countBuysByMonth($fromDate,15);
		$adsCounts = $worksheet->countLinesByMonth($fromDate,15);
		
		$campaignsByMonth = $this->listOfMonths(15);
		$buysByMonth = $this->listOfMonths(15);
		$adsByMonth = $this->listOfMonths(15);

		foreach ($campaignCounts as $count) {
			if (array_key_exists($count["month"], $campaignsByMonth)) {
				$campaignsByMonth[$count["month"]] = $count["total"];
			}
	
		}

		foreach ($buysCounts as $count) {
			if (array_key_exists($count["month"], $buysByMonth)) {
				$buysByMonth[$count["month"]] = $count["total"];
			}
		}	

		foreach ($adsCounts as $count) {
			if (array_key_exists($count["month"], $adsByMonth)) {
				$adsByMonth[$count["month"]] = $count["total"];
			}
		}	
					
		$this->vars["chartCampaigns"] = implode(",",array_values($campaignsByMonth));
		$this->vars["chartCampaignsTotal"] = $campaign->countCampaigns();
				
		$this->vars["chartBuys"] = implode(",",array_values($buysByMonth));
		$this->vars["chartBuysTotal"] = $worksheet->countBuys();
		
		$this->vars["chartAds"] = implode(",",array_values($adsByMonth));
		$this->vars["chartAdsTotal"] = $worksheet->countLines();

		return true;
		
	}
	

	public function isSideNav() {

		$bhUser = new \BH\user($this->db, $this->userID); 
		  
		if ($bhUser->showSideNav()) {
			$this->vars["hideSideBar"] = false;			
		}
		else {
			$this->vars["hideSideBar"] = true;							
		}
		
		return true;
		
	}
	

	
	public function editor($params) {
		
	
		
	   if ($this->auth->validate($this->userID)) {

		$this->vars["sideNav"]="Editor";
/*
		if ($params[4] == "save") {
			error_log("Saving Editor Content.");
			error_log(html_entity_decode($_POST["editorContent"]));
			
			return true;
		}

*/

		if ($params[4] == "ace") {
		
			$this->vars["titleBar"] = $params[5];
		
			$this->view="editor-ace";
	
			$source = $this->editor->getTemplate($params[5]);
	
	//		error_log("Dump: $source");
	
			$this->vars["editorSource"] = htmlentities($source);
			
			return true;
			
		}	
	
		else {
		
			$this->view="editor-table";
	
			$templates = $this->editor->getTemplates();
	
	//		error_log("Dump: $source");
	
			$this->vars["items"] = $templates;
			
			return true;
		}
	  }
	  else {
		 return false;
	  }
	}


	
	public function data() {
		
		return $this->vars;
	}

	public function listOfMonths($numberOfMonths) {
		
		$months = array();
		
		for ($i = 1; $i <= $numberOfMonths; $i++) {
			$month = date("Y-m", strtotime("-$i months"));
			$months[$month] = 0;
		}
		
		return $months;
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

	public function ajax($params) {
	
	 error_log("Worksheets AJAX");
	
	 if ($this->auth->validate($this->userID)) {
		  
		  if ($params[2] == "save") {
		  		  
			  $bhUser = new \BH\user($this->db, $this->userID); 
			  
			  $this->agencyID = $bhUser->getAgencyID();
		  	
			  $form = new \forms($this->db);
		
			  $campaign = array();
			  
			  $campaignID = $params[3];
		
			  $updatedWorksheet = $form->map($this->fields, $_POST);
		
			  $worksheet = new \BH\tv($this->db, $this->agencyID, $this->userID);
		
			  $worksheetID =  $worksheet->saveWorksheet($worksheetID, $updatedWorksheet);

			  $this->view = "ajax-response";	
			  
			  $response = array();	
		
			  if ($campaignID>0) {
			  		$response["message"] = "Saved!";
			  		$this->vars["response"] = json_encode($response);
				  	return true;
			  }
			  else {
			  		$response["message"] = "<span style='color:#f00'>Not Saved! Worksheet Name Already Exists.</span>";
			  		$response["error"] = true;
			  		$response["field"] = "campaign-name";						
			  		$this->vars["response"] = json_encode($response);		
				  	return true;
			  }
		  }

		  else if ($params[2] == "delete") {
		  		  
			  $bhUser = new \BH\user($this->db, $this->userID); 
			  
			  $this->agencyID = $bhUser->getAgencyID();
		  	
			  $form = new \forms($this->db);
					  
			  $worksheetID = $params[3];
				
			  $worksheet = new \BH\tv($this->db, $this->agencyID, $this->userID);
		
			  $worksheetID =  $worksheet->deleteWorksheet($worksheetID);

			  $this->vars["active"] = "campaigns";		
			  $this->view = "ajax-response";	
			  
			  $response = array();	
		
			  if ($worksheetID>0) {
			  		$response["message"] = "Worksheet Deleted!";
			  		$this->vars["response"] = json_encode($response);
				  	return true;
			  }
			  else {
			  		$response["message"] = "<span style='color:#f00'>Error! Unable to delete worksheet.</span>";
			  		$response["error"] = true;
			  		$this->vars["response"] = json_encode($response);		
				  	return true;
			  }
		  }

		  else if ($params[2] == "copy") {
		  		  
			  $bhUser = new \BH\user($this->db, $this->userID); 
			  
			  $this->agencyID = $bhUser->getAgencyID();
		  	
			  $form = new \forms($this->db);
					  
			  $worksheetID = $params[3];
				
			  $worksheet = new \BH\tv($this->db, $this->agencyID, $this->userID);
		
			  $worksheetID =  $worksheet->copyWorksheet($worksheetID, $campaignIDFrom, $campaignIDTo);

			  $this->vars["active"] = "campaigns";		
			  $this->view = "ajax-response";	
			  
			  $response = array();	
		
			  if ($vendorID>0) {
			  		$response["message"] = "Worksheet Deleted!";
			  		$this->vars["response"] = json_encode($response);
				  	return true;
			  }
			  else {
			  		$response["message"] = "<span style='color:#f00'>Error! Unable to delete worksheet.</span>";
			  		$response["error"] = true;
			  		$this->vars["response"] = json_encode($response);		
				  	return true;
			  }
		  }
		  
		  else if ($params[2] == "worksheet") {
			  if (intval($params[3]) > 0) {
				  $bhUser = new \BH\user($this->db, $this->userID); 
				  
				  $this->agencyID = $bhUser->getAgencyID();
			  	
				  $form = new \forms($this->db);
						  
				  $worksheetID = intval($params[3]);
				  
				  $tv = new \BH\tv($this->db, $this->agencyID, $this->userID);
				  $vendor = new \BH\vendor($this->db, $this->agencyID, $this->userID);	
	
				  $vendors = $vendor->getVendorsByWorksheetID($worksheetID);
				  
				  $worksheetLines = $tv->getWorksheetLines($worksheetID);
				  $worksheetWeeks = $tv->getWorksheetWeeks($worksheetID);
		
				  $numberOfWeeks = $tv->numberOfWeeks($worksheetID);
		
				  $lines = array();
				  $wsWeeks = array();
				  
				  $lineCounter = 1;
				  $rowNumber = 1;

				  foreach ($worksheetWeeks as $line) {
					  $wsWeeks[$line["worksheetLine"]][$line["weekNumber"]]=$line["weekValue"];
				  }
				  
				  foreach ($worksheetLines as $wsLine) {
				  	  $line = array();
				  	  $worksheetLine = $wsLine["worksheetLine"];
				  	  $station = $wsLine["station"];
				  	  $timePeriod = $wsLine["timePeriod"];
				  	  $programName = $wsLine["programName"];
				  	  $aqhRating = $wsLine["aqhRating"];
				  	  $rate = $wsLine["rate"];
				  	  $seconds = $wsLine["seconds"];
				  	  $cpp = $wsLine["cpp"];
				  	  $cpm = $wsLine["cpm"];
				  	  $impact = $wsLine["impact"];
				  	  $comments = $wsLine["comments"];

				  	  
				  	  $isMonday = $wsLine["isMonday"];
				  	  $isMondayStr = "";
				  	  if ($isMonday) {
					  	  	$isMondayStr = "checked";
				  	  }

				  	  $isTuesday = $wsLine["isTuesday"];
				  	  $isTuesdayStr = "";
				  	  if ($isTuesday) {
					  	  	$isTuesdayStr = "checked";
				  	  }
				  	  
				  	  $isWednesday = $wsLine["isWednesday"];
				  	  $isWednesdayStr = "";
				  	  if ($isWednesday) {
					  	  	$isWednesdayStr = "checked";
				  	  }				  	  				  	 

				  	  $isThursday = $wsLine["isThursday"];
				  	  $isThursdayStr = "";
				  	  if ($isThursday) {
					  	  	$isThursdayStr = "checked";
				  	  }	

				  	  $isFriday = $wsLine["isFriday"];
				  	  $isFridayStr = "";
				  	  if ($isFriday) {
					  	  	$isFridayStr = "checked";
				  	  }	

				  	  $isSaturday = $wsLine["isSaturday"];
				  	  $isSaturdayStr = "";
				  	  if ($isSaturday) {
					  	  	$isSaturdayStr = "checked";
				  	  }	

				  	  $isSunday = $wsLine["isSunday"];
				  	  $isSundayStr = "";
				  	  if ($isSunday) {
					  	  	$isSundayStr = "checked";
				  	  }	
				  	  
				  	  $isCopy = $wsLine["isCopy"];
				  	  $isCopyStr = "";
				  	  if ($isCopy) {
					  	  	$isCopyStr = "checked";
				  	  }
				  	  
				  	  $isBold = $wsLine["isBold"];
				  	  $isBoldStr = "";
				  	  if ($isBold) {
					  	  	$isBoldStr = "checked";
				  	  }
				  	
				  	  $isDeleted = $wsLine["isDeleted"];
				  	  $isDeletedStr = "";
				  	  if ($isDeleted) {
					  	  	$isDeletedStr = "checked";
				  	  }
				  	  

					  $vendorStr = "";
					  
					  foreach ($vendors as $vendor) {
						  $vendorName = $vendor["name"];
						  $vendorID = $vendor["id"];
						  
						  $selectedStr = "";

						  if ($wsLine["vendorID"] == $vendorID) {
							  	$selectedStr = "selected";
						  }
						  
						  $vendorStr .= "<option value='$vendorID' $selectedStr>$vendorName</option>";
					  }
	
					  $daypartStr = "";
					  
					  foreach ($this->dayparts as $daypart) {
					  						  
						  $selectedStr = "";

						  if ($wsLine["daypart"] == $daypart) {
							  	$selectedStr = "selected";
						  }
						  
						  $daypartStr .= "<option value='$daypart' $selectedStr>$daypart</option>";
					  }
				  	  				  	  				  	  				  	  				  	  				  	  
				  	  $line["worksheetLine"] = "$worksheetLine<input type='hidden' class='worksheet-field' value='". $worksheetLine . "' name='worksheetLine[]'>";
					  $line["daypart"] = "<select class='form-control input-sm worksheet-field' id='field-daypart-". $worksheetLine . "' name='daypart[]' data-index='daypart' data-name='daypart' data-line='". $worksheetLine ."' data-row='". $lineCounter . "' data-counter='". $rowNumber ."' onchange='updateField(this);'>$daypartStr</select>";
				  	  $line["vendor"] = "<select class='form-control input-sm worksheet-field' id='field-vendorID-". $worksheetLine . "' name='vendorID[]' data-index='vendorID' data-name='vendorID' data-line='". $worksheetLine ."' data-row='". $lineCounter . "' data-counter='". $rowNumber ."' onchange='updateField(this);'><option value=''></option>$vendorStr</select>";
				  	  $line["station"] = "<div class='form-group'><input type=text class='form-control input-sm worksheet-field' id='field-station-$worksheetLine' value='$station' name='station[]' data-index='station' data-name='station' data-line='$worksheetLine' data-row='$rowNumber' data-counter='$rowNumber' onchange='updateField(this);'></div>";
				  	  $line["timeOfDay"] = "<div class='form-group'><input type=text class='form-control input-sm worksheet-field' placeholder='####A/P-####A/P'  id='field-timeOfDay-$worksheetLine' value='$timePeriod' name='timeOfDay[]' data-index='timeOfDay' data-name='timeOfDay' data-line='$worksheetLine' data-row='$worksheetLine' data-counter='$worksheetLine' onchange='updateField(this);'></div>";
				  	  $line["program"] = "<div class='form-group'><input type='text' value='$programName' class='form-control input-sm worksheet-field' id='field-program-$worksheetLine'  name='program[]' data-index='program' data-name='program' data-line='$worksheetLine' data-row='$rowNumber' data-counter='$rowNumber' onchange='updateField(this);'></div>";
				  	  $line["isMonday"] = "<input type=checkbox name='isMonday[]' class='' id='field-mon-". $worksheetLine . "' data-index='mon' data-name='mon' data-line='". $worksheetLine . "' data-row='". $lineCounter . "' data-counter='$rowNumber' value='$isMonday' $isMondayStr onchange='updateField(this);'>";
				  	  $line["isTuesday"] = "<input type=checkbox id='field-tue-". $worksheetLine . "' data-index='tue' data-name='tue' data-line='". $worksheetLine . "' data-row='". $lineCounter . "' data-counter='$rowNumber'  name='isTuesday[]' class='' value='$isTuesday' $isTuesdayStr onchange='updateField(this);'>";
				  	  $line["isWednesday"] = "<input type=checkbox data-index='wed' id='field-wed-". $worksheetLine . "' data-name='wed' data-line='". $worksheetLine . "' data-row='". $lineCounter . "' data-counter='$rowNumber'  name='isWednesday[]' class='' value='$isWednesday' $isWednesdayStr onchange='updateField(this);'>";
				  	  $line["isThursday"] = "<input type=checkbox id='field-thu-". $worksheetLine . "' data-index='thu' data-name='thu' data-line='". $worksheetLine . "' data-row='". $lineCounter . "' data-counter='$rowNumber'  name='isThursday[]' class='' value='$isThursday' $isThursdayStr onchange='updateField(this);'>";
				  	  $line["isFriday"] = "<input type=checkbox id='field-fri-". $worksheetLine . "' data-index='fri' data-name='fri' data-line='". $worksheetLine . "' data-row='". $lineCounter . "' data-counter='$rowNumber'  name='isFriday[]' class='' value='$isFriday' $isFridayStr onchange='updateField(this);'>";
				  	  $line["isSaturday"] = "<input type=checkbox id='field-sat-". $worksheetLine . "' data-index='sat' data-name='sat' data-line='". $worksheetLine . "' data-row='". $lineCounter . "' data-counter='$rowNumber'  name='isSaturday[]' class='' value='$isSaturday' $isSaturdayStr onchange='updateField(this);'>";
				  	  $line["isSunday"] = "<input type=checkbox id='field-sun-". $worksheetLine . "' data-index='sun' data-name='sun' data-line='". $worksheetLine . "' data-row='". $lineCounter . "' data-counter='$rowNumber'  name='isSunday[]' class='' value='$isSunday' $isSundayStr onchange='updateField(this);'>";
				  	  $line["length"] = "<div class='form-group'><input type=text class='form-control input-sm' id='field-length-". $worksheetLine . "' value='$seconds' size='3' name='length[]'  data-index='length' data-name='length' data-line='". $worksheetLine . "' data-row='". $lineCounter . "' data-counter='$rowNumber' onchange='updateField(this);'></div>";
				  	  $line["rate"] = "<div class='form-group'><input type=text class='form-control input-sm' id='field-rate-". $worksheetLine . "' data-index='rate' data-name='rate' data-line='". $worksheetLine . "' data-row='". $lineCounter . "' data-counter='$rowNumber' value='$rate' size='5' name='rate[]' onchange='updateField(this);'></div>";
				  	  $line["aqhRating"] = "<div class='form-group'><input type=text class='form-control input-sm' id='field-aqh-". $worksheetLine . "' value='$aqhRating' size='4' name='aqh[]' data-index='aqhRating' data-name='aqh' data-line='". $worksheetLine . "' data-row='". $lineCounter . "' data-counter='$rowNumber' onchange='updateField(this);'></div>";
				  	  $line["cpp"] = "<input type=text class='form-control input-sm' id='field-cpp-". $worksheetLine . "' value='$cpp' size='4' name='cpp[]' tabindex='-1'  data-name='cpp' data-line='". $worksheetLine . "' data-index='cpp' readonly></div>";
				  	  $line["impact"] = "<div class='form-group'><input type=text class='form-control input-sm id='field-impact-". $worksheetLine . "'' value='$impact' size='4' name='impact[]' data-index='impact' data-name='impact' data-line='". $worksheetLine . "' data-row='". $lineCounter . "' data-counter='$rowNumber' onchange='updateField(this);'></div>";
				  	  $line["cpm"] = "<input type=text class='form-control input-sm' id='field-cpm-". $worksheetLine . "' value='$cpm' id='field-cpm-". $worksheetLine . "' size='4'  data-index='cpm' data-name='cpm' data-line='". $worksheetLine . "' data-row='". $lineCounter . "' data-counter='$rowNumber' name='cpm[]' tabindex='-1' readonly>";
				  	  $line["comments"] = "<input type=text class='form-control input  input-sm' id='field-comments-". $worksheetLine . "' size=40 value='$comments' name='comments[]' data-index='comments' data-name='comments' data-line='". $worksheetLine . "' data-row='". $lineCounter . "' data-counter='$rowNumber'  onchange='updateField(this);'>";
				  	  $line["copy"] = "<input type=checkbox class='centered' id='field-copy-". $worksheetLine . "' data-index='copy' data-name='copy' data-line='". $worksheetLine . "' data-row='". $lineCounter . "' data-counter='$rowNumber'  name='isCopy[]' value='$isCopy' $isCopyStr onchange='updateField(this);'>";
				  	  $line["bold"] = "<input type=checkbox class='centered' id='field-bold-". $worksheetLine . "' data-index='bold' data-name='bold' data-line='". $worksheetLine . "' data-row='". $lineCounter . "' data-counter='$rowNumber'  name='isBold[]' value='$isBold' $isBoldStr onchange='updateField(this);'>";
				  	  $line["delete"] = "<input type=checkbox class='centered center' id='field-delete-". $worksheetLine . "' data-index='delete' data-name='delete' data-line='". $worksheetLine . "' data-row='". $lineCounter . "' data-counter='$rowNumber'  name='isDeleted[]' value='$isDeleted' $isDeletedStr onchange='updateField(this);'>";


				  	  $line["line"] = $worksheetLine;
//				  	  $line["week"] = $wsWeeks[$worksheetLine];
				  	  
				  	  foreach ($wsWeeks[$worksheetLine] as $wsWeek=>$wsWeekValue) {
				  	  
				  	  	$line["week"][$wsWeek] = "<input type=text class='form-control input-sm' id='field-week-". $worksheetLine . "-$wsWeek' value='" . $wsWeekValue . "' name='week[". $worksheetLine . "][$wsWeek]' size='3' data-index='field-week-". $worksheetLine . "-$wsWeek' data-name='week' data-line='". $worksheetLine . "' data-row='". $lineCounter . "' data-counter='$rowNumber' data-week='$wsWeek' onchange='updateField(this);'>";

				  	  }

				  	  if (count($wsWeeks) == 0) {

				  	  	for($wsWeek=1; $wsWeek<=$numberOfWeeks; $wsWeek++) {
				  	  
				  	  		$line["week"][$wsWeek] = "<input type=text class='form-control input-sm' id='field-week-". $worksheetLine . "-$wsWeek' value='0' name='week[". $worksheetLine . "][$wsWeek]' size='3' data-index='field-week-". $worksheetLine . "-$wsWeek' data-name='week' data-line='". $worksheetLine . "' data-row='". $lineCounter . "' data-counter='$rowNumber' data-week='$wsWeek' onchange='updateField(this);'>";

				  	  		}
					  	  
				  	  }

/*
				  	  $weekCounter = 1;
				  	  foreach ($worksheetWeeks[$worksheetLine] as $week) {
					  	  $line["week"][$weekCounter] = $week["weekValue"];
					  	  $weekCounter++;
				  	  }
*/


				  	  
					  array_push($lines, $line);
					  $lineCounter++;
					  $rowNumber++;
				  }

				  $this->vars["response"] = json_encode(array("data"=>$lines), JSON_HEX_QUOT | JSON_HEX_TAG);
				  
				  error_log("JSON: " . $this->vars["response"] );
				 
				  $this->view = "ajax-response";	

				  return true;
				  
			  }			  
		  }		
		  		
		  		  
		  else if ($params[2] == "add") {
		  		  
			  $bhUser = new \BH\user($this->db, $this->userID); 
			  
			  $this->agencyID = $bhUser->getAgencyID();
		  	
			  $form = new \forms($this->db);
					  
			  $campaignID = $params[3];
		
			  $newWorksheet = $form->map($this->fields, $_POST);
		
			  $worksheet = new \BH\tv($this->db, $this->agencyID, $this->userID);
		
			  $worksheetID =  $worksheet->addWorksheet($newWorksheet);

			  $this->view = "ajax-response";	
			  
			  $response = array();	
		
			  if ($worksheetID>0) {
			  		$market = array();
			  		$market["worksheetID"] = $worksheetID;
			  		foreach ($_POST["vendorReps"] as $marketRep) {
				  		$market["marketID"] = $marketRep;
				  		$worksheet->saveMarket($worksheetID, $market);
			  		}
			  		$response["message"] = "Added!";
			  		$response["newWorksheet"] = $worksheet->getWorksheet($worksheetID);
			  		$this->vars["response"] = json_encode($response);
				  	return true;
			  }
			  else {
			  		if ($newWorksheet["name"] != "") {
				  		$response["message"] = "<span style='color:#f00'>Not Added! Worksheet Already Exists.</span>";
				  	}
				  	else {
				  		$response["message"] = "<span style='color:#f00'>Not Added! Worksheet Name Required.</span>";					  	
				  	}
			  		$response["error"] = true;
			  		$response["field"] = "worksheet-name";						
			  		$this->vars["response"] = json_encode($response);		
				  	return true;
			  }
		  }
		  
		  else if ($params[2] == "cell") {
			  if ($params[3] == "update") {
			  		  
				  $bhUser = new \BH\user($this->db, $this->userID); 
				  
				  $this->agencyID = $bhUser->getAgencyID();
			  	
				  $form = new \forms($this->db);
						  
				  $worksheetID = $params[4];
			
				  $cell = array();

				  error_log("Updating Cell Count: " . count($_POST["changes"]));
				  
				  $data = $_POST["data"];
				  
				  foreach($_POST["changes"] as $change) {
				  
				  	  $cell["line"] = intval($data[$change[0]]["lineNumber"]);
				  	  $field = explode(".", $change[1],2);
				  	  $cell["field"] = $field[0];
				  	  $cell["number"] = $field[1];
				  	  $cell["prev"] = $change[2];
				  	  $cell["new"] = $change[3];
				  					  
					  $worksheet = new \BH\tv($this->db, $this->agencyID, $this->userID);
				
					  if ($cell["field"] == "week") {
						  $fieldID =  $worksheet->updateWeekByWorksheetIDandLine($worksheetID, $cell["line"], array("weekNumber"=>$cell["number"], "weekValue"=>$cell["new"]));
					  }
					  else {
					  		if ($cell["field"] == "vendor") {
						  		$cell["field"] = "vendorID";
						  		$cell["new"] = $_POST["vendors"][$cell["new"]];
					  		}
					  		else {
								$cell["field"] = $this->cols[$field[0]];
							}
						  	if ($cell["field"]) {
							  	  if ($cell["new"]=="true") {
									  	  $cell["new"]=1;
									  	  }
							  	  else if ($cell["new"]=="false") {
								  	  $cell["new"]=0;
							  	  }
							  	  
								  $fieldID =  $worksheet->updateCellByWorksheetIDandLine($worksheetID, $cell["line"], $cell);					  
							}
					  }

					  $worksheet->totalSpotsAndSpend($worksheetID);
				  
					  $this->view = "ajax-response";	
					  
					  $response = array();	
				
	//				  error_log("Data:" . print_r($_POST["changes"], true));
					  	
					  if ($fieldID>0) {
						  	if ($cell["line"] == 0) {
							  		$response["newLine"] = true;
							  		$response["rowNumber"] = $change[0];
							  		$response["lineNumber"] = $worksheet->getLineByID($fieldID);
						  	}
						  	else {
							  		$reponse["newLine"] = false;
						  	}
					  		$response["message"] = "Changes Saved! (" . (intval($cell["line"])) . "," . $cell["field"] . $cell["number"] . ")";
					  		$this->vars["response"] = json_encode($response);
					  }
					  else {
					  		if ($cell["new"] == $cell["prev"]) {
						  		$response["message"] = "No Changes To Save.";
					  		}
					  		else {
						  		$response["message"] = "<span style='color:#f00'>Error Saving Changes!</span>";
						  		$response["error"] = true;
						  		error_log("Error: " . $cell["line"] . "-" . $cell["new"] . " = " . $cell["prev"]);
						  	}
					  		$this->vars["response"] = json_encode($response);		
					  }
				  }
			  }
			  
			  return true;
		  }
		  
		  else if ($params[2] == "line") {
			  if ($params[3] == "add") {
				  $bhUser = new \BH\user($this->db, $this->userID); 
				  
				  $this->agencyID = $bhUser->getAgencyID();
			  	
				  $form = new \forms($this->db);
						  
				  $worksheetID = $params[4];
				  
				  $lines = 0;
				  $lineCount = 0;
				  $copied = 0;
		
				  $worksheet = new \BH\tv($this->db, $this->agencyID, $this->userID);
				  		  
				  $line = $form->map($this->cols, $_POST["data"]);
				  $lineNumber  = $line["worksheetLine"];
					 
				  $lineID =  $worksheet->saveLineByWorksheetID($worksheetID, $lineNumber, $line);
				  $weekID =  $worksheet->updateWeeksByWorksheetIDandLine($worksheetID, $lineNumber, $_POST["data"]["week"]);
				  $lineCount++;
					 				  

				  if ($worksheet->copyLinesByWorksheetID($worksheetID)) {
					  $copied = true;
				  }	

				  $worksheet->totalSpotsAndSpend($worksheetID);
				  			  
				  $this->view = "ajax-response";	
				  
				  $response = array();	
			
				  if ($lineCount > 0) {
				  		$response["message"] = "$lineCount Line(s) Added!"; 
				  		$this->vars["response"] = json_encode($response);
					  	return true;
				  }
				  else {
				  		$response["message"] = "Nothing Added.";
				  		$response["error"] = false;
				  		$this->vars["response"] = json_encode($response);		
					  	return true;
				  }
			  }
			  else if ($params[3] == "remove") {
				  $bhUser = new \BH\user($this->db, $this->userID); 
				  
				  $this->agencyID = $bhUser->getAgencyID();
			  	
				  $form = new \forms($this->db);
						  
				  $worksheetID = $params[4];
			
				  $line = intval($_POST["line"]);
				  $amount = intval($_POST["amount"]);
			
				  $worksheet = new \BH\tv($this->db, $this->agencyID, $this->userID);
			
				  $lineCounter = 0;
				  for ($i=$line; $i<($line+$amount); $i++) {
					  $lineID =  $worksheet->removeLineByWorksheetID($worksheetID, $i);
					  if ($lineID > 0) {
						  	$lineCounter++;
					  }
				  }

				  $worksheet->totalSpotsAndSpend($worksheetID);

				  $this->view = "ajax-response";	
				  
				  $response = array();	
			
				  if ($lineID>0) {
				  		$response["message"] = "$lineCounter Line(s) Removed!";
				  		$this->vars["response"] = json_encode($response);
					  	return true;
				  }
				  else {
				  		$response["message"] = "<span style='color:#f00'>Error Removing Lines!</span>";
				  		$response["error"] = true;
				  		$this->vars["response"] = json_encode($response);		
					  	return true;
				  }
			  }

		  }
		  
		  else if ($params[2] == "lines") {
			  if ($params[3] == "update") {
				  $bhUser = new \BH\user($this->db, $this->userID); 
				  
				  $this->agencyID = $bhUser->getAgencyID();
			  	
				  $form = new \forms($this->db);
						  
				  $worksheetID = $params[4];
				  
				  $lines = 0;
				  $copied = 0;
		
				  $worksheet = new \BH\tv($this->db, $this->agencyID, $this->userID);
				  
				  foreach ($_POST["data"] as $data) {
					  $line = $form->map($this->cols, $data);
					  $lineNumber  = $line["worksheetLine"];
					  if (($lineNumber <= $_POST["maxLineNumber"]) and ($lineNumber > 0)) {
						 
						  $lineID =  $worksheet->saveLineByWorksheetID($worksheetID, $lineNumber, $line);
						  $weekID =  $worksheet->updateWeeksByWorksheetIDandLine($worksheetID, $lineNumber, $data["week"]);
						  $lines++;
					  }
					 				  
				  }

				  if ($worksheet->copyLinesByWorksheetID($worksheetID)) {
					  $copied = true;
				  }	

				  $worksheet->totalSpotsAndSpend($worksheetID);
				  			  
				  $this->view = "ajax-response";	
				  
				  $response = array();	
			
				  if ($lines > 0) {
				  		$response["message"] = "$lines Line(s) Saved!"; 
				  		$this->vars["response"] = json_encode($response);
					  	return true;
				  }
				  else {
				  		$response["message"] = "Nothing Saved.";
				  		$response["error"] = false;
				  		$this->vars["response"] = json_encode($response);		
					  	return true;
				  }
			  }
			  else if ($params[3] == "remove") {
				  $bhUser = new \BH\user($this->db, $this->userID); 
				  
				  $this->agencyID = $bhUser->getAgencyID();
			  	
				  $form = new \forms($this->db);
						  
				  $worksheetID = $params[4];
			
				  $line = intval($_POST["line"]);
				  $amount = intval($_POST["amount"]);
			
				  $worksheet = new \BH\tv($this->db, $this->agencyID, $this->userID);
			
				  $lineCounter = 0;
				  for ($i=$line; $i<($line+$amount); $i++) {
					  $lineID =  $worksheet->removeLineByWorksheetID($worksheetID, $i);
					  if ($lineID > 0) {
						  	$lineCounter++;
					  }
				  }

				  $worksheet->totalSpotsAndSpend($worksheetID);

				  $this->view = "ajax-response";	
				  
				  $response = array();	
			
				  if ($lineID>0) {
				  		$response["message"] = "$lineCounter Line(s) Removed!";
				  		$this->vars["response"] = json_encode($response);
					  	return true;
				  }
				  else {
				  		$response["message"] = "<span style='color:#f00'>Error Removing Lines!</span>";
				  		$response["error"] = true;
				  		$this->vars["response"] = json_encode($response);		
					  	return true;
				  }
			  }

		  }
		  
		  else {
			  return false;
		  }

	  }
	  else {
		 return false;
	  }
	}



}
?>
