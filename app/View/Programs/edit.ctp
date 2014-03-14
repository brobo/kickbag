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
<h2>Edit Program</h2>
<?php
$readonly = '';
if ($deprecated) {
	echo '<h3>This program is deprecated. You will not be able to update it.';
	$readonly = 'readonly';
}
if (!$deprecated) echo $this->Form->create('Program');
echo $this->Form->input('name', array($readonly));
echo $this->Form->input('duration', array('label'=>'Duration (months)', $readonly));
echo $this->Form->input('price', array(
		'class'=>'currencyInput',
		'style'=>'text-align:left',
		'between' => '<span class="currency">$</span>',
		$readonly
));
if (!$deprecated) echo $this->Form->end('Save Program');
?>