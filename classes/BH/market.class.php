<?php

/**
 * BLUHORN MARKET CLASS
 *  
 * @author Wes Benwick
 * @link http://www.filelogix.com
 * @license Part of Filelogix usage license
 */ 
  
namespace BH;

class market
{  
    // Will store database connection here
	private $db;
	private $sessionID;
	private $agencyID;
	private $userID;
	private $marketID;

	
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

	public function getMarketID() {
		return $this->marketID;
	}
	
	public function addMarketRep($marketRep = array()) {
	  
	  if ($this->exists($marketRep)) {
		  error_log("Market Rep Exists");
		  return false;
	  }
	  
	  else {
		  
		  $marketRep["isActive"] = true;
		  $marketRep["agencyID"] = $this->agencyID;
		  
		  if (intval($marketRep["marketID"])>0) {
			  	$marketRepID = $this->db->insert("BH_MARKET_REPS", $marketRep);
			  	error_log("Insert Market Rep: " . $this->db->lastQuery());
			  	return $marketRepID;
		  }
		  else {
			  return false;
		  }
	  }
				
	  return false;

		
	}

	public function addMarket($market = array()) {
	  
	  if ($this->exists($market)) {
		  error_log("Market Exists");
		  return false;
	  }
	  
	  else {
		  
		  $market["isActive"] = true;
		  $market["agencyID"] = $this->agencyID;
		  
		  if (intval($market["vendorID"])>0) {
			  	$this->marketID = $this->db->insert("BH_MARKETS", $market);
			  	error_log("Insert Market: " . $this->db->lastQuery());
			  	return $this->marketID;
		  }
		  else {
			  return false;
		  }
	  }
				
	  return false;

		
	}
	
