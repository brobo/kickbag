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
<?php echo $this->Html->css(array('transactions/add.css')); ?>
<?php echo $this->Html->script(array('jquery/jquery-ui', 'transactions/add.js')); ?>
<?php echo $this->Js->buffer("$('#student_search').autocomplete({
			source: '" . $this->Html->url(array('controller'=>'students', 'action'=>'search')) . "',
			position: {at:'left bottom+20'},
			autoFocus: true
		});"); ?>
<h2>New Transaction</h2>
<?php echo $this->Form->create('Transaction'); ?>
<table id="items">
<thead>
	<tr>
		<th>Description</th>
		<th>Unit price</th>
		<th>Quantitity</th>
		<th>Total</th>
	</tr>
</thead>
<tbody>
</tbody>
</table>
<table id="options">
	<tr><td><a onclick="addRow();">+</a></td></tr>
	<tr><td>Tax exempt</td><td><input type="checkbox" id="toggleTax" onChange="updateTotals();"></td></tr>
	<tr><td>Apply to</td><td><input id="student_search" name="data[Transaction][student_search]"></td></tr>
</table>
<table id="totalCalc">
	<tr>
		<th>Subtotal:</th>
		<td id="subtotal">$0.00</td>
	</tr>
	<tr>
		<th>Tax:</th>
		<td id="tax">$0.00</td>
	</tr>
	<tr>
		<th>Total:</th>
		<td id="total">$0.00</td>
	</tr>
</table>
<input type="hidden" id="total_hidden" name="data[Transaction][total]" value="0.0">
<?php echo $this->Form->submit('Continue'); ?>
<?php echo $this->Form->end(); ?>