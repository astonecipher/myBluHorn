<?php

/**
 * FILELOGIX BLUHORN MARKETS CLASS
 *  
 * @author Wes Benwick
 * @link http://www.filelogix.com
 * @license Part of Filelogix usage license
 */ 
 
namespace FLX\Controllers;

class markets extends \controller
{  
    // Will store database connection here
	private $db;
	private $connID;
	private $sessionID;
	private $userID;
	private $view = "markets";
	private $auth;
	private $vars = array("activeSideBar"=>array("markets"=>"active"));
	private $lists;
	private $registration;
	private $request;
	private $editor;
	private $fields = array("marketName"=>"name", "contactName"=>"contactName", "emailAddress"=>"emailAddress", "phoneNumber"=>"phoneNumber", "faxNumber"=>"faxNumber", "stations"=>"stations", "agencyID"=>"agencyID", "vendorID"=>"vendorID");

	

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

	  error_log("Market Init");

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

		$this->vars["active"] = "markets";
	
	}
	
	
	/**
  	 * Loads the controller, handles any templating and pre-display logic for the requested view
  	 *
  	 * @return bool
  	 */
	
	public function load($view) {


	}

	public function edit($params) {
	  if ($this->auth->validate($this->userID)) {

		$this->vars["active"] = "markets";		
		  
		$this->view = "markets-edit";

		$bhUser = new \BH\user($this->db, $this->userID); 
			  
		$this->agencyID = $bhUser->getAgencyID();
		
		$market = new \BH\market($this->db, $this->agencyID, $this->userID);
		$vendor = new \BH\vendor($this->db, $this->agencyID, $this->userID);
		
		$this->vars["market"] = $market->getMarket($params[2]);
		$this->vars["vendors"] = $vendor->getAllVendors();
		  		
		return true;		
	  }
	  else {
		 return false;
	  }
	}


	public function dflt() {
	  if ($this->auth->validate($this->userID)) {

		  $this->vars["active"] = "markets";
		  
		  $this->view = "markets";

		  $bhUser = new \BH\user($this->db, $this->userID); 
			  
		  $this->agencyID = $bhUser->getAgencyID();
		
		  $market = new \BH\market($this->db, $this->agencyID, $this->userID);
		
		  $this->vars["markets"] = $market->getAllMarkets();
		
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

	public function ajax($params) {
	 if ($this->auth->validate($this->userID)) {
		  
		  if ($params[2] == "save") {
		  		  
			  $bhUser = new \BH\user($this->db, $this->userID); 
			  
			  $this->agencyID = $bhUser->getAgencyID();
		  	
			  $form = new \forms($this->db);
		
			  $market = array();
			  
			  $marketID = $params[3];
		
			  $updatedMarket = $form->map($this->fields, $_POST);
		
			  $market = new \BH\market($this->db, $this->agencyID, $this->userID);
		
			  $marketID =  $market->saveMarket($marketID, $updatedMarket);

			  $this->view = "ajax-response";	
			  
			  $response = array();	
		
			  if ($marketID>0) {
			  		$response["message"] = "Saved!";
			  		$this->vars["response"] = json_encode($response);
				  	return true;
			  }
			  else {
			  		$response["message"] = "<span style='color:#f00'>Not Saved! Market Already Exists.</span>";
			  		$response["error"] = true;
			  		$response["field"] = "market-name";						
			  		$this->vars["response"] = json_encode($response);		
				  	return true;
			  }
		  }

		  else if ($params[2] == "delete") {
		  		  
			  $bhUser = new \BH\user($this->db, $this->userID); 
			  
			  $this->agencyID = $bhUser->getAgencyID();
		  	
			  $form = new \forms($this->db);
					  
			  $marketID = $params[3];
				
			  $worksheet = new \BH\market($this->db, $this->agencyID, $this->userID);
		
			  $marketID =  $worksheet->deleteMarket($marketID);

			  $this->view = "ajax-response";	
			  
			  $response = array();	
		
			  if ($marketID>0) {
			  		$response["message"] = "Market Deleted!";
			  		$this->vars["response"] = json_encode($response);
				  	return true;
			  }
			  else {
			  		$response["message"] = "<span style='color:#f00'>Error! Unable to delete market.</span>";
			  		$response["error"] = true;
			  		$this->vars["response"] = json_encode($response);		
				  	return true;
			  }
		  }


		  else if ($params[2] == "add") {
		  		  
			  $bhUser = new \BH\user($this->db, $this->userID); 
			  
			  $this->agencyID = $bhUser->getAgencyID();
		  	
			  $form = new \forms($this->db);
		
			  $market = array();
			  
			  $marketID = $params[3];
		
			  $newMarket = $form->map($this->fields, $_POST);
		
			  $market = new \BH\market($this->db, $this->agencyID, $this->userID);
		
			  $marketID =  $market->addMarket($newMarket);

			  $this->view = "ajax-response";	
			  
			  $response = array();	
		
			  if ($marketID>0) {
			  		$response["message"] = "Added!";
			  		$response["newMarket"] = $market->getMarket($marketID);
			  		$this->vars["response"] = json_encode($response);
				  	return true;
			  }
			  else {
			  		$response["message"] = "<span style='color:#f00'>Not Added! Market Already Exists.</span>";
			  		$response["error"] = true;
			  		$response["field"] = "market-name";						
			  		$this->vars["response"] = json_encode($response);		
				  	return true;
			  }
		  }
		  else if ($params[2] == "search") {
			  if ($params[3] == "vendors") {
				  $bhUser = new \BH\user($this->db, $this->userID); 
				  
				  $this->agencyID = $bhUser->getAgencyID();
			  	
				  $vendors = $_POST["vendors"];
					
				  $market = new \BH\market($this->db, $this->agencyID, $this->userID);
					
				  $markets =  $market->getMarketsByVendor($vendors);
				 
				  $this->view = "ajax-response";	
				  
				  $response = array();	
			
				  if (count($markets)>0) {
				  		if (count($markets) == 1) {
					  		$marketStr = " Market";
				  		}
				  		else {
					  		$marketStr = " Vendors";
				  		}
				  		
				  		$response["message"] = "Found " . count($markets) . $marketStr;
				  		$response["results"] = $markets;
				  		$this->vars["response"] = json_encode($response);
					  	return true;
				  }
				  else {
				  		$response["message"] = "No Markets Found";
				  		$response["results"] = "";
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
