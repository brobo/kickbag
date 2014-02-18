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
		'Attendance'
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
					),
					'required' => false,
					'allowEmpty' => true
			), 'dob' => array(
					'rule' => 'notEmpty'
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
	
	public $ranks = array(
			'W' => 'White',
			'W+' => 'White +',
			'O' => 'Orange',
			'O+' => 'Orange +',
			'Y' => 'Yellow',
			'Y+' => 'Yellow +',
			'Ca' => 'Camo',
			'Ca+' => 'Camo +',
			'G' => 'Green',
			'G+' => 'Green +',
			'P' => 'Purple',
			'P+' => 'Purple +',
			'Bl' => 'Blue',
			'Bl+' => 'Blue +',
			'Br' => 'Brown',
			'Br+' => 'Brown +',
			'R' => 'Red',
			'R+' => 'Red +',
			'RB' => 'Red-Black',
			'B' => '1° Degree',
			'2B' => '2° Degree',
			'2B+' => '2° Degree +',
			'3B' => '3° Degree',
			'4B' => '4° Degree',
			'5B' => '5° Degree',
			'6B+' => '6° Degree (+)');
	


	public function sortableRank($rank) {
		$i = 0;
		foreach ($this->ranks as $key => $value) {
			if ($key==$rank || $value==$rank) return $i;
			$i++;
		}
		return $i;
	}
	
	public function buildRankPriority() {
		$res = array();
		$i = 0;
		foreach ($this->ranks as $key => $value) {
			$res[$key] = array('title'=>$value, 'priority'=>sprintf("%02d",$i++));
		}
		return $res;
	}
}
?>