<?php
App::uses('OptimizelyExperiment', 'Optimizely.Model');
App::uses('BaseTest', 'Test/Case');

/**
 * OptimizelyExperiment Test Case
 *
 */
class OptimizelyExperimentTest extends BaseTest {

/**
 * Additional Fixtures
 *
 * @var array
 */
	public $addFixtures = array(
		'plugin.optimizely.optimizely_experiment'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->OptimizelyExperiment = ClassRegistry::init('Optimizely.OptimizelyExperiment');
	}

	public function test_cacheExperiments() {
		$result = $this->OptimizelyExperiment->cacheExperiments('571670074');
		$this->assertNotEqual(0, $result);
	}

	public function test_hasExperiment() {
		$result = $this->OptimizelyExperiment->hasExperiment('/hearing-aids');
		$this->assertTrue($result);

		$result = $this->OptimizelyExperiment->hasExperiment('/hearing-aids/NM-New-Mexico/Rio-Rancho/87124/8119025763-Worth-Hearing-Center-Rio-Rancho');
		$this->assertTrue($result);

		$result = $this->OptimizelyExperiment->hasExperiment('/');
		$this->assertTrue($result);
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->OptimizelyExperiment);

		parent::tearDown();
	}

}
