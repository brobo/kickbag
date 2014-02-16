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

class ContactsController extends AppController {
	public $helpers = array('Html', 'Form', 'Session');
	public $components = array('Session');
	
	public function add($sid = null) {
		$this->loadModel('Student');
		if (!$sid) {
			throw new NotFoundException(_('Invalid student'));
		}
		$s = $this->Student->findById($sid);
		if (!$s) {
			throw new NotFoundException(_('Student not found'));
		}
		if ($this->request->is('post')) {
			$this->Contact->create();
			if ($this->Contact->save($this->request->data)) {
				$this->Session->setFlash('Contact created', 'flash_success');
				$this->redirect(array('controller' => 'Students', 'action' => 'contacts', $s['Student']['ata_number']));
			} else {
				$this->Session->setFlash('Unable to create Contact');
			}
		}
		
		$this->set('sid', $sid);
	}
	
	public function link($sid = null, $cid = null) {
		$this->loadModel('Student');
		if (!$sid) {
			throw new NotFoundException(_('Invalid student'));
		}
		$student = $this->Student->findById($sid);
		if (!$sid) {
			throw new NotFoundException(_('Invalid student'));
		}
		if (!$cid) {
			$tbl = $this->Contact->tablePrefix . "contacts_students";
			$contacts = $this->Contact->find('all', array('conditions' => array("id not in (select contact_id from $tbl where student_id = $sid)")));
			$this->set('contact', $contacts);
			$this->set('sid', $sid);
		} else {
			$contact = $this->Contact->findById($cid);
			if (!$contact) {
				throw new NotFoundException(_('Invalid contact'));
			}
			$rel = array(
					'Contact' => array(
							'id' => $cid
					), 'Student' => array(
							'id' => $sid
					));
			if ($this->Contact->saveAll($rel)) {
				$this->Session->setFlash("Contact linked.", 'flash_success');
				$this->redirect(array('controller' => 'Students', 'action' => 'view', $student['Student']['ata_number']));
			} else {
				$this->Session->setFlash("Failed to link.");
			}
		}
	}
	
	public function delete($id) {
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
	
		if ($this->Contact->delete($id)) {
			$this->Session->setFlash('Contact deleted.');
			$this->redirect(array('action' => 'index'));
		}
	}
	
	public function index() {
		$this->set('contact', $this->Contact->find('all'));
	}
	
	public function update($id = null) {
		if (!$id) {
			throw new NotFoundException(_('Invalid student'));
		}
	
		$contact = $this->Contact->findById($id);
		if (!$contact) {
			throw new NotFoundException(_('Invalid student'));
		}
	
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Contact->save($this->request->data)) {
				$this->Contact->setFlash('Contact updated.', 'flash_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('Failed to update contact.');
			}
		}
	
		if (!$this->data) {
			$this->data = $contact;
			$this->set('id', $contact['Contact']['id']);
		}
	}
	
}
?>