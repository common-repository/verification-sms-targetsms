<?php

/**
  * Подключаем CSS файл для плагина.
*/

add_action('wp_enqueue_scripts', 'targetvr_sbspost_style');

function targetvr_sbspost_style(){
	wp_enqueue_style('targetvr-style', TARGETVR_PLUGIN_URL . '/css/targetvr-style.css');
}

/**
  * Подключаем JS файл для плагина.
*/

add_action('wp_footer', 'targetvr_enqueue_script');

function targetvr_enqueue_script(){
	$settings = targetvr_get_settings();

	wp_enqueue_script('targetvr-script', TARGETVR_PLUGIN_URL . '/js/targetvr-main.js');
	
	wp_localize_script(
		'targetvr-script',
		'targetvrOject',
		array(
			'ajax_url'     => admin_url('admin-ajax.php'),
			'seconds_code' => ($settings['seconds_code_valid']) ? $settings['seconds_code_valid'] : 60,
			'langs' => array(
				'close'               => TargetvrLang::getFrontendPrase('close'),
				'code_is_incorrectly' => TargetvrLang::getFrontendPrase('code_is_incorrectly'),
				'confirm_code'        => TargetvrLang::getFrontendPrase('confirm_code'),
				'good'                => TargetvrLang::getFrontendPrase('good'),
				'sending'             => TargetvrLang::getFrontendPrase('sending'),
				'seconds'             => TargetvrLang::getFrontendPrase('seconds'),
				'you_can_order_sms'   => TargetvrLang::getFrontendPrase('you_can_order_sms_with_code_again'),
				'send_code_again'     => TargetvrLang::getFrontendPrase('send_code_again'),
			)
	));

}

/**
  * Добавляет в форму восстановление пароля поле с номером телефона для заказа СМС с кодом.
*/ 

add_action('woocommerce_lostpassword_form', 'targetvr_truemisha_add_form_lostpassword_field', 25);

function targetvr_truemisha_add_form_lostpassword_field(){
	$settings = targetvr_get_settings();

	$active_shortcode = (isset($settings['active_shortcode'])) ? $settings['active_shortcode'] : '';

	if (!$active_shortcode and isset($settings['send_password_recovery_codde']) and $settings['send_password_recovery_codde']) :
		$args = array(
			'template_name' => 'form_lostpassword',
			'type_code' => 'lostpassword'
		);

		targetvr_truemisha_form_field($args);
	endif;
}

/**
  * Добавляет в форму регистрации поле с номером телефона для заказа СМС с кодом.
*/ 

add_action('woocommerce_register_form', 'targetvr_truemisha_add_form_register_field', 25);

function targetvr_truemisha_add_form_register_field(){
	$settings = targetvr_get_settings();

	$active_shortcode = (isset($settings['active_shortcode'])) ? $settings['active_shortcode'] : '';

	if (!$active_shortcode and isset($settings['send_registration_code']) and $settings['send_registration_code']) :
		$args = array(
			'template_name' => 'form_register',
			'type_code' => 'registration'
		);

		targetvr_truemisha_form_field($args);
	endif;
}

/**
  * Выводит поле в форме для ввода номера телефона. 
*/

function targetvr_truemisha_form_field($args){
	$class = (isset($args['template_name']) and $args['template_name']) ? ' targetvr-' . $args['template_name'] : '';
	$type_code = (isset($args['type_code']) and $args['type_code']) ? $args['type_code'] : '';

	do_action('targetvr_field_phone_start');

	?>
		<div class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide targetvr-row-phone<?php echo $class; ?>">
			<?php echo targetvr_form_input_phone($type_code); ?>
		</div>
	<?php

	do_action('targetvr_field_phone_end');
}

/**
  * Возвращает HTML код поля для ввода номера телефона.
  *
  * @param (string) $type_code -
  *
  * @return (string) $html -
*/

function targetvr_form_input_phone($type_code){
	$phone = targetvr_get_postData('targetvr_billing_phone');

	$html = '<label for="targetvr_billing_phone">
				' . TargetvrLang::getFrontendPrase('your_phone') . '
				<span class="required">*</span>
			</label>
			<div class="targetvr-wrapper">
				<div class="targetvr-item-input">
					<input type="text" class="input-text" name="targetvr_billing_phone" value="' . esc_html($phone) . '" id="targetvr_billing_phone">
					<button class="targetvr-button targetvr-button_send_code" title="' . TargetvrLang::getFrontendPrase('send_code') . '" id="targetvr_button_send_code" data-type_code="' . $type_code . '">
						<span class="button-text">' . TargetvrLang::getFrontendPrase('send_code') . '</span>
						<span class="confirmation-code-good"></span>
					</button>
				</div>
			</div>
			<div class="targetvr-input-desc">
				' . TargetvrLang::getFrontendPrase('will_be_sent_sms_code') . '
			</div>';

	return $html;
}

/* Региструет shortcode, чтобы вывести поле для ввода номера телефона */

add_shortcode('targetvr_verification_lostpass', 'targetvr_shortcode_verification_lostpass_field_phone');

function targetvr_shortcode_verification_lostpass_field_phone($attrs, $content){
	$html = targetvr_form_input_phone('lostpassword');
	
	return $html;
}

/* Региструет shortcode, чтобы вывести поле для ввода номера телефона */

add_shortcode('targetvr_verification_reg', 'targetvr_shortcode_verification_reg_field_phone');

function targetvr_shortcode_verification_reg_field_phone($attrs, $content){
	$html = targetvr_form_input_phone('registration');
	
	return $html;
}

/* Сохраняем номер телефона при создание нового клиента */

add_action( 'woocommerce_created_customer', 'targetvr_save_phone', 25 );

function targetvr_save_phone($user_id){
	$phone = targetvr_get_postData('targetvr_billing_phone');
	$phone = targetvr_clear_phone($phone);

	if ($phone){
		update_user_meta(
			$user_id,
			'billing_phone',
			$phone
		);
	}
}
