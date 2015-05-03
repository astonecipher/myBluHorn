<?php
namespace Scraper32;
require_once("simple_html_dom.php");
require_once("util.php");

/**
 * Class TableToArray
 *
 * Has method that can convert a html table to a 2-dimensional PHP array
 * Has method that can print the 2-dimensional array to console or file
 */
class TableToArray {
  var $arr; //Two dimensional array

  /**
   * Constructor. Initializes the two dimensional array
   */
  function __constructor() {
    $arr = array();
  }

  /**
   * Populates a 2-dimensional array with the contents of an html table. Uses regular 
   * get to get the contents of an html page
   * 
   * @param string $url the site that contains the table
   * @param integer $table_no the table number on the site that needs to be converted
   * @return array returns a two dimensional array with the contents or returns an empty array
   */
  function convert($url, $table_no=1) {
    if(isValidUrl($url)){
      $html = file_get_html($url);
      $this->getArray($html, $table_no);
    } else {
      echo "Url is not valid";
    }
    return $this->arr;
  }

  /**
   * Populates a 2-dimensional array with the contents of an html table. Uses a POST request
   * to get the contents of a page
   * 
   * @param string $url the site that contains the table
   * @param associative array $data data as name value pairs that needs to be passed in the post request
   * @param integer $table_no the table number on the site that needs to be converted
   * @return array returns a two dimensional array with the contents or returns an empty array
   */
  function convertByPOST($url, $data, $table_no=1) {
    if(isValidUrl($url)){
      $html = do_post_request($url, http_build_query($data));
      $this->getArray($html, $table_no);
    } else {
      echo "Url is not valid";
    }
    return $this->arr;
  }

  /**
   * Populates a 2-dimensional array with the contents of an html table got for $html
   * It does not parse nested tables. It will pull the data of the nested tables though
   *
   * @param string $html html as a dom object
   * @param integer $table_no the table number on the site that needs to be converted
   * @return array returns a two dimensional array with the contents or returns an empty array
   */
  function getArray($rawhtml, $table_no=1){
    $html = str_get_html(clean_html($rawhtml));

    $tables = $html->find('table');
    //$table_no is valid
    if(is_numeric($table_no) && count($tables) >= $table_no){
      //empty existing contents of array
      unset($this->arr);
      $this->arr = array();

      $verifier = $table_no - 1;
      $table = $tables[$table_no - 1];
      $table->id = $verifier;
      $trCt = 0;
      //Loop through the rows
      foreach($table->find("tr") as $tr){
        //check if parent table or grandparent table (in case of thead, tbody etc) is same table
        //this is to prevent nested table <tr>'s to be extracted together
        if($tr->parent()->id === $verifier || $tr->parent()->parent()->id === $verifier){
        $tdCt = 0;
        //Loop through the columns
        foreach($tr->find("td, th") as $td){
          //replace all <hr> tags with <br/>
          foreach ($td->find("hr") as $hr){
            $hr->outertext = "<br/>";
          }
          $this->arr[$trCt][$tdCt] = trim(strip_tags(preg_replace("/\s+/", " ", $td->innertext), "<br>"));
          $tdCt++;
        }
        $trCt++;
      }
      }
    } else {
      echo "Error in table number";
    }
    return $this->arr;
  }

  /**
   * Prints $this->arr as a table using the row separator and column separator provided as
   * arguments to this method. Prints to the console or a file path if the file path is given
   *
   * @param string $row_sep delimiter that separates the different rows default is new line
   * @param string $col_sep delimiter that separates the different columns default is |
   * @filepath string $file_path optional. If exists, output prints to file
   *
   */ 
  function print_array($file_path="", $row_sep = "\n", $col_sep = "\t") {
    if($this->arr != null && count($this->arr) > 0){
      $row = 0;
      //starting buffer to print
      ob_start();
      foreach($this->arr as $row){
        echo implode($col_sep, $row);
        echo $row_sep;
      }
      $contents = ob_get_contents();
      ob_end_clean(); //clean buffer and close it

      //write to a file if it is provided
      if(strlen($file_path) > 0){
        file_put_contents($file_path,$contents);
      } else {
        //print to console
        echo $contents;
      }
    } else {
      echo "Empty array. Nothing to print.";
    }
  }
}
?>

