<?php
App::uses('AppController', 'Controller');
class OptimizelyAppController extends AppController {
	public function goodFlash($message) {
		$this->Session->setFlash($message,'goodFlash');
	}

	public function badFlash($message) {
		$this->Session->setFlash($message,'badFlash');
	}

	public function infoFlash($message) {
		$this->Session->setFlash($message,'infoFlash');
	}
}
