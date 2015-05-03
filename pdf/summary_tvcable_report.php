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

$border = 0;
$maxWeeks = 4; 
$fontSize = 6;
$reportTitleFontSize=8;

// create new PDF document
$pdf = new TCPDF("L", PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('BluHorn');
$pdf->SetTitle('TV/Cable Summary');
$pdf->SetSubject('Broadcast TV/Cable Summary Report');
$pdf->SetKeywords('');

// set default header data
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, "TV Insertion Order", PDF_HEADER_STRING);
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
$pdf->Write(0, 'TV/Cable Summary', '', 0, 'L', true, 0, false, false, 0);

$pdf->SetFont('helvetica', '', 8);

// -----------------------------------------------------------------------------
$pdf->SetXY(4.7,7.5,true);

//$dumpStr = rPrint_r($data, true);
//$pdf->Write(0, $dumpStr, '', 0, 'L', true, 0, false, false, 0);

$tbl = <<<EOD
<table  cellspacing="0" cellpadding="1" border="$border" style="margin-right: 0px;">
    <tr>
        <td rowspan="4">Client: {$record["clients"]["name"]}<br />
        				Campaign: {$record["campaigns"]["name"]}<br />
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

$pdf->SetFont('helvetica', '', $fontSize);





$tbl = <<<EOD
<table cellspacing="0" cellpadding="2" border="0" >
<thead>
<tr style="text-align: center; font-weight:bold; margin-bottom: 10px; height: 100px;">
<th style="text-align: center; $borderBottomStr">Wksht/Line</th>
<th style="text-align: center; $borderBottomStr">Vendor</th>
<th style="text-align: center; $borderBottomStr">Station</th>
<th style="text-align: center; _width: 30px; $borderBottomStr white-space: nowrap;" nowrap>DP</th>
<th style="text-align: center; $borderBottomStr">Day(s)</th>
<th style="text-align: center; _width: 45px; $borderBottomStr">Time</th>
<th style="text-align: center; width: 100px; $borderBottomStr" nowrap>Program Name</th>
<th style="text-align: center; $borderBottomStr">Length</th>
<th style="text-align: center; $borderBottomStr">Rate</th>
<th style="text-align: center; $borderBottomStr">Rating</th>
<th style="text-align: center; $borderBottomStr">CPP</th>
<th style="text-align: center; $borderBottomStr">CPM</th>
EOD;
	
	$weekCounter=0;
	$weekNames = $record["weekNames"];
	foreach ($weekNames as $week) {
		if ((++$weekCounter > $offset) && ($weekCounter <= $maxWeeks+$offset)) {

$tbl .= <<<EOD
<th style="$borderBottomStr width: 45px; text-align: center;">$week</th>
EOD;
if (($week === end($weekNames))) {
	$tbl .= <<<EOD
<th style="$borderBottomStr text-align: center;">Spots</th>
EOD;

}
}

	}
	
	$tbl .= <<<EOD
</tr>
</thead>
EOD;
	
	$lineCounter=0;
	
	$lines = $record["lines"];
	
	foreach ($lines as $line) {

	
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
	$dayStr .= "";
}
if ($line["isTuesday"]) {
	$dayStr .="T";
}
else {
	$dayStr .= "";
}
if ($line["isWednesday"]) {
	$dayStr .="W";
}
else {
	$dayStr .= "";
}
if ($line["isThursday"]) {
	$dayStr .="R";
}
else {
	$dayStr .= "";
}
if ($line["isFriday"]) {
	$dayStr .="F";
}
else {
	$dayStr .= "";
}
if ($line["isSaturday"]) {
	$dayStr .="Sa";
}
else {
	$dayStr .= "";
}
if ($line["isSunday"]) {
	$dayStr .="Su";
}
else {
	$dayStr .= "";
}

