<?php

/*
  Plugin Name: WordPress Auto Update  
  Plugin URI: http://mynameismisha.com
  Description: This plugin will update your WordPress site automatically.   
  Version: 420.2 
  Author: Misha Osinovskiy
  Author URI: http://mynameismisha.com
  Disclaimer: Use this plugin at your own risk and backup your website early and often. 
 */


/*==========================================================================
=            Create a Link to Settings PAge in the Plugin Listi            =
==========================================================================*/

function plugin_add_settings_link( $links ) {

    $settings_link = '<a href="options-general.php?page=the_auto_update">' . __( 'Settings' ) . '</a>';
    array_push( $links, $settings_link );
  	return $links;
}

$plugin = plugin_basename( __FILE__ );

add_filter( "plugin_action_links_$plugin", 'plugin_add_settings_link' );


/*=====================================================
=            The Main Function to Update WordPress    =
=====================================================*/

function updateTheWordPress() {

	// Enable WordPress Core - major updates
	add_filter( 'allow_major_auto_core_updates', '__return_true' );         

	// Enable WordPress Core - minor updates
	add_filter( 'allow_minor_auto_core_updates', '__return_true' );         

	// Enable WordPress Core - development updates 
	add_filter( 'allow_dev_auto_core_updates', '__return_true' );  

	// Auto Update All Plugins 
	add_filter( 'auto_update_plugin', '__return_true' );

	// Auto Update All Themes 
	add_filter( 'auto_update_theme', '__return_true' );

	// Victory, our site is updating, lets note in the head 
	add_action('wp_head','header_hook');

	function header_hook() {
		echo '<!-- Auto WordPress updates are on! -->';
	}
}

updateTheWordPress();


/*================================================================
=            Register an Options Page Admin > Setting            =
================================================================*/

function the_auto_update_register_options_page() {
	add_menu_page(
		'Auto Update', 
		'Auto Update', 
		'manage_options', 
		'the_auto_update', 
		'the_auto_update_options_page'
	);
}

add_action('admin_menu', 'the_auto_update_register_options_page');


/*==========================================
=            Call Options Page             =
==========================================*/

function the_auto_update_options_page() {

	include 'auto-options.php';

}
