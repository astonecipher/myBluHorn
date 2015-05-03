<?php

/**
 * BLUHORN ORDER CLASS
 *  
 * @author Wes Benwick
 * @link http://www.filelogix.com
 * @license Part of Filelogix usage license
 */ 
  
namespace BH;

class order
{  
    // Will store database connection here
	private $db;
	private $sessionID;
	private $clientID;
	private $agencyID;
	private $userID;

	
	public function __construct($db, $agencyID, $userID) {
	  $this->db = $db;
	  $this->agencyID = $agencyID;
	  $this->userID = $userID;
	  $this->sessionID = session_id();
	  
	  if (!$agencyID) {
		  return false;
	  }
	  
	  if (!$userID) {
		  return false;
	  }
		
	}

	public function getClientID() {
		return $this->clientID;
	}

	public function create($worksheetID, $params = array(), $vendors = array(), $type, $details = array()) {
		
		$params["orderKey"] = md5($worksheetID . $this->agencyID . strtotime("now"));
		$params["orderCreated"] = date("Y-m-d H:i:s",strtotime("now"));
		$params["userID"] = $this->userID;
		$params["contractNumber"] = $this->agencyID . str_pad($worksheetID, 7, "0", STR_PAD_LEFT);

		$orderID = $this->db->insert("BH_ORDERS", $params);

		error_log("BH_ORDERS: $type");
		
		if ($type != "") {
			$orderType = strtoupper($type);
			$details["orderID"] = $orderID;
			$this->db->insert("BH_ORDER_".$orderType, $details);
		}
		
		foreach ($vendors as $vendor) {
			$this->db->insert("BH_ORDER_VENDORS", array("vendorID"=>$vendor, "agencyID"=>$this->agencyID, "orderID"=>$orderID));		
		}
		
		return $orderID;
	}

	public function preview($worksheetID, $params = array(), $vendors = array(), $type, $details = array()) {
		
		$params["orderKey"] = md5($worksheetID . $this->agencyID . strtotime("now"));
		$params["orderCreated"] = date("Y-m-d H:i:s",strtotime("now"));
		$params["userID"] = $this->userID;
		$params["isPreview"] = true;
		$params["contractNumber"] = "PREVIEW / DRAFT";

		$orderID = $this->db->insert("BH_ORDERS", $params);

		error_log("BH_ORDERS: $type");
		
		if ($type != "") {
			$orderType = strtoupper($type);
			$details["orderID"] = $orderID;
			$this->db->insert("BH_ORDER_".$orderType, $details);
		}
		
		foreach ($vendors as $vendor) {
			$this->db->insert("BH_ORDER_VENDORS", array("vendorID"=>$vendor, "agencyID"=>$this->agencyID, "orderID"=>$orderID));		
		}
		
		return $orderID;
	}

	public function addClient($client = array()) {
	  
	  if ($this->exists($client)) {
		  
		  return false;
	  }
	  
	  else {
		  
		  $client["isActive"] = true;
		  $client["agencyID"] = $this->agencyID;
		  
		  $this->clientID = $this->db->insert("BH_CLIENTS", $client);
		  
		  error_log("Add Client: " . $this->db->lastQuery());

		  return $this->clientID;
	  }
				
	  return $results;

		
	}

