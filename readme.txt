=== Integrate WordPress or WooCommerce with Slack ===

Plugin Name: Integrator For Slack
Plugin URI: https://kerkness.ca/wc-slack
Contributors: kerkness
Tags: hubspot, crm, woocommerce, customers
Requires at least: 5.4
Tested up to: 5.8
Stable tag: 1.0.1
Requires PHP: 7.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Integrator for Slack posts WooCommerce or Wordpress events to a Slack channel. Register, Login, Update Details and Update Address currently supported. More to come.

== Description ==

Integrator for Slack posts WooCommerce or Wordpress customer events to a Slack channel. Register, Login, Update Details and Update Address currently supported. More events will be added as required.

To set up this plugin you will need to create a Slack APP and an Incoming Slack WebHook. See: [Incoming Webhooks for Slack](https://slack.com/intl/en-ca/help/articles/115005265063-Incoming-webhooks-for-Slack)

=== Post your own messages ===

Add hooks to your own `functions.php` file and send messages to Slack with `wc_slack_message("Hello World")`.

=== Post interactive messages ===

Post interactive messages with detailed context with `wc_slack_message($message, $attachements, $channel)`

- [View the Github page for examples](https://github.com/kerkness/wc-slack)
- [Full slack documentation](https://api.slack.com/messaging/composing/layouts#attachments)

=== Coming Soon ===

Send a slack message from any WordPress hook.  We are working on a the ability to select configure a slack message from *ANY* hook/action in your site. 

== Frequently Asked Questions ==

= Can the plugin post to multiple slack organizations =

No. The plugin accepts only one Incoming Webhook from Slack and will be limited to the channels available to that webhook.

= Can the plugin post to multiple slack channels =

That depends on your Slack account. The plugin accepts only one Incoming Webhook from Slack and will be limted to the channels available to that webhook.

== Screenshots ==

1. Sample message of a user login event.
2. Sample custom messages from a wp_insert_post action

== Changelog ==

= 1.0.2 =
* re-factor prefix and removal of test methods
...

= 1.0.1 =
* Banner and Readme Updates

= 1.0.0 =
* Initial release.
* Supports messages on Customer creation and update events.

== Upgrade Notice ==

= 1.0.0 =
Initial release.
