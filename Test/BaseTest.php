<?php
/* Set an environment variable to indicate we are running unit tests */
$_SERVER['UNITTEST'] = true;
/**
* Baseically like an AppModel for Tests
* I'd prefer to call it AppTest, but AppTest is already written and is what calls
* all the tests for app
*/
class BaseTest extends ControllerTestCase {
	public $fixtures = array();

	/**
	* Load extra fixtures by checkint addFixtures to paticular tests
	*/
	public function __construct($name = NULL, array $data = array(), $dataName = ''){
		if(isset($this->addFixtures)){
			foreach($this->addFixtures as $fixture){
				if (!in_array($fixture, $this->fixtures)) {
					array_unshift($this->fixtures, $fixture);
				}
			}
		}
		return parent::__construct($name, $data, $dataName);
	}

	/**
 * Reloads the routes configuration from config/routes.php, and compiles
 * all routes found
 *
 * @return boolean True if config reload was a success, otherwise false
 * @access protected
 */
	protected function _loadRoutes() {
		App::uses('Router', 'Routing');
		Router::reload();
		if (!@include(APP . 'Config' . DS . 'routes.php')) {
			return false;
		}
		Router::parse('/');
		return true;
	}

	protected function loadRoutes(){
		$this->_loadRoutes();
	}

	public function setRequest($here = ''){
		$request = new stdClass();
		$request->here = $here;
		return $request;
	}

	public function assertWithinRange($result, $expected, $margin) {
		$upper = $result + $margin;
		$lower = $result - $margin;
		return $this->assertTrue((($expected <= $upper) && ($expected >= $lower)));
	}

	public function setHost($host = null) {
		if (!$host) {
			$host = Configure::read('host');
		}
		$_SERVER['SERVER_NAME'] = $host;

		$this->Session = new stdClass();
		$this->Session->host = $host;
		return $this->Session;
	}
}