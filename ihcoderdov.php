<?php
/*
Plugin Name: Ihcoderdov Theme Plugin
Plugin URI:
Description: Ihcoderdov Theme Plugin
Version: 1.0
Author: Masum Sakib
Author URI: 
License: GPLv2 or later
Text Domain: ihcoderdov
Domain Path: languages
*/

// Exit if accessed directly				
if ( !defined( 'ABSPATH' ) ) {
    exit;
}


function ihcoderdov_load_textdomain(){
	load_plugin_textdomain('ihcoderdov',false,dirname(__FILE__)."/languages");
}
add_action('plugins_loaded','ihcoderdov_load_textdomain');


/* Set the constant path to the plugin directory URI. */
define( 'IHCODERDOV_URI', trailingslashit( plugin_dir_url( __FILE__ ) ) );

/* Set plugin version constant. */
define( 'IHCODERDOV_VERSION', time() );

/* Set constant path to the plugin directory. */
define( 'IHCODERDOV_PATH', trailingslashit( plugin_dir_path( __FILE__ ) ) );

// Assets Folder URL
define( 'IHCODERDOV_ASSETS', plugins_url( 'assets/', __FILE__ ) );


//Init Including
require_once( IHCODERDOV_PATH . 'init.php' );

       
//---------------------------------
 

