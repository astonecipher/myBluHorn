<?php

/**
 * FILELOGIX SUBSCRIPTIONS CLASS
 *  
 * @author Wes Benwick
 * @link http://www.filelogix.com
 * @license Part of Filelogix usage license
 *
 *
 * @description This class accesses subscriptions
 *
 */ 
 
namespace FLX;

class subscriptions
{  
    // Will store database connection here
	private $db;
	private $sessionID;
	private $subscriptionID;
	private $customerID;
	private $error;
	
	public function __construct($db, $sessionID, $userID) {
	  $this->db = $db;
	  $this->sessionID = $sessionID;
	  $this->userID = $userID;
		
	}

	public function exists($subscriptionKey, $customerID = null, $subscriptionID = null) {
		
		$subscriptionKeyStr = $this->db->quote($subscriptionKey);
		
		if ($customerID > 0) {
			$customerIDStr = $this->db->quote($customerID);
			$customerStr = " and customerID = " . $customerIDStr;
		} 
		else {
			$customerStr = "";
		}

		if ($subscriptionID > 0) {
			$subscriptionIDStr = $this->db->quote($subscriptionID);
			$subscriptionStr = " and id = " . $subscriptionIDStr;
		} 
		else {
			$subscriptionStr = "";
		}
		
		$r=$this->db->query("select * from FLX_SUBSCRIPTIONS where subscriptionKey = $subscriptionKeyStr $customerStr $subscriptionStr and isDeleted is FALSE order by id desc limit 1");
		 
		$results=$r->fetch(\PDO::FETCH_ASSOC);

		if ($results["subscriptionKey"] == $subscriptionKey) {
				$this->subscriptionID = $results["id"];
				$this->customerID = $results["customerID"];
				return true;
		}
		else {
			return false;
		}

	}

	public function isSubscribed($customerID) {
		
		$customerIDStr = $this->db->quote($customerID);
		
		$r=$this->db->query("select * from FLX_SUBSCRIPTIONS where customerID = $customerIDStr  and isDeleted is FALSE and isActive is TRUE");
		 
		$results=$r->fetch(\PDO::FETCH_ASSOC);

		error_log("isSubscribed: " . $this->db->lastQuery());

		if ($results["customerID"] == $customerID) {
				$this->subscriptionID = $results["id"];
				$this->customerID = $results["customerID"];
				return true;
		}
		else {
			return false;
		}

	}

	public function isActive($subscriptionID, $isActive) {
		
		$subscriptionIDStr = $this->db->quote($subscriptionID);

		if ($isActive) {
			$isActiveStr = 1;
		}
		else {
			$isActiveStr = 0;
		}

		if (isset($isActive)) {
			$this->db->update("FLX_SUBSCRIPTIONS", "id", $subscriptionID, array("isActive"=>$isActiveStr));
		}
		
		$r=$this->db->query("select * from FLX_SUBSCRIPTIONS where id = $subscriptionIDStr");
		 
		$results=$r->fetch(\PDO::FETCH_ASSOC);

		return $results["isActive"];

	}

	public function isRead($subscriptionID, $isRead) {
		
		$subscriptionIDStr = $this->db->quote($subscriptionID);

		if ($isRead) {
			$isReadStr = 1;
		}
		else {
			$isReadStr = 0;
		}

		if (isset($isRead)) {
			$this->db->update("FLX_SUBSCRIPTIONS", "id", $subscriptionID, array("isRead"=>$isReadStr));
		}
		
		$r=$this->db->query("select * from FLX_SUBSCRIPTIONS where id = $subscriptionIDStr");
		 
		$results=$r->fetch(\PDO::FETCH_ASSOC);

		return $results["isRead"];

	}

	public function sign($subscriptionID, $userID, $signStamp, $ipAddress, $sessionID) {

		return $this->db->update("FLX_SUBSCRIPTIONS", "id", $subscriptionID, array("isSigned"=>true, "signedBy"=>$userID, "signedOn"=>$signStamp, "signedFrom"=>$ipAddress, "sessionID"=>$sessionID));

	}
		
