<?php

  define("BASE", "bluhorn");
  define("BASEDIR", "");
  define("FLXDIR", "lib/filelogix/");
  define("CLASSDIR", "classes/");
  define("CUSTOMDIR", "custom/");
  define("PLUGINSDIR", "plugins/");
  define("LIBDIR", "lib/");
  define("CALDIR", "CAL/");
  define("FORMSDIR", "FORMS/");
  define("SMARTY_DIR", "/mnt/stor9-wc1-dfw1/649984/dev.filelogix.com/lib/Smarty-3.1.13/libs/");
  define("DB", "649984_bluhorn");
  define("DBHOST", "mysql51-037.wc1.dfw1.stabletransit.com");
  define("DBUSER", "649984_bluhorn");
  define("DBPASSWD", "AHjEz2qWrFrPVsqx");
  define("HEADER", "header.php");
  define("FOOTER", "footer.php");

  error_reporting(E_ALL);
  
  date_default_timezone_set('America/New_York');
  
  set_exception_handler(myException);
  
	//  error_reporting(0);
	//  error_log("debugging " . DB);
  
    // *nix style (note capital 'S')
    
  
  $class_name = "";
    
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
	  	  	elseif (file_exists(LIBDIR . $namespaceDir . $class_name . '.php')) {	  	  
		  			error_log("Loading $class_name" . ".php from " . LIBDIR . CLASSDIR . $namespaceDir);
		  			include_once (LIBDIR . $namespaceDir .  $class_name . '.php');
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
		      elseif (file_exists(LIBDIR . $class_name . '.php')) {
			  		error_log("Loading $class_name from " . LIBDIR);
			    	include_once (LIBDIR . $class_name . '.php');
		      }			      		            
		      else {
			  		error_log("Error loading $class_name.");
			        throw new Exception("Error loading $class_name library.");		      
		      }	
		}

	  }
	  

	  header('Access-Control-Allow-Origin: *');
	  header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
	  header('Access-Control-Allow-Headers: X-PINGARUNER');
	  header('Access-Control-Max-Age: 1728000');
	  header('P3P:CP="IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT"'); 
	  header("X-XSS-Protection: 0");
	  header("Cache-Control: no-cache, must-revalidate");


	  $db=new database("mysql:host=". DBHOST . ";dbname=" . DB, DBUSER, DBPASSWD, NULL);
	  $session = new session($db);
	  $connection = new connection($db);
	  	  
	  $request = new request($db, $connection->uri(), BASE);

	  $controller = new controller($db, $request);

	  $page = new page($db, $connection->id());
 	
	  $rqst["controller"] = trim($page->controller($request));
	  $rqst["view"]="login";
	  $rqst["action"]=trim($request->getAction());
	  error_log( "GetAction\n");
	  if ($controller->open($page->controller($request))) {
		  if ($rqst["action"]) {
			  if (!$controller->go($rqst["action"])) {
		  		  error_log("Action Error: " . $rqst["action"]);	
	 	 		  if ( $controller->view() ) {
		 	 		  $view = new view($db, $controller->view());		  
					  $view->toHTML(null);
					  exit(1);
				  }

				  else if ( $controller->view() == null ) {
					  exit(1);
				  }				  
			  }
		  }
	  }

	  error_log("Transferring: " . $controller->transfer());
	  
	  if ($controller->transfer()) {
		error_log("Controller transferring: {$controller->transfer()}\n\n");
	  	  header("Location: " . $controller->transfer() . "\n\n");
	  	  exit(1);
	  }
	  
	  else if ($controller->view()) {
		error_log("Controller view: {$controller->view()}\n\n");
		  $view = new view($db, $controller->view(), BASE);
	  }
	  
	  else {
	  	  if ($request->getPage()=="") {
		  	  error_log("Transferring: in null\n\n");
	  		  $view = new view($db, "ERROR");		  
	  	  }
	  	  else {
	  	  	error_log("Transferring:{$request->getPage()}\n\n");
 	 		  $view = new view($db, "error");		  
 	 	  }
	  }
	  
	  $view->toHTML($controller->data());
	     
  }
  catch (Exception $e) {
	  echo "Error occurred while loading $class_name library." . $e->getMessage(); 
  }


  function myException($exception) {
  	echo "<b>Exception:</b> " , $exception->getMessage();
  }

 
