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
$maxWeeks = 4; 
$fontSize = 8;

// create new PDF document
$pdf = new TCPDF("L", PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('BluHorn');
$pdf->SetTitle('Outdoor Insertion Order');
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
$pdf->SetMargins(5, 5, 5);
$pdf->SetHeaderMargin(0);
$pdf->SetFooterMargin(5);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, 10);

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

// set font
$pdf->SetFont('helvetica', 'B', 12);

// add a page
$pdf->AddPage();

$pdf->SetXY(4,3,true);
$pdf->Write(0, 'Outdoor Order', '', 0, 'L', true, 0, false, false, 0);

$pdf->SetXY(4,3,true);
$pdf->Write(0, $worksheetName, '', 0, 'C', true, 0, false, false, 0);

$pdf->SetXY(4,3,true);
$pdf->Write(0, $clientName, '', 0, 'R', true, 0, false, false, 0);

$pdf->SetFont('helvetica', '', 8);

// -----------------------------------------------------------------------------
$pdf->SetXY(4.7,7.5,true);

if (strlen($jobNumber)>0) {
	$jobNumberStr = "Job No:";
}
else {
	$jobNumberStr = "";
}

$tbl = <<<EOD
<table cellspacing="0" cellpadding="1" border="$border" style="margin-right: 10px;">
    <tr>
        <td rowspan="6">Market: {$marketVendor["marketName"]} <br />
        				Vendor: {$marketVendor["name"]} <br />
						Station Rep: {$marketVendor["marketRep"]["contactName"]} <br />
						Phone: {$marketVendor["marketRep"]["phoneNumber"]} <br />
						Email: {$marketVendor["marketRep"]["emailAddress"]} <br />
						Campaign Remarks: $remarks<br /></td>
        <td rowspan="6" style="text-align: center;">Campaign: $campaignName<br />Flight Dates: $flightDateStr<br />Contract No: $contractNumber<br />Rev. No: $revisionNumber<br /></td>
        <td rowspan="6" style="text-align: right;">Buyer: $buyerName <br />$jobNumberStr $jobNumber<br /></td>
    </tr>
</table>
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');

$pdf->SetXY(4,28,true);
$pdf->Line(5, 32 , 292, 32);
$pdf->Write(0, '', '', 0, 'L', true, 0, false, false, 0);

$pdf->SetFont('helvetica', '', $fontSize);

$borderTopStr="border-top: 0.5px solid #000;";
$borderBottomStr="border-bottom: none;";

$offset=0;


$tbl = <<<EOD
<table cellspacing="0" cellpadding="5" border="0" >
<thead>
<th style="width: 50px; $borderBottomStr"><strong>Item</strong></th>
<th style="width: 100px; $borderBottomStr"><strong>Start Date</strong></th>
<th style="width: 50px; $borderBottomStr"><strong>Qty</strong></th>
<th style="width: 300px; $borderBottomStr" nowrap><strong>Name & Location</strong></th>
<th style="width: 150px; $borderBottomStr"><strong>Size & Type</strong></th>
<th style="width: 100px;$borderBottomStr"><strong>Board Cost</strong></th>
<th style="width: 100px;$borderBottomStr"><strong>Prod. Cost</strong></th>
<th style="width: 100px;$borderBottomStr"><strong>Total Cost</strong></th>
</tr></thead>
<tbody>
EOD;
	
	
	$lineCounter=0;
	


	foreach ($lines as $line) {
		
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

$linetbl .= <<<EOD
<tr style="$colorStr $fontWtStr $borderTopStr">
<td style="">$lineCounterStr</td>
<td style="width: 100px; white-space: nowrap;" nowrap>{$line["insertionDate"]}</td>
<td style="width: 50px; white-space: nowrap;" nowrap><center>{$line["numberOfBoards"]}</center></td>
<td style="width: 300px;">{$line["name"]}<br />{$line["location"]}</td>
<td style="width: 150px; white-space: nowrap;" nowrap>{$line["size"]}<br />{$line["type"]}</td>
<td style="">{$line["rate"]} {$line["boardCost"]}</td>
<td style="">{$line["productionCost"]}</td>
<td style="">{$line["totalCost"]}</td></tr>
EOD;
		

if ($line["comments"]) {
$linetbl .= <<<EOD
<tr style="$colorStr $borderBottomStr" >
<td style="" colspan="3" style="text-align: right;"><strong>Comments:</strong></td>
<td style="" colspan="4"> <strong><i style="color: #f00;">{$line["comments"]}</i></strong></td>
<td></td>
</tr>
</tbody>
EOD;
}		
		//if ($totalSpotsPerLine > 0) {
			$lineCounter++;
			$tbl .= $linetbl;
		//}
	}
}	

$tbl .= <<<EOD
</table>
EOD;

