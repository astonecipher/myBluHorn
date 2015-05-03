<?php

  
  define("BASEDIR", "/var/www/html/buzz/");
  define("FLXDIR", "/var/www/html/lib/filelogix/");
  define("CLASSDIR", "classes/");
  define("CUSTOMDIR", "custom/");
  define("PLUGINSDIR", "plugins/");
  define("CALDIR", "CAL/");
  define("FORMSDIR", "CAL/");
  define("SMARTY_DIR", "/usr/local/lib/Smarty-3.1.13/libs/");
  define("DB", "buzz");
  define("HEADER", "header.php");
  define("FOOTER", "footer.php");

  error_reporting(E_ALL);
  
  date_default_timezone_set('America/New_York');
  
  set_exception_handler(myException);
  
	//  error_reporting(0);
	//  error_log("debugging " . DB);
  
    // *nix style (note capital 'S')
    
    
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
	  

	  $db=new database("mysql:host=localhost;dbname=" . DB, "root", "", NULL);
	  $session = new session($db);
	  $connection = new connection($db);
	  	  
	  $request = new request($db, $connection->uri(), "buzz");

	  $controller = new controller($db, $request);

	  $page = new page($db, $connection->id());
 	
	  $rqst["controller"] = trim($page->controller($request));
	  $rqst["view"]="login";
	  $rqst["action"]=trim($request->getAction());
	  
	  if ($controller->open($page->controller($request))) {
		  if ($rqst["action"]) {
			  if (!$controller->go($rqst["action"])) {
		  		  error_log("Action Error: " . $rqst["action"]);	
	 	 		  $view = new view($db, $controller->view());		  
				  $view->toHTML(null);
				  exit(1);			  
			  }
		  }
	  }
	  error_log("Transferring: " . $controller->transfer());

	  
	  if ($controller->transfer()) {
	  	  header("Location: " . $controller->transfer() . "\n\n");
	  	  exit(1);
	  }
	  
	  else if ($controller->view()) {
		  $view = new view($db, $controller->view());
	  }
	  
	  else {
	  	  if ($request->getPage()=="") {
		  	  
	  		  $view = new view($db, "CAL_SEARCH");		  
	  	  }
	  	  else {
	  	  	
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

 
?>