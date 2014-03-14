/*************************************************************************
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
*************************************************************************/
var rowCount = 0;

function addRow() {
	var row = '<tr>\
		<td><div class="input text"><input name="data[TransactionItem][?][description]" type="text" id="transactionItem?Description"/></div></td>\
		<td><span class="currency">$</span><input name="data[TransactionItem][?][unit_price]" type="text" id="transactionItem?UnitPrice" class="currencyInput changeListener"></td>\
		<td><div class="input text"><input name="data[TransactionItem][?][quantity]" type="text" id="transactionItem?Quantity" class="changeListener" value="1"/></div></td>\
		<td><div class="input text"><input type="text" id="transactionItem?Total" readonly/></div></td>\
	</tr>'
	$('#items tr:last').after(row.replace(/\?/g, rowCount));
	$('.changeListener').on('change', updateTotals);
	rowCount++;
}

/*NOTE
 * Floating points SUCK. Therefore, totals are calculated in units = hundredth of a cent.
 * Example: An object costing $5.01 costs 50,100 units.
 * This is to help avoid floating point errors and to more accurately round up in tax calculation.
 */
function updateTotals() {
	var total = 0;
	for (var i=0; i<rowCount; i++) {
		var pref = '#transactionItem' + i;
		var rowtot = Math.floor($(pref + 'UnitPrice').val() * $(pref + 'Quantity').val() * 10000);
		$(pref + 'Total').val('$' + parseFloat(rowtot/10000).toFixed(2));
		total += rowtot;
	}
	$('#subtotal').html('$' + parseFloat(total/10000).toFixed(2));
	var tax = 0;
	if (!$('#toggleTax').is(':checked')) {
		tax = total * 8.25;
		var rem = tax % 10000
		if (rem != 0) tax += 10000 - rem;
		tax /= 100;
	}
	$('#tax').html('$' + parseFloat(tax/10000).toFixed(2));
	total += tax;
	$('#total').html('$' + parseFloat(total/10000).toFixed(2));
	$('#total_hidden').val(parseFloat(total/10000).toFixed(2));
}

$(document).ready(function() {
	addRow();
});