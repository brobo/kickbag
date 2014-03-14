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
<?php echo $this->Html->css(array('attendance_index.css', 'jquery_ui/ui.css')); ?>
<?php echo $this->Html->script(array('jquery/plugins/ui.js', 'attendance_index.js')); ?>
<h2>Attendance</h2>
<h1>Enter a student's ATA number to mark them as present.</h1>
<input type="text" id="search">
<?php echo $this->Form->create('students'); ?>
<div id="studentSelector">
	<div id="selected">
		<table id="students">
		<tr></tr>
		</table>
	</div>
	<div id="sidebar">
		<h1>Date:</h1>
		<div id="datepicker"></div>
		<input type="hidden" id="date" name="date" />
		<?php echo $this->Form->submit('Save'); ?>
	</div>
</div>
<?php echo $this->Form->end(); ?>