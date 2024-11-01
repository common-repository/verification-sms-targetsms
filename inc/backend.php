<?php


/**
  * Возвращает URL страницы настроек для плагина.
  *
  * @return (string)
*/

function targetvr_get_url_page_settings(){
	return '?page=verification-sms-targetsms/' . TARGETVR_FILE_PLUGIN_OPTIONS;
}

/**
  * Возвращает URL панели настроек для плагина.
  *
  * @param (string) $panel_key - ключ панели.
  *
  * @return (string) $url - URL панели с настройками.
*/

function targetvr_get_url_panel_settings($panel_key){
	$url = targetvr_get_url_page_settings() . '&panel=' . $panel_key;
	
	return $url;
}

/**
  * Возвращает массив с настройками
  *
  * @return (array) $settings - массив с настройками для плагина
*/

function targetvr_get_all_settings_plugin(){
	$settings = array(
		'section_targetsms' => array(
			'setting_name'  => 'settings_targetsms',
			'option_name'   => 'targetsms',
			'fields' => array(
				'login' => array(
					'field_name'    => 'targetvr_login',
					'field_type'    => 'text',
					'field_label'   => '<label for="targetvr_login">' . TargetvrLang::getAdminPrase('login_for_targetsms') . '</label>',
					'function_name' => 'targetvr_setting_field',
				),
				'password' => array(
					'field_name' => 'targetvr_password',
					'field_type'  => 'text',
					'field_label'   => '<label for="targetvr_password">' . TargetvrLang::getAdminPrase('password_for_targetsms') . '</label>',
					'function_name' => 'targetvr_setting_field',
				),
				'sender_signature' => array(
					'field_name'    => 'targetvr_sender_signature',
					'field_type'    => 'text',
					'field_label'   => '<label for="targetvr_sender_signature">' . TargetvrLang::getAdminPrase('sender_signature') . '</label>',
					'function_name' => 'targetvr_setting_field',
				),
				'code_length' => array(
					'field_name'    => 'targetvr_code_length',
					'field_type'    => 'text',
					'field_label'   => '<label for="targetvr_code_length">' . TargetvrLang::getAdminPrase('how_many_symbols_should_be_code') . '</label>',
					'function_name' => 'targetvr_setting_field',
				),
				'seconds_code_valid' => array(
					'field_name'    => 'targetvr_seconds_code_valid',
					'field_type'    => 'text',
					'field_label'   => '<label for="targetvr_seconds_code_valid">' . TargetvrLang::getAdminPrase('how_many_seconds_code_valid') . '</label>',
					'function_name' => 'targetvr_setting_field',
				),
			)
		),

		'section_verify' => array(
			'setting_name' => 'settings_verify_and_sms',
			'option_name'  => 'verify',
			'fields' => array(
				'send_registration_code' => array(
					'field_name'    => 'targetvr_send_registration_code',
					'field_type'    => 'checkbox',
					'field_label'   => '<label for="targetvr_send_registration_code">' . TargetvrLang::getAdminPrase('send_registration_code') . '</label>',
					'function_name' => 'targetvr_setting_field',
					'checkbox_label' => TargetvrLang::getAdminPrase('enabled'),
				),
				'message_registration_code' => array(
					'field_name'    => 'targetvr_message_registration_code',
					'field_type'    => 'textarea',
					'field_label'   => '<label for="targetvr_message_registration_code">' . TargetvrLang::getAdminPrase('text_sms_during_registration') . '</label>',
					'field_desc'    =>  sprintf(
							'%s <strong>%s</strong>, %s',
							TargetvrLang::getAdminPrase('you_must_specify_code'),
							'{sms_code}',
							TargetvrLang::getAdminPrase('It_will_be_replaced_with_code')
						),
					'function_name' => 'targetvr_setting_field',
				),
				'send_password_recovery_codde' => array(
					'field_name'     => 'targetvr_send_password_recovery_code',
					'field_type'     => 'checkbox',
					'field_label'    => '<label for="targetvr_send_password_recovery_code">' . TargetvrLang::getAdminPrase('send_password_recovery_code') . '</label>',
					'function_name'  => 'targetvr_setting_field',
					'checkbox_label' => TargetvrLang::getAdminPrase('enabled'),
				),
				'message_password_recovery_codde' => array(
					'field_name'    => 'targetvr_message_password_recovery_codde',
					'field_type'    => 'textarea',
					'field_label'   => '<label for="targetvr_message_password_recovery_codde">' . TargetvrLang::getAdminPrase('text_sms_during_password_recovery') . '</label>',
					'field_desc'    =>  sprintf(
							'%s <strong>%s</strong>, %s',
							TargetvrLang::getAdminPrase('you_must_specify_code'),
							'{sms_code}',
							TargetvrLang::getAdminPrase('It_will_be_replaced_with_code')
						),
					'function_name' => 'targetvr_setting_field',
				),
				'active_shortcode' => array(
					'field_name'  => 'targetvr_active_shortcode',
					'field_type'  => 'checkbox',
					'field_label' => '<label for="targetvr_active_shortcode">' . TargetvrLang::getAdminPrase('use_use_shortcode') . '</label>',
					'field_desc'  => sprintf(
							'<p style="margin-bottom: 10px;">%s</p><p style="color: #f00;">%s <strong>%s</strong> %s <strong>%s</strong>.</p>',
							TargetvrLang::getAdminPrase('to_display_field_phone_shortcode'),
							TargetvrLang::getAdminPrase('if_this_option_is_enabled'),
							TargetvrLang::getAdminPrase('shortcode_lostpass'),
							TargetvrLang::getAdminPrase('or'),
							TargetvrLang::getAdminPrase('shortcode_reg')
						),
					'function_name'  => 'targetvr_setting_field',
					'checkbox_label' => TargetvrLang::getAdminPrase('enabled'),
				),
			)
		)
	);

	return $settings;
}

