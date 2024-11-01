<?php
/* Plugin Name: WP Custom Login logo & url
** Description: Automaticly changes wp-login logotype and url with your WP url and customize logo settings.
** Author: Joakim Marklund
** Version: 1.0
** Requires at least: 4.8
** Tested up to: 4.8
** Requires PHP: 5.6
** Stable tag: 1.0
** License: GPLv2 or later
** License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

// 1.1 Security: If file is accessed directly, make it die.
if ( ! defined( 'ABSPATH' ) ) exit;

// 1.1 Added: Check for: custom_logo_support
require_once( 'wp_custom_logo_support.php' );

// 1.1 Add: Change "Powered by WordPress", make it return with site title instead.
function wp_custom_login_url_name() {
    return get_bloginfo( 'name' );
}
add_filter( 'login_headertitle', 'wp_custom_login_url_name' );

// 1.0: Change the url to default WP blog url
function wp_custom_login_url ( $url ) {
    return get_bloginfo( 'url' );
}
add_filter( 'login_headerurl', 'wp_custom_login_url' );

// 1.0: Change the logo using default customize logotype in WP admin
function wp_custom_login_logo() {
    if ( has_custom_logo() ) :
        $image = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' );
        ?>
        <style type="text/css">
            .login h1 a {
                background-image: url(<?php echo esc_url( $image[0] ); ?>);
                -webkit-background-size: <?php echo absint( $image[1] )?>px;
                background-size: <?php echo absint( $image[1] ) ?>px;
                height: <?php echo absint( $image[2] ) ?>px;
                width: <?php echo absint( $image[1] ) ?>px;
            }
        </style>
        <?php
    endif;
}
add_action( 'login_head', 'wp_custom_login_logo', 100 );