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
var info; //This is set by the JS buffer.

$(function() {
	$('#enrollProgramId').change(updateFields);
	$('#datepicker').datepicker({
		onSelect:updateDate,
		minDate:0,
		dateFormat:'yy-mm-dd'
	});
	$('#enrollCharge').click(function() {
		$('#chargeDiv').toggle(this.checked);
	});
});

function updateDate() {
	$('#enrollExpirationDate').val($('#datepicker').val());
}

function updateFields() {
	var program = $('#enrollProgramId').val();
	$('#enrollPrice').val(info[program]['price']*info[program]['duration']);
	$('#datepicker').datepicker('setDate', '+' + info[program]['duration'] + 'm');
	updateDate();
}