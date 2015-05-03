<?php

/**
 * FILELOGIX BLUHORN REPORTS CLASS
 *  
 * @author Wes Benwick
 * @link http://www.filelogix.com
 * @license Part of Filelogix usage license
 */ 
 
namespace FLX\Controllers;

class reports extends \controller
{  
    // Will store database connection here
	private $db;
	private $connID;
	private $sessionID;
	private $agencyID;
	private $userID;
	private $view = "reports";
	private $auth;
	private $vars = array("activeSideBar"=>array("reports"=>"active"));
	private $lists;
	private $registration;
	private $request;
	private $editor;
	private $pdfData;
	private $fields = array();


	/**
  	 * Create instance, load current info based on session info
  	 *
  	 * @return bool
  	 */
	
	public function __construct($db, $sessionID, $userID, $request) {
	  $this->db = $db;
	  $this->sessionID = $sessionID;
	  $this->userID = $userID;
	  $this->request = $request;

	  $this->vars["sessionID"] = $sessionID;
	  
	  error_log("Reports Init");

	  $this->auth = new \auth($this->db);
	  
	  if (!$this->auth->validate($this->userID)) {
		  
		  $_SESSION["returnURL"] = $this->request->getRequest();
		
		  $this->view = "login";
		  
		  return;
	  }
	  
/*
	  $access = $this->auth->getAccessByUserID($this->userID, "Dashboard");
	  
	  if (!$access["read"]) {

		  $_SESSION["returnURL"] = $this->request->getRequest();

		  $this->view = "login";
		  
		  return;		  
		  
	  }	
*/  
	  
	  $this->fields["summary"] = array("clients"=>"clients", "campaigns"=>"campaigns", "vendors"=>"vendors", "markets"=>"markets", "types"=>"types");
	  $this->fields["schedule"] = array("clients"=>"clients", "campaigns"=>"campaigns", "worksheets"=>"worksheets", "vendors"=>"vendors", "markets"=>"markets", "types"=>"types");
	  $this->fields["worksheet"] = array("clients"=>"clients", "campaigns"=>"campaigns", "worksheets"=>"worksheets", "vendors"=>"vendors", "markets"=>"markets", "types"=>"types");
	  $this->fields["reports"] = array("agencyID"=>"agencyID", "format"=>"format", "category"=>"category", "templateID"=>"templateID");
	  $this->fields["tracking"] = array("clients"=>"clients", "campaigns"=>"campaigns", "marketTypes"=>"marketTypes", "startDate"=>"startDate", "endDate"=>"endDate", "allClients"=>"allClients", "allCampaigns"=>"allCampaigns", "allMarketTypes"=>"allMarketTypes", "isBilling"=>"isBilling", "isPending"=>"isPending", "isNetCost"=>"isNetCost");	  
	  
	  unset($_SESSION["returnURL"]);
	  
	  $this->lists = new \lists($this->db);
	  $this->editor = new \editor($this->db);
	 
	  $this->topCharts();
	 
	  $this->vars["sideNav"]="Reports";
	  $this->vars["sessionID"]=$this->sessionID;

	  $this->vars["username"] = "@" . $this->auth->getShortName($this->userID);
	  $this->vars["gravatar"] = md5( strtolower( trim( $this->auth->getEmailAddress($this->userID) ) ) );
  
	  $this->dflt();
	  		
//	  $this->db->insert("FLX_CONNECTIONS", array("type"=>$this->type, "sessionID"=>$this->sessionID, "httpHost"=>$this->httpHost, "ipAddress"=>$this->ipAddress, "userAgent"=>$this->userAgent, "fingerprint"=>$this->fingerprint, "requestURI"=>$this->requestURI, "_server"=>print_r($_SERVER,1), "_get"=>print_r($_GET,1), "_post"=>print_r($_POST,1)));	

//	  error_log($this->db->lastQuery());
	}
	
	/**
  	 * Opens the controller - responsible for authentication and loading defaults
  	 *
  	 * @return bool true if success, false if failure
  	 */
	
