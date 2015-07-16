<?php
/*
Plugin Name: TCBD Tooltip
Plugin URI: http://demos.tcoderbd.com/wordpress_plugin/tcbdtooltip
Description: This plugin will enable tooltip in your Wordpress theme.
Author: Md Touhidul Sadeek
Version: 1.0
Author URI: http://tcoderbd.com
*/

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

// Define Plugin Directory
define('TCBD_PLUGIN_URL', WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/' );


// Hooks TCBD functions into the correct filters
function tcbd_add_mce_button() {
	// check user permissions
	if ( !current_user_can( 'edit_posts' ) && !current_user_can( 'edit_pages' ) ) {
		return;
	}
	// check if WYSIWYG is enabled
	if ( 'true' == get_user_option( 'rich_editing' ) ) {
		add_filter( 'mce_external_plugins', 'tcbd_add_tinymce_plugin' );
		add_filter( 'mce_buttons', 'tcmd_register_mce_button' );
	}
}
add_action('admin_head', 'tcbd_add_mce_button');

// Declare script for new button
function tcbd_add_tinymce_plugin( $plugin_array ) {
	$plugin_array['tcbd_mce_button'] = TCBD_PLUGIN_URL.'js/tinymce.js';
	return $plugin_array;
}

// Register new button in the editor
function tcmd_register_mce_button( $buttons ) {
	array_push( $buttons, 'tcbd_mce_button' );
	return $buttons;
}

function tcbd_tooltip_scripts(){
	// Latest jQuery WordPress
	wp_enqueue_script('jquery');

	// Tooltip jQuery js
	wp_enqueue_script('tcbdtooltip-toolip-js', TCBD_PLUGIN_URL.'js/tooltip.js', array('jquery'), '3.3.5', true);

	// Tooltip Active js
	wp_enqueue_script('tcbdtooltip-active-js', TCBD_PLUGIN_URL.'js/active.js', array('jquery', 'tcbdtooltip-toolip-js'), '1.0', true);

	// Tooltip CSS
	wp_register_style('tcbdtooltip-style-css', TCBD_PLUGIN_URL.'css/style.css');
	wp_enqueue_style('tcbdtooltip-style-css');
}
add_action('wp_enqueue_scripts', 'tcbd_tooltip_scripts');

// TCBD Tooltip Text Shortcode
function tcbd_tooltip_text( $atts, $content = null  ) {
	extract( shortcode_atts( array(
		'title' => '',
		'place' => 'top',
	), $atts ) );
	return '<span data-toggle="tooltip"  rel="tooltip" data-placement="'.$place.'" title="'.$title.'">'.$content.'</span>';
}	
add_shortcode('tcbdtooltip_text', 'tcbd_tooltip_text');

// TCBD Tooltip Text Shortcode
function tcbd_tooltip_link( $atts, $content = null  ) {
	extract( shortcode_atts( array(
		'title' => '',
		'place' => 'top',
		'url' => ''
	), $atts ) );
	return '<a rel="tooltip" title="'.$title.'" data-placement="'.$place.'" href="'.esc_url($url).'">'.$content.'</a>';
}	
add_shortcode('tcbdtooltip_link', 'tcbd_tooltip_link');
