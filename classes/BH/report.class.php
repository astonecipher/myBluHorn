<?php

/**
 * BLUHORN REPORT CLASS
 *  
 * @author Wes Benwick
 * @link http://www.filelogix.com
 * @license Part of Filelogix usage license
 */ 
  
namespace BH;

class report
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

	public function create($reportID, $master = array(), $detail = array()) {
		
		
		if ($this->agencyID > 0) {
			if ($this->agencyID == $master["agencyID"]) {
					$master["userID"] = $this->userID;
					$master["reportCreated"] = date('Y-m-d H:i:s');
					$result = $this->db->insert("BH_REPORTS", $master);		
					if ($result) {							
						$params = array();
						$params["reportID"] = $result;
						if ($master["category"] == "summary") {
							$params["clients"] = implode(",",$detail["clients"]);
							$params["campaigns"] = implode(",",$detail["campaigns"]);
							$params["vendors"] = implode(",",$detail["vendors"]);
							$params["markets"] = implode(",",$detail["markets"]);
							$params["typeID"] = implode(",",$detail["typeID"]);
							$reportID = $this->db->insert("BH_REPORT_SUMMARY", $params);							
							error_log("BH_REPORT Summary Insert " . $this->db->lastQuery());
							return $result;	
						}
						else if ($master["category"] == "schedule") {
							$params["clients"] = implode(",",$detail["clients"]);
							$params["campaigns"] = implode(",",$detail["campaigns"]);
							$params["worksheets"] = implode(",",$detail["worksheets"]);
							$params["markets"] = implode(",",$detail["markets"]);
							$params["vendors"] = implode(",",$detail["vendors"]);
							$reportID = $this->db->insert("BH_REPORT_SCHEDULE", $params);							
							error_log("BH_REPORT Schedule Insert " . $this->db->lastQuery());
							return $result;	
						}
						else if ($master["category"] == "tracking") {
							$params["clients"] = implode(",",$detail["clients"]);
							$params["campaigns"] = implode(",",$detail["campaigns"]);
							$params["marketTypes"] = implode(",",$detail["marketTypes"]);
							$params["startDate"] = $detail["startDate"];
							$params["endDate"] = $detail["endDate"];
							$params["typeID"] = $detail["typeID"];							
							$params["allCampaigns"] = $detail["allCampaigns"];							
							$params["allMarketTypes"] = $detail["allMarketTypes"];							
							$params["allClients"] = $detail["allClients"];							
							$params["isBilling"] = $detail["isBilling"];							
							$params["isPending"] = $detail["isPending"];							
							$params["isNetCost"] = $detail["isNetCost"];							
							$reportID = $this->db->insert("BH_REPORT_TRACKING", $params);		
							error_log("BH_REPORT Tracking Insert " . $this->db->lastQuery());
							return $result;	
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
		
		return false;
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

	
	public function status($reportID, $status) {
	  
		  if ($reportID>0) {
				$result = $this->db->update("BH_REPORTS", "id", $reportID,  array("status"=>$status));		
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
	
	
	public function isReady($reportID, $ready) {
	  
		  if ($reportID>0) {
				$result = $this->db->update("BH_REPORTS", "id", $reportID,  array("isReady"=>$ready));		
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
	
	public function getReport($reportID) {
		$reportIDStr = $this->db->quote($reportID);
		
		$r=$this->db->query("select BH_REPORTS.*, BH_REPORT_TEMPLATES.source from BH_REPORTS left join BH_REPORT_TEMPLATES on (BH_REPORTS.templateID = BH_REPORT_TEMPLATES.id) where BH_REPORTS.id = $reportIDStr and BH_REPORTS.agencyID = \"$this->agencyID\"");
		 
		$results=$r->fetch(\PDO::FETCH_ASSOC);

		error_log("Report Exists: " . $this->db->lastQuery());

		if ($results["id"]) {
				$reportTable = "BH_REPORT_" . strtoupper($results["category"]);
				$this->reportID = $results["id"];
				$r=$this->db->query("select * from $reportTable where reportID = $reportIDStr");
			 
				$details=$r->fetch(\PDO::FETCH_ASSOC);

				error_log("Report: " . $this->db->lastQuery());

				return array_merge($results,$details);
		}
		else {
			return false;
		}
		
	}
	
	public function getTemplate($reportID) {
		$reportIDStr = $this->db->quote($reportID);
		
		$r=$this->db->query("select BH_REPORT_TEMPLATES.* from BH_REPORTS left join BH_REPORT_TEMPLATES on (BH_REPORT_TEMPLATES.id = BH_REPORTS.id) where BH_REPORTS.id = $reportIDStr and BH_REPORTS.agencyID = \"$this->agencyID\"");
		 
		$results=$r->fetch(\PDO::FETCH_ASSOC);

		error_log("Report Template Exists: " . $this->db->lastQuery());

		if ($results["id"]) {
				$this->reportID = $results["id"];
				return $results["template"];
		}
		else {
			return false;
		}
		
	}


	public function getTitle($reportID) {
		$reportIDStr = $this->db->quote($reportID);
		
		$r=$this->db->query("select BH_REPORTS.title as title from BH_REPORTS left join BH_REPORT_TEMPLATES on (BH_REPORT_TEMPLATES.id = BH_REPORTS.id) where BH_REPORTS.id = $reportIDStr and BH_REPORTS.agencyID = \"$this->agencyID\"");
		 
		$results=$r->fetch(\PDO::FETCH_ASSOC);

		error_log("Report Template Exists: " . $this->db->lastQuery());

		if ($results["title"]) {
				return $results["title"];
		}
		else {
			return "";
		}
		
	}

	public function getCategory($reportID) {
		$reportIDStr = $this->db->quote($reportID);
		
		$r=$this->db->query("select BH_REPORTS.category as category from BH_REPORTS left join BH_REPORT_TEMPLATES on (BH_REPORT_TEMPLATES.id = BH_REPORTS.id) where BH_REPORTS.id = $reportIDStr and BH_REPORTS.agencyID = \"$this->agencyID\"");
		 
		$results=$r->fetch(\PDO::FETCH_ASSOC);

		error_log("Report Template Exists: " . $this->db->lastQuery());

		if ($results["category"]) {
				return $results["category"];
		}
		else {
			return false;
		}
		
	}	

	public function getTemplateID($reportID) {
		$reportIDStr = $this->db->quote($reportID);
		
		$r=$this->db->query("select BH_REPORTS.templateID as templateID from BH_REPORTS left join BH_REPORT_TEMPLATES on (BH_REPORT_TEMPLATES.id = BH_REPORTS.id) where BH_REPORTS.id = $reportIDStr and BH_REPORTS.agencyID = \"$this->agencyID\"");
		 
		$results=$r->fetch(\PDO::FETCH_ASSOC);

		error_log("Report Template Exists: " . $this->db->lastQuery());

		if ($results["templateID"]) {
				return $results["templateID"];
		}
		else {
			return "";
		}
		
	}
	
	public function tv($reportID) {

			$this->view = "pdf";
			
			$bhUser = new \BH\user($this->db, $this->userID); 
			  
			$this->agencyID = $bhUser->getAgencyID();				

		    $reports = new \BH\report($this->db, $this->agencyID, $this->userID);

			$template = $reports->getTemplate($reportID);
			$report = $reports->getReport($reportID);

		    $worksheet = new \BH\tv($this->db, $this->agencyID, $this->userID);
		    $market = new \BH\market($this->db, $this->agencyID, $this->userID);
		    
		    if ($report["markets"] != "") {
//			    $marketStr = "and BH_WORKSHEET_MARKETS.marketID in (" . $report["markets"] . ")";
// Changed by WB to accomodate vendors with more than 1 rep in the same market.  Converting from ID's to names
				$marketNames = "'" . implode("','", $market->getMarketNames(explode(",",$report["markets"]))) . "'";

//				error_log("Market_Names: " . $marketNames);

			    $marketStr = "and BH_MARKETS.name in (" . $marketNames . ")";
				
			}
			else {
				$marketStr = "";
			}
	
			if ($report["vendors"] != "") {
			    $vendorStr = "and BH_VENDORS.id in (" . $report["vendors"] . ")";
			}
			else {
				$vendorStr = "";
			}

			if ($report["worksheets"] != "") {
			    $worksheetStr = "and BH_WORKSHEETS.id in (" . $report["worksheets"] . ")";
			}
			else {
				$worksheetStr = "";
			}
			
			$r = $this->db->query("select distinct(BH_WORKSHEETS.id), BH_WORKSHEETS.*, BH_CAMPAIGNS.id as campaignID from BH_WORKSHEETS left join BH_WORKSHEET_MARKETS on (BH_WORKSHEET_MARKETS.worksheetID=BH_WORKSHEETS.id) left join BH_MARKETS on (BH_MARKETS.id=BH_WORKSHEET_MARKETS.marketID) left join BH_VENDORS on (BH_VENDORS.id=BH_MARKETS.vendorID) left join BH_CAMPAIGNS on (BH_WORKSHEETS.campaignID=BH_CAMPAIGNS.id) left join BH_CLIENTS on (BH_CLIENTS.id=BH_CAMPAIGNS.clientID) where BH_CAMPAIGNS.clientID in (" . $report["clients"] . ")  and BH_CAMPAIGNS.id in (" . $report["campaigns"] . ") $marketStr $vendorStr $worksheetStr and BH_WORKSHEETS.typeID in (1,7) and BH_WORKSHEETS.isDeleted is FALSE");
			
			error_log("BH_REPORTS: " . $this->db->lastQuery());
			
			$wksheets=$r->fetchAll();
			
			$data = array();
			
			$worksheetCounter=0;
	
			foreach($wksheets as $wksheet) {
				
				$worksheetID = $wksheet["id"];
		
				$sheet = $worksheet->getWorksheet($worksheetID);
				$lines = $worksheet->getWorksheetLines($worksheetID);
				$worksheetWeeks = $worksheet->getWorksheetWeeks($worksheetID);
		
				// Convert to 2-D array
				if (! empty($lines)) {

					$wsWeeks=array();
			
					foreach ($worksheetWeeks as $line) {
						$wsWeeks[$line["worksheetLine"]][$line["weekNumber"]]=$line["weekValue"];
					}
				
				    $campaign = new \BH\campaign($this->db, $this->agencyID, $this->userID);	
				    $client = new \BH\client($this->db, $this->agencyID, $this->userID);	
				    $market = new \BH\market($this->db, $this->agencyID, $this->userID);	
				    $vendor = new \BH\vendor($this->db, $this->agencyID, $this->userID);	
				
					$campaigns = $campaign->getCampaign($sheet["campaignID"]);
					$clients = $client->getClient($campaigns["clientID"]);
					$marketTypes = $market->getMarketTypes();
					$markets = $market->getMarket($sheet["marketID"]);
					$vendors = $vendor->getAllVendors(true);
				
					$calendar  = new \CAL\calendar($this->db);
					
					$repeats = array();		
				
					$repeats["iWeekly"]=1;
					$repeats["iWeekDays"]=2;
					$repeats["dStartDate"]=$campaigns["flightStart"];
					$repeats["dEndDate"]=$campaigns["flightEnd"];
			
					$weeks = array();
					$month = array();
					$months = array();
					$broadcastWeeks = array();
					$broadcastMonth = array();
					$broadcastMonths = array();
					
					array_push($weeks, $campaigns["flightStart"]);
			
					$weeks = array_merge($weeks,$calendar->createRepeatingDates($repeats,$campaigns["flightEnd"]));
					
			//		error_log(print_r($weeks));
			
					$weekNames = array();
					$broadcastWeekNames = array();
					$monthWeeks = array();
					$broadcastMonthWeeks = array();
			
					$lastMonthWeek = "";
			
					foreach ($weeks as $week) {
						array_push($weekNames, date("M d", strtotime($week)));
						$month["name"]=	date("M", strtotime($week));
						if (!$month["weeks"]) {
							$month["weeks"] = array();
						}
						else { // if month changes, reset weeks array so they don't appear in other months
							if ($lastMonthWeek != date("M", strtotime($week))) {
								$month["weeks"] = array();
							}
						}
						$lastMonthWeek = date("M", strtotime($week));
						array_push($month["weeks"], date("M d", strtotime($week)));
						$months[date("m", strtotime($week))] = array("name"=>date("M", strtotime($week)), "weeks"=>$month["weeks"]);
					}
	
					
					foreach ($weeks as $week) {
			
							
							array_push($broadcastWeekNames, date("M d", strtotime($week)));
							$broadcastMonth["name"]=	date("M", strtotime($week));
			
							if (!$broadcastMonth["weeks"]) {
								$broadcastMonth["weeks"] = array();
								$lastSundayOfMonth = strtotime("last sunday of this month", strtotime($week));
								$currentMonth = date("m",$lastSundayOfMonth);
								error_log("Broadcast Weeks Init - Last Sunday of this month:" . date("Y-m-d",$lastSundayOfMonth));
							}
			
							error_log("Broadcast Weeks - Last Sunday of this month:" . date("Y-m-d",$lastSundayOfMonth));
								error_log("Broadcast Weeks $week " . strtotime($week) . " " . $lastSundayOfMonth);
									
								if (strtotime($week) > $lastSundayOfMonth) {
									$broadcastMonth["weeks"] = array();
									error_log("Broadcast Weeks - New Month:" . date("Y-m-d",strtotime($week)) . " > " . date("Y-m-d",$lastSundayOfMonth));
									if (date("m",strtotime($week)) == date("m",$lastSundayOfMonth)) {
										$currentMonth = date("m",strtotime("+1 month", $lastSundayOfMonth));						
										$lastSundayOfMonth = strtotime("last sunday of next month", strtotime($week));
									}
									else {
										$lastSundayOfMonth = strtotime("last sunday of this month", strtotime($week));
									}
								}
								else {
									error_log("Broadcast Weeks - Same Month:" . date("Y-m-d",strtotime($week)) . " <= " . date("Y-m-d",$lastSundayOfMonth));						
								}
							$currentMonth = date("m",$lastSundayOfMonth);
					
							$lastMonthWeek = date("M", strtotime($week));
							array_push($broadcastMonth["weeks"], date("Y-m-d", strtotime($week)));
							error_log("Broadcast Weeks - Month: $currentMonth " . date("m", $lastSundayOfMonth) . " = " . date("M d", strtotime($week)));
							$broadcastMonths[$currentMonth] = array("name"=>date("M", $lastSundayOfMonth), "weeks"=>$broadcastMonth["weeks"]);	
					}		
				
	
			
			//		error_log("Months:" . print_r($months) );
				
					$category = $report["category"];
				
					error_log("BH_REPORT " . $category);
					
					$data[$worksheetCounter]["sheet"] = $sheet; 
					$data[$worksheetCounter]["lines"] = $lines; 
					$data[$worksheetCounter]["wsWeeks"] = $wsWeeks; 
					$data[$worksheetCounter]["weeks"] = $weeks; 
					$data[$worksheetCounter]["weekNames"] = $weeks; 
					$data[$worksheetCounter]["monthWeeks"] = $months; 
					$data[$worksheetCounter]["campaigns"] = $campaigns; 
					$data[$worksheetCounter]["clients"] = $clients; 
					$data[$worksheetCounter]["markets"] = $market->getMarketNames(explode(",",$report["markets"])); 
					$data[$worksheetCounter]["broadcastWeeks"] = $broadcastWeeks; 
					$data[$worksheetCounter]["broadcastMonth"] = $broadcastMonth; 
					$data[$worksheetCounter]["broadcastMonths"] = $broadcastMonths; 
					
					$worksheetCounter++;
				}
			}
			
			return $data;		
	}

	public function tvcable($reportID) {
			
			$tv = $this->tv($reportID);		
			$cable = $this->cable($reportID);
			
			return array_merge($tv,$cable);						
			
	}
	
	public function radio($reportID) {

		
			$this->view = "pdf";
			
			$bhUser = new \BH\user($this->db, $this->userID); 
			  
			$this->agencyID = $bhUser->getAgencyID();				

		    $reports = new \BH\report($this->db, $this->agencyID, $this->userID);

			$template = $reports->getTemplate($reportID);
			$report = $reports->getReport($reportID);

		    $worksheet = new \BH\radio($this->db, $this->agencyID, $this->userID);
		    $market = new \BH\market($this->db, $this->agencyID, $this->userID);
		    
		    if ($report["markets"] != "") {
//			    $marketStr = "and BH_WORKSHEET_MARKETS.marketID in (" . $report["markets"] . ")";
// Changed by WB to accomodate vendors with more than 1 rep in the same market.  Converting from ID's to names
				$marketNames = "'" . implode("','", $market->getMarketNames(explode(",",$report["markets"]))) . "'";

//				error_log("Market_Names: " . $marketNames);

			    $marketStr = "and BH_MARKETS.name in (" . $marketNames . ")";
				
			}
			else {
				$marketStr = "";
			}
	
			if ($report["vendors"] != "") {
			    $vendorStr = "and BH_VENDORS.id in (" . $report["vendors"] . ")";
			}
			else {
				$vendorStr = "";
			}
			
			if ($report["worksheets"] != "") {
			    $worksheetStr = "and BH_WORKSHEETS.id in (" . $report["worksheets"] . ")";
			}
			else {
				$worksheetStr = "";
			}
			
			$r = $this->db->query("select distinct(BH_WORKSHEETS.id), BH_WORKSHEETS.*, BH_CAMPAIGNS.id as campaignID from BH_WORKSHEETS left join BH_WORKSHEET_MARKETS on (BH_WORKSHEET_MARKETS.worksheetID=BH_WORKSHEETS.id) left join BH_MARKETS on (BH_MARKETS.id=BH_WORKSHEET_MARKETS.marketID) left join BH_VENDORS on (BH_VENDORS.id=BH_MARKETS.vendorID) left join BH_CAMPAIGNS on (BH_WORKSHEETS.campaignID=BH_CAMPAIGNS.id) left join BH_CLIENTS on (BH_CLIENTS.id=BH_CAMPAIGNS.clientID) where BH_CAMPAIGNS.clientID in (" . $report["clients"] . ")  and BH_CAMPAIGNS.id in (" . $report["campaigns"] . ") $marketStr $vendorStr $worksheetStr and BH_WORKSHEETS.typeID in (2,8) and BH_WORKSHEETS.isDeleted is FALSE");
			
			error_log("BH_REPORTS: " . $this->db->lastQuery());
			
			$wksheets=$r->fetchAll();
			
			$data = array();
			
			$worksheetCounter=0;
	
			foreach($wksheets as $wksheet) {
				
				$worksheetID = $wksheet["id"];
		
				$sheet = $worksheet->getWorksheet($worksheetID);
				$lines = $worksheet->getWorksheetLines($worksheetID);
				$worksheetWeeks = $worksheet->getWorksheetWeeks($worksheetID);
		
				// Convert to 2-D array
				if (! empty($lines)) {

			
					$wsWeeks=array();
			
					foreach ($worksheetWeeks as $line) {
						$wsWeeks[$line["worksheetLine"]][$line["weekNumber"]]=$line["weekValue"];
					}
				
				    $campaign = new \BH\campaign($this->db, $this->agencyID, $this->userID);	
				    $client = new \BH\client($this->db, $this->agencyID, $this->userID);	
				    $market = new \BH\market($this->db, $this->agencyID, $this->userID);	
				    $vendor = new \BH\vendor($this->db, $this->agencyID, $this->userID);	
				
					$campaigns = $campaign->getCampaign($sheet["campaignID"]);
					$clients = $client->getClient($campaigns["clientID"]);
					$marketTypes = $market->getMarketTypes();
					$markets = $market->getMarket($sheet["marketID"]);
					$vendors = $vendor->getAllVendors(true);
				
					$calendar  = new \CAL\calendar($this->db);
					
					$repeats = array();		
				
					$repeats["iWeekly"]=1;
					$repeats["iWeekDays"]=2;
					$repeats["dStartDate"]=$campaigns["flightStart"];
					$repeats["dEndDate"]=$campaigns["flightEnd"];
			
					$weeks = array();
					$month = array();
					$months = array();
					$broadcastWeeks = array();
					$broadcastMonth = array();
					$broadcastMonths = array();
					
					array_push($weeks, $campaigns["flightStart"]);
			
					$weeks = array_merge($weeks,$calendar->createRepeatingDates($repeats,$campaigns["flightEnd"]));
					
			//		error_log(print_r($weeks));
			
					$weekNames = array();
					$broadcastWeekNames = array();
					$monthWeeks = array();
					$broadcastMonthWeeks = array();
			
					$lastMonthWeek = "";
			
					foreach ($weeks as $week) {
						array_push($weekNames, date("M d", strtotime($week)));
						$month["name"]=	date("M", strtotime($week));
						if (!$month["weeks"]) {
							$month["weeks"] = array();
						}
						else { // if month changes, reset weeks array so they don't appear in other months
							if ($lastMonthWeek != date("M", strtotime($week))) {
								$month["weeks"] = array();
							}
						}
						$lastMonthWeek = date("M", strtotime($week));
						array_push($month["weeks"], date("M d", strtotime($week)));
						$months[date("m", strtotime($week))] = array("name"=>date("M", strtotime($week)), "weeks"=>$month["weeks"]);
					}
	
					
					foreach ($weeks as $week) {
			
							
							array_push($broadcastWeekNames, date("M d", strtotime($week)));
							$broadcastMonth["name"]=	date("M", strtotime($week));
			
							if (!$broadcastMonth["weeks"]) {
								$broadcastMonth["weeks"] = array();
								$lastSundayOfMonth = strtotime("last sunday of this month", strtotime($week));
								$currentMonth = date("m",$lastSundayOfMonth);
								error_log("Broadcast Weeks Init - Last Sunday of this month:" . date("Y-m-d",$lastSundayOfMonth));
							}
			
							error_log("Broadcast Weeks - Last Sunday of this month:" . date("Y-m-d",$lastSundayOfMonth));
								error_log("Broadcast Weeks $week " . strtotime($week) . " " . $lastSundayOfMonth);
									
								if (strtotime($week) > $lastSundayOfMonth) {
									$broadcastMonth["weeks"] = array();
									error_log("Broadcast Weeks - New Month:" . date("Y-m-d",strtotime($week)) . " > " . date("Y-m-d",$lastSundayOfMonth));
									if (date("m",strtotime($week)) == date("m",$lastSundayOfMonth)) {
										$currentMonth = date("m",strtotime("+1 month", $lastSundayOfMonth));						
										$lastSundayOfMonth = strtotime("last sunday of next month", strtotime($week));
									}
									else {
										$lastSundayOfMonth = strtotime("last sunday of this month", strtotime($week));
									}
								}
								else {
									error_log("Broadcast Weeks - Same Month:" . date("Y-m-d",strtotime($week)) . " <= " . date("Y-m-d",$lastSundayOfMonth));						
								}
							$currentMonth = date("m",$lastSundayOfMonth);
					
							$lastMonthWeek = date("M", strtotime($week));
							array_push($broadcastMonth["weeks"], date("Y-m-d", strtotime($week)));
							error_log("Broadcast Weeks - Month: $currentMonth " . date("m", $lastSundayOfMonth) . " = " . date("M d", strtotime($week)));
							$broadcastMonths[$currentMonth] = array("name"=>date("M", $lastSundayOfMonth), "weeks"=>$broadcastMonth["weeks"]);	
					}		
				
	
			
			//		error_log("Months:" . print_r($months) );
				
					$category = $report["category"];
				
					error_log("BH_REPORT " . $category);
					
					$data[$worksheetCounter]["sheet"] = $sheet; 
					$data[$worksheetCounter]["lines"] = $lines; 
					$data[$worksheetCounter]["wsWeeks"] = $wsWeeks; 
					$data[$worksheetCounter]["weeks"] = $weeks; 
					$data[$worksheetCounter]["weekNames"] = $weeks; 
					$data[$worksheetCounter]["monthWeeks"] = $months; 
					$data[$worksheetCounter]["campaigns"] = $campaigns; 
					$data[$worksheetCounter]["clients"] = $clients; 
					$data[$worksheetCounter]["markets"] = $market->getMarketNames(explode(",",$report["markets"])); 
					$data[$worksheetCounter]["broadcastWeeks"] = $broadcastWeeks; 
					$data[$worksheetCounter]["broadcastMonth"] = $broadcastMonth; 
					$data[$worksheetCounter]["broadcastMonths"] = $broadcastMonths; 
					
					$worksheetCounter++;
				}
			}
			
			return $data;
		
	}
	
	public function cable($reportID) {

			$this->view = "pdf";
			
			$bhUser = new \BH\user($this->db, $this->userID); 
			  
			$this->agencyID = $bhUser->getAgencyID();				

		    $reports = new \BH\report($this->db, $this->agencyID, $this->userID);

			$template = $reports->getTemplate($reportID);
			$report = $reports->getReport($reportID);

		    $worksheet = new \BH\cable($this->db, $this->agencyID, $this->userID);
		    $market = new \BH\market($this->db, $this->agencyID, $this->userID);
		    
		    if ($report["markets"] != "") {
//			    $marketStr = "and BH_WORKSHEET_MARKETS.marketID in (" . $report["markets"] . ")";
// Changed by WB to accomodate vendors with more than 1 rep in the same market.  Converting from ID's to names
				$marketNames = "'" . implode("','", $market->getMarketNames(explode(",",$report["markets"]))) . "'";

//				error_log("Market_Names: " . $marketNames);

			    $marketStr = "and BH_MARKETS.name in (" . $marketNames . ")";
				
			}
			else {
				$marketStr = "";
			}
	
			if ($report["vendors"] != "") {
			    $vendorStr = "and BH_VENDORS.id in (" . $report["vendors"] . ")";
			}
			else {
				$vendorStr = "";
			}

			if ($report["worksheets"] != "") {
			    $worksheetStr = "and BH_WORKSHEETS.id in (" . $report["worksheets"] . ")";
			}
			else {
				$worksheetStr = "";
			}
			
			$r = $this->db->query("select distinct(BH_WORKSHEETS.id), BH_WORKSHEETS.*, BH_CAMPAIGNS.id as campaignID from BH_WORKSHEETS left join BH_WORKSHEET_MARKETS on (BH_WORKSHEET_MARKETS.worksheetID=BH_WORKSHEETS.id) left join BH_MARKETS on (BH_MARKETS.id=BH_WORKSHEET_MARKETS.marketID) left join BH_VENDORS on (BH_VENDORS.id=BH_MARKETS.vendorID) left join BH_CAMPAIGNS on (BH_WORKSHEETS.campaignID=BH_CAMPAIGNS.id) left join BH_CLIENTS on (BH_CLIENTS.id=BH_CAMPAIGNS.clientID) where BH_CAMPAIGNS.clientID in (" . $report["clients"] . ")  and BH_CAMPAIGNS.id in (" . $report["campaigns"] . ") $marketStr $vendorStr $worksheetStr and BH_WORKSHEETS.typeID in (3,9) and BH_WORKSHEETS.isDeleted is FALSE");
			
			error_log("BH_REPORTS: " . $this->db->lastQuery());
			
			$wksheets=$r->fetchAll();
			
			$data = array();
			
			$worksheetCounter=0;
	
			foreach($wksheets as $wksheet) {
				
				$worksheetID = $wksheet["id"];
		
				$sheet = $worksheet->getWorksheet($worksheetID);
				$lines = $worksheet->getWorksheetLines($worksheetID);
				$worksheetWeeks = $worksheet->getWorksheetWeeks($worksheetID);
		
				// Convert to 2-D array
				
				if (! empty($lines)) {

			
					$wsWeeks=array();
			
					foreach ($worksheetWeeks as $line) {
						$wsWeeks[$line["worksheetLine"]][$line["weekNumber"]]=$line["weekValue"];
					}
				
				    $campaign = new \BH\campaign($this->db, $this->agencyID, $this->userID);	
				    $client = new \BH\client($this->db, $this->agencyID, $this->userID);	
				    $market = new \BH\market($this->db, $this->agencyID, $this->userID);	
				    $vendor = new \BH\vendor($this->db, $this->agencyID, $this->userID);	
				
					$campaigns = $campaign->getCampaign($sheet["campaignID"]);
					$clients = $client->getClient($campaigns["clientID"]);
					$marketTypes = $market->getMarketTypes();
					$markets = $market->getMarket($sheet["marketID"]);
					$vendors = $vendor->getAllVendors(true);
				
					$calendar  = new \CAL\calendar($this->db);
					
					$repeats = array();		
				
					$repeats["iWeekly"]=1;
					$repeats["iWeekDays"]=2;
					$repeats["dStartDate"]=$campaigns["flightStart"];
					$repeats["dEndDate"]=$campaigns["flightEnd"];
			
					$weeks = array();
					$month = array();
					$months = array();
					$broadcastWeeks = array();
					$broadcastMonth = array();
					$broadcastMonths = array();
					
					array_push($weeks, $campaigns["flightStart"]);
			
					$weeks = array_merge($weeks,$calendar->createRepeatingDates($repeats,$campaigns["flightEnd"]));
					
			//		error_log(print_r($weeks));
			
					$weekNames = array();
					$broadcastWeekNames = array();
					$monthWeeks = array();
					$broadcastMonthWeeks = array();
			
					$lastMonthWeek = "";
			
					foreach ($weeks as $week) {
						array_push($weekNames, date("M d", strtotime($week)));
						$month["name"]=	date("M", strtotime($week));
						if (!$month["weeks"]) {
							$month["weeks"] = array();
						}
						else { // if month changes, reset weeks array so they don't appear in other months
							if ($lastMonthWeek != date("M", strtotime($week))) {
								$month["weeks"] = array();
							}
						}
						$lastMonthWeek = date("M", strtotime($week));
						array_push($month["weeks"], date("M d", strtotime($week)));
						$months[date("m", strtotime($week))] = array("name"=>date("M", strtotime($week)), "weeks"=>$month["weeks"]);
					}
	
					
					foreach ($weeks as $week) {
			
							
							array_push($broadcastWeekNames, date("M d", strtotime($week)));
							$broadcastMonth["name"]=	date("M", strtotime($week));
			
							if (!$broadcastMonth["weeks"]) {
								$broadcastMonth["weeks"] = array();
								$lastSundayOfMonth = strtotime("last sunday of this month", strtotime($week));
								$currentMonth = date("m",$lastSundayOfMonth);
								error_log("Broadcast Weeks Init - Last Sunday of this month:" . date("Y-m-d",$lastSundayOfMonth));
							}
			
							error_log("Broadcast Weeks - Last Sunday of this month:" . date("Y-m-d",$lastSundayOfMonth));
								error_log("Broadcast Weeks $week " . strtotime($week) . " " . $lastSundayOfMonth);
									
								if (strtotime($week) > $lastSundayOfMonth) {
									$broadcastMonth["weeks"] = array();
									error_log("Broadcast Weeks - New Month:" . date("Y-m-d",strtotime($week)) . " > " . date("Y-m-d",$lastSundayOfMonth));
									if (date("m",strtotime($week)) == date("m",$lastSundayOfMonth)) {
										$currentMonth = date("m",strtotime("+1 month", $lastSundayOfMonth));						
										$lastSundayOfMonth = strtotime("last sunday of next month", strtotime($week));
									}
									else {
										$lastSundayOfMonth = strtotime("last sunday of this month", strtotime($week));
									}
								}
								else {
									error_log("Broadcast Weeks - Same Month:" . date("Y-m-d",strtotime($week)) . " <= " . date("Y-m-d",$lastSundayOfMonth));						
								}
							$currentMonth = date("m",$lastSundayOfMonth);
					
							$lastMonthWeek = date("M", strtotime($week));
							array_push($broadcastMonth["weeks"], date("Y-m-d", strtotime($week)));
							error_log("Broadcast Weeks - Month: $currentMonth " . date("m", $lastSundayOfMonth) . " = " . date("M d", strtotime($week)));
							$broadcastMonths[$currentMonth] = array("name"=>date("M", $lastSundayOfMonth), "weeks"=>$broadcastMonth["weeks"]);	
					}		
				
	
			
			//		error_log("Months:" . print_r($months) );
				
					$category = $report["category"];
				
					error_log("BH_REPORT " . $category);
					
					$data[$worksheetCounter]["sheet"] = $sheet; 
					$data[$worksheetCounter]["lines"] = $lines; 
					$data[$worksheetCounter]["wsWeeks"] = $wsWeeks; 
					$data[$worksheetCounter]["weeks"] = $weeks; 
					$data[$worksheetCounter]["weekNames"] = $weeks; 
					$data[$worksheetCounter]["monthWeeks"] = $months; 
					$data[$worksheetCounter]["campaigns"] = $campaigns; 
					$data[$worksheetCounter]["clients"] = $clients; 
					$data[$worksheetCounter]["markets"] = $market->getMarketNames(explode(",",$report["markets"])); 
					$data[$worksheetCounter]["broadcastWeeks"] = $broadcastWeeks; 
					$data[$worksheetCounter]["broadcastMonth"] = $broadcastMonth; 
					$data[$worksheetCounter]["broadcastMonths"] = $broadcastMonths; 
					
					$worksheetCounter++;
				}
			}
			
			return $data;
			
	}
	
	public function prnt($reportID) {

			$this->view = "pdf";
			
			$bhUser = new \BH\user($this->db, $this->userID); 
			  
			$this->agencyID = $bhUser->getAgencyID();				

		    $reports = new \BH\report($this->db, $this->agencyID, $this->userID);

			$template = $reports->getTemplate($reportID);
			$report = $reports->getReport($reportID);

		    $worksheet = new \BH\prnt($this->db, $this->agencyID, $this->userID);
		    $market = new \BH\market($this->db, $this->agencyID, $this->userID);
		    
		    if ($report["markets"] != "") {
//			    $marketStr = "and BH_WORKSHEET_MARKETS.marketID in (" . $report["markets"] . ")";
// Changed by WB to accomodate vendors with more than 1 rep in the same market.  Converting from ID's to names
				$marketNames = "'" . implode("','", $market->getMarketNames(explode(",",$report["markets"]))) . "'";

//				error_log("Market_Names: " . $marketNames);

			    $marketStr = "and BH_MARKETS.name in (" . $marketNames . ")";
				
			}
			else {
				$marketStr = "";
			}
	
			if ($report["vendors"] != "") {
			    $vendorStr = "and BH_VENDORS.id in (" . $report["vendors"] . ")";
			}
			else {
				$vendorStr = "";
			}

			if ($report["worksheets"] != "") {
			    $worksheetStr = "and BH_WORKSHEETS.id in (" . $report["worksheets"] . ")";
			}
			else {
				$worksheetStr = "";
			}
						
			$r = $this->db->query("select distinct(BH_WORKSHEETS.id), BH_WORKSHEETS.*, BH_CAMPAIGNS.id as campaignID from BH_WORKSHEETS left join BH_WORKSHEET_MARKETS on (BH_WORKSHEET_MARKETS.worksheetID=BH_WORKSHEETS.id) left join BH_MARKETS on (BH_MARKETS.id=BH_WORKSHEET_MARKETS.marketID) left join BH_VENDORS on (BH_VENDORS.id=BH_MARKETS.vendorID) left join BH_CAMPAIGNS on (BH_WORKSHEETS.campaignID=BH_CAMPAIGNS.id) left join BH_CLIENTS on (BH_CLIENTS.id=BH_CAMPAIGNS.clientID) where BH_CAMPAIGNS.clientID in (" . $report["clients"] . ")  and BH_CAMPAIGNS.id in (" . $report["campaigns"] . ") $marketStr $vendorStr $worksheetStr and BH_WORKSHEETS.isDeleted is FALSE");
			
			error_log("BH_REPORTS: " . $this->db->lastQuery());
			
			$wksheets=$r->fetchAll();
			
			$data = array();
			
			$worksheetCounter=0;
	
			foreach($wksheets as $wksheet) {
					
				if ($wksheet["typeID"] == 4) {	
				
					$worksheetID = $wksheet["id"];
					
					$sheet = $worksheet->getWorksheet($worksheetID);
					$lines = $worksheet->getWorksheetLines($worksheetID);

					//error_log("BH_PRNT_SUMMARY_LINES: $worksheetID " . count($lines) . " = " . print_r($lines, true));

					if (! empty($lines)) {
					
					    $campaign = new \BH\campaign($this->db, $this->agencyID, $this->userID);	
					    $client = new \BH\client($this->db, $this->agencyID, $this->userID);	
					    $market = new \BH\market($this->db, $this->agencyID, $this->userID);	
					    $vendor = new \BH\vendor($this->db, $this->agencyID, $this->userID);	
					
						$campaigns = $campaign->getCampaign($sheet["campaignID"]);
						$clients = $client->getClient($campaigns["clientID"]);
						$marketTypes = $market->getMarketTypes();
						$markets = $market->getMarket($sheet["marketID"]);
						$vendors = $vendor->getAllVendors(true);
						
						$repeats["dStartDate"]=$campaigns["flightStart"];
						$repeats["dEndDate"]=$campaigns["flightEnd"];
					
						$category = $report["category"];
					
						error_log("BH_REPORT " . $category);
						
						$data[$worksheetCounter]["sheet"] = $sheet; 
						$data[$worksheetCounter]["lines"] = $lines; 
						$data[$worksheetCounter]["campaigns"] = $campaigns; 
						$data[$worksheetCounter]["clients"] = $clients; 
						$data[$worksheetCounter]["markets"] = $market->getMarketNames(explode(",",$report["markets"])); 
						
						$worksheetCounter++;
					}
				}
				
			}
			
			return $data;
		
	}	
	
	public function outdoor($reportID) {

			$this->view = "pdf";
			
			$bhUser = new \BH\user($this->db, $this->userID); 
			  
			$this->agencyID = $bhUser->getAgencyID();				

		    $reports = new \BH\report($this->db, $this->agencyID, $this->userID);

			$template = $reports->getTemplate($reportID);
			$report = $reports->getReport($reportID);

		    $worksheet = new \BH\outdoor($this->db, $this->agencyID, $this->userID);
		    $market = new \BH\market($this->db, $this->agencyID, $this->userID);
		    
		    if ($report["markets"] != "") {
//			    $marketStr = "and BH_WORKSHEET_MARKETS.marketID in (" . $report["markets"] . ")";
// Changed by WB to accomodate vendors with more than 1 rep in the same market.  Converting from ID's to names
				$marketNames = "'" . implode("','", $market->getMarketNames(explode(",",$report["markets"]))) . "'";

//				error_log("Market_Names: " . $marketNames);

			    $marketStr = "and BH_MARKETS.name in (" . $marketNames . ")";
				
			}
			else {
				$marketStr = "";
			}
	
			if ($report["vendors"] != "") {
			    $vendorStr = "and BH_VENDORS.id in (" . $report["vendors"] . ")";
			}
			else {
				$vendorStr = "";
			}
			
			if ($report["worksheets"] != "") {
			    $worksheetStr = "and BH_WORKSHEETS.id in (" . $report["worksheets"] . ")";
			}
			else {
				$worksheetStr = "";
			}			
			
			$r = $this->db->query("select distinct(BH_WORKSHEETS.id), BH_WORKSHEETS.*, BH_CAMPAIGNS.id as campaignID from BH_WORKSHEETS left join BH_WORKSHEET_MARKETS on (BH_WORKSHEET_MARKETS.worksheetID=BH_WORKSHEETS.id) left join BH_MARKETS on (BH_MARKETS.id=BH_WORKSHEET_MARKETS.marketID) left join BH_VENDORS on (BH_VENDORS.id=BH_MARKETS.vendorID) left join BH_CAMPAIGNS on (BH_WORKSHEETS.campaignID=BH_CAMPAIGNS.id) left join BH_CLIENTS on (BH_CLIENTS.id=BH_CAMPAIGNS.clientID) where BH_CAMPAIGNS.clientID in (" . $report["clients"] . ")  and BH_CAMPAIGNS.id in (" . $report["campaigns"] . ") $marketStr $vendorStr $worksheetStr and BH_WORKSHEETS.typeID in (5) and BH_WORKSHEETS.isDeleted is FALSE");
			
			error_log("BH_REPORTS: " . $this->db->lastQuery());
			
			$wksheets=$r->fetchAll();
			
			$data = array();
			
			$worksheetCounter=0;
	
			foreach($wksheets as $wksheet) {
					
				if ($wksheet["typeID"] == 5) {	
				
					$worksheetID = $wksheet["id"];
					
					$sheet = $worksheet->getWorksheet($worksheetID);
					$lines = $worksheet->getWorksheetLines($worksheetID);

					if (! empty($lines)) {
					
					    $campaign = new \BH\campaign($this->db, $this->agencyID, $this->userID);	
					    $client = new \BH\client($this->db, $this->agencyID, $this->userID);	
					    $market = new \BH\market($this->db, $this->agencyID, $this->userID);	
					    $vendor = new \BH\vendor($this->db, $this->agencyID, $this->userID);	
					
						$campaigns = $campaign->getCampaign($sheet["campaignID"]);
						$clients = $client->getClient($campaigns["clientID"]);
						$marketTypes = $market->getMarketTypes();
						$markets = $market->getMarket($sheet["marketID"]);
						$vendors = $vendor->getAllVendors(true);
						
						$repeats["dStartDate"]=$campaigns["flightStart"];
						$repeats["dEndDate"]=$campaigns["flightEnd"];
					
						$category = $report["category"];
					
						error_log("BH_REPORT " . $category);
						
						$data[$worksheetCounter]["sheet"] = $sheet; 
						$data[$worksheetCounter]["lines"] = $lines; 
						$data[$worksheetCounter]["campaigns"] = $campaigns; 
						$data[$worksheetCounter]["clients"] = $clients; 
						$data[$worksheetCounter]["markets"] = $market->getMarketNames(explode(",",$report["markets"])); 
						
						$worksheetCounter++;
					}
				}
				
			}
			
			return $data;
	}
	
	public function digital($worksheetID) {
	
			$this->view = "pdf";
			
			$bhUser = new \BH\user($this->db, $this->userID); 
			  
			$this->agencyID = $bhUser->getAgencyID();				

		    $reports = new \BH\report($this->db, $this->agencyID, $this->userID);

			$template = $reports->getTemplate($reportID);
			$report = $reports->getReport($reportID);

		    $worksheet = new \BH\digital($this->db, $this->agencyID, $this->userID);
		    $market = new \BH\market($this->db, $this->agencyID, $this->userID);
		    
		    if ($report["markets"] != "") {
//			    $marketStr = "and BH_WORKSHEET_MARKETS.marketID in (" . $report["markets"] . ")";
// Changed by WB to accomodate vendors with more than 1 rep in the same market.  Converting from ID's to names
				$marketNames = "'" . implode("','", $market->getMarketNames(explode(",",$report["markets"]))) . "'";

//				error_log("Market_Names: " . $marketNames);

			    $marketStr = "and BH_MARKETS.name in (" . $marketNames . ")";
				
			}
			else {
				$marketStr = "";
			}
	
			if ($report["vendors"] != "") {
			    $vendorStr = "and BH_VENDORS.id in (" . $report["vendors"] . ")";
			}
			else {
				$vendorStr = "";
			}

			if ($report["worksheets"] != "") {
			    $worksheetStr = "and BH_WORKSHEETS.id in (" . $report["worksheets"] . ")";
			}
			else {
				$worksheetStr = "";
			}
						
			$r = $this->db->query("select distinct(BH_WORKSHEETS.id), BH_WORKSHEETS.*, BH_CAMPAIGNS.id as campaignID from BH_WORKSHEETS left join BH_WORKSHEET_MARKETS on (BH_WORKSHEET_MARKETS.worksheetID=BH_WORKSHEETS.id) left join BH_MARKETS on (BH_MARKETS.id=BH_WORKSHEET_MARKETS.marketID) left join BH_VENDORS on (BH_VENDORS.id=BH_MARKETS.vendorID) left join BH_CAMPAIGNS on (BH_WORKSHEETS.campaignID=BH_CAMPAIGNS.id) left join BH_CLIENTS on (BH_CLIENTS.id=BH_CAMPAIGNS.clientID) where BH_CAMPAIGNS.clientID in (" . $report["clients"] . ")  and BH_CAMPAIGNS.id in (" . $report["campaigns"] . ") $marketStr $vendorStr $worksheetStr and BH_WORKSHEETS.isDeleted is FALSE");
			
			error_log("BH_REPORTS: " . $this->db->lastQuery());
			
			$wksheets=$r->fetchAll();
			
			$data = array();
			
			$worksheetCounter=0;
	
			foreach($wksheets as $wksheet) {
					
				if ($wksheet["typeID"] == 4) {	
				
					$worksheetID = $wksheet["id"];
					
					$sheet = $worksheet->getWorksheet($worksheetID);
					$lines = $worksheet->getWorksheetLines($worksheetID);

					//error_log("BH_PRNT_SUMMARY_LINES: $worksheetID " . count($lines) . " = " . print_r($lines, true));

					if (! empty($lines)) {
					
					    $campaign = new \BH\campaign($this->db, $this->agencyID, $this->userID);	
					    $client = new \BH\client($this->db, $this->agencyID, $this->userID);	
					    $market = new \BH\market($this->db, $this->agencyID, $this->userID);	
					    $vendor = new \BH\vendor($this->db, $this->agencyID, $this->userID);	
					
						$campaigns = $campaign->getCampaign($sheet["campaignID"]);
						$clients = $client->getClient($campaigns["clientID"]);
						$marketTypes = $market->getMarketTypes();
						$markets = $market->getMarket($sheet["marketID"]);
						$vendors = $vendor->getAllVendors(true);
						
						$repeats["dStartDate"]=$campaigns["flightStart"];
						$repeats["dEndDate"]=$campaigns["flightEnd"];
					
						$category = $report["category"];
					
						error_log("BH_REPORT " . $category);
						
						$data[$worksheetCounter]["sheet"] = $sheet; 
						$data[$worksheetCounter]["lines"] = $lines; 
						$data[$worksheetCounter]["campaigns"] = $campaigns; 
						$data[$worksheetCounter]["clients"] = $clients; 
						$data[$worksheetCounter]["markets"] = $market->getMarketNames(explode(",",$report["markets"])); 
						
						$worksheetCounter++;
					}
				}
				
			}
			
			return $data;
		
	}

	public function summary($reportID) {
		
			$this->view = "pdf";
			
			$bhUser = new \BH\user($this->db, $this->userID); 
			  
			$this->agencyID = $bhUser->getAgencyID();				

		    $reports = new \BH\report($this->db, $this->agencyID, $this->userID);

			$template = $reports->getTemplate($reportID);
			$report = $reports->getReport($reportID);

		    $worksheet = new \BH\worksheet($this->db, $this->agencyID, $this->userID);
		    
		    if ($report["markets"] != "") {
			    $marketStr = "and BH_WORKSHEET_MARKETS.marketID in (" . $report["markets"] . ")";
			}
			else {
				$marketStr = "";
			}
	
			if ($report["vendors"] != "") {
			    $vendorStr = "and BH_VENDORS.id in (" . $report["vendors"] . ")";
			}
			else {
				$vendorStr = "";
			}
			
			$r = $this->db->query("select BH_WORKSHEETS.*, BH_CAMPAIGNS.id as campaignID from BH_WORKSHEETS left join BH_WORKSHEET_MARKETS on (BH_WORKSHEET_MARKETS.worksheetID=BH_WORKSHEETS.id) left join BH_MARKETS on (BH_MARKETS.id=BH_WORKSHEET_MARKETS.marketID) left join BH_VENDORS on (BH_VENDORS.id=BH_MARKETS.vendorID) left join BH_CAMPAIGNS on (BH_WORKSHEETS.campaignID=BH_CAMPAIGNS.id) left join BH_CLIENTS on (BH_CLIENTS.id=BH_CAMPAIGNS.clientID) where BH_CAMPAIGNS.clientID in (" . $report["clients"] . ")  and BH_CAMPAIGNS.id in (" . $report["campaigns"] . ") $marketStr $vendorStr and BH_WORKSHEETS.isDeleted is FALSE");
			
			error_log("BH_REPORTS: " . $this->db->lastQuery());
			
			$wksheets=$r->fetchAll();
			
			$data = array();
			
			$worksheetCounter=0;
	
			foreach($wksheets as $wksheet) {
				
				$worksheetID = $wksheet["id"];
		
				$sheet = $worksheet->getWorksheet($worksheetID);
				$lines = $worksheet->getWorksheetLines($worksheetID);
				$worksheetWeeks = $worksheet->getWorksheetWeeks($worksheetID);
		
				// Convert to 2-D array
		
				$wsWeeks=array();
		
				foreach ($worksheetWeeks as $line) {
					$wsWeeks[$line["worksheetLine"]][$line["weekNumber"]]=$line["weekValue"];
				}
			
			    $campaign = new \BH\campaign($this->db, $this->agencyID, $this->userID);	
			    $client = new \BH\client($this->db, $this->agencyID, $this->userID);	
			    $market = new \BH\market($this->db, $this->agencyID, $this->userID);	
			    $vendor = new \BH\vendor($this->db, $this->agencyID, $this->userID);	
			
				$campaigns = $campaign->getCampaign($sheet["campaignID"]);
				$clients = $client->getClient($campaigns["clientID"]);
				$marketTypes = $market->getMarketTypes();
				$markets = $market->getMarket($sheet["marketID"]);
				$vendors = $vendor->getAllVendors(true);
			
				$calendar  = new \CAL\calendar($this->db);
				
				$repeats = array();		
			
				$repeats["iWeekly"]=1;
				$repeats["iWeekDays"]=2;
				$repeats["dStartDate"]=$campaigns["flightStart"];
				$repeats["dEndDate"]=$campaigns["flightEnd"];
		
				$weeks = array();
				$month = array();
				$months = array();
				$broadcastWeeks = array();
				$broadcastMonth = array();
				$broadcastMonths = array();
				
				array_push($weeks, $campaigns["flightStart"]);
		
				$weeks = array_merge($weeks,$calendar->createRepeatingDates($repeats,$campaigns["flightEnd"]));
				
		//		error_log(print_r($weeks));
		
				$weekNames = array();
				$broadcastWeekNames = array();
				$monthWeeks = array();
				$broadcastMonthWeeks = array();
		
				$lastMonthWeek = "";
		
				foreach ($weeks as $week) {
					array_push($weekNames, date("M d", strtotime($week)));
					$month["name"]=	date("M", strtotime($week));
					if (!$month["weeks"]) {
						$month["weeks"] = array();
					}
					else { // if month changes, reset weeks array so they don't appear in other months
						if ($lastMonthWeek != date("M", strtotime($week))) {
							$month["weeks"] = array();
						}
					}
					$lastMonthWeek = date("M", strtotime($week));
					array_push($month["weeks"], date("M d", strtotime($week)));
					$months[date("m", strtotime($week))] = array("name"=>date("M", strtotime($week)), "weeks"=>$month["weeks"]);
				}

				
				foreach ($weeks as $week) {
		
						
						array_push($broadcastWeekNames, date("M d", strtotime($week)));
						$broadcastMonth["name"]=	date("M", strtotime($week));
		
						if (!$broadcastMonth["weeks"]) {
							$broadcastMonth["weeks"] = array();
							$lastSundayOfMonth = strtotime("last sunday of this month", strtotime($week));
							$currentMonth = date("m",$lastSundayOfMonth);
							error_log("Broadcast Weeks Init - Last Sunday of this month:" . date("Y-m-d",$lastSundayOfMonth));
						}
		
						error_log("Broadcast Weeks - Last Sunday of this month:" . date("Y-m-d",$lastSundayOfMonth));
							error_log("Broadcast Weeks $week " . strtotime($week) . " " . $lastSundayOfMonth);
								
							if (strtotime($week) > $lastSundayOfMonth) {
								$broadcastMonth["weeks"] = array();
								error_log("Broadcast Weeks - New Month:" . date("Y-m-d",strtotime($week)) . " > " . date("Y-m-d",$lastSundayOfMonth));
								if (date("m",strtotime($week)) == date("m",$lastSundayOfMonth)) {
									$currentMonth = date("m",strtotime("+1 month", $lastSundayOfMonth));						
									$lastSundayOfMonth = strtotime("last sunday of next month", strtotime($week));
								}
								else {
									$lastSundayOfMonth = strtotime("last sunday of this month", strtotime($week));
								}
							}
							else {
								error_log("Broadcast Weeks - Same Month:" . date("Y-m-d",strtotime($week)) . " <= " . date("Y-m-d",$lastSundayOfMonth));						
							}
						$currentMonth = date("m",$lastSundayOfMonth);
				
						$lastMonthWeek = date("M", strtotime($week));
						array_push($broadcastMonth["weeks"], date("Y-m-d", strtotime($week)));
						error_log("Broadcast Weeks - Month: $currentMonth " . date("m", $lastSundayOfMonth) . " = " . date("M d", strtotime($week)));
						$broadcastMonths[$currentMonth] = array("name"=>date("M", $lastSundayOfMonth), "weeks"=>$broadcastMonth["weeks"]);	
				}		
			

		
		//		error_log("Months:" . print_r($months) );
			
				$category = $report["category"];
			
				error_log("BH_REPORT " . $category);
				
				$data[$worksheetCounter]["sheet"] = $sheet; 
				$data[$worksheetCounter]["lines"] = $lines; 
				$data[$worksheetCounter]["wsWeeks"] = $wsWeeks; 
				$data[$worksheetCounter]["weeks"] = $weeks; 
				$data[$worksheetCounter]["weekNames"] = $weeks; 
				$data[$worksheetCounter]["monthWeeks"] = $months; 
				$data[$worksheetCounter]["campaigns"] = $campaigns; 
				$data[$worksheetCounter]["clients"] = $clients; 
				$data[$worksheetCounter]["markets"] = $markets; 
				$data[$worksheetCounter]["broadcastWeeks"] = $broadcastWeeks; 
				$data[$worksheetCounter]["broadcastMonth"] = $broadcastMonth; 
				$data[$worksheetCounter]["broadcastMonths"] = $broadcastMonths; 
				
				$worksheetCounter++;
			
			}
			
			return $data;
			
	}	
	
	public function tracking($reportID) {
		
			$this->view = "pdf";
			
			$bhUser = new \BH\user($this->db, $this->userID); 
			  
			$this->agencyID = $bhUser->getAgencyID();				

		    $reports = new \BH\report($this->db, $this->agencyID, $this->userID);

			$template = $reports->getTemplate($reportID);
			$report = $reports->getReport($reportID);

		    $worksheet = new \BH\worksheet($this->db, $this->agencyID, $this->userID);
		    
		    if ($report["allCampaigns"]) {
			    $campaignStr = "and BH_CAMPAIGNS.isDeleted is FALSE";
		    }
		    else {
		    	$campaignIDs = $report["campaigns"];
			    $campaignStr = "and BH_CAMPAIGNS.id in ($campaignIDs) and BH_CAMPAIGNS.isDeleted is FALSE";
		    }

		    
		    if ($report["allClients"]) {
			    $clientStr = "and BH_CLIENTS.isDeleted is FALSE";
		    }
		    else {
		    	$clientIDs = $report["clients"];
			    $clientStr = "and BH_CAMPAIGNS.clientID in ($clientIDs) and BH_CLIENTS.isDeleted is FALSE";
		    }	
		    
		    		    
		    if ($report["allMarketTypes"]) {
			    $marketTypeStr = "";
		    }
		    else {
		    	$marketTypes = $report["marketTypes"];
			    $marketTypeStr = "and BH_WORKSHEETS.typeID in ($marketTypes)";
		    }
		    
		    if ($report["startDate"]) {
			    $startDateStr = " and BH_CAMPAIGNS.flightStart >= '" . $report["startDate"] . "'";
		    }
		    else {
			    $startDateStr = "";
		    }

		    if ($report["endDate"]) {
			    $endDateStr = " and BH_CAMPAIGNS.flightEnd <= '" . $report["endDate"] . "'";
		    }
		    else {
			    $endDateStr = "";
		    }
		    		    	    
			$r = $this->db->query("select BH_CAMPAIGNS.*,BH_WORKSHEETS.typeID as mediaType, BH_VENDOR_TYPES.description as mediaDesc from BH_WORKSHEETS left join BH_VENDOR_TYPES on (BH_VENDOR_TYPES.id=BH_WORKSHEETS.typeID) left join BH_WORKSHEET_MARKETS on (BH_WORKSHEET_MARKETS.worksheetID=BH_WORKSHEETS.id) left join BH_MARKETS on (BH_MARKETS.id=BH_WORKSHEET_MARKETS.marketID) left join BH_VENDORS on (BH_VENDORS.id=BH_MARKETS.vendorID) left join BH_CAMPAIGNS on (BH_WORKSHEETS.campaignID=BH_CAMPAIGNS.id) left join BH_CLIENTS on (BH_CLIENTS.id=BH_CAMPAIGNS.clientID) where BH_WORKSHEETS.isDeleted is FALSE $campaignStr $clientStr $marketTypeStr $startDateStr $endDateStr group by BH_CAMPAIGNS.id,BH_WORKSHEETS.typeID order by BH_CAMPAIGNS.flightStart asc, BH_CAMPAIGNS.name asc");

			error_log("Tracking: " . $this->db->lastQuery());
			
			$campaigns=$r->fetchAll();
			
			$data = array();
			
			$campaignsCounter=0;
	
			foreach($campaigns as $campaign) {
							
			    $client = new \BH\client($this->db, $this->agencyID, $this->userID);	
			    $cmpgn = new \BH\campaign($this->db, $this->agencyID, $this->userID);	
			
				$clients = $client->getClient($campaign["clientID"]);
			
				$category = $report["category"];
			
				error_log("BH_REPORT " . $category);
	
				if ($report["isPending"]) {
					$status = "isPending";
				}
				else if ($report["isBilling"]) {
					$status = "isOrdered";
				}
				else {
					$status = "isActive";
				}
				
				$grossCost = $cmpgn->getGrossCostByCampaignIDAndStatus($campaign["id"], $status);
				$netCost = $cmpgn->getNetCostByCampaignIDAndStatus($campaign["id"], $status);
				$totalSpots = $cmpgn->getTotalSpotsByCampaignIDAndStatus($campaign["id"], $status);

				setlocale(LC_MONETARY, 'en_US');

				$data[$campaignsCounter]["campaigns"] = $campaign; 
				$data[$campaignsCounter]["grossCostStr"] = money_format("%n", $grossCost); 
				$data[$campaignsCounter]["netCostStr"] =  money_format("%n", $netCost);
				$data[$campaignsCounter]["grossCost"] = $grossCost; 
				$data[$campaignsCounter]["netCost"] =  $netCost;
				$data[$campaignsCounter]["totalSpots"] = $totalSpots; 
				$data[$campaignsCounter]["clients"] = $clients; 
				$data[$campaignsCounter]["markets"] = $markets; 
				
				$campaignsCounter++;
			
			}
			
			return $data;
	}
	
	public function populate($reportID) {
			
			$bhUser = new \BH\user($this->db, $this->userID); 
			  
			$this->agencyID = $bhUser->getAgencyID();				

		    $reports = new \BH\report($this->db, $this->agencyID, $this->userID);

			$report = $reports->getReport($reportID);

			$source = $report["source"];
			
			return $this->$source($reportID);
		
		
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

	public function getClientNames($clientIDs) {
		
		if ($clientIDs != "") {
		  $agencyIDStr = $this->db->quote($this->agencyID);
  
		  $r=$this->db->query("select group_concat(`name` separator ', ') as clientNames from BH_CLIENTS where id in ($clientIDs) and BH_CLIENTS.agencyID = $agencyIDStr");
		  $results=$r->fetch(\PDO::FETCH_ASSOC);
	
		  error_log($this->db->lastQuery());
			
		  return $results["clientNames"];
		}
		
		return "";
	  
	}

	public function getVendorTypes($typeIDs) {
					
		if ($typeIDs != "") {	  
		  $r=$this->db->query("select group_concat(`description` separator ', ') as vendorTypes from BH_VENDOR_TYPES where id in ($typeIDs)");
		  $results=$r->fetch(\PDO::FETCH_ASSOC);
	
		  error_log($this->db->lastQuery());
			
		  return $results["vendorTypes"];
	    }
	    
	    return "";
	  
	}

	public function getCampaignNames($campaignIDs) {
		
		  $agencyIDStr = $this->db->quote($this->agencyID);
				 
		  if ($campaignIDs != "") {			  
			  $r=$this->db->query("select group_concat(`name` separator ', ') as campaignNames from BH_CAMPAIGNS where id in ($campaignIDs) and BH_CAMPAIGNS.agencyID = 	$agencyIDStr");
			  $results=$r->fetch(\PDO::FETCH_ASSOC);
		  
			  error_log($this->db->lastQuery());
			
			  return $results["campaignNames"];
		  }
		  
		  return "";
	  
	}
	
	public function printOrder() {
		
	}
	
}