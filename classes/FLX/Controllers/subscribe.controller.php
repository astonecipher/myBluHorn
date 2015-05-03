<?php

/**
 * FILELOGIX SUBSCRIPTION CONTROLLER CLASS
 *  
 * @author Wes Benwick
 * @link http://www.filelogix.com
 * @license Part of Filelogix usage license
 */ 
 
namespace FLX\Controllers;

class subscribe extends \controller
{  
    // Will store database connection here
	private $db;
	private $connID;
	private $sessionID;
	private $userID;
	private $view = "subscribe";
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

	public function user($params) {

		if ($params[2]=="activate") {
			$users = new \users($this->db);
			if (intval($params[3]>0)) {		
				$random = new \random(6,6);
				$randomStr = $random->token(6);
				$result = $users->activateByUserID($params[5],$randomStr);	
				if (strlen($result)>1) {
					error_log("ActivateUserResult: " . $result);
					$this->vars["response"] = true;
					$md5Str = md5($result . $randomStr . time());
						
			  		$email = new \FLX\mail($this->db);	
			  		$email->from("marie.meyer@bluhorn.com");
			  		$email->to($result);
		  		
			  		$email->bcc("wbenwick@bluhorn.com");
			  		$email->subject("Welcome to BluHorn");
			  		//$email->text("This message was generated by FileLogix");
			  		//$email->html("<html><head></head><body>This message was generated by FileLogix</body></html>");
					  		
			  		$data = array();
			  		$data["activationCode"] = $randomStr;
			  		$data["username"] = $result;
			  		$data["id"] = $md5Str;
					  		
			  		$email->htmlByTemplate("MAIL_INTRO", array("email" => $data));
				  	//$email->addFileByURL("http://bsf.filelogix.net/test.pdf","test.pdf");
				  	$email->send();									
						 
					return true;
				}
				else {
					$this->vars["response"] = false; 
					return true;
				}
			}
			else {
				return false;
			}
		}
		
		return false;
	}

	public function pay($params) {
		
		$this->view = "pay";

		$customer = new \customer($this->db, $this->sessionID, $this->userID);
		$subscription = new \FLX\subscriptions($this->db, $this->sessionID, $this->userID);
		
		$subscriptionID = $params[4];
		$customerID = $params[3];
		$subscriptionKey = $params[2];

		$sub = $subscription->getSubscription($subscriptionID); 
			
		$this->vars["plan"] = $sub["plan"];
		$this->vars["customer"] = $customer->getCustomer($customerID); 
		$this->vars["subscriptionKey"] = $params[2];	
		$this->vars["subscription"] = $sub["subscription"];	
			
		return true;		

	}

	public function accept($params) {
	
		if ($this->auth->validate($this->userID)) {

			$subscriptionKey = $params[2];
			$customerKey = $params[3];
			$activationCode = $params[4];
			$userKey = $params[5];
	
			$subscription = new \FLX\subscriptions($this->db, $this->sessionID, $this->userID);
			
			$auth = $subscription->authenticate($subscriptionKey, $customerKey, $activationCode, $userKey);		
	
			if ($auth["isValid"]) {
			
				$this->view = "accept";
		
			  	$user = new \BH\user($this->db, $this->userID);
				$customer = new \customer($this->db, $this->sessionID, $this->userID);
				
				$subscriptionID = $auth["sub"]["id"];
				$customerID = $auth["cust"]["id"];
		
				$sub = $this->getSubscription($subscriptionID); 
					
				$this->vars["plan"] = $sub["plan"];
				$this->vars["customer"] = $customer->getCustomer($customerID); 
				$this->vars["subscriptionKey"] = $subscriptionKey;	
				$this->vars["activationKey"] = $activationCode;	
				$this->vars["activationCode"] = $activationCode;	
				$this->vars["userKey"] = $userKey;	
				$this->vars["customerKey"] = $customerKey;	
				$this->vars["subscription"] = $sub["subscription"];	
				$this->vars["ipAddress"] = $_SERVER["REMOTE_ADDR"];
				$this->vars["fullname"] = $user->getFullName();
				$this->vars["today"] = date("F d, Y", strtotime("now"));
	
				$subscription->isRead($subscriptionID, true);
				
				return true;
			}
			else {
				$this->view = "login";
				$this->vars["alertError"]=true;
				$this->vars["errorMsg"]="Error Activating: Unable to authenticate URL.";
				return true;
			}
		}
		else {
			$this->view = "login";
			$this->vars["alertError"]=true;
			$this->vars["errorMsg"]="Before accepting, please login first.";
			return true;			
		}
		
	}

