<?php

/**
 * BLUHORN INVENTORY CLASS
 *  
 * @author Wes Benwick
 * @link http://www.filelogix.com
 * @license Part of Filelogix usage license
 */ 
  
namespace BH;

class inventory
{  
    // Will store database connection here
	private $db;
	private $sessionID;
	private $clientID;
	private $agencyID;
	private $userID;
	private $programs;
	private $worksheet;
	private $vendor;
	private $tv;

	
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

	  $this->tv = new \BH\tv($db, $agencyID, $userID);
	  $this->cable = new \BH\cable($db, $agencyID, $userID);
	  $this->radio = new \BH\radio($db, $agencyID, $userID);
	  $this->programs = new \BH\programs($db, $agencyID, $userID);
	  $this->worksheet = new \BH\worksheet($db, $agencyID, $userID);
	  $this->vendor = new \BH\vendor($db, $agencyID, $userID);

		
	}

	public function addProgram($program, $ratings, $rates) {
		
		$availID = $this->db->insert("BH_AVAILS", $program);

		foreach($ratings as $rating) {
			$rating["availID"] = $availID;
			$this->db->insert("BH_AVAIL_RATINGS", $rating);
		}

		foreach($rates as $rate) {
			$rate["availID"] = $availID;
			$this->db->insert("BH_AVAIL_RATES", $rate);
		}
		
	}

	public function upsertProgram($program, $ratings, $rates) {
		
		$programID = $this->programExists($program);
				
		if ($programID > 0) {
						
			$program["id"]=$programID;

			$availID = $this->db->upsert("BH_AVAILS", $program);
	
			foreach($ratings as $rating) {
/*
				$ratingID = $this->ratingExists($program, $rating);
				
				if ($ratingID > 0) {
					$rating["id"] = $ratingID;
				}
*/
				
				$rating["availID"] = $availID;
		
				$this->db->upsert("BH_AVAIL_RATINGS", $rating);
			}
	
			foreach($rates as $rate) {
/*
				$rateID = $this->rateExists($program, $rate);
				
				if ($rateID > 0) {
					$rate["id"] = $rateID;
				}
*/
				
				$rate["availID"] = $availID;
				$this->db->upsert("BH_AVAIL_RATES", $rate);
			}
		}
		else {
			$this->addProgram($program, $ratings, $rates);
		}
		
	}

	public function programExists($program = array()) {
		
		$programNameStr = $this->db->quote($program["name"]);
		$stationStr = $this->db->quote($program["station"]);
		$timePeriodStr = $this->db->quote($program["timePeriod"]);

		if (($program["source"] != "") and ($program["refID"] > 0)) {
			$sourceStr = $this->db->quote($program["source"]);
			$refIDStr = $this->db->quote($program["refID"]);
			
			$sourceRefIDStr = "(source = $sourceStr and refID = $refIDStr) ";	
			$qryStr = "select * from BH_AVAILS where agencyID = '$this->agencyID' and $sourceRefIDStr and isDeleted is FALSE limit 1";
		}	
		else {
			$sourceRefIDStr = "";
			$qryStr = "select * from BH_AVAILS where (name = $programNameStr and station = $stationStr and timePeriod = $timePeriodStr) and agencyID = '$this->agencyID'  and isDeleted is FALSE limit 1";
		}
				
		$r=$this->db->query($qryStr);
		 
		$results=$r->fetch(\PDO::FETCH_ASSOC);

		error_log("Program Exists ($sourceRefIDStr): " . $this->db->lastQuery());

		if ($results["name"] == $program["name"]) {
				$this->programID = $results["id"];
				return $results["id"];
		}
		else {
			return false;
		}

	}	

	public function ratingExists($program = array(), $rating = array()) {
		
		$availIDStr = $this->db->quote($program["id"]);


		if (($program["source"] != "") and ($program["refID"] > 0)) {
			$sourceStr = $this->db->quote($program["source"]);
			$refIDStr = $this->db->quote($program["refID"]);
			
			$sourceRefIDStr = " and source = $sourceStr and refID = $refIDStr ";	
		}	
		else {
			$sourceRefIDStr = "";
		}
		
		$r=$this->db->query("select * from BH_AVAIL_RATINGS where agencyID = '$this->agencyID' and (availID = $availIDStr) or ($sourceRefIDStr) and isDeleted is FALSE limit 1");
		 
		$results=$r->fetch(\PDO::FETCH_ASSOC);

		error_log("Program Rating Exists: " . $this->db->lastQuery());

		if ($results["id"] > 0) {
			return $results["id"];
		}
		else {
			return false;
		}

	}

	public function rateExists($program = array(), $rate = array()) {
		
		$availIDStr = $this->db->quote($program["id"]);

		if (($program["source"] != "") and ($program["refID"] > 0)) {
			$sourceStr = $this->db->quote($program["source"]);
			$refIDStr = $this->db->quote($program["refID"]);
			
			$sourceRefIDStr = " and source = $sourceStr and refID = $refIDStr ";	
		}	
		else {
			$sourceRefIDStr = "";
		}
		
		$r=$this->db->query("select * from BH_AVAIL_RATES where agencyID = '$this->agencyID' and (availID = $availIDStr) or ($sourceRefIDStr) and isDeleted is FALSE limit 1");
		 
		$results=$r->fetch(\PDO::FETCH_ASSOC);

		error_log("Program Rate Exists: " . $this->db->lastQuery());

		if ($results["id"] > 0) {
			return $results["id"];
		}
		else {
			return false;
		}

	}
	
	public function autoPopulateTVByVendor($worksheetID, $vendors = array(), $demos = array()) {
		
		foreach ($vendors as $vendor) {
			
			foreach ($demos as $demo) {
				
				$line = array();
								
				$programs = $this->programs->getAllProgramsByVendor($vendor);

				foreach ($programs as $program) {

					$line["worksheetID"] = $worksheetID;
					$line["vendorID"] = $vendor;
					$line["station"] = $program["station"];
					$line["timePeriod"] = $program["timePeriod"];
					$line["programName"] = $program["name"];
					$line["days"] = $program["daysOfWeek"];
					$line["daypart"] = $program["daypart"];
					$line["isMonday"] = $program["isMonday"];
					$line["isTuesday"] = $program["isTuesday"];
					$line["isWednesday"] = $program["isWednesday"];
					$line["isThursday"] = $program["isThursday"];
					$line["isFriday"] = $program["isFriday"];
					$line["isSaturday"] = $program["isSaturday"];
					$line["isSunday"] = $program["isSunday"];
										
					$rating = $this->programs->getRatingByProgramAndDemo($program["id"], $demo);
					
					if (count($rating)) {
						$line["aqhRating"] = $rating["aqhRating"];
						$line["impact"] = $rating["impressions"];
					}
					else {
						$line["aqhRating"] = "0.0";
						$line["impact"] = "0";						
					}
					
					$line["comments"] = $program["comments"];
					$line["source"] = "BH_AVAILS";
					$line["isAutoPop"] = true;
					$line["refID"] = $program["id"];

					$rates = $this->programs->getRatesByProgram($program["id"]);

					foreach ($rates as $rate) {
						
						$line["seconds"] = $rate["seconds"];		
						$line["rate"] = $rate["rate"];
						$line["source"] = "BH_AVAIL_RATES";
						$line["refID"] = $rate["id"];
						
						if ( ! $this->tv->autoPopulated($worksheetID, $line["source"], $line["refID"])) {
							$this->tv->addLineByWorksheetID($worksheetID, $line);
						}
					}					
				}					
			}
		}
	}
	

	public function autoPopulateCableByVendor($worksheetID, $vendors = array(), $demos = array()) {
		
		foreach ($vendors as $vendor) {
			
			foreach ($demos as $demo) {
				
				$line = array();
								
				$programs = $this->programs->getAllProgramsByVendor($vendor);

				foreach ($programs as $program) {

					$line["worksheetID"] = $worksheetID;
					$line["vendorID"] = $vendor;
					$line["station"] = $program["station"];
					$line["zone"] = $program["zone"];
					$line["timePeriod"] = $program["timePeriod"];
					$line["programName"] = $program["name"];
					$line["days"] = $program["daysOfWeek"];
					$line["daypart"] = $program["daypart"];
					$line["isMonday"] = $program["isMonday"];
					$line["isTuesday"] = $program["isTuesday"];
					$line["isWednesday"] = $program["isWednesday"];
					$line["isThursday"] = $program["isThursday"];
					$line["isFriday"] = $program["isFriday"];
					$line["isSaturday"] = $program["isSaturday"];
					$line["isSunday"] = $program["isSunday"];
					
					$rating = $this->programs->getRatingByProgramAndDemo($program["id"], $demo);
					
					if ($rating["id"]) {
						$line["aqhRating"] = $rating["aqhRating"];
						$line["impact"] = $rating["impressions"];
					}
					else {
						$line["aqhRating"] = "0.0";
						$line["impact"] = "0";						
					}
					
					$line["comments"] = $program["comments"];
					$line["source"] = "BH_AVAILS";
					$line["isAutoPop"] = true;
					$line["refID"] = $program["id"];

					$rates = $this->programs->getRatesByProgram($program["id"]);

					foreach ($rates as $rate) {
						
						$line["seconds"] = $rate["seconds"];		
						$line["rate"] = $rate["rate"];
						$line["source"] = "BH_AVAIL_RATES";
						$line["refID"] = $rate["id"];

						if ( ! $this->cable->autoPopulated($worksheetID, $line["source"], $line["refID"])) {

							$this->cable->addLineByWorksheetID($worksheetID, $line);
						}
						
					}					
				}					
			}
		}
	}

	public function autoPopulateRadioByVendor($worksheetID, $vendors = array(), $demos = array()) {
		
		foreach ($vendors as $vendor) {
			
			foreach ($demos as $demo) {
				
				$line = array();
								
				$programs = $this->programs->getAllProgramsByVendor($vendor);

				foreach ($programs as $program) {

					$line["worksheetID"] = $worksheetID;
					$line["vendorID"] = $vendor;
					$line["station"] = $program["station"];
					$line["zone"] = $program["zone"];
					$line["timePeriod"] = $program["timePeriod"];
					$line["programName"] = $program["name"];
					$line["days"] = $program["daysOfWeek"];
					$line["daypart"] = $program["daypart"];
					$line["isMonday"] = $program["isMonday"];
					$line["isTuesday"] = $program["isTuesday"];
					$line["isWednesday"] = $program["isWednesday"];
					$line["isThursday"] = $program["isThursday"];
					$line["isFriday"] = $program["isFriday"];
					$line["isSaturday"] = $program["isSaturday"];
					$line["isSunday"] = $program["isSunday"];
										
					$rating = $this->programs->getRatingByProgramAndDemo($program["id"], $demo);
					
					if ($rating["id"]) {
						$line["aqhRating"] = $rating["aqhRating"];
						$line["impact"] = $rating["impressions"];
					}
					else {
						$line["aqhRating"] = "0.0";
						$line["impact"] = "0";						
					}
					
					$line["comments"] = $program["comments"];
					$line["source"] = "BH_AVAILS";
					$line["isAutoPop"] = true;
					$line["refID"] = $program["id"];

					$rates = $this->programs->getRatesByProgram($program["id"]);

					foreach ($rates as $rate) {
						
						$line["seconds"] = $rate["seconds"];		
						$line["rate"] = $rate["rate"];
						$line["source"] = "BH_AVAIL_RATES";
						$line["refID"] = $rate["id"];

						if ( ! $this->radio->autoPopulated($worksheetID, $line["source"], $line["refID"])) {

							$this->radio->addLineByWorksheetID($worksheetID, $line);
						}
						
					}					
				}					
			}
		}
	}

	
}