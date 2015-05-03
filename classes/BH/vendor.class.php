<?php

/**
 * BLUHORN VENDOR CLASS
 *  
 * @author Wes Benwick
 * @link http://www.filelogix.com
 * @license Part of Filelogix usage license
 */ 
  
namespace BH;

class vendor
{  
    // Will store database connection here
	private $db;
	private $sessionID;
	private $vendorID;
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

	public function getVendorID() {
		return $this->vendorID;
	}
	
	public function addVendor($vendor = array()) {
	  
	  if ($this->exists($vendor)) {
		  
		  return false;
	  }
	  
	  else {
		  
		  $vendor["isActive"] = true;
		  $vendor["agencyID"] = $this->agencyID;
		  
		  if (intval($vendor["vendorType"])>0) {
			  	$this->vendorID = $this->db->insert("BH_VENDORS", $vendor);
			  	return $this->vendorID;
		  }
		  else {
			  return false;
		  }
	  }
				
	  return $results;

		
	}

	public function deleteVendor($vendorID, $vendor) {

	  if ($this->agencyID == $this->getAgency($vendorID)) {
	  
		  if ($vendorID>0) {
				if ($vendor["agencyID"] == $this->agencyID) {
					$result = $this->db->update("BH_VENDORS", "id", $vendorID,  array("isDeleted"=>true));		
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

	public function getAgency($vendorID) {
		$vendorIDStr = $this->db->quote($vendorID);
		
		$r=$this->db->query("select agencyID from BH_VENDORS where id = $vendorIDStr and agencyID = \"$this->agencyID\"");
		 
		$results=$r->fetch(\PDO::FETCH_ASSOC);


		if ($results["agencyID"]) {
				return $results["agencyID"];
		}
		else {
			return false;
		}
		
	}

	public function getDemographicsIDByVendorType($isRated, $vendorType) {
		$vendorTypeStr = $this->db->quote($vendorType);
		$isRatedStr = $this->db->quote($isRated);
		
		$r=$this->db->query("select demographicsID from BH_VENDOR_TYPES where isRated = $isRatedStr and id = $vendorTypeStr ");
		 
		$results=$r->fetch(\PDO::FETCH_ASSOC);


		if ($results["demographicsID"]) {
				return $results["demographicsID"];
		}
		else {
			return false;
		}
		
	}


	public function getVendorType($vendorType) {
		$vendorTypeStr = $this->db->quote($vendorType);
		
		$r=$this->db->query("select * from BH_VENDOR_TYPES where id = $vendorTypeStr ");
		 
		$results=$r->fetch(\PDO::FETCH_ASSOC);

		return $results;
		
	}
			
	public function saveVendor($vendorID, $vendor = array()) {

	  if ($this->unique($vendorID, $vendor)) {
	  
		  if ($vendorID>0) {
		  	if (intval($vendor["vendorType"])>0) {
				if ($vendor["agencyID"] == $this->agencyID) {
					$result = $this->db->update("BH_VENDORS", "id", $vendorID,  $vendor);		
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
	
	public function getVendor($vendorID) {
		$vendorIDStr = $this->db->quote($vendorID);
		
		$r=$this->db->query("select BH_VENDORS.*,BH_VENDOR_TYPES.id as vendorTypeID, BH_VENDOR_TYPES.description as vendorTypeDescription, BH_VENDOR_TYPES.isBroadcast as isBroadcast, BH_VENDOR_TYPES.isPublished as isPublished from BH_VENDORS left join BH_VENDOR_TYPES on (BH_VENDORS.vendorType=BH_VENDOR_TYPES.id) where BH_VENDORS.id = $vendorIDStr and BH_VENDORS.agencyID = \"$this->agencyID\"");
		 
		$results=$r->fetch(\PDO::FETCH_ASSOC);

		error_log("Vendor Exists: " . $this->db->lastQuery());

		if ($results["id"]) {
				$this->vendorID = $results["id"];
				return $results;
		}
		else {
			return false;
		}
		
	}	
	
	public function unique($vendorID, $vendor = array()) {
		
		$vendorNameStr = $this->db->quote($vendor["name"]);
		$vendorTypeStr = $this->db->quote($vendor["vendorType"]);
		$vendorIDStr = $this->db->quote($vendorID);
		
		$r=$this->db->query("select * from BH_VENDORS where name = $vendorNameStr and id != $vendorIDStr and agencyID = '$this->agencyID' and vendorType = $vendorTypeStr and isDeleted is FALSE");
		 
		$results=$r->fetch(\PDO::FETCH_ASSOC);

		error_log("Vendor Name Unique?: " . $this->db->lastQuery());

		if ($results["name"] == $vendor["name"]) {
				return false;
		}
		else {
			return true;
		}

	}

	public function exists($vendor = array()) {
		
		$vendorNameStr = $this->db->quote($vendor["name"]);
		$vendorTypeStr = $this->db->quote($vendor["vendorType"]);

		if (($vendor["source"] != "") and ($vendor["refID"] > 0)) {
			$sourceStr = $this->db->quote($vendor["source"]);
			$refIDStr = $this->db->quote($vendor["refID"]);
			
			$sourceRefIDStr = " and source = $sourceStr and refID = $refIDStr ";	
		}	
		else {
			$sourceRefIDStr = "";
		}

		$r=$this->db->query("select * from BH_VENDORS where name = $vendorNameStr and vendorType = $vendorTypeStr and agencyID = '$this->agencyID' $sourceRefIDStr and isDeleted is FALSE");
		 
		$results=$r->fetch(\PDO::FETCH_ASSOC);

		error_log("Vendor Exists: " . $this->db->lastQuery());

		if ($results["name"] == $vendor["name"]) {
				$this->vendorID = $results["id"];
				return true;
		}
		else {
			return false;
		}

	}	

	public function existsByRefID($source, $refID, $vendor = array()) {
		
		$sourceStr = $this->db->quote($source);
		$refIDStr = $this->db->quote($refID);
		$vendorNameStr = $this->db->quote($vendor["name"]);
		$vendorTypeStr = $this->db->quote($vendor["vendorType"]);
		
		$r=$this->db->query("select * from BH_VENDORS where name = $vendorNameStr and vendorType = $vendorTypeStr and agencyID = '$this->agencyID' and source = $sourceStr and refID = $refIDStr ");
		 
		$results=$r->fetch(\PDO::FETCH_ASSOC);

		error_log("Vendor Exists By RefID: " . $this->db->lastQuery());

		if ($results["name"] == $vendor["name"]) {
				$this->vendorID = $results["id"];
				return true;
		}
		else {
			return false;
		}

	}
	
	public function getAllVendors() {
		
		  $agencyIDStr = $this->db->quote($this->agencyID);
				  
		  $r=$this->db->query("select BH_VENDORS.*,BH_VENDOR_TYPES.id as vendorTypeID, BH_VENDOR_TYPES.description as vendorTypeDescription from BH_VENDORS left join BH_VENDOR_TYPES on (BH_VENDORS.vendorType=BH_VENDOR_TYPES.id) where agencyID = $agencyIDStr and isDeleted is FALSE order by name asc");
	      $results=$r->fetchAll();
	
		  error_log($this->db->lastQuery());
			
		  return $results;
	  
	  
	}


	public function getVendorsByWorksheetID($worksheetID) {
		
		  $agencyIDStr = $this->db->quote($this->agencyID);
		  $worksheetIDStr = $this->db->quote($worksheetID);
				  
		  $r=$this->db->query("select BH_VENDORS.*,BH_MARKETS.id as marketID, BH_MARKETS.name as marketName from BH_VENDORS left join BH_MARKETS on (BH_MARKETS.vendorID=BH_VENDORS.id) left join BH_WORKSHEET_MARKETS on (BH_WORKSHEET_MARKETS.marketID=BH_MARKETS.id) where BH_VENDORS.agencyID = $agencyIDStr and BH_WORKSHEET_MARKETS.worksheetID = $worksheetIDStr ");
	      $results=$r->fetchAll();
	
		  error_log($this->db->lastQuery());
			
		  return $results;
	  
	  
	}


	public function getVendorsByCampaignID($campaigns) {
		
		  $agencyIDStr = $this->db->quote($this->agencyID);
		  
		  $campaignIDStr = "";

		  if (is_array($campaigns)) {
			  foreach ($campaigns as $campaign) {
			  	  if (strlen($campaignIDStr)>0) {
				  	  $campaignIDStr .= ",";
			  	  }
				  $campaignIDStr .= $this->db->quote($campaign);
			  }
			  $campaignIDStr = "and BH_WORKSHEETS.campaignID in (" . $campaignIDStr . ")";
		  }
		  else {
			  $campaignIDStr = "and BH_WORKSHEETS.campaignID = " . $this->db->quote($campaigns);		  
		  }
				  
		  $r=$this->db->query("select BH_VENDORS.* from BH_VENDORS left join BH_MARKETS on (BH_MARKETS.vendorID=BH_VENDORS.id) left join BH_WORKSHEET_MARKETS on (BH_WORKSHEET_MARKETS.marketID=BH_MARKETS.id) left join BH_WORKSHEETS on (BH_WORKSHEET_MARKETS.worksheetID=BH_WORKSHEETS.id) where BH_VENDORS.agencyID = $agencyIDStr $campaignIDStr group by BH_VENDORS.id order by BH_VENDORS.name asc");
	      $results=$r->fetchAll();
	
		  error_log($this->db->lastQuery());
			
		  return $results;
	  
	  
	}
	
	public function getVendorsByMarketAndType($marketTypeID, $marketID) {
		
		  $agencyIDStr = $this->db->quote($this->agencyID);
		  $marketTypeIDStr = $this->db->quote($marketTypeID);
		  $marketIDStr = $this->db->quote($marketID);

		  if (intval($marketID)>0) {
			  $marketSearchStr = " BH_MARKETS.id = " . $marketIDStr;
			  error_log("Search By ID");
		  }
		  else {
			  $marketSearchStr = " BH_MARKETS.name = " . $marketIDStr;
			  error_log("Search By Name");
		  }			
		  	  
		  $r=$this->db->query("select BH_VENDORS.*,BH_VENDOR_TYPES.id as vendorTypeID, BH_VENDOR_TYPES.description as vendorTypeDescription from BH_VENDORS left join BH_VENDOR_TYPES on (BH_VENDORS.vendorType=BH_VENDOR_TYPES.id) left join BH_MARKETS on (BH_VENDORS.id = BH_MARKETS.vendorID) where BH_VENDORS.vendorType = $marketTypeIDStr and $marketSearchStr and BH_VENDORS.agencyID = $agencyIDStr and BH_VENDORS.isDeleted is FALSE group by BH_VENDORS.id order by name asc");
	      $results=$r->fetchAll();
	
		  error_log("getVendorsByMarketAndType: ($marketTypeID, $marketID) - " . $this->db->lastQuery());
			
		  return $results;
	  
	  
	}

	public function getVendorRepsByVendorIDAndMarketName($vendorID, $market) {
		
		  $agencyIDStr = $this->db->quote($this->agencyID);
		  $vendorIDStr = $this->db->quote($vendorID);
		  $marketStr = $this->db->quote($market);

		  if (intval($marketStr)>0) {
			  $marketSearchStr = " BH_MARKETS.id = " . $marketStr;
		  }
		  else {
			  $marketSearchStr = " BH_MARKETS.name = " . $marketStr;
		  }			
		  	  
		  $r=$this->db->query("select BH_MARKETS.* from BH_MARKETS where BH_MARKETS.vendorID = $vendorIDStr and $marketSearchStr and BH_MARKETS.agencyID = $agencyIDStr and BH_MARKETS.isDeleted is FALSE group by id,contactName order by contactName asc");
	      $results=$r->fetchAll();
	
		  error_log("getVendorRepsByVendorIDAndMarketName: ($vendorID, $market) - " . $this->db->lastQuery());
			
		  return $results;
	  
	  
	}

	public function getAllVendorTypes() {
		
		  $agencyIDStr = $this->db->quote($this->agencyID);
				  
		  $r=$this->db->query("select * from BH_VENDOR_TYPES order by description asc");
	      $results=$r->fetchAll();
	
		  error_log($this->db->lastQuery());
			
		  return $results;
	  
	  
	}
	
}