<?php
/**
* Optimizely DataSource
*
*/
App::uses('HttpSocket', 'Network/Http');
App::uses('Xml', 'Utility');
class OptimizelySource extends DataSource{
	/**
	* Description of datasource
	*
	* @var string
	* @access public
	*/
	var $description = "Optimizely Data Source";

	/**
	* API URL
	* @var array
	* @access public
	*/
	public $url = 'https://www.optimizelyapis.com/experiment/v1';

	/**
	* HttpSocket object
	*
	* @var HttpSocket
	* @access public
	*/
	public $Http = null;

	/**
	* Request Logs
	*
	* @var array
	* @access private
	*/
	public $__requestLog = array();

	/**
	* Constructor
	*
	* Creates new HttpSocket
	*
	* @param array $config Configuration array
	* @access public
	*/
	public function __construct($config = array()) {
		parent::__construct($config);
		$this->Http = new HttpSocket();
	}

	public function listProjects() {
		return $this->api('/projects');
	}

	public function listExperiments($project_id = '') {
		return $this->api('/projects/'. $project_id .'/experiments');
	}

	public function api($uri, $method = 'GET', $data = array()) {
		$url = $this->url . $uri;
		$this->__reuqestLog[] = $url;
		$retval = $this->Http->request(array(
			'uri' => $this->url . $uri,
			'method' => $method,
			'header' => array(
				'Token' => $this->config['token']
			),
			'body' => $data
		));
		if (!$retval->isOK()){
			return false;
		}
		return json_decode($retval->body, true);
	}
}