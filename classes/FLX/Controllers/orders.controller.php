<?php

/**
 * FILELOGIX BLUHORN CAMPAIGN CLASS
 *  
 * @author Wes Benwick
 * @link http://www.filelogix.com
 * @license Part of Filelogix usage license
 */ 
 
namespace FLX\Controllers;

class orders extends \controller
{  
    // Will store database connection here
	private $db;
	private $connID;
	private $sessionID;
	private $userID;
	private $agencyID;
	private $view = "orders";
	private $auth;
	private $vars = array("activeSideBar"=>array("orders"=>"active"));
	private $lists;
	private $registration;
	private $request;
	private $editor;
	private $dayparts = array("none"=>"No Daypart", "em"=>"EM", "da"=>"DA", "ef"=>"EF", "en"=>"EN", "pa"=>"PA", "pr"=>"PR", "lf"=>"LF", "ln"=>"LN", "ov"=>"OV", "sp"=>"SP", "ro"=>"RO"); 
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
	  $this->vars["dayparts"] = $this->dayparts;

	  error_log("Campaign Init");

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

	  $this->fields["order"] = array("orderID"=>"id", "campaignID"=>"campaignID", "worksheetID"=>"worksheetID", "orderType"=>"orderType", "comments"=>"comments", "revision"=>"revision", "traffic"=>"traffic", "agencyID"=>"agencyID");
	  $this->fields["vendor"] = array("orderID"=>"orderID", "vendorID"=>"vendorID", "agencyID"=>"agencyID");

	  $this->fields["tv"] = array("orderID"=>"orderID", "printSpotsPerStation"=>"printSpotsStation", "printCPPStation"=>"printCPPStation", "printCPMStation"=>"printCPMStation", "printCPPLine"=>"printCPPLine", "printCPMLine"=>"printCPMLine", "printNetDollarsStation"=>"printNetDollars", "printGrossDollarsStation"=>"printGrossDollars", "printRatingLine"=>"printRatingLine", "printGRPStation"=>"printGRPStation", "printGRPWeek"=>"printGRPWeek");

	  $this->fields["cable"] = array("orderID"=>"orderID", "printSpotsPerStation"=>"printSpotsStation", "printCPPStation"=>"printCPPStation", "printCPMStation"=>"printCPMStation", "printCPPLine"=>"printCPPLine", "printCPMLine"=>"printCPMLine", "printNetDollarsStation"=>"printNetDollars", "printGrossDollarsStation"=>"printGrossDollars", "printRatingLine"=>"printRatingLine", "printGRPStation"=>"printGRPStation", "printGRPWeek"=>"printGRPWeek");

	  $this->fields["radio"] = array("orderID"=>"orderID", "printSpotsPerStation"=>"printSpotsStation", "printCPPStation"=>"printCPPStation", "printCPMStation"=>"printCPMStation", "printCPPLine"=>"printCPPLine", "printCPMLine"=>"printCPMLine", "printNetDollarsStation"=>"printNetDollars", "printGrossDollarsStation"=>"printGrossDollars", "printRatingLine"=>"printRatingLine", "printGRPStation"=>"printGRPStation", "printGRPWeek"=>"printGRPWeek");

	  $this->fields["prnt"] = array("orderID"=>"orderID", "printDayOfWeek"=>"printDayOfWeek", "printInsertionDate"=>"printInsertionDate", "printSizeAndType"=>"printSizeAndType", "printNetDollars"=>"printNetDollars", "printGrossDollars"=>"printGrossDollars", "printCPI"=>"printCPI");

	  
	  unset($_SESSION["returnURL"]);
	  
	  $this->lists = new \lists($this->db);
	  $this->editor = new \editor($this->db);
	 
	  $this->vars["sideNav"]="Dashboard";
	  $this->vars["sessionID"]=$this->sessionID;

	  $this->topCharts();

	  $this->vars["username"] = "@" . $this->auth->getShortName($this->userID);
	  $this->vars["gravatar"] = md5( strtolower( trim( $this->auth->getEmailAddress($this->userID) ) ) );

	  
	  $this->dflt($this->request->getArgs());
	  		
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

	public function dflt($params) {
		
	  if ($this->auth->validate($this->userID)) {

		$this->vars["active"] = "dashboard";

		  $campaign = array();
		
		  $campaign["flightDates"] = "May 5 - May 25";
		  
		  $this->vars["campaign"] = $campaign;
		
		  $this->view = "campaigns";

		  $bhUser = new \BH\user($this->db, $this->userID); 
		  
		  $this->agencyID = $bhUser->getAgencyID();
		  
		  error_log("BH agencyID:" . $this->agencyID);

		  $this->vars["agencyID"] = $this->agencyID;		
		  
	      $campaign = new \BH\campaign($this->db, $this->agencyID, $this->userID);

		  switch ($params[1]) {
			  case "pending":
			  	$this->vars["campaigns"] = $campaign->getPendingCampaigns();
 			    $this->vars["listType"] = "Pending";		
			  	break;
			  case "active":
			  	$this->vars["campaigns"] = $campaign->getActiveCampaigns();		
 			    $this->vars["listType"] = "Active";		
			  	break;
			  case "archived":
			  	$this->vars["campaigns"] = $campaign->getArchivedCampaigns();		
 			    $this->vars["listType"] = "Archived";		
			  	break;		
			  case "all":
			  default:
 			    $this->vars["listType"] = "All";		
			  	$this->vars["campaigns"] = $campaign->getAllCampaigns();		

		  }
		
		  return true;		
	  }
	  else {
		 return false;
	  }
	}
	
	public function worksheet($params) {
	  if ($this->auth->validate($this->userID)) {


		$this->vars["active"] = "dashboard";

		
		$this->view = "worksheet";
		
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
						$this->view = "worksheet-station-summary";
				}
			}
		}
		else {
			$this->view = "worksheet-station-summary";			
		}
			
		return true;		
