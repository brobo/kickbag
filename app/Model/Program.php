<?php

/*************************************************************************
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
*************************************************************************/

class Program extends AppModel {
	public $name = 'Program';
	public $hasMany = array(
		'Enrollment' => array(
			'condition' => array('Enrollment.active'=>true)
		)
	);
	public $validate = array(
			'name' => array(
					'rule' => 'notEmpty',
					'required' => true
			), 'duration' => array(
					'numeric' => array(
							'rule' => 'numeric',
							'message' => 'Must be a month'
					),
					'required' => array(
							'rule' =>	'notEmpty'
					)
			), 'price' => array(
					'numeric' => array(
						'rule' => 'numeric',
						'message' => 'Must be a dollar ammount'
					),
					'required' => array(
						'rule' => 'notEmpty'
					)
			)
			
	);
}