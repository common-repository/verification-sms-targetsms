<?php

/**
  * Получает и возвращает значение из глобального $_GET массива по ключу.
  *
  * @param (string) $key - ключ в $_GET массиве
  *
  * @return (string) $value - значения
*/

function targetvr_get_gatData($key, $type=''){
	$value = (isset($_GET[$key])) ? targetvr_data_filter($_GET[$key], $type) : '';
	
	return $value;
}


function targetvr_get_postData($key, $type=''){
	$value = (isset($_POST[$key])) ? targetvr_data_filter($_POST[$key], $type) : '';

	return $value;
}


function targetvr_data_filter($data, $data_type='string'){
	switch($data_type){
		case 'string': $data = sanitize_text_field((string) $data); break;
		case 'int': $data = absint($data); break;
	}

	return $data;
}


function targetvr_clear_phone($phone){
	if ($phone){
		$simbols = array('+', '(', ')', '-', ' ');

		$phone = str_replace($simbols, '', $phone);
		
		$phone = targetvr_format_phone($phone);
	}

	return $phone;
}


function targetvr_format_phone($phone){
	if ($phone){
		$count_simbols = strlen($phone);
		$first_simbol =  substr($phone, 0, 1);

		if ($count_simbols == 11 and $first_simbol == '8')
			$phone = '7' . substr($phone, 1);
	}

	return $phone;
}

function targetvr_kses_text($string){
	$html_attrs = array(
		'class' => true,
		'style' => true,
	);

	$html_tags = array(
		'br'     => array(),
		'em'     => array(),
		'p'      => $html_attrs,
		'strong' => $html_attrs,
	); 

	$text = wp_kses($string, $html_tags);

	return $text;
}