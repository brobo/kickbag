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

class Instructor extends AppModel {
	public $belongsTo = array(
		'Student',
		'Collar'
	);
	
	public $hasMany = array(
		'Hour'
	);
	
	public function beforeFind($query = array()) {
		if (!parent::beforeFind($query)) {
			return false;
		}
		$collars = ClassRegistry::init('Collar');
		$hours = ClassRegistry::init('Hour');
		
		$this->virtualFields = array_merge($this->virtualFields, array(
				'collar' => sprintf('(SELECT value FROM %s%s WHERE id = Instructor.collar_id)', $collars->tablePrefix, $collars->useTable),
				'totalHours' => sprintf('(SELECT sum(hours) FROM %s%s WHERE instructor_id = Instructor.id)', $hours->tablePrefix, $hours->useTable)
		));
	
		return true;
	}
}