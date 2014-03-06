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
<h1>Register Student</h1>
<?php
echo $this->Form->create('Student');
echo $this->Form->input('first_name', array('maxlength'=>32));
echo $this->Form->input('last_name', array('maxlength'=>32));
echo $this->Form->input('dob', array(
		'dateFormat' => 'MDY',
		'minYear' => date('Y') - 60,
		'maxYear' => date('Y') - 4		
));
echo $this->Form->input('rank_id', array('options' => $ranks, 'type' => 'select'));
echo $this->Form->input('ata_number', array('required' => false));
echo $this->Form->input('notes', array('type'=>'textarea'));
echo $this->Form->end('Register Student');
?>