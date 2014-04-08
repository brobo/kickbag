<?php
/*************************************************************************
 * This file is a part of the Kickbag martial arts manager.
 * Copyright © 2014 Colby Brown
 *
 * This program is free software; you can redistribute it and/or modify it
 * under the terms of the GNU General Public License as published by the
 * Free Software Foundation; either version 3 of the License,
 * or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, you can find a copy of it at
 * <http://www.gnu.org/licenses/gpl.html>
 *************************************************************************/
App::import('Vendor', 'tcpdf/tcpdf');

class SheetPdf extends TCPDF {
	public function Header() {
		$ata_image = path_to_webroot . 'app/webroot/img/ata_logo.jpg';
		$integrity_image = path_to_webroot . 'app/webroot/img/integrity_logo.jpg';
		
		$this->Image($ata_image, .5, .5, .6, .75);
		$this->Image($integrity_image, 7.1, .6, .75, .75);
		
		$this->SetFont('helvetica', 'B', 20);
		$this->Text(2.5, .75, "Integrity ATA Martial Arts");
		
	}
}

$pdf = new SheetPdf('P', 'in', array(8.5, 11));

$pdf->SetAuthor('Colby Brown');
$pdf->setPrintHeader(true);
$pdf->SetMargins(.5,2);
$pdf->setPrintFooter(true);

$integrity_image = '../../webroot/img/integrity_logo.jpg';
// $pdf->SetHeaderData($integrity_image, 1, 'Integrity ATA Martial Arts', 'Testing');

//$pdf->SetHeaderMargin(10);

$pdf->AddPage();

$html = <<<EOD
<table style="border-top:solid;width:88%"><tr>
<td style="width:40%">Name (print)</td><td style="width:40%">Name (sign)</td><td>Rank</td>
</tr></table>
EOD;

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', 2, $html, 0, 1, 0, true, '', true);

$html = <<<EOD
<style> td{height: 25px; line-height:25px;}</style>
<table border="1">
<thead>
	<tr style="text-align:center;">
		<th colspan="3">Name</th>
		<th>Rank</th>
		<th>Age</th>
		<th colspan="2">Form<br>(0-5)</th>
		<th colspan="2">Sparring<br>(0-3)</th>
		<th>Boards<br>(0-2)</th>
		<th>Total</th>
		<th>New Rank</th>
	</tr>
</thead>
<tbody>
EOD;

foreach ($students as $s_) {
	$s = $s_['TestingStudent'];
	$s['abbr'] = $s_['Rank']['abbr'];
	$html .=
	'<tr nobr="true">
		<td colspan="3"> ' . $s['last_name'] . ', ' . $s['first_name'] . '</td>
		<td> ' . $s['abbr'] . '</td>
		<td> ' . $s['age'] . '</td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>';
}

$html .= <<<EOD
</tbody>
</table>
EOD;

$pdf->writeHTMLCell(0, 0, '', 2.5, $html, 0, 1, 0, true, '', true);

echo $pdf->Output('testing_sheet.pdf');
?>

