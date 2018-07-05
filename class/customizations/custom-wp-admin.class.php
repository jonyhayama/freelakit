<?php
namespace FreelaKit\customizations;
class WPAdmin{
	public function __construct(){
		$this->add_hooks();
	}
  
	public function add_hooks(){
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
	}
  	
	public function admin_enqueue_scripts(){
		wp_enqueue_style( 'freelakit-custom-wp-admin', FREELAKIT_ASSETS_URL . '/css/custom-wp-admin.css', array(), '1.0' );
// 		wp_enqueue_script( 'freelakit-custom-wp-admin', FREELAKIT_ASSETS_URL . '/js/custom-wp-admin.js', array('jquery'), '1.0', true );
	}
}
