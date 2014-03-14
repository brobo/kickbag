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
<?php echo $this->Html->script('jquery/plugins/dataTables'); ?>
<?php echo $this->Html->css('dataTables'); ?>
<?php echo $this->Js->buffer('$("#contacts_table").dataTable({
			"sPaginationType": "full_numbers"
		});'); ?>
<h1>Select contact to link:</h1>
<table id="contacts_table">
	<thead>
		<tr>
			<th>Contact</th>
			<th>Phone</th>
			<th>Email</th>
			<th>Link</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($contact as $c): ?>
		<tr>
			<td><?php echo $c['Contact']['name']; ?></td>
			<td><?php echo $c['Contact']['phone']; ?></td>
			<td><?php echo $c['Contact']['email']; ?></td>
			<td><?php echo strlen($c['Contact']['address']) > 50 ? substr($c['Contact']['address'], 0, 50) . '...' : $c['Contact']['address']; ?></td>
			<td><?php echo $this->Html->Link('Link', array('controller'=>'contacts', 'action'=>'link', $sid, $c['Contact']['id'])); ?></td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>

<?php unset($c); ?>