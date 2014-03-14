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

App::uses('AppController', 'Controller');
class HoursController extends AppController {
	public $componenents = 'RequestHandler';
	public $helpers = array('Html');
	
	public function index() {
		if ($this->request->isPost()) {
			$newHour = $this->request->data;
			$instructor = $this->Hour->Instructor->findById($newHour['Hour']['instructor_id']);
			if (!$instructor) {
				$this->Session->setFlash(__('Instructor not found.'));
				$this->redirect(array('controller'=>'hours', 'action'=>'index'));
			}
			$this->Hour->create();
			if (!$this->Hour->save($newHour)) {
				$this->Session->setFlash(__('Failed to save instructor hours.'));
				$this->redirect($this->here);
			}
			
			$this->Session->setFlash('Successfully gave ' . $this->Hour->hours . ' hours to ' . $instructor['Student']['name'] . ".", 'flash_success');
		}
	}
	
	public function report() {}
	
	public function fetchRecords() {
		if (!$this->request->is('Ajax')) {
			$this->redirect(array('action'=>'view'));
		}
		$this->autoRender = false;
		$this->layout = 'ajax';
		
		$conditions = array();
		$limit = 10;
		$fields = null;
		if (isset($_POST['start_date'])) {
			$conditions['date >= '] = $_POST['start_date'];
		}
		if (isset($_POST['end_date'])) {
			$conditions['date <= '] = $_POST['end_date'];
		}
		if (isset($_POST['instructor_id'])) {
			$conditions['Hour.instructor_id'] = json_decode($_POST['instructor_id']);
			$limit = null;
		}
		$result = $this->Hour->find('all', array(
				'fields' => array('sum(hours) as total', 'Hour.date'),
				'conditions' => $conditions,
				'group' => 'Hour.date',
				'limit' => $limit,
				'recursive' => 1
		));
		$json = array();
		foreach ($result as $row) $json[] = array('date' => $row['Hour']['date'], 'total' => $row[0]['total']);
		echo json_encode($json);
	}
	
	public function search() {
		if (!$this->request->is('Ajax')) {
			$this->redirect(array('action'=>'index'));
		}
		$this->autoRender = false;
		$this->layout = 'ajax';
	
		if (!$this->request->isPost() || !($search = $this->request->data['search'])) {
			echo json_encode(array($search));
		} else {
			$student = $this->Hour->Instructor->Student->Barcode->findByValue($search);
			if (!$student) {
				$student = $this->Hour->Instructor->Student->findByAtaNumber($search);
				if (!$student) {
					$student = $this->Hour->Instructor->Student->find('first', array(
							'conditions' => array('concat(first_name, " ", last_name) LIKE' => '%' . $search . '%')
					));
					if (!$student) {
						echo json_encode(array('err'=>'Student not found.'));
						return;
					}
				}
			}
			$instructor = $this->Hour->Instructor->findByStudentId($student['Student']['id']);
			if (!$instructor) {
				echo json_encode(array('err'=>'Student not an instructor.'));
				return;
			}
			echo json_encode(array(
					'name'=>$student['Student']['name'], 
					'id'=>$instructor['Instructor']['id'], 
					'ata_number'=>$student['Student']['ata_number'],
					'rank' => $student['Student']['rank'], 
					'collar'=>$instructor['Instructor']['collar']));
		}
	}
}
?>