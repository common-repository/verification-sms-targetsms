<?php

/**
  * Региструет функцию для обработки AJAX запросов.
*/

add_action('wp_ajax_nopriv_targetvrHHndler', 'targetvr_ajax_handler');

function targetvr_ajax_handler(){
	$callback = targetvr_get_postData('callback', 'string');

	if ($callback and function_exists($callback)){
		call_user_func($callback);
	} else {
		targetvr_return_json(false);
	}

	wp_die();
}

/**
  * Отдает/выводит ответ от севера в формате JSON.
  *
  * @param (bool) $status - статус выполнения операции true/false
  * @param (array) $data - данные от сервера
*/

function targetvr_return_json($status,$data=array()){
	$result = array(
		'status'   => $status,
	);

	if ($data)
		$result = array_merge($result, $data);

	$json = json_encode($result, JSON_UNESCAPED_UNICODE);

	header('Content-Type: application/json; charset=UTF-8');

	echo $json;
}


function targetvr_send_code(){
	$status = false;
	$data = array(
		'error' => '',
		'error_text' => '',
		'show_field_code' => false,
	);

	$phone            = targetvr_get_postData('phone', 'string');
	$type_verify_code = targetvr_get_postData('type_code', 'string');

	$phone = targetvr_clear_phone($phone);
	
	if (!$phone){
		$data['error']   = 'error_no_phone';
		$data['message'] = TargetvrLang::getFrontendPrase('error_phone');
	} else {
		$user_id = targetvr_checked_user_phone($phone);

		if ($type_verify_code == 'registration' and $user_id){
			$data['error']   = 'error_user_registered';
			$data['message'] = TargetvrLang::getFrontendPrase('user_specified_phone_already_registered');
		} else if ($type_verify_code == 'lostpassword' and !$user_id){
			$data['error'] = 'error_user_not_find';
			$data['message'] = TargetvrLang::getFrontendPrase('user_specified_phone_not_foun');
		} else {
			$settings = targetvr_get_settings();
			
			$login            = $settings['login'];
			$password         = $settings['password'];
			$sender_signature = $settings['sender_signature'];

			$code_length = ($settings['code_length']) ? $settings['code_length'] : 6;

			if ($login and $password and $sender_signature){			
				switch ($type_verify_code){
					case 'registration': $sms_text = $settings['message_registration_code']; break;
					case 'lostpassword': $sms_text = $settings['message_password_recovery_codde']; break;
					default: $sms_text = '';
				}

				$sms_text = targetvr_validator_message($sms_text);

				$result = targetvr_sender_sms_code(
					array(
						'login'            => $login,
						'password'         => $password,
						'sender_signature' => $sender_signature,
						'phone'            => $phone,
						'code_length'      => $code_length,
						'message'          => $sms_text,
				));

				// Testing
				// $result = array('error' => false, 'code' => 90089);

				if ($result['error'] == false){
					$status = true;

					$data['show_field_code'] = true;
					$data['message'] = sprintf(
						'%s <span> +%s </span> %s',
						TargetvrLang::getFrontendPrase('to_the_number'),
						$phone,
						TargetvrLang::getFrontendPrase('sent_confirmation_code')
					);
					$data['code'] = targetvr_data_filter($result['code'], 'int');
				} else {
					$data['error'] = 'error_targetsms';
					$data['error_text'] = esc_html($result['error']);
					$data['message'] = TargetvrLang::getFrontendPrase('error');
				}
			} else {
				$data['error'] = 'error_not_configured';
				$data['message'] = TargetvrLang::getFrontendPrase('error_plugin_no_settings');
			}
		}
	}

	targetvr_return_json($status, $data);
}

function targetvr_reset_code(){
	$data = array(
		'error' => '',
	);

	$reset_code = targetvr_get_postData('reset_code', 'string');

	if ($reset_code == 'reset_code'){
		$_SESSION['targetvr_code'] = '';
		$status = true;
		$data['message'] = TargetvrLang::getFrontendPrase('code_has_been_resety');
	} else {
		$status = false;
		$data['message'] = TargetvrLang::getFrontendPrase('command_is_incorrect');
	}

	targetvr_return_json($status, $data);
}

/**
  * Ищет пользователя по номеру телефона.
  *
  * @param (string) $phone - номер телефона
  *
  * @return (ID user/false) - ID пользователя или false
*/

function targetvr_checked_user_phone($phone){
	$phone = (strlen($phone) == 11) ? substr($phone, 1) : $phone;

	$args = array(
		'fields'       => 'ID',
		'meta_key'     => 'billing_phone', 
		'meta_value'   => $phone,
		'meta_compare' => 'LIKE'
	);

	$user = get_users($args);

	if ($user)
		return $user[0]['ID'];
	else
        return false;
}


function targetvr_validator_message($message){
	if ($message)
		$message = str_replace('sms_code', 'код', $message);
	else
		$message = TargetvrLang::getFrontendPrase('default_message_sms');
	
	return $message;
}


function targetvr_sender_sms_code($data){
	require_once(TARGETVR_PLUGIN_DIR_INC . '/class-targetsms.php');

	$result = array();

	$targetSMS = new TargetSMS($data['login'], $data['password']);

	try {
		$result_send = $targetSMS->generateCode(
			$data['phone'],            // номер телефона получателя
			$data['sender_signature'], // подпись отправителя
			$data['code_length'],      // длина кода
			$data['message']           // текст персонификации
		);

		$result['code']   = $result_send->success->attributes()['code'];     // сгенерированный код 
		$result['id_sms'] = $result_send->success->attributes()['id_sms'];   // id смс для проверки статуса доставки
		$result['status'] = $result_send->success->attributes()['status'];    // статус доставки
		$result['error']  = false;

	} catch (Exception $e) {
		$result['error'] = $e->getMessage();
	}

	return $result;
}