	public function open() {
/*
	  $this->users=$this->db->query("select * from connections");
	  foreach ($this->users as $row) {
		  $this->userID = $row['userID'];
		  $this->username = $row['username'];
		  $this->emailAddress = $row['emailAddress'];
      }
      
    
*/	

		$this->vars["active"] = "dashboard";
	
	}
	
	
	/**
  	 * Loads the controller, handles any templating and pre-display logic for the requested view
  	 *
  	 * @return bool
  	 */
	
	public function load($view) {


	}

	public function topCharts() {

		$bhUser = new \BH\user($this->db, $this->userID); 
		  
		$this->agencyID = $bhUser->getAgencyID();

		$this->vars["agencyID"] = $this->agencyID;
	
		$campaign = new \BH\campaign($this->db, $this->agencyID, $this->userID);		
	    $worksheet = new \BH\worksheet($this->db, $this->agencyID, $this->userID);		

		$fromDate = date("Y-m-d",strtotime());

		$campaignCounts = $campaign->countCampaignsByMonth($fromDate,15);
		$buysCounts = $worksheet->countBuysByMonth($fromDate,15);
		$adsCounts = $worksheet->countLinesByMonth($fromDate,15);
		
		$campaignsByMonth = $this->listOfMonths(15);
		$buysByMonth = $this->listOfMonths(15);
		$adsByMonth = $this->listOfMonths(15);

		foreach ($campaignCounts as $count) {
			if (array_key_exists($count["month"], $campaignsByMonth)) {
				$campaignsByMonth[$count["month"]] = $count["total"];
			}
	
		}

		foreach ($buysCounts as $count) {
			if (array_key_exists($count["month"], $buysByMonth)) {
				$buysByMonth[$count["month"]] = $count["total"];
			}
		}	

		foreach ($adsCounts as $count) {
			if (array_key_exists($count["month"], $adsByMonth)) {
				$adsByMonth[$count["month"]] = $count["total"];
			}
		}	
					
		$this->vars["chartCampaigns"] = implode(",",array_values($campaignsByMonth));
		$this->vars["chartCampaignsTotal"] = $campaign->countCampaigns();
				
		$this->vars["chartBuys"] = implode(",",array_values($buysByMonth));
		$this->vars["chartBuysTotal"] = $worksheet->countBuys();
		
		$this->vars["chartAds"] = implode(",",array_values($adsByMonth));
		$this->vars["chartAdsTotal"] = $worksheet->countLines();

		return true;
		
	}
	
	public function listOfMonths($numberOfMonths) {
		
		$months = array();
		
		for ($i = 1; $i <= $numberOfMonths; $i++) {
			$month = date("Y-m", strtotime("-$i months"));
			$months[$month] = 0;
		}
		
		return $months;
	}

	public function dflt() {
	  if ($this->auth->validate($this->userID)) {

		$this->vars["active"] = "dashboard";

		  $campaign = array();
		
		  $campaign["flightDates"] = "May 5 - May 25";
		  
		  $this->vars["campaign"] = $campaign;
		
		$this->view = "reports";
		
		return true;		
	  }
	  else {
		 return false;
	  }
	}
	
	public function worksheet($params) {
	  if ($this->auth->validate($this->userID)) {


		$this->vars["active"] = "dashboard";

		
		$this->view = "reports";
		
		return true;		
	  }
	  else {
		 return false;
	  }
	}
	
	public function template($params) {
//	  if ($this->auth->validate($this->userID)) {

		if ($params[2]=="summary") {
			if ($params[3] == "station") {
				if ($params[4] != "") {
						$this->vars["station"] = $params[4];
						$this->view = "reports";
				}
			}
		}
		else {
			$this->view = "reports";			
		}
			
		return true;		
//	  }
//	  else {
//		 return false;
//	  }
	}
	
