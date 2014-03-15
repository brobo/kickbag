<?php
class Collar extends AppModel {
	public function getCollars() {
		$collars_raw = $this->find('all', array('fields'=>array('id', 'value', 'zindex')));
		$collars = array();
		foreach ($collars_raw as $collar) {
			$collars[$collar['Collar']['id']] = $collar['Collar'];
		}
	
		return $collars;
	}
	
	public function getCollarValues() {
		$collars_raw = $this->find('all', array('fields'=>array('id', 'value')));
		$collars = array();
		foreach ($collars_raw as $collar) {
			$collars[$collar['Collar']['id']] = $collar['Collar']['value'];
		}
		return $collars;
	}
}
?>