<?php

/**
 * Main plugin file.
 *
 * @package     WCSlack
 * @author      Kerkness
 * @license     GNU
 *
 * @wordpress-plugin
 * Plugin Name: Integrator for Slack
 * Plugin URI: https://kerkness.ca/wc-slack
 * Description: Integrator for Slack sends messages from Wordpress and Woocommerce actions or custom events.
 * Version:     1.0.0
 * Requires at least: 5.4
 * Tested up to: 5.8
 * Requires PHP: 7.2
 * Author:      Kerkness
 * Author URI:  https://kerkness.ca
 * Text Domain: wc-slack
 * Domain Path: /languages
 * License: GPL2+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html 
 */


//  Exit if accessed directly.
defined('ABSPATH') || exit;

// Include autoloader if plugin isn't running as a dependency
if (!class_exists('WCSlack\WCSlack')) {
    require_once( __DIR__ . '/lib/autoload.php');
}

use WCSlack\WCSlack;


/**
 * Gets this plugin's absolute directory path.
 *
 */
function _get_wc_slack_plugin_directory() {
	return __DIR__;
}

/**
 * Gets this plugin's URL.
 */
function _get_wc_slack_plugin_url() {
	static $plugin_url;

	if ( empty( $plugin_url ) ) {
		$plugin_url = plugins_url( null, __FILE__ );
	}

	return $plugin_url;
}

/**
 * Get plugin base name
 */
if(!function_exists('_get_wc_slack_basename')) {
	function _get_wc_slack_basename() {
		return plugin_basename( __FILE__ );
	}
}

/**
 * Initalize the plugin
 */
WCSlack::init();

// Post to slack
if (!function_exists('wc_slack_message')) {
	function wc_slack_message($message, $attachements = null, $channel = '' ) {
		WCSlack::message($message, $attachements, $channel);
	}
}