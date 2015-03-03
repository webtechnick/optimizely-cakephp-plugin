<?php
App::uses('OptimizelyAppController', 'Optimizely.Controller');
/**
 * OptimizelyProjects Controller
 *
 * @property OptimizelyProject $OptimizelyProject
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class OptimizelyProjectsController extends OptimizelyAppController {

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
			$filter = $this->request->data['OptimizelyProject']['filter'];
		}
		$conditions = $this->OptimizelyProject->generateFilterConditions($filter);
		$this->set('optimizelyProjects',$this->paginate('OptimizelyProject',$conditions));
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
		if (!$this->OptimizelyProject->exists($id)) {
			throw new NotFoundException(__('Invalid optimizely project'));
		}
		$options = array('conditions' => array('OptimizelyProject.' . $this->OptimizelyProject->primaryKey => $id));
		$this->set('optimizelyProject', $this->OptimizelyProject->find('first', $options));
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
			if ($this->OptimizelyProject->save($this->request->data)) {
				$this->goodFlash(__('The optimizely project has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->badFlash(__('The optimizely project could not be saved. Please, try again.'));
			}
		}

		if($id && empty($this->request->data)){
			$this->request->data = $this->OptimizelyProject->findById($id);
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
		$this->OptimizelyProject->id = $id;
		if (!$this->OptimizelyProject->exists()) {
			throw new NotFoundException(__('Invalid optimizely project'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->OptimizelyProject->delete()) {
			$this->goodFlash(__('Optimizely project deleted'));
		} else {
			$this->badFlash(__('Optimizely project was not deleted'));
		}

		$this->redirect(array('action' => 'index'));
	}

	public function admin_cache() {
		if ($this->OptimizelyProject->cacheProjects()) {
			$this->goodFlash('Projects cached.');
		} else {
			$this->badFlash('Error caching projects');
		}
		return $this->redirect(array('array' => 'index'));
	}
}
