<?php
class FreelaKit{
	public function __construct(){
		$this->load_classes();
	}
	
	public function load_classes(){
		require FREELAKIT_DIR_PATH . '/class/controller/people.class.php';
		$this->people = new FreelaKit\controller\People;
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