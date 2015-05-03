<?php

/**
 * FILELOGIX AJAX CLASS
 *  
 * @author Wes Benwick
 * @link http://www.filelogix.com
 * @license Part of Filelogix usage license
 */ 
 
namespace FLX\Controllers;

class ajax extends \controller
{  
    // Will store database connection here
	private $db;

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
	  $this->view = "blank";
	  
	  $this->auth = new \auth($this->db);
	  
	  if (!$this->auth->validate($this->userID)) {
		  
		  return false;
	  }
	  
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

	public function editor($params) {
		
	   if ($this->auth->validate($this->userID)) {

		   $template = new \FLX\template($this->db);
		   $this->view = "editor-table";

			if ($params[4] == "save") {
				error_log("Saving Editor Content.");
				$source = urldecode($_POST["editorContent"]);
				$templateID = $_POST["templateID"];
//				error_log(html_entity_decode($_POST["editorContent"]));

				$template->save($templateID, $source);
				
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

}
?>
