var targetvr_confirmed_code = false;
	targetvr_code = false;


/* SETTING COOKIE */

function targetvr_setting_cookie(name, value, num_hours, path, secure){
	var cookie_string = name + "=" + escape(value),
		domain = window.location.hostname;;

	if (num_hours){
		var to_day = new Date();
		
		to_day.setHours(to_day.getHours() + num_hours);

		cookie_string += "; expires=" + to_day.toGMTString();
	}

	if (path)
		cookie_string += "; path=" + escape(path);

	if (domain)
		cookie_string += "; domain=" + escape(domain);

	if (secure)
		cookie_string += "; secure";

	document.cookie = cookie_string;
	
}

/* GET VALUE OF COOKIE */

function targetvr_get_cookie_value(cookie_name){
	var results = document.cookie.match ( '(^|;) ?' + cookie_name + '=([^;]*)(;|$)' );

	if (results)
		return (unescape(results[2]));
	else
		return null;
}

/* ajax */

function targetvr_query_ajax(post_data){
	post_data.action = 'targetvrHHndler';	

	jQuery('#targetvr_popup_confirm_code .targetvr-message_error').text('');

	jQuery.ajax({
		type: 'POST',
		url: targetvrOject.ajax_url,
		data: post_data,
		dataType: 'json',
		success: function(result){
			jQuery('button#targetvr_button_send_code, .targetvr-popup #targetvr_bottom_confirm_code')
				.removeClass('loading');

			
			switch (post_data.callback){
				case 'targetvr_send_code':
					jQuery('.targetvr-sending')
						.removeClass('targetvr-fade')
						.addClass('targetvr-hide');
				
						if (jQuery('#targetvr_popup_confirm_code').length == 0)
							targetvr_show_popup_confirm_code(post_data, result);

						if (result.status){
							targetvr_code = result.code;

							jQuery('button#targetvr_button_send_code')
								.addClass('targetvr-button_disabled');

							targetvr_remove_send_code_again();

							jQuery('#targetvr_popup_confirm_code .targetvr-wrapper-tamer')
								.removeClass('targetvr-hide')
								.addClass('targetvr-fade');
							
							jQuery('#targetvr_tamer').text(targetvr_second);
							
							targetvr_tamer();
						} else {
							jQuery('button#targetvr_button_send_code')
								.removeClass('targetvr-button_disabled');

							/*
							if (result.error != 'error_targetsms'){
								targetvr_code = false;
								targetvr_add_send_code_again();
							}
							*/
						}
					break;
				case 'targetvr_reset_code':
						if (result.status){
							targetvr_add_send_code_again();
						}
					break;
			}

		}
	});
}

/* Открывает popup для подтверждения кода */

function targetvr_show_popup_confirm_code(data, result){
	var class_field_code = (!result.show_field_code) ? ' targetvr-hide' : '',
		class_error_text = (!result.error_text) ? ' targetvr-hide' : '',
		html;

	html = '<div id="targetvr_popup_confirm_code" class="targetvr-popup">\
					<div class="targetvr-wrapper-popup-close">\
						<div class="targetvr-popup-close">x</div>\
					</div>\
					<div class="targetvr-popup-content">\
						<div class="targetvr-message">\
							' + result.message + '\
						</div>\
						<div class="targetvr-input-code' + class_field_code + '">\
							<input type="text" name="targetvr_confirm_code" value="" id="targetvr_confirm_code">\
							<button class="targetvr-button targetvr-bottom-confirm_code" id="targetvr_bottom_confirm_code">' + targetvrOject.langs.confirm_code + '</button>\
						</div>\
						<div class="targetvr-message_error' + class_error_text + '">' + result.error_text + '</div>\
						<div class="targetvr-sending targetvr-hide">' + targetvrOject.langs.sending + '</div>\
						<div class="targetvr-wrapper-tamer targetvr-hide">\
							<div class="targetvr-tamer">\
								<span>' + targetvrOject.langs.you_can_order_sms + ' </span>\
								<span id="targetvr_tamer"></span>\
								<span> ' + targetvrOject.langs.seconds + '</span>\
							</div>\
						</div>\
					</div>\
				</div>\
				<div id="targetvr_bg_black" class="targetvr-bg-black"></div>';

	jQuery('body').append(html);
}

/* Закрывает popup для подтверждения кода */

function targetvr_show_popup_close(){
	if (targetvr_confirmed_code == false){
		jQuery('#targetvr_button_send_code').removeClass('targetvr-button_disabled');
	}

	jQuery('.targetvr-popup, .targetvr-bg-black')
		.fadeOut(500)
		.delay(600)
		.remove();
}

/* Добавляет/выводит ссылку для повторного заказа кода подтверждения */

function targetvr_add_send_code_again(){
	var html = '<div class="targetvr-link-code">\
					<a href="#" id="send_code_again">\
						' + targetvrOject.langs.send_code_again + '\
					</a>\
				</div>';

	jQuery('.targetvr-wrapper-tamer')
		.removeClass('targetvr-fade')
		.addClass('targetvr-hide');

	if (jQuery('#send_code_again').length == 0){
		jQuery('#targetvr_popup_confirm_code .targetvr-popup-content')
			.append(html);
	}
}

