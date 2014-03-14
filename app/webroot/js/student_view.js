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
			url:"../../attendance/fetchRecords",
			data:{
				start_date: month + "-01",
				end_date: month + "-31",
				student_id: $('#student_id').val()
			},
			async: false,
			success: function(data) {
				var result = $.parseJSON(data)[0];
				if (!result) return;
				var dates = result.date.split(",");
				for (var i=0; i<result.count; i++) {
					if (!dateMap[month][dates[i]]) dateMap[month][dates[i]] = 0;
					dateMap[month][dates[i]]++;
				}
			}
		});
	}
}

$(function() {
	$('#transaction_info').jExpand();
	$('#attendance_calendar').datepicker({
		beforeShowDay: function(date) {
			var monthText = date.getFullYear() + "-" + twoDigit(date.getMonth()+1);
			var dayText = monthText + "-" + twoDigit(date.getDate());
			loadMonthToMap(monthText);
			if (dateMap[monthText][dayText]) {
				var quant = dateMap[monthText][dayText];
				return [true, 'highlight-date', 'Attended ' + quant + (quant > 1 ? ' classes' : ' class')];
			} else {
				return [false,'','Absent'];
			}
			return [(dateMap[monthText][dayText]), 'highlight-date', dateMap[monthText][dayText] ? 'Attended ' + dateMap[monthText][dayText] + ' classes' : 'Absent'];
		},
		onChangeMonthYear: function(year, month, obj) {
			updateAttendanceCount(month, year);
		}
	});
	updateAttendanceCount($('#attendance_calendar').datepicker('getDate').getMonth()+1, $('#attendance_calendar').datepicker('getDate').getFullYear());
});

function updateAttendanceCount(month, year) {
	var monthText = year + "-" + twoDigit(month);
	var total = 0;
	for (var day in dateMap[monthText]) total += dateMap[monthText][day];
	$('#attendance_label').html('Attended ' + total + ' classes in ' + months[month] + ', ' + year + '.');
}

function twoDigit(date) {
	return ("0" + date).slice(-2);
}