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
<?php echo $this->Html->css(array('jquery_ui/ui.css')); ?>
<?php echo $this->Html->script(array('jquery/plugins/ui.js', 'enrollment_renew.js')); ?>
<?php 
$date = date_create_from_format('Y-m-d', $enrollment['Enrollment']['expiration_date']);
$findate = date_add($date, new DateInterval('P' . $enrollment['Program']['duration'] . 'M'));
?>
<?php echo $this->Js->buffer('init("' . date_format($findate, 'Y-m-d') . '")'); ?>

<?php echo '<h2>Renew ' . $enrollment['Student']['name'] . '\'s ' . $enrollment['Program']['name'] . ' Program</h2>'; ?>
<?php echo $this->Form->create('renew'); ?>
<?php echo $this->Form->label('Program.expiration_date'); ?>
<div id="datepicker" name="datepicker"></div>
<?php echo $this->Form->input('expiration_date', array('type'=>'hidden')); ?>
<?php echo $this->Form->input('charge', array('type'=>'checkbox', 'label'=>'Apply charge to student account')); ?>
<div id="chargeDiv" style="display:none;">
	<?php echo $this->Form->input('price', array(
			'class'=>'currencyInput',
			'style'=>'text-align:left',
			'between' => '<span class="currency">$</span>',
			'value' => $enrollment['Program']['price']
	)); ?>
	<?php echo $this->Form->input('paid', array('type'=>'checkbox', 'label'=>'Mark charge as paid')); ?>
</div>
<?php echo $this->Form->end('Renew'); ?>