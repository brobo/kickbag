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

class TestingsController extends AppController {
	public $helpers = array('Html', 'Form', 'Session');
	public $components = array('Session');
	
	var $currentId = -1;
	
	public function add() {
		if ($this->request->is('post')) {
			$this->Testing->create();
			$this->request->data['Testing']['password'] = Security::hash($this->request->data['Testing']['password'], null, true);
			$this->request->data['Testing']['re_password'] = Security::hash($this->request->data['Testing']['re_password'], null, true);
			if ($this->Testing->save($this->request->data)) {
				$this->Session->setFlash('Testing successfully created.', 'flash_success');
				$this->redirect(array('action' => 'manage'));
			} else {
				$this->Session->setFlash('Unable to create testing.');
			}
		}
	}
	
	public function manage() {
		$testings = $this->Testing->find('all', array(
				'conditions' => array('Testing.time >= CURDATE()'),
				'order' => array('Testing.time')
		));
		$this->set('testings', $testings);
		$running = $this->Testing->find('first', array('conditions'=>array('active'=>true)));
		$this->set('start', !$running);
	}
	
	public function start($tid = null) {
		if (!$tid) {
			throw new NotFoundException(__("Invalid testing"));
		}
		$testing = $this->Testing->findById($tid);
		if (!$testing) {
			throw new NotFoundException(__("Invalid testing"));
		}
		var_dump($testing);
		if ($testing['Testing']['active']) {
			throw new MethodNotAllowedException(__("Testing is already running!"));
		}
		$testing['Testing']['active'] = true;
		$this->Testing->save($testing);
		$this->redirect(array('action'=>'manage'));
	}
	
	public function stop() {
		$this->Testing->updateAll(array('active'=>false), array('active'=>true));
		$this->redirect(array('action'=>'manage'));
	}
	
	public function login() {
		$loginOptional = true;
		$this->loadModel('Judge');
		$testing = $this->Testing->getRunningTesting();
		if (!$testing) {
			throw new MethodNotAllowedException(__('Testing is not running!'));
		}
		if ($this->request->isPost()) {
			$hash = Security::hash($this->request->data('password'), null, true);
			if ($hash !== $testing['password']) {
				$this->Session->setFlash('Incorrect password.');
			} else {
				$this->Session->write('Testing.loggedIn', true);
				$judge = $this->Judge->findByAtaNumber($this->request->data('ata_number'));
				if (!$judge) {
					$this->redirect(array('action'=>'register', $this->request->data('ata_number')));
				} else {
					$existing = $this->Judge->PanelSeat->find('all', array('conditions' => array('judge_id'=>$judge['Judge']['id'], 'testing_id'=>$testing['id'])));
					if (!$existing) $this->redirect(array('action'=>'update', $judge['Judge']['ata_number']));
					else {
						$this->Session->write("Testing.judgeId", $judge['Judge']['id']);
						$this->redirect(array('action'=>'index'));
					}
				}
			}
		}
	}
	
	public function loginAsHead() {
		$this->Session->write('Testing.head', true);
		$this->redirect(array('action'=>'login'));
	}
	
	public function logout() {
		$loginOptional = true;
		$this->Session->delete('Testing.loggedIn');
		$this->Session->delete('Testing.judgeId');
		$this->Session->delete('Testing.head');
		$this->redirect(array('action'=>'login'));
	}
	
	public function register($ata_number = null) {
		$loginOptional = true;
		$testing = $this->Testing->getRunningTesting();
		if (!$testing) {
			throw new MethodNotAllowedException(__('Testing is not running!'));
		}
		if (!$this->Session->read('Testing.loggedIn')) {
			$this->redirect(array('action'=>'login'));
		}
		if (!$ata_number) {
			throw new NotFoundException(__("ATA Number is not valid"));
		}
		if ($this->request->isPost()) {
			$this->Testing->Judge->save($this->request->data);
			$this->redirect(array('action'=>'update', $ata_number));
		} else {
			$student = $this->Testing->Judge->Student->findByAtaNumber($ata_number);
			if ($student) {
				$this->set('name', $student['Student']['name']);
				$this->set('rank', $student['Student']['rank']);
				$this->set('sid', $student['Student']['id']);
			}
			$this->set('atanum', $ata_number);
			$this->set('ranks', $this->Testing->ranks);
		}
	}
	
	public function update($atan = null) {
		$loginOptional = true;
		$this->loadModel('Judge');
		$testing = $this->Testing->getRunningTesting();
		if (!$testing) {
			throw new MethodNotAllowedException(__('Testing is not running!'));
		}
		if (!$this->Session->read('Testing.loggedIn')) {
			$this->redirect(array('action'=>'login'));
		}
		if (!$atan) {
			throw new NotFoundException(__('Invalid judge'));
		}
		$judge = $this->Judge->findByAtaNumber($atan);
		if (!$judge) {
			throw new NotFoundException(__('Invalid judge'));
		}
		
		if ($this->request->is('post') || $this->request->is('put')) {
			debug($this->request->data);
			debug($judge);
			$this->Judge->id = $judge['Judge']['id'];
			if ($this->Judge->save($this->request->data)) {
				$rel = array('PanelSeat' => array(
					'judge_id' => $judge['Judge']['id'],
					'testing_id' => $testing['id'],
					'rank' => $this->request->data['Judge']['rank']		
				));
				$this->Testing->PanelSeat->save($rel);
				$this->Session->write("Testing.judgeId", $judge['Judge']['id']);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('Failed to update your information.');
			}
		}
		
		if (!$this->data) {
			$this->data = $judge;
			$this->set('ranks', $this->Testing->ranks);
		}
	}
	
	public function index() {
		$loginOptional = true;
		if ($this->Session->read('Testing.loggedIn') ^ $this->Session->read('Testing.judgeId')) {
			//This should be the same. "Partially logged in" means in the process of updating judge info.
			$this->Session->delete('Testing.loggedIn');
			$this->Session->delete('Testing.judgeId');
		}
		if (!$this->Session->read('Testing.loggedIn')) {
			$this->redirect(array('action'=>'login'));
		}
		$testing = $this->Testing->find('first', array('conditions'=>array('active'=>1)));
		if (!$testing) {
			throw new NotFoundException(__("Testing is not running!"));
		} else {
			$this->set('testing', $testing);
		}
	}
	
	public function edit($tid = null) {
		if (!$tid) {
			throw new NotFoundException(__("Testing not found."));
		}
		$testing = $this->Testing->findById($tid);
		if (!$testing) {
			throw new NotFoundException(__("Testing not found."));
		}
		
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->Testing->id = $tid;
			$params = array();
			if ($this->request->data['Testing']['password'] == "") {
				$params = array('fieldList' => array('time', 'description'));
			}
			if ($this->Testing->save($this->request->data, $params)) {
				$this->Session->setFlash('Testing saved.', 'flash_success');
				$this->redirect(array('action' => 'manage'));
			} else {
				$this->Session->setFlash('Failed to save testing.');
			}
		}
		
		if (!$this->data) {
			$this->data = $testing;
		}
	}
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('login', 'logout', 'update', 'register', 'index');
	}
}
?>