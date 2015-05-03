<?php

/**
 * FILELOGIX CONNECTIONS CLASS
 *  
 * @author Wes Benwick
 * @link http://www.filelogix.com
 * @license Part of Filelogix usage license
 */ 
class registration
{  
    // Will store database connection here
	private $db;
	private $sessionID;
	private $accountID;
	private $accountKey;
	private $parents;
	private $children;
	private $activities;
	private $invoices;
	private $appointments;
	private $confCode;
	
	public function __construct($db) {
	  $this->db = $db;
	  $this->sessionID = session_id();
		
	}
	
	public function create() {
		$token = new token($this->db);

		$random=new random();
		$this->confCode = $random->token(6);

		$this->accountKey = $token->getToken();
		$this->accountID = $this->db->insert("REG_ACCOUNTS", array("accountKey"=>$this->accountKey, "confCode"=>$this->confCode));
		
		return $this->accountID;
	}

	public function open($aKey) {

	  $r=$this->db->query("select * from REG_ACCOUNTS where accountKey='$aKey'");
      $results=$r->fetch(PDO::FETCH_ASSOC);
      $this->accountID = $results['id'];
      $this->confCode = $results['confCode'];

	  error_log($this->db->lastQuery());
		
	  return $this->accountID;
	}
	
	public function addParent($params = array(), $accountID) {
				
	  $this->parentFirstName = $params["parentFirstName"];
	  $this->parentLastName = $params["parentLastName"];
	  $this->parentEmail = $params["parentEmail"];
	  $this->parentAddress = $params["parentAddress"];
	  $this->parentCity = $params["parentCity"];
	  $this->parentState = $params["parentState"];
	  $this->parentZipcode = $params["parentZipcode"];
	  $this->parentPhone1 = $params["parentPhone1"];
	  $this->parentPhone2 = $params["parentPhone2"];
	  $this->accountID = $accountID;
		  			
				
	  $parentID=$this->db->insert("REG_PARENTS", array("firstName"=>$this->parentFirstName, "lastName"=>$this->parentLastName, "emailAddress"=>$this->parentEmail,
	  				 "address"=>$this->parentAddress, "city"=>$this->parentCity, "state"=>$this->parentState, "zipcode"=>$this->parentZipcode, 
	  				 "phoneNumber"=>$this->parentPhone1, "emergencyPhone"=>$this->parentPhone2));	

	  error_log($this->db->lastQuery());
	  
	  $this->db->insert("REG_ACCOUNT", array("accountID"=>$this->accountID, "parentID"=>$parentID));
	  
	  return $parentID;

	}

	public function updateParent($params = array()) {
				
	  $parentID = $params["parentID"];
	  $accountID = $params["accountID"];
	  $parentFirstName = $params["parentFirstName"];
	  $parentLastName = $params["parentLastName"];
	  $parentEmail = $params["parentEmail"];
	  $parentAddress = $params["parentAddress"];
	  $parentCity = $params["parentCity"];
	  $parentState = $params["parentState"];
	  $parentZipcode = $params["parentZipcode"];
	  $parentPhone1 = $params["parentPhone1"];
	  $parentPhone2 = $params["parentPhone2"];
		  			
				
	  $parentID=$this->db->update("REG_PARENTS", "id", $parentID, array("firstName"=>$parentFirstName, "lastName"=>$parentLastName, "emailAddress"=>$parentEmail,
	  				 "address"=>$parentAddress, "city"=>$parentCity, "state"=>$parentState, "zipcode"=>$parentZipcode, 
	  				 "phoneNumber"=>$parentPhone1, "emergencyPhone"=>$parentPhone2));	

	  error_log($this->db->lastQuery());
	  
	  return $parentID;

	}
	
	public function rentInventory($playerID, $barcode, $item) {


		if (!$playerID) {
			return false;
		}

		if (!$item) {
			return false;
		}

		if (!$barcode) {
			return false;
		}
		  				  				  			
				
	  $invID=$this->db->insert("REG_INVENTORY", array("playerID"=>$playerID, "barcode"=>$barcode, "type"=>$item));	

	  error_log($this->db->lastQuery());
	  
	  return $invID;
				
	}
	  public function addChild($params = array()) {

	  $childFirstName = $params["childFirstName"];
	  $childLastName = $params["childLastName"];
	  $childBirthDate = $params["childDOB"];
	  $childGender = $params["childGender"];
	  $childComments = $params["childComments"];

		  			
				
	  $childID=$this->db->insert("REG_CHILD", array("firstName"=>$childFirstName, "lastName"=>$childLastName, "birthDate"=>$childBirthDate, "gender"=>$childGender, "comments"=>$childComments, "accountID"=>$this->accountID));	

	  error_log($this->db->lastQuery());
	  
	  return $childID;
				
	}

	public function addSport($sportID,$childID,$accountID,$seasonID,$amount,$slushFund) {
		  			
				
	  $playerID=$this->db->insert("REG_PLAYERS", array("sportID"=>$sportID, "childID"=>$childID, "seasonID"=>$seasonID, "amount"=>$amount, "slushFund"=>$slushFund));	

	  error_log($this->db->lastQuery());
	  
	  return $playerID;
				
	}


	public function updateChild($params = array()) {
				
	  $accountID = $params["accountID"];
	  $childID = $params["childID"];
	  $childFirstName = $params["childFirstName"];
	  $childLastName = $params["childLastName"];
	  $childBirthDate = $params["childDOB"];
	  $childGender = $params["childGender"];
	  $childComments = $params["comments"];
		  			
				
	  $parentID=$this->db->update("REG_CHILD", "id", $childID, array("firstName"=>$childFirstName, "lastName"=>$childLastName, "birthdate"=>$childBirthDate, "gender"=>$childGender, "comments"=>$childComments));	

	  error_log($this->db->lastQuery());
	  
	  return $childID;

	}

	public function updateWeight($params = array(), $childID, $accountID) {
				
	  $childWeight = $params["childWeight"];
	  $childComments = $params["comments"];
		  			
				
	  $parentID=$this->db->update("REG_CHILD", "id", $childID, array("weight"=>$childWeight, "comments"=>$childComments));	

	  error_log($this->db->lastQuery());
	  
	  return $childID;

	}
	
	public function updateTeam($playerID, $teamID) {
					  			
				
	  error_log("Update Team: $playerID $teamID");			
	  $result = $this->db->update("REG_PLAYERS", "id", $playerID, array("teamID"=>$teamID));	

	  error_log($this->db->lastQuery());
	  
	  return true;

	}

	public function deletePlayer($playerID) {
					  			
				
	  error_log("Delete Player: $playerID");	
	  
// Check to see if any full or partial paid invoices exist, if so, dont delete
		
	  if (!$this->isPlayerActive($playerID)) {
	  
	  	  $this->voidAllInvoicesByPlayer($playerID);
		  		
		  $result = $this->db->update("REG_PLAYERS", "id", $playerID, array("status"=>"remove"));	

		  return true;
	  }
	  
	  error_log($this->db->lastQuery());
	  
	  return false;

	}
	
