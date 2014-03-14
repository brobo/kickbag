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
<h2>Welcome to Testing!</h2>
<p>It looks like this is your first testing as a judge. Please register with us as a guest judge:</p>
<?php echo $this->Form->create('Judge'); ?>
<?php echo $this->Form->input('ata_number', array('value'=>$atanum, 'readonly')); ?>
<?php echo $this->Form->input('name', array('value'=>(isset($name) ? $name : ''))); ?>
<?php echo $this->Form->input('rank', array('options'=>$ranks, 'type'=>'select', 'value'=>(isset($rank) ? $rank : ''))); ?>
<?php if (isset($sid)) echo $this->Form->input('student_id', array('type'=>'hidden', 'value'=>$sid)); ?>
<?php echo $this->Form->end('Register'); ?>