	public function summary($params) {

		if ($this->auth->validate($this->userID)) {

			
			$bhUser = new \BH\user($this->db, $this->userID); 	  
			$this->agencyID = $bhUser->getAgencyID();
			
			$this->vars["agencyID"] = $this->agencyID;
	
			$this->view = "reports-summary";
	
			$client = new \BH\client($this->db, $this->agencyID, $this->userID);
	
			$this->vars["clients"] = $client->getAllClients();
			$this->vars["reportCategory"] = "summary";
			$this->vars["templateID"] = "1";
	
			if ($params[2] == "tv") {
				$this->vars["reportType"] = "tv";
				$this->vars["reportTitle"] = "TV";
				$this->vars["reportDescription"] = "Broadcast TV Campaign Summaries by Client";
				
				return true;
			}

			else if ($params[2] == "tvcable") {
				$this->vars["reportType"] = "tvcable";
				$this->vars["reportTitle"] = "TV/Cable";
				$this->vars["templateID"] = "10";
				$this->vars["reportDescription"] = "Broadcast TV & Cable Campaign Summaries by Client";
				
				return true;
			}
	
			else if ($params[2] == "cable") {
				$this->vars["reportType"] = "cable";
				$this->vars["reportTitle"] = "Cable";
				$this->vars["templateID"] = "5";
				$this->vars["reportDescription"] = "Cable Campaign Summaries by Client";
				
				return true;
			}
			
			else if ($params[2] == "radio") {
				$this->vars["reportType"] = "radio";
				$this->vars["reportTitle"] = "Radio";
				$this->vars["templateID"] = "4";
				$this->vars["reportDescription"] = "Radio Campaign Summaries by Client";
				
				return true;
			}
	
			else if ($params[2] == "digital") {
				$this->vars["reportType"] = "digital";
				$this->vars["reportTitle"] = "Digital";
				$this->vars["templateID"] = "8";
				$this->vars["reportDescription"] = "Digital Campaign Summaries by Client";
				
				return true;
			}
	
			else if ($params[2] == "print") {
				$this->vars["reportType"] = "prnt";
				$this->vars["reportTitle"] = "Print";
				$this->vars["templateID"] = "6";
				$this->vars["reportDescription"] = "Print Campaign Summaries by Client";
				
				return true;
			}
	
			else if ($params[2] == "outdoor") {
				$this->vars["reportType"] = "outdoor";
				$this->vars["reportTitle"] = "Outdoor";
				$this->vars["templateID"] = "8";
				$this->vars["reportDescription"] = "Outdoor Campaign Summaries by Client";
				
				return true;
			}
											
			return false;
		}
		else {
			return false;
		}
		
	}

	public function tracking($params) {
		
		$bhUser = new \BH\user($this->db, $this->userID); 	  
		$this->agencyID = $bhUser->getAgencyID();
		
		$this->vars["agencyID"] = $this->agencyID;

		$this->view = "reports-tracking";

		$client = new \BH\client($this->db, $this->agencyID, $this->userID);

	    $market = new \BH\market($this->db, $this->agencyID, $this->userID);	
	
		$this->vars["vendorTypes"] = $market->getMarketTypes();

		$this->vars["clients"] = $client->getAllClients();
		$this->vars["reportCategory"] = "tracking";
		$this->vars["templateID"] = "2";

		if ($params[2] == "billing") {
			$this->vars["reportType"] = "billing";
			$this->vars["reportTitle"] = "Billing Tracking";
			$this->vars["reportDescription"] = "Billing Tracking Report";
			$this->vars["isBilling"] = "1";
			
			return true;
		}

		else if ($params[2] == "pending") {
			$this->vars["reportType"] = "pending";
			$this->vars["reportTitle"] = "Pending Tracking";
			$this->vars["reportDescription"] = "Pending Tracking Report";
			$this->vars["isPending"] = "1";
			
			return true;
		}
									
		return false;
		
	}
	
	public function players() {
		
	if ($this->auth->validate($this->userID)) {
	
		
		return true;
	 }
	 else {
		 return false;
	 }
	}

	public function all() {
		
	if ($this->auth->validate($this->userID)) {
	
		$this->view = "reports";			

		return true;
	 }
	 else {
		 return false;
	 }
	}

	public function create() {
		
	if ($this->auth->validate($this->userID)) {
	
		$this->view = "reports";			

		return true;
	 }
	 else {
		 return false;
	 }
	}
	
	public function edit() {
		
	if ($this->auth->validate($this->userID)) {
	
		$this->view = "reports";			

		return true;
	 }
	 else {
		 return false;
	 }
	}
	
