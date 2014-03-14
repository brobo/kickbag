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
var dateMap = new Object();
var months = ["Smarch", "January", "Feburary", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

function loadMonthToMap(month) {
	if (!(month in dateMap)) {
		dateMap[month] = {};
		$.ajax({
			type:'POST',
			url:"../../hours/fetchRecords",
			data:{
				start_date: month + "-01",
				end_date: month + "-31",
				instructor_id: $('#instructor_id').val()
			},
			async: false,
			success: function(data) {
				var result = $.parseJSON(data);
				if (!result) return;
				for (var rowkey in result) {
					var row = result[rowkey];
					console.log(row);
					if (!dateMap[month][row.date]) dateMap[month][row.date] = 0;
					dateMap[month][row.date] += parseInt(row.total);
				}
			}
		});
	}
}

$(function() {
	$('#hours_calendar').datepicker({
		beforeShowDay: function(date) {
			var monthText = date.getFullYear() + "-" + twoDigit(date.getMonth()+1);
			var dayText = monthText + "-" + twoDigit(date.getDate());
			loadMonthToMap(monthText);
			if (dateMap[monthText][dayText]) {
				var quant = dateMap[monthText][dayText];
				return [true, 'highlight-date', 'Taught ' + quant + (quant > 1 ? ' hours' : ' hour')];
			} else {
				return [false,'','Did not teach'];
			}
			return [(dateMap[monthText][dayText]), 'highlight-date', dateMap[monthText][dayText] ? 'Taught ' + dateMap[monthText][dayText] + ' hours' : 'Did not teach'];
		},
		onChangeMonthYear: function(year, month, obj) {
			updateHoursCount(month, year);
		}
	});
	updateHoursCount($('#hours_calendar').datepicker('getDate').getMonth()+1, $('#hours_calendar').datepicker('getDate').getFullYear());
});

function updateHoursCount(month, year) {
	var monthText = year + "-" + twoDigit(month);
	var total = 0;
	for (var day in dateMap[monthText]) total += dateMap[monthText][day];
	var word = total == 1 ? ' hour' : ' hours';
	$('#hours_label').html('Taught ' + total + word + ' in ' + months[month] + ', ' + year + '.');
}

function twoDigit(date) {
	return ("0" + date).slice(-2);
}