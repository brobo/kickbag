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
<?php echo $this->Html->script(array('jquery/plugins/dataTables', 'instructors/index.js')); ?>
<?php echo $this->Html->css(array('dataTables')); ?>
<h2>Instructors</h2>
<?php echo $this->Html->link(
		'New Instructor',
		array('controller'=>'instructors', 'action'=>'add')); ?>
		
<table id="instructors_table">
	<thead>
		<tr>
			<th>Name</th>
			<th>Rank</th>
			<th>Collar</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($instructors as $i): ?>
		<tr>
			<td><?php echo $this->Html->link($i['Student']['last_name'] . ', ' . $i['Student']['first_name'], array('action'=>'view', $i['Instructor']['id'])); ?>
			<td>
				<div style="display:none;"><?php echo $rank_z[$i['Student']['rank_id']]['z']; ?></div>
				<?php echo $rank_z[$i['Student']['rank_id']]['value']; ?>
			</td>
			<td>
				<div style="display:none;"><?php echo $collar_z[$i['Instructor']['collar_id']];?></div>
				<?php echo $i['Instructor']['collar']; ?>
			</td>
			<td>
				<ul class="dropdown-menu"><li>&#x25BC;<ul>
					<li><?php echo $this->Html->link('Update', array('controller'=>'instructors', 'action'=>'update', $i['Instructor']['id'])); ?></li>		
					<li><?php echo $this->Form->PostLink(
							'Delete',
							array('action' => 'delete', $i['Instructor']['id']),
							array('confirm' => 'This will remove ALL instructor information associated with ' . $i['Student']['name'] . '!!')); ?></li>
				</ul></li></ul>
			</td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>

<?php unset($i); ?>