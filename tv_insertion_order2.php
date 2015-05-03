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
$pdf->SetTitle('TV Insertion Order');
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
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

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

$pdf->SetXY(4,3,true);
$pdf->Write(0, 'Station Order', '', 0, 'L', true, 0, false, false, 0);

$pdf->SetXY(4,3,true);
$pdf->Write(0, 'Name', '', 0, 'C', true, 0, false, false, 0);

$pdf->SetXY(4,3,true);
$pdf->Write(0, 'Client', '', 0, 'R', true, 0, false, false, 0);

$pdf->SetFont('helvetica', '', 8);

// -----------------------------------------------------------------------------
$pdf->SetXY(4.7,7.5,true);

$tbl = <<<EOD
<table cellspacing="0" cellpadding="1" border="$border" style="margin-right: 10px;">
    <tr>
        <td rowspan="6">Market: $marketName {$sheet["market"]}<br />
        				Station: $station {$sheet["station"]}<br />
						Station Rep: $rep {$sheet["rep"]}<br />
						Phone: $rep  {$sheet["rep"]}<br />
						Email: $rep  {$sheet["rep"]}<br />
						Campaign Remarks: $rep {$sheet["rep"]}<br /></td>
        <td rowspan="6" style="text-align: center;">Campaign: $campaignName<br />Flight Date:<br />Contract No: $contractNumber<br />Rev. No:<br /></td>
        <td rowspan="6" style="text-align: right;">Buyer: <br />Job No: <br /></td>
    </tr>
</table>
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');

$pdf->SetXY(4,32,true);
$pdf->Line(4, 32 , 292, 32);
$pdf->Write(0, '', '', 0, 'L', true, 0, false, false, 0);

$pdf->SetFont('helvetica', '', $fontSize);

$borderTopStr="border-top: 0.5px solid #000;";
$borderBottomStr="border-bottom: none;";




	

	
	$lineCounter=0;
	
	foreach ($lines as $line) {
	
		if ($lineCounter % 2) {
			$colorStr = "background-color: #eee;";
		}
		else {
			$colorStr = "";
		}
		
		$displayedLine = $lineCounter+1;
		

		
		$weekCounter=0;
		foreach ($weekNames as $week) {

			$tbl = <<<EOD
</td>
EOD;

		}
		

		
		$lineCounter++;
	
	}
	

	


// -----------------------------------------------------------------------------

//Close and output PDF document
$pdf->Output('example_048.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+