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
<?php echo $this->Html->script(array('jquery/plugins/ui.js', 'attendance/report.js')); ?>
<?php echo $this->Html->css(array('jquery_ui/ui.css', 'attendance/report.css')); ?>
<h2>Attendance Report</h2>
<h3 id="daterange">Somewhen to nowhen</h3>
<div>
	<div id="maincontent">
		<table id="students">
		<thead>
			<tr><th>Name</th><th>Classes Attended</th></tr>
		</thead>
		<tbody>
		</tbody>
		</table>
	</div>
	<div id="sidebar">
		Start date:
		<div id="startdate" class="calendar"></div>
		End date:
		<div id="enddate" class="calendar"></div>
	</div>
</div>