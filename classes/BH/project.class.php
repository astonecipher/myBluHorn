<?php

/**
 * BLUHORN PROJECT CLASS
 *  
 * @author Wes Benwick
 * @link http://www.filelogix.com
 * @license Part of Filelogix usage license
 */ 
  
namespace BH;

class project
{  
    // Will store database connection here
	private $db;
	private $sessionID;
	private $projectID;
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
	
	public function getprojectID() {
		return $this->projectID;
	}

	public function addproject($project = array()) {
	  	  
	  if ($this->exists($project)) {
		  
		  return false;
	  }
	  
	  else {
		  
		  $project["isActive"] = true;
		  $project["agencyID"] = $this->agencyID;
		  
		  if (intval($project["clientID"])>0) {
			  	$this->projectID = $this->db->insert("BH_PROJECTS", $project);
			  	error_log("Insert project: " . $this->db->lastQuery());
			  	return $this->projectID;
		  }
		  else {
			  return false;
		  }
	  }
				
	  return $results;

		
	}

	public function deleteproject($projectID) {

	  if ($this->agencyID == $this->getAgency($projectID)) {
	  
		  if ($projectID>0) {
				$result = $this->db->update("BH_PROJECTS", "id", $projectID,  array("isDeleted"=>true));		
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

	public function getAgency($projectID) {
		$projectIDStr = $this->db->quote($projectID);
		
		$r=$this->db->query("select agencyID from BH_PROJECTS where id = $projectIDStr and agencyID = \"$this->agencyID\"");
		 
		$results=$r->fetch(\PDO::FETCH_ASSOC);


		if ($results["agencyID"]) {
				return $results["agencyID"];
		}
		else {
			return false;
		}
		
	}
	
	public function saveproject($projectID, $project = array()) {

	  if ($this->unique($projectID, $project)) {
	  
		  if ($projectID>0) {
		  	if (intval($project["clientID"])>0) {
				if ($project["agencyID"] == $this->agencyID) {
					$result = $this->db->update("BH_PROJECTS", "id", $projectID,  $project);		
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
	
	public function getproject($projectID) {
		$projectIDStr = $this->db->quote($projectID);
		
		$r=$this->db->query("select BH_PROJECTS.* from BH_PROJECTS where BH_PROJECTS.id = $projectIDStr and BH_PROJECTS.agencyID = \"$this->agencyID\"");
		 
		$results=$r->fetch(\PDO::FETCH_ASSOC);

		error_log("project Exists: " . $this->db->lastQuery());

		if ($results["id"]) {
				$this->projectID = $results["id"];
				return $results;
		}
		else {
			return false;
		}
		
	}	
	
	public function unique($projectID, $project = array()) {
		
		$projectNameStr = $this->db->quote($project["name"]);
		$clientIDStr = $this->db->quote($project["clientID"]);
		$projectIDStr = $this->db->quote($projectID);
		
		$r=$this->db->query("select * from BH_PROJECTS where name = $projectNameStr and id != $projectIDStr and agencyID = '$this->agencyID' and clientID = $clientIDStr and isDeleted is FALSE");
		 
		$results=$r->fetch(\PDO::FETCH_ASSOC);

		error_log("project Name Unique?: " . $this->db->lastQuery());

		if ($results["name"] == $project["name"]) {
				return false;
		}
		else {
			return true;
		}

	}

	public function exists($project = array()) {
		
		$projectNameStr = $this->db->quote($project["name"]);
		$clientIDStr = $this->db->quote($project["clientID"]);

		if (($project["source"] != "") and ($project["refID"] > 0)) {
			$sourceStr = $this->db->quote($project["source"]);
			$refIDStr = $this->db->quote($project["refID"]);
			
			$sourceRefIDStr = " and source = $sourceStr and refID = $refIDStr ";	
		}	
		else {
			$sourceRefIDStr = "";
		}
		
		$r=$this->db->query("select * from BH_PROJECTS where name = $projectNameStr and clientID = $clientIDStr and agencyID = '$this->agencyID' $sourceRefIDStr and isDeleted is FALSE");
		 
		$results=$r->fetch(\PDO::FETCH_ASSOC);

		error_log("project Exists: " . $this->db->lastQuery());

		if ($results["name"] == $project["name"]) {
				$this->projectID = $results["id"];
				return true;
		}
		else {
			return false;
		}

	}	

	public function existsByRefID($source, $refID, $project = array()) {
		
		$sourceStr = $this->db->quote($source);
		$refIDStr = $this->db->quote($refID);
		$projectNameStr = $this->db->quote($project["name"]);
		$clientIDStr = $this->db->quote($project["clientID"]);
		
		$r=$this->db->query("select * from BH_PROJECTS where name = $projectNameStr and clientID = $clientIDStr and agencyID = '$this->agencyID' and source = $sourceStr and refID = $refIDStr");
		 
		$results=$r->fetch(\PDO::FETCH_ASSOC);

		error_log("project Exists By RefID: " . $this->db->lastQuery());

		if ($results["name"] == $project["name"]) {
				$this->projectID = $results["id"];
				return true;
		}
		else {
			return false;
		}

	}
	
	public function getAllprojects() {
		
		  $agencyIDStr = $this->db->quote($this->agencyID);
				  
		  $r=$this->db->query("select BH_PROJECTS.*, BH_CLIENTS.name as clientName from BH_PROJECTS left join BH_CLIENTS on (BH_PROJECTS.clientID = BH_CLIENTS.id) where BH_PROJECTS.agencyID = $agencyIDStr and BH_PROJECTS.isDeleted is FALSE and BH_CLIENTS.isDeleted is FALSE order by BH_PROJECTS.name asc");
	      $results=$r->fetchAll();
	
		  error_log($this->db->lastQuery());
			
		  return $results;
	  
	}

	public function searchprojects($searchBy, $values) {
		
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
		  
		  $r=$this->db->query("select BH_PROJECTS.*, BH_CLIENTS.name as clientName from BH_PROJECTS left join BH_CLIENTS on (BH_PROJECTS.clientID = BH_CLIENTS.id) where BH_PROJECTS.agencyID = $agencyIDStr and BH_PROJECTS.isDeleted is FALSE and BH_CLIENTS.isDeleted is FALSE $searchStr order  by BH_PROJECTS.name asc");
	      $results=$r->fetchAll();
	
		  error_log($this->db->lastQuery());
			
		  return $results;
	  
	}

	public function getRecentprojects() {
		
		  $agencyIDStr = $this->db->quote($this->agencyID);
		  $userIDStr = $this->db->quote($this->userID);
				  
		  $r=$this->db->query("select distinct(concat(BH_HISTORY.activity,BH_HISTORY.refID)),BH_PROJECTS.*, BH_CLIENTS.name as clientName from BH_HISTORY left join BH_PROJECTS on (BH_HISTORY.refID = BH_PROJECTS.id and BH_HISTORY.activity='BH_PROJECTS') left join BH_CLIENTS on (BH_PROJECTS.clientID = BH_CLIENTS.id) where BH_PROJECTS.agencyID = $agencyIDStr and BH_HISTORY.userID = $userIDStr and BH_PROJECTS.isDeleted is FALSE order by BH_HISTORY.activityStamp desc limit 10");
	      $results=$r->fetchAll();
	
		  error_log($this->db->lastQuery());
			
		  return $results;
	  
	}
	
	public function getActiveprojects() {
		
		  $agencyIDStr = $this->db->quote($this->agencyID);
				  
		  $r=$this->db->query("select BH_PROJECTS.*, BH_CLIENTS.name as clientName from BH_PROJECTS left join BH_CLIENTS on (BH_PROJECTS.clientID = BH_CLIENTS.id) where BH_PROJECTS.agencyID = $agencyIDStr and BH_PROJECTS.isDeleted is FALSE and BH_PROJECTS.isActive is TRUE order by BH_PROJECTS.name asc");
	      $results=$r->fetchAll();
	
		  error_log($this->db->lastQuery());
			
		  return $results;
	  
	}

	public function getArchivedprojects() {
		
		  $agencyIDStr = $this->db->quote($this->agencyID);
				  
		  $r=$this->db->query("select BH_PROJECTS.*, BH_CLIENTS.name as clientName from BH_PROJECTS left join BH_CLIENTS on (BH_PROJECTS.clientID = BH_CLIENTS.id) where BH_PROJECTS.agencyID = $agencyIDStr and BH_PROJECTS.isDeleted is FALSE and BH_PROJECTS.isActive is FALSE order by BH_PROJECTS.name asc");
	      $results=$r->fetchAll();
	
		  error_log($this->db->lastQuery());
			
		  return $results;

	}

	public function getPendingprojects() {
		
		  $agencyIDStr = $this->db->quote($this->agencyID);
				  
		  $r=$this->db->query("select BH_PROJECTS.*, BH_CLIENTS.name as clientName from BH_PROJECTS left join BH_CLIENTS on (BH_PROJECTS.clientID = BH_CLIENTS.id) where BH_PROJECTS.agencyID = $agencyIDStr and BH_PROJECTS.isDeleted is FALSE and BH_PROJECTS.isActive is TRUE order by BH_PROJECTS.name asc");
	      $results=$r->fetchAll();
	
		  error_log($this->db->lastQuery());
			
		  return $results;

	}

	public function getprojectsByClientID($clientID) {
		
		  $agencyIDStr = $this->db->quote($this->agencyID);
		  $clientIDStr = $this->db->quote($clientID);
				  
		  $r=$this->db->query("select BH_PROJECTS.*, BH_CLIENTS.name as clientName from BH_PROJECTS left join BH_CLIENTS on (BH_PROJECTS.clientID = BH_CLIENTS.id) where BH_PROJECTS.agencyID = $agencyIDStr and BH_PROJECTS.clientID = $clientIDStr and BH_PROJECTS.isDeleted is FALSE order by BH_PROJECTS.name asc");
	      $results=$r->fetchAll();
	
		  error_log($this->db->lastQuery());
			
		  return $results;
	  
	  
	}

	public function getprojectsByVendorID($vendorID) {
		
		  $agencyIDStr = $this->db->quote($this->agencyID);
		  $vendorIDStr = $this->db->quote($vendorID);

//needs work, have to create vendor search functionality after fixing vendor mgmt in projects!	
				  
		  $r=$this->db->query("select BH_PROJECTS.*, BH_CLIENTS.name as clientName from BH_PROJECTS left join BH_CLIENTS on (BH_PROJECTS.clientID = BH_CLIENTS.id) where BH_PROJECTS.agencyID = $agencyIDStr and BH_PROJECTS.vendorID = $vendorIDStr and BH_PROJECTS.isDeleted is FALSE and BH_CLIENTS.isDeleted is FALSE order by BH_PROJECTS.name asc");
	      $results=$r->fetchAll();
	
		  error_log($this->db->lastQuery());
			
		  return $results;
	  
	  
	}
	
	public function countProjectsByMonth($fromDate, $maxResults) {
		
		  $agencyIDStr = $this->db->quote($this->agencyID);
		  $maxResultsStr = intval($maxResults);
				  
		  $r=$this->db->query("select concat(year(startDate),\"-\",LPAD(month(startDate),2,'0')) as month, count(1) as total from BH_PROJECTS where agencyID = $agencyIDStr and startDate < now() and isDeleted is FALSE group by year(startDate) desc,month(startDate) desc limit $maxResultsStr;");
	      $results=$r->fetchAll();
	
		  error_log($this->db->lastQuery());
			
		  return $results;
	}

	public function countProjects() {
		
		  $agencyIDStr = $this->db->quote($this->agencyID);
				  
		  $r=$this->db->query("select count(1) as total from BH_PROJECTS where agencyID = $agencyIDStr and isDeleted is FALSE");
	      $results=$r->fetch(\PDO::FETCH_ASSOC);
	
		  if ($results["total"]) {
		  	return $results["total"];
		  }
		  else {
			  return 0;
		  }			
	}

	public function countprojectsByAgencyID($agencyID) {
		
		  $agencyIDStr = $this->db->quote($agencyID);
				  
		  $r=$this->db->query("select count(1) as total from BH_PROJECTS where agencyID = $agencyIDStr and isDeleted is FALSE");
	      $results=$r->fetch(\PDO::FETCH_ASSOC);
	
		  if ($results["total"]) {
		  	return $results["total"];
		  }
		  else {
			  return 0;
		  }			
	}

	public function countprojectsByStatus($status) {
		
		  $agencyIDStr = $this->db->quote($this->agencyID);
				 
		  if ($status != "") {			  
			  $r=$this->db->query("select count(1) as total from BH_PROJECTS where agencyID = $agencyIDStr and startDate < now() and isDeleted is FALSE and $status is TRUE");
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
	
	public function getGrossCostByprojectIDAndStatus($projectID, $status) {

		$totalSpend = 0.00;

		if ($status == "isPending") {

		  // look up project using agency id

		  $project = $this->getproject($projectID);
		  
		  // lookup worksheets by status and type, sum accordingly
		  
		  $wrksht = new \BH\worksheet($this->db, $this->agencyID, $this->userID);
		  
		  $worksheets = $wrksht->getAllWorksheetsByprojectID($projectID);
		  
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

	
	public function getNetCostByprojectIDAndStatus($projectID, $status) {
		
		$netSpend = 0.00;

		if ($status == "isPending") {

		  // look up project using agency id

		  $project = $this->getproject($projectID);
		  
		  // lookup worksheets by status and type, sum accordingly
		  
		  $wrksht = new \BH\worksheet($this->db, $this->agencyID, $this->userID);
		  
		  $worksheets = $wrksht->getAllWorksheetsByprojectID($projectID);
		  
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
				  $projectCommission = $project["commission"];
				  	
				  if ($worksheetCommission == "") {
					  //$netSpend += $totalSpend * ((100-$projectCommission)/100);
				  }
				  else {
					  //$netSpend += $totalSpend * ((100-$worksheetCommission)/100);					  
				  }

				  $netSpend += $totalSpend * ((100-$projectCommission)/100);

			  }
		  }
	
		}
	
		
		return $netSpend;
	}
	
		
	public function getTotalSpotsByprojectIDAndStatus($projectID, $status) {
		
		$totalSpots = 0;
		
		if ($status == "isPending") {

		  // look up project using agency id

		  $project = $this->getproject($projectID);
		  
		  // lookup worksheets by status and type, sum accordingly
		  
		  $wrksht = new \BH\worksheet($this->db, $this->agencyID, $this->userID);
		  
		  $worksheets = $wrksht->getAllWorksheetsByprojectID($projectID);
		  
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