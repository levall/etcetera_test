<?php
/* ==========================================================================
THEME TWEAKS
- Code to register jQuery,  css and js files
- Register multiple widgets
- Add support for post thumbnails
- Add SVG in Media Uploader
- Redirect to homepage from login logo
- Set permalink structure to %postname% !!!!!!!!!
- Add class to empty paragraph
- Adding Page URL to the Pages in Admin Table
- Update wp-scss settings
========================================================================== */
/* Code to register jQuery,  css and js files
========================================================================== */
function simple_theme_style_js() {
	wp_deregister_style( 'contact-form-7' );
	wp_deregister_style( 'wp-pagenavi' );
	if ( ! is_admin() ) {
		wp_deregister_script( 'jquery' );
		wp_register_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js' );
		wp_enqueue_script( 'jquery' );
	};
    wp_enqueue_script( 'init_js', get_template_directory_uri() . '/assets/js/main.js', array( 'jquery' ), '1.0', true );
    wp_enqueue_script( 'fancybox_js', '//cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js');
    wp_enqueue_style( 'init_css', get_template_directory_uri() . '/assets/css/style.css' );
    wp_enqueue_style( 'fancybox_css', '//cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css' );

    //if you want to test something - directly on prod - uncomment this
    //wp_enqueue_style( 'init_theme_css', get_template_directory_uri() . '/style.css' );
}

add_action( 'wp_enqueue_scripts', 'simple_theme_style_js' );



/* Add support for post thumbnails
   ========================================================================== */

add_theme_support( 'post-thumbnails' );


/* Add SVG in Media Uploader
   ========================================================================== */
function wpa_mime_types( $mimes ) {
	$mimes['svg'] = 'image/svg+xml';

	return $mimes;
}

add_filter( 'upload_mimes', 'wpa_mime_types' );
function wpa_fix_svg_thumb() {
	echo '<style>td.media-icon img[src$=".svg"], img[src$=".svg"].attachment-post-thumbnail {width: 100% !important;height: auto !important}</style>';
}

add_action( 'admin_head', 'wpa_fix_svg_thumb' );


/* ==========================================================================
Remove Unnecessary parts from Wordpress core
- Unnecessary Code from wp_head
- Remove wp version param from any enqueued scripts
- Dashboard wigets
- Default wigets
- WordPress logo & pages from Admin bar
- <p> and <br /> from Contact Form 7
========================================================================== */
/* Remove Unnecessary Code from wp_head
   ========================================================================== */
remove_action( 'wp_head', 'rsd_link' ); // Really Simple Discovery
remove_action( 'wp_head', 'wlwmanifest_link' ); // Windows Live Writer
remove_action( 'wp_head', 'wp_generator' ); // WordPress Generator
remove_action( 'wp_head', 'rel_canonical' ); // canonical tag meta
// Post Relational Links
remove_action( 'wp_head', 'start_post_rel_link' );
remove_action( 'wp_head', 'index_rel_link' );
remove_action( 'wp_head', 'adjacent_posts_rel_link' );
// Emoji
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
function remove_json_api() {
	// Remove the REST API lines from the HTML Header
	remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
	remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );
	// Remove the REST API endpoint.
	remove_action( 'rest_api_init', 'wp_oembed_register_route' );
	// Turn off oEmbed auto discovery.
	add_filter( 'embed_oembed_discover', '__return_false' );
	// Don't filter oEmbed results.
	remove_filter( 'oembed_dataparse', 'wp_filter_oembed_result', 10 );
	// Remove oEmbed discovery links.
	remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
	// Remove oEmbed-specific JavaScript from the front-end and back-end.
	remove_action( 'wp_head', 'wp_oembed_add_host_js' );
	// Remove all embeds rewrite rules.
	// remove HTML meta tag
	remove_action( 'wp_head', 'wp_shortlink_wp_head', 10 );
	// remove HTTP header
	remove_action( 'template_redirect', 'wp_shortlink_header', 11 );
}

add_action( 'after_setup_theme', 'remove_json_api' );

/* Remove dashboard wigets
   ========================================================================== */
function remove_dash_widgets() {
	remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_primary', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_secondary', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_quick_press', 'dashboard', 'normal' );
}

add_action( 'admin_init', 'remove_dash_widgets' );
/* Remove default wigets
   ========================================================================== */
function remove_default_widgets() {
	unregister_widget( 'WP_Widget_Archives' );
	unregister_widget( 'WP_Widget_Calendar' );
	// unregister_widget( 'WP_Widget_Categories' );
	unregister_widget( 'WP_Nav_Menu_Widget' );
	unregister_widget( 'WP_Widget_Links' );
	unregister_widget( 'WP_Widget_Meta' );
	unregister_widget( 'WP_Widget_Pages' );
	unregister_widget( 'WP_Widget_Recent_Comments' );
	unregister_widget( 'WP_Widget_Recent_Posts' );
	unregister_widget( 'WP_Widget_RSS' );
	unregister_widget( 'WP_Widget_Search' );
	unregister_widget( 'WP_Widget_Tag_Cloud' );
	// unregister_widget( 'WP_Widget_Text' );
}

add_action( 'widgets_init', 'remove_default_widgets' );