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
<h2><?php echo 'Program ' . $p['Program']['name']; ?></h2>
<?php echo $this->Html->link('Back', array('controller'=>'programs', 'action'=>'index')); ?>
<?php echo ' '; ?>
<?php echo $this->Html->link('Edit', array('controller'=>'programs', 'action'=>'Edit', $p['Program']['id']), array('id'=>'edit')); ?>
<input type="hidden" id="program_id" value="<?php echo $p['Program']['id'];?>">
<h3>Program Information</h3>
<table id="program_info">
<tr>
	<th>Name</th>
	<td><?php echo $p['Program']['name']; ?></td>
</tr>
<tr>
	<th>Duration</th>
	<td><?php echo $p['Program']['duration'] . ' months'; ?></td>
</tr>
<tr>
	<th>Price per month</th>
	<td><?php echo sprintf("$%.2f", $p['Program']['price']); ?></td>
</tr>
</table>
<h3>Registration</h3>
<?php if ($p['Program']['deprecated']) {
	echo 'This program is deprecated. No new enrollment allowed.';
}
?>