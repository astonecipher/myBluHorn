<?php

/**
 * FILELOGIX BLUHORN PROGRAMS CLASS
 *  
 * @author Wes Benwick
 * @link http://www.filelogix.com
 * @license Part of Filelogix usage license
 */ 
 
namespace FLX\Controllers;

class programs extends \controller
{  
    // Will store database connection here
	private $db;
	private $connID;
	private $sessionID;
	private $userID;
	private $agencyID;
	private $view = "worksheet";
	private $auth;
	private $vars = array("activeSideBar"=>array("programs"=>"active"));
	private $lists;
	private $registration;
	private $request;
	private $editor;
	private $dayparts = array("none"=>"No Daypart", "em"=>"EM", "da"=>"DA", "ef"=>"EF", "en"=>"EN", "pa"=>"PA", "pr"=>"PR", "lf"=>"LF", "ln"=>"LN", "ov"=>"OV", "sp"=>"SP", "ro"=>"RO"); 
	private $fields = array("clientID"=>"clientID", "programName"=>"name", "jobNumber"=>"jobNumber", "agencyCommission"=>"commission", "remarks"=>"remarks", "flightStart"=>"flightStart", "flightEnd"=>"flightEnd", "isActive"=>"isActive", "agencyID"=>"agencyID");

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
	  $this->vars["dayparts"] = $this->dayparts;

	  error_log("program Init");

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
	 
	  $this->topCharts();
	 
	  $this->vars["sideNav"]="Dashboard";
	  $this->vars["sessionID"]= $this->sessionID;

	  $this->vars["username"] = "@" . $this->auth->getShortName($this->userID);

	  
	  $this->dflt($this->request->getArgs());
	  		
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

	public function dflt($params) {
		
	  if ($this->auth->validate($this->userID)) {

		$this->vars["active"] = "dashboard";

		  $program = array();
				  
		  $this->vars["program"] = $program;
		
		  $this->view = "programs";

		  $bhUser = new \BH\user($this->db, $this->userID); 
		  
		  $this->agencyID = $bhUser->getAgencyID();
		  
		  error_log("BH agencyID:" . $this->agencyID);

		  $this->vars["agencyID"] = $this->agencyID;		
		  
	      $programs = new \BH\programs($this->db, $this->agencyID, $this->userID);

		  switch ($params[1]) {
			  case "pending":
			  	$this->vars["programs"] = $program->getPendingprograms();
 			    $this->vars["listType"] = "Pending";		
			  	break;
			  case "active":
			  	$this->vars["programs"] = $program->getActiveprograms();		
 			    $this->vars["listType"] = "Active";		
			  	break;
			  case "archived":
			  	$this->vars["programs"] = $program->getArchivedprograms();		
 			    $this->vars["listType"] = "Archived";		
			  	break;		
			  case "all":
			  default:
 			    $this->vars["listType"] = "All";		
			  	$this->vars["programs"] = $programs->getAllPrograms();		

		  }
		
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
	
		$this->view = "programs";			

		return true;
	 }
	 else {
		 return false;
	 }
	}

	public function active() {
		
	if ($this->auth->validate($this->userID)) {
	
		$this->view = "programs";			

		return true;
	 }
	 else {
		 return false;
	 }
	}

	public function pending() {
		
	if ($this->auth->validate($this->userID)) {
	
		$this->view = "programs";			

		return true;
	 }
	 else {
		 return false;
	 }
	}

	public function archived() {
		
	if ($this->auth->validate($this->userID)) {
	
		$this->view = "programs";			

		return true;
	 }
	 else {
		 return false;
	 }
	}

	public function create($params) {
		
	if ($this->auth->validate($this->userID)) {

		$form = new \forms($this->db);
						
	   	$newprogram = $form->map($this->fields, $_POST);
	   	  
		$bhUser = new \BH\user($this->db, $this->userID); 
		  
		$this->agencyID = $bhUser->getAgencyID();
		  
	    error_log("BH agencyID:" . $this->agencyID);

	    $client = new \BH\client($this->db, $this->agencyID, $this->userID);
	
		$this->vars["clients"] = $client->getAllClients();
		  
	    $program = new \BH\programs($this->db, $this->agencyID, $this->userID);
	
		$this->view = "program-create";	
		
		if (($params[2] == "new") and ($newprogram["name"] != "") and (intval($newprogram["clientID"])>0)) {
			
			$programID =  $program->addprogram($newprogram);
	
			$this->vars["active"] = "programs";		
			
			if ($programID>0) {			
				$this->vars["alert"]["success"] = "program Added Succesfully. (id: $programID)";
				$this->vars["program"] = $program->getprogram($programID);
				$this->view = "program-edit";
				$params[2] = $programID;
				return $this->edit($params);			
			}
			else {			  
				$this->vars["alert"]["error"] = "program Not Added. Name already exists for that Client.";
				$this->vars["program"] = $newprogram;
				$this->vars["programNameError"] = true;
				$this->view = "program-create";
	
			}
			
			return true;	
		}
		else {
			return true;
		}
	 }
	 else {
		 return false;
	 }
	}
	
