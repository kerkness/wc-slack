# Integrator For Slack - WooCommerce/Wordpress and Slack Integration

Basic Slack integration for WooCommerce and Wordpress.

### Dependencies

Run `composer install`  to create the autoloader if installing from source.

### Usage

- Setup an incoming web hook for slack https://slack.com/intl/en-ca/help/articles/115005265063-Incoming-webhooks-for-Slack
- Install plugin
- Add your unique slack hook and default channel name in plugin settings
- Plugin posts updates on *Registration*, *Login*, *Account Detail Updates*, *Account Address Updates*.
- More to come.

### Functions

Post your own messages to slack.

*Simple Message*
```
wc_slack_message("Hello World!");
```

*Advanced Message*
@see https://api.slack.com/messaging/composing/layouts#attachments
```
$post = get_post($id);

wc_slack_message("Post Update Event", [
        'color' => '#28a745',
        'title' => $post->post_title,
        'text' => "Time Stamp: " . date('Y-m-d D h:i:s a (e)') . "\nPost ID: " . $post->ID ."\Status: " . $post->post_status,
        'actions' => [
            [
                "type" => "button", 
                "name" => "view-post", 
                "text" => "View", 
                "url" => get_permalink($post)
            ]
        ]
]);    
```
