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

class TransactionsController extends AppController {
	public $helpers = array('Form', 'Html');
	public $components = array('Session');
	
	public function add() {
		if (!empty($this->request->data)) {
			$student = $this->Transaction->Student->findBySearch($this->request->data['Transaction']['student_search']);
			if (!$student) {
				$this->Session->setFlash(__('No student was selected.'));
				return;
			}
			$this->request->data['Transaction']['student_id'] = $student['Student']['id'];
			$transaction = $this->Transaction->save($this->request->data);
			if (!empty($transaction)) {
				for ($i = 0; $i < count($this->request->data['TransactionItem']); $i++) {
					$this->request->data['TransactionItem'][$i]['transaction_id'] = $this->Transaction->id;
				}
				$this->Transaction->TransactionItem->saveMany($this->request->data['TransactionItem']);
			} else {
				throw new InternalErrorException(_('Unable to create Transaction.'));
			}
			$this->Session->setFlash('Applied charge', 'flash_success');
			$this->redirect(array('controller'=>'Students', 'action'=>'view', $student['Student']['ata_number']));
		}
	}
	
	public function index() {
		$this->Transaction->recursive=2;
		$this->set('transactions', $this->Transaction->find('all', array(
			'conditions' => array('paid' => false)
		)));
	}
	
	public function mark_paid($tid) {
		$transaction = $this->Transaction->findById($tid)['Transaction'];
		if (!$transaction) {
			throw new NotFoundException(_('Transaction not found.'));
		}
		$transaction['paid'] = true;
		$transaction['paid_timestamp'] = date('Y-m-d H:i:s');
		var_dump($transaction);
		$this->Transaction->save($transaction);
		$this->Session->setFlash('Paid', 'flash_success');
		$this->redirect(array('controller'=>'Students', 'action'=>'view', $transaction['student_id']));
	}
}
?>