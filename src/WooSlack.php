<?php

namespace WooSlack;

use WooSlack\Admin\WooSlackOptions;

/**
 * WooSlack 
 * Handle updating contact details in HubSpot
 */
class WooSlack
{
    public $default_channel = '';
    public $hook = '';

    /**
     * Initialize Plugin 
     */
    public static function init()
    {
        // If a hubspot api key has been added then register actions
        $instance = get_option('wooslack_slack_api_key') ? new WooSlack() : null;

        if ($instance) {

            // Send some auto logging..

        }

        // Initialize Admin Page
        WooSlackOptions::init();

        return $instance;
    }

    // TODO: move hook key to .env
    public static function post($message, $channel = '',  $attachments = null)
    {
        // $instance = new WooSlack();

        $use_channel = $channel ? $channel : get_option( 'wooslack_slack_default_channel' );

        $data = json_encode(array(
            "channel"=>  "#{$use_channel}",
            "text" =>  $message,
            "attachments" => [$attachments]
        ));

        $ch = curl_init("https://hooks.slack.com/services" . get_option('wooslack_slack_post_hook'));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }

}