	public function isPlayerActive($playerID) {
					  			
					  
// Check to see if any full or partial paid invoices exist, if so, dont delete
	
	  $payments = $this->paymentStatusByPlayer($playerID);
	  $player = $this->getPlayer($playerID);
	  
	
	  if ($payments["totalPaid"]>0) {
		  error_log("Is Active: $playerID - payments made");
		  return true;
	  }
	  
	  if ($payments["numPayments"]>0) {
		  error_log("Is Active: $playerID - payments made");
		  return true;
	  }
	  
	  if ($payments["balance"]==0) {
		  error_log("Is Active: $playerID - zero balance");
		  return true;
	  }
	  
	  if ($player["teamID"]>0) {
		  error_log("Is Active: $playerID - team assigned");
		  return true;
	  }
	  
	  return false;

	}


	public function updateRegistration($playerID, $params = array()) {
				
				
	  $equipmentRental = $params["equipmentRental"];
	  $rentEquipment = $params["rentEquipment"];
	  $rentUniform = $params["rentUniform"];
	  $purchaseUniform = $params["purchaseUniform"];
		  			
				
	  $parentID=$this->db->update("REG_PLAYERS", "id", $playerID, array("equipmentRental"=>$equipmentRental, "rentEquipment"=>$rentEquipment, "rentUniform"=>$rentUniform, "purchaseUniform"=>$purchaseUniform));	

	  error_log($this->db->lastQuery());
	  
	  return $childID;

	}
	
	public function createInvoice($playerID, $params = array()) {

		  			

	  $todayStr=$this->getToday();

	  $player = $this->getPlayer($playerID); 	  			


	  $sport = $this->getFees($playerID); 	  			

	  $titleStr="Registration for " . $player["firstName"] . " " . $player["lastName"];
	  	  	  							
	  $invoiceID=$this->db->insert("REG_INVOICES", array("invoiceDate"=>$todayStr, "accountID"=>$this->accountID, "status"=>"open", "title"=>$titleStr));	

	  error_log($this->db->lastQuery());

	  $line=1;

      $forStr = $player["firstName"] . " " . $player["lastName"];
	  
	  error_log("Amount:" . $player["amount"]);
	  
	  if(isset($invoiceID)) {
		  if($player["amount"]>0) {
		  	  $description = "Base Registration";
			  $this->db->insert("REG_INVOICE", array("invoiceID"=>$invoiceID, "line"=>$line, "description"=>$description, "qty"=>"1", "amount"=>$player["amount"], "extended"=>$player["amount"], "discount"=>"0", "playerID"=>$playerID));		  
			  $line++;
		  }
		  if($player["slushFund"]>0) {
		  	  $description = "Slush Fund";
			  $this->db->insert("REG_INVOICE", array("invoiceID"=>$invoiceID, "line"=>$line, "description"=>$description, "qty"=>"1", "amount"=>$player["slushFund"], "extended"=>$player["slushFund"], "discount"=>"0", "playerID"=>$playerID));		  
			  $line++;
		  }
		  if($player["rentEquipment"]=="Yes") {
		  	  $description = "Equipment Rental";
			  $this->db->insert("REG_INVOICE", array("invoiceID"=>$invoiceID, "line"=>$line, "description"=>$description, "qty"=>"1", "amount"=>$player["equipmentRental"], "extended"=>$player["equipmentRental"], "discount"=>"0", "playerID"=>$playerID));		  
			  $line++;
		  }
		  if($player["rentUniform"]=="Yes") {
		  	  $description = "Uniform Rental";
			  $this->db->insert("REG_INVOICE", array("invoiceID"=>$invoiceID, "line"=>$line, "description"=>$description, "qty"=>"1", "amount"=>$sport["uniformRental"], "extended"=>$sport["uniformRental"], "discount"=>"0", "playerID"=>$playerID));		  
			  $line++;
		  }
		  if($player["purchaseUniform"]=="Yes") {
		  	  $description = "Uniform Purchase";
			  $this->db->insert("REG_INVOICE", array("invoiceID"=>$invoiceID, "line"=>$line, "description"=>$description, "qty"=>"1", "amount"=>$sport["uniformPurchase"], "extended"=>$sport["uniformPurchase"], "discount"=>"0", "playerID"=>$playerID));		  
			  $line++;
		  }
		  if($player["purchaseUniform"]=="Own") {
		  	  $description = "Own Uniform";
			  $this->db->insert("REG_INVOICE", array("invoiceID"=>$invoiceID, "line"=>$line, "description"=>$description, "qty"=>"1", "amount"=>$sport["uniformOwn"], "extended"=>$sport["uniformOwn"], "discount"=>"0", "playerID"=>$playerID));		  
			  $line++;
		  }

	  }	  
	  
	  $total=$this->getTotal($invoiceID);
	  $subtotalStr = $total["subtotal"];
	  $totalStr = $total["subtotal"];
	  
	  if ($total["subtotal"] > 0) {
		  $this->db->update("REG_INVOICES", "id", $invoiceID, array("subtotal"=>$subtotalStr, "total"=>$totalStr, "balance"=>$totalStr));	
	  }
	  
	  return $invoiceID;
	
	}
	
	public function getParents() {

	  $this->parents = array();
	  $rows=$this->db->query("select * from REG_ACCOUNT where accountID='$this->accountID'");
 	  foreach ($rows as $row) {
 	  	  array_push($this->parents,$row['parentID']);
      }

	  error_log($this->db->lastQuery());
		
	  return $this->parents;

		
	}

	public function getParentsByAccountID($accountID) {

	  $this->parents = array();
	  $rows=$this->db->query("select * from REG_ACCOUNT where accountID='$accountID'");
 	  foreach ($rows as $row) {
 	  	  array_push($this->parents,$row['parentID']);
      }

	  error_log($this->db->lastQuery());
		
	  return $this->parents;

		
	}
	
	public function getEmailAddresses($accountID) {

	  $emailAddress="";
	  $rows=$this->db->query("select emailAddress from REG_PARENTS left join REG_ACCOUNT on (REG_PARENTS.id=REG_ACCOUNT.parentID) where accountID='$accountID'");
 	  foreach ($rows as $row) {
 	  	  $emailAddress .= $row['emailAddress'] . ",";
      }

	  error_log($this->db->lastQuery());
		
	  return $emailAddress;

		
	}


	public function getChildren() {

	  $this->children = array();
	  $parents = implode(',',$this->getParents());
	  
	  $rows=$this->db->query("select * from REG_CHILD where accountID = '$this->accountID'");
 	  foreach ($rows as $row) {
 	  	  array_push($this->children,$row['id']);
      }

	  error_log($this->db->lastQuery());
		
	  return $this->children;

		
	}	
	
