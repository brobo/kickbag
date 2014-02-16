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

App::uses('AppModel', 'Model');
class Contact extends AppModel {
	public $name = "Contact";
	public $hasAndBelongsToMany = array(
		'Student' =>
			array(
				'className'				=> 'Student',
				'joinTable'				=> 'contacts_students',
				'foreignKey'			=> 'contact_id',
				'associationForeignKey' => 'student_id',
				'unique'				=> false		
			)	
	);
	
	public $validate = array(
		'name' => array('rule' => 'notEmpty', 'message' => 'Must provide a name'),
		'email' => array('rule' => array('email', true), 'message' => 'Must be a valid email address.'),
		'phone' => array('rule' => array('phone', null, 'us'), 'message' => 'Must be a valid phone number.')
	);
}
?>