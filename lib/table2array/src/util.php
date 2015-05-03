<?php
  /**
   * Check if the url is valid and is up (returning HTTPCODE 200)
   * if site does not return http code 200, code sleeps for 10 minutes
   *
   * @param string $url site to check
   * @return boolean returns true if site is returning content
   */
  function isValidUrl($url){
    $sleepSeconds = 600;
    $isInvalid = true;
    do{
      $headers = @get_headers($url);
      if(strpos($headers[0],'HTTP/1.1 200') !== false){
        break;
      } else {
        echo $url . " returns with " . $headers[0] . ". Sleeping for ". $sleepSeconds . " seconds.";
      }
      sleep($sleepSeconds);
    } while ($isInvalid);

    return true;
  }
?>
