<?php
App::uses('OptimizelyProjectsController', 'Optimizely.Controller');
App::uses('BaseTest', 'Test/Case');

/**
 * OptimizelyProjectsController Test Case
 *
 */
class OptimizelyProjectsControllerTest extends BaseTest {

/**
 * Additional Fixtures
 *
 * @var array
 */
	public $addFixtures = array(
		'plugin.optimizely.optimizely_project',
		'plugin.optimizely.optimizely_experiment',
		'plugin.optimizely.location',
		'plugin.optimizely.user',
		'plugin.optimizely.corp',
		'plugin.optimizely.content',
		'plugin.optimizely.tag',
		'plugin.optimizely.content_tag',
		'plugin.optimizely.product',
		'plugin.optimizely.products_content_join',
		'plugin.optimizely.products_user',
		'plugin.optimizely.content_location',
		'plugin.optimizely.content_user',
		'plugin.optimizely.corps_user',
		'plugin.optimizely.preview',
		'plugin.optimizely.call_source',
		'plugin.optimizely.hour',
		'plugin.optimizely.staff',
		'plugin.optimizely.review',
		'plugin.optimizely.zip',
		'plugin.optimizely.survey_caller',
		'plugin.optimizely.survey_call',
		'plugin.optimizely.survey_admin_note',
		'plugin.optimizely.note',
		'plugin.optimizely.import_status',
		'plugin.optimizely.location_user'
	);

/**
 * testAdminIndex method
 *
 * @return void
 */
	public function testAdminIndex() {
	}

/**
 * testAdminView method
 *
 * @return void
 */
	public function testAdminView() {
	}

/**
 * testAdminEdit method
 *
 * @return void
 */
	public function testAdminEdit() {
	}

/**
 * testAdminDelete method
 *
 * @return void
 */
	public function testAdminDelete() {
	}

}
