<?php

namespace WCSlack\Admin;

use Kerkness\KoreWP\KoreWP;
use Kerkness\KoreWP\Template;

/**
 * WCSlack Admin Options
 * Create admin page and handle option updates
 */
class WCSlackOptions
{

    public $actions = [];

    /**
     * Initalize the plugin
     */
    public static function init()
    {
        $instance = new WCSlackOptions();

        register_activation_hook( wc_slack_plugin_basename(), [$instance, 'wc_slack_activation_hook'] );

        add_action('init', [$instance, 'wc_slack_register_settings']);
        add_action('admin_menu', [$instance, 'wc_slack_admin_settings_menu']);
        add_filter('plugin_action_links_' . wc_slack_plugin_basename(), [$instance, 'wc_slack_settings_link'], 10, 1);
        add_filter('plugin_row_meta', [$instance, 'plugin_row_meta'], 10, 2);

    }

    /**
     * Plugin Activation Hook
     */
    public function wc_slack_activation_hook()
    {
        register_uninstall_hook(wc_slack_plugin_basename(), [$this, 'wc_slack_deactivation_hook'] );
    }

    /**
     * Plugin deactivation hook
     */
    public function wc_slack_deactivation_hook()
    {
        delete_option( 'wc_slack_post_hook' );
        delete_site_option('wc_slack_post_hook');
        delete_option( 'wc_slack_default_channel' );
        delete_site_option('wc_slack_default_channel');
    }


    /**
     * Add a settings link to the plugin listing
     */
    public function wc_slack_settings_link($links)
    {
        // Build and escape the URL.
        $url = esc_url(add_query_arg(
            'page',
            'wc-slack-options-page',
            get_admin_url() . 'admin.php'
        ));
        // Create the link.
        $settings_link = "<a href='$url'>" . __('Settings') . '</a>';
        // Adds the link to the end of the array.
        array_push(
            $links,
            $settings_link
        );
        return $links;
    }

    /**
     * Add description links to plugin description
     */
    public function plugin_row_meta($links, $file)
    {
        if (strpos($file, 'wc-slack.php') !== false) {
            $new_links = [
                '<a href="https://github.com/kerkness/wc-slack" target="_blank">GitHub</a>',
                '<a href="https://github.com/kerkness/wc-slack/issues" target="_blank">Support</a>',
            ];

            $links = array_merge($links, $new_links);
        }

        return $links;
    }

    /**
     * Register Wordpress Options
     */
    public function wc_slack_register_settings()
    {
        register_setting(
            'wc_slack_settings',
            'wc_slack_post_hook',
            array(
                'type'         => 'string',
                'show_in_rest' => false,
                'default'      => '',
            )
        );
        register_setting(
            'wc_slack_settings',
            'wc_slack_default_channel',
            array(
                'type'         => 'string',
                'show_in_rest' => false,
                'default'      => '',
            )
        );
    }

    /**
     * Add Options Page to Dashboard
     */
    public function wc_slack_admin_settings_menu()
    {
        add_options_page('WCSlack', 'WCSlack', 'manage_options', 'wc-slack-options-page', [$this, 'wc_slack_options_page']);
    }

    /**
     * Render Options Page
     */
    public function wc_slack_options_page()
    {
        // $plugin_name = reset(explode('/', str_replace(WP_PLUGIN_DIR . '/', '', __DIR__)));

        // echo $plugin_name;

        // echo plugins_url( $plugin_name . '/images/wordpress.png' );

        echo Template::render('admin-options');

    }
}
