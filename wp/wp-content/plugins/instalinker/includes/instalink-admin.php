<?php

if (!defined('ABSPATH')) exit;


function elfsight_instalink_lite_add_action_links($links) {
    $links[] = '<a href="' . esc_url(admin_url('admin.php?page=instalink-lite')) . '">Settings</a>';
    $links[] = '<a href="http://codecanyon.net/user/elfsight/portfolio?ref=Elfsight" target="_blank">More plugins by Elfsight</a>';
    return $links;
}
add_filter('plugin_action_links_' . ELFSIGHT_INSTALINK_LITE_PLUGIN_SLUG, 'elfsight_instalink_lite_add_action_links');


function elfsight_instalink_lite_admin_init() {
    wp_register_style('instalink-lite-admin', plugins_url('assets/css/instalink-lite-admin.css', ELFSIGHT_INSTALINK_LITE_FILE));
    wp_register_script('instalink-lite-admin', plugins_url('assets/js/instalink-lite-admin.js', ELFSIGHT_INSTALINK_LITE_FILE), array('jquery', 'wp-color-picker'));
}

function elfsight_instalink_lite_admin_scripts() {
    wp_enqueue_style('instalink-lite-admin');
    wp_enqueue_style('wp-color-picker');
    wp_enqueue_script('instalink-lite-admin');
}

function elfsight_instalink_lite_create_menu() {
    $page_hook = add_menu_page(__('InstaLink', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN), __('InstaLink', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN), 'manage_options', 'instalink-lite', 'elfsight_instalink_lite_settings_page', ELFSIGHT_INSTALINK_LITE_URL . 'assets/img/instalink-lite-wp-icon.png');
    add_action('admin_init', 'elfsight_instalink_lite_admin_init');
    add_action('admin_print_styles-' . $page_hook, 'elfsight_instalink_lite_admin_scripts');
}
add_action('admin_menu', 'elfsight_instalink_lite_create_menu');


function elfsight_instalink_lite_update_instagram_connect() {
    if (!wp_verify_nonce($_REQUEST['nonce'], 'elfsight_instalink_lite_update_instagram_connect_nonce')) {
        exit;
    }   

    update_option('instalink_instagram_access_token', !empty($_REQUEST['access_token']) ? $_REQUEST['access_token'] : '');
}
add_action('wp_ajax_elfsight_instalink_lite_update_instagram_connect', 'elfsight_instalink_lite_update_instagram_connect');


