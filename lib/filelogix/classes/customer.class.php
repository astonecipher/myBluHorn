<?php

/**
 * FILELOGIX CUSTOMER CLASS
 *  
 * @author Wes Benwick
 * @link http://www.filelogix.com
 * @license Part of Filelogix usage license
 *
 *
 * @description This class handles the selection and confirmation of subscriptions (plans)
 *
 */ 
 
class customer
{  
    // Will store database connection here
	private $db;
	private $sessionID;
	private $userID;
	private $customerID;
	
	public function __construct($db, $sessionID, $userID) {

		  $this->db = $db;
		  $this->sessionID = $sessionID;
		  $this->userID = $userID;
		  
	}
	
	public function getcustomerID() {
		return $this->customerID;
	}

	public function addCustomer($customer = array()) {
	  
	  if ($this->exists($customer)) {
		  
		  return false;
	  }
	  
	  else {
		  
		  $customer["isActive"] = false;
		  		  
		  $this->customerID = $this->db->insert("FLX_CUSTOMERS", $customer);
		  
		  error_log("Add Customer: " . $this->db->lastQuery());

		  return $this->customerID;
	  }
				
	  return $results;

		
	}
	
/*
	public function deleteCustomer($customerID, $client) {

	  if ($this->customerID == $this->getCustomer($clientID)) {
	  
		  if ($clientID>0) {
				if ($client["customerID"] == $this->customerID) {
					$result = $this->db->update("FLX_CUSTOMERS", "id", $clientID,  array("isDeleted"=>true));		
					if ($result) {
						return true;	
					}
					else {
						return false;
					}
				}
		  }
	  }
	  else {
		  
		  return false;
		  	
	  }
	}	
*/
	
