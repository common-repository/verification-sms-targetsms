<?php

class TargetvrLang {
	private static function adminLangPrases($langCode){
		$langStrings = array(
			'enabled'                           => __('Enabled', TARGETVR_TEXT_DOMAIN),
			'confirmation_and_sms'              => __('Confirmation & SMS', TARGETVR_TEXT_DOMAIN),
			'if_this_option_is_enabled'         => __('If this option is enabled, the verification field will not be displayed by default. Use shortcodes', TARGETVR_TEXT_DOMAIN),
			'targetsms_verify_sms_work_correctly' => __('For the TargetSMS Verify SMS plugin to work correctly, WooCommerce is required.', TARGETVR_TEXT_DOMAIN),
			'how_many_seconds_code_valid'       => __('How many seconds is the code valid', TARGETVR_TEXT_DOMAIN),
			'how_many_symbols_should_be_code'   => __('How many symbols should be in the code', TARGETVR_TEXT_DOMAIN),
			'login_for_targetsms'               => __('Login for TargetSMS', TARGETVR_TEXT_DOMAIN),
			'or'                                => __('or', TARGETVR_TEXT_DOMAIN),
			'password_for_targetsms'            => __('Password for TargetSMS', TARGETVR_TEXT_DOMAIN),
			'send_registration_code'            => __('Send the registration code', TARGETVR_TEXT_DOMAIN),
			'send_password_recovery_code'       => __('Send the password recovery code', TARGETVR_TEXT_DOMAIN),
			'sender_signature'                  => __('Sender\'s signature', TARGETVR_TEXT_DOMAIN),
			'section_targetsms_description'     => __('Here the data is specified from your account in the TargetSMS service.', TARGETVR_TEXT_DOMAIN),
			'section_verify_description'        => __('Here you need to specify the settings for displaying the verification field by phone number and text of message.', TARGETVR_TEXT_DOMAIN),
			'shortcode_lostpass'                => __('[targetvr_verification_lostpass] ', TARGETVR_TEXT_DOMAIN),
			'shortcode_reg'                     => __('[targetvr_verification_reg] ', TARGETVR_TEXT_DOMAIN),
			'settings_verify_sms_targetsms'     => __('Settings of Verification SMS with TargetSMS', TARGETVR_TEXT_DOMAIN),
			'settings_targetsms'                => __('Settings for TargetSMS', TARGETVR_TEXT_DOMAIN),
			'settings_verify_and_sms'           => __('Settings of verification and SMS', TARGETVR_TEXT_DOMAIN),
			'text_sms_during_registration'      => __('Text for SMS during registration', TARGETVR_TEXT_DOMAIN),
			'text_sms_during_password_recovery' => __('Text for SMS during parameter recovery', TARGETVR_TEXT_DOMAIN),
			'to_display_field_phone_shortcode'  => __('Enable this option if you want to use the shortcode to display the sms verification field.', TARGETVR_TEXT_DOMAIN),
			'use_use_shortcode'                 => __('Use shortcode to output the verification field by sms', TARGETVR_TEXT_DOMAIN),
			'you_must_specify_code'             => __('You must specify the', TARGETVR_TEXT_DOMAIN),
			'It_will_be_replaced_with_code'     => __('tag in the text. It will be replaced with a code.', TARGETVR_TEXT_DOMAIN),
		);
		
		
		if (isset($langStrings[$langCode]))
			$langPrase = $langStrings[$langCode];
		else
			$langPrase = __('Language error phrase not found.', TARGETVR_TEXT_DOMAIN);
		
		return $langPrase;
	}

	public static function getAdminPrase($langCode){
		return self::adminLangPrases($langCode);
	}


	private static function frontendLangPrases($langCode){
		$langStrings = array(
			'close'                                   => __('Close', TARGETVR_TEXT_DOMAIN),
			'code_has_been_resety'                    => __('The code has been reset!', TARGETVR_TEXT_DOMAIN),
			'code_is_incorrectly'                     => __('The code is specified incorrectly!', TARGETVR_TEXT_DOMAIN),
			'confirm_code'                            => __('Confirm', TARGETVR_TEXT_DOMAIN),
			'code_was_confirmed_earlier'              => __('The code was confirmed earlier!', TARGETVR_TEXT_DOMAIN),
			'code_is_not_confirmed'                   => __('The code is not confirmed!', TARGETVR_TEXT_DOMAIN),
			'confirmation_code'                       => __('Confirmation code', TARGETVR_TEXT_DOMAIN),
			'command_is_incorrect'                    => __('The command is incorrect!', TARGETVR_TEXT_DOMAIN),
			'default_message_sms'                     => __('Your authentication code {код}', TARGETVR_TEXT_DOMAIN),
			'error'                                   => __('An error has occurred!', TARGETVR_TEXT_DOMAIN),
			'error_code'                              => __('Code number not specified!', TARGETVR_TEXT_DOMAIN),
			'error_phone'                             => __('Phone number not specified!', TARGETVR_TEXT_DOMAIN),
			'error_plugin_settings_message_1'         => __('The message with the code to the number', TARGETVR_TEXT_DOMAIN),
			'error_plugin_no_settings'                => __('SMS with the code could not be sent! Contact the administration of site.', TARGETVR_TEXT_DOMAIN),
			'good'                                    => __('Good!', TARGETVR_TEXT_DOMAIN),
			'sending'                                 => __('Sending...', TARGETVR_TEXT_DOMAIN),
			'send_code'                               => __('Send code', TARGETVR_TEXT_DOMAIN),
			'send_code_again'                         => __('Send the code again', TARGETVR_TEXT_DOMAIN),
			'sent_confirmation_code'                  => __('sent a confirmation code.', TARGETVR_TEXT_DOMAIN),
			'you_can_order_sms_with_code_again'       => __('You can order an SMS with the code again via', TARGETVR_TEXT_DOMAIN),
			'seconds'                                 => __('seconds', TARGETVR_TEXT_DOMAIN),
			'to_the_number'                           => __('To the number', TARGETVR_TEXT_DOMAIN),
			'user_specified_phone_not_foun'           => __('The user with the specified phone number was not found!', TARGETVR_TEXT_DOMAIN),
			'user_specified_phone_already_registered' => __('The user with the specified phone number is already registered!', TARGETVR_TEXT_DOMAIN),
			'will_be_sent_sms_code'                   => __('An SMS with the code will be sent to the specified phone number.', TARGETVR_TEXT_DOMAIN),
			'your_phone'                              => __('Your phone', TARGETVR_TEXT_DOMAIN),
		);
		
		
		
		if (isset($langStrings[$langCode]))
			$langPrase = $langStrings[$langCode];
		else
			$langPrase = __('Language error phrase not found.', TARGETVR_TEXT_DOMAIN);
		
		return $langPrase;
	}
	
	public static function getFrontendPrase($langCode){
		return self::frontendLangPrases($langCode);
	}
}

