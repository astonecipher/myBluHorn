<?php
//============================================================+
// File name   : example_048.php
// Begin       : 2009-03-20
// Last Update : 2013-05-14
//
// Description : Example 048 for TCPDF class
//               HTML tables and table headers
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: HTML tables and table headers
 * @author Nicola Asuni
 * @since 2009-03-20
 */

// Include the main TCPDF library (search for installation path).
require_once('/var/www/html/tcpdf/examples/tcpdf_include.php');

function makePDF($report, $reportID, $records) {

error_log("Creating Schedule");

$border = 0;
$maxWeeks = 13; 
$fontSize = 6;
$reportTitleFontSize=8;

// create new PDF document
$pdf = new TCPDF("L", PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('BluHorn');
$pdf->SetTitle('TV Schedule');
$pdf->SetSubject('TV Schedule');
$pdf->SetKeywords('');

// set default header data
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, "TV Schedule", PDF_HEADER_STRING);
$pdf->SetPrintHeader(false);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', 14));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetMargins(5, 2, 5);
$pdf->SetHeaderMargin(0);
$pdf->SetFooterMargin(5);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, 10);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

$report->status($reportID, "Generating");

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', 'B', 12);

// add a page
$pdf->AddPage();

$totalSpots = 0;
$totalSpend = 0;
$totalSpotsPerWeek = array();
$totalSpotsPerWorksheet = array();
$totalSpotsPerWorksheetWeek = array();
$broadcastMonths = array();

$vendors = array();

$monthStr = "";

$clients = array();
$campaigns = array();
$markets = array();
$vendors = array();

$clientStr = "";
$campaignStr = "";
$dateFromStr = "";
$dateToStr = "";
$marketStr = "";

