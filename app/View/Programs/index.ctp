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
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOE. See the
* GNU General Public License for more details.
*
* You should have received a copy of the GNU General Public License
* along with this program; if not, you can find a copy of it at
* <http://www.gnu.org/licenses/gpl.html>
***********************************************************************-->
<h1>Programs</h1>
<?php echo $this->Html->link(
		'Add Program',
		array('controller'=>'programs', 'action'=>'add')); ?>

<table id="programs_table">
	<thead>
		<tr>
			<th>Name</th>
			<th>Duration</th>
			<th>Price</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($programs as $p): ?>
		<tr>
			<td><?php echo $p['Program']['name']; ?>
			<td><?php echo $p['Program']['duration']; ?></td>
			<td><?php echo sprintf("$%.2f", $p['Program']['price']); ?>
			<td>
				<ul class="dropdown-menu"><li>&#x25BC;<ul>
					<li><?php echo $this->Html->link('View', array('action'=>'view', $p['Program']['id'])); ?></li>
					<li><?php echo $this->Html->link('Edit', array('action'=>'edit', $p['Program']['id'])); ?></li>
					<li><?php echo $this->Form->PostLink(
							'Deprecate',
							array('action' => 'deprecate', $p['Program']['id']),
							array('confirm' => 'This will deprecate the ' . $p['Program']['name'] . ' program and unenroll all students!!')); ?></li>
				</ul></li></ul>
			</td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>

<?php unset($s); ?>