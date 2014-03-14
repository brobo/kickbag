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
<?php echo $this->Html->script(array('jquery/plugins/dataTables', 'jquery/plugins/jExpand')); ?>
<?php echo $this->Html->css(array('dataTables')); ?>
<?php echo $this->Js->buffer("$('#transactions_table').jExpand();"); ?>
<h2>Open Transactions</h2>
<?php echo $this->Html->link('New Transaction', array('controller'=>'transactions', 'action'=>'add')); ?>

<table id="transactions_table">
	<thead>
		<th>Student</th>
		<th>Date</th>
		<th>Items</th>
		<th>Total</th>
		<th></th>
	</thead>
	<tbody>
	<?php foreach($transactions as $t): ?>
		<tr>
			<td><?php echo $t['Student']['name']; ?></td>
			<td><?php echo date('F jS Y g:i a', strtotime($t['Transaction']['created'])); ?></td>
			<td><?php echo count($t['TransactionItem']); ?></td>
			<td><?php printf('$%.2f', $t['Transaction']['total']); ?></td>
			<td><?php echo $this->Html->link('Mark paid', array('controller'=>'Transactions', 'action'=>'mark_paid', $t['Transaction']['id']))?></td>
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
			<?php foreach($t['TransactionItem'] as $ti): ?>
				<tr>
					<td><?php echo $ti['description']; ?></td>
					<td><?php echo '$' . $ti['unit_price'] ?></td>
					<td><?php echo $ti['quantity']; ?></td>
					<td><?php echo '$' . $ti['unit_price'] * $ti['quantity']; ?></td>
				</tr>
			<?php endforeach; ?>
			<?php if (count($t['TransactionItem'])%2 == 0) echo '<tr></tr>'; ?>
			</tbody>
			</table>
		</td></tr>
	<?php endforeach; ?>
	</tbody>
</table>