	public function getAllPlayers() {

	  $r=$this->db->query("select *, REG_PLAYERS.id as playerID,month(REG_CHILD.birthDate) as month, year(REG_CHILD.birthDate) as year, day(REG_CHILD.birthDate) as day, REG_SPORTS.name as sportName, truncate(datediff(REG_SPORTS.birthDate,REG_CHILD.birthDate) / 365.25,0) as age from REG_CHILD left join REG_PLAYERS on (REG_CHILD.id=REG_PLAYERS.childID) left join REG_SPORT on (REG_SPORT.id = REG_PLAYERS.sportID) left join REG_SPORTS on (REG_SPORT.sportID = REG_SPORTS.id)  where REG_PLAYERS.childID is not null and REG_PLAYERS.status='' ");
      $results=$r->fetchAll();


	  error_log($this->db->lastQuery());

      return $results;		
		
	}	

	public function getAllPlayerWithAccounts() {

	  $r=$this->db->query("select *,REG_ACCOUNTS.confCode, REG_CHILD.accountID as accountID, REG_PLAYERS.id as playerID,month(REG_CHILD.birthDate) as month, year(REG_CHILD.birthDate) as year, day(REG_CHILD.birthDate) as day, REG_SPORTS.name as sportName, truncate(datediff(REG_SPORTS.birthDate,REG_CHILD.birthDate) / 365.25,0) as age from REG_CHILD left join REG_PLAYERS on (REG_CHILD.id=REG_PLAYERS.childID) left join REG_SPORT on (REG_SPORT.id = REG_PLAYERS.sportID) left join REG_SPORTS on (REG_SPORT.sportID = REG_SPORTS.id)  left join REG_ACCOUNT on (REG_CHILD.accountID=REG_ACCOUNT.accountID) left join REG_ACCOUNTS on (REG_ACCOUNT.accountID=REG_ACCOUNTS.id) where REG_PLAYERS.childID is not null and REG_PLAYERS.status='' ");
      $results=$r->fetchAll();


	  error_log($this->db->lastQuery());

      return $results;		
		
	}	

	public function getAllPlayersByAccount($accountID) {

	  $r=$this->db->query("select distinct(playerID),REG_PLAYERS.id as playerID, REG_INVOICES.accountID as accountID, REG_ACCOUNTS.confCode, concat(REG_CHILD.firstName,' ', REG_CHILD.lastName) as name, REG_SPORTS.name as sportName, REG_CHILD.`birthDate`, truncate(datediff(REG_SPORTS.birthDate,REG_CHILD.birthDate) / 365.25,0) as age, REG_SPORT.sportID,division, REG_CHILD.weight as weight, REG_INVOICES.total, REG_INVOICES.balance as balance from REG_PLAYERS left join REG_CHILD on (REG_PLAYERS.childID=REG_CHILD.id) left join REG_SPORT on (REG_PLAYERS.sportID=REG_SPORT.id) left join REG_SPORTS on (REG_SPORT.sportID = REG_SPORTS.id) left join REG_INVOICE on (REG_INVOICE.playerID=REG_PLAYERS.id) left join REG_INVOICES on (REG_INVOICE.invoiceID=REG_INVOICES.id) left join REG_ACCOUNT on (REG_INVOICES.accountID=REG_ACCOUNT.accountID) left join REG_ACCOUNTS on (REG_ACCOUNT.accountID=REG_ACCOUNTS.id) where balance<=0  and REG_PLAYERS.status='' and REG_PLAYERS.accountID='$accountID' order by REG_CHILD.firstName");
      $results=$r->fetchAll();


	  error_log($this->db->lastQuery());

      return $results;		
		
	}

	public function getRoster($teamID) {

	  if($teamID=="") {
		  
		  $teamFilterStr="";
	  }
	  
	  else {
		  
		  $teamFilterStr=" and REG_PLAYERS.teamID=" . intval($teamID);
	  }

	  $r=$this->db->query("select *,REG_PLAYERS.id as playerID,month(REG_CHILD.birthDate) as month, year(REG_CHILD.birthDate) as year, day(REG_CHILD.birthDate) as day, REG_SPORTS.name as sportName, REG_TEAMS.name as teamName, truncate(datediff(REG_SPORTS.birthDate,REG_CHILD.birthDate) / 365.25,0) as age from REG_PLAYERS left join REG_CHILD on (REG_CHILD.id=REG_PLAYERS.childID) left join REG_TEAMS on (REG_TEAMS.id=REG_PLAYERS.teamID) left join REG_SPORT on (REG_SPORT.id = REG_PLAYERS.sportID) left join REG_SPORTS on (REG_SPORT.sportID = REG_SPORTS.id) where REG_PLAYERS.childID is not null and REG_PLAYERS.status='' $teamFilterStr");
      $results=$r->fetchAll();


	  error_log($this->db->lastQuery());

      return $results;		
		
	}	

	public function getRosterWithBalances($teamID) {

	  if($teamID=="") {
		  
		  $teamFilterStr="";
	  }
	  
	  else {
		  
		  $teamFilterStr=" and REG_PLAYERS.teamID=" . intval($teamID);
	  }

	  $regOnlyInvoiceStr = "and REG_INVOICES.title like 'Registration%'";

	  $r=$this->db->query("select REG_PLAYERS.*,REG_CHILD.*,REG_INVOICES.balance as balance, REG_PLAYERS.id as playerID,month(REG_CHILD.birthDate) as month, year(REG_CHILD.birthDate) as year, day(REG_CHILD.birthDate) as day, REG_SPORTS.name as sportName, REG_TEAMS.name as teamName, truncate(datediff(REG_SPORTS.birthDate,REG_CHILD.birthDate) / 365.25,0) as age from REG_PLAYERS left join REG_CHILD on (REG_CHILD.id=REG_PLAYERS.childID) left join REG_TEAMS on (REG_TEAMS.id=REG_PLAYERS.teamID) left join REG_SPORT on (REG_SPORT.id = REG_PLAYERS.sportID) left join REG_SPORTS on (REG_SPORT.sportID = REG_SPORTS.id) left join REG_INVOICE on (REG_INVOICE.playerID=REG_PLAYERS.id) left join REG_INVOICES on (REG_INVOICE.invoiceID=REG_INVOICES.id) where REG_PLAYERS.childID is not null and REG_PLAYERS.status=''  and REG_INVOICES.status!='void' $teamFilterStr group by REG_INVOICE.playerID");
      $results=$r->fetchAll();


	  error_log($this->db->lastQuery());

      return $results;		
		
	}
	
