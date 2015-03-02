<?php
class OptimizelyShell extends Shell {
	public $uses = array(
		'Optimizely.OptimizelyProject',
		'Optimizely.OptimizelyExperiment',
	);

	public function main(){
		$this->out("Optimizely Shell");
		$this->hr();
		$this->help();
	}

	public function help(){
		$this->out("Optimizely Help");
		$this->out(" cake optimizely.optimizely cache         Cache Projects and Experiments.");
	}

	public function cache() {
		$this->out('Caching Projects.');
		$this->OptimizelyProject->cacheProjects();
		$projects = $this->OptimizelyProject->find('all', array(
			'fields' => array('OptimizelyProject.id')
		));
		$this->out('Caching Experiments');
		foreach ($projects as $project) {
			$this->OptimizelyExperiment->cacheExperiments($project['OptimizelyProject']['id']);
		}
		$this->out('Finished.');
	}
}