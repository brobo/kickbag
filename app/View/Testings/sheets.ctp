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
$pdf->setPrintFooter(true);

$pdf->AddPage();

$html = <<<EOD
<table style="border-top:solid;"><tr>
<td>Name (print)</td><td>Name (sign)</td><td>Rank</td>
</tr></table>
EOD;

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', 2, $html, 0, 1, 0, true, '', true);

echo $pdf->Output('testing_sheet.pdf');
?>

