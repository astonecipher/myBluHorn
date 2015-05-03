<?php

/**
 * FILELOGIX BLUHORN STRIPE CLASS
 *  
 * @author Wes Benwick
 * @link http://www.filelogix.com
 * @license Part of Filelogix usage license
 */ 
 
namespace FLX\Controllers;

class stripe extends \controller
{  
    // Will store database connection here
	private $db;
	private $connID;
	private $sessionID;
	private $userID;
	private $view = "";
	private $agencyID;
	private $data;
	private $input;
	

	/**
  	 * Create instance, load current info based on session info
  	 *
  	 * @return bool
  	 */
	
	public function __construct($db, $sessionID, $userID) {
	  $this->db = $db;
	  $this->sessionID = $sessionID;
	  $this->userID = $userID;
	  
	  $this->input = @file_get_contents("php://input");
	  $this->data = json_decode($this->input);
	 	  

	}
	
	/**
  	 * Opens the controller - responsible for authentication and loading defaults
  	 *
  	 * @return bool true if success, false if failure
  	 */
	
	public function test($params) {

	  $this->view = null;

	  error_log("Test Data Stripe: " . print_r($this->data,1));
	  
	  echo "Success!";
	  
	  return false;

	}
	
	
	/**
  	 * Loads the controller, handles any templating and pre-display logic for the requested view
  	 *
  	 * @return bool
  	 */
	
	public function load($view) {


	}
	
	public function create($params) {
	  if ($this->auth->validate($this->userID)) {

		$this->vars["active"] = "vendors";		
		  
		$this->view = "inventory-create";
		
		return true;		
	  }
	  else {
		 return false;
	  }
	}

	public function imports($params) {
	  if ($this->auth->validate($this->userID)) {

		$this->vars["active"] = "inventory";		
		  
		$this->view = "inventory-imports";
		
		return true;		
	  }
	  else {
		 return false;
	  }
	}

	public function import($params) {
	  if ($this->auth->validate($this->userID)) {
		
		 $bhUser = new \BH\user($this->db, $this->userID); 
		  
		 $this->agencyID = $bhUser->getAgencyID();
		  
		 $contents = ""; 
		  
		 if ($params[2] == "upload") {
							 
				$ds = DIRECTORY_SEPARATOR; 
				$storeFolder = '/var/www/html/bluhorn/uploads/' . $this->agencyID;
				
				if (!empty($_FILES)) {
					 
					$tempFile = $_FILES['file']['tmp_name'];
					$targetPath = $storeFolder . $ds;
					$targetFile =  $targetPath. $_FILES['file']['name']; 
					move_uploaded_file($tempFile,$targetFile);
					
					error_log("Upload: " . $tempFile . " -> " . $targetFile);

					$row = 1;
					if (($handle = fopen($targetFile, "r")) !== FALSE) {
					    while (($data = fgetcsv($handle, 10000, ",")) !== FALSE) {
					        $num = count($data);
					        echo "<p> $num fields in line $row: <br /></p>\n";
					        $row++;
					        for ($c=0; $c < $num; $c++) {
					            error_log($data[$c]);
					            $contents .= $data[$c] . "\t";
					        }
					        $contents .= "\n";
					    }
					    fclose($handle);
					}
					 
				}
						 
		 }

		 $this->vars["response"] = $contents;

		 $this->view = "ajax-response";
		 
		 return true;		
	  }
	  else {
		 return false;
	  }
	}

	public function edit($params) {
	  if ($this->auth->validate($this->userID)) {

		$this->vars["active"] = "vendors";		
		  
		$this->view = "inventory-edit";
		
		return true;		
	  }
	  else {
		 return false;
	  }
	}


	public function users($params) {
	  if ($this->auth->validate($this->userID)) {

		$this->vars["active"] = "agency";		
		  
		$this->view = "user-edit";
		
		return true;		
	  }
	  else {
		 return false;
	  }
	}

	public function dflt() {
	  if ($this->auth->validate($this->userID)) {

		  $bhUser = new \BH\user($this->db, $this->userID); 
		  
		  $this->agencyID = $bhUser->getAgencyID();

		  $agency = new \BH\agency($this->db, $this->agencyID, $this->userID);

		  $this->vars["agency"] = $agency->getAgency($this->agencyID);

		  $this->vars["readOnly"] = true;
		  
		  $this->vars["active"] = "Agency";
		  
		  $this->view = "inventory";
		
		return true;		
	  }
	  else {
		 return false;
	  }
	}

	
	public function data() {
		
		return $this->vars;
	}


	public function view() {
	
		return $this->view;
		
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
	
}
?>
