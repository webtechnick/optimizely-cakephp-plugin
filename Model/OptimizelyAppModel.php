<?php

App::uses('AppModel', 'Model');

class OptimizelyAppModel extends AppModel {

	public $actsAs = array('Containable');

	public $Optimizely = null;

	/**
	* Load the optimizely datasource
	*/
	public function loadOptimizely() {
		if ($this->Optimizely === null) {
			App::uses('ConnectionManager','Model');
			$this->Optimizely = ConnectionManager::getDataSource('optimizely');
		}
	}

	/**
	* String to datetime stamp
	* @param string that is parsable by str2time
	* @return date time string for MYSQL
	*/
	public function str2datetime($str = 'now') {
		if (is_array($str) && isset($str['month']) && isset($str['day']) && isset($str['year'])) {
			$str = "{$str['month']}/{$str['day']}/{$str['year']}";
		}
		return date("Y-m-d H:i:s", strtotime($str));
	}

	/**
	* This is what I want create to do, but without setting defaults.
	*/
	public function clear() {
		$this->id = false;
		$this->data = array();
		$this->validationErrors = array();
		return $this->data;
	}
}