	public function pending() {
		
	if ($this->auth->validate($this->userID)) {
	
		
		return true;
	 }
	 else {
		 return false;
	 }
	}


	public function active() {
		
	if ($this->auth->validate($this->userID)) {
	
		
		return true;
	 }
	 else {
		 return false;
	 }
	}
	
	
	public function editor($params) {
		
	
		
	   if ($this->auth->validate($this->userID)) {

		$this->vars["sideNav"]="Editor";
/*
		if ($params[4] == "save") {
			error_log("Saving Editor Content.");
			error_log(html_entity_decode($_POST["editorContent"]));
			
			return true;
		}

*/

		if ($params[4] == "ace") {
		
			$this->vars["titleBar"] = $params[5];
		
			$this->view="editor-ace";
	
			$source = $this->editor->getTemplate($params[5]);
	
	//		error_log("Dump: $source");
	
			$this->vars["editorSource"] = htmlentities($source);
			
			return true;
			
		}	
	
		else {
		
			$this->view="editor-table";
	
			$templates = $this->editor->getTemplates();
	
	//		error_log("Dump: $source");
	
			$this->vars["items"] = $templates;
			
			return true;
		}
	  }
	  else {
		 return false;
	  }
	}


	
	public function data() {
		
		return $this->vars;
	}


	public function view() {
	
		if ($_GET["mobile"] == "yes") {
			return "mobile";
		}
		else {			
			return $this->view;
		}
	}
	
	public function transfer() {
		
		return $this->transfer;
	}

