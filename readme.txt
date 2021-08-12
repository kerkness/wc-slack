=== WooSlack ===
Contributors: Kerkness
Tags: hubspot, crm, woocommerce, customers
Requires at least: 5.4
Tested up to: 5.8
Stable tag: 1.0.0
Requires PHP: 7.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

WooSlack posts WooCommerce customer events to a Slack channel. Register, Login, Update Details and Update Address currently supported. More to come.

== Description ==

WooSlack posts WooCommerce customer events to a Slack channel. Register, Login, Update Details and Update Address currently supported. More events will be added as required.

To set up this plugin you will need to create a Slack APP and an Incoming Slack WebHook. See: [Incoming Webhooks for Slack](https://slack.com/intl/en-ca/help/articles/115005265063-Incoming-webhooks-for-Slack)

=== Post your own messages ===

Add hooks to your own `functions.php` file and send messages to Slack with `wooslack_message("Hello World")`.

=== Post interactive messages ===

Post interactive messages with detailed context with `wooslack_message($message, $attachements, $channel)`

- [View the Github page for examples](https://github.com/kerkness/wooslack)
- [Full slack documentation](https://api.slack.com/messaging/composing/layouts#attachments)

== Frequently Asked Questions ==

= Can the plugin post to multiple slack organizations =

No. The plugin accepts only one Incoming Webhook from Slack and will be limited to the channels available to that webhook.

= Can the plugin post to multiple slack channels =

That depends on your Slack account. The plugin accepts only one Incoming Webhook from Slack and will be limted to the channels available to that webhook.

== Screenshots ==

1. Sample message of a user login event.
2. Sample custom messages from a wp_insert_post action

== Changelog ==

= 1.0.0 =
* Initial release.
* Supports messages on Customer creation and update events.

== Upgrade Notice ==

= 1.0.0 =
Initial release.