	public function cancel($worksheetID) {
	  
	  if ($worksheetID > 0) {
			  	$currentTimeStr = date("Y-m-d H:i:s",strtotime("now"));
				$result = $this->db->updateWhere("BH_ORDERS", array("worksheetID"=>$worksheetID, "agencyID"=>$this->agencyID), array("isCancelled"=>"1", "orderCancelled"=>$currentTimeStr));		
				if ($result) {
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
		
	public function saveClient($clientID, $client = array()) {

	  if ($this->unique($clientID, $client)) {
	  
		  if ($clientID>0) {
				if ($client["agencyID"] == $this->agencyID) {
					$result = $this->db->update("BH_CLIENTS", "id", $clientID,  $client);		
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

	public function getOrderKeyByOrderID($orderID) {
		$orderIDStr = $this->db->quote($orderID);
		
		$r=$this->db->query("select orderKey from BH_ORDERS where id = $orderIDStr and agencyID = \"$this->agencyID\"");
		 
		$results=$r->fetch(\PDO::FETCH_ASSOC);

		if ($results["orderKey"]) {
				return $results["orderKey"];
		}
		else {
			return false;
		}
		
	}	


	public function getOrderByKey($orderKey) {
		$orderKeyStr = $this->db->quote($orderKey);
		
		$r=$this->db->query("select * from BH_ORDERS where orderKey = $orderKeyStr and agencyID = \"$this->agencyID\" limit 1");
		 
		$results=$r->fetch(\PDO::FETCH_ASSOC);

		error_log("OrderByKey: " . $this->db->lastQuery());

		if ($results["id"]) {
				return $results;
		}
		else {
			return false;
		}
		
	}

	public function getOrderDetails($orderID, $orderType) {
		$orderIDStr = $this->db->quote($orderID);
		
		$orderTypeStr = strtoupper($orderType);
		
		$r=$this->db->query("select * from BH_ORDER_$orderTypeStr where orderID = $orderIDStr limit 1");
		 
		$results=$r->fetch(\PDO::FETCH_ASSOC);

		error_log("Order Details: " . $this->db->lastQuery());

		if ($results["id"]) {
				return $results;
		}
		else {
			return false;
		}
		
	}


	public function getLastOrderByWorksheetID($worksheetID) {
		$worksheetIDStr = $this->db->quote($worksheetID);
		
		$r=$this->db->query("select * from BH_ORDERS where worksheetID = $worksheetIDStr and agencyID = \"$this->agencyID\" and isPreview is FALSE order by revision desc, orderCreated desc limit 1");
		 
		$results=$r->fetch(\PDO::FETCH_ASSOC);

		if ($results["id"]) {
				return $results;
		}
		else {
			return false;
		}
		
	}

	public function getOrderVendorsByOrderID($orderID) {
		$orderIDStr = $this->db->quote($orderID);
		
		$r=$this->db->query("select vendorID from BH_ORDER_VENDORS where BH_ORDER_VENDORS.orderID = $orderIDStr ");

		error_log("OrderVendorsByOrderID: " . $this->db->lastQuery());
		 
		$results=$r->fetchAll(\PDO::FETCH_COLUMN,0);
		
		return $results;
		
	}

	public function getOrderIDByKey($orderKey) {
		$orderKeyStr = $this->db->quote($orderKey);
		
		$r=$this->db->query("select id from BH_ORDERS where orderKey = $orderKeyStr and agencyID = \"$this->agencyID\"");
		 
		$results=$r->fetch(\PDO::FETCH_ASSOC);

		if ($results["id"]) {
				return $results["id"];
		}
		else {
			return false;
		}
		
	}
	
	public function getClient($clientID) {
		$clientIDStr = $this->db->quote($clientID);
		
		$r=$this->db->query("select * from BH_CLIENTS where id = $clientIDStr and agencyID = \"$this->agencyID\"");
		 
		$results=$r->fetch(\PDO::FETCH_ASSOC);

		error_log("Client Exists: " . $this->db->lastQuery());

		if ($results["id"]) {
				$this->clientID = $results["id"];
				return $results;
		}
		else {
			return false;
		}
		
	}	
	
	public function unique($clientID, $client = array()) {
		
		$clientNameStr = $this->db->quote($client["name"]);
		$clientIDStr = $this->db->quote($clientID);
		
		$r=$this->db->query("select * from BH_CLIENTS where name = $clientNameStr and id != $clientIDStr and agencyID = '$this->agencyID'");
		 
		$results=$r->fetch(\PDO::FETCH_ASSOC);

		error_log("Client Name Unique?: " . $this->db->lastQuery());

		if ($results["name"] == $client["name"]) {
				return false;
		}
		else {
			return true;
		}

	}

	public function exists($client = array()) {
		
		$clientNameStr = $this->db->quote($client["name"]);

		if (($client["source"] != "") and ($client["refID"] > 0)) {
			$sourceStr = $this->db->quote($client["source"]);
			$refIDStr = $this->db->quote($client["refID"]);
			
			$sourceRefIDStr = " and source = $sourceStr and refID = $refIDStr ";	
		}	
		else {
			$sourceRefIDStr = "";
		}
		
		$r=$this->db->query("select * from BH_CLIENTS where name = $clientNameStr and agencyID = '$this->agencyID' $sourceRefIDStr");
		 
		$results=$r->fetch(\PDO::FETCH_ASSOC);

		error_log("Client Exists: " . $this->db->lastQuery());

		if ($results["name"] == $client["name"]) {
				$this->clientID = $results["id"];
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
		
		$r=$this->db->query("select * from BH_CLIENTS where name = $clientNameStr and agencyID = '$this->agencyID' and source = $sourceStr and refID = $refIDStr ");
		 
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
	
	public function getAllClients() {
		
		  $agencyIDStr = $this->db->quote($this->agencyID);
				  
		  $r=$this->db->query("select * from BH_CLIENTS where agencyID = $agencyIDStr and isDeleted is FALSE order by name asc");
	      $results=$r->fetchAll();
	
		  error_log($this->db->lastQuery());
			
		  return $results;
	  
	  
	}

	public function getAllOrders($agencyID, $grouped) {
		
		  $agencyIDStr = $this->db->quote($agencyID);
				  
		  $groupByStr = "group by BH_ORDERS.worksheetID, BH_ORDERS.revision";		  
				  
		  $r=$this->db->query("select *,BH_CLIENTS.name as clientName, BH_CAMPAIGNS.name as campaignName, BH_WORKSHEETS.name as worksheetName, lcase(BH_VENDOR_TYPES.shortName) as worksheetType, BH_WORKSHEETS.totalSpend as orderAmount from BH_ORDERS left join BH_WORKSHEETS on (BH_WORKSHEETS.id = BH_ORDERS.worksheetID) left join BH_CAMPAIGNS on (BH_CAMPAIGNS.id = BH_ORDERS.campaignID) left join BH_CLIENTS on (BH_CLIENTS.id = BH_CAMPAIGNS.clientID) left join BH_VENDOR_TYPES on (BH_VENDOR_TYPES.id = BH_WORKSHEETS.typeID) where BH_ORDERS.agencyID = $agencyIDStr and BH_ORDERS.isDeleted is FALSE $groupByStr order by BH_ORDERS.orderCreated desc");
	      $results=$r->fetchAll();
	
		  error_log($this->db->lastQuery());
			
		  return $results;
	  
	  
	}

	public function getCancelledOrders($agencyID, $grouped) {
		
		  $agencyIDStr = $this->db->quote($agencyID);
				  
		  $groupByStr = "group by BH_ORDERS.worksheetID, BH_ORDERS.revision";		  
				  
		  $r=$this->db->query("select *,BH_CLIENTS.name as clientName, BH_CAMPAIGNS.name as campaignName, BH_WORKSHEETS.name as worksheetName, lcase(BH_VENDOR_TYPES.shortName) as worksheetType, BH_WORKSHEETS.totalSpend as orderAmount from BH_ORDERS left join BH_WORKSHEETS on (BH_WORKSHEETS.id = BH_ORDERS.worksheetID) left join BH_CAMPAIGNS on (BH_CAMPAIGNS.id = BH_ORDERS.campaignID) left join BH_CLIENTS on (BH_CLIENTS.id = BH_CAMPAIGNS.clientID) left join BH_VENDOR_TYPES on (BH_VENDOR_TYPES.id = BH_WORKSHEETS.typeID) where BH_ORDERS.agencyID = $agencyIDStr and BH_ORDERS.isDeleted is FALSE and BH_ORDERS.isCancelled is TRUE $groupByStr order by BH_ORDERS.orderCreated desc");
	      $results=$r->fetchAll();
	
		  error_log($this->db->lastQuery());
			
		  return $results;
	  
	  
	}

	public function getArchivedOrders($agencyID, $grouped) {
		
		  $agencyIDStr = $this->db->quote($agencyID);
				  
		  $groupByStr = "group by BH_ORDERS.worksheetID, BH_ORDERS.revision";		  
				  
		  $r=$this->db->query("select *,BH_CLIENTS.name as clientName, BH_CAMPAIGNS.name as campaignName, BH_WORKSHEETS.name as worksheetName, lcase(BH_VENDOR_TYPES.shortName) as worksheetType, BH_WORKSHEETS.totalSpend as orderAmount from BH_ORDERS left join BH_WORKSHEETS on (BH_WORKSHEETS.id = BH_ORDERS.worksheetID) left join BH_CAMPAIGNS on (BH_CAMPAIGNS.id = BH_ORDERS.campaignID) left join BH_CLIENTS on (BH_CLIENTS.id = BH_CAMPAIGNS.clientID) left join BH_VENDOR_TYPES on (BH_VENDOR_TYPES.id = BH_WORKSHEETS.typeID) where BH_ORDERS.agencyID = $agencyIDStr and BH_ORDERS.isDeleted is FALSE and BH_ORDERS.isArchived is TRUE $groupByStr order by BH_ORDERS.orderCreated desc");
	      $results=$r->fetchAll();
	
		  error_log($this->db->lastQuery());
			
		  return $results;
	  
	  
	}

	public function getActiveOrders($agencyID, $grouped) {
		
		  $agencyIDStr = $this->db->quote($agencyID);
				  
		  $groupByStr = "group by BH_ORDERS.worksheetID, BH_ORDERS.revision";		  
				  
		  $r=$this->db->query("select *,BH_CLIENTS.name as clientName, BH_CAMPAIGNS.name as campaignName, BH_WORKSHEETS.name as worksheetName, lcase(BH_VENDOR_TYPES.shortName) as worksheetType, BH_WORKSHEETS.totalSpend as orderAmount from BH_ORDERS left join BH_WORKSHEETS on (BH_WORKSHEETS.id = BH_ORDERS.worksheetID) left join BH_CAMPAIGNS on (BH_CAMPAIGNS.id = BH_ORDERS.campaignID) left join BH_CLIENTS on (BH_CLIENTS.id = BH_CAMPAIGNS.clientID) left join BH_VENDOR_TYPES on (BH_VENDOR_TYPES.id = BH_WORKSHEETS.typeID) where BH_ORDERS.agencyID = $agencyIDStr and BH_ORDERS.isDeleted is FALSE and BH_ORDERS.isActive is TRUE $groupByStr order by BH_ORDERS.orderCreated desc");
	      $results=$r->fetchAll();
	
		  error_log($this->db->lastQuery());
			
		  return $results;
	  
	  
	}

	public function getPendingOrders($agencyID, $grouped) {
		
		  $agencyIDStr = $this->db->quote($agencyID);
				  
		  $groupByStr = "group by BH_ORDERS.worksheetID, BH_ORDERS.revision";		  
				  
		  $r=$this->db->query("select *,BH_CLIENTS.name as clientName, BH_CAMPAIGNS.name as campaignName, BH_WORKSHEETS.name as worksheetName, lcase(BH_VENDOR_TYPES.shortName) as worksheetType, BH_WORKSHEETS.totalSpend as orderAmount from BH_ORDERS left join BH_WORKSHEETS on (BH_WORKSHEETS.id = BH_ORDERS.worksheetID) left join BH_CAMPAIGNS on (BH_CAMPAIGNS.id = BH_ORDERS.campaignID) left join BH_CLIENTS on (BH_CLIENTS.id = BH_CAMPAIGNS.clientID) left join BH_VENDOR_TYPES on (BH_VENDOR_TYPES.id = BH_WORKSHEETS.typeID) where BH_ORDERS.agencyID = $agencyIDStr and BH_ORDERS.isDeleted is FALSE and BH_ORDERS.isPending is TRUE $groupByStr order by BH_ORDERS.orderCreated desc");
	      $results=$r->fetchAll();
	
		  error_log($this->db->lastQuery());
			
		  return $results;
	  
	  
	}

	
	public function printOrder() {
		
	}
	
}