/**
  * Возвращает массив с настройками для плагина
  *
  * @return (array) $settings - массив с настройками для плагина
*/

function targetvr_get_plugin_settings($setting_name){
	$settings = get_option($setting_name);

	return $settings;
}


/**
  * Возвращает массив с названиями опций для плагина.
  *
  * @return (array) $options_names - массив с названиями опций для плагина
*/

function targetvr_get_options_plugin(){
	$all_settings = targetvr_get_all_settings_plugin();
	
	$options_names = array_column($all_settings, 'option_name');

	return $options_names;
}

/**
  * Возвращает массив с названиям настроек для плагина.
  *
  * @return (array) $settings_names - массив с названиям настроек для плагина
*/

function targetvr_get_settings_names(){
	$all_settings = targetvr_get_all_settings_plugin();

	$settings_names = array_column($all_settings, 'setting_name');

	return $settings_names;
}

/**
  * Возвращает массив с парами ключ => название поля настроек.
  *
  * @return (array) $options - массив с парами ключ => название поля настроек
*/

function targetvr_get_fields_names(){
	$all_settings = targetvr_get_all_settings_plugin();
	
	$fields_targetsms = $all_settings['section_targetsms']['fields'];
	$fields_verify    = $all_settings['section_verify']['fields'];

	$key_targetsms = array_keys($fields_targetsms);
	$key_verify    = array_keys($fields_verify);
	
	$fields_targetsms = array_column($fields_targetsms, 'field_name');
	$fields_verify    = array_column($fields_verify, 'field_name');

	$options_targetsms = array_combine($key_targetsms, $fields_targetsms);
	$options_verify    = array_combine($key_verify, $fields_verify);

	$options = array_merge($options_targetsms, $options_verify);

	return $options;
}

/**
  * Возвращает массив с настройками для плагина.
  *
  * @return (array) $settings - массив с настройками
*/

function targetvr_get_settings(){
	$settings = array();
	$options = array();

	$settings_names = targetvr_get_settings_names();
	$fields_names   = targetvr_get_fields_names();

	foreach ($settings_names as $setting_name){
		$option = get_option($setting_name);
		
		if ($option and is_array($option))
			$options = array_merge($options, $option);
	}

	foreach ($fields_names as $field_key => $field_name){
		$settings[$field_key] = (isset($options[$field_name])) ? $options[$field_name] : '';
	}

	return $settings;
}

/**
  * Региструет страницунастроик для плагина
*/

add_action('admin_menu', 'targetvr_add_plugin_page_settings');

function targetvr_add_plugin_page_settings(){
	add_submenu_page(
		'woocommerce',
		TargetvrLang::getAdminPrase('settings_verify_sms_targetsms'),
		'Verification SMS with TargetSMS',
		'manage_options',
		TARGETVR_PLUGIN_DIR . '/' . TARGETVR_FILE_PLUGIN_OPTIONS,
	); 
}