$pdf->SetFont('helvetica', '', 9);

	//$pdf->SetXY(1,30,true);
	$pdf->writeHTML($tbl, true, false, false, false, '');



if ($lineCounter < 1) {
	$pdf->deletePage($pdf->PageNo());
}


else {
	$infoTbl = <<<EOD
<table cellspacing="0" cellpadding="1" border="$border" style="margin-right: 10px;">
    <tr>
        <td rowspan="1"><strong>Comments:</strong><br />{$orderInfo["comments"]} {$agencyInfo["comments"]}</td>
        <td rowspan="1" style="text-align: left;"><strong>Traffic:</strong><br />{$orderInfo["traffic"]}</td>
    </tr>
</table>
EOD;


$pdf->SetFont('helvetica', '', 9);

$pdf->writeHTML($infotbl, true, false, false, false, '');


$pdf->SetFont('helvetica', '', 10);
$pdf->SetXY(4,$pdf->GetY()+1,true);

$pdf->Write(0, 'Signed:_________________________________________ Date:_____________________', '', 0, 'L', true, 0, false, false, 0);
$pdf->SetXY(4,$pdf->GetY()+5,true);

$pdf->Line(5, $pdf->GetY(), 292, $pdf->GetY());




$agencyAddressStr = str_replace("\n", "<br>", $agencyInfo["address"]);

$tbl = <<<EOD
<table cellspacing="0" cellpadding="1" border="$border" style="margin-right: 10px;">
    <tr>
        <td rowspan="1"><strong>{$agencyInfo["name"]}</strong>$agencyName<br />$agencyAddressStr<br />{$agencyInfo["phoneNumber"]}
		</td>
        <td rowspan="1" style="text-align: left;"><strong>Buyer</strong><br />$buyerName</td>
    </tr>
</table>
EOD;


$logoY = $pdf->GetY()+10;

$pdf->SetXY(4,$pdf->GetY()+5,true);

$pdf->writeHTML($tbl, true, false, false, false, '');

	if ($agencyInfo["logo"] != "") {
		$pdf->setJPEGQuality(75);

		$pdf->Image('/var/www/html/bluhorn/logos/'. $agencyInfo["id"] . "/" . $agencyInfo["logo"] , 270, $logoY-2, 20,20, 'JPG', $agencyInfo["website"], 'B', true, 150, '', false, false, 0, false, false, false);
		
	}


	$pdf->writeHTML($infoTbl, true, false, false, false, '');

	$pdf->SetFont('helvetica', '', 7);

//	$pdf->writeHTML(summaryTable($months), true, false, false, false, '');
	
}

}



// -----------------------------------------------------------------------------

//Close and output PDF document
$pdf->Output('example_048.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+


function summaryTable($months) {

$summary = <<<EOD
<table cellspacing="0" cellpadding="1" border="1" style="margin-right: 10px; width: 500px;">
	<thead>
    	<tr>
    	    <th rowspan="1" style="text-align: center;"><strong>Month</strong></th>
    	    <th rowspan="1" style="text-align: center;"><strong>Spots</strong></th>
    	    <th rowspan="1" style="text-align: center;"><strong>Net</strong></th>
    	    <th rowspan="1" style="text-align: center;"><strong>Gross</strong></th>
		</tr>
    </thead>
	<tbody>
EOD;

	$totalSpots = 0;
	$totalGross = 0;
	$totalNet = 0;
	
	foreach ($months as $month) {
		
		setlocale(LC_MONETARY, 'en_US');
	
		$monthSpots = $month["totalSpots"];
		$monthGrossStr = money_format("$%!i", $month["grossCost"]);
		$monthNetStr = money_format("$%!i", $month["netCost"]);
		
		$totalSpots += $month["totalSpots"];
		$totalGross += $month["grossCost"];
		$totalNet += $month["netCost"];
		
		$monthName = $month["name"];
		
		$summary .= "<tr><td style=\"text-align: center;\">$monthName</td>";
		$summary .= "<td style=\"text-align: center;\">$monthSpots</td>";
		$summary .= "<td style=\"text-align: center;\">$monthNetStr</td>";
		$summary .= "<td style=\"text-align: center;\">$monthGrossStr</td>";
		$summary .= "</tr>";
		
	}

	
	$totalGrossStr = money_format("$%!i", $totalGross);
	$totalNetStr = money_format("$%!i", $totalNet);

	$summary .= "<tr><td style=\"text-align: center;\"><strong>Totals</strong></td>";
	$summary .= "<td style=\"text-align: center;\"><strong>$totalSpots</strong></td>";
	$summary .= "<td style=\"text-align: center;\"><strong>$totalNetStr</strong></td>";
	$summary .= "<td style=\"text-align: center;\"><strong>$totalGrossStr</strong></td>";
	$summary .= "</tr>";
	
$summary .= <<<EOD
	</tbody>
</table>
EOD;
	
	return $summary;
}