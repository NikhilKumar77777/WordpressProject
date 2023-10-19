<?php
/**
 * Add theme page
 */
function gutenify_hustle_menu() {
	add_theme_page( esc_html__( 'Gutenify Hustle', 'gutenify-hustle' ), esc_html__( 'Gutenify Theme', 'gutenify-hustle' ), 'edit_theme_options', 'gutenify-hustle-info', 'gutenify_hustle_theme_page_display' );
}
add_action( 'admin_menu', 'gutenify_hustle_menu' );

/**
 * Display About page
 */
function gutenify_hustle_theme_page_display() {
	$theme = wp_get_theme();

	if ( is_child_theme() ) {
		$theme = wp_get_theme()->parent();
	}

	include_once 'templates/theme-info.php';
}

function gutenify_hustle_admin_plugin_notice() {
	$hide_notice_bar = get_user_meta( get_current_user_id(), 'gutenify_hustle_hide_theme_info_noticebar', true );
	if ( '1' !== $hide_notice_bar ) {
		include 'templates/admin-plugin-notice.php';
	}
}
add_action( 'admin_notices', 'gutenify_hustle_admin_plugin_notice' );


function gutenify_hustle_hide_theme_info_noticebar() {
	check_ajax_referer( 'gutenify_hustle-nonce', 'gutenify_hustle-nonce-name' );
	if ( ! current_user_can( 'edit_theme_options' ) ) {
		wp_die( -1 );
	}

	update_user_meta( get_current_user_id(), 'gutenify_hustle_hide_theme_info_noticebar', 1 );

	wp_die( 1 );
}
add_action( 'wp_ajax_gutenify_hustle_hide_theme_info_noticebar', 'gutenify_hustle_hide_theme_info_noticebar' );
