<?php

/**
 * Main plugin file.
 *
 * @package     WooSlack
 * @author      Ryan Mayberry (@kerkness)
 * @license     GNU
 *
 * @wordpress-plugin
 * Plugin Name: WooSlack
 * Description: WooCommerce & Slack Integration
 * Version:     0.1
 * Author:      Ryan Mayberry (@kerkness)
 * Author URI:  https://kerkness.ca
 * Text Domain: wooslack
 * Domain Path: /languages
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
 * Initalize the plugin
 */
WooSlack::init();

