<?php
/**
 * Plugin Name: All Things Modal
 * Description: All things modal you will ever need.
 * Plugin URI:  https://souptik.dev
 * Author:      Souptik Datta
 * Author URI:  https://profiles.wordpress.org/souptik/
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Version:     1.0
 * Text Domain: all-things-modal
 * Domain Path: /languages
 * @package all-things-modal
 */

define( 'ALL_THINGS_MODAL_FEATURES_PATH', untrailingslashit( plugin_dir_path( __FILE__ ) ) );
define( 'ALL_THINGS_MODAL_FEATURES_URL', untrailingslashit( plugin_dir_url( __FILE__ ) ) );

// phpcs:disable WordPressVIPMinimum.Files.IncludingFile.UsingCustomConstant
require_once ALL_THINGS_MODAL_FEATURES_PATH . '/inc/helpers/autoloader.php';
require_once ALL_THINGS_MODAL_FEATURES_PATH . '/inc/helpers/custom-functions.php';
// phpcs:enable WordPressVIPMinimum.Files.IncludingFile.UsingCustomConstant

/**
 * To load plugin manifest class.
 *
 * @return void
 */
function all_things_modal_features_plugin_loader() {
	\All_Things_Modal\Features\Inc\Plugin::get_instance();
}

all_things_modal_features_plugin_loader();