/**
  * Возвращает массив с меню настроик для плагина.
  *
  * @return (array) $menu - массив с меню настроик для плагина
*/

function targetvr_get_plugin_menu(){
	$menu = array(
		'targetsms' => 'TargetSMS',
		'verify'    => TargetvrLang::getAdminPrase('confirmation_and_sms'),
	);

	return $menu;
}

/**
  * Возвращает название опции с настройками для панели настроек.
  *
  * @param (string) $panel - название панели
  *
  * @return (string) $option_name - название опции
*/

function targetvr_get_panel_option($panel){
	$options_names = targetvr_get_options_plugin();

	$key = array_search($panel, $options_names);

	$option_name = ($key !== false) ? $options_names[$key] : '';

	return $option_name;
}

/* Регистрирует настройки плагина */

add_action('admin_init', 'targetvr_add_plugin_settings');

function targetvr_add_plugin_settings(){
	$settings = targetvr_get_all_settings_plugin();

	if ($settings and is_array($settings)){
		foreach ($settings as $section => $setting){
			add_settings_section(
				$section,
				TargetvrLang::getAdminPrase($setting['setting_name']),
				'targetvr_description_section',
				$setting['option_name']
			);

			register_setting(
				$setting['option_name'],
				$setting['setting_name']
			);

			foreach ($setting['fields'] as $field){
				$field['setting_name'] = $setting['setting_name'];
				$field['option_name'] = $setting['option_name'];
				
				add_settings_field(
					$field['field_name'], 
					$field['field_label'],
					$field['function_name'],
					$field['option_name'],
					$section,
					$field
				);
			}
		}
	}
}

/**
  * Выводит описания для секция с настройками.
  *
  * @param (array) $section - массив с данными секции.
*/

function targetvr_description_section($section){
	$all_settings = targetvr_get_all_settings_plugin();
	
	$sections = array_keys($all_settings);

	$key = array_search($section['id'], $sections);
	
	if ($key !== false){
		$lang_key = $section['id'] . '_description';

		echo TargetvrLang::getAdminPrase($lang_key); 
	}
}

/**
  * Выводит поля настроек для плагина
  *
  * @param (array) $args - массив с параметрами для поля
*/

function targetvr_setting_field($args){
	$options = targetvr_get_plugin_settings($args['setting_name']);

	$atrr_name      = $args['setting_name'] . '[' . $args['field_name'] . ']';
	$field_type     = $args['field_type'];
	$field_name     = $args['field_name'];
	$field_label    = $args['field_label'];
	
	$field_desc     = (isset($args['field_desc']))     ? $args['field_desc']     : '';
	$checkbox_label = (isset($args['checkbox_label'])) ? $args['checkbox_label'] : '';
	$value          = (isset($options[$field_name]))   ? $options[$field_name]   : '';

	?>
		<div class="targetvr-field">
			<?php if ($field_type == 'text') : ?>

					<input type="text" name="<?php echo esc_html($atrr_name); ?>" value="<?php echo esc_html($value); ?>" id="<?php  echo esc_html($field_name); ?>" style="max-width: 500px; width: 100%;">
			
			<?php elseif ($field_type == 'checkbox') :
					$checked = ($value) ? ' checked' : ''; ?>

					<input type="checkbox" name="<?php echo esc_html($atrr_name); ?>" value="1" id="<?php echo esc_html($field_name); ?>"<?php echo $checked; ?>>
					<label for="<?php echo esc_html($field_name); ?>"><?php echo esc_html($checkbox_label); ?></label>
					
			<?php elseif ($field_type== 'textarea') : ?>

					<textarea name="<?php echo esc_html($atrr_name); ?>" id="<?php  echo esc_html($field_name); ?>" style="height: 120px; max-width: 500px; width: 100%;"><?php echo esc_html($value); ?></textarea>

			<?php endif; ?>
			
			<?php if ($field_desc) : ?>

				<div style="margin-top: 10px; max-width: 500px; width: 100%;">
					<?php echo targetvr_kses_text($field_desc); ?>
				</div>

			<?php endif; ?>
		</div>
	<?php
}

add_action('admin_notices', 'targetvr_notice_plugin');

function targetvr_notice_plugin(){
	if (!class_exists('woocommerce')) :
		?>
			<div class="notice notice-error is-dismissible">
				<p>
					<?php echo TargetvrLang::getAdminPrase('targetsms_verify_sms_work_correctly'); ?>
				</p>
			</div>
		<?php
	endif;
}
