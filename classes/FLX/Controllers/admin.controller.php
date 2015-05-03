<?php

/**
 * FILELOGIX ADMIN CLASS
 *  
 * @author Wes Benwick
 * @link http://www.filelogix.com
 * @license Part of Filelogix usage license
 */ 
 
namespace FLX\Controllers;

class admin extends \controller
{  
    // Will store database connection here
	private $db;
	private $connID;
	private $sessionID;
	private $userID;
	private $view = "";
	private $auth;
	private $vars = array();
	private $lists;
	private $registration;
	private $request;
	private $editor;
	private $permissions;
	private $fields = array();

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
	  
	  $this->fields["agency"] = array("agencyName"=>"name", "contactName"=>"contactName", "emailAddress"=>"emailAddress", "address"=>"address", "phoneNumber"=>"phoneNumber", "faxNumber"=>"faxNumber", "website"=>"website", "comments"=>"comments","agencyID"=>"id");
	  
	  $this->auth = new \auth($this->db);
	  
	  if (!$this->auth->validate($this->userID)) {

		  
		  $_SESSION["returnURL"] = $this->request->getRequest();

		  $this->view = "login";
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

	  $this->permissions = $this->auth->getAccessByUserID($this->userID, "BH_ADMIN");
	  
	  error_log("BH_ADMIN: " . $this->permissions[0]["view"]);
		  
	  if ($this->permissions[0]["view"] != true) {
		  
		  return false;
	  }

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

	public function user($params) {
	  if ($this->auth->validate($this->userID)) {

		  if ($params[2] == "edit") {
			  if ($this->permissions[0]["edit"] == true) {
		
					$bhUser = new \BH\user($this->db, $this->userID); 
					  
					$this->agencyID = $bhUser->getAgencyID();
			
					$this->vars["agencyID"] = $this->agencyID;
			
					$this->vars["user"] = $bhUser->getUser(intval($params[3]));	
			
				    $agency = new \BH\agency($this->db, $this->agencyID, $this->userID);
			
					$this->vars["agencies"] = $agency->getAllAgencies();	
					
					$this->vars["active"] = "user";		
					  
					$this->view = "admin-user-edit";
					
					return true;		
				  }
				  else {
					 return false;
				  }
			}
	   }
	}

	public function agency($params) {
	  if ($this->auth->validate($this->userID)) {

		  if ($params[2] == "edit") {
			  	if ($this->permissions[0]["edit"] == true) {
		
					$bhUser = new \BH\user($this->db, $this->userID); 
					  
					$this->agencyID = $bhUser->getAgencyID();
			
					$this->vars["agencyID"] = $this->agencyID;
			
					$this->vars["user"] = $bhUser->getUser(intval($params[3]));	
	
				    $agency = new \BH\agency($this->db, $this->agencyID, $this->userID);
					
					$this->vars["agencyUsers"] = $agency->getAllAgencyUsers(intval($params[3]));	
						
					$this->vars["agency"] = $agency->getAgency(intval($params[3]));	
					
					$this->vars["active"] = "admin";		
					  
					$this->view = "admin-agency-edit";
					
					return true;		
				  }
				  else {
					 return false;
				  }
		  }
		  else if ($params[2] == "create") {
			  	
			  if ($this->permissions[0]["write"] == true) {

				  	$form = new \forms($this->db);
					
			      	$agency = array();
					
			   	  	$newAgency = $form->map($this->fields["agency"], $_POST);
		
					if (($newAgency["id"] == "new") and ($newAgency["name"] != "") and ($newAgency["contactName"] != "")) {
						
							$newAgency["id"] = 0;
						
							$admin = new \BH\admin($this->db, $this->agencyID, $this->userID);
							
							$agencyID =  $admin->addAgency($newAgency);
					
							$this->vars["active"] = "admin";		
							
							if ($agencyID>0) {			
								$this->vars["alert"]["success"] = "Agency Added Successfully. (id: $agencyID)";
								$this->vars["agency"] = $admin->getAgency($agencyID);
								$this->view = "agency-edit";			
							}
							else {			  
								$this->vars["alert"]["error"] = "Agency Not Added. It appears they already exist.";
								$this->vars["agency"] = $newClient;
								$this->vars["agencyNameError"] = true;
								$this->view = "agency-create";
					
							}
		
					}
					
					$this->vars["active"] = "admin";		
					  
					$this->view = "admin-agency-create";
					
					return true;		
				  }
				  else {
				  
					 return false;
				  }
		  }
	   }
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
		
		$this->view = "admin";
		
		$bhUser = new \BH\user($this->db, $this->userID); 
		  
		$this->agencyID = $bhUser->getAgencyID();
		  
		$this->vars["agencyID"] = $this->agencyID;		
		  
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

	public function inbox($params) {
		
		if ($this->auth->validate($this->userID)) {

			if ($this->permissions[0]["view"] == true) {
			
				$bhAdmin = new \BH\admin($this->db, $this->userID); 
				
				$this->vars["users"] = $bhAdmin->getPendingUsers();
				
				$this->view = "admin-inbox";
				
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
	
	public function users() {
		
	if ($this->auth->validate($this->userID)) {
	
	  if ($this->permissions[0]["view"] == true) {
			
			$bhAdmin = new \BH\admin($this->db, $this->userID); 
			  
			$this->vars["users"] = $bhAdmin->getAllUsers();
			
			$this->view = "admin-users";
			
			return true;
		 }
		 else {
			 return false;
		 }
	  }
	}
	
	public function logs($params) {
		
	if ($this->auth->validate($this->userID)) {
	
	  if ($this->permissions[0]["view"] == true) {

			$logs = new \FLX\logs($this->db, $this->userID); 

		    if ($params[2] == "connection") {
				$this->vars["connection"] = $logs->connection($params[3]);
				
				$this->view = "admin-logs-connection";
				
				return true;			    
		    }
						  
			else {				  
				$this->vars["connections"] = $logs->connections("desc", 0, 200);
				
				$this->view = "admin-logs";
				
				return true;
			}
		 }
		 else {
			 return false;
		 }
	  }
	}

	public function agencies() {
		
	if ($this->auth->validate($this->userID)) {
	
	  if ($this->permissions[0]["view"] == true) {
			
			$bhAdmin = new \BH\admin($this->db, $this->userID); 
			  
			$this->vars["agencies"] = $bhAdmin->getAllAgenciesWithStats();
			
			$this->view = "admin-agencies";
			
			return true;
		 }
		 else {
			 return false;
		 }
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
			
		return $this->view;
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

		  else if ($params[2] == "agency") {
		  		 
		  	if ($params[3] == "save") {		  

			  if ($this->permissions[0]["edit"] == true) {

				  $bhUser = new \BH\user($this->db, $this->userID); 
				  
				  $this->agencyID = $bhUser->getAgencyID();
			  	
				  $form = new \forms($this->db);
						  
				  $agencyID = $params[4];
			
				  $updatedAgency = $form->map($this->fields["agency"], $_POST);
			
				  $admin = new \BH\admin($this->db, $this->agencyID, $this->userID);
			
				  $agencyID =  $admin->saveAgency($agencyID, $updatedAgency);
	
				  $this->vars["active"] = "agency";		
				  $this->view = "ajax-response";	
				  
				  $response = array();	
			
				  if ($agencyID>0) {
				  		$response["message"] = "Saved!";
				  		$this->vars["response"] = json_encode($response);
					  	return true;
				  }
				  else {
				  		$response["message"] = "<span style='color:#f00'>Error! Agency Information Not Saved.</span>";
				  		$response["error"] = true;
				  		$response["field"] = "agency-name";						
				  		$this->vars["response"] = json_encode($response);		
					  	return true;
				  }
			 }
			 
			 else {
			 		$response = array();
			 		
				  	$response["message"] = "<span style='color:#f00'>Error! You don't have permission to make these changes.</span>";
				  	$response["error"] = true;
				  	$this->vars["response"] = json_encode($response);		
					
					return true;				 
			 }
			 
		  }
		  
		  else if ($params[3] == "add") {

			  if ($this->permissions[0]["write"] == true) {
		  		  
				  $bhUser = new \BH\user($this->db, $this->userID); 
				  
				  $this->agencyID = $bhUser->getAgencyID();
			  	
				  $form = new \forms($this->db);
						  			
				  $newAgency = $form->map($this->fields["agency"], $_POST);
			
				  $admin = new \BH\admin($this->db, $this->agencyID, $this->userID);
			
				  $agencyID =  $admin->addAgency($newAgency);
	
				  $this->vars["active"] = "agency";		
				  $this->view = "ajax-response";	
				  
				  $response = array();	
			
				  if ($agencyID>0) {
				  		$response["message"] = "Agency Created!";
				  		$response["agencyID"] = $agencyID;
				  		$this->vars["response"] = json_encode($response);
					  	return true;
				  }
				  else {
				  		$response["message"] = "<span style='color:#f00'>Error! Agency Information Not Saved.</span>";
				  		$response["error"] = true;
				  		$response["field"] = "agency-name";						
				  		$this->vars["response"] = json_encode($response);		
					  	return true;
				  }
			  }
		  }
				  

		  if ($params[3] == "update") {
		  
		  	if ($params[4] == "cc") {
		  		  
				  $bhUser = new \BH\user($this->db, $this->userID); 
				  
				  $this->agencyID = $bhUser->getAgencyID();
			  	
				  $form = new \forms($this->db);
						  
				  $agencyID = $params[5];
			
//				  $updatedAgency = $form->map($this->fields, $_POST);
			
				  $agency = new \BH\agency($this->db, $this->agencyID, $this->userID);
				  $admin = new \BH\admin($this->db, $this->agencyID, $this->userID);
			
//				  $agencyID =  $agency->saveAgency($agencyID, $updatedAgency);
				  	
				  $this->view = "ajax-response";	
				  
				  $response = array();	
				
				  $stripe = new \FLX\stripe($this->db, "Live", "sk_live_mXU1UbR4mwxUHeTd9Q1FNDC2");

				  $agencyInfo = $agency->getAgency($agencyID);

				  if (! $agencyInfo["stripeID"]) {
				
				  	$stripeID = $stripe->createCustomer($_POST["token"], $agencyInfo);
				
				  }
				  
				  else {
					$customerID = $stripe->getCustomerID($agencyInfo["stripeID"]);
				  	if($stripe->updateCustomer($_POST["token"], $customerID, $agencyInfo)) {
					  	$stripeID = $agencyInfo["stripeID"];
				  	}
				  	else {
					  	$stripeID = 0;
				  	}
				  }
				  
				  $admin->saveAgency($agencyID, array("stripeID"=>$stripeID));
			
				  if ( $stripeID ) {
				  		$response["message"] = "Credit Card Saved!";
				  		$this->vars["response"] = json_encode($response);
					  	return true;
				  }
				  else {
					  	$response["message"] = "<span style='color:#f00'>Error! Credit Card Information Not Saved.</span>";
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
	  else {
		 return false;
	  }
	}
 }	
	


}
?>
