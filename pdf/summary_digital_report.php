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
$fontSize = 8;
$reportTitleFontSize=8;

// create new PDF document
$pdf = new TCPDF("L", PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('BluHorn');
$pdf->SetTitle('Print Summary');
$pdf->SetSubject('Print Summary Report');
$pdf->SetKeywords('');

// set default header data
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, "Print Insertion Order", PDF_HEADER_STRING);
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
$months = array();

$vendors = array();

$monthStr = "";

$clientStr = "";
$campaignStr = "";
$dateFromStr = "";
$dateToStr = "";
$marketStr = "";

foreach ($records as $record) {

//echo print_r($record);
		
$report->status($reportID, "Adding Record");

$borderTopStr="border-top: 0.5px solid #000;";
$borderBottomStr="border-bottom: none;";

$offset=0;

$weekNames = $record["weekNames"];

$totalSpotsPerWorksheetLine = array();
$totalSpendPerWorksheetLine = array();


	
$pdf->SetXY(4,3,true);
$pdf->SetFont('helvetica', 'B', $reportTitleFontSize);
$pdf->Write(0, 'Print Summary', '', 0, 'L', true, 0, false, false, 0);

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
$campaignStr .= $record["campaigns"]["name"] . ", ";
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

$pdf->SetXY(4,22,true);
$pdf->Line(5, 25 , 292, 25);
$pdf->Write(0, '', '', 0, 'L', true, 0, false, false, 0);

$pdf->SetFont('helvetica', '', $fontSize);



$tbl = <<<EOD
<table cellspacing="0" cellpadding="5" border="0" >
<thead>
<tr style="font-weight:bold; margin-bottom: 10px; height: 100px;">
<th style="width: 50px; $borderBottomStr">Item</th>
<th style="width: 150px; $borderBottomStr">Vendor</th>
<th style="width: 50px; $borderBottomStr white-space: nowrap;" nowrap>Day</th>
<th style="width: 90px; $borderBottomStr">Insertion Date</th>
<th style="width: 150px; $borderBottomStr">Ad Size & Type</th>
<th style="width: 150px; $borderBottomStr" nowrap>Caption</th>
<th style="width: 150px; $borderBottomStr">Position</th>
<th style="width: 150px; $borderBottomStr">Deadline</th>
<th style="width: 100px;$borderBottomStr">Gross Cost</th>
</tr></thead>
<tbody>
EOD;
		
	
	$lineCounter=0;

	$lines = $record["lines"];

	
	foreach ($lines as $line) {
		
	  $totalSpotsPerLine = 0;
	  $linetbl = "";
	  	
	
		if ($lineCounter % 2) {
			$colorStr = "background-color: #eee;";
		}
		else {
			$colorStr = "";
		}
		
//		$displayedLine = $lineCounter+1;
		$displayedLine = $line["worksheetLine"];
		
if ($line["isBold"]) {
	$fontWtStr="font-weight:bold;";
}
else {
	$fontWtStr="font-weight:normal;";	
}		

$lineCounterStr = $lineCounter + 1;

$dayStr = date("D",strtotime($line["insertionDate"]));
$monthStr = date("M",strtotime($line["insertionDate"]));

$vendors[$line["vendorID"]]["name"] = $line["vendorName"];
$vendors[$line["vendorID"]]["months"][$monthStr]["name"] = $monthStr;
$vendors[$line["vendorID"]]["months"][$monthStr]["totalSpots"]++;
$vendors[$line["vendorID"]]["months"][$monthStr]["totalSpend"] += $line["grossCost"];

$months[$monthStr]["name"] = $monthStr;
$months[$monthStr]["totalSpots"]++;
$months[$monthStr]["totalSpend"] += $line["grossCost"];

$sizeStr = "";
if (intval($line["numberOfColumns"]) > 0 and floatval($line["inches"]) > 0) {
	if (intval($line["numberOfColumns"])>1) {
		$colStr = "cols";
	}
	else {
		$colStr = "col";
	}
	if (floatval($line["inches"])>1) {
		$inchStr = "inches";
	}
	else {
		$inchStr = "inch";
	}	
	$sizeStr = intval($line["numberOfColumns"]) . " $colStr x " . $line["inches"] . " $inchStr";
	if ($line["color"] != "") {
		$sizeStr .= ", " . $line["color"];
	}
}
else {
	$sizeStr = $line["printSize"];
	if ($line["color"] != "") {
		$sizeStr .= ", " . $line["color"];
	}
}

if ($line["creativeDeadline"] == "0000-00-00 00:00:00") {
	$deadlineStr = "";
}
else {
	$deadlineStr = $line["creativeDeadline"];
}
$linetbl .= <<<EOD
<tr style="$colorStr $fontWtStr $borderTopStr">
<td style="width: 50px;">$lineCounterStr</td>
<td style="width: 150px; white-space: nowrap;" nowrap>{$line["vendorName"]}</td>
<td style="width: 50px; white-space: nowrap;" nowrap>$dayStr</td>
<td style="width: 90px; white-space: nowrap;" nowrap>{$line["insertionDate"]}</td>
<td style="width: 150px;">$sizeStr</td>
<td style="width: 150px; white-space: nowrap;" nowrap>{$line["caption"]}</td>
<td style="width: 150px;">{$line["positionRequest"]}</td>
<td style="width: 150px;">{$deadlineStr}</td>
<td style="width: 70px; text-align: right;">{$line["grossCost"]}</td></tr>
EOD;
		

if ($line["comments"]) {
$linetbl .= <<<EOD
<tr style="$colorStr $borderBottomStr" >
<td style="" colspan="2" style="text-align: right;"><strong>Comments:</strong></td>
<td style="" colspan="6"> <strong><i style="color: #f00;">{$line["comments"]}</i></strong></td>
<td></td>
</tr>
EOD;
}	
	
		//if ($totalSpotsPerLine > 0) {
			$lineCounter++;
			$tbl .= $linetbl;

		//}
	
	
}

$tbl .= <<<EOD
</tbody>
</table>
EOD;



	//$pdf->SetXY(1,30,true);
	$pdf->writeHTML($tbl, true, false, false, false, '');





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
$pdf->Write(0, 'Print Summary', '', 0, 'L', true, 0, false, false, 0);

$pdf->SetFont('helvetica', '', 8);

// -----------------------------------------------------------------------------
$pdf->SetXY(4.7,7.5,true);

//$dumpStr = print_r($record, true);
//$pdf->Write(0, $dumpStr, '', 0, 'L', true, 0, false, false, 0);

$marketTextStr = implode(",",$marketStr);
$clientTextStr = substr($clientStr,0,strlen($clientStr)-2);
$campaignTextStr = substr($campaignStr,0,strlen($campaignStr)-2);

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
$pdf->SetXY(4,24,true);
$pdf->Line(5, 25 , 292, 25);
$pdf->Write(0, '', '', 0, 'L', true, 0, false, false, 0);

$pdf->SetFont('helvetica', '', 9);

//$dumpStr = rPrint_r($data, true);
//$pdf->Write(0, $dumpStr, '', 0, 'L', true, 0, false, false, 0);

$tbl = <<<EOD
<table cellspacing="0" cellpadding="5" border="1">
<thead>
<tr style="font-weight:bold; margin-bottom: 10px; height: 100px;">
<th style="$borderBottomStr">Summary</th>
EOD;

	$monthCounter=0;


	foreach ($months as $month) {
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
	foreach ($months as $month) {
$totalSpots += $month["totalSpots"];	


$tbl .= <<<EOD
<td style="$borderBottomStr text-align: center;">{$month["totalSpots"]}</td>
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
	foreach ($months as $month) {
	
	$totalSpendPerMonth = $month["totalSpend"];
	
	$totalSpend += $totalSpendPerMonth;
	
	$totalSpendPerMonthStr = money_format("%n",$totalSpendPerMonth);
	
$tbl .= <<<EOD
<td style="$borderBottomStr text-align: center;">$totalSpendPerMonthStr</td>
EOD;

	}
	$totalSpendStr = money_format("%n",$totalSpend);
	
$tbl .= <<<EOD
<td style="text-align: center;">$totalSpendStr</td>
   </tr>
EOD;

$tbl .= <<<EOD
</tbody>
</table>
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');

foreach($vendors as $vendor) {

if ($vendor["name"] == "") {
//	continue;
}

$tbl = <<<EOD
<table cellspacing="0" cellpadding="5" border="1">
<thead>
<tr style="font-weight:bold; margin-bottom: 10px; height: 100px;">
<th style="$borderBottomStr">{$vendor["name"]}</th>
EOD;

	$monthCounter=0;


	foreach ($months as $month) {
$tbl .= <<<EOD
<th style="$borderBottomStr text-align: center;">{$month["name"]}</th>
EOD;

	}



$tbl .= <<<EOD
<th style="text-align: center; $borderBottomStr">Vendor Total</th>


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
$totalSpots = 0;
	foreach ($months as $month) {
$totalSpots += $vendor["months"][$month["name"]]["totalSpots"];	
$vendorSpotStr = 0;
$vendorSpotStr += $vendor["months"][$month["name"]]["totalSpots"];

$tbl .= <<<EOD
<td style="$borderBottomStr text-align: center;">{$vendorSpotStr}</td>
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
$totalSpend = 0;

	foreach ($months as $month) {
	
	$totalSpendPerMonth = $vendor["months"][$month["name"]]["totalSpend"];
	
	$totalSpend += $totalSpendPerMonth;
	
	$totalSpendPerMonthStr = money_format("%n",$totalSpendPerMonth);
	
$tbl .= <<<EOD
<td style="$borderBottomStr text-align: center;">$totalSpendPerMonthStr</td>
EOD;

	}
	$totalSpendStr = money_format("%n",$totalSpend);
	
$tbl .= <<<EOD
<td style="text-align: center;">$totalSpendStr</td>
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