	public function show($params) {

		if ($this->auth->validate($this->userID)) {
		
			$bhUser = new \BH\user($this->db, $this->userID); 
			  
			$this->agencyID = $bhUser->getAgencyID();

			$report = new \BH\report($this->db, $this->agencyID, $this->userID);
		
			$reportID = $params[2];

			$report->isReady($reportID, true);
							
			$records =  $report->populate($reportID);

			$category = $report->getCategory($reportID);

			error_log("Report: $category $reportID - " . $report->getTemplateID($reportID));

			if ($params[3] == "pdf") {
			
					if ($category == "tracking") {
						$reportTitle = "Tracking Report";
						include_once("/var/www/html/bluhorn/pdf/tracking_report.php");
		
						$this->view = "ajax-response";	
					  
					    $this->pdfData = makePDF($report, $reportID, $records);
						$response = array();	
				
				  		$response["pdfData"] = $this->pdfData;
				 		$this->vars["response"] = json_encode($response);
				 		
				 		return false;
					}
					else if ($category == "schedule") {
						if ($report->getTemplateID($reportID) == "13") {	
							include_once("/var/www/html/bluhorn/pdf/schedule_radio_report.php");
						}
						else if ($report->getTemplateID($reportID) == "12") {	
							include_once("/var/www/html/bluhorn/pdf/schedule_cable_report.php");
						}
						else if ($report->getTemplateID($reportID) == "11") {	
							include_once("/var/www/html/bluhorn/pdf/schedule_tv_report.php");
						}						
						$this->view = "ajax-response";	
					  
					    $this->pdfData = makePDF($report, $reportID, $records);
						$response = array();	
				
				  		$response["pdfData"] = $this->pdfData;
				 		$this->vars["response"] = json_encode($response);
					
					  	return false;
					}
					else if ($category == "worksheet") {
						if ($report->getTemplateID($reportID) == "13") {	
							include_once("/var/www/html/bluhorn/pdf/schedule_radio_report.php");
						}
						else if ($report->getTemplateID($reportID) == "12") {	
							include_once("/var/www/html/bluhorn/pdf/schedule_cable_report.php");
						}
						else if ($report->getTemplateID($reportID) == "11") {	
							include_once("/var/www/html/bluhorn/pdf/schedule_tv_report.php");
						}						
						$this->view = "ajax-response";	
					  
					    $this->pdfData = makePDF($report, $reportID, $records);
						$response = array();	
				
				  		$response["pdfData"] = $this->pdfData;
				 		$this->vars["response"] = json_encode($response);
					
					  	return false;
					}
					else {
											
						if ($report->getTemplateID($reportID) == "4") {	
							include_once("/var/www/html/bluhorn/pdf/summary_radio_report.php");
						}
						else if ($report->getTemplateID($reportID) == "5") {	
							include_once("/var/www/html/bluhorn/pdf/summary_cable_report.php");
						}
						else if ($report->getTemplateID($reportID) == "6") {	
							include_once("/var/www/html/bluhorn/pdf/summary_prnt_report.php");
						}
						else if ($report->getTemplateID($reportID) == "8") {	
							include_once("/var/www/html/bluhorn/pdf/summary_outdoor_report.php");
						}
						else if ($report->getTemplateID($reportID) == "9") {	
							include_once("/var/www/html/bluhorn/pdf/summary_digital_report.php");
						}
						else if ($report->getTemplateID($reportID) == "10") {	
							include_once("/var/www/html/bluhorn/pdf/summary_tvcable_report.php");
						}
						else {
							include_once("/var/www/html/bluhorn/pdf/summary_tv_report.php");
						}
		
						$this->view = "ajax-response";	
					  
					    $this->pdfData = makePDF($report, $reportID, $records);
						$response = array();	
				
				  		$response["pdfData"] = $this->pdfData;
				 		$this->vars["response"] = json_encode($response);
					
					  	return false;
					}
			}
			
			else if	($params[3] == "csv") {
						
						if ($report->getTemplateID($reportID) == "1") {	
							$this->toCSV(1, $records, $params);
						}
						else if ($report->getTemplateID($reportID) == "4") {	
							$this->toCSV(1, $records, $params);
						}
						else if ($report->getTemplateID($reportID) == "5") {	
							$this->toCSV(1, $records, $params);
						}
						else if ($report->getTemplateID($reportID) == "6") {	
							$this->toCSV(2, $records, $params);
						}
						else if ($report->getTemplateID($reportID) == "8") {	
							$this->toCSV(3, $records, $params);
						}
						else if ($report->getTemplateID($reportID) == "9") {	
							$this->toCSV(4, $records, $params);
						}
						else if ($report->getTemplateID($reportID) == "10") {	
							$this->toCSV(1, $records, $params);
						}
						else if ($report->getTemplateID($reportID) == "14") {	
							$this->toCSV(5, $records, $params);
						}
						else if ($report->getTemplateID($reportID) == "15") {	
							$this->toCSV(5, $records, $params);
						}
						else if ($report->getTemplateID($reportID) == "16") {	
							$this->toCSV(5, $records, $params);
						}
						else if ($report->getTemplateID($reportID) == "17") {	
							$this->toCSV(2, $records, $params);
						}
						else if ($report->getTemplateID($reportID) == "18") {	
							$this->toCSV(3, $records, $params);
						}
						else if ($report->getTemplateID($reportID) == "19") {	
							$this->toCSV(4, $records, $params);
						}
						else {
							return true;
						}
				
			}
			
			return false;

		}
		
		else {
			
		}
		
		return false;
		
	}
	
