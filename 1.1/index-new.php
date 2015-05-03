<?php

  
  define("CLASSDIR", "classes/");
  define("CUSTOMDIR", "custom/");
  define("PLUGINSDIR", "plugins/");
  define("SMARTY_DIR", "/usr/local/lib/Smarty-3.1.13/libs/");
  define("DB", "letsgomaa");
  define("HEADER", "header.php");
  define("FOOTER", "footer.php");

  error_reporting(E_ALL);
  
  date_default_timezone_set('America/New_York');
  
  set_exception_handler(myException);
  
	//  error_reporting(0);
	//  error_log("debugging " . DB);
  
    // *nix style (note capital 'S')
    
    
  try {	
	  function __autoload($class_name) {
		  error_log("looking for $class_name");
		  $class_name = end(explode("\\", $class_name));
		  error_log("updated looking for $class_name");

	  	  if (file_exists(CLASSDIR . "controllers/" . $class_name . '.controller.php')) {
		  		error_log("loading $class_name");
		    	include_once (CLASSDIR . "controllers/" . $class_name . '.controller.php');
	      }
	      
	  	  if (file_exists(CLASSDIR . $class_name . '.class.php')) {	  	  
		  	  	include_once (CLASSDIR . $class_name . '.class.php');
		  }
	 	  elseif (file_exists(CLASSDIR . "controllers/" . $class_name . '.controller.php')) {
		  		error_log("loading $class_name");
		    	include_once (CLASSDIR . "controllers/" . $class_name . '.controller.php');
	      }
		  elseif (file_exists(CUSTOMDIR . $class_name . '.class.php')) {
		    	include_once (CUSTOMDIR . $class_name . '.class.php');
	      }
	  	  elseif (file_exists(SMARTY_DIR . $class_name . '.php')) {
		    	include_once (SMARTY_DIR . $class_name . '.php');
	      }
	  	  elseif (file_exists(SMARTY_DIR . "plugins/" . strtolower($class_name) . '.php')) {
		    	include_once (SMARTY_DIR . "plugins/" . strtolower($class_name) . '.php');
	      }
	  	  elseif (file_exists(SMARTY_DIR . "sysplugins/" . strtolower($class_name) . '.php')) {
		    	include_once (SMARTY_DIR . "sysplugins/" . strtolower($class_name) . '.php');
	      }
	      elseif (file_exists(CLASSDIR . "fields/" . $class_name . '.class.php')) {
		    	include_once (CLASSDIR . "fields/" . $class_name . '.class.php');
	      }
		  elseif (file_exists(CUSTOMDIR . "fields/" . $class_name . '.class.php')) {
		    	include_once (CUSTOMDIR . "fields/" . $class_name . '.class.php');
	      }	     
	      elseif (file_exists(PLUGINSDIR . $class_name . '.class.php')) {
		    	include_once (PLUGINSDIR . $class_name . '.class.php');
	      }	      
	      else {
		         throw new Exception("Error loading $class_name library.");		      
	      }

	  }
	  
	  
	  $global = array();
	  
	  $db=new database("mysql:host=localhost;dbname=" . DB, "root", "", NULL);

	  $session = new session($db);

	  $connection = new connection($db);
	  	  
	  $request = new request($db, $connection->uri());

	  $controller = new controller($db, $request);

	  $page = new page($db, $connection->id());

	  $auth = new auth($db);

	  $config = new config($db);

	  $global["db"] = $db;
	  $global["session"] = $session;
	  $global["connection"] = $connection;
	  $global["request"] = $request;
	  $global["page"] = $page;
	  $global["auth"] = $auth;
	  $global["config"] = $config;
	  
	  $route = new route($global);
	  
	  $rqst["controller"] = $route->getController();
	  $rqst["view"] = $route->getView();
	  $rqst["action"] = $route->getAction();
	  
//	  $isAuthenticated = $auth->login("wes.benwick@letsgomaa.org","");
 	
//	  $rqst["controller"] = trim($page->controller($request));
//	  $rqst["view"]="login";
//	  $rqst["action"]=trim($request->getAction());
	  

//	  $controller = new $rqst["controller"]($db, session_id(), "test");

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

	  
//	  $data->open();
//	  $data->$rqst["action"]("login");
	     
//	  $view = new view($db, $page->view());
//	  $view->toHTML($data->data());	


	  if ($controller->transfer()) {
	  	  header("Location: " . $controller->transfer() . "\n\n");
	  	  exit(1);
	  }
	  else if ($controller->view()) {
		  $view = new view($db, $controller->view());
	  }
	  else {
	  	  if ($request->getPage()=="") {
		  	  
	  		  $view = new view($db, "home");		  
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