	public function subscribeByKey($subscriptionKey, $customerID, $planID, $extras = array()) {
	  
	  	$subscribe = array();
	  	
	  	$valid = false;
	  	
	  	//validate plan by looking it up

		$plans = $this->getPlanByID($planID);

	  	//validate customer and key by looking it up
	  	
	  	$customer = $this->getCustomerByID($customerID);
	  	
	  	if (($plans["id"] == $planID) and ($customer["id"] == $customerID)) {
		  	error_log("sub valid");
		  	$valid = true;
	  	}

	  	if ($this->exists($subscriptionKey)) {
		  	
		  	if ($this->customerID == $customerID) {
//			  	return $this->subscriptionID;
			}
			else {
				return false;
			}
	  	}

	  	if ($this->isSubscribed($customerID)) {
		  	
		  	if ($this->customerID == $customerID) {
			  	return $this->subscriptionID;
			}
			else {
				return false;
			}
	  	}
	  	 	  	
	  	if ($valid) {
	  	
	  			$amount = $plans["rate"];
	  			$userCount = $this->getLicenseCountByPlan($planID, "user");
	  			
	  			foreach ($extras as $extra) {
		  			
		  			$amount += floatval($extra["qty"] * $extra["amount"]);
		  			if ($extra["type"] == "user") {
			  			$userCount += intval($extra["qty"]);
			  			$userCost = $extra["amount"];
		  			}
	  			}
	  	
			  	$subscribe["customerID"] = $customerID;
			  	$subscribe["userID"] = $this->userID;
			  	$subscribe["created"] = date("Y-m-d h:i:s",strtotime(now));
			  	$subscribe["period"] = $plans["period"];
			  	$subscribe["amount"] = $amount;
			  	
			  	if ($subscribe["isRecurring"]) {
				  	$subscribe["balance"] = $plans["term"] * $amount;
				}
				else {
				  	$subscribe["balance"] = $amount;					
				}
				
			  	$subscribe["subscriptionKey"] = $subscriptionKey;
			  	$subscribe["status"] = "new";
			  
				$this->subscriptionID = $this->db->insert("FLX_SUBSCRIPTIONS", $subscribe);

				$plan = array();
				$plan["planID"] = $plans["id"];
				$plan["subscriptionID"] = $this->subscriptionID;
				$plan["amount"] = $plans["rate"];
				$plan["term"] = $plans["term"];
				$plan["startDate"] = date("Y-m-d", strtotime("now"));
				$plan["expirationDate"] = date("Y-m-d", strtotime("+" . $plans["term"] . " " . $plans["periodStr"]));
				$plan["renewalDate"] = date("Y-m-d", strtotime($plan["expirationDate"] . " - 30 days"));
				$plan["isActive"] = false;
				$plan["userCount"] = "1";
				$plan["userCost"] = $userCost;
				$plan["maxUsers"] = $userCount;

				$subPlanID = $this->db->insert("FLX_PLAN", $plan);

				$licenses = $this->getLicenses($planID);

				foreach ($licenses as $license) {
					$lic = array();
					$lic["licenseID"] = $license["id"];
					$lic["planID"] = $subPlanID;
					$lic["extraID"] = 0;
					$lic["quantity"] = $license["meter"];
					$licID = $this->db->insert("FLX_LICENSE", $lic);					
				}
				
				foreach ($extras as $extra) {
					$extra["licenseID"] = $this->getExtraLicenseID($extra["id"]);
					$extra["license"] = $this->getExtraLicense($extra["id"]);					
					
					$xtra = array();
					$xtra["extraID"] = $extra["id"];
					$xtra["subscriptionID"] = $this->subscriptionID;
					$xtra["customerID"] = $customerID;
					$xtra["quantity"] = $extra["qty"];
					$xtra["total"] = floatval($extra["amount"] * $extra["qty"]);
					$xtra["isActive"] = true;

					$subExtraID = $this->db->insert("FLX_PLAN", $plan);

					$license = array();
					$license["licenseID"] = $extra["licenseID"];
					$license["planID"] = $subPlanID;
					$license["extraID"] = $subExtraID;
					$license["quantity"] = $extra["qty"];
					$licenseID = $this->db->insert("FLX_LICENSE", $license);
				}
								
				return $this->subscriptionID;
		}

		return false;
		
	}

	public function findSubscription($subscriptionKey, $customerID, $subscriptionID) {
		
		if ($this->exists($subscriptionKey, $customerID, $subscriptionID)) {
			return $this->subscriptionID;
		}
		else {
			return false;
		}
	}

