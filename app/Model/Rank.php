<?php
class Rank extends AppModel {
	public function getRanks() {
		$ranks_raw = $this->find('all', array('fields'=>array('id', 'value', 'abbr', 'zindex')));
		$ranks = array();
		foreach ($ranks_raw as $rank) {
			$ranks[$rank['Rank']['id']] = $rank['Rank']; 
		}
		
		return $ranks;
	}
	
	public function getRankValues() {
		$ranks_raw = $this->find('all', array('fields'=>array('id', 'value')));
		$ranks = array();
		foreach ($ranks_raw as $rank) {
			$ranks[$rank['Rank']['id']] = $rank['Rank']['value'];
		}
		return $ranks;
	}
}
?>