<?php

/**
 * FILELOGIX BLUHORN VENDORS CLASS
 *  
 * @author Wes Benwick
 * @link http://www.filelogix.com
 * @license Part of Filelogix usage license
 */ 
 
namespace FLX\Controllers;

class vendors extends \controller
{  
    // Will store database connection here
	private $db;
	private $connID;
	private $sessionID;
	private $userID;
	private $view = "vendors";
	private $auth;
	private $vars = array("activeSideBar"=>array("vendors"=>"active"));
	private $fields = array("vendorType"=>"vendorType", "vendorName"=>"name", "contactName"=>"contactName", "emailAddress"=>"emailAddress", "address"=>"address", "phoneNumber"=>"phoneNumber", "faxNumber"=>"faxNumber", "website"=>"website", "notes"=>"notes", "isActive"=>"isActive", "agencyID"=>"agencyID");
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

	  error_log("Vendors Init");

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

		$this->vars["active"] = "vendors";
	
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
		  $form = new \forms($this->db);
			
	      $vendor = array();
			
	   	  $newVendor = $form->map($this->fields, $_POST);

		  $vendor = new \BH\vendor($this->db, $this->agencyID, $this->userID);
			
		  $this->vars["vendorTypes"] = $vendor->getAllVendorTypes();


		  if (($params[2] == "new") and ($newVendor["name"] != "") and (intval($newVendor["vendorType"])>0)) {
			
			$vendorID =  $vendor->addVendor($newVendor);
	
			$this->vars["active"] = "vendors";		
			
			if ($vendorID>0) {			
				$this->vars["alert"]["success"] = "Vendor Added Succesfully. (id: $vendorID)";
				$this->vars["vendor"] = $vendor->getVendor($vendorID);
				$this->view = "vendors-edit";			
			}
			else {			  
				$this->vars["alert"]["error"] = "Vendor Not Added. It already exists.";
				$this->vars["vendor"] = $newVendor;
				$this->vars["vendorNameError"] = true;
				$this->view = "vendors-create";
	
			}
			
			return true;	
		}
		else {
			$this->view = "vendors-create";
			return true;
		}

	  }
	  else {
		 return false;
	  }
	}

	public function edit($params) {
	  if ($this->auth->validate($this->userID)) {

		$this->vars["active"] = "vendors";		
		
		$vendorID = $params[2];
		
		$vendor = new \BH\vendor($this->db, $this->agencyID, $this->userID);
		$market = new \BH\market($this->db, $this->agencyID, $this->userID);
		$programs = new \BH\programs($this->db, $this->agencyID, $this->userID);

		$this->vars["vendor"] = $vendor->getVendor($vendorID);
//		$this->vars["vendorType"] = $vendor->getVendorType($this->vars["vendor"]["vendorType"]);
		$this->vars["markets"] = $market->getMarketsByVendorID($vendorID);
		$this->vars["programs"] = $programs->getAllProgramsByVendor($vendorID);

		$this->view = "vendors-edit";
		
		return true;		
	  }
	  else {
		 return false;
	  }
	}


	public function dflt() {
	  if ($this->auth->validate($this->userID)) {

		  $this->vars["active"] = "vendors";
		  
		  $this->view = "vendors";
		  		  
		  $bhUser = new \BH\user($this->db, $this->userID); 
		  
		  $this->agencyID = $bhUser->getAgencyID();
		  
		  error_log("BH agencyID:" . $this->agencyID);
		  
	      $vendor = new \BH\vendor($this->db, $this->agencyID, $this->userID);

		  $this->vars["vendors"] = $vendor->getAllVendors();		
		
		  $vendor = new \BH\vendor($this->db, $this->agencyID, $this->userID);
			
		  $this->vars["vendorTypes"] = $vendor->getAllVendorTypes();

		  return true;		
	  }
	  else {
		 return false;
	  }
	}
	
	public function all($params) {
		
			return $this->dflt();
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

	public function ajax($params) {
	 if ($this->auth->validate($this->userID)) {
		  
		  if ($params[2] == "save") {
		  		  
			  $bhUser = new \BH\user($this->db, $this->userID); 
			  
			  $this->agencyID = $bhUser->getAgencyID();
		  	
			  $form = new \forms($this->db);
		
			  $vendor = array();
			  
			  $vendorID = $params[3];
		
			  $updatedVendor = $form->map($this->fields, $_POST);
		
			  $vendor = new \BH\vendor($this->db, $this->agencyID, $this->userID);
		
			  $vendorID =  $vendor->saveVendor($vendorID, $updatedVendor);

			  $this->vars["active"] = "vendors";		
			  $this->view = "ajax-response";	
			  
			  $response = array();	
		
			  if ($vendorID>0) {
			  		$response["message"] = "Saved!";
			  		$this->vars["response"] = json_encode($response);
				  	return true;
			  }
			  else {
			  		$response["message"] = "<span style='color:#f00'>Not Saved! Vendor Name Already Exists.</span>";
			  		$response["error"] = true;
			  		$response["field"] = "vendor-name";						
			  		$this->vars["response"] = json_encode($response);		
				  	return true;
			  }
		  }

		  else if ($params[2] == "search") {
		  	if ($params[3] == "marketandtype") {	  
			  $bhUser = new \BH\user($this->db, $this->userID); 
			  
			  $this->agencyID = $bhUser->getAgencyID();
		  	
			  $marketTypeID = $params[4];
			  $marketID = urldecode($params[5]);
			  
			  if ($params[6]) {
				  $marketID .= "/" . urldecode($params[6]);;
			  }

			  $vendors = array();
				
			  $vendor = new \BH\vendor($this->db, $this->agencyID, $this->userID);
		
			  error_log("Search: " . $marketTypeID . " " . $marketID);
		
			  $vendors =  $vendor->getVendorsByMarketAndType($marketTypeID, $marketID);
			 
			  $this->view = "ajax-response";	
			  
			  $response = array();	
		
			  if (count($vendors)>0) {
			  		if (count($vendors) == 1) {
				  		$vendorStr = " Vendor";
			  		}
			  		else {
				  		$vendorStr = " Vendors";
			  		}
			  		
			  		$response["message"] = "Found " . count($vendors) . $vendorStr;
			  		$response["vendors"] = $vendors;
			  		$this->vars["response"] = json_encode($response);
				  	return true;
			  }
			  else {
			  		$response["message"] = "No Vendors Found";
			  		$response["vendors"] = "";
			  		$this->vars["response"] = json_encode($response);	
				  	return true;
			  }
			}
			else if ($params[3] == "reps") {
			  $bhUser = new \BH\user($this->db, $this->userID); 
			  
			  $this->agencyID = $bhUser->getAgencyID();
		  	
			  $vendorID = $params[4];
			  $market = urldecode($params[5]);
			  
			  if ($params[6]) {
				  $market .= "/" . urldecode($params[6]);
			  }

			  $vendors = array();
				
			  $vendor = new \BH\vendor($this->db, $this->agencyID, $this->userID);
		
			  error_log("Search Reps: " . $vendorID . " " . $market);
		
			  $vendorReps =  $vendor->getVendorRepsByVendorIDAndMarketName($vendorID,$market);
			 
			  $this->view = "ajax-response";	
			  
			  $response = array();	
		
			  if (count($vendorReps)>0) {
			  		if (count($vendorReps) == 1) {
				  		$vendorRepStr = " Rep";
			  		}
			  		else {
				  		$vendorRepStr = " Reps";
			  		}
			  		
			  		$response["message"] = "Found " . count($vendorReps) . $vendorRepStr;
			  		$response["vendorReps"] = $vendorReps;
			  		$this->vars["response"] = json_encode($response);
				  	return true;
			  }
			  else {
			  		$response["message"] = "No Vendor Reps Found";
			  		$response["vendorReps"] = "";
			  		$this->vars["response"] = json_encode($response);	
				  	return true;
			  }				
			}
			

			else if ($params[3] == "campaigns") {
			  $bhUser = new \BH\user($this->db, $this->userID); 
			  
			  $this->agencyID = $bhUser->getAgencyID();
		  	
			  $vendorID = $params[4];
			  $campaigns = $_POST["campaigns"];

			  $vendors = array();
				
			  $vendor = new \BH\vendor($this->db, $this->agencyID, $this->userID);
		
			  error_log("Search Vendors By Campaigns: " . $vendorID . " " . $campaigns);
		
			  $vendors =  $vendor->getVendorsByCampaignID($campaigns);
			 
			  $this->view = "ajax-response";	
			  
			  $response = array();	
		
			  if (count($vendors)>0) {
			  		if (count($vendors) == 1) {
				  		$vendorStr = " Vendor";
			  		}
			  		else {
				  		$vendorStr = " Vendors";
			  		}
			  		
			  		$response["message"] = "Found " . count($vendors) . $vendorStr;
			  		$response["results"] = $vendors;
			  		$this->vars["response"] = json_encode($response);
				  	return true;
			  }
			  else {
			  		$response["message"] = "No Vendors Found";
			  		$response["results"] = "";
			  		$this->vars["response"] = json_encode($response);	
				  	return true;
			  }				
				
			}


		  }

		  else if ($params[2] == "delete") {
		  		  
			  $bhUser = new \BH\user($this->db, $this->userID); 
			  
			  $this->agencyID = $bhUser->getAgencyID();
		  	
			  $form = new \forms($this->db);
					  
			  $vendorID = $params[3];
				
			  $vendor = new \BH\vendor($this->db, $this->agencyID, $this->userID);
	
			  $deletedVendor = $form->map($this->fields, $_POST);
	
			  $vendorID =  $vendor->deleteVendor($vendorID, $deletedVendor);

			  $this->vars["active"] = "vendors";		
			  $this->view = "ajax-response";	
			  
			  $response = array();	
		
			  if ($vendorID>0) {
			  		$response["message"] = "Vendor Deleted!";
			  		$this->vars["response"] = json_encode($response);
				  	return true;
			  }
			  else {
			  		$response["message"] = "<span style='color:#f00'>Error! Unable to delete vendor.</span>";
			  		$response["error"] = true;
			  		$this->vars["response"] = json_encode($response);		
				  	return true;
			  }
		  }


		  else if ($params[2] == "type") {
		  		  
			  $bhUser = new \BH\user($this->db, $this->userID); 
			  
			  $this->agencyID = $bhUser->getAgencyID();
		  	
			  $form = new \forms($this->db);
					  
			  $vendorTypeID = $params[3];
				
			  $vendor = new \BH\vendor($this->db, $this->agencyID, $this->userID);
	
			  $vendorType =  $vendor->getVendorType($vendorTypeID);

			  $this->vars["active"] = "vendors";		
			  $this->view = "ajax-response";	
			  
			  $response = array();	
		
			  if ($vendorType>0) {
			  		$response["message"] = "Vendor Type set to " . $vendorType["description"];
			  		$response["vendorType"] = $vendorType;
			  		$this->vars["response"] = json_encode($response);
				  	return true;
			  }
			  else {
			  		$response["message"] = "<span style='color:#f00'>Error! Vendor Type Not Found.</span>";
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