	public function getMarketsByVendor($vendors) {
		
		  $agencyIDStr = $this->db->quote($this->agencyID);
		  
		  $vendorIDStr = "";

		  if (is_array($vendors)) {
			  foreach ($vendors as $vendor) {
			  	  if (strlen($vendorIDStr)>0) {
				  	  $vendorIDStr .= ",";
			  	  }
				  $vendorIDStr .= $this->db->quote($vendor);
			  }
			  $vendorIDStr = "and BH_VENDORS.id in (" . $vendorIDStr . ")";
		  }
		  else {
			  $vendorIDStr = "and BH_VENDORS.id = " . $this->db->quote($vendors);		  
		  }
				  
		  $r=$this->db->query("select BH_MARKETS.* from BH_MARKETS left join BH_VENDORS on (BH_MARKETS.vendorID=BH_VENDORS.id) where BH_VENDORS.agencyID = $agencyIDStr $vendorIDStr group by BH_MARKETS.name order by BH_MARKETS.name asc ");
	      $results=$r->fetchAll();
	
		  error_log($this->db->lastQuery());
			
		  return $results;
	  
	  
	}	

	
	public function saveMarket($marketID, $market = array()) {

	  if ($this->unique($marketID, $market)) {
	  
		  if ($marketID>0) {
		  	if (intval($market["vendorID"])>0) {
				if ($market["agencyID"] == $this->agencyID) {
					$result = $this->db->update("BH_MARKETS", "id", $marketID,  $market);		
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
	  }
	  else {
		  
		  return false;
		  	
	  }
	}	
	
	public function getMarket($marketID) {
		$marketIDStr = $this->db->quote($marketID);
		
		$r=$this->db->query("select BH_MARKETS.* from BH_MARKETS where BH_MARKETS.id = $marketIDStr and BH_MARKETS.agencyID = \"$this->agencyID\"");
		 
		$results=$r->fetch(\PDO::FETCH_ASSOC);

		error_log("Market: " . $this->db->lastQuery());

		if ($results["id"]) {
				$this->marketID = $results["id"];
				return $results;
		}
		else {
			return false;
		}
		
	}	

	public function getMarketNames($markets) {
		  $marketIDStr = "";

		  if (is_array($markets)) {
		  	if (count($markets)>0) {
			  foreach ($markets as $market) {
			  	  if (strlen($marketIDStr)>0) {
				  	  $marketIDStr .= ",";
			  	  }
				  $marketIDStr .= $this->db->quote($market);
			  }
			  $marketIDStr = "and BH_MARKETS.id in (" . $marketIDStr . ")";
			}
			else {
				return false;
			}
		  }
		  else {
			  $marketIDStr = "and BH_MARKETS.id = " . $this->db->quote($markets);		  
		  }
		
		$r=$this->db->query("select distinct(BH_MARKETS.name) as name from BH_MARKETS where BH_MARKETS.agencyID = \"$this->agencyID\" $marketIDStr");
		 
		$results=$r->fetchAll(\PDO::FETCH_COLUMN,0);

		error_log("MarketNames: " . $this->db->lastQuery());

		return $results;
		
	}	
	
	public function unique($marketID, $market = array()) {
		
		$marketNameStr = $this->db->quote($market["name"]);
		$vendorIDStr = $this->db->quote($market["vendorID"]);
		$emailAddressStr = $this->db->quote($vendor["emailAddress"]);
		$marketIDStr = $this->db->quote($marketID);
		
		$r=$this->db->query("select * from BH_MARKETS where name = $marketNameStr and id != $marketIDStr and emailAddress = $emailAddressStr and agencyID = '$this->agencyID' and vendorID = $vendorIDStr ");
		 
		$results=$r->fetch(\PDO::FETCH_ASSOC);

		error_log("Market Name Unique?: " . $this->db->lastQuery());

		if ($results["name"] == $market["name"]) {
				return false;
		}
		else {
			return true;
		}

	}

	public function exists($market = array()) {
		
		$vendorIDStr = $this->db->quote($market["vendorID"]);
		$marketNameStr = $this->db->quote($market["name"]);
		$contactNameStr = $this->db->quote($market["contactName"]);
		$emailAddressStr = $this->db->quote($market["emailAddress"]);

		if (($market["source"] != "") and ($market["refID"] > 0)) {
			$sourceStr = $this->db->quote($market["source"]);
			$refIDStr = $this->db->quote($market["refID"]);
			
			$sourceRefIDStr = " and source = $sourceStr and refID = $refIDStr ";	
		}	
		else {
			$sourceRefIDStr = "";
		}
		
		$r=$this->db->query("select * from BH_MARKETS where name = $marketNameStr and emailAddress = $emailAddressStr and contactName = $contactNameStr and vendorID = $vendorIDStr and agencyID = '$this->agencyID'  $sourceRefIDStr and isDeleted is FALSE");
		 
		$results=$r->fetch(\PDO::FETCH_ASSOC);

		error_log("Market and Contact Exists: " . $this->db->lastQuery());

		if ($results["name"] == $market["name"]) {
				$this->marketID = $results["id"];
				return true;
		}
		else {
			return false;
		}

	}	

	public function existsByRefID($source, $refID, $market = array()) {
		
		$sourceStr = $this->db->quote($source);
		$refIDStr = $this->db->quote($refID);
		$vendorIDStr = $this->db->quote($market["vendorID"]);
		$marketNameStr = $this->db->quote($market["name"]);
		$emailAddressStr = $this->db->quote($market["emailAddress"]);
		
		$r=$this->db->query("select * from BH_MARKETS where name = $marketNameStr and emailAddress = $emailAddressStr and vendorID = $vendorIDStr and agencyID = '$this->agencyID' and source = $sourceStr and refID = $refIDStr ");
		 
		$results=$r->fetch(\PDO::FETCH_ASSOC);

		error_log("Market and Contact Exists By RefID: " . $this->db->lastQuery());

		if ($results["name"] == $market["name"]) {
				$this->marketID = $results["id"];
				return true;
		}
		else {
			return false;
		}

	}
	
	public function getMarketsByVendorID($vendorID) {
		
		  $agencyIDStr = $this->db->quote($this->agencyID);
		  $vendorIDStr = $this->db->quote($vendorID);
				  
		  $r=$this->db->query("select BH_MARKETS.* from BH_MARKETS where vendorID = $vendorIDStr and agencyID = $agencyIDStr and isDeleted is FALSE order by name asc");
	      $results=$r->fetchAll();
	
		  error_log($this->db->lastQuery());
			
		  return $results;
	  
	  
	}

	public function deleteMarket($marketID) {

	  if ($this->agencyID == $this->getAgency($marketID)) {
	  
		  if ($marketID>0) {
				$result = $this->db->update("BH_MARKETS", "id", $marketID,  array("isDeleted"=>true));		
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

	public function getAgency($marketID) {
		$marketIDStr = $this->db->quote($marketID);
		
		$r=$this->db->query("select agencyID from BH_MARKETS where id = $marketIDStr and agencyID = \"$this->agencyID\"");
		 
		$results=$r->fetch(\PDO::FETCH_ASSOC);


		if ($results["agencyID"]) {
				return $results["agencyID"];
		}
		else {
			return false;
		}
		
	}
	
	public function getMarketsByWorksheetID($worksheetID) {
		
		  $agencyIDStr = $this->db->quote($this->agencyID);
		  $worksheetIDStr = $this->db->quote($worksheetID);
				  
		  $r=$this->db->query("select BH_MARKETS.* from BH_MARKETS left join BH_WORKSHEET_MARKETS on (BH_WORKSHEET_MARKETS.marketID = BH_MARKETS.id) where BH_WORKSHEET_MARKETS.worksheetID = $worksheetIDStr and agencyID = $agencyIDStr and isDeleted is FALSE order by name asc");
	      $results=$r->fetchAll();
	
		  error_log($this->db->lastQuery());
			
		  return $results;
	  
	  
	}

	public function getMarketNameByWorksheetID($worksheetID) {
		
		  $agencyIDStr = $this->db->quote($this->agencyID);
		  $worksheetIDStr = $this->db->quote($worksheetID);
				  
		  $r=$this->db->query("select distinct(BH_MARKETS.name) as name from BH_MARKETS left join BH_WORKSHEET_MARKETS on (BH_WORKSHEET_MARKETS.marketID = BH_MARKETS.id) where BH_WORKSHEET_MARKETS.worksheetID = $worksheetIDStr and agencyID = $agencyIDStr and isDeleted is FALSE order by name asc limit 1");
	      $results=$r->fetch(\PDO::FETCH_ASSOC);
	
		  error_log($this->db->lastQuery());
			
		  return $results["name"];
	  
	  
	}

	public function getAllMarkets($grouped) {
		
		  $agencyIDStr = $this->db->quote($this->agencyID);
				  
		  if ($grouped) {
			  	$groupByStr = " group by BH_MARKETS.name";
		  }		  
		  else {
			  $groupByStr = "";
		  }
				  
		  $r=$this->db->query("select BH_MARKETS.*, BH_VENDORS.name as vendorName, BH_VENDORS.id as vendorID from BH_MARKETS left join BH_VENDORS on (BH_MARKETS.vendorID = BH_VENDORS.id) where BH_MARKETS.agencyID = $agencyIDStr and BH_MARKETS.isDeleted is FALSE $groupByStr order by BH_MARKETS.name asc");
	      $results=$r->fetchAll();
	
		  error_log($this->db->lastQuery());
			
		  return $results;
	  
	  
	}

	public function getMarketTypes($isRated) {
		if ($isRated) {	  
		  $r=$this->db->query("select * from BH_VENDOR_TYPES where isRated is TRUE order by BH_VENDOR_TYPES.description asc");
		}
		else {
		  $r=$this->db->query("select * from BH_VENDOR_TYPES where isRated is FALSE order by BH_VENDOR_TYPES.description asc");

	    }
	    $results=$r->fetchAll();
	
		error_log($this->db->lastQuery());
			
		return $results;
	  
	  
	}
	
}