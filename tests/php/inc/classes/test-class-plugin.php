<?php
/**
 * Plugin manifest class.
 *
 * @package all-things-modal
 */

namespace All_Things_Modal\Features\Tests\Inc;

use All_Things_Modal\Features\Tests\TestCase;

/**
 * Class Test_Plugin
 *
 * @since 1.0.0
 */
class Test_Plugin extends TestCase {

	/**
	 * Test that the plugin class exists.
	 *
	 * @since 1.0.0
	 */
	public function test_plugin_class_exists() {
		$this->assertTrue( class_exists( 'All_Things_Modal\Features\Inc\Plugin' ) );
	}
}
