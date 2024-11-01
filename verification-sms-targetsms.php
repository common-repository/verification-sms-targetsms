<?php
/*
 * Plugin Name: Verification SMS with TargetSMS
 * Description: Позволяет реализовать верификацию посредством отправки СМС с кодом подтверждения на указанный номер телефона. СМС отправляются через сервис targetsms.ru. Также должен быть установлен WooCommerce.
 * Author URI:  https://vk.com/cajka_d
 * Author:      Дробина Лариса
 * Text Domain: verification_sms_targetsms
 * Domain Path: /languages/
 * Version:     1.5
 */

defined('ABSPATH') or exit;

define('TARGETVR_PLUGIN_DIR', dirname( __FILE__ ));

define('TARGETVR_PLUGIN_URL', plugins_url('', __FILE__));

define('TARGETVR_PLUGIN_DIR_INC', TARGETVR_PLUGIN_DIR . '/inc');

define('TARGETVR_PLUGIN_DIR_LANGS', TARGETVR_PLUGIN_DIR . '/languages');

define('TARGETVR_TEXT_DOMAIN', 'verification_sms_targetsms');

define('TARGETVR_FILE_PLUGIN_OPTIONS', 'plugin-options.php');

/**
  * Подключаем файл перевода для плагина
*/

add_action('after_setup_theme', function(){
	load_theme_textdomain(TARGETVR_TEXT_DOMAIN, TARGETVR_PLUGIN_DIR_LANGS);
});


require_once(TARGETVR_PLUGIN_DIR_INC . '/class-targetvr-lang.php');

require_once(TARGETVR_PLUGIN_DIR_INC . '/functions-hilping.php');

require_once(TARGETVR_PLUGIN_DIR_INC . '/backend.php');

require_once(TARGETVR_PLUGIN_DIR_INC . '/frontend.php');

require_once(TARGETVR_PLUGIN_DIR_INC . '/ajax.php');


?>