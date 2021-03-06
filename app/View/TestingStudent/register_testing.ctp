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
<?php echo "<h2>Register $name for testing</h2>"; ?>
<table>
<?php foreach ($testings as $t): ?>
	<tr>
		<td><?php echo date('l, F j o g:i a', strtotime($t['Testing']['time'])); ?></td>
		<td><?php echo $t['Testing']['description']; ?></td>
		<td><?php echo $t[0]['registered'] ? __("Registered") : $this->Html->link('Register', array ('action' => 'register_testing', $atan, $t['Testing']['id'])); ?></td>
	</tr>
<?php endforeach; ?>
</table>