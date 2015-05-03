<?php

/**
 * FILELOGIX AUTHENTICATION CLASS
 *  
 * @author Wes Benwick
 * @link http://www.filelogix.com
 * @license Part of Filelogix usage license
 */ 
class auth
{  
    // Will store database connection here
	private $db;
	private $connID;
	private $sessionID;
	private $username;
	private $user;
	private $userID;
	private $emailAddress;
	private $authType;
	private $view;
	private $vars;

	/**
  	 * Create instance, load current info based on session info
  	 *
  	 * @return bool
  	 */
	
	public function __construct($db) {
	  $this->db = $db;
	  $this->sessionID = session_id();	
	  $this->userID = $_SESSION["userID"];
	  $this->getUsername();
	  $this->view = "login";
	}
	
	/**
  	 * Log a user in based on password
  	 *
  	 * @return bool true for success, false for failure
  	 */
	
	public function login($username, $password) {
	
//	  session_regenerate_id();
	
	  $usernameStr = $this->db->quote($username);

	  $this->users=$this->db->query("select *,md5('$password') as pwd from FLX_USERS where username=$usernameStr and isActive is TRUE");

	  error_log("Login: " . $this->db->lastQuery());

	  error_log("Authenticating $username...");
	  
	  foreach ($this->users as $row) {
		  $this->userID = $row['userID'];
		  $this->username = $row['username'];
		  $this->emailAddress = $row['emailAddress'];
		  if ($row['password'] == $row['pwd']) {
		  	  $this->create();
		  	  $this->user = new \user($this->db, $username);
			  return true;
		  }
		  else {
			  return false;
		  }
      }
		

		return false;
	}
	
	/**
  	 * Log the current user out
  	 *
  	 * @return bool 
  	 */
		
	public function logout() {
	
		error_log("Logging out..." . $this->sessionID);
		
		session_regenerate_id();
		
		$this->delete();
		return true;

	}

	
	/**
  	 * Create an entry in the FLX_SESSION table to show the session is active and the userID it is assigned to.
  	 *
  	 * @return bool 
  	 */
		
	public function create() {
		
		$_SESSION["userID"] = $this->userID;
	
		$nowStr = date('Y-m-d h:i:s a', time());

	    $this->db->insert("FLX_SESSION", array("sessionID"=>session_id(), "userID"=>$this->userID, "created"=>$nowStr));	
	  	
//	   	error_log("Inserting Session: " . $this->db->lastQuery());	  	
	  	
		return true;

	}

	/**
  	 * Delete an entry in the FLX_SESSION table to inactivate the session.
  	 *
  	 * @return bool 
  	 */
		
	public function delete() {
		
		error_log("Deleting session: " . $this->sessionID);
	    $this->db->delete("FLX_SESSION", "sessionID", $this->sessionID, array("userID"=>$this->userID));	
		return true;

	}
	
	/**
  	 * Log a user out based on sessionID
  	 *
  	 * @return bool 
  	 */
		
	public function logoutSID($sID) {
		
	}
	
	/**
  	 * Validate the current session
  	 *
  	 * @return bool 
  	 */
	 	
	public function validate() {

	  error_log("Validating... " . "select * from FLX_SESSION where sessionID = '" . session_id() . "'");
	  $sessions=$this->db->query("select * from FLX_SESSION where sessionID = '" . session_id() . "'");
	  foreach ($sessions as $session) {
		  error_log("Validate: " . $this->userID . "=" . $session['userID']);
//		  if ($userID == $session['userID']) {
		  if (intval(trim($this->userID)) == intval(trim($session['userID']))) {
	   		  error_log("Validated. (BH)");

		  	  $this->user = new \user($this->db, $this->getUsername());

// check if user "isReset"

			  if ($this->user->isReset()) {
			  
	   			  error_log("Reset. (BH) (" . $this->userID .") != (" . $session['userID'] . ")");
	   			  $this->view = "reset";
				  return false;				  
			  }
			
// check if user "isSuspended"

			  if ($this->user->isReset()) {
				
	   			  error_log("Suspended. (BH) (" . $this->userID .") != (" . $session['userID'] . ")");
	   			  $this->view = "login";
				  return false;
			  }

// check if user "isPending"

			  if ($this->user->isPending()) {
				
	   			  		error_log("Pending. (BH) (" . $this->userID .") != (" . $session['userID'] . ")");

						$customer = new \customer($this->db, $this->sessionID, $this->userID);
						$subscribe = new \subscribe($this->db);
						$subscription = new \FLX\subscriptions($this->db, $this->sessionID, $this->userID);
			
						$customer = new \customer($this->db, $this->sessionID, $this->userID);

						$cust = $customer->getCustomerByUserID($this->userID);
			
						$customerID = $cust["id"];
						$customerKey = $cust["customerKey"];
			
						$random = new \random(6,6);
						$randomStr = $random->token(6);			
						
						$subscriptionKey = $randomStr;
			
						$this->view="choose";
						$this->vars["plans"] = $subscribe->plans(true); 
						$this->vars["customer"] = $customer->getCustomer($customerID); 
						$this->vars["subscriptionKey"] = $subscriptionKey;
				
						return false;
			  }
			  
// check if agency "isAlerted"

// check if agency "isCredit"

	   		  if ($session['userID'] == 0) {

		   			return false;
		   		  
	   		  }

			  return true;
		  }
		  else {
	   		  error_log("Not Validated. (BH) (" . $this->userID .") != (" . $session['userID'] . ")");
	   		  $this->view = "login";
			  return false;
		  }
      }

  	  error_log("Validation Error.");
      
      return false;
      
    }
    
