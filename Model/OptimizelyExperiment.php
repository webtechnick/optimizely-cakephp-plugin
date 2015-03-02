<?php
App::uses('OptimizelyAppModel', 'Optimizely.Model');
/**
 * OptimizelyExperiment Model
 *
 */
class OptimizelyExperiment extends OptimizelyAppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'edit_url';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'status' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'url_condition_value' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'url_condition_match_type' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'descriptions' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'sharable_results_link' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'is_multivariante' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'edit_url' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	/**
	* List of fields to search for using quick search
	*/
	public $searchFields = array('OptimizelyExperiment.id','OptimizelyExperiment.edit_url');

	/**
	* List of fields that can be updated via ajax.
	*/
	public $ajaxFields = array();

	/**
	* Cache exepriments of a project.
	*/
	public function cacheExperiments($project_id = null) {
		if (!$project_id) {
			return false;
		}
		$this->loadOptimizely();
		$experiments = $this->Optimizely->listExperiments($project_id);
		$retval = 0;
		foreach ($experiments as $experiment) {
			$this->clear();
			$save_data = $experiment;
			$save_data['url_condition_value'] = $experiment['url_conditions'][0]['value'];
			$save_data['url_condition_match_type'] = $experiment['url_conditions'][0]['match_type'];
			$save_data['optimizely_project_id'] = $experiment['project_id'];
			if ($this->save($save_data)) {
				$retval++;
			} else {
				debug($save_data);
			}
			return $retval;
		}
	}

	/**
	* Decide if the current page has
	* @param string here.
	* @return boolean true if this url has an active experiment.
	*/
	public function hasExperiment($here = null) {
		App::uses('Router','Routing');
		$url = Router::url($here, true);
		$conditions = array(
			'OptimizelyExperiment.edit_url' => $url,
		);
		return $this->hasAny($conditions);
	}
}
