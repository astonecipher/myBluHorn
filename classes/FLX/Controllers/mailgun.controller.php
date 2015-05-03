<?php

/**
 * FILELOGIX BLUHORN MAILGUN CONTROLLER CLASS
 *  
 * @author Wes Benwick
 * @link http://www.filelogix.com
 * @license Part of Filelogix usage license
 */ 
 
namespace FLX\Controllers;

class mailgun extends \controller
{  
    // Will store database connection here
	private $db;
	private $sessionID;
	private $userID;
	
	/**
  	 * Create instance, load current info based on session info
  	 *
  	 * @return bool
  	 */
	
	public function __construct($db, $sessionID, $userID) {
	  $this->db = $db;
	  $this->sessionID = $sessionID;
	  $this->userID = $userID;
	
	}
	
	public function delivered($params) {
	
		if (hash_hmac('sha256', $_POST["timestamp"] . $_POST["token"], "key-48c0a228297f5e095233b236cd4bda7d") ==  $_POST["signature"]) {
			$mailgun = new \mg($this->db);
			if ($_POST["event"] == "delivered") { 
				$mailgun->isDelivered($_POST["Message-Id"], true);
				$mailgun->update($_POST["Message-Id"], array("deliveredStamp"=>date("Y-m-d H:i:s", $_POST["timestamp"])));
			}
		}

	}

	public function failed($params) {

		if (hash_hmac('sha256', $_POST["timestamp"] . $_POST["token"], "key-48c0a228297f5e095233b236cd4bda7d") ==  $_POST["signature"]) {
			$mailgun = new \mg($this->db);
			if ($_POST["event"] == "failed") { 
				$mailgun->isFailed($_POST["Message-Id"], true);
			}
		}
	}
	
}
?>
