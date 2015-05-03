<?php

/**
 * FILELOGIX LOGS CLASS
 *  
 * @author Wes Benwick
 * @link http://www.filelogix.com
 * @license Part of Filelogix usage license
 *
 *
 * @description This class gives access to system logs
 *
 */ 
 
namespace FLX;

class logs
{  
    // Will store database connection here
	private $db;
	private $sessionID;
	
	public function __construct($db, $sessionID) {
	  $this->db = $db;
	  $this->sessionID = $sessionID;
		
	}
	
	public function connections($orderBy, $offset = 0, $maxRecords = 100) {

		  if ($orderBy == "desc") {
			  $orderByStr = "desc";
		  }
		  else if ($orderBy == "asc") {
			  $orderByStr = "asc";
		  }
		  else {
			  $orderByStr = "desc";
		  }
		  
		  $offsetStr = intval($offset);
		  $maxRecordsStr = intval($maxRecords);
				  
		  $r=$this->db->query("select * from FLX_CONNECTIONS order by `id` $orderByStr limit $offsetStr, $maxRecordsStr");
	      $results=$r->fetchAll();
				
		  return $results;
		
	}

	public function connection($connectionID) {

		  $connectionIDStr = $this->db->quote($connectionID);
		  				  
		  $r=$this->db->query("select * from FLX_CONNECTIONS where `id` = $connectionIDStr");
		  $results=$r->fetch(\PDO::FETCH_ASSOC);
				
		  return $results;
		
	}
	
}

?>