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

class TestingStudentController extends AppController {
	public function register_students($testing_id = null, $sid = null) {
		if (!$testing_id) {
			$this->redirect(array('controller'=>'testings', 'action'=>'manage'));
		}
		if (!$sid) {
			$testing = $this->TestingStudent->Testing->findById($testing_id);
			if (!$testing) {
				$this->Session->setFlash("Error: Testing not found.");
				$this->redirect(array('action'=>'manage'));
			}
			$tbl = $this->TestingStudent->tablePrefix . $this->TestingStudent->useTable;
			$students = $this->TestingStudent->Student->find('all', array(
					'fields' => array ("*", "(Student.id in (select student_id from $tbl where testing_id = $testing_id)) as registered")));
			$this->set('students', $students);
			$this->set('tid', $testing_id);
			$this->set('description', $testing['Testing']['description']);
			$this->set('date', date('F j o', strtotime($testing['Testing']['time'])));
		} else {
			$student = $this->TestingStudent->Student->findById($sid);
			if (!$student) {
				$this->Session->setFlash("Error: Could not find that student!");
				$this->redirect(array('action'=>'register_students', $testing_id));
			} else {
				$entry = array('TestingStudent' => array(
					'student_id' => $student['Student']['id'],
					'first_name' => $student['Student']['first_name'],
					'last_name' => $student['Student']['last_name'],
					'rank_id' => $student['Student']['rank_id'],
					'dob' => $student['Student']['dob'],
					'ata_number' => $student['Student']['ata_number'],
					'testing_id' => $testing_id
				));
				if ($this->TestingStudent->save($entry)) {
					$this->Session->setFlash("Successfully registered student!", "flash_success");
				} else {
					$this->Session->setFlash("Error: Failed to register student.");
				}
				$this->redirect(array('action' => 'register_students', $testing_id));
			}
		}
	}
	
	public function unregister($tsid = null) {
		if (!$tsid) {
			$this->redirect(array('controller'=>'testing', 'action'=>'manage'));
		}
		if ($this->TestingStudent->delete($tsid)) {
			$this->Session->setFlash('Successfully unregistered student.', 'flash_success');
		} else {
			$this->Session->setFlash('An error occured while unregistering the student.');
		}
		$this->redirect($this->referer());
	}
}