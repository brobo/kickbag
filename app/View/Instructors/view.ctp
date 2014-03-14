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
<?php echo $this->Html->css(array('instructors/instructors_view', 'jquery_ui/ui.css')); ?>
<?php echo $this->Html->script(array('jquery/plugins/ui.js', 'instructors/view')); ?>
<h2><?php echo $i['Student']['name']; ?></h2>
<?php echo $this->Html->link('Back', array('controller'=>'instructors', 'action'=>'index')); ?> 
<?php echo $this->Html->link('Update', array('controller'=>'instructors', 'action'=>'update', $i['Instructor']['id']), array('id'=>'update')); ?> 
<?php echo $this->Html->link('Student Profile', array('controller'=>'students', 'action'=>'view', $i['Student']['id'])); ?>
<div id='profile'>
	<div id="picture">
		<?php
			$url = $i['Student']['picture'] ? 'students/' . $i['Student']['picture'] : 'students/nopicture.png';
			echo $this->Html->image($url);
		?>
	</div>
	<h3>Instructor Information</h3>
	<table id="instructor_info">
	<tr>
		<th>Name</th>
		<td><?php echo $i['Student']['name']; ?></td>
	</tr>
	<tr>
		<th>ATA Number</th>
		<td><?php echo $i['Student']['ata_number']; ?></td>
	</tr>
	<tr>
		<th>Rank</th>
		<td><?php echo $i['Student']['rank']; ?></td>
	</tr>
	<tr>
		<th>Collar</th>
		<td><?php echo $i['Instructor']['collar']; ?></td>
	</tr>
	</table>
</div>

<h3 class="blockhead">Hours</h3>
<div id="hours_calendar"></div>
<label id="hours_label"></label>
