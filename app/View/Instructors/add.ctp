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
<?php echo $this->Html->script(array('jquery/plugins/dataTables', 'instructors/add.js')); ?>
<?php echo $this->Html->css(array('dataTables')); ?>
<?php  echo "<h2>Promote Student to Instructor</h2>"; ?>
<table id="students_table">
	<thead>
		<tr>
			<th>Name</th>
			<th>Rank</th>
			<th>ATA Number</th>
			<th>Promote</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($students as $s): ?>
		<tr>
			<td><?php echo $s['Student']['last_name'] . ', ' . $s['Student']['first_name']; ?>
			<td><?php echo $s['Student']['rank']; ?></td>
			<td><?php echo $s['Student']['ata_number']; ?></td>
			<td><?php echo $s[0]['instructor'] ? "Instructor" : $this->Html->link('Promote', array('action'=>'add', $s['Student']['id'])); ?>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>