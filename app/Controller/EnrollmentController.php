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

class EnrollmentController extends AppController {
	public $uses = array('Enrollment', 'Transaction');
		
	public function student($sid) {
		if (!isset($sid)) {
			throw new BadRequestException(__('Illegal ATA Number'));
		}
		$student = $this->Enrollment->Student->findById($sid);
		if (!$student) {
			$this->Session->setFlash(__('Student not found.'));
			$this->redirect(array('controller'=>'students', 'action'=>'index'));
		}
		if ($this->request->isPost()) {
			$data = $this->request->data;
			$this->Enrollment->create(array(
				'student_id' => $data['enroll']['student_id'],
				'program_id' => $data['enroll']['program_id'],
				'active' => true,
				'expiration_date' => $data['enroll']['expiration_date'],
				'enrolled' => 'NOW()'
			));
			if (!$this->Enrollment->save()) {
				$this->Session->setFlash(__('Error: Failed to enroll student.'));
				$this->redirect(array('action'=>'index'));
			}
			if ($data['enroll']['charge']) {
				$this->Transaction->create(array(
					'student_id' => $data['enroll']['student_id'],
					'total' => $data['enroll']['price']
				));
				if ($data['enroll']['paid']) {
					$this->Transaction->set(array(
						'paid' => true,
						'paid_timestamp' => 'NOW()'
					));
				}
				if (!$this->Transaction->save()) {
					$this->Session->setFlash(__('Error: Failed to apply charge.'));
				} else {
					$program = $this->Enrollment->Program->findById($data['enroll']['program_id']);
					$description = 'Enrollment in ' . (isset($program) ? $program['Program']['name'] : 'unknown program.');
					$this->Transaction->TransactionItem->create(array(
						'transaction_id' => $this->Transaction->id,
						'description' => $description,
						'unit_price' => $data['enroll']['price'],
						'quantity' => 1
					));
					if (!$this->Transaction->TransactionItem->save()) {
						$this->Session->setFlash(__('Error: Failed to create charge item.'));
					}
				}
			}
			$this->Session->setFlash(__('Successfully enrolled student in program.'), 'flash_success');
			$this->redirect(array('controller'=>'students', 'action'=>'view', $student['Student']['ata_number']));
		}
		$this->set('student', $student);
		$this->set('programs', $this->Enrollment->Program->find('all'));
	}
	
	public function unenroll($eid) {
		$enrollment = $this->Enrollment->findById($eid);
		if (!$enrollment) {
			$this->Sessnion->setFlash(__('Enrollment not found.'));
			$this->redirect($this->request->referer());
		}
		$enrollment['Enrollment']['active'] = false;
		$enrollment['Enrollment']['unenrolled'] = 'NOW()';
		if ($this->Enrollment->save($enrollment)) {
			$this->Session->setFlash(__('Successfully unenrolled student.'), 'flash_success');
			$this->redirect($this->request->referer());
		}
	}
	
	public function renew($eid) {
		$enrollment = $this->Enrollment->findById($eid);
		if (!$enrollment) {
			$this->Session->setFlash(__('Error: Enrollment not found.'));
		} else {
			if ($this->request->isPost()) {
				$data = $this->request->data;
				$enrollment['Enrollment']['expiration_date'] = $data['renew']['expiration_date'];
				if (!$this->Enrollment->save($enrollment)) {
					$this->Session->setFlash(__('Error: Failed to enroll student.'));
					$this->redirect(array('action'=>'index'));
				}
				if ($data['renew']['charge']) {
					$this->Transaction->create(array(
						'student_id' => $enrollment['Enrollment']['student_id'],
						'total' => $data['renew']['price']
					));
					if ($data['renew']['paid']) {
						$this->Transaction->set(array(
							'paid' => true,
							'paid_timestamp' => 'NOW()'
						));
					}
					if (!$this->Transaction->save()) {
						$this->Session->setFlash(__('Error: Failed to apply charge.'));
					} else {
						$program = $this->Enrollment->Program->findById($enrollment['Enrollment']['program_id']);
						$description = 'Enrollment in ' . (isset($program) ? $enrollment['Program']['name'] : 'unknown program.');
						$this->Transaction->TransactionItem->create(array(
							'transaction_id' => $this->Transaction->id,
							'description' => $description,
							'unit_price' => $data['renew']['price'],
							'quantity' => 1
						));
						if (!$this->Transaction->TransactionItem->save()) {
							$this->Session->setFlash(__('Error: Failed to create charge item.'));
						}
					}
				}
				$this->Session->setFlash('Successfully renewed student in program.', 'flash_success');
				$this->redirect(array('controller'=>'students', 'action'=>'view', $enrollment['Student']['ata_number']));
			} else {
				$this->set('enrollment', $enrollment);
			}
		}
	}
}
?>