 <?php
  require_once("TableToArray.php");
  require_once("FrontLineConnect.php");

  $frontLineConnect = new Scraper32\FrontLineConnect();

// Daily data - enter date here in mm/dd/yyyy format
  $dailyEvents = $frontLineConnect->getDailyEventData("1/22/2015");
//  $frontLineConnect->print_array();			// Print to screen	
//  $frontLineConnect->print_array("output_daily.txt","\r\n");	// Print to file
 
	print_r($dailyEvents);

// Monthly data - First argument is month - 1 (January) thru 12 (December)
// Second argument is session 
//	1	Public Session
//	2	Open Hockey
//	3	Private Rental
//	4	Freestyle Ice
//	5	YHL
//	6	Featured Events	
//	7	AHL

/*
  $frontLineConnect->getMonthlyEventData(11, 7);
  $frontLineConnect->print_array();			// Print to screen	
  $frontLineConnect->print_array("output_monthly.txt","\r\n\r\n\r\n\r\n", "\r\n");	// Print to file
*/
?> 