foreach ($records as $record) {

		foreach($record["broadcastMonths"] as $month) {
			$broadcastMonths[$month["name"]] = array("name"=>$month["name"]);
			foreach ($month["weeks"] as $week) {
				$broadcastMonths[$month["name"]]["weeks"][$week] = $week;
			}
			$monthStr .= print_r($month,true);
		}
		
$report->status($reportID, "Adding Record");

$borderTopStr="border-top: 0.5px solid #000;";
$borderBottomStr="border-bottom: none;";

$offset=0;

$weekNames = $record["weekNames"];

$totalSpotsPerWorksheetLine = array();
$totalSpendPerWorksheetLine = array();


if (count($weekNames)>$maxWeeks) {
	$weekOffset=0;
}


for ($offset=0; $offset<count($weekNames); $offset += $maxWeeks) {

	if ($offset > 0) {
		$pdf->AddPage();
	}
	
$pdf->SetXY(4,3,true);
$pdf->SetFont('helvetica', 'B', $reportTitleFontSize);
$pdf->Write(0, 'TV Schedule', '', 0, 'L', true, 0, false, false, 0);

$pdf->SetFont('', '', 8);

// -----------------------------------------------------------------------------
$pdf->SetXY(4.7,7.5,true);

//$dumpStr = rPrint_r($data, true);
//$pdf->Write(0, $dumpStr, '', 0, 'L', true, 0, false, false, 0);

$tbl = <<<EOD
<table  cellspacing="0" cellpadding="1" border="$border" style="margin-right: 0px;">
    <tr>
        <td rowspan="4">Client: {$record["clients"]["name"]}<br />
        				Campaign: {$record["campaigns"]["name"]}<br />
        				Worksheet: {$record["sheet"]["name"]}<br />
						Dates: {$record["campaigns"]["flightStart"]} to {$record["campaigns"]["flightEnd"]} <br />
						Market: {$record["markets"]["name"]}<br /></td>
    </tr>
</table>
EOD;

$clientStr .= $record["clients"]["name"] . ", ";
array_push($clients, $record["clients"]["name"]);

$campaignStr .= $record["campaigns"]["name"] . ", ";
array_push($campaigns, $record["campaigns"]["name"]);

$marketStr[$record["markets"]["name"]] = $record["markets"]["name"];

if (($dateFromStr != "")  and (strtotime($dateFromStr)>strtotime($record["campaigns"]["flightStart"]))) {
	$dateFromStr = $record["campaigns"]["flightStart"];
}
else if ($dateFromStr == "") {
	$dateFromStr = $record["campaigns"]["flightStart"];	
}
if (($dateToStr != "")  and (strtotime($dateFromStr)<strtotime($record["campaigns"]["flightStart"]))) {
	$dateToStr = $record["campaigns"]["flightEnd"];
}
else if ($dateToStr == "") {
	$dateToStr = $record["campaigns"]["flightEnd"];	
}

$pdf->writeHTML($tbl, true, false, false, false, '');

$pdf->SetXY(4,28,true);
$pdf->Line(5, 25 , 292, 25);
$pdf->Write(0, '', '', 0, 'L', true, 0, false, false, 0);

$pdf->SetFont('', '', $fontSize);





$tbl = <<<EOD
<table cellspacing="0" cellpadding="2" border="0" >
<thead>
<tr style="text-align: center; font-weight:bold; margin-bottom: 10px; height: 100px;">
<th style="text-align: center; $borderBottomStr">Station</th>
<th style="text-align: center; $borderBottomStr">Daypart</th>
<th style="text-align: center; $borderBottomStr">Days</th>
<th style="width: 80px; text-align: center; $borderBottomStr">Time</th>
<th style="text-align: center; $borderBottomStr">Length</th>
<th style="text-align: center; width: 140px; $borderBottomStr" nowrap>Program</th>
EOD;
	
	$weekCounter=0;
	$weekNames = $record["weekNames"];
	foreach ($weekNames as $week) {
		if ((++$weekCounter > $offset) && ($weekCounter <= $maxWeeks+$offset)) {
			$weekStr = date("M-d",strtotime($week));
$tbl .= <<<EOD
<th style="$borderBottomStr width: 40px; text-align: center;">$weekStr</th>
EOD;
if (($week === end($weekNames))) {
	$tbl .= <<<EOD
<th style="$borderBottomStr text-align: center;">Spots</th>
<th style="text-align: center; $borderBottomStr">Rating</th>
<th style="text-align: center; $borderBottomStr">Cost</th>
EOD;

}
}

	}
	
	$tbl .= <<<EOD
</tr>
</thead>
<tbody>
EOD;
	
	$lineCounter=0;
	
	$lines = $record["lines"];

	$stations = unique($lines, "station", false);
	$vendors = unique($lines, "vendorID");

//	uasort($lines, "vendorSort");
//	uasort($lines, "stationSort");
	uasort($lines, "timeSort");

foreach ($vendors as $vendor) {
  foreach ($stations as $station) {
	  
	$spotCounter = 0;
	
	$totalSpendByStation = array();
	$totalSpotsPerWeekByStation = array();
	$totalSpotsByStation = array();
	

	foreach ($lines as $line) {

			if ($line["station"] == $station) {
				if ($line["vendorID"] == $vendor) {
				
		$lineStr = "";
		
		if ($lineCounter % 2) {
			$colorStr = "background-color: #eee;";
		}
		else {
			$colorStr = "";
		}
		
//		$displayedLine = $lineCounter+1;
		$displayedLine = $line["worksheetLine"];
		
		$report->status($reportID, "Adding Worksheet " . $line["worksheetID"] ." - Line $displayedLine");

if ($line["isBold"]) {
	$fontWtStr="font-weight:bold;";
}
else {
	$fontWtStr="font-weight:normal;";	
}		

$dayStr = "";
if ($line["isMonday"]) {
	$dayStr .="M";
}
else {
	$dayStr .= "--";
}	
if ($line["isTuesday"]) {
	$dayStr .="T";
}
else {
	$dayStr .= "--";
}
if ($line["isWednesday"]) {
	$dayStr .="W";
}
else {
	$dayStr .= "--";
}
if ($line["isThursday"]) {
	$dayStr .="R";
}
else {
	$dayStr .= "--";
}
if ($line["isFriday"]) {
	$dayStr .="F";
}
else {
	$dayStr .= "--";
}
if ($line["isSaturday"]) {
	$dayStr .="S";
}
else {
	$dayStr .= "--";
}
if ($line["isSunday"]) {
	$dayStr .="S";
}
else {
	$dayStr .= "--";
}

$lineStr .= <<<EOD
<tr style="$colorStr $fontWtStr $borderTopStr">
<td style="_width: 45px;">{$line["station"]}</td>
<td style="_width: 45px;">{$line["daypart"]}</td>
<td style="_width: 45px;">$dayStr</td>
<td style="width: 80px; white-space: nowrap;" nowrap>{$line["timePeriod"]}</td>
<td style="_width: 45px;">{$line["seconds"]}</td>
<td style="width: 140px; white-space: nowrap;" nowrap>{$line["programName"]}</td>
EOD;
		
		
		$weekCounter=0;
		$weekNames = $record["weekNames"];
		$wsWeeks = $record["wsWeeks"];
		

		
		foreach ($weekNames as $week) {
		if ((++$weekCounter > $offset) && ($weekCounter <= $maxWeeks+$offset)) {

$lineStr .= <<<EOD
<td style="width: 40px; text-align: center;">{$wsWeeks[$displayedLine][$weekCounter]}</td>
EOD;

$totalSpotsPerWorksheetLine[$displayedLine] += intval($wsWeeks[$displayedLine][$weekCounter]);
$totalSpotsPerWeekByStation[$station][$week] += intval($wsWeeks[$displayedLine][$weekCounter]);
$totalSpotsPerWeek[$week] += intval($wsWeeks[$displayedLine][$weekCounter]);
$totalSpendPerWeek[$week] += intval($wsWeeks[$displayedLine][$weekCounter]*$line["rate"]);

	if (array_key_exists($line["vendorName"], $vendors)) {

		$vendors[$line["vendorName"]]["totalSpendPerWeek"][$week] += intval($wsWeeks[$displayedLine][$weekCounter]*$line["rate"]);
		$vendors[$line["vendorName"]]["totalSpotsPerWeek"][$week] += intval($wsWeeks[$displayedLine][$weekCounter]);
	}
	else {
		
		$vendors[$line["vendorName"]]["totalSpendPerWeek"][$week] = intval($wsWeeks[$displayedLine][$weekCounter]*$line["rate"]);
		$vendors[$line["vendorName"]]["totalSpotsPerWeek"][$week] = intval($wsWeeks[$displayedLine][$weekCounter]);
	}

if (($week === end($weekNames))) {
	$lineStr .= <<<EOD
<td style="text-align: center;">{$totalSpotsPerWorksheetLine[$displayedLine]}</td>
EOD;
$totalSpotsPerWorksheet[$line["worksheetID"]] += $totalSpotsPerWorksheetLine[$displayedLine];
$totalSpots += $totalSpotsPerWorksheetLine[$displayedLine];
$totalSpotsByStation[$station] += $totalSpotsPerWorksheetLine[$displayedLine];
$totalSpendPerWorksheetLine[$line["worksheetID"]] += $totalSpotsPerWorksheetLine[$displayedLine]*$line["rate"];
$totalSpend += $totalSpotsPerWorksheetLine[$displayedLine]*$line["rate"];
$totalSpendByStation["station"] += $totalSpotsPerWorksheetLine[$displayedLine]*$line["rate"];

	if (array_key_exists($line["vendorName"], $vendors)) {

		$vendors[$line["vendorName"]]["totalSpots"] += $totalSpotsPerWorksheetLine[$displayedLine];
		$vendors[$line["vendorName"]]["totalSpend"] += $totalSpotsPerWorksheetLine[$displayedLine]*$line["rate"];

	}
	else {
		
		$vendors[$line["vendorName"]]["totalSpots"] = $totalSpotsPerWorksheetLine[$displayedLine];
		$vendors[$line["vendorName"]]["totalSpend"] = $totalSpotsPerWorksheetLine[$displayedLine]*$line["rate"];

	}
}

}

		}

setlocale(LC_MONETARY, 'en_US');
$lineSpend = money_format("%!n", $line["rate"]*$totalSpotsPerWorksheetLine[$displayedLine]);		

$lineStr .= <<<EOD
<td style="">{$line["aqhRating"]}</td>
<td style="text-align: right;">{$lineSpend}</td>
</tr>
EOD;

/*
if ($line["comments"]) {
$tbl .= <<<EOD
<tr style="$colorStr $borderBottomStr" >
<td style="" colspan="2" style="text-align: right;"><strong>Comments:</strong></td>
<td style="text-align: left;" colspan="13"> <strong><i style="color: #f00;">{$line["comments"]}</i></strong></td>
<td></td>
</tr>
EOD;
}
*/
		if ($totalSpotsPerWorksheetLine[$displayedLine] > 0) {


					$tbl .= $lineStr;
					$lineCounter++;	
					$spotCounter++;		
	
			}	
		}
		}
	}
	
	if ($spotCounter > 0) {

$tbl .= <<<EOD
<tr>
<td colspan="6" style="text-align: left;"><strong>{$station} Spot Totals</strong>
</td>
EOD;

		$weekCounter=0;
		$weekNames = $record["weekNames"];
		$wsWeeks = $record["wsWeeks"];
		
		foreach ($weekNames as $week) {
		if ((++$weekCounter > $offset) && ($weekCounter <= $maxWeeks+$offset)) {

$tbl .= <<<EOD
<td style="width: 40px; text-align: center;"><strong>{$totalSpotsPerWeekByStation[$station][$week]}</strong></td>
EOD;
}

}



$totalSpendByStationStr = money_format("%n",$totalSpendByStation["station"]);

$tbl .= <<<EOD
<td><strong>{$totalSpotsByStation[$station]}</strong></td>
<td></td>
<td style="text-align: right;"><strong>{$totalSpendByStationStr}</strong><br></td>
</tr>
EOD;

	}
  }
}


$tbl .= <<<EOD
<tr>
<td colspan="6" style="text-align: left;"><strong>Schedule Totals</strong>
</td>
EOD;

		$weekCounter=0;
		$weekNames = $record["weekNames"];
		$wsWeeks = $record["wsWeeks"];
		
		foreach ($weekNames as $week) {
		if ((++$weekCounter > $offset) && ($weekCounter <= $maxWeeks+$offset)) {

$tbl .= <<<EOD
<td style="width: 40px; text-align: center;"><strong>{$totalSpotsPerWeek[$week]}</strong></td>
EOD;
}

}



$totalSpendStr = money_format("%n",$totalSpend);

$tbl .= <<<EOD
<td><strong>{$totalSpots}</strong></td>
<td></td>
<td style="text-align: right;"><strong>{$totalSpendStr}</strong><br></td>
</tr>
EOD;

$tbl .= <<<EOD
</tbody></table>
EOD;
	
	//$pdf->SetXY(1,30,true);
	$pdf->writeHTML($tbl, true, false, false, false, 'C');
	


}
if (!($record === end($records))) {
	$pdf->AddPage();
}

}

