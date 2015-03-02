<?php
App::uses('OptimizelyAppModel', 'Optimizely.Model');
/**
 * OptimizelyProject Model
 *
 * @property OptimizelyExperiment $OptimizelyExperiment
 */
class OptimizelyProject extends OptimizelyAppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'name' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
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
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'OptimizelyExperiment' => array(
			'className' => 'OptimizelyExperiment',
			'foreignKey' => 'optimizely_project_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);


	/**
	* List of fields to search for using quick search
	*/
	public $searchFields = array('OptimizelyProject.id','OptimizelyProject.name');

	/**
	* List of fields that can be updated via ajax.
	*/
	public $ajaxFields = array();

	public function cacheProjects() {
		$this->loadOptimizely();
		$projects = $this->Optimizely->listProjects();
		$retval = 0;
		foreach ($projects as $project) {
			$save_data = $project;
			$this->clear();
			if ($this->save($save_data)){
				$retval++;
			}
		}
		return $retval;
	}
}
