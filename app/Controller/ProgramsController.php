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

class ProgramsController extends AppController {
	
	public function index() {
		$this->set('programs', $this->Program->find('all', array('conditions' => array('deprecated'=>false))));
	}
	
	public function add() {
		if ($this->request->is('post')) {
			$this->Program->create();
			if ($this->Program->save($this->request->data)) {
				$this->Session->setFlash('Program successfully added', 'flash_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('Unable to add program.');
			}
		}
	}
	
	public function edit($pid = null) {
		if (!$pid) {
			throw new NotFoundException(_('Invalid program'));
		}
	
		$p = $this->Program->findById($pid);
		if (!$p) {
			throw new NotFoundException(_('Invalid program'));
		}
		
		$dep = false;
		if ($p['Program']['deprecated']) {
			$dep = true;
		}
	
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($dep) {
				$this->Session->setFlash('Program is deprecated; editing is not allowed.');
				$this->redirect(array('action'=>'index'));
			}
			$this->Program->id = $p['Program']['id'];
			if ($this->Program->save($this->request->data)) {
				$this->Session->setFlash('Program edited.', 'flash_success');
				$this->redirect(array('action' => 'view', $p['Program']['id']));
			} else {
				$this->Session->setFlash('Failed to edit program.');
			}
		}
	
		if (!$this->data) {
			$this->data = $p;
			$this->set("deprecated", $dep);
		}
	}
	
	
	public function deprecate($pid) {
		if (!$pid) {
			throw new NotFoundException(__("Illegal program ID"));
		}
		
		$program = $this->Program->findById($pid);
		if (!$program) {
			$this->Session->setFlash(__("Program not found"));
			$this->redirect(array('controller'=>'Programs', 'action'=>'index'));
		}
		
		$program['Program']['deprecated'] = true;
		debug($program);
		foreach ($program['Enrollment'] as $key => $_) {
			$program['Enrollment'][$key]['active'] = false;
		}
		if ($this->Program->saveAll($program)) {
			$this->Session->setFlash(__('Program deprecated'), 'flash_success');
			$this->redirect(array('controller'=>'programs', 'action'=>'index'));
		} else {
			$this->Session->setFlash(__('An error occured while deprecating the program.'));
			$this->redirect($this->referer());
		}
	}
	
	public function view($pid = null) {
		if (!$pid) {
			throw new NotFoundException(__('Invalid program'));
		}
		$program = $this->Program->findById($pid);
		if (!$program) {
			throw new NotFoundException(__('Program not found'));
		}
		
		$this->set('p', $program);
	}
}