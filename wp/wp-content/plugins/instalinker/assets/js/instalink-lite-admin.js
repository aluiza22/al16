/* Elfsight (c) elfsight.com */
(function($) {

	$(function() {
		var $settingsForm = $('.instalink-lite-settings-generator-setup form'),
			$preview = $('.instalink-lite-settings-generator-preview'),
			$previewIframe = $('iframe', $preview),
			$codeTextarea = $('.instalink-lite-settings-generator-code textarea'),
			instaLinkLiteURL,
			data = {},
			timer,
			getData = function() {
				$('input[type=text]:enabled, input[type=checkbox]:enabled:not([name=responsive]), input[type=hidden]:enabled, select:enabled', $settingsForm).each(function() {
					getValue($(this));
				});
			},
			getValue = function($element) {
				var name = $element.attr('name'),
					value = $element.val();

				if((name == 'width' || name == 'height') && !(new RegExp("px|%|auto").test(value)))
					value += 'px';

				if($element.is('[type=checkbox]'))
					value = $element.prop('checked').toString();

				if($element.is('.instalink-lite-colorpicker'))
					value = $element.wpColorPicker('color');
				
				data[name] = value;
			},
			updateWidget = function($element) {
				if ($element) {
					getValue($element);
				}
				var shortcode = '[instalink';
				for(var item in data)
					if(data[item] && item != 'access_token')
						shortcode += ' ' + item + '="' + data[item] + '"';
				
				shortcode += ']';
				$codeTextarea.val(shortcode);

				clearTimeout(timer);
				timer = setTimeout(function() {
					$previewIframe.css({ width: data.width, height: data.height });
					$previewIframe.attr('src', instaLinkLiteURL + '?' + $.param(data));
				}, 500);
			};

		// update widget subscribe
		if($previewIframe.length) {
			instaLinkLiteURL = $previewIframe.attr('src').split('?')[0];
			$('input[type=text]', $settingsForm).not('.instalink-lite-colorpicker').on('keyup change', function() {
				updateWidget($(this));
			});
			$('input[type=checkbox]:not([name=responsive])', $settingsForm).on('click', function() {
				updateWidget($(this));
			});
			$('select', $settingsForm).on('change', function() {
				updateWidget($(this));
			});
		}

		// colorpicker
		if($.fn.wpColorPicker) {
			$('.instalink-lite-colorpicker').each(function() {
				var $colorpicker = $(this);

				$colorpicker.wpColorPicker({
					change: function() {
						updateWidget($colorpicker);
					},
					defaultColor: $colorpicker.val(),
					palettes: false,
					disable: true
				});

				$('.wp-color-result').on('focus', function(e) {
					e.preventDefault();
					e.stopPropagation();
				});
			});
		}

		// get default values
		getData();

		// code textarea select
		$codeTextarea.on('click', function() {
			$codeTextarea.select();
		});

		// responsive
		var $widthInput = $('.instalink-lite-settings-generator-field-width input', $settingsForm),
			widthCurrentValue;

		$('.instalink-lite-settings-generator-field-responsive input[type=checkbox]', $settingsForm).on('click', function() {
			if($(this).prop('checked')) {
				widthCurrentValue = $widthInput.val();
				$widthInput.val('100%').trigger('change').prop('disabled', true);
			}
			else {
				$widthInput.prop('disabled', false).val(widthCurrentValue).trigger('change');
			}
		});


		// client_id check and save
		var $connect = $('.instalink-lite-instagram-connect');
		var $connectForm = $connect.find('form');
		var $connectAccessToken = $connectForm.find('[name=instalink_instagram_access_token]');

		var checkClientId = function() {
			var accessToken = $connectAccessToken.val();

			$.ajax({
				dataType: 'jsonp',
				url: 'https://api.instagram.com/v1/users/self/',
				data: {
					access_token: accessToken
				},
				success: function(res) {
					if (res.meta.code !== 200) {
						accessToken = '';
					}

					$connect.toggleClass('instalink-lite-instagram-connected', res.meta.code === 200);

					$.post(ajaxurl, 
						{ 
							action: 'elfsight_instalink_lite_update_instagram_connect',
							access_token: accessToken,
							nonce: $connectForm.attr('data-nonce')
						}
					);

					$('.instalink-lite-settings-generator-setup-access-token').val(accessToken);
					getData();
					updateWidget();
				}
			});
		};

		var connectAccessTokenTimeout;
		$connectAccessToken.on('change keyup', function() {
			clearTimeout(connectAccessTokenTimeout);
			connectAccessTokenTimeout = setTimeout(function() {
				$connectForm.trigger('submit');
			}, 300);
		});

		$connectForm.submit(function(e) {
			e.preventDefault();
			e.stopPropagation();

			checkClientId();
		});
	});

})(jQuery);