<?php
App::uses('OptimizelyProject', 'Optimizely.Model');
App::uses('BaseTest', 'Test/Case');

/**
 * OptimizelyProject Test Case
 *
 */
class OptimizelyProjectTest extends BaseTest {

/**
 * Additional Fixtures
 *
 * @var array
 */
	public $addFixtures = array(
		'plugin.optimizely.optimizely_project',
		'plugin.optimizely.optimizely_experiment'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->OptimizelyProject = ClassRegistry::init('Optimizely.OptimizelyProject');
	}

	public function test_cacheProjects() {
		$results = $this->OptimizelyProject->cacheProjects();
		$this->assertNotEqual(0, $results);
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->OptimizelyProject);

		parent::tearDown();
	}

}
