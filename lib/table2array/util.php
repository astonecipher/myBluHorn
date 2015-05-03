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
      if(strpos($headers[0],'200 OK') !== false){
        break;
      } else {
        echo $url . " returns with " . $headers[0] . ". Sleeping for ". $sleepSeconds . " seconds.";
        sleep($sleepSeconds);
      }
    } while ($isInvalid);

    return true;
  }


  /**
   * Does a HTTP POST request to the given url with data that needs to be passed
   *
   * @param string $url site to check
   * @param data data that needs to be passed to the url as an associative array
   * @param optional_headers any additional headers. Default is null
   * @return dom object returns the html as a dom object
   */
  function do_post_request($url, $data, $optional_headers = null)
  {
    $params = array('http' => array(
              'method' => 'POST',
              'header'=> "Content-type: application/x-www-form-urlencoded",
              'content' => $data
            ));
    if ($optional_headers !== null) {
      $params['http']['header'] = $optional_headers;
    }
    $ctx = stream_context_create($params);
    return file_get_html($url, false, $ctx);
  }


  /**
   * Validates if the date is a valid date in the given format
   *
   * @param string $date date to be validated
   * @param string $format format used by the date
   * @return bool true if date is valid else false
   *
   */
  function clean_html($rawhtml){
    libxml_use_internal_errors(true);
    $dom_obj = new DomDocument();
    $dom_obj->loadHTML($rawhtml);
    return $dom_obj->saveXML();
  }
?>
