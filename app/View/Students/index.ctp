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
<?php echo $this->Html->script(array('jquery/plugins/dataTables', 'students/index.js')); ?>
<?php echo $this->Html->css(array('dataTables')); ?>
<h1>Students</h1>
<?php echo $this->Html->link(
		'New Student',
		array('controller'=>'students', 'action'=>'add')); ?>

<table id="students_table">
	<thead>
		<tr>
			<th>Name</th>
			<th>Rank</th>
			<th>ATA Number</th>
			<th>Open Transactions</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($students as $s): ?>
		<tr>
			<td><?php echo $this->Html->link($s['Student']['last_name'] . ', ' . $s['Student']['first_name'], array('action'=>'view', $s['Student']['id'])); ?>
			<td>
				<div style="display:none;"><?php echo sprintf("%03d", $rank_z[$s['Student']['rank_id']]);?></div>
				<?php echo $s['Student']['rank']; ?>
			</td>
			<td><?php echo $s['Student']['ata_number']; ?></td>
			<td><?php if ($s['Transaction']['total'] > 0) echo sprintf("%d open, total $%.2f", count($s['Transaction'])-1, $s['Transaction']['total']); ?></td>
			<td>
				<ul class="dropdown-menu"><li>&#x25BC;<ul>
					<li><?php echo $this->Html->link('Update', array('controller'=>'students', 'action'=>'update', $s['Student']['id'])); ?></li>
					<li><?php echo $this->Html->link('Contacts', array('controller'=>'students', 'action'=>'contacts', $s['Student']['id'])); ?></li>		
					<li><?php echo $this->Form->PostLink(
							'Delete',
							array('action' => 'delete', $s['Student']['id']),
							array('confirm' => 'This will delete ALL data associated with ' . $s['Student']['name'] . '!!')); ?></li>
				</ul></li></ul>
			</td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>

<?php unset($s); ?>
