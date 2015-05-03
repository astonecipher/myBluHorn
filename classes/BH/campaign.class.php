<?php

/**
 * BLUHORN CAMPAIGN CLASS
 *  
 * @author Wes Benwick
 * @link http://www.filelogix.com
 * @license Part of Filelogix usage license
 */ 
  
namespace BH;

class campaign
{  
    // Will store database connection here
	private $db;
	private $sessionID;
	private $campaignID;
	private $agencyID;
	private $userID;

	private $types = array();
	
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
	  
	  $this->types["tv"] = array("1","3","7","9");
	  $this->types["radio"] = array("2","8");
	  $this->types["print"] = array("4");
	  $this->types["digital"] = array("11");
	  $this->types["outdoor"] = array("5");
	  $this->types["social"] = array("10");
		
	}
	
	public function getCampaignID() {
		return $this->campaignID;
	}

	public function addCampaign($campaign = array()) {
	  	  
	  if ($this->exists($campaign)) {
		  
		  return false;
	  }
	  
	  else {
		  
		  $campaign["isActive"] = true;
		  $campaign["agencyID"] = $this->agencyID;
		  
		  if (intval($campaign["clientID"])>0) {
			  	$this->campaignID = $this->db->insert("BH_CAMPAIGNS", $campaign);
			  	error_log("Insert Campaign: " . $this->db->lastQuery());
			  	return $this->campaignID;
		  }
		  else {
			  return false;
		  }
	  }
				
	  return $results;

		
	}

	public function deleteCampaign($campaignID) {

	  if ($this->agencyID == $this->getAgency($campaignID)) {
	  
		  if ($campaignID>0) {
				$result = $this->db->update("BH_CAMPAIGNS", "id", $campaignID,  array("isDeleted"=>true));		
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

	public function getAgency($campaignID) {
		$campaignIDStr = $this->db->quote($campaignID);
		
		$r=$this->db->query("select agencyID from BH_CAMPAIGNS where id = $campaignIDStr and agencyID = \"$this->agencyID\"");
		 
		$results=$r->fetch(\PDO::FETCH_ASSOC);


		if ($results["agencyID"]) {
				return $results["agencyID"];
		}
		else {
			return false;
		}
		
	}
	
	public function saveCampaign($campaignID, $campaign = array()) {

	  if ($this->unique($campaignID, $campaign)) {
	  
		  if ($campaignID>0) {
		  	if (intval($campaign["clientID"])>0) {
				if ($campaign["agencyID"] == $this->agencyID) {
					$result = $this->db->update("BH_CAMPAIGNS", "id", $campaignID,  $campaign);	
					error_log("Save Campaign: " . $this->db->lastQuery());
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
	
	public function getCampaign($campaignID) {
		$campaignIDStr = $this->db->quote($campaignID);
		
		$r=$this->db->query("select BH_CAMPAIGNS.* from BH_CAMPAIGNS where BH_CAMPAIGNS.id = $campaignIDStr and BH_CAMPAIGNS.agencyID = \"$this->agencyID\"");
		 
		$results=$r->fetch(\PDO::FETCH_ASSOC);

		error_log("Campaign Exists: " . $this->db->lastQuery());

		if ($results["id"]) {
				$this->campaignID = $results["id"];
				return $results;
		}
		else {
			return false;
		}
		
	}	
	
	public function unique($campaignID, $campaign = array()) {
		
		$campaignNameStr = $this->db->quote($campaign["name"]);
		$clientIDStr = $this->db->quote($campaign["clientID"]);
		$campaignIDStr = $this->db->quote($campaignID);
		
		$r=$this->db->query("select * from BH_CAMPAIGNS where name = $campaignNameStr and id != $campaignIDStr and agencyID = '$this->agencyID' and clientID = $clientIDStr and isDeleted is FALSE");
		 
		$results=$r->fetch(\PDO::FETCH_ASSOC);

		error_log("Campaign Name Unique?: " . $this->db->lastQuery());

		if ($results["name"] == $campaign["name"]) {
				return false;
		}
		else {
			return true;
		}

	}

	public function exists($campaign = array()) {
		
		$campaignNameStr = $this->db->quote($campaign["name"]);
		$clientIDStr = $this->db->quote($campaign["clientID"]);

		if (($campaign["source"] != "") and ($campaign["refID"] > 0)) {
			$sourceStr = $this->db->quote($campaign["source"]);
			$refIDStr = $this->db->quote($campaign["refID"]);
			
			$sourceRefIDStr = " and source = $sourceStr and refID = $refIDStr ";	
		}	
		else {
			$sourceRefIDStr = "";
		}
		
		$r=$this->db->query("select * from BH_CAMPAIGNS where name = $campaignNameStr and clientID = $clientIDStr and agencyID = '$this->agencyID' $sourceRefIDStr and isDeleted is FALSE");
		 
		$results=$r->fetch(\PDO::FETCH_ASSOC);

		error_log("Campaign Exists: " . $this->db->lastQuery());

		if ($results["name"] == $campaign["name"]) {
				$this->campaignID = $results["id"];
				return true;
		}
		else {
			return false;
		}

	}	

	public function existsByRefID($source, $refID, $campaign = array()) {
		
		$sourceStr = $this->db->quote($source);
		$refIDStr = $this->db->quote($refID);
		$campaignNameStr = $this->db->quote($campaign["name"]);
		$clientIDStr = $this->db->quote($campaign["clientID"]);
		
		$r=$this->db->query("select * from BH_CAMPAIGNS where name = $campaignNameStr and clientID = $clientIDStr and agencyID = '$this->agencyID' and source = $sourceStr and refID = $refIDStr");
		 
		$results=$r->fetch(\PDO::FETCH_ASSOC);

		error_log("Campaign Exists By RefID: " . $this->db->lastQuery());

		if ($results["name"] == $campaign["name"]) {
				$this->campaignID = $results["id"];
				return true;
		}
		else {
			return false;
		}

	}
	
	public function getAllCampaigns() {
		
		  $agencyIDStr = $this->db->quote($this->agencyID);
				  
		  $r=$this->db->query("select 
						BH_CAMPAIGNS.*, BH_CLIENTS.name as clientName, BH_CAMPAIGNS.flightStart 
					from 
						BH_CAMPAIGNS 
					left join
						BH_CLIENTS 
							on 
						(BH_CAMPAIGNS.clientID = BH_CLIENTS.id) 
					where 
						BH_CAMPAIGNS.agencyID = $agencyIDStr
							and 
						BH_CAMPAIGNS.isDeleted is FALSE 
							and 
						BH_CLIENTS.isDeleted is FALSE 
					ORDER BY
						BH_CAMPAIGNS.flightStart desc");
	      $results=$r->fetchAll();
	
		  error_log($this->db->lastQuery());
			
		  return $results; 
	  
	}

	public function searchCampaigns($searchBy, $values) {
		
		  $agencyIDStr = $this->db->quote($this->agencyID);
		  $searchStr = "";
				 
		  if (is_array($values)) {
		  	if (count($values)>0) { 
		  		$valuesStr = "";
			   	foreach ($values as $value) {
			   		if ($valuesStr != "") {
				   		$valuesStr .= ",";
			   		}
				   	$valuesStr .= $this->db->quote($value);
			   	}
				$searchStr = "and `$searchBy` IN ($valuesStr)";
		  	}	
		  	else {
			  	return false;
		  	}		  
		  }	  
		  else {
			if ($values != "") {
				$valuesStr = $this->db->quote($values);
				$searchStr = "and `$searchBy`= $valuesStr";
			}	  
			else {
				return false;
			}
		  }
		  
		  $r=$this->db->query("select BH_CAMPAIGNS.*, BH_CLIENTS.name as clientName from BH_CAMPAIGNS left join BH_CLIENTS on (BH_CAMPAIGNS.clientID = BH_CLIENTS.id) where BH_CAMPAIGNS.agencyID = $agencyIDStr and BH_CAMPAIGNS.isDeleted is FALSE and BH_CLIENTS.isDeleted is FALSE $searchStr 
					ORDER BY
						BH_CAMPAIGNS.flightStart desc");
	      $results=$r->fetchAll();
	
		  error_log($this->db->lastQuery());
			
		  return $results;
	  
	}

	public function getRecentCampaigns() {
		
		  $agencyIDStr = $this->db->quote($this->agencyID);
		  $userIDStr = $this->db->quote($this->userID);
				  
		  $r=$this->db->query("select distinct
        		                        (concat(BH_HISTORY.activity,BH_HISTORY.refID)),
        		                        BH_CAMPAIGNS.*, 
		                                BH_CLIENTS.name as clientName
		                        from 
                                        BH_HISTORY 
                                left join 
		                                BH_CAMPAIGNS 
		                        on 
		                                  (BH_HISTORY.refID = BH_CAMPAIGNS.id 
		                                and
		                                  BH_HISTORY.activity='BH_CAMPAIGNS')
		                        left join 
		                                BH_CLIENTS 
		                        on 
		                                (BH_CAMPAIGNS.clientID = BH_CLIENTS.id)
		                        where 
		                                  BH_CAMPAIGNS.agencyID = $agencyIDStr
		                                and 
		                                  BH_HISTORY.userID = $userIDStr 
		                                and
		                                  BH_CAMPAIGNS.isDeleted 
		                                is 
		                                  FALSE 
		                        order by 
		                                  BH_HISTORY.activityStamp desc limit 10");
		  
	      $results=$r->fetchAll();
	
		  error_log($this->db->lastQuery());
			
		  return $results;
	  
	}
	
	public function getActiveCampaigns() {
		
		  $agencyIDStr = $this->db->quote($this->agencyID);
				  
		  $r=$this->db->query("select BH_CAMPAIGNS.*, BH_CLIENTS.name as clientName from BH_CAMPAIGNS left join BH_CLIENTS on (BH_CAMPAIGNS.clientID = BH_CLIENTS.id) where BH_CAMPAIGNS.agencyID = $agencyIDStr and BH_CAMPAIGNS.isDeleted is FALSE and BH_CAMPAIGNS.isActive is TRUE 
					ORDER BY
						BH_CAMPAIGNS.flightStart desc");
	      $results=$r->fetchAll();
	
		  error_log($this->db->lastQuery());
			
		  return $results;
	  
	}

	public function getArchivedCampaigns() {
		
		  $agencyIDStr = $this->db->quote($this->agencyID);
				  
		  $r=$this->db->query("select BH_CAMPAIGNS.*, BH_CLIENTS.name as clientName from BH_CAMPAIGNS left join BH_CLIENTS on (BH_CAMPAIGNS.clientID = BH_CLIENTS.id) where BH_CAMPAIGNS.agencyID = $agencyIDStr and BH_CAMPAIGNS.isDeleted is FALSE and BH_CAMPAIGNS.isActive is FALSE order by BH_CAMPAIGNS.flightStart desc");
	      $results=$r->fetchAll();
	
		  error_log($this->db->lastQuery());
			
		  return $results;

	}

	public function getPendingCampaigns() {
		
		  $agencyIDStr = $this->db->quote($this->agencyID);
				  
		  $r=$this->db->query("select BH_CAMPAIGNS.*, BH_CLIENTS.name as clientName from BH_CAMPAIGNS left join BH_CLIENTS on (BH_CAMPAIGNS.clientID = BH_CLIENTS.id) where BH_CAMPAIGNS.agencyID = $agencyIDStr and BH_CAMPAIGNS.isDeleted is FALSE and BH_CAMPAIGNS.isActive is TRUE 
					ORDER BY
						BH_CAMPAIGNS.flightStart desc");
	      $results=$r->fetchAll();
	
		  error_log($this->db->lastQuery());
			
		  return $results;

	}

	public function getCampaignsByClientID($clientID) {
		
		  $agencyIDStr = $this->db->quote($this->agencyID);
		  $clientIDStr = $this->db->quote($clientID);
				  
		  $r=$this->db->query("select BH_CAMPAIGNS.*, BH_CLIENTS.name as clientName from BH_CAMPAIGNS left join BH_CLIENTS on (BH_CAMPAIGNS.clientID = BH_CLIENTS.id) where BH_CAMPAIGNS.agencyID = $agencyIDStr and BH_CAMPAIGNS.clientID = $clientIDStr and BH_CAMPAIGNS.isDeleted is FALSE 
					ORDER BY
						BH_CAMPAIGNS.flightStart desc");
	      $results=$r->fetchAll();
	
		  error_log($this->db->lastQuery());
			
		  return $results;
	  
	  
	}

	public function getCampaignsByVendorID($vendorID) {
		
		  $agencyIDStr = $this->db->quote($this->agencyID);
		  $vendorIDStr = $this->db->quote($vendorID);

//needs work, have to create vendor search functionality after fixing vendor mgmt in campaigns!	
				  
		  $r=$this->db->query("select BH_CAMPAIGNS.*, BH_CLIENTS.name as clientName from BH_CAMPAIGNS left join BH_CLIENTS on (BH_CAMPAIGNS.clientID = BH_CLIENTS.id) where BH_CAMPAIGNS.agencyID = $agencyIDStr and BH_CAMPAIGNS.vendorID = $vendorIDStr and BH_CAMPAIGNS.isDeleted is FALSE and BH_CLIENTS.isDeleted is FALSE 
					ORDER BY
						BH_CAMPAIGNS.flightStart desc");
	      $results=$r->fetchAll();
	
		  error_log($this->db->lastQuery());
			
		  return $results;
	  
	  
	}
	
	public function countCampaignsByMonth($fromDate, $maxResults) {
		
		  $agencyIDStr = $this->db->quote($this->agencyID);
		  $maxResultsStr = intval($maxResults);
				  
		  $r=$this->db->query("select concat(year(flightStart),\"-\",LPAD(month(flightStart),2,'0')) as month, count(1) as total from BH_CAMPAIGNS where agencyID = $agencyIDStr and flightStart < now() and isDeleted is FALSE group by year(flightStart) desc,month(flightStart) desc limit $maxResultsStr;");
	      $results=$r->fetchAll();
	
		  error_log($this->db->lastQuery());
			
		  return $results;
	}

	public function countCampaigns() {
		
		  $agencyIDStr = $this->db->quote($this->agencyID);
				  
		  $r=$this->db->query("select count(1) as total from BH_CAMPAIGNS where agencyID = $agencyIDStr and isDeleted is FALSE");
	      $results=$r->fetch(\PDO::FETCH_ASSOC);
	
		  if ($results["total"]) {
		  	return $results["total"];
		  }
		  else {
			  return 0;
		  }			
	}

	public function countCampaignsByAgencyID($agencyID) {
		
		  $agencyIDStr = $this->db->quote($agencyID);
				  
		  $r=$this->db->query("select count(1) as total from BH_CAMPAIGNS where agencyID = $agencyIDStr and isDeleted is FALSE");
	      $results=$r->fetch(\PDO::FETCH_ASSOC);
	
		  if ($results["total"]) {
		  	return $results["total"];
		  }
		  else {
			  return 0;
		  }			
	}

	public function countCampaignsByStatus($status) {
		
		  $agencyIDStr = $this->db->quote($this->agencyID);
				 
		  if ($status != "") {			  
			  $r=$this->db->query("select count(1) as total from BH_CAMPAIGNS where agencyID = $agencyIDStr and flightStart < now() and isDeleted is FALSE and $status is TRUE");
			  $results=$r->fetch(\PDO::FETCH_ASSOC);
	
			  if ($results["total"]) {
				  return $results["total"];
			  }
			  else {
			  	  return 0;
			  }	
		  }
		  else {
			  return false;
		  }		
	}
	
	public function getGrossCostByCampaignIDAndStatus($campaignID, $status) {

		$totalSpend = 0.00;

		if ($status == "isPending") {

		  // look up campaign using agency id

		  $campaign = $this->getCampaign($campaignID);
		  
		  // lookup worksheets by status and type, sum accordingly
		  
		  $wrksht = new \BH\worksheet($this->db, $this->agencyID, $this->userID);
		  
		  $worksheets = $wrksht->getAllWorksheetsByCampaignID($campaignID);
		  
		  foreach ($worksheets as $worksheet) {
			  			  			  
			  if ($worksheet[$status]) {
			  
				  $worksheetIDStr = $this->db->quote($worksheet["id"]);

				  if (in_array($worksheet["typeID"], $this->types["tv"])) {
					  $tv = new \BH\tv($this->db, $this->agencyID, $this->userID);
					  $totals = $tv->totalSpotsAndSpend($worksheet["id"]);
				  }

				  if (in_array($worksheet["typeID"], $this->types["radio"])) {
					  $radio = new \BH\radio($this->db, $this->agencyID, $this->userID);
					  $totals = $radio->totalSpotsAndSpend($worksheet["id"]);
				  }
				  
				  if (in_array($worksheet["typeID"], $this->types["cable"])) {
					  $cable = new \BH\cable($this->db, $this->agencyID, $this->userID);
					  $totals = $cable->totalSpotsAndSpend($worksheet["id"]);
				  }

				  if (in_array($worksheet["typeID"], $this->types["prnt"])) {
					  $prnt = new \BH\prnt($this->db, $this->agencyID, $this->userID);
					  $totals = $prnt->totalSpotsAndSpend($worksheet["id"]);
				  }

				  if (in_array($worksheet["typeID"], $this->types["outdoor"])) {
					  $outdoor = new \BH\outdoor($this->db, $this->agencyID, $this->userID);
					  $totals = $outdoor->totalSpotsAndSpend($worksheet["id"]);
				  }
				  				  
				  $r=$this->db->query("select totalSpend from BH_WORKSHEETS where id = $worksheetIDStr and isDeleted is FALSE");

				  $results=$r->fetch(\PDO::FETCH_ASSOC);
		      
				  $totalSpend += $results["totalSpend"];
			  }
		  }
	
		}
	
		
		return $totalSpend;
	}

	
	public function getNetCostByCampaignIDAndStatus($campaignID, $status) {
		
		$netSpend = 0.00;

		if ($status == "isPending") {

		  // look up campaign using agency id

		  $campaign = $this->getCampaign($campaignID);
		  
		  // lookup worksheets by status and type, sum accordingly
		  
		  $wrksht = new \BH\worksheet($this->db, $this->agencyID, $this->userID);
		  
		  $worksheets = $wrksht->getAllWorksheetsByCampaignID($campaignID);
		  
		  foreach ($worksheets as $worksheet) {
			  
			  $totalSpend = 0.00;
			  			  
			  if ($worksheet[$status]) {
			  
				  $worksheetIDStr = $this->db->quote($worksheet["id"]);
				  
				  if (in_array($worksheet["typeID"], $this->types["tv"])) {
					  $tv = new \BH\tv($this->db, $this->agencyID, $this->userID);
					  $totals = $tv->totalSpotsAndSpend($worksheet["id"]);
				  }

				  if (in_array($worksheet["typeID"], $this->types["radio"])) {
					  $radio = new \BH\radio($this->db, $this->agencyID, $this->userID);
					  $totals = $radio->totalSpotsAndSpend($worksheet["id"]);
				  }
				  
				  if (in_array($worksheet["typeID"], $this->types["cable"])) {
					  $cable = new \BH\cable($this->db, $this->agencyID, $this->userID);
					  $totals = $cable->totalSpotsAndSpend($worksheet["id"]);
				  }

				  if (in_array($worksheet["typeID"], $this->types["prnt"])) {
					  $prnt = new \BH\prnt($this->db, $this->agencyID, $this->userID);
					  $totals = $prnt->totalSpotsAndSpend($worksheet["id"]);
				  }

				  if (in_array($worksheet["typeID"], $this->types["outdoor"])) {
					  $outdoor = new \BH\outdoor($this->db, $this->agencyID, $this->userID);
					  $totals = $outdoor->totalSpotsAndSpend($worksheet["id"]);
				  }
				  
				  $r=$this->db->query("select totalSpend, commission from BH_WORKSHEETS where id = $worksheetIDStr and isDeleted is FALSE");

				  $results=$r->fetch(\PDO::FETCH_ASSOC);
		      
				  $totalSpend = $results["totalSpend"];
				  $worksheetCommission = $results["commission"];
				  $campaignCommission = $campaign["commission"];
				  	
				  if ($worksheetCommission == "") {
					  //$netSpend += $totalSpend * ((100-$campaignCommission)/100);
				  }
				  else {
					  //$netSpend += $totalSpend * ((100-$worksheetCommission)/100);					  
				  }

				  $netSpend += $totalSpend * ((100-$campaignCommission)/100);

			  }
		  }
	
		}
	
		
		return $netSpend;
	}
	
		
	public function getTotalSpotsByCampaignIDAndStatus($campaignID, $status) {
		
		$totalSpots = 0;
		
		if ($status == "isPending") {

		  // look up campaign using agency id

		  $campaign = $this->getCampaign($campaignID);
		  
		  // lookup worksheets by status and type, sum accordingly
		  
		  $wrksht = new \BH\worksheet($this->db, $this->agencyID, $this->userID);
		  
		  $worksheets = $wrksht->getAllWorksheetsByCampaignID($campaignID);
		  
		  foreach ($worksheets as $worksheet) {			  
			  			  
			  if (($worksheet[$status]) and (in_array($worksheet["typeID"], $this->types["tv"]))) {
			  
				  $worksheetIDStr = $this->db->quote($worksheet["id"]);
				  
				  $r=$this->db->query("select sum(BH_WORKSHEET_TV_WEEKS.weekValue) as totalSpots from BH_WORKSHEET_TV_WEEKS where worksheetID = $worksheetIDStr and isDeleted is FALSE");

				  $results=$r->fetch(\PDO::FETCH_ASSOC);
		      
				  $totalSpots += $results["totalSpots"];
			  }
		  }
	
		}
				
		return $totalSpots;
	}
	
}