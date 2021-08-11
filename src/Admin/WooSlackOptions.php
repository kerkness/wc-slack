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

        add_action('init', [$instance, 'wooslack_register_settings']);
        add_action('admin_menu', [$instance, 'wooslack_admin_settings_menu']);

    }

    /**
     * Register Wordpress Options
     */
    public function wooslack_register_settings()
    {
        register_setting(
            'wooslack_settings',
            'wooslack_slack_api_key',
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
        add_options_page('WooSlack', 'WooSlack', 'manage_options', 'woohub-options-page', [$this, 'wooslack_options_page']);
    }

    /**
     * Render Options Page
     */
    public function wooslack_options_page()
    {
?>
        <div class="wrap">
            <h1><?php echo __('WooSlack Settings', 'woohub') ?></h1>

            <form method="post" action="options.php">
                <?php settings_fields('wooslack_settings'); ?>
                <?php do_settings_sections('wooslack_settings'); ?>
                <table class="form-table">
                    <tr valign="top">
                        <th scope="row"><?php echo __('Slack API Key', 'woohub') ?></th>
                        <td><input type="text" name="wooslack_slack_api_key" value="<?php echo esc_attr(get_option('wooslack_slack_api_key')); ?>" /></td>
                    </tr>

                </table>

                <?php submit_button(); ?>

            </form>
        </div>
<?php
    }
}
