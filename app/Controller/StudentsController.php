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

class StudentsController extends AppController {
	public $helpers = array('Html', 'Form', 'Session');
	public $components = array('Session');
	
	public function index() {
		$students = $this->Student->find('all');
		foreach ($students as $id => $student) {
			$total = 0;
			foreach ($student['Transaction'] as $transaction) {
				$total += $transaction['total'];
			}
			$students[$id]['Transaction']['total'] = $total;
		}
		$this->set('students', $students);
		$this->set('ranks', $this->Student->buildRankPriority());
	}
	
	public function view($sid = null) {
		if (!$sid) {
			throw new NotFoundException(__('Invalid student'));
		}
		$this->Student->recursive = 2;
		$student = $this->Student->findById($sid);
		if (!$student) {
			$student = $this->Student->findByAtaNumber($sid);
			if (!$student) {
				throw new NotFoundException(__('Student not found'));
			}
		}
		
		$this->set('ranks', $this->Student->ranks);
		foreach($student['Transaction'] as $t) {
			$student['TransactionItem'][$t['id']] = $this->Student->Transaction->TransactionItem->findAllByTransactionId($t['id']);
		}
		$this->set('s', $student);
	}
	
	public function add($guest = false) {
		if ($this->request->is('post')) {
			$this->Student->create();
			if ($this->Student->save($this->request->data)) {
				$this->Session->setFlash('Student successfully registered.', 'flash_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('Unable to register student.');
			}
		}
	}
	
	public function update($sid = null) {
		if (!$sid) {
			throw new NotFoundException(__('Invalid student'));
		}
		
		$s = $this->Student->findById($sid);
		if (!$s) {
			throw new NotFoundException(__('Invalid student'));
		}
		
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->Student->id = $s['Student']['id'];
			if ($this->Student->save($this->request->data)) {
				$this->Session->setFlash('Student updated.', 'flash_success');
				$this->redirect(array('action' => 'view', $s['Student']['id']));
			} else {
				$this->Session->setFlash('Failed to update student.');
			}
		}
		
		if (!$this->data) {
			$this->data = $s;
			$this->set('ranks', $this->Student->ranks);
		}
	}
	
	public function remove($cid, $sid) {
		$this->loadModel('Contact');
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		
		if (!$cid) {
			throw new NotFoundException(__("Invalid contact"));
		}
		if (!$sid) {
			throw new NotFoundException(__("Invalid student"));
		}
		
		if ($this->Student->ContactsStudent->deleteAll(array('contact_id'=>$cid, 'student_id'=>$sid))) {
			$this->Session->setFlash('Removed link.');
			$this->redirect('index');
		} else {
			$this->Session->setFlash('Unable to remove link.');
		}
	}
	
	public function contacts($sid) {
		$this->loadModel('Contact');
		if (!$sid) {
			throw new NotFoundException(_("Invalid student"));
		}
		$student = $this->Student->findById($sid);
		if (!$student) {
			throw new NotFoundException(__("Invalid student"));
		}
		$id = $student['Student']['id'];
		$tbl = $this->Student->tablePrefix . "contacts_students";
		$contacts = $this->Contact->find('all', array('conditions' => "Contact.id IN (SELECT contact_id FROM $tbl WHERE student_id=$id)"));
		$this->set('contacts', $contacts);
		$this->set('student', $student);
	}
	
	public function delete($id) {
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		if ($this->Student->delete($id)) {
			$this->Session->setFlash('Student deleted.', 'flash_success');
			$this->redirect(array('action' => 'index'));
		}
	}
	
	public function search($param1 = false, $param2 = false) {
		$term = $_GET['term'];
		$students = $this->Student->find('all', array(
				'conditions' => "search LIKE '%$term%'", 
				'fields'=>array('search')
			));
		$res = array();
		foreach ($students as $s) {
			array_push($res, $s['Student']['search']);
		}
		echo json_encode($res);
		exit;
	}
	
	public function picture($sid, $remove = false) {
		$this->Student->recursive = 0;
		$student = $this->Student->findById($sid);
		if (!$student) {
			$this->Session->setFlash('Student does not exist');
			$this->redirect(array('controller'=>'students', 'action'=>'inedx'));
		}
		$this->Student->id = $sid;
		if ($remove) {
			unlink(WWW_ROOT . 'img/students/' . $student['Student']['picture']);
			if ($this->Student->saveField('picture', null)) {
				$this->Session->setFlash('Successfully removed picture', 'flash_success');
			} else {
				$this->Session->setFlash('Failed to remove picture');
			}
			$this->redirect(array('controller'=>'students', 'action'=>'view', $student['Student']['id']));
		}
		if ($this->request->isPost()) {
			$image = base64_decode($this->request->data['picture']['picture_data']);
			$url = uniqid('student_id') . '.png';
			if (file_put_contents(WWW_ROOT . 'img/students/' . $url, $image)) {
				if ($this->Student->saveField('picture', $url)) {
					$this->Session->setFlash('Successfully added image', 'flash_success');
					$this->redirect(array('controller'=>'students', 'action'=>'view', $student['Student']['id']));
				} else {
					$this->Session->setFlash('Unable to save image');
				}
			} else {
				$this->Session->setFlash('Failed to upload image.');
			}
		}
		$this->set('student', $student['Student']);
	}
}
?>