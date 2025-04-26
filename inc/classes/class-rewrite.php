<?php
/**
 * Rewrite class.
 *
 * @package all-things-modal
 */

namespace All_Things_Modal\Features\Inc;

use All_Things_Modal\Features\Inc\Traits\Singleton;

/**
 * Class Rewrite
 */
class Rewrite {

	use Singleton;

	/**
	 * Construct method.
	 */
	protected function __construct() {

		$this->setup_hooks();

	}

	/**
	 * To setup action/filter.
	 *
	 * @return void
	 */
	protected function setup_hooks() {}
}
