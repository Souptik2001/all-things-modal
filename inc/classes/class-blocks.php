<?php
/**
 * Registers all custom gutenberg blocks.
 *
 * @package all-things-modal
 */

namespace All_Things_Modal\Features\Inc;

use All_Things_Modal\Features\Inc\Traits\Singleton;

/**
 * Class Blocks
 */
class Blocks {

	use Singleton;

	/**
	 * Construct method.
	 */
	protected function __construct() {
		$this->setup_hooks();

	}

	/**
	 * Setup hooks.
	 *
	 * @return void
	 */
	public function setup_hooks() {
		add_action( 'init', [ $this, 'register_blocks' ] );
	}

	/**
	 * Register all custom gutenberg blocks.
	 *
	 * @return void
	 */
	public function register_blocks() {
		// Register modal block.
		register_block_type(
			ALL_THINGS_MODAL_FEATURES_PATH . '/assets/build/blocks/modal/',
			[
				'render_callback' => [ $this, 'render_modal_block' ],
			]
		);

	}

	/**
	 * Render modal Block.
	 *
	 * @param array $attributes Block attributes.
	 * @return string Rendered HTML.
	 */
	public function render_modal_block( $attributes = [], $content = '' ) {
		// Return empty if required attributes are not set.
		if ( empty( $attributes['modalId'] ) || empty( $attributes['modalPostId'] ) ) {
			return '';
		}

		$post_id = $attributes['modalPostId'];
		$post = get_post( $post_id );

		if ( $post && 'atm-modal' === $post->post_type ) {
			$modal_content = apply_filters( 'the_content', $post->post_content );
		} else {
			return '';
		}

		// Enqueue the required assets.
		add_action(
			'wp_enqueue_scripts',
			function () {
				wp_enqueue_style( 'tp-modal' );
			},
			20
		);

		// Set the auto trigger and scroll trigger attributes.
		$attributes['autoTrigger']       = true === $attributes['autoTrigger'] ? 'yes' : 'no';
		$attributes['triggerOnScroll']   = true === $attributes['triggerOnScroll'] ? 'yes' : 'no';
		$attributes['triggerOnPageExit'] = true === $attributes['triggerOnPageExit'] ? 'yes' : 'no';

		return all_things_modal_features_template(
			'block-templates/modal',
			[
				'attributes' => $attributes,
				'modal_content' => $modal_content,
				'trigger_element' => $content,
			]
		);

	}
}
