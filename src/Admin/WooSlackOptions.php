<?php

namespace WooSlack\Admin;

/**
 * WooSlack Admin Options
 * Create admin page and handle option updates
 */
class WooSlackOptions
{
    /**
     * Initalize the plugin
     */
    public static function init()
    {
        $instance = new WooSlackOptions();

        register_activation_hook( _get_wooslack_basename(), [$instance, 'wooslack_activation_hook'] );

        add_action('init', [$instance, 'wooslack_register_settings']);
        add_action('admin_menu', [$instance, 'wooslack_admin_settings_menu']);
        add_filter('plugin_action_links_' . _get_wooslack_basename(), [$instance, 'wooslack_settings_link'], 10, 1);
        add_filter('plugin_row_meta', [$instance, 'plugin_row_meta'], 10, 2);

    }

    /**
     * Plugin Activation Hook
     */
    public function wooslack_activation_hook()
    {
        register_uninstall_hook(_get_wooslack_basename(), 'wooslack_deactivation_hook' );
    }

    /**
     * Plugin deactivation hook
     */
    public function wooslack_deactivation_hook()
    {
        delete_option( 'wooslack_slack_post_hook' );
        delete_site_option('wooslack_slack_post_hook');
        delete_option( 'wooslack_slack_default_channel' );
        delete_site_option('wooslack_slack_default_channel');
    }


    /**
     * Add a settings link to the plugin listing
     */
    public function wooslack_settings_link($links)
    {
        // Build and escape the URL.
        $url = esc_url(add_query_arg(
            'page',
            'wooslack-options-page',
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
        if (strpos($file, 'wooslack.php') !== false) {
            $new_links = [
                '<a href="https://github.com/kerkness/wooslack" target="_blank">GitHub</a>',
                '<a href="https://github.com/kerkness/wooslack/issues" target="_blank">Support</a>',
            ];

            $links = array_merge($links, $new_links);
        }

        return $links;
    }

    /**
     * Register Wordpress Options
     */
    public function wooslack_register_settings()
    {
        register_setting(
            'wooslack_settings',
            'wooslack_slack_post_hook',
            array(
                'type'         => 'string',
                'show_in_rest' => false,
                'default'      => '',
            )
        );
        register_setting(
            'wooslack_settings',
            'wooslack_slack_default_channel',
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
    public function wooslack_admin_settings_menu()
    {
        add_options_page('WooSlack', 'WooSlack', 'manage_options', 'wooslack-options-page', [$this, 'wooslack_options_page']);
    }

    /**
     * Render Options Page
     */
    public function wooslack_options_page()
    {
?>
        <div class="wrap">
            <h1><?php echo __('WooSlack Settings', 'wooslack') ?></h1>

            <form method="post" action="options.php">
                <?php settings_fields('wooslack_settings'); ?>
                <?php do_settings_sections('wooslack_settings'); ?>
                <table class="form-table">
                    <tr valign="top">
                        <th scope="row"><?php echo __('Slack Hook', 'wooslack') ?></th>
                        <td>
                        https://hooks.slack.com/services    
                        <input type="text" name="wooslack_slack_post_hook" value="<?php echo esc_attr(get_option('wooslack_slack_post_hook')); ?>" /></td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><?php echo __('Default Channel', 'wooslack') ?></th>
                        <td>
                            <input type="text" name="wooslack_slack_default_channel" value="<?php echo esc_attr(get_option('wooslack_slack_default_channel')); ?>" /><br/>
                            * Note you have to configure your slack webhook to have permissions for multiple channels.
                        </td>
                    </tr>

                </table>

                <?php submit_button(); ?>

            </form>
        </div>
<?php
    }
}
