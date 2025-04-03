<?php
/* ==========================================================================

========================================================================== */
/* Code to register jQuery,  css and js files
========================================================================== */
function theme_style_js() {
	if ( ! is_admin() ) {
		wp_deregister_script( 'jquery' );
		wp_register_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js' );
		wp_enqueue_script( 'jquery' );
	};
    wp_enqueue_script( 'init_js', get_template_directory_uri() . '/assets/js/main.js', array( 'jquery' ), '1.0', true );
    wp_enqueue_style( 'init_css', get_template_directory_uri() . '/assets/css/style.css' );

}

add_action( 'wp_enqueue_scripts', 'theme_style_js' );
