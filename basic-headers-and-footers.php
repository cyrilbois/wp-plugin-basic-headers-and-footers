<?php
/**
 * Plugin Name: Basic Headers And Footers
 * Plugin URI: https://github.com/cyrilbois/wp-plugin-basic-headers-and-footers
 * Description: Allows you to insert script or CSS in the header or footer.
 * Version: 1.0.0
 * Author: Cyril Bois
 * Author URI: https://github.com/cyrilbois
 * Text Domain: basic-headers-and-footers
 * Domain Path:  languages
 * License: GPLv3
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 */
 
// Security: If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Register options
add_action('admin_init', 'adminInit');

// Add submenu
add_action('admin_menu', 'adminMenu');

// Add code to header
add_action('wp_head', 'injectHeader');

// Add code to footer
add_action('wp_footer', 'injectFooter');

function adminInit() {
	register_setting('basic-headers-and-footers', 'bhaf_header');
	register_setting('basic-headers-and-footers', 'bhaf_footer');
}	

function adminMenu() {
	add_submenu_page( 'options-general.php', 
		'Basic headers and footers', 
		'Basic headers and footers', 
		'manage_options', 
		'basic-headers-and-footers', 
		'adminPanel'
	);
}

function adminPanel() {
	// check user capabilities
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	// Save settings
	if (isset($_REQUEST['submit'])) {
		if (wp_verify_nonce($_REQUEST['bhaf_nonce'], 'basic-headers-and-footers')) {
			update_option('bhaf_header', stripslashes_deep($_REQUEST['bhaf_header']));
			update_option('bhaf_footer', stripslashes_deep($_REQUEST['bhaf_footer']));
		}
	}
	include_once( plugin_dir_path( __FILE__ ) . '/views/panel.php');
}

function injectHeader() {
	inject('bhaf_header');
}

function injectFooter() {
	inject('bhaf_footer');
}

function inject($section) {
	// Does not send data in some cases
	if (is_admin() || is_feed() || is_robots() || is_trackback()) {
		return;
	}
	// Global header / footer
	$data = get_option($section);
	if (!empty($data)) {
		echo $data;
	}
}

?>