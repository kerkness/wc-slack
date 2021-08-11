<?php

namespace WooSlack;

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
        $instance = get_option('wooslack_slack_api_key') ? new WooSlack() : null;

        // Initialize Admin Page
        WooSlackOptions::init();

        return $instance;
    }

}
