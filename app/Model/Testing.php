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

class Testing extends AppModel {
	public $name = 'Testing';
	//public $hasMany = array('PanelSeat', 'TestingStudent');
	public $hasMany = array('TestingStudent');
	/*public $hasAndBelongsToMany = array(
		'Judge' => array(
			'className' => 'Judge',
			'joinTable' => 'panel_seats',
			'foreignKey' => 'testing_id',
			'associationForeignKey' => 'judge_id',
			'unique' => false
		),
	);*/
	
	public $validate = array(
			'password' => array(
					'required' => array('rule' => array('notEmpty'), 'message' => 'Password required')
			),
			're_password' => array(
				'required' => array('rule' => array('equalToField', 'password'), 'message' => 'Both passwords need to be the same!')
			)
	);
	
	/*public function beforeSave($options = array()) {
		if (isset($this->data[$this->alias]['password'])) {
			$this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
		}
	}*/ //Removed because password was hashing twice
	
	public function equalToField($array, $field) {
		return strcmp($this->data[$this->alias][key($array)], $this->data[$this->alias][$field]) == 0;
	}
	
	/*public function authJudge() {
		if (!getRunningTesting()) {
			throw new MethodNotAllowedException(__('Testing is not running!'));
		}
		if (!$this->Session->check('Testing.judge')) {
			$this->Session->setFlash('Please log in first!');
			$this->redirect(array('action'=>'login'));
		}
	}*/
	
	/*public function getRunningTesting() {
		$running = $this->find('first', array('conditions'=>array('active'=>true)));
		return !$running ? null : $running['Testing'];
	}*/
	
	public function getStudents($tid) {
		
	}
}
?>