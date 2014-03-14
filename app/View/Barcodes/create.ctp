<!--*************************************************************************
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
 *************************************************************************/-->

<h2>Print Barcodes</h2>
<?php echo $this->Form->create('page'); ?>
<?php echo $this->Form->input('pages', array('type'=>'numeric', 'default'=>'1')); ?>
<?php echo $this->Form->input('rows', array('type'=>'numeric', 'default'=>'7')); ?>
<?php echo $this->Form->input('columns', array('type'=>'numeric', 'default'=>'2')); ?>
<?php echo $this->Form->input('page_width', array('type'=>'numeric', 'default'=>'8.5')); ?>
<?php echo $this->Form->input('page_height', array('type'=>'numeric', 'default'=>'11')); ?>
<?php echo $this->Form->input('left_margin', array('type'=>'numeric', 'default'=>'.1563')); ?>
<?php echo $this->Form->input('right_margin', array('type'=>'numeric', 'default'=>'.1563')); ?>
<?php echo $this->Form->input('top_margin', array('type'=>'numeric', 'default'=>'.833')); ?>
<?php echo $this->Form->input('bottom_margin', array('type'=>'numeric', 'default'=>'.833')); ?>
<?php echo $this->Form->end('Print'); ?>

