<?php
/*
Plugin Name: InstaLink Lite
Plugin URI: https://elfsight.com/instagram-widget-instalink/wordpress/
Description: Premium-quality smart plugin for Instagram to embed Instagram profile easily and quickly to your website.
Author: Elfsight
Version: 1.3.0
Author URI: https://elfsight.com/
*/

if (!defined('ABSPATH')) exit;

define('ELFSIGHT_INSTALINK_LITE_SLUG', 'instalink-lite');
define('ELFSIGHT_INSTALINK_LITE_VERSION', '1.3.0');
define('ELFSIGHT_INSTALINK_LITE_FILE', __FILE__);
define('ELFSIGHT_INSTALINK_LITE_PATH', plugin_dir_path(__FILE__));
define('ELFSIGHT_INSTALINK_LITE_URL', plugin_dir_url( __FILE__ ));
define('ELFSIGHT_INSTALINK_LITE_PLUGIN_SLUG', plugin_basename( __FILE__ ));
define('ELFSIGHT_INSTALINK_LITE_TEXTDOMAIN', 'instalink');
define('ELFSIGHT_INSTALINK_LITE_PRO_URL', 'https://elfsight.com/instagram-widget-instalink/wordpress/?utm_source=markets&utm_medium=wordpressorg&utm_content=adminpanel&utm_campaign=ILWPlite&utm_term=upgradetopro');


$elfsight_instalink_lite_defaults = array(
	'width' => '350px',
	'height' => '350px',
	'image_size' => 'small',
	'bg_color' => '#285989'
);

require_once(ABSPATH . implode(DIRECTORY_SEPARATOR, array('wp-admin', 'includes', 'plugin.php')));

if (!is_plugin_active('instalink/instalink.php')) {
    require_once(ELFSIGHT_INSTALINK_LITE_PATH . '/includes/instalink-admin.php');
    require_once(ELFSIGHT_INSTALINK_LITE_PATH . '/includes/instalink-lib.php');
    require_once(ELFSIGHT_INSTALINK_LITE_PATH . '/includes/instalink-shortcode.php');
    require_once(ELFSIGHT_INSTALINK_LITE_PATH . '/includes/instalink-widget.php');
}

?>