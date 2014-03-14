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
$pdf = new TCPDF('P', 'mm', array($settings['page_width']*25.4, $settings['page_height']*25.4));

$pdf->SetAuthor('Colby Brown');
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

$printableHeight = ($settings['page_height']-$settings['top_margin']-$settings['bottom_margin'])*25.4;
$stickerHeight = $printableHeight / $settings['rows'];

$printableWidth = ($settings['page_width']-$settings['left_margin']-$settings['right_margin'])*25.4;
$stickerWidth = $printableWidth / $settings['columns'];

$hShrink = $stickerWidth*.1;
$vShrink = $stickerHeight*.1;


$pdf->setLeftMargin($settings['left_margin']*25.4);
$pdf->setRightMargin($settings['right_margin']*25.4);
$pdf->setTopMargin($settings['top_margin']*25.4);
$pdf->setFooterMargin(0);
$pdf->SetAutoPageBreak(true, 0);

for ($page=0; $page<$settings['pages']; $page++) {
	$pdf->AddPage();
	for ($row=0; $row<$settings['rows']; $row++) {
		for ($col=0; $col<$settings['columns']; $col++) {
			$pdf->write1DBarcode(array_pop($barcodes), 
					'C128',
					($col*$stickerWidth+($settings['left_margin']*25.4))+$hShrink,
					($row*$stickerHeight+($settings['top_margin']*25.4))+$vShrink,
					($stickerWidth-2*$hShrink),
					($stickerHeight-2*$vShrink)
				);
		}
	}
}

echo $pdf->Output('kickbag_barcodes.pdf', 'D');
//We do not want to use inline saving because browsers may change the margin on us.
?>

