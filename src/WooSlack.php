<?php

namespace WooSlack;

use WP_User;
use WooSlack\Admin\WooSlackOptions;

/**
 * WooSlack 
 * Handle updating contact details in HubSpot
 */
class WooSlack
{
    /**
     * Initialize Plugin 
     */
    public static function init()
    {
        // If a hubspot api key has been added then register actions
        $instance = get_option('wooslack_slack_post_hook') ? new WooSlack() : null;

        if ($instance) {

            // Send some auto logging..
            add_action('user_register', [$instance, 'user_register_action'], 10, 1);
            add_action('wp_login', [$instance, 'wp_login_action'], 10, 2);
            add_action('woocommerce_save_account_details', [$instance, 'action_woocommerce_save_account_details'], 10, 1);
            add_action('woocommerce_customer_save_address', [$instance, 'action_woocommerce_customer_save_address'], 10, 2);

        }

        // Initialize Admin Page
        WooSlackOptions::init();

        return $instance;
    }

    /**
     * User Registered
     */
    public function user_register_action($user_id)
    {
        $message = "New Registration: " . get_bloginfo( 'name' );

        $user = get_user_by('ID', $user_id);

        $attachments = [
            'color' => '#28a745',
            'title' => 'Email: ' . $user->user_email,
            'text' => "Username: " . $user->user_login,
        ];

        WooSlack::message($message, $attachments);
    }

    /**
     * User logged in
     */
    public function wp_login_action($user_login, WP_User $user)
    {
        $message = "User Logged In: " . get_bloginfo( 'name' );

        $attachments = [
            'color' => '#28a745',
            'title' => 'Email: ' . $user->user_email,
            'text' => "Username: " . $user_login,
        ];

        WooSlack::message($message, $attachments);
    }

    /**
     * User updated account details
     */
    public function action_woocommerce_save_account_details($user_id)
    {
        $message = "User Updated Account Details: " . get_bloginfo( 'name' );

        $user = get_user_by('ID', $user_id);

        $attachments = [
            'color' => '#28a745',
            'title' => 'Email: ' . $user->user_email,
            'text' => "Username: " . $user->user_login,
        ];

        WooSlack::message($message, $attachments);
    
    }

    /**
     * User updated address
     */
    public function action_woocommerce_customer_save_address($user_id, $load_address)
    {   
        $message = "User Updated Address: " . get_bloginfo( 'name' );

        $user = get_user_by('ID', $user_id);

        $attachments = [
            'color' => '#28a745',
            'title' => 'User: ' . $user->user_email .' : '.$user->user_login,
            'text' => "Address: " . $load_address,
        ];

        WooSlack::message($message, $attachments);

    }


    /**
     * Post a message to slack
     */
    public static function message($message, $attachments = null, $channel = '')
    {
        $use_channel = $channel ? $channel : get_option( 'wooslack_slack_default_channel' );

        $data = json_encode(array(
            "channel"=>  "#{$use_channel}",
            "text" =>  $message,
            "attachments" => [$attachments]
        ));

        // validate hook provided in options assuming instructions are not followed.
        $hook_option = str_replace('https://hooks.slack.com/services', '', get_option('wooslack_slack_post_hook'));

        // Start with slash
        $slack_hook = str_starts_with($hook_option, '/')
            ? 'https://hooks.slack.com/services' . $hook_option
            : 'https://hooks.slack.com/services/' . $hook_option;

        $response = wp_remote_request($slack_hook, [
            'method' => 'POST',
            'headers' => [
                'Content-Type: application/json',
                'Accepts: application/json'
            ],
            'body' => $data
        ]);    

        return $response;
    }

}
