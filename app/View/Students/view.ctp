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
<?php echo $this->Html->css(array('students_view', 'jquery_ui/ui.css', 'dropdown-menu')); ?>
<?php echo $this->Html->script(array('jquery/plugins/jExpand', 'jquery/plugins/ui.js', 'student_view.js', 'jquery/plugins/dropdown-menu')); ?>
<h2><?php echo $s['Student']['name']; ?></h2>
<?php echo $this->Html->link('Back', array('controller'=>'students', 'action'=>'index')); ?> 
<?php echo $this->Html->link('Update', array('controller'=>'students', 'action'=>'update', $s['Student']['id']), array('id'=>'update')); ?>
<input type="hidden" id="student_id" value="<?php echo $s['Student']['id'];?>">
<div id='profile'>
	<div id="picture">
		<?php
			$url = $s['Student']['picture'] ? 'students/' . $s['Student']['picture'] : 'students/nopicture.png';
			echo $this->Html->image($url);
			echo $this->Html->link('Update', array('controller'=>'students', 'action'=>'picture', $s['Student']['id'])) . "\t";
			echo $this->Html->link('Remove', array('controller'=>'students', 'action'=>'picture', $s['Student']['id'], true));
		?>
	</div>
	<h3>Student Information</h3>
	<table id="student_info">
	<tr>
		<th>Name</th>
		<td><?php echo $s['Student']['name']; ?></td>
	</tr>
	<tr>
		<th>ATA Number</th>
		<td><?php echo $s['Student']['ata_number']; ?></td>
	</tr>
	<tr>
		<th>Rank</th>
		<td><?php echo $s['Student']['rank']; ?></td>
	</tr>
	<tr>
		<th>DOB</th>
		<td><?php echo date('F jS Y', strtotime($s['Student']['dob'])); ?>
	</tr>
	<tr>
		<th>Notes</th>
		<td><?php echo $s['Student']['notes']; ?></td>
	</tr>
	</table>
</div>
<br>
<h3 class="blockhead">Contact Information</h3>
<h1>(<?php echo $this->Html->link('Add', array('controller'=>'contacts', 'action'=>'add', $s['Student']['id'])); ?>
 | <?php echo $this->Html->link('Link', array('controller'=>'contacts', 'action'=>'link', $s['Student']['id'])); ?>)</h1>
<table id="contact_info">
<thead>
	<tr>
		<th>Name</th>
		<th>Phone number</th>
		<th>Email</th>
		<th>Address</th>
		<th>Edit</th>
	</tr>
</thead>
<tbody>
<?php foreach($s['Contact'] as $c): ?>
	<tr>
		<td><?php echo $this->Html->link($c['name'], array('controller'=>'contacts', 'action'=>'view', $c['id'])); ?></td>
		<td><?php echo $c['phone']; ?></td>
		<td><?php echo $c['email']; ?></td>
		<td><?php echo strlen($c['address']) > 25 ? substr($c['address'], 0, 25) . '...' : $c['address']; ?></td>
		<td>
			<ul class="dropdown-menu"><li>&#x25BC;<ul>
			<li><?php echo $this->Html->link('Update', array('controller'=>'contacts', 'action'=>'update', $c['id'])); ?></li>
			<li><?php echo $this->Html->link('Unlink', array('controller'=>'contacts', 'action'=>'renew', $c['id'])); ?>
			</ul></li></ul>
		</td>
	</tr>
<?php endforeach;?>
</tbody>
</table>
<h3 class="blockhead">Open Transactions</h3>
<table id="transaction_info">
<thead>
	<tr>
		<th>Date</th>
		<th># Items</th>
		<th>Total</th>
		<th>Paid?</th>
	</tr>
</thead>
<tbody>
<?php foreach($s['Transaction'] as $t): ?>
	<tr>
		<td><?php echo date('F jS Y g:i a', strtotime($t['created'])); ?></td>
		<td><?php echo count($s['TransactionItem'][$t['id']]); ?></td>
		<td><?php printf('$%.2f', $t['total']); ?></td>
		<td><?php echo $this->Html->link('Mark paid', array('controller'=>'Transactions', 'action'=>'mark_paid', $t['id']))?></td>
	</tr>
	<tr><td colspan="4">
		<table>
		<thead>
			<th>Item</th>
			<th>Price</th>
			<th>Quantitiy</th>
			<th>Total</th>
		</thead>
		<tbody>
		<?php foreach($s['TransactionItem'][$t['id']] as $ti): ?>
			<tr>
				<td><?php echo $ti['TransactionItem']['description']; ?></td>
				<td><?php echo '$' . $ti['TransactionItem']['unit_price'] ?></td>
				<td><?php echo $ti['TransactionItem']['quantity']; ?></td>
				<td><?php echo '$' . $ti['TransactionItem']['unit_price'] * $ti['TransactionItem']['quantity']; ?></td>
			</tr>
		<?php endforeach; ?>
		<?php if (count($s['TransactionItem'][$t['id']])%2 == 0) echo '<tr></tr>'; ?>
		</tbody>
		</table>
	</td></tr>
<?php endforeach; ?>
</tbody>
</table>
<br>

<h3 class="blockhead">Attendance</h3>
<div id="attendance_calendar"></div>
<label id="attendance_label"></label>

<h3 class="blockhead">Enrollment</h2>
<table>
<thead>
	<th>Program</th>
	<th>Expiration date</th>
	<th></th>
</thead>
<tbody>
<?php foreach($s['Enrollment'] as $en): ?>
	<tr>
		<td><?php echo $en['Program']['name']; ?></td>
		<td><?php echo date('F jS Y', strtotime($en['expiration_date'])); ?></td>
		<td>
			<ul class="dropdown-menu"><li>&#x25BC;<ul>
			<li><?php echo $this->Html->link('Unenroll', array('controller'=>'enrollment', 'action'=>'unenroll', $en['id'])); ?></li>
			<li><?php echo $this->Html->link('Renew', array('controller'=>'enrollment', 'action'=>'renew', $en['id'])); ?>
			</ul></li></ul>
		</td>
	</tr>
<?php endforeach; ?>
</tbody>
</table>
<?php echo $this->Html->link('Enroll', array('controller'=>'enrollment', 'action'=>'student', $s['Student']['id'])); ?>