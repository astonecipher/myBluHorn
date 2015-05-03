<?php

/**
 * FILELOGIX HOME CLASS
 *  
 * @author Wes Benwick
 * @link http://www.filelogix.com
 * @license Part of Filelogix usage license
 */ 
 
namespace FLX\Controllers;

class home extends \controller
{  
    // Will store database connection here
	private $db;
	private $connID;
	private $sessionID;
	private $userID;
	private $view = "home";
	private $auth;
	private $vars = array();
	private $lists;
	private $registration;
	private $request;
	private $editor;

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
	 
	  
	  $this->auth = new \auth($this->db);
	  
	  if (!$this->auth->validate($this->userID)) {

		  
		  $_SESSION["returnURL"] = $this->request->getRequest();

//		  $this->view = "login";
		  $this->view = $this->auth->view();
		  $this->vars = $this->auth->data();
//		  $this->vars["username"] = 
		  
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

//	  session_regenerate_id(false);

	  
	  unset($_SESSION["returnURL"]);
	  
	  $this->lists = new \lists($this->db);
	  $this->editor = new \editor($this->db);
	 
	  $this->vars["sideNav"]="Dashboard";
	  $this->vars["sessionID"]=$this->sessionID;

	  $this->vars["userID"] = $this->userID;
	  $this->vars["username"] = $this->auth->getUsernameMD5($this->userID);
	  $this->vars["shortname"] = "@" . $this->auth->getShortName($this->userID);
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
	
	public function dflt() {
	  if ($this->auth->validate($this->userID)) {

		$this->vars["active"] = "dashboard";
		$this->vars["activeSideBar"] = array("dashboard"=>"active");
		
		$this->view = "home";
		
		$bhUser = new \BH\user($this->db, $this->userID); 

		$this->agencyID = $bhUser->getAgencyID();

		$agency = new \BH\agency($this->db, $this->agencyID, $this->userID); 		  
		  
		$this->vars["agencyID"] = $this->agencyID;		
		$this->vars["agency"] = $agency->getAgency($this->agencyID);		
		$this->vars["user"] = $bhUser->getAgencyUser($this->userID, $this->agencyID);		
		  
	    $campaign = new \BH\campaign($this->db, $this->agencyID, $this->userID);		
	    $worksheet = new \BH\worksheet($this->db, $this->agencyID, $this->userID);		

		$fromDate = date("Y-m-d",strtotime("now"));

		$worksheetCount = $worksheet->countWorksheets();

		$this->vars["TVCableRatio"] = $worksheet->countWorksheetsByType(array("TV","Cable"))/$worksheetCount*100;
		$this->vars["RadioRatio"] = $worksheet->countWorksheetsByType("Radio")/$worksheetCount*100;
		$this->vars["PrintDigitalRatio"] = $worksheet->countWorksheetsByType(array("Prnt","Digital"))/$worksheetCount*100;
		$this->vars["OutdoorRatio"] = $worksheet->countWorksheetsByType("Outdoor")/$worksheetCount*100;
		$this->vars["recentCampaigns"] = $campaign->getRecentCampaigns();
		$this->vars["recentWorksheets"] = $worksheet->getRecentWorksheets();

		$campaignCounts = $campaign->countCampaignsByMonth($fromDate,15);
		$buysCounts = $worksheet->countBuysByMonth($fromDate,15);
		$adsCounts = $worksheet->countLinesByMonth($fromDate,15);
		
		$campaignsByMonth = $this->listOfMonths(15);
		$buysByMonth = $this->listOfMonths(15);
		$adsByMonth = $this->listOfMonths(15);
		
		$this->isSideNav();			

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
	
	public function players() {
		
	if ($this->auth->validate($this->userID)) {
	
		
		return true;
	 }
	 else {
		 return false;
	 }
	}

	public function activate($params) {

	  if ($this->auth->validate($this->userID)) {

		return $this->home($params);
		  
	  }
	  
	  else {
	  
	  	error_log("Activating new user... " . $_POST["emailAddress"]);

	  	$users = new \users($this->db);

		$this->vars["emailAddress"] = $_POST["emailAddress"];
		
		if ($params[2]) {
			$this->vars["activationCode"] = $params[2];
		}
		else {
			$this->vars["activationCode"] = $_POST["activationCode"];
		}
				
		if ($_POST["emailAddress"] != "") {
			$this->auth->logout();
			
			$username = $users->activateWithActivationCode($_POST["emailAddress"], $_POST["password"], $_POST["activationCode"]);
			if ($username) {

				$_POST["username"] = $username;

				error_log("User Activated.  Logging In Automatically...");

				return $this->login($params);
	
				return true;
			}
			else {
				$this->view="activate";
				$this->vars["alertError"]=true;
				$this->vars["errorMsg"]="An error occurred. Please Try Again.";
				if (($_POST["emailAddress"] != "") and (strlen($_POST["password"]) < 6)) {
					$this->vars["errorMsg"]="Your password is too short.";				
				}
				
				return true;
			}
		}

		$this->view="activate";
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
	  	
	  	$this->vars["emailAddress"] = $_POST["emailAddress"];
	  	$this->vars["firstName"] = $_POST["firstName"];
	  	$this->vars["lastName"] = $_POST["lastName"];
	  	$this->vars["organization"] = $_POST["organization"];
	  	$this->vars["phoneNumber"] = $_POST["phoneNumber"];

		if (($_POST["emailAddress"] != "") and ($_POST["firstName"] != "") and ($_POST["lastName"] != "")) {

			$this->auth->logout();

			if ($users->emailExists($_POST["emailAddress"])) {
				
				$this->view="register";
				$this->vars["alertError"]=true;
				$this->vars["errorMsg"]="That email address has already been used.";
				$this->vars["signUpHide"]="";
			}
			else {
				if ($_POST["organization"] == "") {
					$this->view="register";
					$this->vars["alertError"]=true;
					$this->vars["errorMsg"]="Please let us know which organization you represent.";
					$this->vars["signUpHide"]="";					
				}
				else if ($_POST["phoneNumber"] == "") {
					$this->view="register";
					$this->vars["alertError"]=true;
					$this->vars["errorMsg"]="Please share a phone number we can use to contact you.";
					$this->vars["signUpHide"]="";										
				}
				else {
					$users->signup($_POST["emailAddress"], $_POST["firstName"], $_POST["lastName"], $_POST["organization"], $_POST["phoneNumber"]);
					$this->view="register";
					$this->vars["alertSuccess"]=true;
					$this->vars["successMsg"]="Thank You! Your request is being reviewed.";
					$this->vars["signUpHide"]="hide";
				}
				return true;
			}
		}
		
		else {
			if ($_POST["submit"]) {
				$this->vars["alertError"]=true;
				$this->vars["errorMsg"]="Please answer all of the fields.";
			}							
		}

		$this->view="register";
		$this->vars["navHomeActive"]=false;
		
		return true;		  
		  
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

	public function listOfMonths($numberOfMonths) {
		
		$months = array();
		
		for ($i = 1; $i <= $numberOfMonths; $i++) {
			$month = date("Y-m", strtotime("-$i months"));
			$months[$month] = 0;
		}
		
		return $months;
	}

	
	public function data() {
		
		return $this->vars;
	}


	public function view() {
	
		if ($_GET["mobile"] == "yes") {
			return "mobile";
		}
		else {		
		    error_log("Home controller, View: " . $this->view);
			return $this->view;
		}
	}
	
	public function transfer() {
		
		return $this->transfer;
	}
	
	public function ajax($params) {
	
	 error_log("Home AJAX");
	
	 if ($this->auth->validate($this->userID)) {
		  
		  if ($params[2] == "sidebar") {
		  		  
			  $bhUser = new \BH\user($this->db, $this->userID); 
			  
			  $this->agencyID = $bhUser->getAgencyID();
		  	
			  $status = $bhUser->showSideNav($params[3]);

			  $this->view = "ajax-response";	
			  
			  $response = array();	
		
			  if ($status>=0) {
			  		$response["message"] = "Saved!";
			  		$this->vars["response"] = json_encode($response);
				  	return true;
			  }
			  else {
			  		$response["message"] = "<span style='color:#f00'>Not Saved.</span>";
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
