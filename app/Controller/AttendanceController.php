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
class AttendanceController extends AppController {
	public $componenents = 'RequestHandler';
	public $helpers = array('Html');
	
	public function index() {
		if ($this->request->isPost()) {
			$date = $this->request->data['date'];
			$students = $this->request->data['Students'];
			$failed = array();
			
			foreach ($students as $s) {
				$student = $this->Attendance->Student->findById($s['id']);
				if (!$student) {
					$failed[$student] = 'Student not found';
					continue;
				}
				$row = array('student_id' => $student['Student']['id'], 'date' => $date);
				if (!$this->Attendance->saveAll($row)) {
					$failed[$atan['ata_number']] = 'Failed to mark attendance';
				}
			}
			
			if (empty($failed)) {
				$this->Session->setFlash("Successfully marked students as present for " . date("n/j/Y", date_create_from_format("Y-m-d", $date)->getTimestamp()) . ".", 'flash_success');
			} else {
				$this->Session->setFlash("Failed to mark some students as present for " . date("n/j/Y", date_create_from_format("Y-m-d", $date)->getTimestamp()) . ".");
			}
		}
	}
	
	public function report() {}
	
	public function search() {
		if (!$this->request->is('Ajax')) {
			$this->redirect(array('action'=>'index'));
		}
		$this->autoRender = false;
		$this->layout = 'ajax';
	
		if (!$this->request->isPost() || !($search = $this->request->data['search'])) {
			echo json_encode(array($search));
		} else {
			$student = $this->Attendance->Student->Barcode->findByValue($search);
			if (!$student) {
				$student = $this->Attendance->Student->findByAtaNumber($search);
				if (!$student) {
					$student = $this->Attendance->Student->find('first', array(
						'conditions' => array('concat(first_name, " ", last_name) LIKE' => '%' . $search . '%')
					));
					if (!$student) {
						echo json_encode('err');
						return;
					}
				}
			}
			$atan = $student['Student']['ata_number'];
			if (!$atan) $atan = '';
			echo json_encode(array('name'=>$student['Student']['name'], 'id'=>$student['Student']['id'], 'ata_number'=>$student['Student']['ata_number']));
		}
	}
	
	public function fetchRecords() {
		if (!$this->request->is('Ajax')) {
			$this->redirect(array('action'=>'view'));
		}
		$this->autoRender = false;
		$this->layout = 'ajax';
		
		$conditions = array();
		$limit = 100;
		$fields = null;
		if (isset($_POST['start_date'])) {
			$conditions['date >= '] = $_POST['start_date'];
		}
		if (isset($_POST['end_date'])) {
			$conditions['date <= '] = $_POST['end_date'];
		}
		if (isset($_POST['student_id'])) {
			$conditions['Attendance.student_id'] = json_decode($_POST['student_id']);
			$limit = null;
		}
		$result = $this->Attendance->find('all', array(
				'conditions' => $conditions,
				'fields' => array('concat (Student.first_name, " ", Student.last_name) AS name', 'group_concat(Attendance.date) AS date', 'count(*) AS count'),
				'group' => 'Attendance.student_id',
				'limit' => $limit,
				'order' => 'count DESC'
		));
		$json = array();
		foreach ($result as $row) $json[] = $row[array_keys($row)[0]];
		echo json_encode($json);
	}
}
?>