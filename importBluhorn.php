<?php

  define("BASEDIR", "/var/www/html/bluhorn/");
  define("FLXDIR", "/var/www/html/lib/filelogix/");
  define("CLASSDIR", "classes/");
  define("CUSTOMDIR", "custom/");
  define("PLUGINSDIR", "plugins/");
  define("BHDIR", "BH/");
  define("CALDIR", "CAL/");
  define("FORMSDIR", "CAL/");
  define("DB", "bluhorn");
  define("DBOLD", "BluHorn");
  define("BHUSERID", "8");
  define("AGENCYID", "141");


  error_reporting(E_ALL);
//  error_reporting(0);
  
  date_default_timezone_set('America/New_York');
  
  set_exception_handler(myException);
  
	//  error_reporting(0);
	//  error_log("debugging " . DB);
  
    // *nix style (note capital 'S')
   
//  require("/var/www/html/buzz/classes/CAL/calendar.class");  
    
  try {	
	  function __autoload($className) {
		  error_log("looking for $className");
		  $class_name = end(explode("\\", $className));
		  

		  if ($class_name != $className) { // this is for custom namespaces

			$length = strlen($className)-strlen($class_name);
			$namespace = substr($className, 0, $length);
			$namespaceDir = str_replace("\\", "/", $namespace);

			error_log("updated looking for $class_name in $namespaceDir");

	  	  	if (file_exists(CLASSDIR . $namespaceDir . $class_name . '.class.php')) {	  	  
		  			error_log("Loading $class_name from " . CLASSDIR . $namespaceDir);
		  			include_once (CLASSDIR . $namespaceDir .  $class_name . '.class.php');
		  	}
	  	  	elseif (file_exists(CLASSDIR . $namespaceDir . $class_name . '.controller.php')) {	  	  
		  			error_log("Loading $class_name" . ".controller.php from " . CLASSDIR . $namespaceDir);
		  			include_once (CLASSDIR . $namespaceDir .  $class_name . '.controller.php');
		  	}
	  	  	elseif (file_exists(FLXDIR . CLASSDIR . $namespaceDir . $class_name . '.controller.php')) {	  	  
		  			error_log("Loading $class_name" . ".controller.php from " . FLXDIR . CLASSDIR . $namespaceDir);
		  			include_once (FLXDIR . CLASSDIR . $namespaceDir .  $class_name . '.controller.php');
		  	}		  
	  	  	elseif (file_exists(FLXDIR . CLASSDIR . $namespaceDir . $class_name . '.class.php')) {	  	  
		  			error_log("Loading $class_name" . ".class.php from " . FLXDIR . CLASSDIR . $namespaceDir);
		  			include_once (FLXDIR . CLASSDIR . $namespaceDir .  $class_name . '.class.php');
		  	}		  
		  }
		  
		  else { // this is for standard namespaces

  			  error_log("looking for $class_name in standard namespace.");

		  	  if (file_exists(CLASSDIR . "controllers/" . $class_name . '.controller.php')) {
			  		error_log("Loading $class_name" . ".controller.php from " . CLASSDIR);
			    	include_once (CLASSDIR . "controllers/" . $class_name . '.controller.php');
		      }
		  	  elseif (file_exists(CLASSDIR . $class_name . '.class.php')) {	  	  
			  		error_log("Loading $class_name from " . CLASSDIR);
			  	  	include_once (CLASSDIR . $class_name . '.class.php');
			  }
		 	  elseif (file_exists(CLASSDIR . "controllers/" . $class_name . '.controller.php')) {
			  		error_log("Loading controllers/$class_name from " . CLASSDIR);
			    	include_once (CLASSDIR . "controllers/" . $class_name . '.controller.php');
		      }
			  elseif (file_exists(CUSTOMDIR . $class_name . '.class.php')) {
			  		error_log("Loading $class_name from " . CUSTOMDIR);
			    	include_once (CUSTOMDIR . $class_name . '.class.php');
		      }
		  	  elseif (file_exists(FLXDIR . CLASSDIR . "controllers/" . $class_name . '.controller.php')) {
			  		error_log("Loading controllers/$class_name from " . FLXDIR . CLASSDIR);
			    	include_once (FLXDIR . CLASSDIR . "controllers/" . $class_name . '.controller.php');
		      }
		  	  elseif (file_exists(FLXDIR . CLASSDIR . $class_name . '.class.php')) {	  	  
			  		error_log("Loading $class_name from " . FLXDIR . CLASSDIR);
			  	  	include_once (FLXDIR . CLASSDIR . $class_name . '.class.php');
			  }
		  	  elseif (file_exists(SMARTY_DIR . $class_name . '.php')) {
			  		error_log("Loading $class_name from " . SMARTYDIR);
			    	include_once (SMARTY_DIR . $class_name . '.php');
		      }
		  	  elseif (file_exists(SMARTY_DIR . "plugins/" . strtolower($class_name) . '.php')) {
			  		error_log("Loading plugins/$class_name from " . SMARTYDIR);
			    	include_once (SMARTY_DIR . "plugins/" . strtolower($class_name) . '.php');
		      }
		  	  elseif (file_exists(SMARTY_DIR . "sysplugins/" . strtolower($class_name) . '.php')) {
			  		error_log("Loading sysplugins/$class_name from " . SMARTYDIR);
			    	include_once (SMARTY_DIR . "sysplugins/" . strtolower($class_name) . '.php');
		      }
		      elseif (file_exists(CLASSDIR . FORMSDIR . $class_name . '.class.php')) {
			  		error_log("Loading $class_name from " . CLASSDIR . FORMSDIR);
			    	include_once (CLASSDIR . FORMSDIR . $class_name . '.class.php');
		      }
		      elseif (file_exists(PLUGINSDIR . $class_name . '.class.php')) {
			  		error_log("Loading $class_name from " . PLUGINSDIR);
			    	include_once (PLUGINSDIR . $class_name . '.class.php');
		      }	      
		      else {
			  		error_log("Error loading $class_name.");
			        throw new Exception("Error loading $class_name library.");		      
		      }	
		}

	  }
    
	  $dbNew=new database("mysql:host=localhost;dbname=" . DB, "root", "", NULL);
	  $dbOld=new database("mysql:host=localhost;dbname=" . DBOLD, "root", "", NULL);

	  $client = new \BH\client($dbNew, AGENCYID, BHUSERID);
	  $vendor = new \BH\vendor($dbNew, AGENCYID, BHUSERID);
	  $market = new \BH\market($dbNew, AGENCYID, BHUSERID);
	  $campaign = new \BH\campaign($dbNew, AGENCYID, BHUSERID);
	  $worksheet = new \BH\worksheet($dbNew, AGENCYID, BHUSERID);

/*
	  $calendars=$dbBuzz->query("select * from CAL_EVENT");
		
	  $results=$calendars->fetch(\PDO::FETCH_ASSOC);
	
	  var_dump($results);

	  $calendars=$dbOld->query("select * from events");

	  $results=$calendars->fetch(\PDO::FETCH_ASSOC);
		
	  var_dump($results);
*/

// Get Regions for Lookup purposes

	  $oldVendors=$dbOld->query("select * from tbl_Vendors where AgencyID = \"" . AGENCYID . "\"");
	  	  
	  foreach ($oldVendors as $oldVendor) {
		  $vendors = array();
	  	  $vendors["source"] = "bluhorn-import";
		  $vendors["id"] = $oldVendor["VendorID"];
		  $vendors["refID"] = $oldVendor["VendorID"];
		  $vendors["vendorType"] = $oldVendor["VendorTypeID"];
		  $vendors["agencyID"] = $oldVendor["AgencyID"];
		  $vendors["name"] = $oldVendor["VName"];
		  $vendors["address"] = $oldVendor["VAddressLine1"];
		  if ($oldVendor["VAddressLine2"]) {
			$vendors["address"] .= "\n" . $oldVendor["VAddressLine2"];  	
		  }
		  if ($oldVendor["VCity"]) {
			$vendors["address"] .= "\n" . $oldVendor["VCity"] . ", " . $oldVendor["VState"] . " " . $oldVendor["VZip"];  	
		  }
		  if ($oldVendor["VInactive"] > 0) {
			$vendors["isActive"] = "0";  	
		  }
		  $vendorID = $vendor->addVendor($vendors);
		  
		  $oldMarkets=$dbOld->query("select * from tbl_VendorMarkets where VendorID = \"" . $vendors["vendorID"] . "\"");
		  	  
		  foreach ($oldMarkets as $oldMarket) {
			  $markets = array();
		  	  $markets["source"] = "bluhorn-import";
			  $markets["vendorID"] = $oldMarket["VendorID"];
			  $markets["id"] = $oldMarket["VendorMarketID"];
			  $markets["refID"] = $oldMarket["VendorMarketID"];
			  $markets["name"] = $oldMarket["VMName"];
			  $markets["agencyID"] = AGENCYID;

			  $marketID = $market->addMarket($markets);
	
			  $oldMarketReps=$dbOld->query("select * from tbl_VendorMarketReps where VendorMarketID = \"" . $markets["marketID"] . "\"");
			  	  
			  foreach ($oldMarketReps as $oldMarketRep) {
				  $marketReps = array();
			  	  $marketReps["source"] = "bluhorn-import";
				  $marketReps["marketID"] = $oldMarket["VendorMarketID"];
				  $marketReps["refID"] = $oldMarketRep["VendorMarketRepID"];
				  $marketReps["id"] = $oldMarketRep["VendorMarketRepID"];
				  $marketReps["contactName"] = $oldMarket["VMRName"];
				  $marketReps["emailAddress"] = $oldMarket["VMREmail"];
				  $marketReps["phoneNumber"] = $oldMarket["VMRPhone"];
				  $marketReps["faxNumber"] = $oldMarket["VMRFax"];
				  $marketReps["agencyID"] = AGENCYID;
	
				  $marketID = $market->addMarketRep($marketReps);
		
			  }
			  

		  }
	  }

	  $oldClients=$dbOld->query("select * from tbl_Clients where AgencyID = \"" . AGENCYID . "\"");
	  	  
	  foreach ($oldClients as $oldClient) {
		  $clients = array();
	  	  $clients["source"] = "bluhorn-import";
		  $clients["id"] = $oldClient["ClientID"];
		  $clients["refID"] = $oldClient["ClientID"];
		  $clients["agencyID"] = $oldClient["AgencyID"];
		  $clients["name"] = $oldClient["CName"];
		  $clients["contactName"] = $oldClient["CContactName"];
		  $clients["phoneNumber"] = $oldClient["CPhone"];
		  $clients["faxNumber"] = $oldClient["CFax"];
		  $clients["emailAddress"] = $oldClient["CContactEmail"];
		  $clients["notes"] = $oldClient["CNotes"];
		  $clients["address"] = $oldClient["CAddressLine1"];
		  if ($oldClient["CAddressLine2"]) {
			$clients["address"] .= "\n" . $oldClient["CAddressLine2"];  	
		  }
		  if ($oldClient["CCity"]) {
			$clients["address"] .= "\n" . $oldClient["CCity"] . ", " . $oldClient["CState"] . " " . $oldClient["CZip"];  	
		  }


		  $clientID = $client->addClient($clients);

	  }	  

	  $oldCampaigns=$dbOld->query("select * from tbl_Campaigns where AgencyID = \"" . AGENCYID . "\"");
	  	  
	  foreach ($oldCampaigns as $oldCampaign) {
		  $campaigns = array();
	  	  $campaigns["source"] = "bluhorn-import";
		  $campaigns["id"] = $oldCampaign["CampaignID"];
		  $campaigns["refID"] = $oldCampaign["CampaignID"];
		  $campaigns["agencyID"] = $oldCampaign["AgencyID"];
		  $campaigns["name"] = $oldCampaign["CName"];
		  $campaigns["clientID"] = $oldCampaign["ClientID"];
		  $campaigns["flightStart"] = date('Y-m-d',strtotime($oldCampaign["CFlightStartDate"]));
		  $campaigns["flightEnd"] = date('Y-m-d',strtotime($oldCampaign["CFlightEndDate"]));
		  $campaigns["commission"] = $oldClient["CAgencyCommission"];
		  $campaigns["jobNumber"] = $oldClient["CJobNumber"];
		  $campaigns["remarks"] = $oldClient["CRemarks"];
		  $campaigns["traffic"] = $oldClient["CTraffic"];

		  $campaignID = $client->addCampaign($campaigns);

		  $oldWorksheets=$dbOld->query("select tbl_CampaignUnratedTVVVendors.*, tbl_Vendors.AgencyID as AgencyID, tbl_CampaignUnratedTVMarketVendors.CampaignID as CampaignID from tbl_CampaignUnratedTVVendors left join tbl_CampaignUnratedTVMarketVendors using (tbl_CampaignUnratedTVMarketVendors.CampaignUnratedTVMarketVendorID = tbl_CampaignUnratedTVVendors.CampaignUnratedTVMarketVendorID) left join tbl_Vendors using (tbl_Vendors.VendorID = tbl_CampaignUnratedTVVendors.VendorID) where tbl_Vendors.AgencyID = \"" . AGENCYID . "\" and tbl_CampaignUnratedTVMarketVendors.CampaignID = \"" . $campaigns["id"] . "\"");
		  	  
		  foreach ($oldWorksheets as $oldWorksheet) {
			  $worksheets = array();
		  	  $worksheets["source"] = "bluhorn-import";
			  $worksheets["id"] = $oldWorksheet["CampaignUnratedTVMarketVendorID"];
			  $worksheets["refID"] = $oldWorksheet["CampaignUnratedTVMarketVendorID"];
			  $worksheets["agencyID"] = $oldWorksheet["AgencyID"];
			  $worksheets["campaignID"] = $oldWorksheet["CampaignID"];
			  $worksheets["marketID"] = $oldWorksheet["VendorMarketID"];
			  $worksheets["vendorID"] = $oldWorksheet["VendorID"];
			  $worksheets["name"] = "";
	
			  $worksheetID = $worksheet->addWorksheet($worksheetss);

			  $oldWorksheetLines=$dbOld->query("select * from CampaignUnratedTVPrebuyWorksheets where CampaignUnratedTVMarketVendorID = \"" . $worksheets["id"] . "\"");
			  	  
			  $lineNumber = 1;	  
			  	  
			  foreach ($oldWorksheetLines as $oldWorksheetLines) {
				  $worksheetLines = array();
			  	  $worksheetLines["source"] = "bluhorn-import";
				  $worksheetLines["id"] = $oldWorksheetLine["CampaignUnratedTVPrebuyWorksheetID"];
				  $worksheetLines["refID"] = $oldWorksheetLine["CampaignUnratedTVPrebuyWorksheetID"];
				  $worksheetLines["agencyID"] = $worksheets["agencyID"];
				  $worksheetLines["worksheetID"] = $worksheets["id"];
				  $worksheetLines["worksheetLine"] = $lineNumber++;
				  $worksheetLines["daypart"] = $oldWorksheetLine["CUTVPWDayPart"];
				  $worksheetLines["station"] = $oldWorksheetLine["CUTVPWStationCAllLetters"];
				  $worksheetLines["timePeriod"] = $oldWorksheetLine["CUTVPWTimePeriod"];
		
//				  $worksheetLineID = $worksheet->addWorksheet($worksheetLines);
		
			  }	
	
		  }

	  }	


  }
  catch (Exception $e) {
	  echo "Error occurred while loading $class_name library." . $e->getMessage(); 
  }


  function myException($exception) {
  	echo "<b>Exception:</b> " , $exception->getMessage();
  }


	function geocode($string){
	 
	   $string = str_replace (" ", "+", urlencode($string));
	   $details_url = "http://maps.googleapis.com/maps/api/geocode/json?address=".$string."&sensor=false";
	 
	   $ch = curl_init();
	   curl_setopt($ch, CURLOPT_URL, $details_url);
	   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	   $response = json_decode(curl_exec($ch), true);
	 
	   // If Status Code is ZERO_RESULTS, OVER_QUERY_LIMIT, REQUEST_DENIED or INVALID_REQUEST
	   if ($response['status'] != 'OK') {
	    return null;
	   }
	 
	   print_r($response);
	   $geometry = $response['results'][0]['geometry'];
	 
	    $longitude = $geometry['location']['lat'];
	    $latitude = $geometry['location']['lng'];
	 
	    $array = array(
	        'latitude' => $geometry['location']['lat'],
	        'longitude' => $geometry['location']['lng'],
	        'location_type' => $geometry['location_type'],
	    );
	 
	    return $array;
	 
	}
 
 
?>