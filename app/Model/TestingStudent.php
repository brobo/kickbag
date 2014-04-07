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
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
* GNU General Public License for more details.
*
* You should have received a copy of the GNU General Public License
* along with this program; if not, you can find a copy of it at
* <http://www.gnu.org/licenses/gpl.html>
*************************************************************************/

App::uses('AppModel','Model');
class TestingStudent extends AppModel {
	public $name = 'TestingStudent';
	public $hasOne = array('Testing', 
			'Student' => array(
				'className' => 'Student',
				'foreignKey' => 'ata_number',
				'dependent' => false)	
	); 
	public $belongsTo = array('Rank');
	public $virtualFields = array(
			'name' => 'CONCAT(TestingStudent.first_name, " ", TestingStudent.last_name)',
			'age' => 'DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), TestingStudent.dob)), "%Y")+0'
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