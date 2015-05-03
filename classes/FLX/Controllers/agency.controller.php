<?php

/**
 * FILELOGIX BLUHORN AGENCY CLASS
 *  
 * @author Wes Benwick
 * @link http://www.filelogix.com
 * @license Part of Filelogix usage license
 */ 
 
namespace FLX\Controllers;

class agency extends \controller
{  
    // Will store database connection here
	private $db;
	private $connID;
	private $sessionID;
	private $userID;
	private $view = "agency";
	private $auth;
	private $vars = array("activeSideBar"=>array("agency"=>"active"));
	private $fields = array("agencyName"=>"name", "contactName"=>"contactName", "emailAddress"=>"emailAddress", "address"=>"address", "phoneNumber"=>"phoneNumber", "faxNumber"=>"faxNumber", "website"=>"website", "comments"=>"comments","agencyID"=>"id");
	private $lists;
	private $registration;
	private $request;
	private $editor;
	private $agencyID;
	

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

	  $this->vars["sessionID"]=$this->sessionID;

	  $this->vars["username"] = "@" . $this->auth->getShortName($this->userID);
	  $this->vars["gravatar"] = md5( strtolower( trim( $this->auth->getEmailAddress($this->userID) ) ) );

	  
	  $this->topCharts();
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

		$this->vars["active"] = "clients";
	
	}
	
	
	/**
  	 * Loads the controller, handles any templating and pre-display logic for the requested view
  	 *
  	 * @return bool
  	 */
	
	public function load($view) {


	}
	
	public function create($params) {
	  if ($this->auth->validate($this->userID)) {

		$this->vars["active"] = "vendors";		
		  
		$this->view = "agency-create";
		
		return true;		
	  }
	  else {
		 return false;
	  }
	}

	public function edit($params) {
	  if ($this->auth->validate($this->userID)) {

		$this->vars["active"] = "vendors";		
		  
		$this->view = "agency-edit";
		
		return true;		
	  }
	  else {
		 return false;
	  }
	}


	public function users($params) {
	  if ($this->auth->validate($this->userID)) {

		$this->vars["active"] = "agency";		
		  
		$this->view = "user-edit";
		
		return true;		
	  }
	  else {
		 return false;
	  }
	}

	public function dflt() {
	  if ($this->auth->validate($this->userID)) {

		  $bhUser = new \BH\user($this->db, $this->userID); 
		  
		  $this->agencyID = $bhUser->getAgencyID();

		  $agency = new \BH\agency($this->db, $this->agencyID, $this->userID);

		  $this->vars["agency"] = $agency->getAgency($this->agencyID);
		  
		  $this->vars["agencyUsers"] = $agency->getAllAgencyUsers($this->agencyID);

		  $this->vars["readOnly"] = true;

		  if ($bhUser->isAdmin()) {
			  $this->vars["readOnly"] = false;		  
		  }
		  
		  $this->vars["active"] = "Agency";
		  
		  $this->view = "agency";
		
		return true;		
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
	
	 if ($this->auth->validate($this->userID)) {
					  
		  if ($params[2] == "save") {
		  		  
			  $bhUser = new \BH\user($this->db, $this->userID); 
			  
			  $this->agencyID = $bhUser->getAgencyID();
		  	
			  $form = new \forms($this->db);
					  
			  $agencyID = $params[3];
		
			  $updatedAgency = $form->map($this->fields, $_POST);
		
			  $agency = new \BH\agency($this->db, $this->agencyID, $this->userID);
		
			  $agencyID =  $agency->saveAgency($agencyID, $updatedAgency);

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


		  else if ($params[2] == "agency") {
		  
		  	if ($params[3] == "add") {
		  		  
				  $bhUser = new \BH\user($this->db, $this->userID); 
				  
				  $this->agencyID = $bhUser->getAgencyID();
			  	
				  $form = new \forms($this->db);
						  			
				  $newAgency = $form->map($this->fields["agency"], $_POST);
			
				  $admin = new \BH\admin($this->db, $this->agencyID, $this->userID);
			
				  $agencyID =  $admin->addAgency($agencyID, $newAgency);
	
				  $this->vars["active"] = "agency";		
				  $this->view = "ajax-response";	
				  
				  $response = array();	
			
				  if ($agencyID>0) {
				  		$response["message"] = "Agency Created!";
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
		  
		  else if ($params[3] == "update") {
		  
		  	if ($params[4] == "cc") {
		  		  
				  $bhUser = new \BH\user($this->db, $this->userID); 
				  
				  $this->agencyID = $bhUser->getAgencyID();
			  	
				  $form = new \forms($this->db);
						  
//				  $agencyID = $params[5];
			
//				  $updatedAgency = $form->map($this->fields, $_POST);
			
				  $agency = new \BH\agency($this->db, $this->agencyID, $this->userID);
			
//				  $agencyID =  $agency->saveAgency($agencyID, $updatedAgency);

				  $agencyID = 85;
				  	
				  $this->view = "ajax-response";	
				  
				  $response = array();	

error_log("Updating Credit Card.");
			
				  if ($agencyID>0) {
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
	  }
	  else {
		 return false;
	  }
	}		
	
}
?>
