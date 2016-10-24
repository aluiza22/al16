<?php

if (!defined('ABSPATH')) exit;


if(!class_exists('InstaLinkLiteWidget')) {
	/**
	 * Adds InstaLinkLiteWidget widget.
	 */
	class InstaLinkLiteWidget extends WP_Widget {

		/**
		 * Register widget with WordPress.
		 */
		function __construct() {
			parent::__construct(
				'InstaLinkLiteWidget',
				__('InstaLink Lite', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN),
				array('description' => __('Instagram Plugin - InstaLink Lite', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN))
			);
		}

		/**
		 * Front-end display of widget.
		 *
		 * @see WP_Widget::widget()
		 *
		 * @param array $args     Widget arguments.
		 * @param array $instance Saved values from database.
		 */
		public function widget($args, $instance) {
			extract($instance, EXTR_SKIP);

			$access_token = get_option('instalink_instagram_access_token', '');

			// params for compatibility with previous versions
            $old_access_token = get_option('instalinker_instagram_access_token', '');

            if (empty($access_token)) {
                $access_token = $old_access_token;
            }

			echo '<div 
				data-il ' .
				(!empty($access_token) ? 'data-il-access-token="' . esc_attr($access_token) . '" ' : '') . '
				data-il-width="' . (!empty($width) ? esc_attr($width) : '') . '" 
				data-il-height="' . (!empty($height) ? esc_attr($height) : '') . '" 
				data-il-image-size="' . (!empty($image_size) ? esc_attr($image_size) : '') . '" 
				data-il-bg-color="' . (!empty($bg_color) ? esc_attr($bg_color) : '') . '">
			</div>';
		}

		/**
		 * Back-end widget form.
		 *
		 * @see WP_Widget::form()
		 *
		 * @param array $instance Previously saved values from database.
		 */
		public function form($instance) {
			global $elfsight_instalink_lite_defaults;
			$instance = wp_parse_args($instance, $elfsight_instalink_lite_defaults);
			extract($instance, EXTR_SKIP);
			?>
			<?php if(isset($width)) {?>
				<p>
					<label for="<?php echo $this->get_field_id('width'); ?>"><?php _e('Width:', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN); ?></label>
					<input class="widefat" id="<?php echo $this->get_field_id('width'); ?>" name="<?php echo $this->get_field_name('width'); ?>" type="text" value="<?php echo esc_attr($width); ?>">
				</p>
			<?php } ?>

			<?php if(isset($height)) {?>
				<p>
					<label for="<?php echo $this->get_field_id('height'); ?>"><?php _e('Height:', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN); ?></label>
					<input class="widefat" id="<?php echo $this->get_field_id('height'); ?>" name="<?php echo $this->get_field_name('height'); ?>" type="text" value="<?php echo esc_attr($height); ?>">
				</p>
			<?php } ?>

			<?php if(isset($image_size)) {?>
				<p>
					<label for="<?php echo $this->get_field_id('image_size'); ?>"><?php _e('Image Size:', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN); ?></label>
					<select class='widefat' id="<?php echo $this->get_field_id('image_size'); ?>" name="<?php echo $this->get_field_name('image_size'); ?>">
		          		<option value='small'<?php echo ($image_size == 'small') ? ' selected' : ''; ?>><?php _e('Small', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN); ?></option>
		          		<option value='medium' disabled><?php _e('Medium', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN); ?></option>
		          		<option value='large' disabled><?php _e('Large', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN); ?></option>
		          		<option value='xlarge'<?php echo ($image_size == 'xlarge') ? ' selected' : ''; ?>><?php _e('xLarge', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN); ?></option>
		        	</select>
				</p>
			<?php } ?>

			<?php if(isset($bg_color)) {?>
				<p>
					<label for="<?php echo $this->get_field_id('bg_color'); ?>"><?php _e('Panel and Button Background:', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN); ?></label>
					<input class="widefat" id="<?php echo $this->get_field_id('bg_color'); ?>" name="<?php echo $this->get_field_name('bg_color'); ?>" type="text" value="<?php echo esc_attr($bg_color); ?>">
				</p>
			<?php } ?>

			<div class="instalink-lite-widget-premium">
				<div class="instalink-lite-widget-premium-title">
					<a href="<?php echo ELFSIGHT_INSTALINK_LITE_PRO_URL; ?>" target="_blank">Upgrade to Pro</a> to get the following options:
				</div>

				<div class="instalink-widget-premium-content" style="opacity: 0.5;">
                    <p>
                        <label><?php _e('Username:', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN); ?></label>
                        <input class="widefat" name="username" type="text" value="" disabled>
                    </p>

					<p>
						<label><?php _e('Hashtag:', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN); ?></label>
						<input class="widefat" name="hashtag" type="text" value="" disabled>
					</p>

					<p>
						<label><?php _e('Language:', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN); ?></label>
						<select class="widefat" name="lang" disabled>
							<option value="en"><?php _e('English', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN); ?></option>
		                    <option value="id"><?php _e('Bahasa Indonesia', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN); ?></option>
		                    <option value="de"><?php _e('Deutsch', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN); ?></option>
		                    <option value="es"><?php _e('Espa&ntilde;ol', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN); ?></option>
		                    <option value="fr"><?php _e('Fran&ccedil;ais', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN); ?></option>
		                    <option value="nl"><?php _e('Nederlands', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN); ?></option>
		                    <option value="pl"><?php _e('Polski', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN); ?></option>
		                    <option value="pt-BR"><?php _e('Portugu&ecirc;s', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN); ?></option>
		                    <option value="ru"><?php _e('&#x0420;&#x0443;&#x0441;&#x0441;&#x043a;&#x0438;&#x0439;', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN); ?></option>
		                    <option value="sv"><?php _e('Svenska', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN); ?></option>
		                    <option value="tr"><?php _e('T&uuml;rk&ccedil;e', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN); ?></option>
		                    <option value="zh-HK"><?php _e('&#x4e2d;&#x6587;', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN); ?></option>
		                    <option value="ja"><?php _e('&#x65e5;&#x672c;&#x8a9e;', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN); ?></option>
		                    <option value="ko"><?php _e('&#xd55c;&#xad6d;&#xc758;', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN); ?></option>
		                    <option value="he"><?php _e('&#x5E2;&#x5B4;&#x5D1;&#x5B0;&#x5E8;&#x5B4;&#x5D9;&#x5EA;', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN); ?></option>
			        	</select>
					</p>

					<p>
						<input class="checkbox" type="checkbox" name="show_heading" value="true" disabled>
						<label><?php _e('Show Heading', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN); ?></label>
					</p>

					<p>
						<input class="checkbox" type="checkbox" name="scroll" value="true" disabled>
						<label><?php _e('Scroll', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN); ?></label>
					</p>

					<p>
						<label><?php _e('Content Background Color:', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN); ?></label>
						<input class="widefat" name="content_bg_color" type="text" value="" disabled>
					</p>
					
					<p>
						<label><?php _e('Font Color:', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN); ?></label>
						<input class="widefat" name="font_color" type="text" value="" disabled>
					</p>

					<p>
						<label><?php _e('Ban by Username:', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN); ?></label>
						<input class="widefat" name="ban" type="text" value="" disabled>
					</p>
				</div>
			</div>
			<?php
		}

		/**
		 * Sanitize widget form values as they are saved.
		 *
		 * @see WP_Widget::update()
		 *
		 * @param array $new_instance Values just sent to be saved.
		 * @param array $old_instance Previously saved values from database.
		 *
		 * @return array Updated safe values to be saved.
		 */
		public function update($new_instance, $old_instance) {
			$instance = $old_instance;
		    $instance['width'] = !empty($new_instance['width']) ? $new_instance['width'] : '';
		    $instance['height'] = !empty($new_instance['height']) ? $new_instance['height'] : '';
		    $instance['image_size'] = !empty($new_instance['image_size']) ? $new_instance['image_size'] : '';
		    $instance['bg_color'] = !empty($new_instance['bg_color']) ? $new_instance['bg_color'] : '';

		    return $instance;
		}
	}

	if (!function_exists('elfsight_instalink_lite_register_widget')) {
		function elfsight_instalink_lite_register_widget() {
		    register_widget('InstaLinkLiteWidget');
		}
		add_action('widgets_init', 'elfsight_instalink_lite_register_widget');
	}
}

?>