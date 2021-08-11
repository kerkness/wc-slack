<?php

/**
 * Main plugin file.
 *
 * @package     WooSlack
 * @author      Kerkness
 * @license     GNU
 *
 * @wordpress-plugin
 * Plugin Name: WooSlack
 * Plugin URI: https://kerkness.ca/wooslack
 * Description: Post messages to slack from woocommerce customer events.
 * Version:     1.0.0
 * Requires at least: 5.4
 * Tested up to: 5.8
 * Requires PHP: 7.2
 * Author:      Kerkness
 * Author URI:  https://kerkness.ca
 * Text Domain: wooslack
 * Domain Path: /languages
 * License: GPL2+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html 
 */


//  Exit if accessed directly.
defined('ABSPATH') || exit;

// Include autoloader if plugin isn't running as a dependency
if (!class_exists('WooSlack\WooSlack')) {
    require_once( __DIR__ . '/lib/autoload.php');
}

use WooSlack\WooSlack;


/**
 * Gets this plugin's absolute directory path.
 *
 */
function _get_wooslack_plugin_directory() {
	return __DIR__;
}

/**
 * Gets this plugin's URL.
 */
function _get_wooslack_plugin_url() {
	static $plugin_url;

	if ( empty( $plugin_url ) ) {
		$plugin_url = plugins_url( null, __FILE__ );
	}

	return $plugin_url;
}

/**
 * Get plugin base name
 */
if(!function_exists('_get_wooslack_basename')) {
	function _get_wooslack_basename() {
		return plugin_basename( __FILE__ );
	}
}

/**
 * Initalize the plugin
 */
WooSlack::init();

// Post to slack
if (!function_exists('wooslack_post')) {
	function wooslack_post($message, $channel = '', $attachements = null) {
		WooSlack::post($message, $channel, $attachements);
	}
}