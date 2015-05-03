<?php

/**
 * BLUHORN DIGITALWORKSHEET CLASS
 *  
 * @author Wes Benwick
 * @link http://www.filelogix.com
 * @license Part of Filelogix usage license
 */ 
  
namespace BH;

class digital extends worksheet
{  
    // Will store database connection here
	protected $db;
	protected $sessionID;
	protected $campaignID;
	protected $worksheetID;
	protected $agencyID;
	protected $userID;

	
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

	public function getWorksheetID() {
		return $this->worksheetID;
	}
	
	public function addWorksheet($worksheet = array()) {

	  error_log("Add Worksheet: " .  $worksheet["campaignID"]);
	  	  
	  if ($this->exists($worksheet)) {
		  error_log("Not adding worksheet, it already exists: " .  $this->worksheetID);

		  return false;
	  }
	  
	  else {
		  
		  $worksheet["isActive"] = true;
		  $worksheet["agencyID"] = $this->agencyID;
	  	  
		  if (intval($worksheet["campaignID"])>0) {
			  	$this->worksheetID = $this->db->insert("BH_WORKSHEETS", $worksheet);
			  	error_log("Insert Worksheet: " . $this->db->lastQuery());
			  	return $this->worksheetID;
		  }
		  else {
			  return false;
		  }
	  }
				
	  return $results;

		
	}
	
