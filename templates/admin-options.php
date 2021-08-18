<div class="wrap">
            <h1><?php echo __('WCSlack Settings', 'wc-slack') ?></h1>

            <form method="post" action="options.php">
                <?php settings_fields('wc_slack_settings'); ?>
                <?php do_settings_sections('wc_slack_settings'); ?>
                <table class="form-table">
                    <tr valign="top">
                        <th scope="row"><?php echo __('Slack Hook', 'wc-slack') ?></th>
                        <td>
                        https://hooks.slack.com/services<br/>    
                        <input type="text" name="wc_slack_post_hook" value="<?php echo esc_attr(get_option('wc_slack_post_hook')); ?>" /></td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><?php echo __('Default Channel', 'wc-slack') ?></th>
                        <td>
                            <input type="text" name="wc_slack_default_channel" value="<?php echo esc_attr(get_option('wc_slack_default_channel')); ?>" /><br/>
                            * Note you have to configure your slack webhook to have permissions for multiple channels.
                        </td>
                    </tr>

                </table>

                <?php submit_button(); ?>

            </form>
        </div>
