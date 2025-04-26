<?php
/**
 * Plugin manifest class.
 *
 * @package all-things-modal
 */

namespace All_Things_Modal\Features\Inc;

use \All_Things_Modal\Features\Inc\Traits\Singleton;
use \All_Things_Modal\Features\Inc\Post_Types\Modal;

/**
 * Class Plugin
 */
class Plugin {

	use Singleton;

	/**
	 * Construct method.
	 */
	protected function __construct() {

		// Load plugin classes.
		Assets::get_instance();
		$this->load_post_types();
		$this->load_taxonomies();
		Rewrite::get_instance();
		$this->load_plugin_configs();
		SEO::get_instance();
		Blocks::get_instance();
		add_filter( 'wp_kses_allowed_html', array( $this, 'kses_custom_allowed_html' ), 10, 2 );

	}

	/**
	 * Custom allowed HTML for `wp_kses_post`
	 *
	 * @param mixed[] $tags    Allowed HTML tags.
	 * @param string  $context Context name.
	 *
	 * @return mixed[]
	 */
	function kses_custom_allowed_html( array $tags = [], string $context = 'post' ): array {
		// Construct allowed HTML tags for `wp_kses_post` based on the passed context.
		if ( 'post' === $context ) {
			$tags = array_merge(
				$tags,
				[
					'tp-modal' => [
						'overlay-click-close' => true,
						'overlay-click-close' => true,
						'id'                  => true,
					],
					'tp-modal-close' => [
						'overlay-click-close' => true,
						'overlay-click-close' => true,
					],
					'tp-modal-content' => [
						'overlay-click-close' => true,
						'overlay-click-close' => true,
					],
					'atm-modal' => [
						'overlay-click-close' => true,
						'overlay-click-close' => true,
						'id'                  => true,
					],
					'atm-modal-trigger' => [
						'overlay-click-close' => true,
						'overlay-click-close' => true,
						'id'                  => true,
					],
				]
			);
		}

		return $tags;
	}

	/**
	 * Load Post Types.
	 */
	public function load_post_types() {

		// Load all post types.
		Modal::get_instance();

	}

	/**
	 * Load Taxonomies.
	 */
	public function load_taxonomies() {
	}

	/**
	 * Load Plugin Configs.
	 */
	public function load_plugin_configs() {

		// Load all plugin configs.
	}
}
