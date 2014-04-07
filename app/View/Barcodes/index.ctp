<!--**********************************************************************
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
***********************************************************************-->
<?php echo $this->Html->script(array('barcodes/index.js', 'jquery/plugins/dataTables')); ?>
<?php echo $this->Html->css(array('dataTables')); ?>
<h2>Add Barcode</h2>
<?php echo $this->Html->link('Print more barcodes', array('controller'=>'barcodes', 'action'=>'create')); ?>
<input type="text" id="scan_space">
<div id="student_info" style="display:none;"></div>
<div id="student_select" style="display:none;">
	<?php echo $this->Form->create('Barcode'); ?>
		<?php echo $this->Form->input('code', array('type'=>'hidden')); ?>
		<table id="student_table">
		<thead>
			<th>Name</th>
			<th>Rank</th>
			<th>Ata Number</th>
			<th></th>
		</thead>
		<tbody>
		<?php foreach ($students as $student): ?>
			<tr>
				<td><?php echo $student['Student']['name']; ?></td>
				<td><?php echo $student['Student']['rank']; ?></td>
				<td><?php echo $student['Student']['ata_number']; ?></td>
				<td><input type="radio" name="data[Barcode][student_id]" value="<?php echo $student['Student']['id'] ?>" /></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
		</table>
	<?php echo $this->Form->end('Save'); ?>
</div>
