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
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, you can find a copy of it at
 * <http://www.gnu.org/licenses/gpl.html>
 *************************************************************************/
App::import('Vendor', 'tcpdf/tcpdf');
$pdf = new TCPDF('P', 'in', array($settings['page_width'], $settings['page_height']));

$pdf->SetAuthor('Colby Brown');
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

$printableHeight = $settings['page_height']-$settings['top_margin']-$settings['bottom_margin'];
$stickerHeight = $printableHeight / $settings['rows'];

$printableWidth = $settings['page_width']-$settings['left_margin']-$settings['right_margin'];
$stickerWidth = $printableWidth / $settings['columns'];
//debug(array($printableHeight, $settings['rows'], $stickerHeight, $printableWidth, $settings['columns'], $stickerWidth));

$hShrink = $stickerWidth*.05;
$vShrink = $stickerHeight*.05;


$pdf->setLeftMargin($settings['left_margin']);
$pdf->setRightMargin($settings['right_margin']);
$pdf->setTopMargin($settings['top_margin']);
$pdf->setFooterMargin(0);
$pdf->SetAutoPageBreak(true, 0);

for ($page=0; $page<$settings['pages']; $page++) {
	$pdf->AddPage();
	for ($row=0; $row<$settings['rows']; $row++) {
		for ($col=0; $col<$settings['columns']; $col++) {
			$pdf->write1DBarcode(array_pop($barcodes), 
					'C128',
					($col*$stickerWidth+$settings['left_margin'])+$hShrink,
					($row*$stickerHeight+$settings['top_margin'])+$vShrink,
					($stickerWidth-2*$hShrink),
					($stickerHeight-2*$vShrink)
				);
		}
	}
}

echo $pdf->Output('filename.pdf', 'I');
?>

