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
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOE. See the
* GNU General Public License for more details.
*
* You should have received a copy of the GNU General Public License
* along with this program; if not, you can find a copy of it at
* <http://www.gnu.org/licenses/gpl.html>
*************************************************************************/
var rowCount = 0;
var KB_ENTER = 13;

function addRow(studentName, id, ataNumber) {
	var row = '<tr onClick="remove()">\
		<td>' + studentName + '</td>\
		<td><input name="data[Students][?][id]" type="hidden" value="' + id + '">' + ataNumber + '</td>\
	</tr>';
	$('#students > tbody:last').after(row.replace(/\?/g, rowCount));
	rowCount++;
}

function onFinishedTyping() {
	var input = $('#search');
	//alert('$' + input.val() + '^');
	//alert(input.val());
	$.post("attendance/search", {search: input.val()}, function(data) {
		result = $.parseJSON(data);
		if (!$.isEmptyObject(result)) {
			addRow(result.name, result.id, result.ata_number);
			input.val("");
		}
	});
}

$(function() {
	$('#search').on('paste', function() {setTimeout(onFinishedTyping, 1);});
	$('#search').on('keypress', function(e) {
		if (e.which == KB_ENTER) onFinishedTyping();
	});
	$('#search').focus();
	$('#datepicker').datepicker({
		altField:'#date',
		dateFormat:'yy-mm-dd'
	});
});