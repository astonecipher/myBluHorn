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
$fontSize = 7;

// create new PDF document
$pdf = new TCPDF("L", PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('BluHorn');
$pdf->SetTitle($reportTitle);
$pdf->SetSubject($reportSubject);
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
$pdf->SetFooterMargin(10);

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


// set font
$pdf->SetFont('helvetica', 'B', 10);

// add a page
$pdf->AddPage();

$pdf->SetXY(4,3,true);
$pdf->Write(0, $report->getTitle($reportID), '', 0, 'L', true, 0, false, false, 0);

$pdf->SetFont('helvetica', '', 8);

// -----------------------------------------------------------------------------
$pdf->SetXY(4.7,7.5,true);

$reportInfo = $report->getReport($reportID); 

$reportDates = $reportInfo["startDate"] . " to " . $reportInfo["endDate"];
$reportClients = $report->getClientNames($reportInfo["clients"]);
$reportTypes = $report->getVendorTypes($reportInfo["typeID"]);
$reportCampaigns = $report->getCampaignNames($reportInfo["campaigns"]);

if ($reportInfo["allCampaigns"]) {
	$reportCampaigns = "All";
}

if ($reportInfo["allClients"]) {
	$reportClients = "All";
}

if ($reportInfo["allCampaigns"]) {
	$reportTypes = "All";
}

$tbl = <<<EOD
<table cellspacing="0" cellpadding="1" border="$border" style="margin-right: 10px;">
    <tr>
        <td rowspan="4">Dates: $reportDates<br />
        				Clients: $reportClients<br />
						Types: $reportTypes<br />
						Campaigns: $reportCampaigns<br /></td>
    </tr>
</table>
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');

$pdf->SetXY(4,28,true);
$pdf->Line(5, 25 , 292, 25);
$pdf->Write(0, '', '', 0, 'L', true, 0, false, false, 0);

$pdf->SetFont('helvetica', '', $fontSize);

$borderTopStr="border-top: 0.5px solid #000;";
$borderBottomStr="border-bottom: none;";

$offset=0;

$tbl = <<<EOD
<table cellspacing="0" cellpadding="5" border="0" >
<thead>
<tr style="font-weight:bold; margin-bottom: 10px; height: 100px;">
<th style="$borderBottomStr">Client Name</th>
<th style="width: 150px; $borderBottomStr">Media Type</th>
<th style="width: 150px; $borderBottomStr" nowrap>Campaign Name</th>
<th style="$borderBottomStr">Contract #</th>
<th style="width: 150px; $borderBottomStr"><center>Flight Dates</center></th>
<th style="width: 100px; text-align: right; $borderBottomStr">Gross Cost</th>
EOD;

if ($reportInfo["isNetCost"]) {
$tbl .= <<<EOD
<th style="width: 100px; text-align: right; $borderBottomStr">Net Cost</th>
EOD;
}

$tbl .= <<<EOD
<th style="width: 100px; $borderBottomStr text-align: center;">Spots</th>
</tr>
</thead>
EOD;

$totalGrossCost = 0;	
$totalNetCost = 0;	
$totalSpots = 0;

foreach ($records as $record) {
	
$tbl .= <<<EOD
<tbody>
<tr style="$colorStr $fontWtStr $borderTopStr">
<td style="">{$record["clients"]["name"]}</td>
<td style="width: 150px; nowrap;" nowrap>{$record["campaigns"]["mediaDesc"]}</td>
<td style="width: 150px; white-space: nowrap;" nowrap>{$record["campaigns"]["name"]}</td>
<td style="white-space: nowrap;" nowrap>{$record["campaigns"]["contractNumber"]}</td>
<td style="width: 150px; white-space: nowrap;" nowrap><center>{$record["campaigns"]["flightStart"]} to {$record["campaigns"]["flightEnd"]}</center></td>
<td style="width: 100px; text-align: right;">{$record["grossCostStr"]}</td>
EOD;

if ($reportInfo["isNetCost"]) {
$tbl .= <<<EOD
<td style="width: 100px; text-align: right;">{$record["netCostStr"]}</td>
EOD;
}

$tbl .= <<<EOD
<td style="width: 100px; text-align: center;">{$record["totalSpots"]}</td>
</tr>
EOD;

$totalGrossCost += floatval($record["grossCost"]);	
$totalNetCost += floatval($record["netCost"]);	
$totalSpots += $record["totalSpots"];	
	
}

setlocale(LC_MONETARY, 'en_US');
$totalGrossCostStr = money_format("%i", $totalGrossCost);
$totalNetCostStr = money_format("%i", $totalNetCost);


$tbl .= <<<EOD
<tbody>
<tr style="$colorStr $fontWtStr $borderTopStr">
<td style=""></td>
<td style="width: 150px; nowrap;" nowrap></td>
<td style="width: 150px; white-space: nowrap;" nowrap></td>
<td style="white-space: nowrap;" nowrap></td>
<td style="width: 150px; white-space: nowrap;" nowrap><center></center></td>
<td style="font-weight:bold; width: 100px; text-align: right;">$totalGrossCostStr</td>
EOD;

if ($reportInfo["isNetCost"]) {
$tbl .= <<<EOD
<td style="font-weight:bold; width: 100px; text-align: right;">$totalNetCostStr</td>
EOD;
}

$tbl .= <<<EOD
<td style="font-weight:bold; width: 100px; text-align: center;">$totalSpots</td>
</tr>
EOD;

$tbl .= <<<EOD
</tbody>
</table>
EOD;
	
//$pdf->SetXY(1,30,true);
$pdf->writeHTML($tbl, true, false, false, false, '');
	

//$pdf->SetXY(4,3,true);

$pdf->SetFont('helvetica', '', 10);
$pdf->SetXY(4,$pdf->GetY()+5,true);

//$pdf->Line(5, $pdf->GetY(), 292, $pdf->GetY());

$pdf->SetFont('helvetica', '', 9);

/*
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
	
//Close and output PDF document
return $pdf->Output("/var/www/html/bluhorn/pdf/documents/" . $reportID . ".pdf", 'I');
	
//============================================================+
// END OF FILE
//============================================================+
}
