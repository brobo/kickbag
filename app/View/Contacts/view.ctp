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
<h2><?php echo 'Contact information for ' . $c['Contact']['name']; ?></h2>
<?php echo $this->Html->link('Back', array('controller'=>'contacts', 'action'=>'index')); ?> 
<?php echo $this->Html->link('Update', array('controller'=>'contacts', 'action'=>'update', $c['Contact']['id'])); ?>
<table>
<tr>
	<th>Name</th>
	<td><?php echo $c['Contact']['name']; ?></td>
</tr>
<tr>
	<th>Phone Number</th>
	<td><?php echo $c['Contact']['phone']; ?></td>
</tr>
<tr>
	<th>Email Address</th>
	<td><?php echo $c['Contact']['email']; ?></td>
</tr>
<tr>
	<th>Address</th>
	<td><?php echo $c['Contact']['address']; ?>
</tr>
</table>