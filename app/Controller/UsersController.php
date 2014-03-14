<?php 

/*************************************************************************
 * This file is a part of the Kickbag Martial Arts Manager.
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

class UsersController extends AppController {
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('login');
	}
	
	public function add() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('the user has been saved'), 'flash_success');
				$this->redirect(array('controller'=>'Students'));
			} else {
				$this->Session->setFlash(__('User creation failed.'));
			}
		}
	}
	
	public function login() {
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				$this->redirect(array('controller'=>'students'));
			} else {
				$this->Session->setFlash(__('Invalid username or password.'));
			}
		}
	}
	
	public function logout(){
		$this->redirect($this->Auth->logout());
	}
}
?>