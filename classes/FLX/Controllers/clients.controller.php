<?php

/**
 * FILELOGIX BLUHORN CLIENTS CLASS
 *  
 * @author Wes Benwick
 * @link http://www.filelogix.com
 * @license Part of Filelogix usage license
 */ 
 
namespace FLX\Controllers;

class clients extends \controller
{  
    // Will store database connection here
	private $db;
	private $connID;
	private $sessionID;
	private $userID;
	private $view = "clients";
	private $auth;
	private $vars = array("activeSideBar"=>array("clients"=>"active"));
	private $fields = array("clientName"=>"name", "contactName"=>"contactName", "emailAddress"=>"emailAddress", "address"=>"address", "phoneNumber"=>"phoneNumber", "faxNumber"=>"faxNumber", "website"=>"website", "notes"=>"notes", "bgColor"=>"bgColor", "fontColor"=>"fontColor", "isActive"=>"isActive", "agencyID"=>"agencyID");
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

	  error_log("Clients Init");

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
		  $form = new \forms($this->db);
			
	      $client = array();
			
	   	  $newClient = $form->map($this->fields, $_POST);

		  if (($params[2] == "new") and ($newClient["name"] != "") and ($newClient["contactName"] != "")) {

			
			$client = new \BH\client($this->db, $this->agencyID, $this->userID);
			
			$clientID =  $client->addClient($newClient);
	
			$this->vars["active"] = "clients";		
			
			if ($clientID>0) {			
				$this->vars["alert"]["success"] = "Client Added Succesfully. (id: $clientID)";
				$this->vars["client"] = $client->getClient($clientID);
				$this->view = "clients-edit";			
			}
			else {			  
				$this->vars["alert"]["error"] = "Client Not Added. It appears they already exist.";
				$this->vars["client"] = $newClient;
				$this->vars["clientNameError"] = true;
				$this->view = "clients-create";
	
			}
			
			return true;	
		}
		else {
			$this->view = "clients-create";
			return true;
		}

	  }
	  else {
		 return false;
	  }
	}

	public function edit($params) {
	  if ($this->auth->validate($this->userID)) {

		$this->vars["active"] = "clients";		
		
		$clientID = $params[2];
		
		$client = new \BH\client($this->db, $this->agencyID, $this->userID);

		$this->vars["client"] = $client->getClient($clientID);

		$campaign = new \BH\campaign($this->db, $this->agencyID, $this->userID);

		$this->vars["campaigns"] = $campaign->getCampaignsByClientID($clientID);
		
		$this->view = "clients-edit";
		
		return true;		
	  }
	  else {
		 return false;
	  }
	}


	public function dflt() {
	  if ($this->auth->validate($this->userID)) {

		  $this->vars["active"] = "clients";
		  
		  $this->view = "clients";
		  		  
		  $bhUser = new \BH\user($this->db, $this->userID); 
		  
		  $this->agencyID = $bhUser->getAgencyID();
		  
		  error_log("BH agencyID:" . $this->agencyID);
		  
	      $client = new \BH\client($this->db, $this->agencyID, $this->userID);

		  $this->vars["clients"] = $client->getAllClients();		
		
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
		
			  $client = array();
			  
			  $clientID = $params[3];
		
			  $updatedClient = $form->map($this->fields, $_POST);
		
			  $client = new \BH\client($this->db, $this->agencyID, $this->userID);
		
			  $clientID =  $client->saveClient($clientID, $updatedClient);

			  $this->vars["active"] = "clients";		
			  $this->view = "ajax-response";	
			  
			  $response = array();	
		
			  if ($clientID>0) {
			  		$response["message"] = "Saved!";
			  		$this->vars["response"] = json_encode($response);
				  	return true;
			  }
			  else {
			  		$response["message"] = "<span style='color:#f00'>Not Saved! Client Name Already Exists.</span>";
			  		$response["error"] = true;
			  		$response["field"] = "client-name";						
			  		$this->vars["response"] = json_encode($response);		
				  	return true;
			  }
		  }

		  else if ($params[2] == "delete") {
		  		  
			  $bhUser = new \BH\user($this->db, $this->userID); 
			  
			  $this->agencyID = $bhUser->getAgencyID();
		  	
			  $form = new \forms($this->db);
		
			  $client = array();
			  
			  $clientID = $params[3];
				
			  $client = new \BH\client($this->db, $this->agencyID, $this->userID);
	
			  $deletedClient = $form->map($this->fields, $_POST);
	
			  $clientID =  $client->deleteClient($clientID, $deletedClient);

			  $this->vars["active"] = "clients";		
			  $this->view = "ajax-response";	
			  
			  $response = array();	
		
			  if ($clientID>0) {
			  		$response["message"] = "Client Deleted!";
			  		$this->vars["response"] = json_encode($response);
				  	return true;
			  }
			  else {
			  		$response["message"] = "<span style='color:#f00'>Error! Unable to delete client.</span>";
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
