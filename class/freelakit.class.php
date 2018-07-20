<?php
class FreelaKit{
	public function __construct(){
		add_action( 'plugins_loaded', array( $this, 'load_carbon_fields' ) );
		add_action( 'plugins_loaded', array( $this, 'load_plugin_textdomain') );
		
		$this->load_classes();
	}
	
	public function load_classes(){
		require FREELAKIT_DIR_PATH . 'class/customizations/custom-wp-admin.class.php';
		$this->custom_wp_admin = new FreelaKit\customizations\WPAdmin;
		
		require FREELAKIT_DIR_PATH . 'class/controller/people.class.php';
		$this->people = new FreelaKit\controller\People;
		
		require FREELAKIT_DIR_PATH . 'class/controller/project.class.php';
		$this->project = new FreelaKit\controller\Project;
	}
	
	public function load_carbon_fields(){
		require FREELAKIT_DIR_PATH . 'lib/carbon-fields/vendor/autoload.php';
		\Carbon_Fields\Carbon_Fields::boot();
	}
	
	public function load_plugin_textdomain(){
		load_plugin_textdomain( 'freelakit', false, basename( dirname( FREELAKIT_PLUGIN_FILE ) ) . '/languages' ); 
	}
	
	public function getModule( $module ){
		if( property_exists( $this, $module ) ){
			return $this->$module;
		}
	}
	public function getPluginInfo( $info = '' ){
		if( !$this->pluginInfo ){
			$this->pluginInfo = get_plugin_data( FREELAKIT_DIR_PATH . 'siscafe.php' );
		}
		if( $info ){
			return $this->pluginInfo[$info];
		}
		return $this->pluginInfo;
	}
	public function getVersion(){
		return $this->getPluginInfo( 'Version' );
	}
}