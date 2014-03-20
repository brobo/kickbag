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
<h2>Add Testing</h2>
<?php echo $this->Form->create('Testing');
echo $this->Form->input('time', array(
		'minYear' => date('Y')
));
/*echo $this->Form->input('password');
echo $this->Form->input('re_password', array('type'=>'password', 'label'=>'Re enter password'));*/
echo $this->Form->input('description');
echo $this->Form->end('Schedual testing');
?>