	public function getRosterWithBalancesAndContacts($teamID) {

	  $results = array();

	  if($teamID=="") {
		  
		  $teamFilterStr="";
	  }
	  
	  else {
		  
		  $teamFilterStr=" and REG_PLAYERS.teamID=" . intval($teamID);
	  }

	  $regOnlyInvoiceStr = "and REG_INVOICES.title like 'Registration%'";

	  $rows=$this->db->query("select REG_PLAYERS.*,REG_CHILD.*,REG_INVOICES.balance as balance, REG_PLAYERS.id as playerID,month(REG_CHILD.birthDate) as month, year(REG_CHILD.birthDate) as year, day(REG_CHILD.birthDate) as day, REG_SPORTS.name as sportName, REG_TEAMS.name as teamName, truncate(datediff(REG_SPORTS.birthDate,REG_CHILD.birthDate) / 365.25,0) as age from REG_PLAYERS left join REG_CHILD on (REG_CHILD.id=REG_PLAYERS.childID) left join REG_TEAMS on (REG_TEAMS.id=REG_PLAYERS.teamID) left join REG_SPORT on (REG_SPORT.id = REG_PLAYERS.sportID) left join REG_SPORTS on (REG_SPORT.sportID = REG_SPORTS.id) left join REG_INVOICE on (REG_INVOICE.playerID=REG_PLAYERS.id) left join REG_INVOICES on (REG_INVOICE.invoiceID=REG_INVOICES.id) where REG_PLAYERS.childID is not null and REG_PLAYERS.status=''  and REG_INVOICES.status!='void' $teamFilterStr group by REG_INVOICE.playerID");
 
 	  foreach ($rows as $row) {
 	      $parents = $this->getParentsByAccountID($row["accountID"]);
 	  	  $row["parents"]=$parents;
 	      if ($parents[0]) {
	   	      $row["parent1"] = $this->getParent($parents[0]);  
 	      } 
 	      if ($parents[1]) {
		      $row["parent2"] = $this->getParent($parents[1]);	 	      
 	      }
 	  	  array_push($results,$row);
      }

	  error_log($this->db->lastQuery());

      return $results;		
		
	}

	public function getUnassignedPlayers() {

	  $r=$this->db->query("select *,REG_PLAYERS.id as playerID,month(REG_CHILD.birthDate) as month, year(REG_CHILD.birthDate) as year, day(REG_CHILD.birthDate) as day, REG_SPORTS.name as sportName, REG_TEAMS.name as teamName, truncate(datediff(REG_SPORTS.birthDate,REG_CHILD.birthDate) / 365.25,0) as age from REG_PLAYERS left join REG_CHILD on (REG_CHILD.id=REG_PLAYERS.childID) left join REG_TEAMS on (REG_TEAMS.id=REG_PLAYERS.teamID) left join REG_SPORT on (REG_SPORT.id = REG_PLAYERS.sportID) left join REG_SPORTS on (REG_SPORT.sportID = REG_SPORTS.id) where REG_PLAYERS.childID is not null and REG_PLAYERS.teamID=0 and REG_PLAYERS.status='' ");
      $results=$r->fetchAll();


	  error_log($this->db->lastQuery());

      return $results;		
		
	}	

	
	public function getInventoryPlayers() {

	  $r=$this->db->query("select REG_PLAYERS.*, concat(REG_CHILD.lastName, ', ', REG_CHILD.firstName) as name from REG_PLAYERS left join REG_CHILD on (REG_PLAYERS.childID = REG_CHILD.id) where rentEquipment='Yes' and REG_PLAYERS.status='' order by name asc");
      $results=$r->fetchAll();


	  error_log($this->db->lastQuery());

      return $results;		
		
	}	
	
	public function getRecentPlayers() {

	  $r=$this->db->query("select *,REG_PLAYERS.id as playerID,month(REG_CHILD.birthDate) as month, year(REG_CHILD.birthDate) as year, day(REG_CHILD.birthDate) as day, REG_SPORTS.name as sportName, truncate(datediff(REG_SPORTS.birthDate,REG_CHILD.birthDate) / 365.25,0) as age from REG_CHILD left join REG_PLAYERS on (REG_CHILD.id=REG_PLAYERS.childID) left join REG_SPORT on (REG_SPORT.id = REG_PLAYERS.sportID) left join REG_SPORTS on (REG_SPORT.sportID = REG_SPORTS.id) where REG_PLAYERS.childID is not null and isActive='1' and REG_PLAYERS.status='' order by REG_PLAYERS.id  desc limit 100");
      $results=$r->fetchAll();


	  error_log($this->db->lastQuery());

      return $results;		
		
	}	


	public function getPlayerCount() {

	  $r=$this->db->query("select count(1) as playerCount from REG_CHILD left join REG_PLAYERS on (REG_CHILD.id=REG_PLAYERS.childID) left join REG_SPORT on (REG_SPORT.id = REG_PLAYERS.sportID) left join REG_SPORTS on (REG_SPORT.sportID = REG_SPORTS.id) where REG_PLAYERS.childID is not null and isActive='1' and REG_PLAYERS.status='' ");
      $results=$r->fetch(PDO::FETCH_ASSOC);
    

	  error_log($this->db->lastQuery());

      return $results["playerCount"];		
		
	}	

	public function getFamilyCount() {

	  $r=$this->db->query("select count(1) as familyCount from REG_ACCOUNTS");
      $results=$r->fetch(PDO::FETCH_ASSOC);
    

	  error_log($this->db->lastQuery());

      return $results["familyCount"];		
		
	}	

	public function getSportCount() {

	  $r=$this->db->query("select count(1) as sportCount from REG_SPORTS");
      $results=$r->fetch(PDO::FETCH_ASSOC);
    

	  error_log($this->db->lastQuery());

      return $results["sportCount"];		
		
	}	

	public function getTeamCount() {

	  $r=$this->db->query("select count(1) as teamCount from REG_TEAMS");
      $results=$r->fetch(PDO::FETCH_ASSOC);
    

	  error_log($this->db->lastQuery());

      return $results["teamCount"];		
		
	}		
	
	public function getActivities($cID) {

	  $this->activities = array();
	  
	  $rows=$this->db->query("select * from REG_PLAYERS where childID = '$cID' and REG_PLAYERS.status='' ");
 	  foreach ($rows as $row) {
 	  	  array_push($this->activities,$row['id']);
      }

	  error_log($this->db->lastQuery());
		
	  return $this->activities;

		
	}	

	public function getSports() {

	  
	  $sports=$this->db->query("select * from REG_SPORTS where isActive=1");

      $results=$sports->fetch(PDO::FETCH_ASSOC);


	  error_log($this->db->lastQuery());
		
	  return $results;

		
	}	

	public function useWeight($sID) {

	  
	  $sports=$this->db->query("select * from REG_SPORTS where isActive=1 and id='$sID'");

	  error_log($this->db->lastQuery());
		
	  $useWeight="0";

      $results=$sports->fetch(PDO::FETCH_ASSOC);
      $useWeight = $results['useWeight'];
      		
	  return $useWeight;

		
	}	

	public function getFees($playerID) {

	  
	  $fees=$this->db->query("select REG_SPORT.* from REG_SPORT left join REG_PLAYERS on (REG_PLAYERS.sportID=REG_SPORT.id) where REG_PLAYERS.id='$playerID' and REG_PLAYERS.status='' ");

	  error_log($this->db->lastQuery());
		
	  $useWeight="0";

      $results=$fees->fetch(PDO::FETCH_ASSOC);
      		
	  return $results;

		
	}		
		
	
	public function getAllDivisions($sID) {

	  
	  $sports=$this->db->query("select *,sum(amount+slushFund) as total from REG_SPORT where sportID='$sID' and REG_SPORT.status='' group by id");

	  error_log($this->db->lastQuery());
		
	  return $sports;

		
	}	

