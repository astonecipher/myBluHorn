<?php

/**
 * FILELOGIX REQUEST CLASS
 *  
 * @author Wes Benwick
 * @link http://www.filelogix.com
 * @license Part of Filelogix usage license
 *
 *
 * @description This class will handles the parsing of requests from incoming connections
 *
 */ 
 
class request
{  
    // Will store database connection here
    static private $_instance; 
	private $db;
	private $request;
	private $baseURL;
	private $page;
	private $action;
	private $result;
	private $args;
	
	public function __construct($db, $request, $base) {

		  $this->db = $db;
		  $this->request = $request;
		  $replace = "/^$base/";
		  $requestNoBase = ltrim(preg_replace($replace, "",ltrim($request, '/')), '/');
	
		  error_log("BHRequest: nobase=$requestNoBase");		  		  

		  $requestArray = explode("/",$requestNoBase);	

		  error_log("BHRequest: requestArray[0]=" . $requestArray[0]);		  		  

		  $this->result = $requestArray;
		  $page = explode("?",$requestArray[0]);
		  $this->page = $page[0];
		  $action = explode("?",$requestArray[1]);
		  $this->action = $action[0];
		  $resultNoBase = explode("?",$requestNoBase);
		  $this->args = explode("/", $resultNoBase[0]);
		  
		  error_log("BHRequest: base is $base, page is $page[0] - 0:$requestArray[0] - 1:$requestArray[1] - 2:$requestArray[2] from $requestNoBase($request).");
		  error_log("BHRequest: args is " . $this->args[1]);
		  
	}


	
	public function getPage() {
		
		  return $this->page;
	}
	
	public function getAction() {
		
		  return $this->action;
	}
	
	public function getArg($num) {
			
		   return $this->result[$num+2];	
	}

	public function getArgs() {
			
		   return $this->args;	
	}	

	public function getRequest() {

		   return $this->request;	
	}	
	
}

?>