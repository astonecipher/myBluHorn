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

$border = 0;
$maxWeeks = 9; 
$fontSize = 7;

// create new PDF document
$pdf = new TCPDF("L", PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('BluHorn');
$pdf->SetTitle('Radio TV Insertion Order');
$pdf->SetSubject('Insertion Order');
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
$pdf->SetMargins(3, 3, 3);
$pdf->SetHeaderMargin(0);
$pdf->SetFooterMargin(6);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, 6);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

$lineCounter = 0;

foreach ($marketVendors as $marketVendor) {

if (count($orderVendors)>0) {
	if (!in_array($marketVendor["id"], $orderVendors, true)) {
		$marketVendor["isSelected"] = false;
		continue;
	}
	else {
		$marketVendor["isSelected"] = true;
	}
}

$totalLinesOnPage = 0;

$totalSpots = 0;

$weekSummary = array();

// set font

// add a page
$pdf->AddPage();

$pdf->SetFont('helvetica', 'B', 11);

$pdf->SetXY(4,3,true);
$pdf->Write(0, 'Radio TV Station Order', '', 0, 'L', true, 0, false, false, 0);

$pdf->SetXY(4,3,true);
$pdf->Write(0, $clientName, '', 0, 'C', true, 0, false, false, 0);

$pdf->SetXY(4,3,true);
$pdf->Write(0, $agencyInfo["name"], '', 0, 'R', true, 0, false, false, 0);

$pdf->SetFont('helvetica', '', 8);

// -----------------------------------------------------------------------------
$pdf->SetXY(4.7,7.5,true);

if (strlen($jobNumber)>0) {
	$jobNumberStr = "Job No:";
}
else {
	$jobNumberStr = "";
}

$revisionNumber = $orderInfo["revision"];

$tbl = <<<EOD
<table cellspacing="0" cellpadding="1" border="$border" style="margin-right: 10px;">
    <tr>
        <td rowspan="6">Market: $marketName <br />
        				Vendor: {$marketVendor["name"]}<br />
						Station Rep: {$marketVendor["marketRep"]["contactName"]} <br />
						Phone: {$marketVendor["marketRep"]["phoneNumber"]} <br />
						Email: {$marketVendor["marketRep"]["emailAddress"]} <br />
						Campaign Remarks: $remarks<br /></td>
        <td rowspan="6" style="text-align: center;">Campaign: $campaignName<br />Flight Dates: $flightDateStrStd<br />Contract No: $contractNumber<br />Rev. No: $revisionNumber<br /></td>
        <td rowspan="6" style="text-align: right;">Buyer: $buyerName<br>jsakin@jsml.com <br />$jobNumberStr $jobNumber<br /></td>
    </tr>
</table>
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');

$pdf->SetXY(4,28,true);
$pdf->Line(3, 32 , 292, 32);
$pdf->Write(0, '', '', 0, 'L', true, 0, false, false, 0);

$pdf->SetFont('helvetica', '', $fontSize);

$borderTopStr="border-top: 0.5px solid #000;";
$borderBottomStr="border-bottom: none;";

$offset=0;

if (count($weekNames)>$maxWeeks) {
	$weekOffset = 0;
}

$headerLineCount = 0;
$printedLines = 0;

for ($offset=0; $offset<count($weekNames); $offset += $maxWeeks) {

	$weeksOnLine = 0;

	
	$headerLineCount += 2;

	
$tbl = <<<EOD
<table cellspacing="0" cellpadding="5" border="0" >
<thead>
<tr style="font-weight:bold; margin-bottom: 10px; height: 100px;">
<th style="width: 40px; $borderBottomStr">Item</th>
<th style="width: 80px; $borderBottomStr white-space: nowrap;" nowrap>Days</th>
<th style="width: 80px; $borderBottomStr white-space: nowrap;" nowrap>Times</th>
<th style="width: 60px; $borderBottomStr">DP/LEN</th>
<th style="width: 40px; $borderBottomStr">Call</th>
<th style="width: 100px; $borderBottomStr" nowrap>Program Title</th>
<th style="width: 70px; $borderBottomStr">Rate/Total</th>
<th style="$borderBottomStr">CPP</th>
<th style="$borderBottomStr">CPM</th>
<th style="$borderBottomStr">AQH</th>
EOD;
	
	$weekCounter=0;
	foreach ($weekNames as $week) {
		if ((++$weekCounter > $offset) && ($weekCounter <= $maxWeeks+$offset)) {

$tbl .= <<<EOD
<th style="width: 40px; text-align: center;">$week</th>
EOD;
$weeksOnLine++;


}





	}

//		if (((($weekCounter+$offset)%$maxWeeks)<$maxWeeks) and ((($weekCounter+$offset)%$maxWeeks)>0) ) {
		if ($weeksOnLine < $maxWeeks) {
			$cols = ($weekCounter+$offset) % $maxWeeks;
			for ($i=0; $i<=$cols+1; $i++) {

$tbl .= <<<EOD
<th style="width: 40px; text-align: center;"></th>
EOD;

			}
		}

	
$tbl .= <<<EOD
<th style="width: 50px; $borderBottomStr text-align: center;"> Spots</th>
</tr>
</thead>
EOD;
	
	$lineCounter=0;
	


	foreach ($lines as $line) {


	if ($totalLinesOnPage + $headerLineCount > 18){
		if ($printedLines > 0) {	
			//$pdf->writeHTML("--Page Break-- $totalLinesOnPage $headerLineCount $printedLines", true, false, false, false, '');

		$tbl .= '<tcpdf method="AddPage" />';

			//$pdf->AddPage();
		}

		$totalLinesOnPage = 0;
		$headerLineCount = 0;
		$printedLines = 0;
	}


		
	  $totalSpotsPerLine = 0;
	  $linetbl = "";
	  	
	  if ($line["vendorID"] == $marketVendor["id"]) {
	
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

$daysStr = "";

if ($line["isMonday"]) {
	$daysStr .= "M";
}
if ($line["isTuesday"]) {
	$daysStr .= "T";
}
if ($line["isWednesday"]) {
	$daysStr .= "W";
}
if ($line["isThursday"]) {
	$daysStr .= "R";
}
if ($line["isFriday"]) {
	$daysStr .= "F";
}
if ($line["isSaturday"]) {
	$daysStr .= "Sa";
}
if ($line["isSunday"]) {
	$daysStr .= "Su";
}

$linetbl .= <<<EOD
<tbody>
<tr style="$colorStr $fontWtStr $borderTopStr">
<td style="width: 40px;">$lineCounterStr</td>
<td style="width: 80px; white-space: nowrap;" nowrap>$daysStr</td>
<td style="width: 80px; white-space: nowrap;" nowrap>{$line["timePeriod"]}</td>
<td style="width: 60px; white-space: nowrap;" nowrap>{$line["daypart"]}/{$line["seconds"]}</td>
<td style="width: 40px;">{$line["station"]}</td>
<td style="width: 100px; white-space: nowrap;" nowrap>{$line["programName"]}</td>
<td style="width: 70px;">{$line["rate"]} <br /> {$line["totalSpend"]}</td>
<td style="">{$line["cpp"]}</td>
<td style="">{$line["cpm"]}</td>
<td style="">{$line["aqhRating"]}{$sheet["demo"][1]["description"]}</td>
EOD;
		
		$weekCounter=0;
		foreach ($weekNames as $week) {
		if ((++$weekCounter > $offset) && ($weekCounter <= $maxWeeks+$offset)) {
			$printedLines++;
			$totalSpotsPerLine += $wsWeeks[$displayedLine][$weekCounter];
$linetbl .= <<<EOD
<td style="width: 40px; text-align: center;">{$wsWeeks[$displayedLine][$weekCounter]}</td>
EOD;

			if(!isset($weekSummary[$week]["totalSpots"])) {
				$weekSummary[$week]["totalSpots"] = 0;
				$weekSummary[$week]["totalGRP"] = 0;
				$weekSummary[$week]["totalGross"] = 0;
				$weekSummary[$week]["totalNet"] = 0;
				$weekSummary[$week]["totalCPP"] = 0;
				$weekSummary[$week]["totalCPM"] = 0;
			}

			$weekSummary[$week]["totalSpots"] += $wsWeeks[$displayedLine][$weekCounter];
			$weekSummary[$week]["totalGRP"] += $wsWeeks[$displayedLine][$weekCounter] * $line["aqhRating"];
			$weekSummary[$week]["totalGross"] += $wsWeeks[$displayedLine][$weekCounter] * $line["rate"];
			$weekSummary[$week]["totalNet"] += $wsWeeks[$displayedLine][$weekCounter] * $line["rate"] * (100-$sheet["commission"])/100;
			$weekSummary[$week]["totalCPP"] += $wsWeeks[$displayedLine][$weekCounter] * $line["cpp"]; 
 			$weekSummary[$week]["totalCPM"] += $wsWeeks[$displayedLine][$weekCounter] * $line["cpm"];


		$weeksOnLastLine = ($weekCounter+$offset) % $maxWeeks;
//		if (((($weekCounter+$offset)%$maxWeeks)<$maxWeeks) and ((($weekCounter+$offset)%$maxWeeks)>0) ) {
			
}

		}

		if ($weeksOnLine < $maxWeeks) {
			$cols = ($weekCounter+$offset) % $maxWeeks;
			for ($i=0; $i<=$cols+1; $i++) {

$linetbl .= <<<EOD
<td style="width: 40px; text-align: center;"></td>
EOD;

			}
		}

		
$linetbl .= <<<EOD
<td style="width: 50px; text-align: center;">$totalSpotsPerLine</td>
</tr>
EOD;
if ($line["comments"]) {
$totalLinesOnPage++;
$linetbl .= <<<EOD
<tr style="$colorStr $borderBottomStr" >
<td style="" colspan="2" style="text-align: right;"><strong>Comments:</strong></td>
<td style="" colspan="19"> <strong><i style="color: #f00;">{$line["comments"]}</i></strong></td>
<td></td>
</tr>
</tbody>
EOD;
}		
		//if ($totalSpotsPerLine > 0) {
		if ($line["totalSpots"] > 0) {
			$lineCounter++;
			$totalLinesOnPage++;
			$totalSpots = $line["totalSpots"];
			$tbl .= $linetbl;
		}
	}
}	


$tbl .= <<<EOD
<tfoot>
<tr style="font-weight:bold; margin-bottom: 10px; height: 100px;">
<th style="width: 40px; $borderBottomStr"></th>
<th style="width: 80px; $borderBottomStr white-space: nowrap;" nowrap></th>
<th style="width: 80px; $borderBottomStr white-space: nowrap;" nowrap></th>
<th style="$borderBottomStr"></th>
<th style="width: 40px; $borderBottomStr"></th>
<th style="width: 100px; $borderBottomStr" nowrap></th>
<th style="width: 70px; $borderBottomStr"></th>
<th style="$borderBottomStr"></th>
<th style="$borderBottomStr"></th>
<th style="$borderBottomStr text-align: center;"><strong>Spots:</strong><br><strong>GRPs:</strong></th>
EOD;
	
	$totalSpotsPerTable = 0;
	$totalGRPsPerTable = 0;
	
	$weekCounter=0;
	foreach ($weekNames as $week) {
		if ((++$weekCounter > $offset) && ($weekCounter <= $maxWeeks+$offset)) {

			$weeklyAQHStr = $weekSummary[$week]["totalGRP"];

$tbl .= <<<EOD
<th style="width: 40px; text-align: center;">{$weekSummary[$week]["totalSpots"]}<br>$weeklyAQHStr</th>
EOD;
$totalSpotsPerTable += $weekSummary[$week]["totalSpots"];
$totalGRPsPerTable += $weekSummary[$week]["totalGRP"];
$weeksOnLine++;

	}

}



//		if (((($weekCounter+$offset)%$maxWeeks)<$maxWeeks) and ((($weekCounter+$offset)%$maxWeeks)>0) ) {
		if ($weeksOnLine < $maxWeeks) {
			$cols = ($weekCounter+$offset) % $maxWeeks;
			for ($i=0; $i<=$cols+1; $i++) {

$tbl .= <<<EOD
<th style="width: 40px; text-align: center;"></th>
EOD;

			}
		}

	
$tbl .= <<<EOD
<th style="$borderBottomStr text-align: center;"> $totalSpotsPerTable<br>$totalGRPsPerTable</th>
</tr>
</tfoot>
EOD;

$tbl .= <<<EOD
</table>
EOD;

	//$pdf->SetXY(1,30,true);
if ($totalSpots>0) {
	$pdf->writeHTML($tbl, true, false, false, false, '');
}

}
//$pdf->SetXY(4,3,true);




if ($lineCounter < 1) {
	$pdf->deletePage($pdf->PageNo());
}

else {
	
	if ($pdf->GetY() > 160) {
		$pdf->AddPage();
	}


	$pdf->SetFont('helvetica', '', 7);
	$pdf->SetXY(4,$pdf->GetY()-10,true);

	$pdf->writeHTML(summaryTable($lines, $weekSummary, $months, $orderDetails), true, false, false, false, '');

	$infoTbl = <<<EOD
<table cellspacing="0" cellpadding="1" border="$border" style="margin-right: 10px;">
    <tr>
        <td rowspan="1"><strong>Comments:</strong><br />{$orderInfo["comments"]}</td>
        <td rowspan="1" style="text-align: left;"><strong>Traffic:</strong><br />{$orderInfo["traffic"]}</td>
    </tr>
</table>
EOD;

if (($orderInfo["comments"] != "") and ($orderInfo["traffic"] != "")) {

	$pdf->writeHTML($infoTbl, true, false, false, false, '');

}	


$pdf->SetFont('helvetica', '', 10);
$pdf->SetXY(4,$pdf->GetY()+10,true);

$pdf->Write(0, 'Signed:_________________________________________ Date:_____________________', '', 0, 'L', true, 0, false, false, 0);
//$pdf->SetXY(4,$pdf->GetY()+5,true);

$pdf->Line(3, $pdf->GetY()+5, 292, $pdf->GetY()+5);

$pdf->SetFont('helvetica', '', 9);

$agencyAddressStr = str_replace("\n", "<br>", $agencyInfo["address"]);

$tbl = <<<EOD
<table cellspacing="0" cellpadding="1" border="$border" style="margin-right: 10px;">
    <tr>
        <td rowspan="1"><strong>{$agencyInfo["name"]}</strong>$agencyName<br />$agencyAddressStr<br />{$agencyInfo["phoneNumber"]}
		</td>
        <td rowspan="1" style="text-align: left;"><strong>Buyer</strong><br />$buyerName<br>jsakin@jsml.com</td>
    </tr>
</table>
EOD;

$logoY = $pdf->GetY()+10;

$pdf->SetXY(4,$pdf->GetY()+5,true);

$pdf->writeHTML($tbl, true, false, false, false, '');

	if ($agencyInfo["logo"] != "") {
		$pdf->setJPEGQuality(75);

		$pdf->Image('/var/www/html/bluhorn/logos/'. $agencyInfo["id"] . "/" . $agencyInfo["logo"] , 250, $logoY-2, 30,20, 'JPG', $agencyInfo["website"], 'B', true, 150, '', false, false, 0, false, false, false);
		
	}

}


}

