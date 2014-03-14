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

class InstructorsController extends AppController {
	
	function add($sid = null) {
		if ($sid !== null) {
			$instructor = $this->Instructor->findByStudentId($sid);
			if ($instructor) {
				$this->Session->setFlash(__('That student is already an instructor.'));
				$this->redirect($this->request->referer());
			}
			
			$this->Instructor->create(array(
				'student_id' => $sid
			));
			if ($this->Instructor->save()) {
				$this->Session->setFlash(__('Successfully created instructor.'), 'flash_success');
				$this->redirect(array('controller'=> 'instructors', 'action'=>'view', $this->Instructor->id));
			} else {
				$this->Session->setFlash(__('Unable to create instructor.'));
			}
		}
		$tbl = $this->Instructor->tablePrefix . $this->Instructor->table;
		$students = $this->Instructor->Student->find('all', array(
				'fields' => array ("*", "(Student.id in (select student_id from $tbl)) as instructor")));
		$this->set('students', $students);
	}
	
	public function update($iid = null) {
		if (!$iid) {
			$this->Session->setFlash(__('Illegal instructor id.'));
			$this->redirect($this->request->referer());
		}
	
		$instructor = $this->Instructor->findById($iid);
		if (!$instructor) {
			$this->Session->setFlash(__('Instructor not found.'), 'flash_success');
		}
	
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->Instructor->id = $instructor['Instructor']['id'];
			if ($this->Instructor->save($this->request->data)) {
				$this->Session->setFlash('Instructor updated.', 'flash_success');
				$this->redirect(array('action' => 'view', $instructor['Instructor']['id']));
			} else {
				$this->Session->setFlash('Failed to update instructor.');
			}
		}
	
		if (!$this->data) {
			$this->set('s', $instructor['Student']);
			$collars_raw = $this->Instructor->Collar->find('all');
			$collars = array();
			foreach ($collars_raw as $collar) {
				$collars[$collar['Collar']['id']] = $collar['Collar']['value'];
			}
			$this->set('collars', $collars);
			$this->data = $instructor;
		}
	}
	
	function index() {
		$instructors = $this->Instructor->find('all');
		$this->set('instructors', $instructors);
	
		$ranksModel = ClassRegistry::init('Rank');
		$ranks = $ranksModel->find('all', array('fields'=>array('id', 'zindex', 'value')));
		$rank_z = array();
		foreach ($ranks as $rank) {
			$rank_z[$rank['Rank']['id']]['z'] = $rank['Rank']['zindex'];
			$rank_z[$rank['Rank']['id']]['value'] = $rank['Rank']['value'];
		}
		
		$collarsModel = ClassRegistry::init('Collar');
		$collars = $collarsModel->find('all');
		$collar_z = array();
		foreach ($collars as $collar) {
			$collar_z[$collar['Collar']['id']] = $collar['Collar']['zindex'];
		}
	
		$this->set('rank_z', $rank_z);
		$this->set('collar_z', $collar_z);
	}
	
	function view($iid = null) {
		if (!$iid) {
			$this->Session->setFlash(__('Illegal instructor id.'));
			$this->redirect(array('controller'=>'instructors', 'action'=>'index'));
		}
		$instructor = $this->Instructor->findById($iid);
		if (!$instructor) {
			$this->Session->setFlash(__('That instructor was not found.'));
			$this->redirect(array('controller'=>'instructors', 'action'=>'index'));
		}
		$rank = $this->Instructor->Student->Rank->findById($instructor['Student']['rank_id']);
		$instructor['Student']['rank'] = $rank['Rank']['value'];
		$this->set('i', $instructor);
		
		$hours = $this->Instructor->Hour->find('all', array(
			'conditions' => array('instructor_id' => $iid),
			'fields' => array('sum(hours) as total, date'),
			'group' => array('date'),
			'recursive' => 0
		));
		$this->set('hours', $hours);
	}
	
	public function delete($id) {
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		if ($this->Instructor->delete($id)) {
			$this->Session->setFlash('Instructor deleted.', 'flash_success');
			$this->redirect(array('action' => 'index'));
		}
	}
}