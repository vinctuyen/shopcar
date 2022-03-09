<?php

	require get_template_directory() . '/inc/class-tgm-plugin-activation.php';
/**
 * Recommended plugins.
 */
function watch_store_register_recommended_plugins() {
	$plugins = array(
		array(
			'name'             => __( 'YITH WooCommerce Quick View', 'watch-store' ),
			'slug'             => 'yith-woocommerce-quick-view',
			'required'         => false,
			'force_activation' => false,
		),
	);
	$config = array();
	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'watch_store_register_recommended_plugins' );