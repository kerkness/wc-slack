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
 * Version:     1.0.3
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

// PHP 8 Support
// Plugin uses some php 8 methods.  Include this file for reverse compatibility with php 7
require_once __DIR__ . '/lib/kerkness/kore-wp/php_8/functions.php';


/**
 * Get plugin base name
 * @return string
 */
if(!function_exists('wc_slack_plugin_basename')) {
	function wc_slack_plugin_basename() {
		return plugin_basename( __FILE__ );
	}
}

/**
 * Initalize the plugin
 */
\WCSlack\WCSlack::init();

// Post to slack
if (!function_exists('wc_slack_message')) {
	function wc_slack_message($message, $attachements = null, $channel = '' ) {
		\WCSlack\WCSlack::message($message, $attachements, $channel);
	}
}