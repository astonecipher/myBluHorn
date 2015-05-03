<?php
namespace Scraper32;
date_default_timezone_set('UTC');
require_once("TableToArray.php");

/**
 * Class FrontLineConnect
 *
 * Used to scrap data from http://www.frontline-connect.com site
 */
class FrontLineConnect extends TableToArray{
  public static $dailyEventUrl = "http://www.frontline-connect.com/dailyevents.cfm?fac=jaxice&facid=1";
  public static $weekEventUrl = "http://www.frontline-connect.com/weeklysched.cfm?fac=jaxice&facid=1";
  public static $monthEventUrl = "http://www.frontline-connect.com/monthlyevents.cfm?fac=jaxice&facid=1&session=%d&month=%d";

  function __constructor() {
  }



  /**
   * Populates a 2-dimensional array with the contents of an html table. Uses a POST request
   * to get the contents of a page
   * 
   * @param string $date date for which the data needs to be extracted. Date in mm/dd/yyyy format
   * @return array returns a two dimensional array with the contents or returns an empty array
   */
  function getDailyEventData($date) {
    //Check date format
    $format = "m/d/Y";
    $eventDate = date_create_from_format($format, $date);
    if(!$eventDate) {
      // createFromFormat returns false if the format is invalid or date is invalid
      echo "Please enter a valid date in mm/dd/yyyy format. Cannot proceed due to invalid date error";
    } else {
      $data;
      $data['SelectedDate'] = $date;
      $data['surfSelect']=0;
      $data['sChange']="Get Date";
      return parent::convertByPOST(self::$dailyEventUrl,$data,3);
    }
  }


  /**
   * Populates a 2-dimensional array with the contents of an html table. Uses a POST request
   * to get the contents of a page
   * 
   * @param string $date date for which the data needs to be extracted. Date in mm/dd/yyyy format
   *                     Date should be that of the Monday before the week. Eg. for 10/26/2014 week, 
   *                     the date passed should be 10/20/2014
   * @return array returns a two dimensional array with the contents or returns an empty array
   */
  function getWeeklyEventData($date) {
    //Check date format
    $format = "m/d/Y";
    $eventDate = date_create_from_format($format, $date);
    if(!$eventDate) {
      // createFromFormat returns false if the format is invalid or date is invalid
      echo "Please enter a valid date in mm/dd/yyyy format. Cannot proceed due to invalid date error";
    } else {
      $data;
      $data['nextDay']="View Next Week >>";
      $data['hbdate'] = "{ts '".date_format($eventDate,"Y-m-d")." 02:37:51'}";
      return parent::convertByPOST(self::$weekEventUrl,$data,2);
    }
  }


  /**
   * Populates a 2-dimensional array with the contents of an html table. Uses a POST request
   * to get the contents of a page
   * 
   * @param int $month month for which the data needs to be extracted
   * @param int $session session for which data needs to be extracted. Possible session values
   *    1    Public Session
   *    2    Open Hockey
   *    3    Private Rental
   *    4    Freestyle Ice
   *    5    YHL
   *    6    Featured Events   
   *    7    AHL  
   * @return array returns a two dimensional array with the contents or returns an empty array
   */
  function getMonthlyEventData($month, $session=7) {
    //Check month format
    $isValidMonth = date_create_from_format("m", $month);
    if(!$isValidMonth) {
      //TODO Add any more validations that may be required
      // createFromFormat returns false if the format is invalid or month is invalid
      echo "Please enter a valid month as an int. Cannot proceed due to invalid month error";
    } else if(!is_numeric($session) && ($session>0 && $session<8)){
      //$session is not valid
      echo "Please enter a valid session as an int with value between 1 and 7 inclusive. Cannot proceed due to invalid session error";
    }else {
      $monthUrl = sprintf(self::$monthEventUrl, $session, $month);
      return parent::convert($monthUrl,3);
    }
  }
}
?>
