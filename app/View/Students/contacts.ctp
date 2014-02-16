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
<?php echo $this->Html->script(array('jquery/plugins/dataTables')); ?>
<?php echo $this->Html->css(array('dataTables')); ?>
<?php echo $this->Js->buffer('$("#contacts_table").dataTable();'); ?>

<h2>Contacts for <?php echo $student['Student']['name'] ?></h2>
<table id="contacts_table">
	<thead>
		<tr>
			<th>Name</th>
			<th>Phone</th>
			<th>Email</th>
			<th>Edit</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($contacts as $c): ?>
		<tr>
			<td><?php echo $c['Contact']['name']; ?></td>
			<td><?php echo $c['Contact']['phone']; ?></td>
			<td><?php echo $c['Contact']['email']; ?></td>
			<td>
				<ul class="dropdown-menu"><li>&#x25BC;<ul>
					<li><?php echo $this->Html->link('Update', array('controller'=>'contacts', 'action'=>'update', $c['Contact']['id'])); ?></li>
					<li><?php echo $this->Form->PostLink(
							'Remove',
							array('action' => 'remove', $c['Contact']['id'], $student['Student']['id']),
							array('confirm' => 'This will remove this contact!!')); ?></li>
				</ul></li></ul>
			</td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
<br>
<?php echo $this->Html->link('Add new contact', array('controller'=>'Contacts', 'action'=>'add', $student['Student']['id'])); ?>

<?php echo $this->Html->link('Link existing contact', array('controller'=>'Contacts', 'action'=>'link', $student['Student']['id'])) ?>