	public function saveCustomer($customerID, $customer = array()) {
	  
	  if ($customerID>0) {
			if ($customer["id"] == $this->customerID) {
				$result = $this->db->update("FLX_CUSTOMERS", "id", $customerID,  $customer);		
				if ($result) {
					return true;	
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
	
	public function getCustomer($customerID) {
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

	
	public function getCustomerByUserID($userID) {
		$userIDStr = $this->db->quote($userID);
		
		$r=$this->db->query("select * from FLX_CUSTOMERS where userID = $userIDStr limit 1");
		 
		$results=$r->fetch(\PDO::FETCH_ASSOC);

		error_log("Customer Exists: " . $this->db->lastQuery());

		if ($results["id"]) {
			return $results;
		}
		else {
			return false;
		}
		
	}	

	public function getCustomerByName($name) {
		$nameStr = $this->db->quote($name);
		
		$r=$this->db->query("select * from FLX_CUSTOMERS where name = $nameStr");
		 
		$results=$r->fetch(\PDO::FETCH_ASSOC);

		error_log("CustomerByName: " . $this->db->lastQuery());

		if ($results["id"]) {
			return $results;
		}
		else {
			return false;
		}
		
	}	
	
	public function unique($clientID, $client = array()) {
		
		$clientNameStr = $this->db->quote($client["name"]);
		$clientIDStr = $this->db->quote($clientID);
		
		$r=$this->db->query("select * from FLX_CUSTOMERS where name = $clientNameStr and id != $clientIDStr and customerID = '$this->customerID' and isDeleted is FALSE");
		 
		$results=$r->fetch(\PDO::FETCH_ASSOC);

		error_log("Client Name Unique?: " . $this->db->lastQuery());

		if ($results["name"] == $client["name"]) {
				return false;
		}
		else {
			return true;
		}

	}

	public function exists($customer = array()) {
		
		$customerNameStr = $this->db->quote($customer["name"]);

		if (($customer["source"] != "") and ($customer["refID"] > 0)) {
			$sourceStr = $this->db->quote($customer["source"]);
			$refIDStr = $this->db->quote($customer["refID"]);
			
			$sourceRefIDStr = " and source = $sourceStr and refID = $refIDStr ";	
		}	
		else {
			$sourceRefIDStr = "";
		}
		
		$r=$this->db->query("select * from FLX_CUSTOMERS where name = $customerNameStr $sourceRefIDStr and isDeleted is FALSE and isActive is TRUE");
		 
		$results=$r->fetch(\PDO::FETCH_ASSOC);

		error_log("Customer Exists: " . $this->db->lastQuery());

		if ($results["name"] == $customer["name"]) {
				$this->customerID = $results["id"];
				return true;
		}
		else {
			return false;
		}

	}	

	public function isActive($customer, $isActive) {
		
		if (is_array($customer)) {
			$customerNameStr = "and name = " . $this->db->quote($customer["name"]);
			$customerIDStr = "";
	
			if (($customer["source"] != "") and ($customer["refID"] > 0)) {
				$sourceStr = $this->db->quote($customer["source"]);
				$refIDStr = $this->db->quote($customer["refID"]);
				
				$sourceRefIDStr = " and source = $sourceStr and refID = $refIDStr ";	
			}	
			else {
				$sourceRefIDStr = "";
			}
			
			if ($customer["id"] > 0) {
				$customerNameStr = "";
				$sourceStr = "";
				$refIDStr = "";
				$sourceRefIDStr = "";
				$customerIDStr = "and id = " . $this->db->quote($customer["id"]);
			}
		}
		else {
			$customerIDStr = "and FLX_CUSTOMERS.id = " . $this->db->quote($customer["id"]);

			if ($isActive) {
				$isActiveStr = 1;
			}
			else {
				$isActiveStr = 0;
			}		
			
			if (isset($isActive)) {
				$this->db->update("FLX_CUSTOMERS", "id", $customerID, array("isActive"=>$isActiveStr));
				error_log("Activate Customer: " . $this->db->lastQuery());
			}	
		}
				
		$r=$this->db->query("select * from FLX_CUSTOMERS where isActive is TRUE and isDeleted is FALSE $customerIDStr $customerNameStr $sourceRefIDStr");
		 
		$results=$r->fetch(\PDO::FETCH_ASSOC);

		error_log("Customer Active?: " . $this->db->lastQuery());

		if ($results["name"] == $customer["name"]) {
				$this->customerID = $results["id"];
				return true;
		}
		else {
			return false;
		}

	}

	public function existsByRefID($source, $refID, $client = array()) {
		
		$sourceStr = $this->db->quote($source);
		$refIDStr = $this->db->quote($refID);
		$clientNameStr = $this->db->quote($client["name"]);
		$clientNameStr = $this->db->quote($client["name"]);
		
		$r=$this->db->query("select * from FLX_CUSTOMERS where name = $clientNameStr and customerID = '$this->customerID' and source = $sourceStr and refID = $refIDStr ");
		 
		$results=$r->fetch(\PDO::FETCH_ASSOC);

		error_log("Client Exists By RefID: " . $this->db->lastQuery());

		if ($results["name"] == $client["name"]) {
				$this->clientID = $results["id"];
				return true;
		}
		else {
			return false;
		}

	}
	
	public function getAllAgencies() {
		
		  $customerIDStr = $this->db->quote($this->customerID);
				  
		  $r=$this->db->query("select * from FLX_CUSTOMERS where  isActive is TRUE order by name asc");
	      $results=$r->fetchAll();
	
		  error_log($this->db->lastQuery());
			
		  return $results;
	  
	  
	}

	public function getAllAgenciesByUserID($userID) {
		
		  $customerIDStr = $this->db->quote($this->customerID);
		  $userIDStr = $this->db->quote($userID);
				  
		  $r=$this->db->query("select * from BH_USERS left join FLX_CUSTOMERS on (BH_USERS.customerID = FLX_CUSTOMERS.id) where BH_USERS.userID = $userIDStr and FLX_CUSTOMERS.isActive is TRUE order by FLX_CUSTOMERS.name asc");
	      $results=$r->fetchAll();
	
		  error_log($this->db->lastQuery());
			
		  return $results;
	  
	  
	}

	public function getAllCustomerUsers($customerID) {
		
		  $customerIDStr = $this->db->quote($customerID);
				  
		  $r=$this->db->query("select * from BH_USERS left join FLX_CUSTOMERS on (BH_USERS.customerID = FLX_CUSTOMERS.id) left join FLX_USERS on (FLX_USERS.userID = BH_USERS.userID) where BH_USERS.customerID = $customerIDStr and BH_USERS.isActive is TRUE and BH_USERS.isSupport is FALSE order by FLX_USERS.lastName asc, FLX_USERS.firstName asc");
	      $results=$r->fetchAll();
	
		  error_log($this->db->lastQuery());
			
		  return $results;
	  
	  
	}


	
}

?>