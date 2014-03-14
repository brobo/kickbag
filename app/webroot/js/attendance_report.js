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
var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'Decembe'];
$(function() {
	$(".calendar").datepicker({
		onSelect:updateList
	});
	updateList();
});

function updateList() {
	$("#startdate").datepicker("option", "maxDate", $("#enddate").datepicker("getDate"));
	$("#enddate").datepicker("option", "minDate", $("#startdate").datepicker("getDate"));
	$.post("../attendance/fetchRecords", {
			start_date: formatDate($("#startdate").datepicker("getDate")),
			end_date: formatDate($("#enddate").datepicker("getDate"))
		}, function(data) {
			var students = $.parseJSON(data);
			$("#students").find("tr:gt(0)").remove();
			for (var i=0; i<students.length; i++) {
				var row = '<tr><td>' + students[i]['name'] + '</td><td>' + students[i]['count'] + '</td></tr>';
				$('#students > tbody').append(row);
			}
			$('#daterange').html(readableDate($("#startdate").datepicker("getDate")) + " to " + readableDate($("#enddate").datepicker("getDate")));
		});
}

function readableDate(date) {
	return months[date.getMonth()] + " " + date.getDate() + ", " + date.getFullYear();
}

function formatDate(date) {
	return date.getFullYear() + "-" + twoDigit(date.getMonth()+1) + "-" + twoDigit(date.getDate());
}

function twoDigit(str) {
	return ("0" + str).slice(-2);
}