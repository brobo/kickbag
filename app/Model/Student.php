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
class Student extends AppModel {
	public $name = 'Student';
	public $hasMany = array(
		'Transaction' => array(
			'conditions' => array('Transaction.paid'=> false),
			'dependent' => true,
			'order' => 'Transaction.created DESC'),
		'Enrollment' => array(
			'conditions' => array('Enrollment.active'=> true)
		),
		'Attendance',
		'Barcode'
	);
	public $belongsTo = array(
		'Rank'
	);
	public $virtualFields = array(
		'name' => 'CONCAT(Student.first_name, " ", Student.last_name)'
	);
	public $validate = array(
			'first_name' => array(
					'rule' => 'alphaNumeric',
					'required' => true
			), 'last_name' => array(
					'rule' => 'alphaNumeric',
					'required' => true
			), 'ata_number' => array(
					'numeric' => array(
						'rule' => 'numeric',
						'message' => 'Numeric characters only',
						'required' => false,
						'allowEmpty' => true
					),
					'maxLength' => array(
						'rule' => array('maxLength', 9),
						'message' => 'Not a valid ATA Number'
					)
			), 'dob' => array(
					'rule' => 'notEmpty'
			), 'uniform_size' => array(
					'rule' => array('maxLength', 8),
					'message' => 'Length must be less than 8',
					'allowEmpty' => true
			), 'belt_size' => array(
					'rule' => array('maxLength', 8),
					'message' => 'Length must be less than 8',
					'allowEmpty' => true
			)
	);
	public $hasAndBelongsToMany = array(
		'Contact' =>
			array(
				'className'				=> 'Contact',
				'joinTable'				=>	'contacts_students',
				'foreignKey'			=> 'student_id',
				'associationForeignKey'	=>	'contact_id',
				'unique'				=> false		
			)
	);
	
	public function beforeFind($query = array()) {
		if (!parent::beforeFind($query)) {
			return false;
		}
		
		$ranks = ClassRegistry::init('Rank');
		
		$this->virtualFields = array_merge($this->virtualFields, array(
				'rank' => sprintf('(SELECT value FROM %sranks WHERE id = Student.rank_id)', $ranks->tablePrefix)	
		));

		return true;
	}
}
?>