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
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOE. See the
* GNU General Public License for more details.
*
* You should have received a copy of the GNU General Public License
* along with this program; if not, you can find a copy of it at
* <http://www.gnu.org/licenses/gpl.html>
***********************************************************************-->
<h2>Edit Testing</h2>
<?php echo $this->Form->create('Testing'); ?>
<?php echo $this->Form->input('time'); ?>
<?php echo $this->Form->input('description'); ?>
<?php echo $this->Form->input('password', array('label' => 'New Password <h6>leave blank to remain unchanged</h6>', 'required'=> false, 'value' => '')); ?>
<?php echo $this->Form->submit('Save'); ?>
<?php echo $this->Form->end(); ?>