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
<?php echo $this->Html->css(array('dataTables')); ?>
<?php echo $this->Html->script(array('jquery/plugins/dataTables')); ?>
<?php echo $this->Js->buffer('$("#contacts_table").dataTable({
			"sPaginationType": "full_numbers"
		});'); ?>
<h1>All Contacts</h1>
<table id="contacts_table">
	<thead>
		<tr>
			<th>Contact</th>
			<th>Phone</th>
			<th>Email</th>
			<th>Address</th>
			<th>Edit</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($contact as $c): ?>
		<tr>
			<td><?php echo $c['Contact']['name']; ?></td>
			<td><?php echo $c['Contact']['phone']; ?></td>
			<td><?php echo $c['Contact']['email']; ?></td>
			<td><?php echo strlen($c['Contact']['address']) > 25 ? substr($c['Contact']['address'], 0, 25) . '...' : $c['Contact']['address']; ?></td>
			<td>
				<ul class="dropdown-menu"><li>&#x25BC;<ul>
					<li><?php echo $this->Html->link('Update', array('controller'=>'contacts', 'action'=>'update', $c['Contact']['id'])); ?></li>
					<li><?php echo $this->Form->PostLink(
							'Delete',
							array('action' => 'delete', $c['Contact']['id']),
							array('confirm' => 'This will delete ALL data associated with ' . $c['Contact']['name'] . '!!')); ?></li>
				</ul></li></ul>
			</td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>

<?php unset($c); ?>