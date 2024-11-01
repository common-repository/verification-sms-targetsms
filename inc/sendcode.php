<?php

require_once(TARGETVR_PLUGIN_DIR_INC . '/class-target-send-sms.php');

$targetSendSMS = new TargetSendSMS(
    'логин',// логин в системе TargetSMS
    'пароль'// пароль в системе TargetSMS
);

try {
    $result = $targetSendSMS->generateCode(
        'телефон',// номер телефона получателя
        'отправитель',// подпись отправителя
        4,// длина кода
        'Код авторизации: {код}'// текст персонификации
    );

    $code = $result->success->attributes()['code'];// сгенерированный код 
    $id_sms = $result->success->attributes()['id_sms'];// id смс для проверки статуса доставки
    $status = $result->success->attributes()['status'];// статус доставки

} catch (Exception $e){
	
    $error = $e->getMessage();

}