	public function toCSV($templateID, $records, $params) {
		
				$array = array();

				if ($templateID == 1) {
					$fields = array("clientName"=>"ClientName", "clientID"=>"Client ID",  "campaignName"=>"Campaign Name", "campaignID"=>"Campaign ID", "worksheetName"=>"Worksheet Name", "worksheetID" => "Worksheet ID", "worksheetLine"=>"Line #", "vendorName"=>"Vendor Name", "station"=>"Station", "daypart"=>"Daypart", "daysOfWeek"=>"Days", "timePeriod"=>"Time", "programName"=>"Program", "seconds"=>"Length", "rate"=>"Rate", "aqhRating"=>"Rating", "cpp"=>"CPP", "cpm"=>"CPM", "comments"=>"Comments");
					
					
					foreach ($records as $record) {
						$weekCounter = 1;
						foreach ($record["weekNames"] as $week) {
							$fields["week" . $weekCounter] = $week;
							$weekCounter++;
						}
					}

					
					$lineCounter = 1;
					
					foreach ($records as $record) {
					
							foreach ($record["lines"] as $line) {
	
//								error_log("CSV_WEEKS: $lineCounter " . print_r($records[0]["wsWeeks"][$lineCounter],true));

								$weekCounter = 1;
								$row = array();
								foreach (array_keys($fields) as $field) {
									if ($field == "daysOfWeek") {
										$daysOfWeekStr = "";
										if ($line["isMonday"]) {
											$daysOfWeekStr .= "M";
										}
										if ($line["isTuesday"]) {
											$daysOfWeekStr .= "T";
										}
										if ($line["isWednesday"]) {
											$daysOfWeekStr .= "W";
										}
										if ($line["isThursday"]) {
											$daysOfWeekStr .= "R";
										}
										if ($line["isFriday"]) {
											$daysOfWeekStr .= "F";
										}
										if ($line["isSaturday"]) {
											$daysOfWeekStr .= "A";
										}
										if ($line["isSunday"]) {
											$daysOfWeekStr .= "U";
										}									
										$row[$field] = $daysOfWeekStr;
									}
									else if ($field == "worksheetLine") {
										$row[$field] = $lineCounter;
									}
									
									else if ($field == "clientName") {
										$row[$field] = $record["clients"]["name"];
									}

									else if ($field == "clientID") {
										$row[$field] = $record["clients"]["id"];
									}							
													
									else if ($field == "campaignName") {
										$row[$field] = $record["campaigns"]["name"];
									}		

									else if ($field == "campaignID") {
										$row[$field] = $record["campaigns"]["id"];
									}		

									else if ($field == "worksheetName") {
										$row[$field] = $record["sheet"]["name"];
									}	
																													
									else if (substr($field,0,4) == "week") {
//										error_log("CSV_WEEKS: $lineCounter $weekCounter ");
										$row[$field] = intval($record["wsWeeks"][$line["worksheetLine"]][$weekCounter]);
										$weekCounter++;
									}
									else {
										$row[$field] = $line[$field];
									}									
									
								}
			
								array_push($array, $row);
								$lineCounter++;
							}
					}
				}

				else if ($templateID == 2) {
					$fields = array("clientName"=>"ClientName", "clientID"=>"Client ID",  "campaignName"=>"Campaign Name", "campaignID"=>"Campaign ID", "worksheetName"=>"Worksheet Name", "worksheetID" => "Worksheet ID", "worksheetLine"=>"Line #", "vendorName"=>"Vendor Name", "insertionDate", "Insertion Date", "caption" => "Caption", "printSize"=>"Size", "color"=>"Color", "numberOfColumns"=>"Cols", "inches"=>"Inches", "positionRequest"=>"Position", "grossCPI"=>"Gross CPI", "grossColor"=>"Gross Color", "netCPI"=>"Net CPI", "netColor"=>"Net Color", "grossCost"=>"Gross Cost", "netCost"=>"Net Cost", "comments"=>"Comments");
					
					$weekCounter = 1;
					
					
					$lineCounter = 1;
					
					foreach ($records as $record) {
					
							foreach ($record["lines"] as $line) {
	
//								error_log("CSV_WEEKS: $lineCounter " . print_r($records[0]["wsWeeks"][$lineCounter],true));

								$weekCounter = 1;
								$row = array();
								foreach (array_keys($fields) as $field) {

									if ($field == "worksheetLine") {
										$row[$field] = $lineCounter;
									}
									
									else if ($field == "clientName") {
										$row[$field] = $record["clients"]["name"];
									}

									else if ($field == "clientID") {
										$row[$field] = $record["clients"]["id"];
									}							
													
									else if ($field == "campaignName") {
										$row[$field] = $record["campaigns"]["name"];
									}		

									else if ($field == "campaignID") {
										$row[$field] = $record["campaigns"]["id"];
									}		

									else if ($field == "worksheetName") {
										$row[$field] = $record["sheet"]["name"];
									}	
																													
									else {
										$row[$field] = $line[$field];
									}									
									
								}
			
								array_push($array, $row);
								$lineCounter++;
							}
					}
				}

				else if ($templateID == 3) {
					$fields = array("clientName"=>"ClientName", "clientID"=>"Client ID",  "campaignName"=>"Campaign Name", "campaignID"=>"Campaign ID", "worksheetName"=>"Worksheet Name", "worksheetID" => "Worksheet ID", "worksheetLine"=>"Line #", "vendorName"=>"Vendor Name", "insertionDate", "Insertion Date", "name" => "Name", "location"=>"Location", "boardSize"=>"Size", "numberOfBoards"=>"# of Boards", "type"=>"Type", "locationRequest"=>"Location Request", "boardCost"=>"Board Cost", "productionCost"=>"Production Cost", "Total Cost"=>"Total Cost", "Net Cost"=>"Net Cost", "comments"=>"Comments");
					
					$weekCounter = 1;
					
					
					$lineCounter = 1;
					
					foreach ($records as $record) {
					
							foreach ($record["lines"] as $line) {
	
//								error_log("CSV_WEEKS: $lineCounter " . print_r($records[0]["wsWeeks"][$lineCounter],true));

								$weekCounter = 1;
								$row = array();
								foreach (array_keys($fields) as $field) {

									if ($field == "worksheetLine") {
										$row[$field] = $lineCounter;
									}
									
									else if ($field == "clientName") {
										$row[$field] = $record["clients"]["name"];
									}

									else if ($field == "clientID") {
										$row[$field] = $record["clients"]["id"];
									}							
													
									else if ($field == "campaignName") {
										$row[$field] = $record["campaigns"]["name"];
									}		

									else if ($field == "campaignID") {
										$row[$field] = $record["campaigns"]["id"];
									}		

									else if ($field == "worksheetName") {
										$row[$field] = $record["sheet"]["name"];
									}	
																													
									else {
										$row[$field] = $line[$field];
									}									
									
								}
			
								array_push($array, $row);
								$lineCounter++;
							}
					}
				}
	
				else if ($templateID == 5) {
					$fields = array("clientName"=>"ClientName", "clientID"=>"Client ID",  "campaignName"=>"Campaign Name", "campaignID"=>"Campaign ID", "worksheetName"=>"Worksheet Name", "worksheetID" => "Worksheet ID", "worksheetLine"=>"Line #", "vendorName"=>"Vendor Name", "station"=>"Station", "daypart"=>"Daypart", "daysOfWeek"=>"Days", "timePeriod"=>"Time", "programName"=>"Program", "seconds"=>"Length", "rate"=>"Rate", "aqhRating"=>"Rating", "cpp"=>"CPP", "impact"=>"impact", "cpm"=>"CPM", "comments"=>"Comments");
					
					$weekCounter = 1;
					
					foreach ($records as $record) {
						foreach ($record["weekNames"] as $week) {
							$fields["week" . $weekCounter] = $week;
							$weekCounter++;
						}
					}

					
					$lineCounter = 1;
					
					foreach ($records as $record) {
					
							foreach ($record["lines"] as $line) {
	
//								error_log("CSV_WEEKS: $lineCounter " . print_r($records[0]["wsWeeks"][$lineCounter],true));

								$weekCounter = 1;
								$row = array();
								foreach (array_keys($fields) as $field) {
									if ($field == "daysOfWeek") {
										$daysOfWeekStr = "";
										if ($line["isMonday"]) {
											$daysOfWeekStr .= "M";
										}
										if ($line["isTuesday"]) {
											$daysOfWeekStr .= "T";
										}
										if ($line["isWednesday"]) {
											$daysOfWeekStr .= "W";
										}
										if ($line["isThursday"]) {
											$daysOfWeekStr .= "R";
										}
										if ($line["isFriday"]) {
											$daysOfWeekStr .= "F";
										}
										if ($line["isSaturday"]) {
											$daysOfWeekStr .= "A";
										}
										if ($line["isSunday"]) {
											$daysOfWeekStr .= "U";
										}									
										$row[$field] = $daysOfWeekStr;
									}
									else if ($field == "worksheetLine") {
										$row[$field] = $lineCounter;
									}
									
									else if ($field == "clientName") {
										$row[$field] = $record["clients"]["name"];
									}

									else if ($field == "clientID") {
										$row[$field] = $record["clients"]["id"];
									}							
													
									else if ($field == "campaignName") {
										$row[$field] = $record["campaigns"]["name"];
									}		

									else if ($field == "campaignID") {
										$row[$field] = $record["campaigns"]["id"];
									}		

									else if ($field == "worksheetName") {
										$row[$field] = $record["sheet"]["name"];
									}	
																													
									else if (substr($field,0,4) == "week") {
//										error_log("CSV_WEEKS: $lineCounter $weekCounter ");
										$row[$field] = intval($record["wsWeeks"][$line["worksheetLine"]][$weekCounter]);
										$weekCounter++;
									}
									else {
										$row[$field] = $line[$field];
									}									
									
								}
			
								array_push($array, $row);
								$lineCounter++;
							}
					}
				}

						
				// Open the output stream
				$fh = fopen('php://output', 'w');
				        
				// Start output buffering (to capture stream contents)
				ob_start();
				        
				fputcsv($fh, $headings);
				        
				// Loop over the * to export
				if (! empty($array)) {
				  fputcsv($fh, array_values($fields));							  
				
				  foreach ($array as $item) {
				    fputcsv($fh, $item);
				  }
				}
				        
				// Get the contents of the output buffer
				$string = ob_get_clean();
				        
				$filename = $this-agencyID . $params[2] . strtotime("now");
				        
				// Output CSV-specific headers
				header("Pragma: public");
				header("Expires: 0");
				header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
				header("Cache-Control: private",false);
				header("Content-Type: application/octet-stream");
				header("Content-Disposition: attachment; filename=\"$filename.csv\";" );
				header("Content-Transfer-Encoding: binary");
				 
				exit($string);
		
	}
	

