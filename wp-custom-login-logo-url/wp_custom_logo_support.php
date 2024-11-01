<?php // 1.1: Add: Check if theme has custom logo support, else add it.
function wp_custom_login_custom_logo_support() {
    if ( function_exists( 'custom-logo' ) ) {
        the_custom_logo();
    } else {
        add_theme_support( 'custom-logo' );
    }
}
add_action( 'after_setup_theme', 'wp_custom_login_custom_logo_support' );