	/**
  	 * Return the current user's username
  	 *
  	 * @return string
  	 */
	
	public function getUsername() {
	
	   if (isset($this->username)) {
		   return $this->username;
	   }
	
	   else {
		   
		   $userID = $this->userID;
		   
		   $q = "select * from FLX_USERS where userID= '$userID'";
		   
		   $r=$this->db->query($q);	   

		   $results=$r->fetch(PDO::FETCH_ASSOC);
		   
		   $this->username = $results["username"];
	
		   return $this->username;
	   }

    }

	public function getUsernameMD5() {
	
	   if (isset($this->username)) {
		   return md5($this->username);
	   }
	
	   else {
		   
		   $userID = $this->userID;
		   
		   $q = "select * from FLX_USERS where userID= '$userID'";
		   
		   $r=$this->db->query($q);	   

		   $results=$r->fetch(PDO::FETCH_ASSOC);
		   
		   $this->username = $results["username"];
	
		   return md5($this->username);
	   }

    }
	
	public function getUserID() {
	
			return $this->userID;

    }

	/**
  	 * Return the current user's abbreviated (short) name
  	 *
  	 * @return string
  	 */
	
	public function getShortName($userID) {
	
	   $q = "select * from FLX_USERS where userID= '$userID'";

	   $r=$this->db->query($q);	   

       $results=$r->fetch(PDO::FETCH_ASSOC);

//  	   error_log($this->db->lastQuery());

       return $results["shortName"];
		
    }
 
 	/**
  	 * Return the current user's abbreviated (short) name
  	 *
  	 * @return string
  	 */
	
	public function getEmailAddress($userID) {
	
	   $q = "select * from FLX_USERS where userID= '$userID'";

	   $r=$this->db->query($q);	   

       $results=$r->fetch(PDO::FETCH_ASSOC);

//  	   error_log($this->db->lastQuery());

       return $results["emailAddress"];
		
    }
 
  	/**
  	 * Return the username of a logged in user from an existing session
  	 *
  	 * @return string
  	 */
	
	public function view() {
	
			return $this->view;


    }
 
	public function data() {
	
			return $this->vars;

    } 
 
 	/**
  	 * Return the username of a logged in user from an existing session
  	 *
  	 * @return string
  	 */
	
	public function getUsernameSID($sID) {
	
			return true;


    }
       
    /**
  	 * Change the current user's password
  	 *
  	 * @return bool 
  	 */
	
	public function changePassword() {
	
			return true;


    }

	/**
  	 * change a specific user's password
  	 *
  	 * @return bool 
  	 */
	
	public function changeUsername($username) {
	
			return true;

    }    

    public function getAccessByUsername($username, $activity) {
	    
	   $q = "select * from FLX_ACCESS left join FLX_GROUP using (accessID) left join FLX_MEMBERS on (FLX_MEMBERS.groupID=FLX_GROUP.groupID) left join FLX_USERS on (FLX_USERS.userID=FLX_MEMBERS.userID) where FLX_MEMBERS.memberID is not NULL and FLX_ACCESS.activity = '$activity' and FLX_USERS.username = '$username'";

	   $r=$this->db->query($q);	   

       $results=$r->fetchAll();

 	   error_log("Auth: " . $this->db->lastQuery());

       return $results;
       
    }

    public function getAccessByUserID($userID, $activity) {
	    
	   $q = "select * from FLX_ACCESS left join FLX_GROUP using (accessID) left join FLX_MEMBERS on (FLX_MEMBERS.groupID=FLX_GROUP.groupID) where FLX_MEMBERS.memberID is not NULL and FLX_ACCESS.activity = '$activity' and FLX_MEMBERS.userID= '$userID'";

	   $r=$this->db->query($q);	   

       $results=$r->fetchAll();

 	   error_log("Auth: " . $this->db->lastQuery());

       return $results;
       
    }

}
?>