	public function getDivisions($sID, $cID) {

// Lookup child's birthDate and weight (if needed)

	$child=$this->getChild($cID);

	$childDOB = $child["birthDate"];
	$childWeight = $child["weight"];
	
// Determine if sportID is weight restricted



	  if ($this->useWeight($sID)) {
		  $weightStr = " and ('$childWeight' between fromWeight and toWeight)  ";
	  }
	  else {
		  $weightStr = "";
	  }
			  
	  $sports=$this->db->query("select *,amount+slushFund as total from REG_SPORT where sportID='$sID' and REG_SPORT.status='' and ('$childDOB' between fromBirthdate and toBirthdate) $weightStr  group by id");

      $results=$sports->fetch(PDO::FETCH_ASSOC);


	  error_log($this->db->lastQuery());
		
	  return $results;

		
	}	

	public function getTotal($invoiceID) {

	  
	  $rows=$this->db->query("select sum(extended) as subtotal from REG_INVOICE where invoiceID = '$invoiceID'");

	  error_log($this->db->lastQuery());

      $results=$rows->fetch(PDO::FETCH_ASSOC);
 

		
	  return $results;

		
	}		
	
	public function getToday() {

	  
	  $rows=$this->db->query("select curdate() as today");
      $results=$rows->fetch(PDO::FETCH_ASSOC);
 

	  error_log($this->db->lastQuery());
		
	  return $results["today"];

		
	}		

	public function getInvoice($invoiceID) {

	  
	  $rows=$this->db->query("select * from REG_INVOICES where id= '$invoiceID'");
      $results=$rows->fetch(PDO::FETCH_ASSOC);
 

	  error_log($this->db->lastQuery());
		
	  return $results;

		
	}	

	public function getInvoices() {

	  $results=$this->db->query("select * from REG_INVOICES where accountID= '$this->accountID'");
 	
  

	  error_log($this->db->lastQuery());
		
	  return $results;

		
	}	

	
	public function getInvoiceItems($invoiceID) {

	  
	  $items=$this->db->query("select * from REG_INVOICE where invoiceID='$invoiceID'");

	  error_log($this->db->lastQuery());
		
	  return $items;

		
	}			
	
	public function getInvoiceItemsByPlayer($playerID) {

	  
	  $r=$this->db->query("select * from REG_INVOICE where playerID='$playerID'");

      $results=$r->fetchAll();

	  error_log($this->db->lastQuery());
		
	  return $results;

		
	}	

	public function getInvoicesByPlayer($playerID) {

	  
	  $r=$this->db->query("select distinct(REG_INVOICES.id), REG_INVOICES.* from REG_INVOICES left join REG_INVOICE on (REG_INVOICE.invoiceID=REG_INVOICES.id) where playerID='$playerID'");

      $results=$r->fetchAll();

	  error_log($this->db->lastQuery());
		
	  return $results;

		
	}	
	
	
	public function paymentStatusByPlayer($playerID) {

	  
	  $rows=$this->db->query("select distinct(REG_INVOICES.id), REG_INVOICES.* from REG_INVOICES left join REG_INVOICE on (REG_INVOICE.invoiceID=REG_INVOICES.id) where playerID='$playerID'");

	  $results=array();
	  $results["paidCount"] = 0;
	  $results["openCount"] = 0;
	  $results["numPayments"] = 0;
	  $results["totalPaid"] = 0;
	  $results["balance"] = -1;
	  
	  
      foreach ($rows as $row) {
 	  	  if ($row['status'] == "open") {
	 	  	  	$results["openCount"]++;
 	  	  }
 	  	  if ($row['status'] == "Paid") {
	 			$results["paidCount"]++;	  	  
 	  	  }
 	  	  if ($row['amount']>0) {
 	 	 	  	$results["numPayments"] += $row['numPayments'];
 	 	  }
 	 	  
	 	  $results["totalPaid"] += $row['total']-$row['balance'];
	 	  $results["balance"] += $row['balance'];
      }
      
//      error_log("Pay Status By Player: " . $results["totalPaid"] . " - " . $results["numPayments"]);
      return $results;
		
	}	


	public function voidAllInvoicesByPlayer($playerID) {

	  
	  $rows=$this->db->query("update REG_INVOICES set status='void' where id IN ((select distinct invoiceID from REG_INVOICE where playerID='$playerID'))");

	  error_log($this->db->lastQuery());

	  return true;	
		
	}
	
	
	public function getOpenInvoicesByPlayer($playerID) {

	  
	  $results=$this->db->query("select distinct(REG_INVOICES.id), REG_INVOICES.* from REG_INVOICES left join REG_INVOICE on (REG_INVOICE.invoiceID=REG_INVOICES.id) where playerID='$playerID' and REG_INVOICES.balance>0 and REG_INVOICES.status='open'");

	  error_log($this->db->lastQuery());
		
	  return $results;

		
	}
	
	public function getParent($pID) {
	 	
	  $parent = array();

	  $r=$this->db->query("select REG_PARENTS.*,REG_ACCOUNTS.confCode as confCode from REG_PARENTS left join REG_ACCOUNT on (REG_PARENTS.id=REG_ACCOUNT.parentID) left join REG_ACCOUNTS on (REG_ACCOUNT.accountID=REG_ACCOUNTS.id) where REG_PARENTS.id='$pID'");
      $results=$r->fetch(PDO::FETCH_ASSOC);
      $parent["id"] = $results['id'];
      $parent["firstName"] = $results['firstName'];
      $parent["lastName"] = $results['lastName'];
      $parent["address"] = $results['address'];
      $parent["city"] = $results['city'];
      $parent["state"] = $results['state'];
      $parent["zipcode"] = $results['zipcode'];
      $parent["emailAddress"] = $results['emailAddress'];
      $parent["confCode"] = $results['confCode'];
      $parent["phoneNumber"] = preg_replace('~.*(\d{3})[^\d]*(\d{3})[^\d]*(\d{4}).*~', '($1) $2-$3', $results['phoneNumber']);

      $parent["emergencyPhone"] = preg_replace('~.*(\d{3})[^\d]*(\d{3})[^\d]*(\d{4}).*~', '($1) $2-$3', $results['emergencyPhone']);

	  error_log($this->db->lastQuery());

      return $parent;
		
	}
	
	public function getKey() {
	 	
	 	return $this->accountKey;
		
	}

	public function getConfCode() {
	 	
	 	return $this->confCode;
		
	}
	
	public function getChild($cID) {
	 	
	  $child = array();

	  $r=$this->db->query("select *,month(birthDate) as month, year(birthDate) as year, day(birthDate) as day from REG_CHILD where id='$cID'");
      $results=$r->fetch(PDO::FETCH_ASSOC);
      $child["id"] = $results['id'];
      $child["firstName"] = $results['firstName'];
      $child["lastName"] = $results['lastName'];
      $child["gender"] = $results['gender'];
      $child["birthDate"] = $results['birthDate'];
      $child["comments"] = $results['comments'];
      $child["day"] = $results['day'];
      $child["month"] = $results['month'];
      $child["year"] = $results['year'];
      $child["weight"] = $results['weight'];

	  error_log($this->db->lastQuery());

      return $child;
		
	}

