<?php
if (!defined('ABSPATH')) {
    /** Set up WordPress environment */
    require_once( dirname( __FILE__ ) . '/wp-load.php' );
}
if (isset($_GET['post_id'])) {
    echo siteorigin_panels_render(intval($_GET['post_id']));
    siteorigin_panels_print_inline_css();
}
