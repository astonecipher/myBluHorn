<?php

/**
 * FILELOGIX BLUHORN SUPPORT CLASS
 *  
 * @author Wes Benwick
 * @link http://www.filelogix.com
 * @license Part of Filelogix usage license
 */ 
 
namespace FLX\Controllers;

class support extends \controller
{  
    // Will store database connection here
	private $db;
	private $connID;
	private $sessionID;
	private $userID;
	private $view = "support";
	private $auth;
	private $vars = array("activeSideBar"=>array("more"=>"active"));
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

	  $this->vars["username"] = "@" . $this->auth->getShortName($this->userID);

	  
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

		$this->vars["active"] = "cabinet";
	
	}
	
	
	/**
  	 * Loads the controller, handles any templating and pre-display logic for the requested view
  	 *
  	 * @return bool
  	 */
	
	public function load($view) {


	}
	
	public function cases($params) {
	  if ($this->auth->validate($this->userID)) {

		$this->vars["active"] = "support";		
		  
		$this->view = "maintenance";
		
		return true;		
	  }
	  else {
		 return false;
	  }
	}

	public function kb($params) {
	  if ($this->auth->validate($this->userID)) {

		$this->vars["active"] = "support-kb";		
		
		if ($this->userID == 1) {
  			$this->view = "knowledge-base";
		}
		else {
			$this->view = "maintenance";
		}
		
		return true;		
	  }
	  else {
		 return false;
	  }
	}


	public function dflt() {
	  if ($this->auth->validate($this->userID)) {

		  $this->vars["active"] = "support-kb";
		  
		  $this->view = "knowledge-base";
		
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
		
  	 $this->view = "ajax-response";
	 
	 if ($this->auth->validate($this->userID)) {
		  
		  if ($params[2] == "report") {	  		  
		  	  	  
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


}
?>