	public function getPlayer($pID) {
	 	

	  $r=$this->db->query("select *, REG_SPORTS.name as sportName, REG_SPORT.division as divisionName, month(REG_CHILD.birthDate) as month, year(REG_CHILD.birthDate) as year, day(REG_CHILD.birthDate) as day, truncate(datediff(REG_SPORTS.birthDate,REG_CHILD.birthDate) / 365.25,0) as age, REG_PLAYERS.id as playerID, REG_CHILD.birthDate as dob from REG_CHILD left join REG_PLAYERS on (REG_CHILD.id=REG_PLAYERS.childID) left join REG_SPORT on (REG_PLAYERS.sportID=REG_SPORT.id) left join REG_SPORTS on (REG_SPORT.sportID = REG_SPORTS.id) where REG_PLAYERS.id='$pID' and REG_PLAYERS.status=''");
      $results=$r->fetch(PDO::FETCH_ASSOC);

	  $this->accountID = $results["accountID"];

	  error_log($this->db->lastQuery());

      return $results;
		
	}

	
	public function getActivity($activityID) {
	 	
	  $activity = array();

	  $r=$this->db->query("select REG_PLAYERS.id as playerID, REG_PLAYERS.amount as amount, concat(REG_SPORT.division, ' ', REG_SPORTS.name) as sport, REG_SEASONS.name as season, REG_TEAMS.name as team from REG_PLAYERS left join REG_SPORT on (REG_SPORT.id=REG_PLAYERS.sportID) left join REG_SPORTS on (REG_SPORT.sportID=REG_SPORTS.id) left join REG_SEASONS on (REG_SEASONS.id=REG_PLAYERS.seasonID) left join REG_TEAMS on (REG_TEAMS.id=teamID) where REG_PLAYERS.id='$activityID' and REG_PLAYERS.status=''");
      $results=$r->fetch(PDO::FETCH_ASSOC);
      $activity["id"] = $results['playerID'];
      $activity["sport"] = $results['sport'];
      $activity["season"] = $results['season'];
      $activity["amount"] = $results['amount'];
      $activity["team"] = $results['team'];

	  error_log($this->db->lastQuery());

      return $activity;
		
	}

	public function getSport($playerID) {
	 	
	  $sport = array();

	  $r=$this->db->query("select REG_PLAYERS.id as playerID, REG_PLAYERS.amount as amount, REG_SPORT.slushFund as slushFund, concat(REG_SPORT.division, ' ', REG_SPORTS.name) as sport, REG_SEASONS.name as season, REG_TEAMS.name as team, REG_PLAYERS.sportID as sportID from REG_PLAYERS left join REG_SPORT on (REG_SPORT.id=REG_PLAYERS.sportID) left join REG_SPORTS on (REG_SPORT.sportID=REG_SPORTS.id) left join REG_SEASONS on (REG_SEASONS.id=REG_PLAYERS.seasonID) left join REG_TEAMS on (REG_TEAMS.id=teamID) where REG_PLAYERS.id='$playerID' and REG_PLAYERS.status=''");
      $results=$r->fetch(PDO::FETCH_ASSOC);
      $sport["id"] = $results['playerID'];
      $sport["playerID"] = $results['playerID'];
      $sport["sportID"] = $results['sportID'];
      $sport["sport"] = $results['sport'];
      $sport["season"] = $results['season'];
      $sport["amount"] = $results['amount'];
      $sport["slushFund"] = $results['slushFund'];
      $sport["team"] = $results['team'];

	  error_log($this->db->lastQuery());

      return $sport;
		
	}

	public function getEquipment($playerID) {
	 	
	  $sport = array();

	  $r=$this->db->query("select REG_SPORT.* from REG_PLAYERS left join REG_SPORT on (REG_SPORT.id=REG_PLAYERS.sportID) where REG_PLAYERS.id='$playerID' and REG_PLAYERS.status=''");
      $results=$r->fetch(PDO::FETCH_ASSOC);
      $sport["id"] = $results['playerID'];
      $sport["rentEquipment"] = $results['rentEquipment'];
      $sport["rentUniform"] = $results['rentUniform'];
      $sport["purchaseUniform"] = $results['purchaseUniform'];
      $sport["equipmentRental"] = $results['equipmentRental'];
      $sport["uniformRental"] = $results['uniformRental'];
      $sport["team"] = $results['team'];

	  error_log($this->db->lastQuery());

      return $sport;
		
	}

	public function getUniform($playerID) {
	 	
	  $sport = array();

	  $r=$this->db->query("select REG_SPORT.* from REG_PLAYERS left join REG_SPORT on (REG_SPORT.id=REG_PLAYERS.sportID) where REG_PLAYERS.id='$playerID' and REG_PLAYERS.status=''");
      $results=$r->fetch(PDO::FETCH_ASSOC);
      $sport["id"] = $results['playerID'];
      $sport["rentEquipment"] = $results['rentEquipment'];
      $sport["rentUniform"] = $results['rentUniform'];
      $sport["purchaseUniform"] = $results['purchaseUniform'];
      $sport["equipmentRental"] = $results['equipmentRental'];
      $sport["uniformRental"] = $results['uniformRental'];
      $sport["team"] = $results['team'];

	  error_log($this->db->lastQuery());

      return $sport;
		
	}
	
	
	public function lookup($params = array()) {

	  $confCode = $params["confCode"];
	  $emailAddress = $params["emailAddress"];

	  $r=$this->db->query("select distinct(REG_ACCOUNTS.id) as id, REG_ACCOUNTS.accountKey as accountKey from REG_ACCOUNTS left join REG_ACCOUNT on (REG_ACCOUNTS.id=REG_ACCOUNT.accountID) left join REG_PARENTS on (parentID=REG_PARENTS.id) where REG_ACCOUNTS.confCode='$confCode' and emailAddress='$emailAddress'");
      $results=$r->fetch(PDO::FETCH_ASSOC);
      $this->accountID = $results['id'];
      $this->accountKey = $results['accountKey'];

	  error_log($this->db->lastQuery());
		
	  return $this->accountID;


	}
	
	public function getSchedule($cID) {
		
			$this->db->update("letsgomaa_camp", "id", "$cID", array("status"=>$statusStr));
	}
	

	
	public function getParentLastName($pid) {
		return $this->parentLastName;
	}
	
	public function getParentFirstName($pid) {
		return $this->parentFirstName;
	}
	
	public function getParentEmail($pid) {
		return $this->parentEmail;
	}
	
	public function getParentAddress($pid) {
		return $this->parentAddress;
	}
	
	public function getParentCity($pid) {
		return $this->parentCity;
	}

