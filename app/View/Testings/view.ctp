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
<?php echo $this->Html->script(array('jquery/plugins/dataTables', 'testings/view')); ?>
<?php echo $this->Html->css(array('dataTables')); ?>
<h2><?php echo $testing['Testing']['description']; ?></h2>
<h3><?php echo 'Testing scheduled for ' . date('l, F j, Y g:i a', strtotime($testing['Testing']['time'])); ?></h3>
<table id="students">
<thead>
	<th>Name</th>
	<th>Current Rank</th>
	<th>ATA Number</th>
	<th></th>
</thead>
<tbody>
	<?php foreach ($testing['TestingStudent'] as $s): ?>
		<tr>
			<td><?php echo $s['name']; ?></td>
			<td>
				<div style="display:none;"><?php echo sprintf("%03d", $ranks[$s['rank_id']]['zindex']);?></div>
				<?php echo $ranks[$s['rank_id']]['value']; ?>
			</td>
			<td><?php echo $s['ata_number']; ?></td>
			<td><?php echo $this->Html->link('Remove', array('controller'=>'TestingStudent', 'action'=>'unregister', $s['id'])); ?></td>
		</tr>
	<?php endforeach; ?>
</tbody>
</table>
<br>
<?php echo $this->Html->link('Register student', array('controller'=>'TestingStudent', 'action'=>'register_students', $testing['Testing']['id'])); ?>