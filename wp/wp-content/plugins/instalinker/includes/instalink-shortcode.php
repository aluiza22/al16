<?php

if (!defined('ABSPATH')) exit;

// shortcode [instalink]
function elfsight_instalink_lite_shortcode($atts) {
    global $elfsight_instalink_lite_defaults;

    extract(shortcode_atts($defaults = $elfsight_instalink_lite_defaults, $atts, 'instalink'), EXTR_SKIP);

    $access_token = get_option('instalink_instagram_access_token', '');

    // params for compatibility with previous versions
    $old_access_token = get_option('instalinker_instagram_access_token', '');

    if (empty($access_token)) {
        $access_token = $old_access_token;
    }

    return '<div
        data-il ' .
        (!empty($access_token) ? 'data-il-access-token="' . esc_attr($access_token) . '" ' : '') . '
        data-il-width="' . (!empty($width) ? esc_attr($width) : '') . '"
        data-il-height="' . (!empty($height) ? esc_attr($height) : '') . '"
        data-il-image-size="' . (!empty($image_size) ? esc_attr($image_size) : '') . '"
        data-il-bg-color="' . (!empty($bg_color) ? esc_attr($bg_color) : '') . '">
    </div>';
}
add_shortcode('instalink', 'elfsight_instalink_lite_shortcode');

// [instalinker] shortcode for compatibility with previous versions
add_shortcode('instalinker', 'elfsight_instalink_lite_shortcode');

?>