 <?php
  require_once("TableToArray.php");

  $converter2 = new FLX\TableToArray();
//  $converter2->convert("http://www.frontline-connect.com/weeklysched.cfm?fac=jaxice&facid=1",2);
//  $converter2->print_array();

//  $events = $converter2->convert("http://www.frontline-connect.com/monthlyevents.cfm?fac=jaxice&facid=1&session=4&month=10",3);
//  print_r($events);
//  $converter2->print_array();

  $events = $converter2->convert("http://www.frontline-connect.com/dailyevents.cfm?fac=jaxice&facid=1",3);
  print_r($events);
  $converter2->print_array();


?> 
