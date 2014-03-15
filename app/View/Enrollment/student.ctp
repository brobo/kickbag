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
<?php echo $this->Html->css(array('jquery_ui/ui.css')); ?>
<?php echo $this->Html->script(array('jquery/plugins/ui.js', 'enrollment/student.js')); ?>
<?php 
	$options=array();
	$info=array();
	foreach ($programs as $program) {
		$options[$program['Program']['id']] = $program['Program']['name'];
		$info[$program['Program']['id']]['price'] = $program['Program']['price'];
		$info[$program['Program']['id']]['duration'] = $program['Program']['duration'];
	}
	echo $this->Js->buffer('info=' . json_encode($info) . '; updateFields();');
?>
<?php echo '<h2>Enroll ' . $student['Student']['name'] . ' in a Program</h2>'; ?>
<?php echo $this->Form->create('enroll'); ?>
<?php echo $this->Form->input('student_id', array('type'=>'hidden', 'value'=>$student['Student']['id'])); ?>
<?php echo $this->Form->input('program_id', array('type'=>'select', 'options'=>$options))?>
<?php echo $this->Form->label('Program.expiration_date'); ?>
<div id="datepicker" name="datepicker"></div>
<?php echo $this->Form->input('expiration_date', array('type'=>'hidden')); ?>
<?php echo $this->Form->input('charge', array('type'=>'checkbox', 'label'=>'Apply charge to student account')); ?>
<div id="chargeDiv" style="display:none;">
	<?php echo $this->Form->input('price', array(
			'class'=>'currencyInput',
			'style'=>'text-align:left',
			'between' => '<span class="currency">$</span>'
	)); ?>
	<?php echo $this->Form->input('paid', array('type'=>'checkbox', 'label'=>'Mark charge as paid')); ?>
</div>
<?php echo $this->Form->end('Enroll'); ?>