	public function sign($params) {

		if ($this->auth->validate($this->userID)) {
	
			$subscriptionKey = $params[2];
			$customerKey = $params[3];
			$activationCode = $params[4];
			$userKey = $params[5];
	
			$subscription = new \FLX\subscriptions($this->db, $this->sessionID, $this->userID);
			
			$auth = $subscription->authenticate($subscriptionKey, $customerKey, $activationCode, $userKey);	
						
			if (($auth["isValid"]) and ($subscription->isRead($auth["sub"]["id"]))) {

				$this->view = "signed";
		
			  	$user = new \BH\user($this->db, $this->userID);
				$customer = new \customer($this->db, $this->sessionID, $this->userID);
				
				$subscriptionID = $auth["sub"]["id"];
				$customerID = $auth["cust"]["id"];
		
				$sub = $this->getSubscription($subscriptionID); 
					
				$this->vars["plan"] = $sub["plan"];
				$this->vars["customer"] = $customer->getCustomer($customerID); 
				$this->vars["subscriptionKey"] = $subscriptionKey;	
				$this->vars["activationKey"] = $activationCode;	
				$this->vars["subscription"] = $sub["subscription"];	
				$this->vars["ipAddress"] = $_SERVER["REMOTE_ADDR"];
				$this->vars["fullname"] = $user->getFullName();
				$this->vars["today"] = date("F d, Y", strtotime("now"));
				$this->vars["signedStamp"] = date("Y-m-d h:i:s", strtotime("now"));

				$success = $subscription->sign($subscriptionID, $this->userID, $this->vars["signedStamp"], $_SERVER["REMOTE_ADDR"], $this->sessionID);
				
				if ($success) {
					return true;
				}
				else {
					$this->view = "accept";
					$this->vars["alertError"]=true;
					$this->vars["errorMsg"]="Error occurred while signing.  Please try again.";
				}
			}
			else {
				$this->accept($params);
				$this->vars["alertError"]=true;
				$this->vars["errorMsg"]="Unable to authenticate request.  Please try again.";
				$this->view = "accept";
				return true;
			}	
		}
		else  {
			$this->view = "login";
			$this->vars["alertError"]=true;
			$this->vars["errorMsg"]="Unable to sign, not logged in.";
			return true;	
		}
		
	}