	public function getParentState($pid) {
		return $this->parentState;
	}	
	
	public function getParentZipcode($pid) {
		return $this->parentZipcode;
	}
	
	public function getParentPhone1($pid) {
		return $this->parentPhone1;
	}
	
	public function getParentPhone2($pid) {
		return $this->parentPhone2;
	}
	
	public function getChildFirstName($cid) {
		return $this->childFirstName;
	}	

	public function getChildLastName($cid) {
		return $this->childLastName;
	}

	public function getChildFullName($cid) {
		return $this->childFirstName . ' ' . $this->childLastName;
	}
	
	public function getChildLastNameFirstName($cid) {
		return $this->childLastName . ', ' . $this->childFirstName;
	}	
					
	public function payment($invoiceID, $transID, $paymentAmount, $fee) {
		
			$numPayments = 0;
			$totalAmount = $paymentAmount - $fee;
		
			$nowStr = date('Y-m-d h:i:s a', time());
			$paymentID=$this->db->insert("REG_PAYMENTS", array("source"=>"PayPal", "refNumber"=>$transID, "amount"=>$paymentAmount, "fee"=>$fee, "total"=>$totalAmount, "created"=>$nowStr));
			$this->db->insert("REG_PAYMENT", array("paymentID"=>$paymentID, "invoiceID"=>$invoiceID, "amount"=>$paymentAmount, "fee"=>$fee));
			
			$prevBalance = $this->getBalance($invoiceID);

			if ($paymentAmount>0) {
				$numPayments = $this->getNumPayments($invoiceID) + 1;
			}
			else {
				$numPayments = $this->getNumPayments($invoiceID) - 1;				
			}
			
			$balance = $prevBalance - $paymentAmount;
			
			$newStatus = "open";
			
			if ($balance <= 0) {
				$newStatus = "Paid";

			}
			
			$this->db->update("REG_INVOICES", "id", $invoiceID, array("balance"=>$balance, "status"=>$newStatus, "numPayments"=>$numPayments));
			
//			$this->db->update("REG_INVOICES", id, $invoiceID, array("status"=>"Paid"));
	}


	public function paymentByPlayer($source, $invoiceID, $transID, $paymentAmount, $fee, $addedBy) {
		
			$numPayments = 0;
			$totalAmount = $paymentAmount - $fee;
		
			$nowStr = date('Y-m-d h:i:s a', time());
			$paymentID=$this->db->insert("REG_PAYMENTS", array("source"=>$source, "refNumber"=>$transID, "amount"=>$paymentAmount, "fee"=>$fee, "total"=>$totalAmount, "created"=>$nowStr, "addedBy"=>$addedBy));
			$this->db->insert("REG_PAYMENT", array("paymentID"=>$paymentID, "invoiceID"=>$invoiceID, "amount"=>$paymentAmount, "fee"=>$fee));
			
			$prevBalance = $this->getBalance($invoiceID);
			$numPayments = $this->getNumPayments($invoiceID) + 1;
			
			$balance = $prevBalance - $paymentAmount;
			
			$newStatus = "open";
			
			if ($balance <= 0) {
				$newStatus = "Paid";

			}
			
			$this->db->update("REG_INVOICES", "id", $invoiceID, array("balance"=>$balance, "status"=>$newStatus, "numPayments"=>$numPayments));
			
//			$this->db->update("REG_INVOICES", id, $invoiceID, array("status"=>"Paid"));
	}
	

	
	public function getBalance($invoiceID) {

	  $r=$this->db->query("select * from REG_INVOICES where id='$invoiceID'");
      $results=$r->fetch(PDO::FETCH_ASSOC);

	  error_log($this->db->lastQuery());

      return $results['balance'];
		
	}   
	
	 
	public function getNumPayments($invoiceID) {

	  $r=$this->db->query("select * from REG_INVOICES where id='$invoiceID'");
      $results=$r->fetch(PDO::FETCH_ASSOC);

	  error_log($this->db->lastQuery());

      return $results['numPayments'];
		
	}    

    public function getAllPayments() {

	   $q = "select distinct(playerID),REG_PLAYERS.id as playerID, REG_INVOICES.accountID as accountID, REG_ACCOUNTS.confCode, concat(REG_CHILD.firstName,' ', REG_CHILD.lastName) as name, REG_SPORTS.name as sportName, REG_CHILD.`birthDate`, truncate(datediff(REG_SPORTS.birthDate,REG_CHILD.birthDate) / 365.25,0) as age, REG_SPORT.sportID,division, REG_CHILD.weight as weight, REG_INVOICES.total, REG_INVOICES.balance as balance from REG_PLAYERS left join REG_CHILD on (REG_PLAYERS.childID=REG_CHILD.id) left join REG_SPORT on (REG_PLAYERS.sportID=REG_SPORT.id) left join REG_SPORTS on (REG_SPORT.sportID = REG_SPORTS.id) left join REG_INVOICE on (REG_INVOICE.playerID=REG_PLAYERS.id) left join REG_INVOICES on (REG_INVOICE.invoiceID=REG_INVOICES.id) left join REG_ACCOUNT on (REG_INVOICES.accountID=REG_ACCOUNT.accountID) left join REG_ACCOUNTS on (REG_ACCOUNT.accountID=REG_ACCOUNTS.id) where total >= balance  and REG_PLAYERS.status='' order by REG_SPORT.sportID asc, REG_SPORT.id asc";

	   $r=$this->db->query($q);	   

       $results=$r->fetchAll();

//  	   error_log($this->db->lastQuery());

       return $results;

	    
    }
 
    public function getCalendarPaymentsByEvent($eventID) {

	   $q = "select CAL_EVENTS.title as calTitle, CAL_EVENT.startStamp, concat(REG_CHILD.firstName, ' ', REG_CHILD.lastName) as childName, REG_CHILD.birthDate as childDOB, REG_INVOICES.balance, CAL_EVENT.refID as playerID from CAL_EVENT left join CAL_EVENTS on (CAL_EVENT.eventID=CAL_EVENTS.id) left join REG_PLAYERS on (REG_PLAYERS.id=CAL_EVENT.refID) left join REG_CHILD on (REG_CHILD.id=REG_PLAYERS.childID) left join REG_INVOICES on (REG_INVOICES.id=CAL_EVENT.invoiceID) where CAL_EVENT.eventID='$eventID' order by CAL_EVENT.startStamp asc";

	   $r=$this->db->query($q);	   

       $results=$r->fetchAll();

//  	   error_log($this->db->lastQuery());

       return $results;

	    
    }

