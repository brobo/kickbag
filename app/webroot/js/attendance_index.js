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

function addRow(studentName, atan) {
	var row = '<tr onClick="remove()">\
		<td>' + studentName + '</td>\
		<td>' + atan + '<input name="data[Students][?][ata_number]" type="hidden" value="' + atan + '"></td>\
	</tr>';
	$('#students > tbody:last').after(row.replace(/\?/g, rowCount));
	rowCount++;
}

$(function() {
	$('#atanumber').on('input', function() {
		var self = $(this);
		if (self.val().match(/^[0-9]{9}$/)) {
			$.post("attendance/searchAtanumber", {atan: $(this).val()}, function(data) {
				result = $.parseJSON(data);
				if (!$.isEmptyObject(result)) {
					addRow(result.name, result.ata_number);
					self.val("");
				}
			});
		}
	}).focus();
	$('#datepicker').datepicker({
		altField:'#date',
		dateFormat:'yy-mm-dd'
	});
});