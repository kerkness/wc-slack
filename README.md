# WooSlack

Basic slack integration for WooCommerce

# Usage

- Setup an incoming web hook for slack @see https://slack.com/intl/en-ca/help/articles/115005265063-Incoming-webhooks-for-Slack
- Install plugin
- Add your unique slack hook and default channel name in plugin settings
- Plugin posts updates on *Registration*, *Login*, *Account Detail Updates*, *Account Address Updates*.
- More to come.

# functions

Post your own messages to slack.

*Simple Message*
```
wooslack_post("Hello World!");
```

*Advanced Message*
```
$post = get_post($id);

wooslack_post("Post Update Event", [
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