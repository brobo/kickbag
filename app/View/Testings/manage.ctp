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
<?php /*if (!$start) {
	echo 'Testing is currently running. ' . $this->Html->link('Log in as head judge.', array('action'=>'loginAsHead')) . ' ' . $this->Html->link('STOP', array('action'=>'stop'));
}*/?>
<?php echo $this->Html->link('Create Testing', array('action'=>'add')); ?>
<table>
<?php foreach ($testings as $t): ?>
	<tr>
		<td><?php echo $this->Html->link(date('j F g:i', strtotime($t['Testing']['time'])), array('action'=>'view', $t['Testing']['id'])); ?></td>
		<td><?php echo $t['Testing']['description']; ?></td>
		<td>
			<ul class="dropdown-menu"><li>&#x25BC;<ul>
				<?php /*if ($start) echo '<li>' . $this->Html->link('START', array('action'=>'start', $t['Testing']['id'])) . '</li>'; */?>
				<li><?php echo $this->Html->link('Edit', array('action'=>'edit', $t['Testing']['id'])); ?></li>
				<li><?php echo $this->Html->link('Students', array('controller' => 'TestingStudent', 'action'=>'register_students', $t['Testing']['id'])); ?>
				<li><?php echo $this->Html->link('Sheets', array('controller'=> 'Testings', 'action'=>'sheets', $t['Testing']['id'])); ?>
			</ul></li></ul>
		</td>
	</tr>
<?php endforeach; ?>
</table>
<?php echo $this->Html->link('Schedual testing', array('action'=>'add')); ?>
