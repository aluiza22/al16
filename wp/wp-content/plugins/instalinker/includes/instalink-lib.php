<?php

if (!defined('ABSPATH')) exit;


// register styles and scripts
function elfsight_instalink_lite_lib() {
    wp_register_style('instalink-lite', plugins_url('assets/instalink-lite/instalink-lite-1.3.0.min.css', ELFSIGHT_INSTALINK_LITE_FILE), array(), ELFSIGHT_INSTALINK_LITE_VERSION);
    wp_register_script('instalink-lite', plugins_url('assets/instalink-lite/instalink-lite-1.3.0.min.js', ELFSIGHT_INSTALINK_LITE_FILE), array('jquery'), ELFSIGHT_INSTALINK_LITE_VERSION);

    wp_enqueue_style('instalink-lite');
    wp_enqueue_script('instalink-lite');
}
add_action('wp_enqueue_scripts', 'elfsight_instalink_lite_lib');

?>