//	  }
//	  else {
//		 return false;
//	  }
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
	
		  $this->view = "orders";			

		  $bhUser = new \BH\user($this->db, $this->userID); 
		  
		  $this->agencyID = $bhUser->getAgencyID();
		  
		  error_log("BH agencyID:" . $this->agencyID);

		  $this->vars["agencyID"] = $this->agencyID;

		  $orders = new \BH\order($this->db, $this->userID, $this->agencyID);
		  
		  $this->vars["orders"] = $orders->getAllOrders($this->agencyID);	

		return true;
	 }
	 else {
		 return false;
	 }
	}

	public function active() {
		
	if ($this->auth->validate($this->userID)) {
	
		  $this->view = "orders";			

		  $bhUser = new \BH\user($this->db, $this->userID); 
		  
		  $this->agencyID = $bhUser->getAgencyID();
		  
		  error_log("BH agencyID:" . $this->agencyID);

		  $this->vars["agencyID"] = $this->agencyID;

		  $orders = new \BH\order($this->db, $this->userID, $this->agencyID);
		  
		  $this->vars["orders"] = $orders->getActiveOrders($this->agencyID);
		return true;
	 }
	 else {
		 return false;
	 }
	}

	public function pending() {
		
	if ($this->auth->validate($this->userID)) {
	
		  $this->view = "orders";			

		  $bhUser = new \BH\user($this->db, $this->userID); 
		  
		  $this->agencyID = $bhUser->getAgencyID();
		  
		  error_log("BH agencyID:" . $this->agencyID);

		  $this->vars["agencyID"] = $this->agencyID;

		  $orders = new \BH\order($this->db, $this->userID, $this->agencyID);
		  
		  $this->vars["orders"] = $orders->getPendingOrders($this->agencyID);
		  
		return true;
	 }
	 else {
		 return false;
	 }
	}

	public function archived() {
		
	if ($this->auth->validate($this->userID)) {
	
		  $this->view = "orders";			

		  $bhUser = new \BH\user($this->db, $this->userID); 
		  
		  $this->agencyID = $bhUser->getAgencyID();
		  
		  error_log("BH agencyID:" . $this->agencyID);

		  $this->vars["agencyID"] = $this->agencyID;

		  $orders = new \BH\order($this->db, $this->userID, $this->agencyID);
		  
		  $this->vars["orders"] = $orders->getArchivedOrders($this->agencyID);
		  
		return true;
	 }
	 else {
		 return false;
	 }
	}

	public function cancelled() {
		
	if ($this->auth->validate($this->userID)) {
	
		  $this->view = "orders";			

		  $bhUser = new \BH\user($this->db, $this->userID); 
		  
		  $this->agencyID = $bhUser->getAgencyID();
		  
		  error_log("BH agencyID:" . $this->agencyID);

		  $this->vars["agencyID"] = $this->agencyID;

		  $orders = new \BH\order($this->db, $this->userID, $this->agencyID);
		  
		  $this->vars["orders"] = $orders->getCancelledOrders($this->agencyID);
		  
		return true;
	 }
	 else {
		 return false;
	 }
	}

	public function deliver($params) {
		
		$params["send"] = true;

		error_log("Deliver Order");
		
		$showParams[0] = "orders";
		$showParams[1] = "show";
		$showParams[2] = $params[4];
		
		return $this->show($showParams, true);
		
	}

	public function show($params, $sendOrder = false) {

		if ($this->auth->validate($this->userID)) {
		
			$this->view = "pdf";
		
			$sheet["id"] = $params[2];
			$worksheetID = $params[2];
			$orderKey = $_GET["orderKey"];
	
			$bhUser = new \BH\user($this->db, $this->userID); 
			  
			$this->agencyID = $bhUser->getAgencyID();		
				
		    $worksheet = new \BH\worksheet($this->db, $this->agencyID, $this->userID);
			$campaign = new \BH\campaign($this->db, $this->agencyID, $this->userID);	
		    $market = new \BH\market($this->db, $this->agencyID, $this->userID);	
		    $vendor = new \BH\vendor($this->db, $this->agencyID, $this->userID);	
		    $client = new \BH\client($this->db, $this->agencyID, $this->userID);	
		    $order = new \BH\order($this->db, $this->agencyID, $this->userID);	
		    $agency = new \BH\agency($this->db, $this->agencyID, $this->userID);	
			
			$marketVendors = array();
		
			$agencyInfo = $agency->getAgency($this->agencyID);
		
			$worksheetVendors = $vendor->getVendorsByWorksheetID($worksheetID);

			foreach ($worksheetVendors as $wsVendor) {
				$marketRep = $market->getMarket($wsVendor["marketID"]);
				$wsVendor["marketRep"] = $marketRep;
				$marketVendors[$wsVendor["id"]] = $wsVendor;
			}
		
			$sheet = $worksheet->getWorksheet($worksheetID);

			$campaigns = $campaign->getCampaign($sheet["campaignID"]);
			$marketTypes = $market->getMarketTypes();
			$markets = $market->getAllMarkets(true);
			$vendors = $vendor->getAllVendors(true);
		
			$mrkt = $market->getMarketsByWorksheetID($sheet["id"]);
			$mrktNames = $market->getMarketNames($worksheet->getMarkets($worksheetID));
			if (is_array($mrktNames)) {
				$marketName = implode(" ", $mrktNames);
			}
			else {
				$marketName = $mrktNames;
			}
			
			$campaignName = $campaigns["name"];
			$worksheetName = $sheet["name"];
			$clnt = $client->getClient($campaigns["clientID"]);
			$clientName = $clnt["name"];
			$jobNumber = $campaigns["jobNumber"];
			$buyerName = $bhUser->getFullName();
			$buyer = $bhUser->getUser($this->userID);
			$flightDateStr = $campaigns["flightStart"] . " to " . $campaigns["flightEnd"];
			$flightDateStrStd = date("m/d/Y",strtotime($campaigns["flightStart"])) . " to " . date("m/d/Y",strtotime($campaigns["flightEnd"]));
			$remarks = $campaigns["remarks"];
			$orderInfo = $order->getOrderByKey($orderKey);
			$contractNumber = $orderInfo["contractNumber"];
			$revNumber = $orderInfo["revision"];
			$orderDetails = $order->getOrderDetails($orderInfo["id"], $orderInfo["orderType"]);
			$orderVendors = $order->getOrderVendorsByOrderID($orderInfo["id"]);
			$cols = $worksheet->getCols($worksheetID);
			
			$worksheetCols = array();
			
			$orderInfo["marketName"] = $marketName;
			
			foreach ($cols as $col) {
				$worksheetCols[$col["colName"]] = $col["isHidden"];
			}

			if (($sheet["vendorType"] == "TV")) {
	
				$tv = new \BH\tv($this->db, $this->agencyID, $this->userID);

				$tv->totalSpotsAndSpend($worksheetID);
				$lines = $tv->getWorksheetLines($worksheetID);
				$worksheetWeeks = $tv->getWorksheetWeeks($worksheetID);
		
				// Convert to 2-D array
		
				$wsWeeks=array();
		
				foreach ($worksheetWeeks as $line) {
					$wsWeeks[$line["worksheetLine"]][$line["weekNumber"]]=$line["weekValue"];
				}
			
				$calendar  = new \CAL\calendar($this->db);
				
				$repeats = array();		
			
				$repeats["iWeekly"]=1;
				$repeats["iWeekDays"]=2;
				$repeats["dStartDate"]=$campaigns["flightStart"];
				$repeats["dEndDate"]=$campaigns["flightEnd"];
		
				$weeks = array();
				$month = array();
				$months = array();
				
				array_push($weeks, $campaigns["flightStart"]);
		
				$weeks = array_merge($weeks,$calendar->createRepeatingDates($repeats,$campaigns["flightEnd"]));
				
//				error_log("R_Weeks: " . print_r($weeks, true));
		
				$weekNames = array();
				$monthWeeks = array();
		
				$lastMonthWeek = "";

				$broadcastWeeks = $sheet["useBroadcastWeeks"];
		
				if (!$broadcastWeeks) {
		
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
				
				}
				
				else {
				
					$weekNames = array();

					error_log("Week Names 1:" . print_r($weekNames,true));
				
					foreach ($weeks as $week) {
								
						array_push($weekNames, date("M d", strtotime($week)));
						$month["name"]=	date("M", strtotime($week));
		
						if (!$month["weeks"]) {
							$month["weeks"] = array();
							$lastSundayOfMonth = strtotime("last sunday of this month", strtotime($week));
							$currentMonth = date("m",$lastSundayOfMonth);
							error_log("Broadcast Weeks Init - Last Sunday of this month:" . date("Y-m-d",$lastSundayOfMonth));
						}
		
						error_log("Broadcast Weeks - Last Sunday of this month:" . date("Y-m-d",$lastSundayOfMonth));
							error_log("Broadcast Weeks $week " . strtotime($week) . " " . $lastSundayOfMonth);
								
							if (strtotime($week) > $lastSundayOfMonth) {
								$month["weeks"] = array();
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
						array_push($month["weeks"], date("M d", strtotime($week)));
						error_log("Broadcast Weeks - Month: $currentMonth " . date("m", $lastSundayOfMonth) . " = " . date("M d", strtotime($week)));
						$months[$currentMonth] = array("name"=>date("M", $lastSundayOfMonth), "weeks"=>$month["weeks"]);	
					}		
				}	
				
				error_log("Week Names 2:" . print_r($weekNames,true));

				if ($sendOrder) {

					$msgCount = 0;

					error_log("Send Order to TV Reps: " . print_r($orderVendors, true));
				
					include_once("/var/www/html/bluhorn/pdf/tv_insertion_order_new.php");
					foreach ($orderVendors as $vendor) {
						$orderPDF = makePDF($orderInfo, $orderDetails, $worksheetCols, $marketVendors, array($vendor), $sheet, $lines, $weekNames, $wsWeeks, $months, $agencyInfo, $buyer, $campaigns, $clnt, "E");

						$vendorRep = $worksheet->getMarketRepsByVendor($worksheetID, $vendor);
														
						error_log("Sending to " . $vendorRep[0]["emailAddress"]);
						
						$email = new \mg($this->db, "bluhorn.com", "MAIL_ORDER");
												
						$email->from("orders@bluhorn.com");
						
						$cc = $this->auth->getEmailAddress($this->userID);
						if ($cc != "") {
							$email->replyto($cc);
							$email->cc($cc);
						}
						
						$email->to($vendorRep[0]["emailAddress"]);
						$email->subject("Station Order (Rev. $revNumber)");
						$email->contents($orderPDF);
						
						$messageID = $email->send(1, true);
		
						// Carbon Copy Alternative		
								
						$emailcc = new \mg($this->db, "bluhorn.com", "MAIL_ORDER");
						
						$emailcc->from("orders@bluhorn.com");
						
						$emailcc->to($this->auth->getEmailAddress($this->userID));
						
						$vendorName = $vendorRep[0]["vendorName"];
						
						$emailcc->subject("Station Order (Rev. $revNumber) for $vendorName (cc)");
						$emailcc->contents($orderPDF);
								
						$messageID = $emailcc->send(1, true);
						
						// End Carbon Copy Alternative
						
						if ($messageID > 0) {
							$msgCount++;
						}
						
					}
					
					return $msgCount;
				}
				else {
					if ($this->agencyID == 154) {
						
							include_once("/var/www/html/bluhorn/pdf/154/tv_insertion_order.php");
					}
/*
					else if ($this->agencyID == 155) {
					
							include_once("/var/www/html/bluhorn/pdf/155/tv_insertion_order.php");
					}
*/
					else if ($this->agencyID == 148) {
					
							include_once("/var/www/html/bluhorn/pdf/148/tv_insertion_order.php");
					}
					else if ($this->agencyID == 161) {
					
							include_once("/var/www/html/bluhorn/pdf/154/tv_insertion_order.php");
					}
					else if ($this->agencyID == 161) {
					
							include_once("/var/www/html/bluhorn/pdf/154/tv_insertion_order.php");
					}					
					else if ($this->agencyID == 1003) {
					
							include_once("/var/www/html/bluhorn/pdf/1003/tv_insertion_order.php");
					}							
					else {
							include_once("/var/www/html/bluhorn/pdf/tv_insertion_order_new.php");
							makePDF($orderInfo, $orderDetails, $worksheetCols, $marketVendors, $orderVendors, $sheet, $lines, $weekNames, $wsWeeks, $months, $agencyInfo, $buyer, $campaigns, $clnt, "I");
//							return false;
					}
				}
			}
			
			else if ($sheet["vendorType"] == "Cable") {
			
				$cable = new \BH\cable($this->db, $this->agencyID, $this->userID);

				$cable->totalSpotsAndSpend($worksheetID);
				$lines = $cable->getWorksheetLines($worksheetID);
				$worksheetWeeks = $cable->getWorksheetWeeks($worksheetID);
		
				// Convert to 2-D array
		
				$wsWeeks=array();
		
				foreach ($worksheetWeeks as $line) {
					$wsWeeks[$line["worksheetLine"]][$line["weekNumber"]]=$line["weekValue"];
				}
			
				$calendar  = new \CAL\calendar($this->db);
				
				$repeats = array();		
			
				$repeats["iWeekly"]=1;
				$repeats["iWeekDays"]=2;
				$repeats["dStartDate"]=$campaigns["flightStart"];
				$repeats["dEndDate"]=$campaigns["flightEnd"];
		
				$weeks = array();
				$month = array();
				$months = array();
				
				array_push($weeks, $campaigns["flightStart"]);
		
				$weeks = array_merge($weeks,$calendar->createRepeatingDates($repeats,$campaigns["flightEnd"]));
				
		//		error_log(print_r($weeks));
		
				$weekNames = array();
				$monthWeeks = array();
		
				$lastMonthWeek = "";

				$broadcastWeeks = $sheet["useBroadcastWeeks"];
		
				if (!$broadcastWeeks) {
		
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
				}
				
				else {
				
					foreach ($weeks as $week) {
								
						array_push($weekNames, date("M d", strtotime($week)));
						$month["name"]=	date("M", strtotime($week));
		
						if (!$month["weeks"]) {
							$month["weeks"] = array();
							$lastSundayOfMonth = strtotime("last sunday of this month", strtotime($week));
							$currentMonth = date("m",$lastSundayOfMonth);
							error_log("Broadcast Weeks Init - Last Sunday of this month:" . date("Y-m-d",$lastSundayOfMonth));
						}
		
						error_log("Broadcast Weeks - Last Sunday of this month:" . date("Y-m-d",$lastSundayOfMonth));
							error_log("Broadcast Weeks $week " . strtotime($week) . " " . $lastSundayOfMonth);
								
							if (strtotime($week) > $lastSundayOfMonth) {
								$month["weeks"] = array();
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
						array_push($month["weeks"], date("M d", strtotime($week)));
						error_log("Broadcast Weeks - Month: $currentMonth " . date("m", $lastSundayOfMonth) . " = " . date("M d", strtotime($week)));
						$months[$currentMonth] = array("name"=>date("M", $lastSundayOfMonth), "weeks"=>$month["weeks"]);	
					}		
				}	

				if ($sendOrder) {

					$msgCount = 0;

					error_log("Send Order to Cable Reps: " . print_r($orderVendors, true));
				
					include_once("/var/www/html/bluhorn/pdf/cable_insertion_order_new.php");
					foreach ($orderVendors as $vendor) {
						$orderPDF = makePDF($orderInfo, $orderDetails, $worksheetCols, $marketVendors, array($vendor), $sheet, $lines, $weekNames, $wsWeeks, $months, $agencyInfo, $buyer, $campaigns, $clnt, "E");

						$vendorRep = $worksheet->getMarketRepsByVendor($worksheetID, $vendor);
														
						error_log("Sending to " . $vendorRep[0]["emailAddress"]);
						
						$email = new \mg($this->db, "bluhorn.com", "MAIL_ORDER");
												
						$email->from("orders@bluhorn.com");
						
						$cc = $this->auth->getEmailAddress($this->userID);
						if ($cc != "") {
							$email->replyto($cc);
							$email->cc($cc);
						}
						
						$email->to($vendorRep[0]["emailAddress"]);
						$email->subject("Station Order (Rev. $revNumber)");
						$email->contents($orderPDF);
						
						$messageID = $email->send(1, true);
		
						// Carbon Copy Alternative		
								
						$emailcc = new \mg($this->db, "bluhorn.com", "MAIL_ORDER");
						
						$emailcc->from("orders@bluhorn.com");
						
						$emailcc->to($this->auth->getEmailAddress($this->userID));
						
						$vendorName = $vendorRep[0]["vendorName"];
						
						$emailcc->subject("Station Order (Rev. $revNumber) for $vendorName (cc)");
						$emailcc->contents($orderPDF);
								
						$messageID = $emailcc->send(1, true);
						
						// End Carbon Copy Alternative
						
						if ($messageID > 0) {
							$msgCount++;
						}
						
					}
					
					return $msgCount;
				}
				else {				
					if ($this->agencyID == 0) {
						
							include_once("/var/www/html/bluhorn/pdf/154/cable_insertion_order.php");
					}
/*
					else if ($this->agencyID == 148) {
					
							include_once("/var/www/html/bluhorn/pdf/148/cable_insertion_order.php");
					}
*/
/*
					else if ($this->agencyID == 155) {
					
							include_once("/var/www/html/bluhorn/pdf/155/cable_insertion_order.php");
					}
*/
/*
					else if ($this->agencyID == 161) {
					
							include_once("/var/www/html/bluhorn/pdf/154/cable_insertion_order.php");
					}	
*/
/*
					else if ($this->agencyID == 138) {
					
							include_once("/var/www/html/bluhorn/pdf/138/cable_insertion_order.php");
					}
*/
/*
					else if ($this->agencyID == 1003) {
					
							include_once("/var/www/html/bluhorn/pdf/1003/cable_insertion_order.php");
					}
*/											
					else {
							include_once("/var/www/html/bluhorn/pdf/cable_insertion_order_new.php");
							makePDF($orderInfo, $orderDetails, $worksheetCols, $marketVendors, $orderVendors, $sheet, $lines, $weekNames, $wsWeeks, $months, $agencyInfo, $buyer, $campaigns, $clnt, "I");
							return false;	
					}				
				}
			}
			
			else if ($sheet["vendorType"] == "Radio") {
	
				$radio = new \BH\radio($this->db, $this->agencyID, $this->userID);

				$radio->totalSpotsAndSpend($worksheetID);
				$lines = $radio->getWorksheetLines($worksheetID);
				$worksheetWeeks = $radio->getWorksheetWeeks($worksheetID);
		
				// Convert to 2-D array
		
				$wsWeeks=array();
		
				foreach ($worksheetWeeks as $line) {
					$wsWeeks[$line["worksheetLine"]][$line["weekNumber"]]=$line["weekValue"];
				}
			
				$calendar  = new \CAL\calendar($this->db);
				
				$repeats = array();		
			
				$repeats["iWeekly"]=1;
				$repeats["iWeekDays"]=2;
				$repeats["dStartDate"]=$campaigns["flightStart"];
				$repeats["dEndDate"]=$campaigns["flightEnd"];
		
				$weeks = array();
				$month = array();
				$months = array();
				
				array_push($weeks, $campaigns["flightStart"]);
		
				$weeks = array_merge($weeks,$calendar->createRepeatingDates($repeats,$campaigns["flightEnd"]));
				
		//		error_log(print_r($weeks));
		
				$weekNames = array();
				$monthWeeks = array();
		
				$lastMonthWeek = "";
		
				$broadcastWeeks = $sheet["useBroadcastWeeks"];
		
				if (!$broadcastWeeks) {
		
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
				
				}
				
				else {
				
					foreach ($weeks as $week) {
								
						array_push($weekNames, date("M d", strtotime($week)));
						$month["name"]=	date("M", strtotime($week));
		
						if (!$month["weeks"]) {
							$month["weeks"] = array();
							$lastSundayOfMonth = strtotime("last sunday of this month", strtotime($week));
							$currentMonth = date("m",$lastSundayOfMonth);
							error_log("Broadcast Weeks Init - Last Sunday of this month:" . date("Y-m-d",$lastSundayOfMonth));
						}
		
						error_log("Broadcast Weeks - Last Sunday of this month:" . date("Y-m-d",$lastSundayOfMonth));
							error_log("Broadcast Weeks $week " . strtotime($week) . " " . $lastSundayOfMonth);
								
							if (strtotime($week) > $lastSundayOfMonth) {
								$month["weeks"] = array();
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
						array_push($month["weeks"], date("M d", strtotime($week)));
						error_log("Broadcast Weeks - Month: $currentMonth " . date("m", $lastSundayOfMonth) . " = " . date("M d", strtotime($week)));
						$months[$currentMonth] = array("name"=>date("M", $lastSundayOfMonth), "weeks"=>$month["weeks"]);	
					}		
				}

				if ($sendOrder) {

					$msgCount = 0;

					error_log("Send Order to Radio Reps: " . print_r($orderVendors, true));
				
					include_once("/var/www/html/bluhorn/pdf/radio_insertion_order_new.php");
					foreach ($orderVendors as $vendor) {
						$orderPDF = makePDF($orderInfo, $orderDetails, $worksheetCols, $marketVendors, array($vendor), $sheet, $lines, $weekNames, $wsWeeks, $months, $agencyInfo, $buyer, $campaigns, $clnt, "E");

						$vendorRep = $worksheet->getMarketRepsByVendor($worksheetID, $vendor);
														
						error_log("Sending to " . $vendorRep[0]["emailAddress"]);
						
						$email = new \mg($this->db, "bluhorn.com", "MAIL_ORDER");
												
						$email->from("orders@bluhorn.com");
						
						$cc = $this->auth->getEmailAddress($this->userID);
						if ($cc != "") {
							$email->replyto($cc);
							$email->cc($cc);
						}
						
						$email->to($vendorRep[0]["emailAddress"]);
						$email->subject("Station Order (Rev. $revNumber)");
						$email->contents($orderPDF);
						
						$messageID = $email->send(1, true);
		
						// Carbon Copy Alternative		
								
						$emailcc = new \mg($this->db, "bluhorn.com", "MAIL_ORDER");
						
						$emailcc->from("orders@bluhorn.com");
						
						$emailcc->to($this->auth->getEmailAddress($this->userID));
						
						$vendorName = $vendorRep[0]["vendorName"];
						
						$emailcc->subject("Station Order (Rev. $revNumber) for $vendorName (cc)");
						$emailcc->contents($orderPDF);
								
						$messageID = $emailcc->send(1, true);
						
						// End Carbon Copy Alternative
						
						if ($messageID > 0) {
							$msgCount++;
						}
						
					}
					
					return $msgCount;
				}
				else {
					if ($this->agencyID == 0) {
						
							include_once("/var/www/html/bluhorn/pdf/154/radio_insertion_order.php");
					}
/*
					else if ($this->agencyID == 148) {
					
							include_once("/var/www/html/bluhorn/pdf/148/radio_insertion_order.php");
					}
					else if ($this->agencyID == 161) {
					
							include_once("/var/www/html/bluhorn/pdf/154/radio_insertion_order.php");
					}	
					else if ($this->agencyID == 1003) {
					
							include_once("/var/www/html/bluhorn/pdf/1003/radio_insertion_order.php");
					}	
*/
/*
					else if ($this->agencyID == 138) {
					
							include_once("/var/www/html/bluhorn/pdf/138/radio_insertion_order.php");
					}
*/							
					else {
							include_once("/var/www/html/bluhorn/pdf/radio_insertion_order_new.php");
							makePDF($orderInfo, $orderDetails, $worksheetCols, $marketVendors, $orderVendors, $sheet, $lines, $weekNames, $wsWeeks, $months, $agencyInfo, $buyer, $campaigns, $clnt, "I");
							return false;	
					}	
				}									
			}

			else if ($sheet["vendorType"] == "Prnt") {
	
				$prnt = new \BH\prnt($this->db, $this->agencyID, $this->userID);

				$prnt->totalSpotsAndSpend($worksheetID);

				$lines = $prnt->getWorksheetLines($worksheetID);
						
				if ($sendOrder) {

					$msgCount = 0;

					error_log("Send Order to Prnt Reps: " . print_r($orderVendors, true));
				
					include_once("/var/www/html/bluhorn/pdf/prnt_insertion_order_new.php");
					foreach ($orderVendors as $vendor) {
						$orderPDF = makePDF($orderInfo, $orderDetails, $worksheetCols, $marketVendors, array($vendor), $sheet, $lines, $agencyInfo, $buyer, $campaigns, $clnt, "E");

						$vendorRep = $worksheet->getMarketRepsByVendor($worksheetID, $vendor);
														
						error_log("Sending to " . $vendorRep[0]["emailAddress"]);
						
						$email = new \mg($this->db, "bluhorn.com", "MAIL_ORDER");
												
						$email->from("orders@bluhorn.com");
						
						$cc = $this->auth->getEmailAddress($this->userID);
						if ($cc != "") {
							$email->replyto($cc);
							$email->cc($cc);
						}
						
						$email->to($vendorRep[0]["emailAddress"]);
						$email->subject("Station Order (Rev. $revNumber)");
						$email->contents($orderPDF);
						
						$messageID = $email->send(1, true);
		
						// Carbon Copy Alternative		
								
						$emailcc = new \mg($this->db, "bluhorn.com", "MAIL_ORDER");
						
						$emailcc->from("orders@bluhorn.com");
						
						$emailcc->to($this->auth->getEmailAddress($this->userID));
						
						$vendorName = $vendorRep[0]["vendorName"];
						
						$emailcc->subject("Station Order (Rev. $revNumber) for $vendorName (cc)");
						$emailcc->contents($orderPDF);
								
						$messageID = $emailcc->send(1, true);
						
						// End Carbon Copy Alternative
						
						if ($messageID > 0) {
							$msgCount++;
						}
						
					}
					
					return $msgCount;
				}
				else {			
					include_once("/var/www/html/bluhorn/pdf/prnt_insertion_order_new.php");
					makePDF($orderInfo, $orderDetails, $worksheetCols, $marketVendors, $orderVendors, $sheet, $lines, $agencyInfo, $buyer, $campaigns, $clnt, "I");
				}
			}

			else if ($sheet["vendorType"] == "Digital") {
	
				$digital = new \BH\digital($this->db, $this->agencyID, $this->userID);

				$digital->totalSpotsAndSpend($worksheetID);

				$lines = $digital->getWorksheetLines($worksheetID);


				if ($sendOrder) {

					$msgCount = 0;

					error_log("Send Order to TV Reps: " . print_r($orderVendors, true));
				
					include_once("/var/www/html/bluhorn/pdf/digital_insertion_order_new.php");
					foreach ($orderVendors as $vendor) {
						$orderPDF = makePDF($orderInfo, $orderDetails, $worksheetCols, $marketVendors, array($vendor), $sheet, $lines, $agencyInfo, $buyer, $campaigns, $clnt, "E");

						$vendorRep = $worksheet->getMarketRepsByVendor($worksheetID, $vendor);
														
						error_log("Sending to " . $vendorRep[0]["emailAddress"]);
						
						$email = new \mg($this->db, "bluhorn.com", "MAIL_ORDER");
												
						$email->from("orders@bluhorn.com");
						
						$cc = $this->auth->getEmailAddress($this->userID);
						if ($cc != "") {
							$email->replyto($cc);
							$email->cc($cc);
						}
						
						$email->to($vendorRep[0]["emailAddress"]);
						$email->subject("Station Order (Rev. $revNumber)");
						$email->contents($orderPDF);
						
						$messageID = $email->send(1, true);
		
						// Carbon Copy Alternative		
								
						$emailcc = new \mg($this->db, "bluhorn.com", "MAIL_ORDER");
						
						$emailcc->from("orders@bluhorn.com");
						
						$emailcc->to($this->auth->getEmailAddress($this->userID));
						
						$vendorName = $vendorRep[0]["vendorName"];
						
						$emailcc->subject("Station Order (Rev. $revNumber) for $vendorName (cc)");
						$emailcc->contents($orderPDF);
								
						$messageID = $emailcc->send(1, true);
						
						// End Carbon Copy Alternative
						
						if ($messageID > 0) {
							$msgCount++;
						}
						
					}
					
					return $msgCount;
				}
				else {							
					include_once("/var/www/html/bluhorn/pdf/digital_insertion_order_new.php");
					makePDF($orderInfo, $orderDetails, $worksheetCols, $marketVendors, $orderVendors, $sheet, $lines, $agencyInfo, $buyer, $campaigns, $clnt, "I");
				}
			}

			else if ($sheet["vendorType"] == "Outdoor") {
	
				$outdoor = new \BH\outdoor($this->db, $this->agencyID, $this->userID);

				$outdoor->totalSpotsAndSpend($worksheetID);

				$lines = $outdoor->getWorksheetLines($worksheetID);

				if ($sendOrder) {

					$msgCount = 0;

					error_log("Send Order to TV Reps: " . print_r($orderVendors, true));
				
					include_once("/var/www/html/bluhorn/pdf/outdoor_insertion_order_new.php");
					foreach ($orderVendors as $vendor) {
						$orderPDF = makePDF($orderInfo, $orderDetails, $worksheetCols, $marketVendors, array($vendor), $sheet, $lines, $agencyInfo, $buyer, $campaigns, $clnt, "E");

						$vendorRep = $worksheet->getMarketRepsByVendor($worksheetID, $vendor);
														
						error_log("Sending to " . $vendorRep[0]["emailAddress"]);
						
						$email = new \mg($this->db, "bluhorn.com", "MAIL_ORDER");
												
						$email->from("orders@bluhorn.com");
						
						$cc = $this->auth->getEmailAddress($this->userID);
						if ($cc != "") {
							$email->replyto($cc);
							$email->cc($cc);
						}
						
						$email->to($vendorRep[0]["emailAddress"]);
						$email->subject("Station Order (Rev. $revNumber)");
						$email->contents($orderPDF);
						
						$messageID = $email->send(1, true);
		
						// Carbon Copy Alternative		
								
						$emailcc = new \mg($this->db, "bluhorn.com", "MAIL_ORDER");
						
						$emailcc->from("orders@bluhorn.com");
						
						$emailcc->to($this->auth->getEmailAddress($this->userID));
						
						$vendorName = $vendorRep[0]["vendorName"];
						
						$emailcc->subject("Station Order (Rev. $revNumber) for $vendorName (cc)");
						$emailcc->contents($orderPDF);
								
						$messageID = $emailcc->send(1, true);
						
						// End Carbon Copy Alternative
						
						if ($messageID > 0) {
							$msgCount++;
						}
						
					}
					
					return $msgCount;
				}
				else {							
					include_once("/var/www/html/bluhorn/pdf/outdoor_insertion_order_new.php");
					makePDF($orderInfo, $orderDetails, $worksheetCols, $marketVendors, $orderVendors, $sheet, $lines, $agencyInfo, $buyer, $campaigns, $clnt, "I");
					return false;
				}
			}
	
	//		error_log("Months:" . print_r($months) );
								
			return false;
		}
		
		return false;
		
	}
	

	public function create($params) {
		
	if ($this->auth->validate($this->userID)) {

		$form = new \forms($this->db);
						
	   	$newCampaign = $form->map($this->fields, $_POST);
	   	  
		$bhUser = new \BH\user($this->db, $this->userID); 
		  
		$this->agencyID = $bhUser->getAgencyID();
		  
	    error_log("BH agencyID:" . $this->agencyID);

	    $client = new \BH\client($this->db, $this->agencyID, $this->userID);
	
		$this->vars["clients"] = $client->getAllClients();
		  
	    $campaign = new \BH\campaign($this->db, $this->agencyID, $this->userID);

	    $worksheet = new \BH\worksheet($this->db, $this->agencyID, $this->userID);
	    	
		$this->view = "campaign-create";	
		
		if (($params[2] == "new") and ($newCampaign["name"] != "") and (intval($newCampaign["clientID"])>0)) {
			
			$campaignID =  $campaign->addCampaign($newCampaign);
	
			$this->vars["active"] = "campaigns";		
			
			if ($campaignID>0) {			
				$this->vars["alert"]["success"] = "Campaign Added Succesfully. (id: $campaignID)";
				$this->vars["campaign"] = $campaign->getCampaign($campaignID);
				$this->view = "campaign-edit";			
			}
			else {			  
				$this->vars["alert"]["error"] = "Campaign Not Added. Name already exists for that Client.";
				$this->vars["campaign"] = $newCampaign;
				$this->vars["campaignNameError"] = true;
				$this->view = "campaign-create";
	
			}
			
			return true;	
		}
		else {
			return true;
		}
	 }
	 else {
		 return false;
	 }
	}
	
	public function edit($params) {
		
	if ($this->auth->validate($this->userID)) {
	
		$this->view = "campaign-edit";		
		
		$form = new \forms($this->db);
		
		$campaignID	= $params[2];				
						
	   	$newCampaign = $form->map($this->fields, $_POST);
	   	  
		$bhUser = new \BH\user($this->db, $this->userID); 
		  
		$this->agencyID = $bhUser->getAgencyID();

		$this->vars["agencyID"] = $this->agencyID;
		  
	    error_log("BH agencyID:" . $this->agencyID);

	    $client = new \BH\client($this->db, $this->agencyID, $this->userID);
	
		$this->vars["clients"] = $client->getAllClients();
		  
	    $campaign = new \BH\campaign($this->db, $this->agencyID, $this->userID);	
	    $market = new \BH\market($this->db, $this->agencyID, $this->userID);	
	    $vendor = new \BH\vendor($this->db, $this->agencyID, $this->userID);	
	    $worksheet = new \BH\worksheet($this->db, $this->agencyID, $this->userID);	
	
		$this->vars["campaign"] = $campaign->getCampaign($campaignID);
		$this->vars["marketTypes"] = $market->getMarketTypes();
		$this->vars["markets"] = $market->getAllMarkets(true);
		$this->vars["worksheets"] = $worksheet->getAllWorksheetsByCampaignID($campaignID);
		

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
	
		
	public function ajax($params) {
	
	 error_log("Orders AJAX");
	
	 if ($this->auth->validate($this->userID)) {
		  
		  if ($params[2] == "create") {
		  		  
			  $bhUser = new \BH\user($this->db, $this->userID); 
			  
			  $this->agencyID = $bhUser->getAgencyID();
		  	
			  $form = new \forms($this->db);
					  
			  $worksheetID = $params[4];
		
			  $orderType = strtoupper($params[3]);
		
			  $newOrder = $form->map($this->fields["order"], $_POST);

			  $newOrderVendors = $_POST["vendor"];

			  $newOrderDetails = $form->map($this->fields[strtolower($orderType)], $_POST);
		
			  $order = new \BH\order($this->db, $this->agencyID, $this->userID);
			  
			  $worksheet = new \BH\worksheet($this->db, $this->agencyID, $this->userID);
		
			  $orderID =  $order->create($worksheetID, $newOrder, $newOrderVendors, $orderType, $newOrderDetails);
			  $orderKey =  $order->getOrderKeyByOrderID($orderID);
			  
			  $this->view = "ajax-response";	
			  
			  $response = array();	
		
			  if ($orderID>0) {
				  	$worksheet->isOrdered($worksheetID, true);
				  
			  		$response["message"] = "Order Created!";
			  		$response["orderID"] = $orderID;
			  		$response["worksheetID"] = $worksheetID;
			  		$response["orderKey"] = $orderKey;
			  		$this->vars["response"] = json_encode($response);
				  	return true;
			  }
			  else {
			  		$response["message"] = "<span style='color:#f00'>Error Creating Order.</span>";
			  		$response["error"] = true;
			  		$this->vars["response"] = json_encode($response);		
				  	return true;
			  }
		  }

		  else if ($params[2] == "preview") {
		  		  
			  $bhUser = new \BH\user($this->db, $this->userID); 
			  
			  $this->agencyID = $bhUser->getAgencyID();
		  	
			  $form = new \forms($this->db);
					  
			  $worksheetID = $params[4];
		
			  $orderType = strtoupper($params[3]);
		
			  $newOrder = $form->map($this->fields["order"], $_POST);

			  $newOrderVendors = $_POST["vendor"];

			  $newOrderDetails = $form->map($this->fields[strtolower($orderType)], $_POST);
		
			  $order = new \BH\order($this->db, $this->agencyID, $this->userID);
			  
			  $worksheet = new \BH\worksheet($this->db, $this->agencyID, $this->userID);
		
			  $orderID =  $order->preview($worksheetID, $newOrder, $newOrderVendors, $orderType, $newOrderDetails);
			  $orderKey =  $order->getOrderKeyByOrderID($orderID);
			  
			  $this->view = "ajax-response";	
			  
			  $response = array();	
		
			  if ($orderID>0) {
			  				  
			  		$response["message"] = "Order Previewed!";
			  		$response["orderID"] = $orderID;
			  		$response["worksheetID"] = $worksheetID;
			  		$response["orderKey"] = $orderKey;
			  		$this->vars["response"] = json_encode($response);
				  	return true;
			  }
			  else {
			  		$response["message"] = "<span style='color:#f00'>Error Previewing Order.</span>";
			  		$response["error"] = true;
			  		$this->vars["response"] = json_encode($response);		
				  	return true;
			  }
		  }

		  else if ($params[2] == "deliver") {
		  		  
			  $msgCount = $this->deliver($params);
			  
			  $worksheetID = $params[4];

			  $this->view = "ajax-response";	
			  
			  $response = array();	
		
			  if ($msgCount>0) {
			  			  				  
			  		if ($msgCount > 1) {
				  		$vendorStr = "vendors";
			  		}			  
			  		else {
				  		$vendorStr = "vendor";
			  		}
			  		
			  		$response["message"] = "Order Sent! ($msgCount $vendorStr)";
			  		$response["msgCount"] = $msgCount;
			  		$response["worksheetID"] = $worksheetID;
			  		$response["orderKey"] = $orderKey;
			  		$this->vars["response"] = json_encode($response);
			  		
				  	return true;
			  }
			  else {
			  		$response["message"] = "<span style='color:#f00'>Error Sending Order.</span>";
			  		$response["error"] = true;
			  		$this->vars["response"] = json_encode($response);	
			  			
				  	return true;
			  }
		  }	
		  		  
		  else if ($params[2] == "cancel") {
		  		  
			  $bhUser = new \BH\user($this->db, $this->userID); 
			  
			  $this->agencyID = $bhUser->getAgencyID();
		  	
			  $form = new \forms($this->db);
					  
			  $worksheetID = $params[3];
		
			  $orderType = strtoupper($params[3]);
		
			  $newOrder = $form->map($this->fields["order"], $_POST);

			  $newOrderVendors = $_POST["vendor"];

			  $newOrderDetails = $form->map($this->fields[strtolower($orderType)], $_POST);
		
			  $order = new \BH\order($this->db, $this->agencyID, $this->userID);
			  
			  $worksheet = new \BH\worksheet($this->db, $this->agencyID, $this->userID);
		
			  $cancelled =  $order->cancel($worksheetID);
			  
			  $this->view = "ajax-response";	
			  
			  $response = array();	
		
			  if ($cancelled) {

				  	$worksheet->isCancelled($worksheetID, true);
			  				  
			  		$response["cancelled"] = true;
			  		$response["message"] = "Order Cancelled.";
			  		$response["timestamp"] = date("Y-m-d H:i:s",strtotime("now"));
			  		$response["worksheetID"] = $worksheetID;
			  		$this->vars["response"] = json_encode($response);
				  	return true;
			  }
			  else {
			  		$response["message"] = "<span style='color:#f00'>Unable to cancel order.</span>";
			  		$response["error"] = true;
			  		$this->vars["response"] = json_encode($response);		
				  	return true;
			  }
		  }		  

		  else if ($params[2] == "send") {
		  		  
			  $bhUser = new \BH\user($this->db, $this->userID); 
			  
			  $this->agencyID = $bhUser->getAgencyID();
		  	
			  $form = new \forms($this->db);
					  
			  $worksheetID = $params[3];
			  $orderID = $params[4];
			  $orderKey = $params[5];
		
			  $order = new \BH\order($this->db, $this->agencyID, $this->userID);
			  
			  $worksheet = new \BH\worksheet($this->db, $this->agencyID, $this->userID);
			  
			  $vendor = new \BH\vendor($this->db, $this->agencyID, $this->userID);
	
			  $template = new \template($this->db,"send-order");
	
			  $vendors = $order->getOrderVendorsByOrderID($order->getOrderIDByKey($orderKey));
			  					  
			  $this->view = "ajax-response";	
			  
			  $response = array();	
		
			  if (count($vendors)) {
			  				  
			  		$vendorRep = array();
			  				  
			  		foreach ($vendors as $vendor) {
				  		
				  		array_push($vendorRep,$worksheet->getMarketRepsByVendor($worksheetID, $vendor));
				  		
			  		}		  
			  				  
			  		$response["vendors"] = $vendors;
			  		$response["vendorRep"] = $vendorRep;
			  		$response["worksheetID"] = $worksheetID;
			  		$response["emailAddress"] = $this->auth->getEmailAddress($this->userID);

			  		$response["content"] = $template->fetch($response);
			  		$this->vars["response"] = json_encode($response);
			  		
				  	return true;
			  }
			  else {
			  		$response["content"] = "<span style='color:#f00'>No email addresses found. Make sure vendors are selected.</span>";
			  		$response["worksheetID"] = $worksheetID;
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
