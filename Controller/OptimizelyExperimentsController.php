<?php
App::uses('OptimizelyAppController', 'Optimizely.Controller');
/**
 * OptimizelyExperiments Controller
 *
 * @property OptimizelyExperiment $OptimizelyExperiment
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class OptimizelyExperimentsController extends OptimizelyAppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index($filter = null) {
		if(!empty($this->request->data)){
			$filter = $this->request->data['OptimizelyExperiment']['filter'];
		}
		$conditions = $this->OptimizelyExperiment->generateFilterConditions($filter);
		$this->set('optimizelyExperiments',$this->paginate('OptimizelyExperiment',$conditions));
		$this->set('filter', $filter);
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->OptimizelyExperiment->exists($id)) {
			throw new NotFoundException(__('Invalid optimizely experiment'));
		}
		$options = array('conditions' => array('OptimizelyExperiment.' . $this->OptimizelyExperiment->primaryKey => $id));
		$this->set('optimizelyExperiment', $this->OptimizelyExperiment->find('first', $options));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!empty($this->request->data)) {
			if ($this->OptimizelyExperiment->save($this->request->data)) {
				$this->goodFlash(__('The optimizely experiment has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->badFlash(__('The optimizely experiment could not be saved. Please, try again.'));
			}
		}

		if($id && empty($this->request->data)){
			$this->request->data = $this->OptimizelyExperiment->findById($id);
			$this->set('id', $id);
		}

	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->OptimizelyExperiment->id = $id;
		if (!$this->OptimizelyExperiment->exists()) {
			throw new NotFoundException(__('Invalid optimizely experiment'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->OptimizelyExperiment->delete()) {
			$this->goodFlash(__('Optimizely experiment deleted'));
		} else {
			$this->badFlash(__('Optimizely experiment was not deleted'));
		}

		$this->redirect(array('action' => 'index'));
	}

	public function admin_cache($project_id = null) {
		if (!$project_id) {
			$this->badFlash('Project ID not specified.');
			return $this->redirect(array('array' => 'index'));
		}
		$result = $this->OptimizelyExperiment->cacheExperiments($project_id);
		if ($result) {
			$this->goodFlash('Experiments Cached.');
		} else {
			$this->badFlash('Error caching experiments');
		}
		return $this->redirect(array('action' => 'index'));
	}
}