//$pdf->writeHTML(print_r($totalSpotsPerWorksheetWeek,true), true, false, false, false, '');

/*
$pdf->writeHTML("Broadcast Months:",true, false, false, false, '');

$totalSpotsStr=print_r($broadcastMonths,true);

$pdf->writeHTML($totalSpotsStr,true, false, false, false, '');
$pdf->writeHTML("Broadcast Months Str:",true, false, false, false, '');
$pdf->writeHTML($monthStr,true, false, false, false, '');
*/


$report->status($reportID, "Writing Report");


$report->status($reportID, "");

$report->isReady($reportID, "1");

//Close and output PDF document
return $pdf->Output("/var/www/html/bluhorn/pdf/documents/" . $reportID . ".pdf", 'I');

}

function rPrint_r ($bigArray) {
	if (!isset($rStr)) {
		$rStr = "";
		$counter = 0;
	}
	
	foreach ($bigArray as $array) {
		if (is_array($array)) {
			$rStr .= rPrint_r($array);
			//error_log("rPrint_r recursing $counter: " . print_r($array,true));
		}
		$rStr .= print_r($array,true);
		$counter++;
	}
	
	return $rStr;
}

function timeSort($a, $b) {
	

	$aTimeStd = convertTimeToStd($a["timePeriod"]);
	$bTimeStd = convertTimeToStd($b["timePeriod"]);


	if ($aTimeStd == $bTimeStd) {
		error_log("Sort: " . $aTimeStd . " == " . $bTimeStd);
		return 0;
	}
	
	if ($aTimeStd < $bTimeStd) {
		error_log("Sort: " . $aTimeStd . " less than " . $bTimeStd);
		return -1;
	}
	
	if ($aTimeStd > $bTimeStd) {
		error_log("Sort: " . $aTimeStd . " greater than " . $bTimeStd);
		return 1;
	}
	
}