	public function ajax($params) {
	
	 error_log("Reports AJAX");
	
	 if ($this->auth->validate($this->userID)) {
		  
		  if ($params[2] == "create") {
		  		  
			  $bhUser = new \BH\user($this->db, $this->userID); 
			  
			  $this->agencyID = $bhUser->getAgencyID();
		  	
			  $form = new \forms($this->db);
					  		
			  $reportCategory = $params[3];
			  $reportType = $params[4];
		
			  $reportMaster = $form->map($this->fields["reports"], $_POST);
			  $reportDetail = $form->map($this->fields[$reportCategory], $_POST);
				
			  $reports = new \BH\report($this->db, $this->agencyID, $this->userID);
		
			  if ($reportDetail["isBilling"]) {
				  $reportMaster["title"] = "Billing Report";
			  }
			  else if ($reportDetail["isPending"]) {
				  $reportMaster["title"] = "Pending Report";
			  }
			  else if ($reportDetail["isSchedule"]) {
				  $reportMaster["title"] = "Schedule";
			  }
			  else if ($reportDetail["isWorksheet"]) {
				  $reportMaster["title"] = "Worksheet";
			  }
			  else {
				  $reportMaster["title"] = "Summary Report";
			  }
			  
			  $reportID =  $reports->create($reportCategory, $reportMaster, $reportDetail);

			  $this->view = "ajax-response";	
			  
			  $response = array();	
		
			  if ($reportID>0) {
			  		$response["message"] = "Report Created!";
			  		$response["reportID"] = $reportID;
			  		$response["format"] = $reportMaster["format"];
			  		$this->vars["response"] = json_encode($response);
				  	return true;
			  }
			  else {
			  		$response["message"] = "<span style='color:#f00'>Error Creating Report.</span>";
			  		$response["error"] = true;
			  		$this->vars["response"] = json_encode($response);		
				  	return true;
			  }
		  }

		  else if ($params[2] == "status") {
		  		  
			  $bhUser = new \BH\user($this->db, $this->userID); 
			  
			  $this->agencyID = $bhUser->getAgencyID();
		  	
			  $form = new \forms($this->db);
					  		
			  $reportID = $params[3];
		
			  $reports = new \BH\report($this->db, $this->agencyID, $this->userID);
		
			  $report =  $reports->getReport($reportID);

			  $this->view = "ajax-response";	
			  
			  $response = array();	
		
			  if ($report) {
			  		$response["message"] = $report["status"];
			  		$response["reportID"] = $reportID;
			  		$this->vars["response"] = json_encode($response);
				  	return true;
			  }
			  else {
			  		$response["message"] = "";
			  		$response["error"] = true;
			  		$this->vars["response"] = json_encode($response);		
				  	return true;
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
	

}
?>
