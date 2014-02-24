<?php 
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
?>

<?php echo $this->Html->script(array('student_picture.js')); ?>
<?php echo $this->Html->css(array('students_picture.css')); ?>
<h2>Student Picture</h2>
<h1>Take a picture for <?php echo $student['name']; ?></h1>
<div id="area">
	<div id="booth">
		<canvas id="canv" width="200" height="300"></canvas>
	</div>
	<div id="controll">
		<video id="live" autoplay style="display:none;"></video>
		<?php echo $this->Html->link('Take picture', '#', array('class'=>'livebtn', 'onClick'=>'snap()')); ?>
		<?php echo $this->Html->link('Try Again', '#', array('class'=>'stillbtn', 'onClick'=>'start(); snap(); start();')); ?>
		<?php echo $this->Form->create('picture'); ?>
		<?php echo $this->Form->input('picture_data', array('type'=>'hidden')); ?>
	</div>
	<input id="okbtn" class="stillbtn" type="submit" value="Ok">
</div>