function elfsight_instalink_lite_settings_page() {
    global $elfsight_instalink_lite_defaults;
    $instalink_lite_config = $elfsight_instalink_lite_defaults;

    $access_token = get_option('instalink_instagram_access_token', '');

    // params for compatibility with previous versions
    $old_access_token = get_option('instalinker_instagram_access_token', '');

    if (empty($access_token)) {
        $access_token = $old_access_token;
    }

    extract($instalink_lite_config, EXTR_SKIP);?>

	<div class="instalink-lite-settings wrap">
        <h2 class="instalink-lite-settings-wp-messages-hack"></h2>
		<h1><?php _e('InstaLink Lite - Instagram Plugin', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN); ?></h1>

		<div class="instalink-lite-instagram-connect<?php echo !empty($access_token) ? ' instalink-lite-instagram-connected' : ''?> instalink-lite-settings-group">
            <h2><?php _e('Connect to Instagram', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN); ?></h2>

            <div class="instalink-lite-instagram-connect-access-token">
                <div class="instalink-lite-instagram-connect-access-token-text">
                    <p><?php _e('Get your <b>Instagram Access Token</b> with the help of the tutorial:', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN); ?><br>
                        <a href="https://elfsight.com/blog/2016/05/how-to-get-instagram-access-token/?utm_source=markets&utm_medium=wordpressorg&utm_content=adminpanel&utm_campaign=ILWPlite&utm_term=howtogetIAT" target="_blank"><?php _e('How to get Instagram Access Token?', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN); ?></a>
                    </p>

                    <p><?php _e('The token allows you to display 20 latest photos only from your account.', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN); ?></p>

                    <h3><?php _e('Instagram Access Token:', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN); ?></h3>

                    <form data-nonce="<?php echo wp_create_nonce('elfsight_instalink_lite_update_instagram_connect_nonce'); ?>">
                        <input type="text" name="instalink_instagram_access_token" value="<?php echo esc_attr($access_token); ?>" class="regular-text">
                    </form>
                </div>
            </div>

			<div class="instalink-lite-instagram-connect-note">
                <h3><?php _e('Note!', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN); ?></h3>

                <ul class="instalink-lite-instagram-connect-note-list">
                    <li><?php _e('Different Instagram @usernames', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN); ?></li>
                    <li><?php _e('Different #hashtags', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN); ?></li>
                    <li><?php _e('All photos without restrictions', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN); ?></li>
                </ul>

                <p><?php _e('Are available in <b>PRO version</b>!', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN); ?></p>

                <a class="instalink-lite-instagram-connect-note-button" href="<?php echo ELFSIGHT_INSTALINK_LITE_PRO_URL;?>" target="_blank"><?php _e('Upgrade to PRO', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN); ?></a>
			</div>
		</div>
		
		<div class="instalink-lite-settings-group">
			<h2><?php _e('Shortcode Generator', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN); ?></h2>

			<p><?php _e('You can get InstaLink Lite Shortcode using this generator.', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN); ?></p>

			<div class="instalink-lite-settings-generator">
				<div class="instalink-lite-settings-generator-setup">
	                <form>
                        <input class="instalink-lite-settings-generator-setup-access-token" type="hidden" name="access_token" value="<?php echo $access_token; ?>">

                        <div class="instalink-lite-settings-generator-field">
                            <label class="instalink-lite-settings-generator-field-width">
                                <span class="instalink-lite-settings-generator-label"><?php _e('Width:', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN); ?></span>
                                <input type="text" name="width" value="<?php echo $width; ?>" size="10">
                            </label>

                            <label class="instalink-lite-settings-generator-field-responsive">
                                <input type="checkbox" name="responsive" value="1">
                                <span class="label"><?php _e('Responsive', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN); ?></span>
                            </label>
                        </div>

                        <div class="instalink-lite-settings-generator-field">
                            <label>
                                <span class="instalink-lite-settings-generator-label"><?php _e('Height:', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN); ?></span>
                                <input type="text" name="height" value="<?php echo $height; ?>" size="10">
                            </label>
                        </div>

                        <div class="instalink-lite-settings-generator-field">
                            <label>
                                <span class="instalink-lite-settings-generator-label"><?php _e('Image size:', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN); ?></span>
                                <select name="image_size">
                                    <option value="small"<?php echo $image_size == 'small' ? ' selected' : ''; ?>><?php _e('Small', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN); ?></option>
                                    <option value="medium" disabled><?php _e('Medium (available in Pro version)', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN); ?></option>
                                    <option value="large" disabled><?php _e('Large (available in Pro version)', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN); ?></option>
                                    <option value="xlarge"<?php echo $image_size == 'xlarge' ? ' selected' : ''; ?>><?php _e('xLarge', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN); ?></option>
                                </select>
                            </label>
                        </div>

                        <div class="instalink-lite-settings-generator-field">
                            <label>
                                <span class="instalink-lite-settings-generator-label"><?php _e('Panel, button color:', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN); ?></span>
                                <input class="instalink-lite-colorpicker" type="text" name="bg_color" value="<?php echo $bg_color; ?>">
                            </label>
                        </div>

                        <div class="instalink-lite-settings-generator-premium-title"><a href="<?php echo ELFSIGHT_INSTALINK_LITE_PRO_URL;?>" target="_blank"><?php _e('Upgrade to Pro', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN); ?></a> <?php _e('to get the following options:', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN); ?></div>

                        <div class="instalink-lite-settings-generator-field-disabled instalink-lite-settings-generator-field">
                            <label>
                                <span class="instalink-lite-settings-generator-label"><?php _e('Username:', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN); ?></span>
                                <input type="text" name="username" value="" disabled>
                            </label>
                        </div>
                        
                        <div class="instalink-lite-settings-generator-field-disabled instalink-lite-settings-generator-field">
                            <label>
                                <span class="instalink-lite-settings-generator-label"><?php _e('Hashtag:', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN); ?></span>
                                <input type="text" name="hashtag" value="" disabled>
                            </label>
                        </div>

                        <div class="instalink-lite-settings-generator-field-disabled instalink-lite-settings-generator-field">
                            <label>
                                <span class="instalink-lite-settings-generator-label"><?php _e('Language:', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN); ?></span>
                                <select name="lang" disabled>
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
                            </label>
                        </div>
                        
                        <div class="instalink-lite-settings-generator-field-disabled instalink-lite-settings-generator-field">
                            <label>
                                <span class="instalink-lite-settings-generator-label"><?php _e('Show Heading:', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN); ?></span>
                                <input type="checkbox" name="show_heading" value="true" disabled>
                            </label>
                        </div>
                        
                        <div class="instalink-lite-settings-generator-field-disabled instalink-lite-settings-generator-field">
                            <label>
                                <span class="instalink-lite-settings-generator-label"><?php _e('Scroll:', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN); ?></span>
                                <input type="checkbox" name="scroll" value="true" disabled>
                            </label>
                        </div>

                        <div class="instalink-lite-settings-generator-field-disabled instalink-lite-settings-generator-field">
                            <label>
                                <span class="instalink-lite-settings-generator-label"><?php _e('Content background:', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN); ?></span>
                                <a class="wp-color-result" title="Select Color" data-current="Current Color"></a>
                                <!-- <input class="instalink-lite-colorpicker" type="text" name="content_bg_color" value="" disabled> -->
                            </label>
                        </div>
                        
                        <div class="instalink-lite-settings-generator-field-disabled instalink-lite-settings-generator-field">
                            <label>
                                <span class="instalink-lite-settings-generator-label"><?php _e('Text color:', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN); ?></span>

                                <a class="wp-color-result" title="Select Color" data-current="Current Color"></a>
                                <!-- <input class="instalink-lite-colorpicker" type="text" name="font_color" value="" disabled> -->
                            </label>
                        </div>

                        <div class="instalink-lite-settings-generator-field-disabled instalink-lite-settings-generator-field">
                            <label>
                                <span class="instalink-lite-settings-generator-label"><?php _e('Ban by Username:', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN); ?></span>
                                <input type="text" name="ban" value="" disabled>
                            </label>
                        </div>

                        <div class="instalink-lite-settings-generator-premium-instashow">
                            <?php printf(__('Check <a href="%s" target="_blank">InstaShow</a> to get one of the most flexible<br> Instagram widgets with 60+ adjustable parameters.', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN), 'https://elfsight.com/instagram-feed-instashow/wordpress/?utm_source=markets&utm_medium=wordpressorg&utm_content=adminpanel&utm_campaign=ILWPlite&utm_term=upgradetopro'); ?>
                        </div>
                    </form>
	            </div>

	            <div class="instalink-lite-settings-generator-preview-container">
                    <?php 
                        $preview_url =  ELFSIGHT_INSTALINK_LITE_URL . 'includes/instalink-admin-preview.php?';
                        if (!empty($access_token)) {
                            $preview_url .= 'access_token=' . $access_token . '&';
                        }
                        $preview_url .= http_build_query($instalink_lite_config);
                    ?>

                    <div class="instalink-lite-settings-generator-preview">
                        <iframe src="<?php echo $preview_url; ?>"></iframe>
                    </div>

                    <div class="instalink-lite-settings-generator-code">
                        <h3><?php _e('Get Your Shortcode', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN); ?></h3>
                        <p><?php _e('Copy this shortcode and paste it into any page or post.', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN); ?></p>
                        <?php 
                        $shortcode_params = '';
                        foreach($instalink_lite_config as $key => $value) {
                            if(!empty($value))
                                $shortcode_params .= sprintf(' %s="%s"', $key, $value);
                        }?>
                        <textarea spellcheck="false" rows="5" readonly>[instalink<?php echo $shortcode_params; ?>]</textarea>
                    </div>
	            </div>
			</div>
		</div>

        <div class="instalink-lite-premium instalink-lite-settings-group">
            <hgroup class="instalink-lite-premium-title">
                <h4><?php _e('Need more features to share your Instagram feed?', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN); ?></h4>
                <h2><?php _e('Try our premium products to display your Instagram feed', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN); ?></h2>
            </hgroup>

            <div class="instalink-lite-premium-products">
                <div class="instalink-lite-premium-products-instashow">
                    <figure class="instalink-lite-premium-products-instashow-logo">
                        <a href="https://elfsight.com/instagram-feed-instashow/wordpress/?utm_source=markets&utm_medium=wordpressorg&utm_content=adminpanel&utm_campaign=ILWPlite&utm_term=upgradetopro" target="_blank">
                            <img src="<?php echo ELFSIGHT_INSTALINK_LITE_URL; ?>assets/img/instashow-logo.png">
                        </a>
                    </figure>

                    <h5 class="instalink-lite-premium-products-instashow-title"><?php _e('Display your Instagram feed in an eye-catching way<br> to get wow-effect from your audience', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN); ?></h5>

                    <figure class="instalink-lite-premium-products-instashow-banner">
                        <a href="https://elfsight.com/instagram-feed-instashow/wordpress/?utm_source=markets&utm_medium=wordpressorg&utm_content=adminpanel&utm_campaign=ILWPlite&utm_term=upgradetopro" target="_blank">
                            <img src="<?php echo ELFSIGHT_INSTALINK_LITE_URL; ?>assets/img/instashow-banner.png">
                        </a>
                    </figure>

                    <div class="instalink-lite-premium-products-instashow-features">
                        <div class="instalink-lite-premium-products-features-generator">
                            <span class="instalink-lite-icon-generator instalink-lite-icon"></span>
                            <span><?php _e('Shortcode Generator', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN); ?></span>
                        </div>

                        <div class="instalink-lite-premium-products-features-vc">
                            <span class="instalink-lite-icon-vc instalink-lite-icon"></span>
                            <span><?php _e('Visual Composer Support', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN); ?></span>
                        </div>

                        <ul class="instalink-lite-premium-products-instashow-features-list">
                            <li><?php _e('60+ customizable parameters', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN); ?></li>
                            <li><?php _e('Unlinited combination of sources', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN); ?></li>
                            <li><?php _e('Extended feed moderation', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN); ?></li>
                            <li><?php _e('Essential Popup Data', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN); ?></li>
                            <li><?php _e('10 Gorgeous Color Schemes', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN); ?></li>
                            <li><?php _e('Responsive, Retina Ready', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN); ?></li>
                            <li><?php _e('Mobile friendly', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN); ?></li>
                            <li><?php _e('16 languages', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN); ?></li>
                        </ul>
                    </div>

                    <div class="instalink-lite-premium-products-buttons">
                        <a class="instalink-lite-premium-products-buttons-demo" href="https://elfsight.com/instagram-feed-instashow/wordpress/?utm_source=markets&utm_medium=wordpressorg&utm_content=adminpanel&utm_campaign=ILWPlite&utm_term=upgradetopro" target="_blank"><?php _e('Free demo', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN); ?></a>
                    </div>
                </div>

                <div class="instalink-lite-premium-products-instalink">
                    <figure class="instalink-lite-premium-products-instalink-logo">
                        <a href="<?php echo ELFSIGHT_INSTALINK_LITE_PRO_URL; ?>" target="_blank">
                            <img src="<?php echo ELFSIGHT_INSTALINK_LITE_URL; ?>assets/img/instalink-logo.png">
                        </a>
                    </figure>

                    <h5 class="instalink-lite-premium-products-instalink-title"><?php _e('Promote your Instagram profile<br>to increase followers', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN); ?></h5>

                    <figure class="instalink-lite-premium-products-instalink-banner">
                        <a href="<?php echo ELFSIGHT_INSTALINK_LITE_PRO_URL; ?>" target="_blank">
                            <img src="<?php echo ELFSIGHT_INSTALINK_LITE_URL; ?>assets/img/instalink-banner.png">
                        </a>
                    </figure>

                    <div class="instalink-lite-premium-products-instalink-features">
                        <div class="instalink-lite-premium-products-features-generator">
                            <span class="instalink-lite-icon-generator instalink-lite-icon"></span>
                            <span><?php _e('Shortcode Generator', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN); ?></span>
                        </div>

                        <div class="instalink-lite-premium-products-features-vc">
                            <span class="instalink-lite-icon-vc instalink-lite-icon"></span>
                            <span><?php _e('Visual Composer Support', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN); ?></span>
                        </div>

                        <ul class="instalink-lite-premium-products-instalink-features-list">
                            <li><?php _e('Works with @username / #hashtag', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN); ?></li>
                            <li><?php _e('Adapts to all sizes and devices', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN); ?></li>
                            <li><?php _e('Show all pics with a scroll', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN); ?></li>
                            <li><?php _e('Use as a gallery without heading', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN); ?></li>
                            <li><?php _e('4 sizes of images', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN); ?></li>
                            <li><?php _e('3 customizable color elements', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN); ?></li>
                            <li><?php _e('16 languages', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN); ?></li>
                        </ul>
                    </div>

                    <div class="instalink-lite-premium-products-buttons">
                        <a class="instalink-lite-premium-products-buttons-demo" href="<?php echo ELFSIGHT_INSTALINK_LITE_PRO_URL; ?>" target="_blank"><?php _e('Free demo', ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN); ?></a>
                    </div>
                </div>
            </div>
        </div>
	</div>
<?php } ?>