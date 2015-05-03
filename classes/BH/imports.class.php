<?php

/**
 * BLUHORN IMPORTS CLASS
 *  
 * @author Wes Benwick
 * @link http://www.filelogix.com
 * @license Part of Filelogix usage license
 */ 
  
namespace BH;

class imports
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


	public function xml_to_array($xml) {

	    $deXml = simplexml_load_string($xml);
	    $deJson = json_encode($deXml);
	    $xml_array = json_decode($deJson,TRUE);

        return $xml_array;

	}

	public function getClientID() {
		return $this->clientID;
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
	
	public function deleteClient($clientID, $client) {

	  if ($this->agencyID == $this->getAgency($clientID)) {
	  
		  if ($clientID>0) {
				if ($client["agencyID"] == $this->agencyID) {
					$result = $this->db->update("BH_CLIENTS", "id", $clientID,  array("isDeleted"=>true));		
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

	public function getAgency($clientID) {
		$clientIDStr = $this->db->quote($clientID);
		
		$r=$this->db->query("select agencyID from BH_CLIENTS where id = $clientIDStr and agencyID = \"$this->agencyID\"");
		 
		$results=$r->fetch(\PDO::FETCH_ASSOC);


		if ($results["agencyID"]) {
				return $results["agencyID"];
		}
		else {
			return false;
		}
		
	}
	
	public function unique($clientID, $client = array()) {
		
		$clientNameStr = $this->db->quote($client["name"]);
		$clientIDStr = $this->db->quote($clientID);
		
		$r=$this->db->query("select * from BH_CLIENTS where name = $clientNameStr and id != $clientIDStr and agencyID = '$this->agencyID' and isDeleted is FALSE");
		 
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
		
		$r=$this->db->query("select * from BH_CLIENTS where name = $clientNameStr and agencyID = '$this->agencyID' $sourceRefIDStr and isDeleted is FALSE");
		 
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
	
}