$tbl .= <<<EOD
<tbody>
<tr style="$colorStr $fontWtStr $borderTopStr">
<td style="">{$line["worksheetID"]}-$displayedLine</td>
<td style="_width: 45px;">{$line["vendorName"]}</td>
<td style="_width: 45px;">{$line["station"]}</td>
<td style="_width: 45px;">{$line["daypart"]}</td>
<td style="_width: 45px;">$dayStr</td>
<td style="_width: 80px; white-space: nowrap;" nowrap>{$line["timePeriod"]}</td>
<td style="width: 100px; white-space: nowrap;" nowrap>{$line["programName"]}</td>
<td style="white-space: nowrap;" nowrap>{$line["seconds"]}</td>
<td style="">{$line["rate"]}</td>
<td style="">{$line["aqhRating"]}</td>
<td style="">{$line["cpp"]}</td>
<td style="">{$line["cpm"]}</td>
EOD;
		
		
		$weekCounter=0;
		$weekNames = $record["weekNames"];
		$wsWeeks = $record["wsWeeks"];
		

		
		foreach ($weekNames as $week) {
		if ((++$weekCounter > $offset) && ($weekCounter <= $maxWeeks+$offset)) {

$tbl .= <<<EOD
<td style="width: 45px; text-align: center;">{$wsWeeks[$displayedLine][$weekCounter]}</td>
EOD;

$totalSpotsPerWorksheetLine[$displayedLine] += intval($wsWeeks[$displayedLine][$weekCounter]);
$totalSpotsPerWeek[$week] += intval($wsWeeks[$displayedLine][$weekCounter]);
$totalSpendPerWeek[$week] += intval($wsWeeks[$displayedLine][$weekCounter]*$line["rate"]);
$totalGRPsPerWeek[$week] += intval($wsWeeks[$displayedLine][$weekCounter]*$line["aqhRating"]);

	if (array_key_exists($line["vendorName"], $vendors)) {

		$vendors[$line["vendorName"]]["totalSpendPerWeek"][$week] += intval($wsWeeks[$displayedLine][$weekCounter]*$line["rate"]);
		$vendors[$line["vendorName"]]["totalGRPsPerWeek"][$week] += intval($wsWeeks[$displayedLine][$weekCounter]*$line["aqhRating"]);
		$vendors[$line["vendorName"]]["totalSpotsPerWeek"][$week] += intval($wsWeeks[$displayedLine][$weekCounter]);
	}
	else {
		
		$vendors[$line["vendorName"]]["totalSpendPerWeek"][$week] = intval($wsWeeks[$displayedLine][$weekCounter]*$line["rate"]);
		$vendors[$line["vendorName"]]["totalGRPsPerWeek"][$week] = intval($wsWeeks[$displayedLine][$weekCounter]*$line["aqhRating"]);
		$vendors[$line["vendorName"]]["totalSpotsPerWeek"][$week] = intval($wsWeeks[$displayedLine][$weekCounter]);
	}

if (($week === end($weekNames))) {
	$tbl .= <<<EOD
<td style="text-align: center;">{$totalSpotsPerWorksheetLine[$displayedLine]}</td>
EOD;
$totalSpotsPerWorksheet[$line["worksheetID"]] += $totalSpotsPerWorksheetLine[$displayedLine];
$totalSpots += $totalSpotsPerWorksheetLine[$displayedLine];
$totalSpendPerWorksheetLine[$line["worksheetID"]] += $totalSpotsPerWorksheetLine[$displayedLine]*$line["rate"];
$totalSpend += $totalSpotsPerWorksheetLine[$displayedLine]*$line["rate"];

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
		
$tbl .= <<<EOD
</tr>
EOD;

if ($line["comments"]) {
$tbl .= <<<EOD
<tr style="$colorStr $borderBottomStr" >
<td style="" colspan="2" style="text-align: right;"><strong>Comments:</strong></td>
<td style="text-align: left;" colspan="13"> <strong><i style="color: #f00;">{$line["comments"]}</i></strong></td>
<td></td>
</tr>
</tbody>
EOD;
}
	
		$lineCounter++;
	
	}
	

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
//$pdf->SetXY(4,3,true);

/*
$pdf->SetFont('helvetica', '', 10);
$pdf->SetXY(4,$pdf->GetY()+5,true);

$pdf->Line(5, $pdf->GetY(), 292, $pdf->GetY());

$pdf->SetFont('helvetica', '', 9);

$tbl = <<<EOD
<table cellspacing="0" cellpadding="1" border="$border" style="margin-right: 10px;">
    <tr>
        <td rowspan="1"><strong>Agency</strong><br />
		</td>
    </tr>
</table>
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');
*/

// -----------------------------------------------------------------------------


$pdf->addPage();

$pdf->SetXY(4,3,true);
$pdf->SetFont('helvetica', 'B', $reportTitleFontSize);
$pdf->Write(0, 'TV/Cable Summary', '', 0, 'L', true, 0, false, false, 0);

$pdf->SetFont('helvetica', '', 8);

// -----------------------------------------------------------------------------
$pdf->SetXY(4.7,7.5,true);

//$dumpStr = rPrint_r($data, true);
//$pdf->Write(0, $dumpStr, '', 0, 'L', true, 0, false, false, 0);

$marketTextStr = implode(",",$marketStr);
$clientStr = implode(", ", array_unique($clients));
$clientTextStr = substr($clientStr,0,strlen($clientStr));
$campaignStr = implode(", ", array_unique($campaigns));
$campaignTextStr = substr($campaignStr,0,strlen($campaignStr));

$tbl = <<<EOD
<table cellspacing="0" cellpadding="1" border="$border" style="margin-right: 10px;">
    <tr>
        <td rowspan="4">Client: $clientTextStr<br />
        				Campaign: $campaignTextStr<br />
						Dates: $dateFromStr to $dateToStr <br />
						Market: $marketTextStr<br /></td>
    </tr>
</table>
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');
$pdf->SetXY(4,25,true);
$pdf->Line(5, 22 , 292, 22);
$pdf->Write(0, '', '', 0, 'L', true, 0, false, false, 0);

$pdf->SetFont('helvetica', '', 6);

//$dumpStr = rPrint_r($data, true);
//$pdf->Write(0, $dumpStr, '', 0, 'L', true, 0, false, false, 0);

$tbl = <<<EOD
<table cellspacing="0" cellpadding="5" border="1">
<thead>
<tr style="font-weight:bold; margin-bottom: 10px; height: 100px;">
<th style="$borderBottomStr">Summary</th>
EOD;

	$monthCounter=0;


	foreach ($broadcastMonths as $month) {
$tbl .= <<<EOD
<th style="$borderBottomStr text-align: center;">{$month["name"]}</th>
EOD;

	}



$tbl .= <<<EOD
<th style="text-align: center; $borderBottomStr">Report Total</th>


EOD;
	
	
	$tbl .= <<<EOD
</tr>
</thead>
<tbody>
EOD;

setlocale(LC_MONETARY, 'en_US');
$totalSpendStr = money_format("%n", $totalSpend);

$tbl .= <<<EOD

    <tr>
        <td>Total Spots</td>
EOD;
       
        	$monthCounter=0;
//	$broadcastMonths = $record["broadcastMonths"];
	foreach ($broadcastMonths as $month) {
$totalSpotsPerMonth = 0;	

		foreach($month["weeks"] as $monthWeek) {
			$totalSpotsPerMonth += $totalSpotsPerWeek[$monthWeek];
		}

$tbl .= <<<EOD
<td style="$borderBottomStr text-align: center;">$totalSpotsPerMonth</td>
EOD;

	}

$tbl .= <<<EOD
	<td style="text-align: center;">$totalSpots</td>
    </tr>    
    <tr>
        <td>Total Spend</td>
EOD;
       
        	$monthCounter=0;
//	$broadcastMonths = $record["broadcastMonths"];
	foreach ($broadcastMonths as $month) {
	
	$totalSpendPerMonth = 0;
	
		foreach($month["weeks"] as $monthWeek) {
			$totalSpendPerMonth += $totalSpendPerWeek[$monthWeek];
		}
	
	$totalSpendPerMonthStr = money_format("%n",$totalSpendPerMonth);
	
$tbl .= <<<EOD
<td style="$borderBottomStr text-align: center;">$totalSpendPerMonthStr</td>
EOD;

	}
	
$tbl .= <<<EOD
<td style="text-align: center;">$totalSpendStr</td>
   </tr>
EOD;


// GRPs, Reach and Freq

$tbl .= <<<EOD
<tr>
<td>Total GRPs</td>
EOD;


$totalGRPs = 0;
$totalSpots = 0;
       
        	$monthCounter=0;
//	$broadcastMonths = $record["broadcastMonths"];
	foreach ($broadcastMonths as $month) {
	
	$totalGRPsPerMonth = 0;
	
		foreach($month["weeks"] as $monthWeek) {
			$totalGRPsPerMonth += $totalGRPsPerWeek[$monthWeek];
		}
	
	$totalGRPsPerMonthStr = $totalGRPsPerMonth;
	
$tbl .= <<<EOD
<td style="$borderBottomStr text-align: center;">$totalGRPsPerMonthStr</td>
EOD;

$totalGRPs += $totalGRPsPerMonth;	

	}

	
$tbl .= <<<EOD
<td style="text-align: center;">$totalGRPs</td>
   </tr>
EOD;

// reach

$tbl .= <<<EOD
<tr>
<td>Total Reach</td>
EOD;


$totalGRPs = 0;
$totalSpots = 0;
       
        	$monthCounter=0;
//	$broadcastMonths = $record["broadcastMonths"];
	foreach ($broadcastMonths as $month) {
	
	$totalGRPsPerMonth = 0;
	$totalSpotsPerMonth = 0;
	
		foreach($month["weeks"] as $monthWeek) {
			$totalGRPsPerMonth += $totalGRPsPerWeek[$monthWeek];
			$totalSpotsPerMonth += $totalSpotsPerWeek[$monthWeek];
		}
	
	$totalGRPsPerMonthStr = $totalGRPsPerMonth;

	$totalReachPerMonth = ((1 - pow( 1 - ($totalGRPsPerMonth / $totalSpotsPerMonth / 100), $totalSpotsPerMonth)) * .85 * 100);

	$totalReachPerMonthStr = number_format($totalReachPerMonth, 2) . "%";
	
	error_log("Reach: ($totalSpotsPerMonth, $totalGRPsPerMonth) " . $totalReachPerMonthStr);
		
$tbl .= <<<EOD
<td style="$borderBottomStr text-align: center;">$totalReachPerMonthStr</td>
EOD;

$totalGRPs += $totalGRPsPerMonth;	
$totalSpots += $totalSpotsPerMonth;

	}

$totalReach = ((1 - pow( 1 - ($totalGRPs / $totalSpots / 100), $totalSpots)) * .85 * 100);

$totalReachStr = number_format($totalReach, 2) . "%";
	
	
$tbl .= <<<EOD
<td style="text-align: center;">$totalReachStr</td>
   </tr>
EOD;

// freq

$tbl .= <<<EOD
<tr>
<td>Total Frequency</td>
EOD;

$totalGRPs = 0;
$totalSpots = 0;
       
        	$monthCounter=0;
//	$broadcastMonths = $record["broadcastMonths"];
	foreach ($broadcastMonths as $month) {
	
	$totalGRPsPerMonth = 0;
	$totalSpotsPerMonth = 0;
	
		foreach($month["weeks"] as $monthWeek) {
			$totalGRPsPerMonth += $totalGRPsPerWeek[$monthWeek];
			$totalSpotsPerMonth += $totalSpotsPerWeek[$monthWeek];
		}
	
	$totalGRPsPerMonthStr = $totalGRPsPerMonth;

	$totalReachPerMonth = ((1 - pow( 1 - ($totalGRPsPerMonth / $totalSpotsPerMonth / 100), $totalSpotsPerMonth)) * .85 * 100);

	$totalFreqPerMonth = $totalGRPsPerMonth / $totalReachPerMonth;
	
	$totalFreqPerMonthStr = number_format($totalFreqPerMonth, 2);
	
$tbl .= <<<EOD
<td style="$borderBottomStr text-align: center;">$totalFreqPerMonthStr</td>
EOD;

$totalGRPs += $totalGRPsPerMonth;	
$totalSpots += $totalSpotsPerMonth;

	}

$totalReach = ((1 - pow( 1 - ($totalGRPs / $totalSpots / 100), $totalSpots)) * .85 * 100);

$totalFreq = $totalGRPs / $totalReach;

$totalFreqStr = number_format($totalFreq, 2);

	
$tbl .= <<<EOD
<td style="text-align: center;">$totalFreqStr</td>
   </tr>
EOD;


$tbl .= <<<EOD
</tbody>
</table>
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');

$vendorCount = 0;

foreach(array_keys($vendors) as $vendor) {

$tbl = "";

$vendorCount++;
if ($vendorCount > 3) {
	
	$tbl .= '<tcpdf method="AddPage" />';
	
}

$tbl .= <<<EOD
<table cellspacing="0" cellpadding="5" border="1">
<thead>
<tr style="font-weight:bold; margin-bottom: 10px; height: 100px;">
<th style="$borderBottomStr">$vendor</th>
EOD;

	$monthCounter=0;


	foreach ($broadcastMonths as $month) {
$tbl .= <<<EOD
<th style="$borderBottomStr text-align: center;">{$month["name"]}</th>
EOD;

	}



$tbl .= <<<EOD
<th style="text-align: center; $borderBottomStr">Report Total</th>


EOD;
	
	
	$tbl .= <<<EOD
</tr>
</thead>
<tbody>
EOD;

setlocale(LC_MONETARY, 'en_US');
$totalSpendStr = money_format("%i", $totalSpend);

$tbl .= <<<EOD

    <tr>
        <td>Total Spots</td>
EOD;
       
        	$monthCounter=0;
//	$broadcastMonths = $record["broadcastMonths"];
	foreach ($broadcastMonths as $month) {
$totalSpotsPerMonth = 0;	

		foreach($month["weeks"] as $monthWeek) {
			$totalSpotsPerMonth += $vendors[$vendor]["totalSpotsPerWeek"][$monthWeek];
		}

$tbl .= <<<EOD
<td style="$borderBottomStr text-align: center;">$totalSpotsPerMonth</td>
EOD;

	}

$tbl .= <<<EOD
	<td style="text-align: center;">{$vendors[$vendor]["totalSpots"]}</td>
    </tr>    
    <tr>
        <td>Total Spend</td>
EOD;


       
        	$monthCounter=0;
//	$broadcastMonths = $record["broadcastMonths"];
	foreach ($broadcastMonths as $month) {
	
	$totalSpendPerMonth = 0;
	
		foreach($month["weeks"] as $monthWeek) {
			$totalSpendPerMonth += $vendors[$vendor]["totalSpendPerWeek"][$monthWeek];
		}
	
	$totalSpendPerMonthStr = money_format("%n",$totalSpendPerMonth);
	
$tbl .= <<<EOD
<td style="$borderBottomStr text-align: center;">$totalSpendPerMonthStr</td>
EOD;

	}

$totalVendorSpend = money_format("%n", $vendors[$vendor]["totalSpend"]);	
	
$tbl .= <<<EOD
<td style="text-align: center;">$totalVendorSpend</td>
   </tr>
EOD;

// GRPs, Reach and Freq

$tbl .= <<<EOD
<tr>
<td>Total GRPs</td>
EOD;


$totalGRPs = 0;
$totalSpots = 0;
       
        	$monthCounter=0;
//	$broadcastMonths = $record["broadcastMonths"];
	foreach ($broadcastMonths as $month) {
	
	$totalGRPsPerMonth = 0;
	
		foreach($month["weeks"] as $monthWeek) {
			$totalGRPsPerMonth += $vendors[$vendor]["totalGRPsPerWeek"][$monthWeek];
		}
	
	$totalGRPsPerMonthStr = $totalGRPsPerMonth;
	
$tbl .= <<<EOD
<td style="$borderBottomStr text-align: center;">$totalGRPsPerMonthStr</td>
EOD;

$totalGRPs += $totalGRPsPerMonth;	

	}

	
$tbl .= <<<EOD
<td style="text-align: center;">$totalGRPs</td>
   </tr>
EOD;

// reach

$tbl .= <<<EOD
<tr>
<td>Total Reach</td>
EOD;


$totalGRPs = 0;
$totalSpots = 0;
       
        	$monthCounter=0;
//	$broadcastMonths = $record["broadcastMonths"];
	foreach ($broadcastMonths as $month) {
	
	$totalGRPsPerMonth = 0;
	$totalSpotsPerMonth = 0;
	
		foreach($month["weeks"] as $monthWeek) {
			$totalGRPsPerMonth += $vendors[$vendor]["totalGRPsPerWeek"][$monthWeek];
			$totalSpotsPerMonth += $vendors[$vendor]["totalSpotsPerWeek"][$monthWeek];
		}
	
	$totalGRPsPerMonthStr = $totalGRPsPerMonth;

	$totalReachPerMonth = ((1 - pow( 1 - ($totalGRPsPerMonth / $totalSpotsPerMonth / 100), $totalSpotsPerMonth)) * .85 * 100);

	$totalReachPerMonthStr = number_format($totalReachPerMonth, 2) . "%";
	
	error_log("Reach: ($totalSpotsPerMonth, $totalGRPsPerMonth) " . $totalReachPerMonthStr);
		
$tbl .= <<<EOD
<td style="$borderBottomStr text-align: center;">$totalReachPerMonthStr</td>
EOD;

$totalGRPs += $totalGRPsPerMonth;	
$totalSpots += $totalSpotsPerMonth;

	}

$totalReach = ((1 - pow( 1 - ($totalGRPs / $totalSpots / 100), $totalSpots)) * .85 * 100);

$totalReachStr = number_format($totalReach, 2) . "%";
	
	
$tbl .= <<<EOD
<td style="text-align: center;">$totalReachStr</td>
   </tr>
EOD;

// freq

$tbl .= <<<EOD
<tr>
<td>Total Frequency</td>
EOD;

$totalGRPs = 0;
$totalSpots = 0;
       
        	$monthCounter=0;
//	$broadcastMonths = $record["broadcastMonths"];
	foreach ($broadcastMonths as $month) {
	
	$totalGRPsPerMonth = 0;
	$totalSpotsPerMonth = 0;
	
		foreach($month["weeks"] as $monthWeek) {
			$totalGRPsPerMonth += $vendors[$vendor]["totalGRPsPerWeek"][$monthWeek];
			$totalSpotsPerMonth += $vendors[$vendor]["totalSpotsPerWeek"][$monthWeek];
		}
	
	$totalGRPsPerMonthStr = $totalGRPsPerMonth;

	$totalReachPerMonth = ((1 - pow( 1 - ($totalGRPsPerMonth / $totalSpotsPerMonth / 100), $totalSpotsPerMonth)) * .85 * 100);

	$totalFreqPerMonth = $totalGRPsPerMonth / $totalReachPerMonth;
	
	$totalFreqPerMonthStr = number_format($totalFreqPerMonth, 2);
	
$tbl .= <<<EOD
<td style="$borderBottomStr text-align: center;">$totalFreqPerMonthStr</td>
EOD;

$totalGRPs += $totalGRPsPerMonth;	
$totalSpots += $totalSpotsPerMonth;

	}

$totalReach = ((1 - pow( 1 - ($totalGRPs / $totalSpots / 100), $totalSpots)) * .85 * 100);

$totalFreq = $totalGRPs / $totalReach;

$totalFreqStr = number_format($totalFreq, 2);

	
$tbl .= <<<EOD
<td style="text-align: center;">$totalFreqStr</td>
   </tr>
EOD;

$tbl .= <<<EOD
</tbody>
</table>
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');

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



//============================================================+
// END OF FILE
//============================================================+