<?php
/**
 * TargetSMS Verification SMS Uninstall
 *
 * Uninstalling TargetSMS Verification SMS deletes options.
 *
 * @version 1.5
 */

defined( 'WP_UNINSTALL_PLUGIN' ) or exit;

$settings_names = array(
	'settings_targetsms',
	'settings_verify_and_sms'
);

if ($settings_names){
	foreach ($settings_names as $setting_name){
		delete_option($setting_name);
	}
}