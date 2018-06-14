<?php
namespace FreelaKit\controller;
class People{
	public function __construct(){
		$this->add_hooks();
	}
	public function add_hooks(){
		add_action( 'init', array( $this, 'register_taxonomy' ) );
		add_action( 'init', array( $this, 'register_post_type' ) );
		add_action( 'admin_init', array( $this, 'add_custom_capabilities' ), 999 );
	}
	public function register_post_type(){
		$labels = array(
			'name'                  => _x( 'People', 'Post Type General Name', 'siscafe' ),
			'singular_name'         => _x( 'Person', 'Post Type Singular Name', 'siscafe' ),
			'menu_name'             => __( 'People', 'siscafe' ),
			'name_admin_bar'        => __( 'People', 'siscafe' ),
			'archives'              => __( 'Item Archives', 'siscafe' ),
			'attributes'            => __( 'Item Attributes', 'siscafe' ),
			'parent_item_colon'     => __( 'Parent Item:', 'siscafe' ),
			'all_items'             => __( 'All People', 'siscafe' ),
			'add_new_item'          => __( 'Add New Person', 'siscafe' ),
			'add_new'               => __( 'Add Person', 'siscafe' ),
			'new_item'              => __( 'New Person', 'siscafe' ),
			'edit_item'             => __( 'Edit Person', 'siscafe' ),
			'update_item'           => __( 'Update Person', 'siscafe' ),
			'view_item'             => __( 'View Person', 'siscafe' ),
			'view_items'            => __( 'View People', 'siscafe' ),
			'search_items'          => __( 'Search People', 'siscafe' ),
			'not_found'             => __( 'Not found', 'siscafe' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'siscafe' ),
			'featured_image'        => __( 'Featured Image', 'siscafe' ),
			'set_featured_image'    => __( 'Set featured image', 'siscafe' ),
			'remove_featured_image' => __( 'Remove featured image', 'siscafe' ),
			'use_featured_image'    => __( 'Use as featured image', 'siscafe' ),
			'insert_into_item'      => __( 'Insert into item', 'siscafe' ),
			'uploaded_to_this_item' => __( 'Uploaded to this item', 'siscafe' ),
			'items_list'            => __( 'Items list', 'siscafe' ),
			'items_list_navigation' => __( 'Items list navigation', 'siscafe' ),
			'filter_items_list'     => __( 'Filter items list', 'siscafe' ),
		);
		$capabilities = array(
			'edit_post'             => 'edit_person',
			'read_post'             => 'read_person',
			'delete_post'           => 'delete_person',
			'delete_posts'          => 'delete_person',
			'edit_posts'            => 'edit_people',
			'edit_others_posts'     => 'edit_others_people',
			'publish_posts'         => 'publish_people',
			'read_private_posts'    => 'read_private_people',
		);
		$args = array(
			'label'                 => __( 'Person', 'siscafe' ),
			'description'           => __( 'List of people', 'siscafe' ),
			'labels'                => $labels,
			'supports'              => array( 'title' ),
			'taxonomies'            => array( 'person_role' ),
			'hierarchical'          => false,
			'public'                => false,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'menu_icon'             => 'dashicons-id',
			'show_in_admin_bar'     => false,
			'show_in_nav_menus'     => false,
			'can_export'            => true,
			'has_archive'           => false,
			'exclude_from_search'   => true,
			'publicly_queryable'    => true,
			'capabilities'          => $capabilities,
			'show_in_rest'					=> true,
		);
		register_post_type( 'person', $args );
	}
	
	public function register_taxonomy(){
		
		$labels = array(
			'name'                       => _x( 'Person Roles', 'Taxonomy General Name', 'siscafe' ),
			'singular_name'              => _x( 'Person Role', 'Taxonomy Singular Name', 'siscafe' ),
			'menu_name'                  => __( 'Role', 'siscafe' ),
			'all_items'                  => __( 'All Person Roles', 'siscafe' ),
			'parent_item'                => __( 'Parent Item', 'siscafe' ),
			'parent_item_colon'          => __( 'Parent Item:', 'siscafe' ),
			'new_item_name'              => __( 'New Person Role', 'siscafe' ),
			'add_new_item'               => __( 'Add Person Role', 'siscafe' ),
			'edit_item'                  => __( 'Edit Person Role', 'siscafe' ),
			'update_item'                => __( 'Update Person Role', 'siscafe' ),
			'view_item'                  => __( 'View Person Role', 'siscafe' ),
			'separate_items_with_commas' => __( 'Separate items with commas', 'siscafe' ),
			'add_or_remove_items'        => __( 'Add or remove items', 'siscafe' ),
			'choose_from_most_used'      => __( 'Choose from the most used', 'siscafe' ),
			'popular_items'              => __( 'Popular Items', 'siscafe' ),
			'search_items'               => __( 'Search Items', 'siscafe' ),
			'not_found'                  => __( 'Not Found', 'siscafe' ),
			'no_terms'                   => __( 'No items', 'siscafe' ),
			'items_list'                 => __( 'Items list', 'siscafe' ),
			'items_list_navigation'      => __( 'Items list navigation', 'siscafe' ),
		);
		$capabilities = array(
			'manage_terms'               => 'manage_person_roles',
			'edit_terms'                 => 'manage_person_roles',
			'delete_terms'               => 'manage_person_roles',
			'assign_terms'               => 'edit_person',
		);
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => true,
			'public'                     => false,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => false,
			'show_tagcloud'              => false,
			'capabilities'               => $capabilities,
			'show_in_rest'               => true,
		);
		register_taxonomy( 'person_role', array( 'people' ), $args );
	}
	
	public function add_custom_capabilities(){
		// Add the roles you'd like to administer the custom post types
		$roles = array( 'editor', 'administrator' );
		// Loop through each role and assign capabilities
		foreach($roles as $the_role) { 
			$role = get_role($the_role);
			// Post Type
			$role->add_cap( 'edit_person' );
			$role->add_cap( 'read_person' );
			$role->add_cap( 'delete_person' );
			$role->add_cap( 'edit_people' );
			$role->add_cap( 'edit_others_people' );
			$role->add_cap( 'publish_people' );
			$role->add_cap( 'read_private_people' );
			// Taxonomy
			$role->add_cap( 'manage_person_roles' );
		}
	}
}