<?php
/**
 * Register Modal post type.
 *
 * @package all-things-modal
 */

namespace All_Things_Modal\Features\Inc\Post_Types;

/**
 * Class Modal
 */
class Modal extends Base {

	/**
	 * Slug of post type.
	 *
	 * @var string
	 */
	const SLUG = 'atm-modal';

	/**
	 * Icon of post type.
	 *
	 * @var string
	 */
	const ICON = 'dashicons-id';

	/**
	 * Post type label for internal uses.
	 *
	 * @var string
	 */
	const LABEL = 'Modal';

	/**
	 * To get list of labels for post type.
	 *
	 * @return array
	 */
	public function get_labels() {

		return [
			'name'               => _x( 'Modals', 'post type general name', 'all-things-modal' ),
			'singular_name'      => _x( 'Modal', 'post type singular name', 'all-things-modal' ),
			'menu_name'          => _x( 'Modals', 'admin menu', 'all-things-modal' ),
			'name_admin_bar'     => _x( 'Modals', 'add new on admin bar', 'all-things-modal' ),
			'add_new'            => _x( 'Add New', 'post', 'all-things-modal' ),
			'add_new_item'       => __( 'Add New Modal', 'all-things-modal' ),
			'new_item'           => __( 'New Modal', 'all-things-modal' ),
			'edit_item'          => __( 'Edit Modal', 'all-things-modal' ),
			'view_item'          => __( 'View Modal', 'all-things-modal' ),
			'all_items'          => __( 'All Modals', 'all-things-modal' ),
			'search_items'       => __( 'Search Modal', 'all-things-modal' ),
			'parent_item_colon'  => __( 'Parent Modal:', 'all-things-modal' ),
			'not_found'          => __( 'No Modal found.', 'all-things-modal' ),
			'not_found_in_trash' => __( 'No Modal found in Trash.', 'all-things-modal' ),
		];

	}
}
