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
<?php echo $this->Html->css(array('dropdown-menu')); ?>
<?php echo $this->Html->script(array('jquery/plugins/dropdown-menu')); ?>
<?php echo $this->Js->buffer('$(".dropdown-menu").dropdown_menu();')?>
<div id="navbar">
		<ul class="dropdown-menu">
			<li><span>Integrity Martial Arts</span></li>
			<li><?php echo $this->Html->link('Students ▾', array('controller'=>'Students', 'action'=>'index')); ?><ul>
				<li><?php echo $this->Html->link('Programs', array('controller'=>'Programs', 'action'=>'index')); ?></li>
				<li><?php echo $this->Html->link('Contacts', array('controller'=>'Contacts', 'action'=>'index')); ?></li>
				<li><?php echo $this->Html->link('Attendance ▸', array('controller'=>'attendance', 'action'=>'index'));?><ul>
					<li><?php echo $this->Html->link('Report', array('controller'=>'attendance', 'action'=>'report'));?></li>
					<li><?php echo $this->Html->link('Barcodes', array('controller'=>'barcodes', 'action'=>'index')); ?></li>
				</ul></li>
				<li><?php echo $this->Html->link('Transactions ▸', array('controller'=>'transactions', 'action'=>'index'));?><ul>
				<li><?php echo $this->Html->link('New', array('controller'=>'Transactions', 'action'=>'add')); ?></li>
			</ul></li>
			</ul></li>
			<li><?php echo $this->Html->link('Instructors ▾', array('controller'=>'Instructors', 'action'=>'index')); ?><ul>
				<li><?php echo $this->Html->link('Hours ▸', array('controller'=>'hours', 'action'=>'index'));?><ul>
					<li><?php echo $this->Html->link('Barcodes', array('controller'=>'barcodes', 'action'=>'index')); ?></li>
				</ul></li>
			</ul></li>
			<?php 
			if ($this->Session->read('Auth.User')) echo '<li>' . $this->Html->link('Logout', array('controller'=>'users', 'action'=>'logout')) . '</li>';
			?>
		</ul>
</div>