/* Удаляет ссылку для повторного заказа кода подтверждения */

function targetvr_remove_send_code_again(){
	var link_code = jQuery('#targetvr_popup_confirm_code .targetvr-link-code');
	
	if (link_code.length > 0)
		link_code.remove();
}

/* Запускает таймер обратного отсчета времени, в течение которого код действует */

var targetvr_second = targetvrOject.seconds_code,
	targetvr_tamer_second = targetvr_second;

function targetvr_tamer(){
	if (targetvr_tamer_second == 0){
		var post_data = {
				callback: 'targetvr_reset_code',
				reset_code: 'reset_code'
			};

		targetvr_query_ajax(post_data);

		targetvr_tamer_second = targetvr_second;

		return false;
	} else if (targetvr_tamer_second < 0){
		targetvr_tamer_second = targetvr_second;

		return false;
	}

	targetvr_tamer_second--;

	jQuery('#targetvr_tamer').text(targetvr_tamer_second);

	setTimeout("targetvr_tamer()", 1000);
}

function targetvr_set_confirmed_code(){
	var cookie_value = targetvr_get_cookie_value('targetvr_confirmed_code');

	if (cookie_value == 'y'){
		targetvr_confirmed_code = true;

		jQuery('button#targetvr_button_send_code')
			.addClass('targetvr-button_disabled');

		jQuery('button#targetvr_button_send_code .button-text')
			.text(targetvrOject.langs.good);
			
		jQuery('button#targetvr_button_send_code .confirmation-code-good')
			.css('display', 'block');
	}
}

		
/* jQuery */

jQuery(function($){
	targetvr_set_confirmed_code();
	
	/* Передает данные с номером телефона на сервер для отправки СМС с кодом */

	$('button#targetvr_button_send_code').on('click', function(){
		if (targetvr_confirmed_code == false && !$(this).hasClass('targetvr-button_disabled')){
			var type_code = $(this).data('type_code'),
				phone = $('input#targetvr_billing_phone').val(),
				post_data = {
					callback: 'targetvr_send_code',
					phone: phone,
					type_code: type_code
				};

			$('input#targetvr_billing_phone').removeClass('targetvr-input_error');

			if (phone){
				$(this).addClass('loading targetvr-button_disabled');

				targetvr_query_ajax(post_data);
			} else {
				$(this).removeClass('loading targetvr-button_disabled');
				$('input#targetvr_billing_phone').addClass('targetvr-input_error');
			}
		}
		
		return false;
	});

	/* Закрывает/удаляет popup с полем для ввода кода из СМС */

	$('body').on('click', '.targetvr-popup .targetvr-popup-close', function(){
		targetvr_show_popup_close();
	});

	/* */

	$('body').on('click', '.targetvr-popup #send_code_again', function(){
		var phone = $('input#targetvr_billing_phone').val(),
			post_data = {
				callback: 'targetvr_send_code',
				phone: phone
			};

		$('input#targetvr_confirm_code').val('');

		if (phone){
			$('.targetvr-sending')
				.removeClass('targetvr-hide')
				.addClass('targetvr-fade');

			targetvr_remove_send_code_again();
			targetvr_query_ajax(post_data);
		} else {
			targetvr_show_popup_close();

			$('input#targetvr_billing_phone')
				.addClass('targetvr-input_error');
		}

		return false;
	});
	
	/* Проверяем указан ли код, если да, отправляем запрос на проверку кода */

	$('body').on('click', '.targetvr-popup #targetvr_bottom_confirm_code', function(){
		var code = $('input#targetvr_confirm_code').val();

		if (!code){
			$('input#targetvr_confirm_code')
				.addClass('targetvr-input_error');

			return false;
		} else {
			$('input#targetvr_confirm_code')
				.removeClass('targetvr-input_error');
		}

		if (targetvr_code){
			if (targetvr_code && targetvr_code == code){				
				targetvr_setting_cookie('targetvr_confirmed_code', 'y', 1);
				targetvr_set_confirmed_code();
				targetvr_show_popup_close();
			} else {
				jQuery('#targetvr_popup_confirm_code .targetvr-message_error')
					.text(targetvrOject.langs.code_is_incorrectly);
			}
		} else {
			$('.targetvr-popup #targetvr_bottom_confirm_code')
				.removeClass('loading');

			$('input#targetvr_confirm_code')
				.addClass('targetvr-input_error');
		}

		return false;
	});


	$('body').on('click', '.woocommerce-button.woocommerce-form-register__submit, form.lost_reset_password .button-lost_reset_password', function(){
		console.log(targetvr_confirmed_code);

		if (targetvr_confirmed_code){
			return true;
		} else {
			$('input#targetvr_billing_phone').addClass('targetvr-input_error');

			return false;
		}
	});


});