    public function getCalendarPaymentsByEventAllPlayers($eventID) {

	   $q = "select REG_PARENTS.emailAddress as emailAddress, REG_ACCOUNTS.confCode, CAL_EVENT.name as eventName, CAL_EVENTS.title as calTitle, CAL_EVENT.startStamp, concat(REG_CHILD.firstName, ' ', REG_CHILD.lastName) as childName, REG_CHILD.birthDate as childDOB, REG_INVOICES.balance, CAL_EVENT.refID as playerID from REG_PLAYERS left join CAL_EVENT on (REG_PLAYERS.id=CAL_EVENT.refID) left join CAL_EVENTS on (CAL_EVENT.eventID=CAL_EVENTS.id) left join REG_CHILD on (REG_CHILD.id=REG_PLAYERS.childID) left join REG_INVOICES on (REG_INVOICES.id=CAL_EVENT.invoiceID) left join REG_ACCOUNT on (REG_CHILD.accountID=REG_ACCOUNT.accountID) left join REG_PARENTS on (REG_PARENTS.id=REG_ACCOUNT.parentID) left join REG_ACCOUNTS on (REG_ACCOUNT.accountID=REG_ACCOUNTS.id) where REG_PLAYERS.status='' and (CAL_EVENT.eventID is NULL or CAL_EVENT.eventID='$eventID') order by CAL_EVENT.startStamp asc";

	   $r=$this->db->query($q);	   

       $results=$r->fetchAll();

//  	   error_log($this->db->lastQuery());

       return $results;

	    
    }
        
    public function getPaymentStatus($playerID) {

	   $q = "select distinct(playerID),REG_PLAYERS.id as playerID, REG_INVOICES.accountID as accountID, REG_ACCOUNTS.confCode, concat(REG_CHILD.firstName,' ', REG_CHILD.lastName) as name, REG_SPORTS.name as sportName, REG_CHILD.`birthDate`, truncate(datediff(REG_SPORTS.birthDate,REG_CHILD.birthDate) / 365.25,0) as age, REG_SPORT.sportID,division, REG_CHILD.weight as weight, REG_INVOICES.total, REG_INVOICES.balance  as balance from REG_PLAYERS left join REG_CHILD on (REG_PLAYERS.childID=REG_CHILD.id) left join REG_SPORT on (REG_PLAYERS.sportID=REG_SPORT.id) left join REG_SPORTS on (REG_SPORT.sportID = REG_SPORTS.id) left join REG_INVOICE on (REG_INVOICE.playerID=REG_PLAYERS.id) left join REG_INVOICES on (REG_INVOICE.invoiceID=REG_INVOICES.id) left join REG_ACCOUNT on (REG_INVOICES.accountID=REG_ACCOUNT.accountID) left join REG_ACCOUNTS on (REG_ACCOUNT.accountID=REG_ACCOUNTS.id) where REG_PLAYERS.id=\"$playerID\" and REG_PLAYERS.status='' order by REG_SPORT.sportID asc, REG_SPORT.id asc";

	   $r=$this->db->query($q);	   

       $results=$r->fetchAll();

//  	   error_log($this->db->lastQuery());

       return $results;

	    
    }

   public function getPaymentHistory($playerID) {

	   $q = "select distinct(REG_PAYMENTS.id), REG_PAYMENTS.*,REG_INVOICES.id as invoiceID, REG_INVOICE.playerID from REG_PAYMENTS left join REG_PAYMENT on (REG_PAYMENTS.id=REG_PAYMENT.paymentID) left join REG_INVOICES on (REG_PAYMENT.invoiceID=REG_INVOICES.id) left join REG_INVOICE on (REG_INVOICE.invoiceID=REG_INVOICES.id) where playerID=\"$playerID\" order by REG_PAYMENTS.created desc";

	   $r=$this->db->query($q);	   

       $results=$r->fetchAll();

//  	   error_log($this->db->lastQuery());

       return $results;

	    
    }

    
    public function getNonPlayers() {

	   $q = "select distinct(REG_CHILD.id), REG_ACCOUNTS.confCode, REG_ACCOUNT.accountID, REG_CHILD.firstName, REG_CHILD.lastName from REG_CHILD left join REG_PLAYERS on (REG_CHILD.id=REG_PLAYERS.childID) left join REG_ACCOUNT on (REG_ACCOUNT.accountID=REG_CHILD.accountID) left join REG_ACCOUNTS on (REG_ACCOUNT.accountID=REG_ACCOUNTS.id) where childID is NULL";

	   $r=$this->db->query($q);	   

       $results=$r->fetchAll();

//  	   error_log($this->db->lastQuery());

       return $results;
	    
    }

    public function getAllTeamsBySport($sportID, $seasonID) {

	   $q = "select REG_TEAMS.* from REG_TEAMS left join REG_SPORT on (REG_TEAMS.sportID=REG_SPORT.id) left join REG_SPORTS on (REG_SPORT.sportID=REG_SPORTS.id) where sportID='$sportID' and seasonID = '$seasonID' order by name asc";

	   $r=$this->db->query($q);	   

       $results=$r->fetchAll();

//  	   error_log($this->db->lastQuery());

       return $results;
	    
    }

    public function getAllTeams($seasonID) {

	   $q = "select  distinct(REG_TEAMS.id), REG_TEAMS.*, REG_SPORTS.name as sportName, REG_SPORT.division as divisionName, REG_TEAMS.name as teamName from REG_TEAMS left join REG_SPORT on (REG_TEAMS.divisionID=REG_SPORT.divisionID) left join REG_SPORTS on (REG_TEAMS.sportID=REG_SPORTS.id)where REG_TEAMS.seasonID = '$seasonID' order by name asc";

	   $r=$this->db->query($q);	   

       $results=$r->fetchAll();

  	   error_log($this->db->lastQuery());

       return $results;
	    
    }

    
    public function getAllSports() {

	   $q = "select * from REG_SPORTS where isActive=1";

	   $r=$this->db->query($q);	   

       $results=$r->fetchAll();

//  	   error_log($this->db->lastQuery());

       return $results;
	    
    }

    public function dropPlayer($playerID) {

	   $q = "select * from REG_SPORTS where isActive=1";

	   $r=$this->db->query($q);	   

       $results=$r->fetchAll();

//  	   error_log($this->db->lastQuery());

       return true;
	    
    }
     
    public function getTeamsByDivision($sportID) {

	   $q = "select *, REG_TEAMS.id as teamID from REG_TEAMS left join REG_SPORT using (divisionID) where REG_SPORT.id = '$sportID' order by name asc";

	   $results=$this->db->query($q);	   

 	   error_log($this->db->lastQuery());

       return $results;
	    
    }

   public function getTeam($teamID) {

	   $q = "select *, REG_TEAMS.id as teamID, REG_TEAMS.name as teamName from REG_TEAMS left join REG_SPORT using (divisionID) where REG_TEAMS.id = '$teamID'";

	   $r=$this->db->query($q);	   

       $results=$r->fetch(PDO::FETCH_ASSOC);

 	   error_log($this->db->lastQuery());

       return $results;
	    
    }

    
/*    public function getDivisions($sportID, $seasonID) {

	   $q = "select distinct(division) from REG_SPORT where REG_SPORT.sportID='$sportID' and REG_SPORT.seasonID = '$seasonID' order by division asc";

	   $r=$this->db->query($q);	   

       $results=$r->fetchAll();

//  	   error_log($this->db->lastQuery());

       return $results;
	    
    }
*/
    
}
?>