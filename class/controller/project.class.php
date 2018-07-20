<?php
namespace FreelaKit\controller;
use \Carbon_Fields\Container;
use \Carbon_Fields\Field;

class Project{
	public function __construct(){
		$this->add_hooks();
	}
	public function add_hooks(){
		add_action( 'init', array( $this, 'register_post_type' ) );
		add_action( 'admin_init', array( $this, 'add_custom_capabilities' ), 999 );
		
// 		add_action( 'plugins_loaded', array( $this, 'register_fields' ) );
	}
	
	// Register Custom Post Type
	public function register_post_type() {
		$labels = array(
			'name'                  => _x( 'Projects', 'Post Type General Name', 'freelakit' ),
			'singular_name'         => _x( 'Project', 'Post Type Singular Name', 'freelakit' ),
			'menu_name'             => __( 'Projects', 'freelakit' ),
			'name_admin_bar'        => __( 'Project', 'freelakit' ),
			'archives'              => __( 'Item Archives', 'freelakit' ),
			'attributes'            => __( 'Item Attributes', 'freelakit' ),
			'parent_item_colon'     => __( 'Parent Item:', 'freelakit' ),
			'all_items'             => __( 'All Items', 'freelakit' ),
			'add_new_item'          => __( 'Add New Item', 'freelakit' ),
			'add_new'               => __( 'Add New', 'freelakit' ),
			'new_item'              => __( 'New Item', 'freelakit' ),
			'edit_item'             => __( 'Edit Item', 'freelakit' ),
			'update_item'           => __( 'Update Item', 'freelakit' ),
			'view_item'             => __( 'View Item', 'freelakit' ),
			'view_items'            => __( 'View Items', 'freelakit' ),
			'search_items'          => __( 'Search Item', 'freelakit' ),
			'not_found'             => __( 'Not found', 'freelakit' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'freelakit' ),
			'featured_image'        => __( 'Featured Image', 'freelakit' ),
			'set_featured_image'    => __( 'Set featured image', 'freelakit' ),
			'remove_featured_image' => __( 'Remove featured image', 'freelakit' ),
			'use_featured_image'    => __( 'Use as featured image', 'freelakit' ),
			'insert_into_item'      => __( 'Insert into item', 'freelakit' ),
			'uploaded_to_this_item' => __( 'Uploaded to this item', 'freelakit' ),
			'items_list'            => __( 'Items list', 'freelakit' ),
			'items_list_navigation' => __( 'Items list navigation', 'freelakit' ),
			'filter_items_list'     => __( 'Filter items list', 'freelakit' ),
		);
		$rewrite = array(
			'slug'                  => 'project',
			'with_front'            => true,
			'pages'                 => true,
			'feeds'                 => true,
		);
		$capabilities = array(
			'edit_post'             => 'edit_project',
			'read_post'             => 'read_project',
			'delete_post'           => 'delete_project',
			'delete_posts'          => 'delete_project',
			'edit_posts'            => 'edit_projects',
			'edit_others_posts'     => 'edit_others_projects',
			'publish_posts'         => 'publish_projects',
			'read_private_posts'    => 'read_private_projects',
		);
		$args = array(
			'label'                 => __( 'Project', 'freelakit' ),
			'description'           => __( 'Projects', 'freelakit' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'editor', 'thumbnail' ),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'menu_icon'             => 'dashicons-format-aside',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'rewrite'               => $rewrite,
			'capabilities'          => $capabilities,
		);
		register_post_type( 'project', $args );
	}
	
	public function add_custom_capabilities(){
		// Add the roles you'd like to administer the custom post types
		$roles = array( 'editor', 'administrator' );
		// Loop through each role and assign capabilities
		foreach($roles as $the_role) { 
			$role = get_role($the_role);
			// Post Type
			$role->add_cap( 'edit_project' );
			$role->add_cap( 'read_project' );
			$role->add_cap( 'delete_project' );
			$role->add_cap( 'edit_projects' );
			$role->add_cap( 'edit_others_projects' );
			$role->add_cap( 'publish_projects' );
			$role->add_cap( 'read_private_projects' );
		}
	}
}