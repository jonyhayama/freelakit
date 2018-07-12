<?php
/*
Plugin Name: Freela Kit
Plugin URI: https://github.com/jonyhayama/freelakit
Description: A simple kit to help freelancers
Version: 0.1
Author: Jony Hayama
Author URI: http://jony.co
*/

define( 'FREELAKIT_PLUGIN_FILE', __FILE__ );
define( 'FREELAKIT_DIR_PATH', plugin_dir_path( __FILE__ ) );
define( 'FREELAKIT_PLUGIN_URL', plugins_url('', __FILE__ ) );
define( 'FREELAKIT_ASSETS_URL', FREELAKIT_PLUGIN_URL . '/assets' );

require_once( FREELAKIT_DIR_PATH . 'lib/carbon-fields/carbon-fields-plugin.php' );
require_once( FREELAKIT_DIR_PATH . 'class/freelakit.class.php' );

function freelakit( $module = '' ){
	static $_freelakit_obj = null;
	if( !$_freelakit_obj ){
		$_freelakit_obj = new FreelaKit();
	} 
	if( $module ){
		return $_freelakit_obj->getModule( $module );
	}
	return $_freelakit_obj;
}
freelakit();