//$pdf->writeHTML(print_r($weekSummary,true), true, false, false, false, '');
//$pdf->writeHTML(print_r($months,true), true, false, false, false, '');



// -----------------------------------------------------------------------------

//Close and output PDF document
$pdf->Output('example_048.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+

function summaryTable($lines, $weeks, $months, $orderDetails) {

$summary = <<<EOD
<table cellspacing="0" cellpadding="1" border="1" style="margin-right: 10px; width: 500px;">
	<thead>
    	<tr>
    	    <th rowspan="1" style="text-align: center;"><strong>Month</strong>$agencyName</th>
    	    <th rowspan="1" style="text-align: center;"><strong>Spots</strong></th>
    	    <th rowspan="1" style="text-align: center;"><strong>GRPs</strong></th>
EOD;

if ($orderDetails["printGrossDollars"]>0) {

$summary .= <<<EOD
    	    <th rowspan="1" style="text-align: center;"><strong>Gross</strong></th>
EOD;
}

$summary .= <<<EOD
    	    <th rowspan="1" style="text-align: center;"><strong>Net</strong></th>
    	    <th rowspan="1" style="text-align: center;"><strong>CPP</strong></th>
    	    <th rowspan="1" style="text-align: center;"><strong>CPM</strong></th>
		</tr>
    </thead>
	<tbody>
EOD;

	$totalSpots = 0;
	$totalGRP = 0;
	$totalGross = 0;
	$totalNet = 0;
	$totalCPP = 0;
	$totalCPM = 0;
	
	foreach ($months as $month) {
		// print month name
		// get weeks in the month
		// sum those weeks for the given month
		// print sum as totalSpots
		
		$monthName = $month["name"];
		$weekNames = "";
		$monthSpots = 0;
		$monthGRP = 0;
		$monthGross = 0;
		$monthNet = 0;
		$monthCPP = 0;
		$monthCPM = 0;
				
		foreach ($month["weeks"] as $weekNumber=>$weekName) {
			$monthSpots += $weeks[$weekName]["totalSpots"];
			$monthGRP += $weeks[$weekName]["totalGRP"];
			$monthGross += $weeks[$weekName]["totalGross"];
			$monthNet += $weeks[$weekName]["totalNet"];
			$monthCPP += $weeks[$weekName]["totalCPP"];
			$monthCPM += $weeks[$weekName]["totalCPM"];
		}

		$totalSpots += $monthSpots;

		$monthCPP = $monthCPP / $monthSpots;
		$monthCPM = $monthCPM / $monthSpots;
		
		$totalGRP += $monthGRP;
		$totalGross += $monthGross;
		$totalNet += $monthNet;
		$totalCPP += $monthCPP * $monthSpots;
		$totalCPM += $monthCPM * $monthSpots;
		
		setlocale(LC_MONETARY, 'en_US');
	
		$monthGrossStr = money_format("$%!i", $monthGross);
		$monthNetStr = money_format("$%!i", $monthNet);
		$monthCPPStr = money_format("$%!i", $monthCPP);
		$monthCPMStr = money_format("$%!i", $monthCPM);
		
		$summary .= "<tr><td style=\"text-align: center;\">$monthName</td>";
		$summary .= "<td style=\"text-align: center;\">$monthSpots</td>";
		$summary .= "<td style=\"text-align: center;\">$monthGRP</td>";
if ($orderDetails["printGrossDollars"]>0) {
		$summary .= "<td style=\"text-align: center;\">$monthGrossStr</td>";
}
		$summary .= "<td style=\"text-align: center;\">$monthNetStr</td>";
		$summary .= "<td style=\"text-align: center;\">$monthCPPStr</td>";
		$summary .= "<td style=\"text-align: center;\">$monthCPMStr</td>";
		$summary .= "</tr>";
		
	}

	$totalCPP = $totalCPP / $totalSpots;
	$totalCPM = $totalCPM / $totalSpots; 
	
	$totalGrossStr = money_format("$%!i", $totalGross);
	$totalNetStr = money_format("$%!i", $totalNet);
	$totalCPPStr = money_format("$%!i", $totalCPP);
	$totalCPMStr = money_format("$%!i", $totalCPM);

	$summary .= "<tr><td style=\"text-align: center;\"><strong>Totals</strong></td>";
	$summary .= "<td style=\"text-align: center;\"><strong>$totalSpots</strong></td>";
	$summary .= "<td style=\"text-align: center;\"><strong>$totalGRP</strong></td>";
if ($orderDetails["printGrossDollars"] > 0) {
	$summary .= "<td style=\"text-align: center;\"><strong>$totalGrossStr</strong></td>";
}
	$summary .= "<td style=\"text-align: center;\"><strong>$totalNetStr</strong></td>";
	$summary .= "<td style=\"text-align: center;\"><strong>$totalCPPStr</strong></td>";
	$summary .= "<td style=\"text-align: center;\"><strong>$totalCPMStr</strong></td>";
	$summary .= "</tr>";
	
$summary .= <<<EOD
	</tbody>
</table>
EOD;
	
	return $summary;
}



function reportHeader() {
	
}

function reportBody() {
	
}

function reportLines($from, $to) {
	
}

function reportSummary() {
	
}

function reportFooter() {
	
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