	public function getSubscription($subscriptionID) {
	  
		$plan = array();
		$extras = array();
	
		$subscriptionIDStr = $this->db->quote($subscriptionID);

		$r=$this->db->query("select * from FLX_SUBSCRIPTIONS where id = $subscriptionIDStr ");
		 
		$subscription=$r->fetch(\PDO::FETCH_ASSOC);

		// query plans for the specified subscriptionID
		
		$r=$this->db->query("select * from FLX_PLAN left join FLX_PLANS on (FLX_PLAN.planID = FLX_PLANS.id) where subscriptionID = $subscriptionIDStr ");
		 
		$plan=$r->fetch(\PDO::FETCH_ASSOC);
	
		// query extras for the specificied subscriptionID

		$r=$this->db->query("select * from FLX_EXTRA left join FLX_EXTRAS on (FLX_EXTRA.extraID = FLX_EXTRAS.id) left join FLX_LICENSES on (FLX_EXTRAS.licenseID = FLX_LICENSES.id) where subscriptionID = $subscriptionIDStr ");
		 
		$extras=$r->fetchAll();
	
		return array("subscription"=>$subscription, "plan"=>$plan, "extras"=>$extras);
		
	}

	public function getPlanByID($planID) {

		$planIDStr = $this->db->quote($planID);
		
		$r=$this->db->query("select * from FLX_PLANS where id = $planIDStr ");
		 
		$results=$r->fetch(\PDO::FETCH_ASSOC);

		error_log("Plan Exists: " . $this->db->lastQuery());

		if ($results["id"]) {
			return $results;
		}
		else {
			return false;
		}		
		
	}
	
	public function getCustomerByID($customerID) {

		$customerIDStr = $this->db->quote($customerID);
		
		$r=$this->db->query("select * from FLX_CUSTOMERS where id = $customerIDStr ");
		 
		$results=$r->fetch(\PDO::FETCH_ASSOC);

		error_log("Customer Exists: " . $this->db->lastQuery());

		if ($results["id"]) {
			return $results;
		}
		else {
			return false;
		}		
		
	}

	public function getExtraLicenseID($extraID) {

		$extraIDStr = $this->db->quote($extraID);
		
		$r=$this->db->query("select * from FLX_EXTRA where id = $extraIDStr ");
		 
		$results=$r->fetch(\PDO::FETCH_ASSOC);

		error_log("Extra Exists: " . $this->db->lastQuery());

		if ($results["id"]) {
			return $results["licenseID"];
		}
		else {
			return false;
		}		
		
	}	
	
	public function authenticate($subscriptionKey, $customerKey, $activationCode, $userKey) {

		$subscriptionKeyStr = $this->db->quote($subscriptionKey);
		$customerKeyStr = $this->db->quote($customerKey);
		$activationCodeStr = $this->db->quote($activationCode);
		$userKeyStr = $this->db->quote($userKey);
		
		$r=$this->db->query("select * from FLX_SUBSCRIPTIONS where subscriptionKey = $subscriptionKeyStr and isActive is TRUE and isConfirmed is FALSE");
		
		$sub=$r->fetch(\PDO::FETCH_ASSOC);

		$customerIDStr = $this->db->quote($sub["customerID"]);

		$r=$this->db->query("select * from FLX_CUSTOMERS where customerKey = $customerKeyStr and id = $customerIDStr and isConfirmed is FALSE");

		$cust=$r->fetch(\PDO::FETCH_ASSOC);

		$userIDStr = $this->db->quote($sub["userID"]);

		$r=$this->db->query("select * from FLX_USERS where userID = $userIDStr and userKey = $userKeyStr and activationCode = $activationCodeStr and isActive is TRUE and isConfirmed is FALSE");

		$usr=$r->fetch(\PDO::FETCH_ASSOC);
		 
		if (($usr["userID"]) and ($sub["id"]) and ($cust["id"])) {
			return array("isValid"=>true, "sub"=>$sub, "cust"=>$cust, "usr"=>$usr);
		}
		
		return false;
	}

	public function getLicenses($planID) {

		$planIDStr = $this->db->quote($planID);
		
		$r=$this->db->query("select * from FLX_LICENSES where planID = $planIDStr ");
		 
		$results=$r->fetch(\PDO::FETCH_ASSOC);

		error_log("Licenses Exist: " . $this->db->lastQuery());

		if ($results["id"]) {
			return $results;
		}
		else {
			return false;
		}		
	}
	
	public function getLicenseCountByPlan($planID, $license) {

		$planIDStr = $this->db->quote($planID);
		$licenseStr = $this->db->quote($license);
		
		$r=$this->db->query("select * from FLX_LICENSES where planID = $planIDStr and license = $licenseStr");
		 
		$results=$r->fetch(\PDO::FETCH_ASSOC);

		error_log("Licenses Exist: " . $this->db->lastQuery());

		if ($results["id"]) {
			return $results["meter"];
		}
		else {
			return false;
		}		
		
	}		
}

?>