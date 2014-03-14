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

class BarcodesController extends AppController {
	
	private $randomPool = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
	public $components = array('RequestHandler');
	
	function index() {
		if ($this->request->isPost()) {
			$data = $this->request->data['Barcode'];
			$exists = $this->Barcode->findByValue($data['code']);
			if ($exists) {
				$this->Session->setFlash('That barcode already exists.');
			} else {
				$this->Barcode->create(array('Barcode'=>array(
					'value' => $data['code'],
					'student_id' => $data['student_id']
				)));
				if ($this->Barcode->save()) {
					$this->Session->setFlash('Successfully created barcode.', 'flash_success');
				} else {
					$this->Session->setFlash('Unable to create barcode.');
				}
			}
		}
		$this->Barcode->Student->recursive=0;
		$this->set('students', $this->Barcode->Student->find('all', array('fields'=>array('Student.id', 'Student.name', 'Student.rank', 'Student.ata_number'))));
	}
	 
	function create() {
		if ($this->request->isPost()) {
			$this->Session->write('barcode_settings', json_encode($this->request->data['page']));
			$this->redirect(array('controller'=>'barcodes', 'action'=>'printBarcodes'));
		}
	}
	
	function printBarcodes() {
		if (!$this->Session->check('barcode_settings')) {
			$this->redirect(array('controller'=>'barcodes', 'action'=>'create'));
		}
		$data = json_decode($this->Session->read('barcode_settings'), true);
		$quantity = $data['pages']*$data['rows']*$data['columns'];
		for ($i = 0; $i < $quantity; $i++) {
			$barcodes[$i] = $this->generateRandomText();
		}
		$this->set('barcodes', $barcodes);
		$this->set('settings', $data);
		
		$this->layout = 'pdf';
		$this->render();
	}
	
	private function generateRandomText() {
		$randomString = "";
		for ($i=0; $i < 10; $i++) {
			$randomString .= substr($this->randomPool, mt_rand(0, 36)-1, 1);
		}
		$exists = $this->Barcode->findByValue($randomString);
		if ($exists) return generateRandomBarcode();
		return $randomString;
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
			$barcode = $this->Barcode->findByValue($search);
			if (!$barcode) {
				echo json_encode('nope');
				return;
			}
			$url = Router::url(array('controller'=>'students', 'action'=>'view', $barcode['Barcode']['student_id'])); 
			echo json_encode(array('url'=>$url, 'name'=>$barcode['Student']['name'])); 
		}
	}
}
?>
