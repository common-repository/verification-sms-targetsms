=== Verification SMS with TargetSMS ===
Contributors: cajka
Tags: TargetSMS, SMS, Verify, verification, confirmed, WooCommerce
Requires at least: 4.7
Tested up to: 5.9
Stable tag: 1.5
Requires PHP: 5.2.4
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

The plugin allows you to implement verification via SMS for WooCommerce.

== Description ==

The TargetSMS Verify SMS allows you to implement verification by sending an SMS with a confirmation code to the specified phone number. SMS messages are sent via the service targetsms.ru. WooCommerce must also be installed.

= Privacy notices =

In the plugin, you can configure:

* enable/disable verification during registration and/or password recovery;
* specify the length of the confirmation code;
* specify the validity time of the confirmation code;
* specify text for SMS during registration and/or password recovery;

== Installation ==

1. Upload the entire `targetsms-verify-sms` folder to the `/wp-content/plugins/` directory.
1. Activate the plugin through the **Plugins** screen (**Plugins > Installed Plugins**).

== Screenshots ==
1. Settings for targetsms.ru in WooCommerce -> Verification SMS with TargetSMS -> TargetSMS.
2. Verification and SMS settings in WooCommerce -> TargetSMS verify SMS -> Verification and SMS.
3. The field for entering the phone number in the registration form.
4. The field for entering the phone number in the password recovery form.
5. PopUp to enter the confirmation code.

== Frequently Asked Questions ==

= SMS with the code is sent only via servers targetsms.ru ? =

Yes. You must have an account registered in targetsms.ru.

= Is the plugin free? =

Yes. You only pay for the services of the service targetsms.ru, through which SMS messages are sent.

= Is there a test mode? =

Service targetsms.ru enables test mode. To test the plugin, specify in the plugin settings the login and password of your account in targetsms.ru . In the "signature" field, specify targettele.

= Where is the phone number input field displayed? =

The field is displayed for registration and password recovery forms. You can also use shortcodes [targetvr_verification_lostpass] or [targetvr_verification_reg] to display the field.

= Does the WooCommerce plugin have to be installed? =

Yes. It won't work without WooCommerce.

= Is the phone number saved during registration? =

Yes, the phone number is saved in the standard WooCommerce field in the customer profile.

= Is there a user verification by phone number? =

Yes. During registration and/or password recovery, it is checked whether there is a user with the specified phone number.

== Changelog ==

= 1.5 =
* Added user verification by phone number.
* Shortcuts added.
* The plugin settings interface has been changed.

= 1.0 =
* Added SMS verification function for password recovery form.

= 0.5 =
Initial release.

== Upgrade Notice ==
Make a backup of your site.