	public function edit($params) {
		
	if ($this->auth->validate($this->userID)) {
	
		$this->view = "program-edit";		
		
		$form = new \forms($this->db);
		
		$programID	= $params[2];				
						
	   	$newprogram = $form->map($this->fields, $_POST);
	   	  
		$bhUser = new \BH\user($this->db, $this->userID); 
		  
		$this->agencyID = $bhUser->getAgencyID();

		$this->vars["agencyID"] = $this->agencyID;
		  
	    error_log("BH agencyID:" . $this->agencyID);
	    	    
	    $client = new \BH\client($this->db, $this->agencyID, $this->userID);
	
		$this->vars["clients"] = $client->getAllClients();
		  
	    $program = new \BH\programs($this->db, $this->agencyID, $this->userID);	
	    $market = new \BH\market($this->db, $this->agencyID, $this->userID);	
	    $vendor = new \BH\vendor($this->db, $this->agencyID, $this->userID);	
	    $worksheet = new \BH\worksheet($this->db, $this->agencyID, $this->userID);	
	    $demographics = new \BH\demographics($this->db, $this->agencyID, $this->userID);	
	
		$this->vars["program"] = $program->getProgram($programID);
		$this->vars["rates"] = $program->getRatesByProgram($programID);
		$this->vars["ratings"] = $program->getRatingsByProgram($programID);
		$this->vars["marketTypes"] = $market->getMarketTypes();
		$this->vars["markets"] = $market->getAllMarkets(true);
//		$this->vars["worksheets"] = $worksheet->getAllWorksheetsByProgramID($programID);
		$this->vars["demographics"] = $demographics->getAllDemographics(1);
		
		return true;
	 }
	 else {
		 return false;
	 }
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

	public function topCharts() {

		$bhUser = new \BH\user($this->db, $this->userID); 
		  
		$this->agencyID = $bhUser->getAgencyID();

		$this->vars["agencyID"] = $this->agencyID;
	
		$campaign = new \BH\campaign($this->db, $this->agencyID, $this->userID);		
	    $worksheet = new \BH\worksheet($this->db, $this->agencyID, $this->userID);		

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

	

	public function listOfMonths($numberOfMonths) {
		
		$months = array();
		
		for ($i = 1; $i <= $numberOfMonths; $i++) {
			$month = date("Y-m", strtotime("-$i months"));
			$months[$month] = 0;
		}
		
		return $months;
	}	
	
	public function ajax($params) {
	
	 error_log("program AJAX");
	
	 if ($this->auth->validate($this->userID)) {
		  
		  if ($params[2] == "save") {
		  		  
			  $bhUser = new \BH\user($this->db, $this->userID); 
			  
			  $this->agencyID = $bhUser->getAgencyID();
		  	
			  $form = new \forms($this->db);
		
			  $program = array();
			  
			  $programID = $params[3];
		
			  $updatedprogram = $form->map($this->fields, $_POST);
		
			  $program = new \BH\programs($this->db, $this->agencyID, $this->userID);
		
			  $programID =  $program->saveprogram($programID, $updatedprogram);

			  $this->view = "ajax-response";	
			  
			  $response = array();	
		
			  if ($programID>0) {
			  		$response["message"] = "Saved!";
			  		$this->vars["response"] = json_encode($response);
				  	return true;
			  }
			  else {
			  		$response["message"] = "<span style='color:#f00'>Not Saved! program Name Already Exists.</span>";
			  		$response["error"] = true;
			  		$response["field"] = "program-name";						
			  		$this->vars["response"] = json_encode($response);		
				  	return true;
			  }
		  }

		  else if ($params[2] == "search") {
		  		  
			  $bhUser = new \BH\user($this->db, $this->userID); 
			  
			  $this->agencyID = $bhUser->getAgencyID();
		  	
			  $searchType = $params[3];
			  $searchBy = $params[4];
			  $searchID = $params[5];
				
			  $program = new \BH\programs($this->db, $this->agencyID, $this->userID);
		
			  error_log("Search: " . $searchBy . " " . $searchID);

			  $programs = array();
			  
			  $searchValues = explode(",",$searchID);
			  
			  if ($searchType == "programs") {
				  $results =  $program->searchprograms($searchBy, $searchValues);
			  }
			  
			  else if ($searchType == "vendors") {
				  
			  }
			  
			  else if ($searchType == "markets") {
				  
			  }
			  
			  else {
				  $results =  $program->searchprograms($searchBy, $searchValues);
			  }
			  
			  $this->view = "ajax-response";	
			  
			  $response = array();	

			  if (count($results)>0) {
			  	
			  		if (count($results)>1) {
				  		$resultsStr = " " . ucfirst($searchType);
			  		}
			  		else {
				  		$resultsStr = " " . rtrim(ucfirst($searchType),'s');
			  		}
			  		
			  		$response["message"] = "Found " . count($results) . $resultsStr;
			  		$response["results"] = $results;
			  		$this->vars["response"] = json_encode($response);
				  	return true;
			  }
			  else {
			  		$response["message"] = "No " . ucfirst($searchType) . " Found";
			  		$response["results"] = "";
			  		$this->vars["response"] = json_encode($response);	
				  	return true;
			  }
		  }

		  else if ($params[2] == "delete") {
		  		  
			  $bhUser = new \BH\user($this->db, $this->userID); 
			  
			  $this->agencyID = $bhUser->getAgencyID();
		  	
			  $form = new \forms($this->db);
					  
			  $programID = $params[3];
				
			  $program = new \BH\programs($this->db, $this->agencyID, $this->userID);
		
			  $programID =  $program->deleteprogram($programID);

			  $this->vars["active"] = "programs";		
			  $this->view = "ajax-response";	
			  
			  $response = array();	
		
			  if ($programID>0) {
			  		$response["message"] = "program Deleted!";
			  		$this->vars["response"] = json_encode($response);
				  	return true;
			  }
			  else {
			  		$response["message"] = "<span style='color:#f00'>Error! Unable to delete program.</span>";
			  		$response["error"] = true;
			  		$this->vars["response"] = json_encode($response);		
				  	return true;
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
