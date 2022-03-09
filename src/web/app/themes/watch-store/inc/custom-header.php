<?php
/**
 * @package Watch Store
 * Setup the WordPress core custom header feature.
 *
 * @uses watch_store_header_style()
*/
function watch_store_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'watch_store_custom_header_args', array(
		'default-text-color'     => 'fff',
		'header-text' 			 =>	false,
		'width'                  => 1200,
		'height'                 => 85,
		'flex-width'         	=> true,
        'flex-height'        	=> true,
		'wp-head-callback'       => 'watch_store_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'watch_store_custom_header_setup' );

if ( ! function_exists( 'watch_store_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see watch_store_custom_header_setup().
 */
add_action( 'wp_enqueue_scripts', 'watch_store_header_style' );
function watch_store_header_style() {
	//Check if user has defined any header image.
	if ( get_header_image() ) :
	$watch_store_custom_css = "
        .mid-header{
			background-image:url('".esc_url(get_header_image())."');
			background-position: center top;
			background-size: 100% 100%;
		}";
	   	wp_add_inline_style( 'watch-store-basic-style', $watch_store_custom_css );
	endif;
}
endif; // watch_store_header_style