function vendorSort($a, $b) {
	
	if ($a["vendorID"] == $b["vendorID"]) {
		return 0;
	}
	
	if ($a["vendorID"] < $b["vendorID"]) {
		return -1;
	}
	
	if ($a["vendorID"] > $b["vendorID"]) {
		return 1;
	}
	
}

function stationSort($a, $b) {
	

	if ($a["station"] == $b["station"]) {
		return 0;
	}
	
	if ($a["station"] < $b["station"]) {
		return -1;
	}
	
	if ($a["station"] > $b["station"]) {
		return 1;
	}
	
}

function convertTimeToStd($timeStr) {

	$timeSplit = explode("-", $timeStr);

	$startTime = $timeSplit[0];
	$endTime = $timeSplit[1];

	$startTimeM = substr($startTime, -1);
	$endTimeM = substr($endTime, -1);
	
	$startTime = intval(substr($startTime, 0,4));
	$endTime = intval(substr($endTime, 0,4));
	
	if ($startTimeM == "P") {
		$startTime += 1200;
	}

	if ($endTimeM == "P") {
		$endTime += 1200;
	}
	
	return $startTime . $endTime;
}

function unique($rows, $field, $skipBlank = true) {
	
	$items = array();
	
	foreach ($rows as $row) {
		if (! in_array($row[$field], $items)) {
			if ($skipBlank) {
				if ($row[$field] != "") {
					array_push($items, trim($row[$field]));	
				}
			}
			else {
				array_push($items, trim($row[$field]));					
			}
		}
	}
	
	return $items;
}

//============================================================+
// END OF FILE
//============================================================+