	public function paid($params) {
		
		$this->view = "paid";

	  	$user = new \BH\user($this->db, $this->userID);
		$customer = new \customer($this->db, $this->sessionID, $this->userID);
		$subscription = new \FLX\subscriptions($this->db, $this->sessionID, $this->userID);
		
		$subscriptionID = $params[4];
		$customerID = $params[3];
		$subscriptionKey = $params[2];

		$sub = $this->getSubscription($subscriptionID); 
			
		$this->vars["plan"] = $sub["plan"];
		$this->vars["customer"] = $customer->getCustomer($customerID); 
		$this->vars["subscriptionKey"] = $params[2];	
		$this->vars["activationKey"] = $params[2];	
		$this->vars["subscription"] = $sub["subscription"];	
		$this->vars["firstName"] = $this->vars["customer"]["firstName"];	
		$this->vars["lastName"] = $this->vars["customer"]["lastName"];	
		$this->vars["customerName"] = $this->vars["customer"]["name"];	
		$this->vars["customerKey"] = $this->vars["customer"]["customerKey"];	
		$bhUser = $user->getUser($this->userID);
		$this->vars["userKey"] = $bhUser["userKey"];	
		$this->vars["activationCode"] = $bhUser["activationCode"];

		$emailAddress = $bhUser["emailAddress"];

		$welcome = new \template($this->db, "MAIL_WELCOME");
		$notify = new \template($this->db, "MAIL_NOTIFY");

		$thankyou = $welcome->fetch($this->vars);
		$alert = $notify->fetch($this->vars);

		$outside_email = new \mg($this->db, "bluhorn.com", "MAIL_MIME");
		$inside_email = new \mg($this->db, "bluhorn.com", "MAIL_MIME");
		
		$outside_email->from("marie.meyer@bluhorn.com");
		$outside_email->bcc("support@bluhorn.com");
		$outside_email->cc("marie.meyer@bluhorn.com");
		$outside_email->to($emailAddress);
		$outside_email->subject("Thank you for signing up with BluHorn!");
		$outside_email->text("Finish activating your account at: https://bluhorn.filelogix.com/subscribe/accept/" . $params[2] . "/" . $this->vars["customerKey"] . "/" . $this->vars["activationCode"] . "/" . $this->vars["userKey"]);
		$outside_email->html($thankyou);
		
		$messageID = $outside_email->send(1, false);

		$firstName = $this->vars["firstName"];
		$lastName = $this->vars["lastName"];
		$customerName = $this->vars["customerName"];
		$agency = $user->getAgencyByCustomerID($customerID);
		$agencyID = $agency["id"];
		
		$inside_email->from("support@bluhorn.com");
		$inside_email->bcc("wbenwick@bluhorn.com");
		$inside_email->to("marie.meyer@bluhorn.com");
		$inside_email->cc("mike@cfmedia.net");
		$inside_email->subject("Alert: New Subscriber!");
		$inside_email->text("A new subscriber has been added: $firstName $lastName, of $customerName\nhttps://bluhorn.filelogix.com/admin/agency/edit/" . $agencyID);
		$inside_email->html($alert);
		
		$messageID = $inside_email->send(1, false);
			
		return true;		

	}

	public function isValid($customerID, $customerKey) {
				
		$customerIDStr = $this->db->quote($customerID);
		$customerKeyStr = $this->db->quote($customerKey);
		
		$r=$this->db->query("select * from FLX_CUSTOMERS where id = $customerIDStr and customerKey = $customerKeyStr and isActive is FALSE");
		 
		$results=$r->fetch(\PDO::FETCH_ASSOC);

		if ($results["id"]) {
			return $results["id"];
		}
		else {
			return false;
		}
		
		return false;
				
	}

	public function start() {
		
		if ($this->userID > 0) {
			
			$customer = new \customer($this->db, $this->sessionID, $this->userID);

			$cust = $customer->getCustomerByUserID($this->userID);
			
			$customerID = $cust["id"];
			$customerKey = $cust["customerKey"];

			return $this->choose(array($this->userID, $this->sessionID, $customerID, $customerKey));
			
		} 
		
	}

	public function choose($params) {

			$customerID = $params[2];
			$customerKey = $params[3];
								
			$customer = new \customer($this->db, $this->sessionID, $this->userID);
			$subscribe = new \subscribe($this->db);
			$subscription = new \FLX\subscriptions($this->db, $this->sessionID, $this->userID);

			$random = new \random(6,6);
			$randomStr = $random->token(6);			
			
			$subscriptionKey = $randomStr;

			$isValid = $this->isValid($customerID, $customerKey);
						
			if ($isValid) {

				$this->view="choose";
				$this->vars["plans"] = $subscribe->plans(true); 
				$this->vars["customer"] = $customer->getCustomer($customerID); 
				$this->vars["subscriptionKey"] = $subscriptionKey;
			
			}
			else {
				
				$this->view="register";
				$this->vars["alertError"]=true;
				$this->vars["errorMsg"]="Error: Invalid Customer.";
				$this->vars["signUpHide"]="";
			}
			
			return true;
	}
	