	public function saveWorksheet($worksheetID, $worksheet = array()) {

	  if ($this->unique($worksheetID, $worksheet)) {
	  
		  if ($worksheetID>0) {
		  	if (intval($worksheet["campaignID"])>0) {
				if ($worksheet["agencyID"] == $this->agencyID) {
					$result = $this->db->update("BH_WORKSHEETS", "id", $worksheetID,  $worksheet);		
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
	
	public function getMaxLinesByWorksheetID($worksheetID) {

		$worksheetIDStr = $this->db->quote($worksheetID);
		
		$r=$this->db->query("select max(worksheetLine) as maxLine from BH_WORKSHEET_DIGITAL_LINES where worksheetID = $worksheetIDStr and agencyID = '$this->agencyID' ");
		 
		$results=$r->fetch(\PDO::FETCH_ASSOC);
		
		return $results["maxLine"]+1;
	}

	public function getLineByID($worksheetLineID) {

		$worksheetLineIDStr = $this->db->quote($worksheetLineID);
		
		$r=$this->db->query("select worksheetLine from BH_WORKSHEET_DIGITAL_LINES where id = $worksheetLineIDStr and agencyID = '$this->agencyID' ");
		 
		$results=$r->fetch(\PDO::FETCH_ASSOC);
		
		return $results["worksheetLine"];
	}

	public function updateCellByWorksheetIDandLine($worksheetID, $line, $cell = array()) {

		error_log("Update Cell:" . $this->agencyID . $worksheetID . " " . $line . " " . $cell["field"] . " = " . $cell["new"]);

		$agencyIDStr = $this->db->quote($this->agencyID);
		$worksheetIDStr = $this->db->quote($worksheetID);

		if (intval($line) == 0) {
			$line = $this->getMaxLinesByWorksheetID($worksheetID);
		} 

		$params = array();
		
		$params["worksheetID"] = intval($worksheetID);
		$params["agencyID"] = intval($this->agencyID);
		$params["worksheetLine"] = intval($line);
		$params[$cell["field"]] = $cell["new"];

		$id = $this->db->upsert("BH_WORKSHEET_DIGITAL_LINES", $params);
		
		error_log("Update Cell: " . $this->db->lastQuery());

		return $id;
	}
	
	public function copyLinesByWorksheetID($worksheetID) {
		
		$linesCopied = 0;
		
		if ($this->db->beginTransaction()) {

			$worksheetIDStr = $this->db->quote($worksheetID);
	
			$r=$this->db->query("select BH_WORKSHEET_DIGITAL_LINES.*, BH_VENDORS.name as vendorName from BH_WORKSHEET_DIGITAL_LINES left join BH_VENDORS on (BH_WORKSHEET_DIGITAL_LINES.vendorID = BH_VENDORS.id) where BH_WORKSHEET_DIGITAL_LINES.worksheetID = $worksheetIDStr and BH_WORKSHEET_DIGITAL_LINES.agencyID = \"$this->agencyID\" and BH_WORKSHEET_DIGITAL_LINES.isCopy is TRUE and BH_WORKSHEET_DIGITAL_LINES.isDeleted is FALSE order by BH_WORKSHEET_DIGITAL_LINES.worksheetLine asc");
		 
			$lines=$r->fetchAll();

			error_log("Copying Lines: " . $this->db->lastQuery());


			if ($lines) {
				
				foreach ($lines as $line) {

					$newLine = array();
					foreach ($line as $keyStr=>$valStr) {
						if (!is_numeric($keyStr)) {
							$newLine[$keyStr] = $valStr;
						}
					}
					$newLine["worksheetLine"] = $this->getMaxLinesByWorksheetID($worksheetID);
					$newLine["isCopy"] = 0;
					unset($newLine["id"]);
					
					$id = $this->db->upsert("BH_WORKSHEET_DIGITAL_LINES", $newLine);
					error_log("Copying Lines Upsert: $id = " . $this->db->lastQuery());

					
					if ($id>0) {			

						$copyResult = $this->db->update("BH_WORKSHEET_DIGITAL_LINES", "id", $line["id"], array("isCopy"=>"0"));
						error_log("Lines Copied: " . $linesCopied);
								
						$originalWorksheetLine = $line["worksheetLine"];		
						
						$linesCopied++;
					}
				}
				
				if ($this->db->commitTransaction()) {
					
					return $linesCopied;
				}
				else {
					return false;
				}
			
			}
			else {
				return false;
			}		
		}
		else {
			return false;
		}
		
	}
	
	public function updateLineByWorksheetID($worksheetID, $line, $source = array()) {

		error_log("Update Line:" . $this->agencyID . $worksheetID . " " . $line);

		$agencyIDStr = $this->db->quote($this->agencyID);
		$worksheetIDStr = $this->db->quote($worksheetID);

		if (intval($line) == 0) {
			$line = $this->getMaxLinesByWorksheetID($worksheetID);
		} 

		$params = array_merge($source);
		
		$params["worksheetID"] = intval($worksheetID);
		$params["agencyID"] = intval($this->agencyID);
		$params["worksheetLine"] = intval($line);

		error_log("isCopy: " . $params["isCopy"]);
		error_log("isBold: " . $params["isBold"]);

		if ($params["isCopy"]=='true') {
			$params["isCopy"]=1;
		}			

		if ($params["isDeleted"]=='true') {
			$params["isCopy"]=0;
		}

		if ($params["isDeleted"]>0) {
			$params["isCopy"]=0;
		}

		if ($params["isBold"]=='true') {
			$params["isBold"]=1;
		}			
	
				
		$id = $this->db->upsert("BH_WORKSHEET_DIGITAL_LINES", $params);
		
		error_log("Update Line($line): " . $this->db->lastQuery());

		return $id;
	}


	public function removeLineByWorksheetID($worksheetID, $line) {

		error_log("Remove Line:" . $this->agencyID . $worksheetID . " " . $line);

		$agencyIDStr = $this->db->quote($this->agencyID);
		$worksheetIDStr = $this->db->quote($worksheetID);

		$params = array_merge($source);
		
		$params["worksheetID"] = intval($worksheetID);
		$params["agencyID"] = intval($this->agencyID);
		$params["worksheetLine"] = intval($line);
		$params["isDeleted"] = TRUE;

		if ($this->db->beginTransaction()) {
			$id = $this->db->upsert("BH_WORKSHEET_DIGITAL_LINES", $params);
			
			error_log("Remove Line($line): $id - " . $this->db->lastQuery());
			
/*
			$lineNumber = intval($line);

			$this->db->exec("update BH_WORKSHEET_DIGITAL_LINES set worksheetLine=worksheetLine-1 where worksheetLine > $lineNumber and worksheetID = $worksheetIDStr and agencyID = $agencyIDStr ");

*/

			$this->db->commitTransaction();
			

			return true;

		}
		
		return false;
	}
	
	public function saveLinebyWorksheetID($worksheetID, $lineNumber, $source = array()) {
				
		if ($source["worksheetLine"] == $lineNumber) {
			if ($this->updateLineByWorksheetID($worksheetID, $lineNumber, $source)) {
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
	
	public function getWorksheet($worksheetID) {
		$worksheetIDStr = $this->db->quote($worksheetID);
		
		$r=$this->db->query("select BH_WORKSHEETS.*, BH_MARKETS.name as marketName, BH_VENDOR_TYPES.type as vendorType from BH_WORKSHEETS left join BH_MARKETS on (BH_WORKSHEETS.marketID = BH_MARKETS.id) left join BH_VENDOR_TYPES on (BH_WORKSHEETS.typeID = BH_VENDOR_TYPES.id) where BH_WORKSHEETS.id = $worksheetIDStr and BH_WORKSHEETS.agencyID = \"$this->agencyID\" and BH_WORKSHEETS.isDeleted is FALSE");
		 
		$results=$r->fetch(\PDO::FETCH_ASSOC);

		error_log("Worksheet Exists: " . $this->db->lastQuery());

		if ($results["id"]) {
				$this->worksheetID = $results["id"];
				return $results;
		}
		else {
			return false;
		}
		
	}	

	public function getWorksheetLines($worksheetID) {
		$worksheetIDStr = $this->db->quote($worksheetID);
		
		$showDeletedStr = "and BH_WORKSHEET_DIGITAL_LINES.isDeleted is FALSE";
		
		$orderBy = $this->getSortByWorksheetID($worksheetID);
		
		$orderStr = "";
		
		if (count($orderBy)>0) {
			$orderStr = "order by ";
			
			foreach ($orderBy as $sortBy) {
				$orderStr .= $sortBy["name"] . " " . $sortBy["direction"] ;
				if ($sortBy !== end($orderBy)) {
					$orderStr .= ",";	
				}
			}
		}		
		
		$r=$this->db->query("select BH_WORKSHEET_DIGITAL_LINES.*, BH_VENDORS.name as vendorName from BH_WORKSHEET_DIGITAL_LINES left join BH_VENDORS on (BH_WORKSHEET_DIGITAL_LINES.vendorID = BH_VENDORS.id) where BH_WORKSHEET_DIGITAL_LINES.worksheetID = $worksheetIDStr and BH_WORKSHEET_DIGITAL_LINES.agencyID = \"$this->agencyID\" $showDeletedStr $orderStr");
		 
		$results=$r->fetchAll();

		error_log("Worksheet Lines: " . $this->db->lastQuery());

		if ($results) {
			return $results;
		}
		else {
			return false;
		}
		
	}

	public function unique($worksheetID, $worksheet = array()) {
		
		$worksheetNameStr = $this->db->quote($worksheet["name"]);
		$campaignIDStr = $this->db->quote($worksheet["campaignID"]);
		$worksheetIDStr = $this->db->quote($worksheetID);
		
		$r=$this->db->query("select * from BH_WORKSHEETS where name = $worksheetNameStr and id != $worksheetIDStr and agencyID = '$this->agencyID' and campaignID = $campaignIDStr ");
		 
		$results=$r->fetch(\PDO::FETCH_ASSOC);

		error_log("Worksheet Name Unique?: " . $this->db->lastQuery());

		if ($results["name"] == $worksheet["name"]) {
				return false;
		}
		else {
			return true;
		}

	}

	public function exists($worksheet = array()) {
		
		$worksheetNameStr = $this->db->quote($worksheet["name"]);
		$campaignIDStr = $this->db->quote($worksheet["campaignID"]);
		
		if (($worksheet["source"] != "") and ($worksheet["refID"] > 0)) {
			$sourceStr = $this->db->quote($worksheet["source"]);
			$refIDStr = $this->db->quote($worksheet["refID"]);
			
			$sourceRefIDStr = " and source = $sourceStr and refID = $refIDStr ";	
		}	
		else {
			$sourceRefIDStr = "";
		}
		
		$r=$this->db->query("select * from BH_WORKSHEETS where name = $worksheetNameStr and campaignID = $campaignIDStr and agencyID = '$this->agencyID' $sourceRefIDStr ");
		 
		$results=$r->fetch(\PDO::FETCH_ASSOC);

		error_log("Worksheet Exists: " . $this->db->lastQuery());

		if ($results["name"] == $worksheet["name"]) {
				$this->worksheetID = $results["id"];
				return true;
		}
		else {
			return false;
		}

	}	

	public function existsByRefID($source, $refID, $worksheet = array()) {
		
		$sourceStr = $this->db->quote($source);
		$refIDStr = $this->db->quote($refID);
		$worksheetNameStr = $this->db->quote($worksheet["name"]);
		$campaignIDStr = $this->db->quote($worksheet["campaignID"]);
		
		$r=$this->db->query("select * from BH_WORKSHEETS where name = $worksheetNameStr and campaignID = $campaignIDStr and agencyID = '$this->agencyID' and source = $sourceStr and refID = $refIDStr");
		 
		$results=$r->fetch(\PDO::FETCH_ASSOC);

		error_log("Worksheet Exists By RefID: " . $this->db->lastQuery());

		if ($results["name"] == $worksheet["name"]) {
				$this->worksheetID = $results["id"];
				return true;
		}
		else {
			return false;
		}

	}
	
	public function getAllWorksheetsByCampaignID($campaignID) {
		
		  $agencyIDStr = $this->db->quote($this->agencyID);
		  $campaignIDStr = $this->db->quote($campaignID);
				  
		  $r=$this->db->query("select BH_WORKSHEETS.*, BH_MARKETS.name as marketName, BH_VENDOR_TYPES.type as vendorType from BH_WORKSHEETS left join BH_MARKETS on (BH_WORKSHEETS.marketID = BH_MARKETS.id) left join BH_VENDOR_TYPES on (BH_WORKSHEETS.typeID = BH_VENDOR_TYPES.id) where BH_WORKSHEETS.campaignID = $campaignIDStr and BH_WORKSHEETS.agencyID = $agencyIDStr and BH_WORKSHEETS.isDeleted is FALSE order by BH_WORKSHEETS.name asc");
	      $results=$r->fetchAll();
	
		  error_log($this->db->lastQuery());
			
		  return $results;
	  
	  
	}
	
	public function getActiveCampaigns() {
		
		  $agencyIDStr = $this->db->quote($this->agencyID);
				  
		  $r=$this->db->query("select BH_CAMPAIGNS.*, BH_CLIENTS.name as clientName from BH_CAMPAIGNS left join BH_CLIENTS on (BH_CAMPAIGNS.clientID = BH_CLIENTS.id) where BH_CAMPAIGNS.agencyID = $agencyIDStr and BH_CAMPAIGNS.isDeleted is FALSE and BH_CAMPAIGNS.isActive is TRUE order by BH_CAMPAIGNS.name asc");
	      $results=$r->fetchAll();
	
		  error_log($this->db->lastQuery());
			
		  return $results;
	  
	}

	public function getArchivedCampaigns() {
		
		  $agencyIDStr = $this->db->quote($this->agencyID);
				  
		  $r=$this->db->query("select BH_CAMPAIGNS.*, BH_CLIENTS.name as clientName from BH_CAMPAIGNS left join BH_CLIENTS on (BH_CAMPAIGNS.clientID = BH_CLIENTS.id) where BH_CAMPAIGNS.agencyID = $agencyIDStr and BH_CAMPAIGNS.isDeleted is FALSE and BH_CAMPAIGNS.isActive is FALSE order by BH_CAMPAIGNS.name asc");
	      $results=$r->fetchAll();
	
		  error_log($this->db->lastQuery());
			
		  return $results;

	}

	public function getPendingCampaigns() {
		
		  $agencyIDStr = $this->db->quote($this->agencyID);
				  
		  $r=$this->db->query("select BH_CAMPAIGNS.*, BH_CLIENTS.name as clientName from BH_CAMPAIGNS left join BH_CLIENTS on (BH_CAMPAIGNS.clientID = BH_CLIENTS.id) where BH_CAMPAIGNS.agencyID = $agencyIDStr and BH_CAMPAIGNS.isDeleted is FALSE and BH_CAMPAIGNS.isActive is TRUE order by BH_CAMPAIGNS.name asc");
	      $results=$r->fetchAll();
	
		  error_log($this->db->lastQuery());
			
		  return $results;

	}

	public function getCampaignsByClientID($clientID) {
		
		  $agencyIDStr = $this->db->quote($this->agencyID);
		  $clientIDStr = $this->db->quote($clientID);
				  
		  $r=$this->db->query("select BH_CAMPAIGNS.*, BH_CLIENTS.name as clientName from BH_CAMPAIGNS left join BH_CLIENTS on (BH_CAMPAIGNS.clientID = BH_CLIENTS.id) where BH_CAMPAIGNS.agencyID = $agencyIDStr and BH_CAMPAIGNS.clientID = $clientIDStr and BH_CAMPAIGNS.isDeleted is FALSE order by BH_CAMPAIGNS.name asc");
	      $results=$r->fetchAll();
	
		  error_log($this->db->lastQuery());
			
		  return $results;
	  
	  
	}

	public function countBuysByMonth($fromDate, $maxResults) {
		
		  $agencyIDStr = $this->db->quote($this->agencyID);
		  $maxResultsStr = intval($maxResults);
				  
		  $r=$this->db->query("select concat(year(flightStart),\"-\",LPAD(month(flightStart),2,'0')) as month, count(1) as total from BH_WORKSHEETS left join BH_CAMPAIGNS on (BH_CAMPAIGNS.id = BH_WORKSHEETS.campaignID) where BH_CAMPAIGNS.agencyID = $agencyIDStr and flightStart < now() and BH_WORKSHEETS.isDeleted is FALSE and BH_CAMPAIGNS.isDeleted is FALSE group by year(flightStart) desc,month(flightStart) desc limit $maxResultsStr;");
	      $results=$r->fetchAll();
	
		  error_log($this->db->lastQuery());
			
		  return $results;
	}

	public function countBuys() {
		
		  $agencyIDStr = $this->db->quote($this->agencyID);
				  
		  $r=$this->db->query("select count(1) as total from BH_WORKSHEETS left join BH_CAMPAIGNS on (BH_CAMPAIGNS.id = BH_WORKSHEETS.campaignID) where BH_WORKSHEETS.agencyID = $agencyIDStr and flightStart < now() and BH_WORKSHEETS.isDeleted is FALSE and BH_CAMPAIGNS.isDeleted is FALSE");
	      $results=$r->fetch(\PDO::FETCH_ASSOC);
	
		  if ($results["total"]) {
		  	return $results["total"];
		  }
		  else {
			  return 0;
		  }			
	}

	public function countLinesByMonth($fromDate, $maxResults) {
		
		  $agencyIDStr = $this->db->quote($this->agencyID);
		  $maxResultsStr = intval($maxResults);
				  
		  $r=$this->db->query("select concat(year(flightStart),\"-\",LPAD(month(flightStart),2,'0')) as month, sum(totalLines) as total from BH_WORKSHEETS left join BH_CAMPAIGNS on (BH_CAMPAIGNS.id = BH_WORKSHEETS.campaignID) where BH_CAMPAIGNS.agencyID = $agencyIDStr and flightStart < now() and BH_WORKSHEETS.isDeleted is FALSE and BH_CAMPAIGNS.isDeleted is FALSE  group by year(flightStart) desc,month(flightStart) desc limit $maxResultsStr;");
	      $results=$r->fetchAll();
	
		  error_log($this->db->lastQuery());
			
		  return $results;
	}

	public function countLines() {
		
		  $agencyIDStr = $this->db->quote($this->agencyID);
				  
		  $r=$this->db->query("select sum(totalLines) as total from BH_WORKSHEETS left join BH_CAMPAIGNS on (BH_CAMPAIGNS.id = BH_WORKSHEETS.campaignID) where BH_WORKSHEETS.agencyID = $agencyIDStr and flightStart < now() and BH_WORKSHEETS.isDeleted is FALSE and BH_CAMPAIGNS.isDeleted is FALSE");
	      $results=$r->fetch(\PDO::FETCH_ASSOC);
	
		  if ($results["total"]) {
		  	return $results["total"];
		  }
		  else {
			  return 0;
		  }			
	}


	public function saveMarket($worksheetID, $market = array()) {
	  
	  $worksheet = $this->getWorksheet($worksheetID);
	  
	  error_log("Saving Market for $worksheetID and agency: " . $this->agencyID);
	  
	  if ($worksheetID>0) {
	  	if (intval($worksheet["campaignID"])>0) {
			if ($worksheet["agencyID"] == $this->agencyID) {
				$result = $this->db->upsert("BH_WORKSHEET_MARKETS", $market);		
				error_log("Save BH_WORKSHEET_MARKET: " . $this->db->lastQuery());

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
	
	public function totalSpotsAndSpend($worksheetID) {
		
		 $totalSpend = 0.00;
		 
		 $wrksht = $this->getWorksheet($worksheetID);
		 
		 if ($wrksht["id"] == $worksheetID) {
			 
			 $lines = $this->getWorksheetLines($wrksht["id"]);
			 
			 foreach ($lines as $line) {
				 // total up the number of spots on each line
				 
				 $lineSpots = 1;
				 
				 // multiply spots * rate = totalspend per line
				 
				 $lineSpend = $line["grossCost"];
				 
				 error_log("Line Spend: " . $lineSpend);
				 
				 $this->db->update("BH_WORKSHEET_DIGITAL_LINES", "id", $line["id"], array("totalSpots"=>$lineSpots, "totalSpend"=>$lineSpend));
				 
			 }
			 
			 $worksheetIDStr = $this->db->quote($worksheetID);
			 
			 $r=$this->db->query("select sum(totalSpend) as totalSpend, sum(totalSpots) as totalSpots from BH_WORKSHEET_DIGITAL_LINES where BH_WORKSHEET_DIGITAL_LINES.worksheetID = $worksheetIDStr and BH_WORKSHEET_DIGITAL_LINES.isDeleted is FALSE");
		     $results=$r->fetch(\PDO::FETCH_ASSOC);
		
			 if ($results["totalSpend"]) {
				$this->db->update("BH_WORKSHEETS", "id", $worksheetID, array("totalSpots"=>$results["totalSpots"], "totalSpend"=>$results["totalSpend"]));
			  	return array("totalSpots"=>$results["totalSpots"], "totalSpend"=>$results["totalSpend"]);
			 }
			 else {
				return array("totalSpots"=>"0.00", "totalSpend"=>"0.00");
			 }			
		 }
		 
		 return false;
		
	}
	
}