	public function change($params) {
		
			$customer = new \customer($this->db, $this->sessionID, $this->userID);
			$subscribe = new \subscribe($this->db);
			$subscription = new \FLX\subscriptions($this->db, $this->sessionID, $this->userID);
			
			$subscriptionKey = $params[3];
			$customerID = $params[4];
			
			$subscriptionID = $subscription->findSubscription($subscriptionKey, $customerID, $params[5]);
			
			if ($subscriptionID == $params[5]) {
			
				$sub = $this->getSubscription($subscriptionID);		
	
				error_log("change: " . print_r($sub["subscription"], true));
				error_log("change: " . print_r($sub["plan"], true));
				
				$this->view="choose";
				$this->vars["plans"] = $subscribe->plans(true); 
				$this->vars["customer"] = $customer->getCustomer($params[4]); 
				$this->vars["subscriptionKey"] = $params[3];
			
			}
			else {
				
				$this->view="register";
				$this->vars["alertError"]=true;
				$this->vars["errorMsg"]="An error occurred.";
				$this->vars["signUpHide"]="";
			}
			
			return true;
	}
	
	public function confirm($params) {
			
		$customer = new \customer($this->db, $this->sessionID, $this->userID);
		$subscription = new \FLX\subscriptions($this->db, $this->sessionID, $this->userID);
		
		$customerID = $params[3];
		$subscriptionKey = $params[2];

		$extras = $_POST["extras"];
		$planID= $_POST["planID"];

		if ($planID > 0) {
			
			$subscriptionID = $subscription->subscribeByKey($subscriptionKey, $customerID, $planID, $extras);

		}
		else {
			
			$subscriptionID = $subscription->findSubscription($subscriptionKey, $customerID);

		}
		
		if ($subscriptionID > 0) {

			$this->getSubscription($subscriptionID);		
			$this->vars["subscriptionKey"] = $subscriptionKey;
			$this->vars["planID"] = $planID;
			$this->vars["customerID"] = $customerID;
			$this->view="subscribe";
			return true;

		}
		
		else {
					
			$this->view="register";
			$this->vars["alertError"]=true;
			$this->vars["errorMsg"]="An error occurred.";
			$this->vars["signUpHide"]="";

		}
			
		return true;
		
		
		
	}

	private function getSubscription($subscriptionID) {
			
			$items = array();
	
			$customer = new \customer($this->db, $this->sessionID, $this->userID);
			$subscription = new \FLX\subscriptions($this->db, $this->sessionID, $this->userID);
		
			$sub = $subscription->getSubscription($subscriptionID); 
			$plan = $subscription->getPlanByID($sub["plan"]["id"]);
			 
			$this->vars["plan"] = $sub["plan"];
			$this->vars["customer"] = $customer->getCustomer($sub["subscription"]["customerID"]); 
			$this->vars["subscriptionKey"] = $params[2];	
			$this->vars["subscription"] = $sub["subscription"];	
			$this->vars["planID"] = $sub["plan"]["id"];	

			$lineNumber = 1;

			$line = array();
			$line["lineNumber"] = $lineNumber++;
			$line["description"] = $sub["plan"]["description"];
			$line["qty"] = 1;
			$line["amount"] = $sub["plan"]["amount"];
			$line["term"] = $sub["plan"]["term"];
			$line["period"] = $plan["period"];
			$line["periodStr"] = $plan["periodStr"];
			$line["total"] = $sub["plan"]["amount"];			
			
			array_push($items, $line);
			
			foreach ($sub["extras"] as $extra) {
				
				$line = array();
				$line["lineNumber"] = $lineNumber++;
				$line["description"] = $extra["license"];
				$line["qty"] = $extra["quantity"];
				$line["amount"] = $extra["amount"];
				$line["term"] = $sub["plan"]["term"];
				$line["total"] = $extra["total"];
				
				array_push($items, $line);

			}

			$this->vars["items"] = $items;

			return $sub;
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
			return $this->view;
		}
	}
	
	public function transfer() {
		
		return $this->transfer;
	}
	
	public function ajax($params) {

		  $this->view = "ajax-response";	

		 if ($params[2] == "payment") {
				  
		  	if ($params[3] == "cc") {
		  		 
		  		 if ($_POST["token"] != "") { 
			  		  
			  		  $subscriptionKey = $params[4];
			  		  $customerID = $params[5];
			  		  $subscriptionID = $params[6];
			  		  					  
					  $response = array();	
					
					  $stripe = new \FLX\stripe($this->db, "Live", "sk_live_mXU1UbR4mwxUHeTd9Q1FNDC2");
					  $customer = new \customer($this->db, $this->sessionID, $this->userID);
					  $subscription = new \FLX\subscriptions($this->db, $this->sessionID, $this->userID);
	
					  $cust = $customer->getCustomer($customerID);

					  if ($cust["stripeID"] == 0) {
					
					  	$stripeID = $stripe->createCustomer($_POST["token"], $cust);
					
					  }
					  
					  else {
					  	if($stripe->updateCustomer($_POST["token"], $customerID, $cust)) {
						  	$stripeID = $cust["stripeID"];
					  	}
					  	else {
						  	$stripeID = 0;
					  	}
					  }
	
					  if ( $stripeID ) {
						  	$customer->saveCustomer($customerID, array("stripeID"=>$stripeID));

						  	$subscription->isActive($subscriptionID, true);
						  	$customer->isActive($customerID, true);
						  					
						  	$cust = $customer->getCustomer($customerID);

error_log("Subscribe: " . $cust["userID"] . "=" . $this->userID);

						  	if ($cust["userID"] == $this->userID) {
						  	
							  	$agency = new \BH\agency($this->db, $this->sessionID, $this->userID);
							  	$user = new \BH\user($this->db, $this->userID);

							  	$agencyID = $agency->addAgency(array("name"=>$cust["name"], "address"=>$cust["address"], "phoneNumber"=>$cust["phoneNumber"], "customerID"=>$cust["id"], "contactName"=>$cust["firstName"] . " " . $cust["lastName"]), true);	

							  	if ($agencyID > 0) {

								  	error_log("Subscribe: Agency Created. $agencyID");

								  	$bhUserID = $user->addUser($cust["userID"], $agencyID);

								  	error_log("Subscribe: BluHorn User Created. $bhUserID");
							  	
								  	$user->set($bhUserID, "isSelected", true);
								  	$user->set($bhUserID, "isBilling", true);
								  	$user->set($bhUserID, "isAgencyAdmin", true);
								  	$user->set($bhUserID, "isDefault", true);
	
								  	if ($bhUserID > 0) {
									  	$users = new \users($this->db);
									  	$users->isSubscribed($this->userID, true);
									}
									
									$response["message"] = "Credit Card Processed!";
									$response["error"] = false;
									$this->vars["response"] = json_encode($response);
									return true;
								}
								else {
									error_log("Credit Card Saved. Unable to create agency.");
									$response["error"] = true;
									$response["message"] = "Credit Card Saved.  Unable to create agency automatically.  Please check your email.";
									$this->vars["response"] = json_encode($response);
									return true;									
								}
							}
							else {
								error_log("Credit Card Saved. User Invalid.");
								$response["error"] = true;
								$response["message"] = "Credit Card Saved. Error assigning user to account.  Please check your email.";
								$this->vars["response"] = json_encode($response);
								return true;
							}
					  }
					  else {
						  	$response["message"] = "<span style='color:#f00'>Error! Credit Card Information Not Saved.</span>";
					  		$response["error"] = true;
					  		$this->vars["response"] = json_encode($response);		
						  	return true;
					  }
				 }
		  		 else {
						error_log("Credit Card Error.");
						$response["error"] = true;
						$response["message"] = "Credit Card Error. Please check and try again.";
						$this->vars["response"] = json_encode($response);
						return false;
		  		 }
			}
		}
		
		error_log("Ajax Error.");
		$response["message"] = "System Error. Please check and try again.";
		$this->vars["response"] = json_encode($response);
		return false;
		return false;

	}
	
	


}
?>
