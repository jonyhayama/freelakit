<?php
namespace FreelaKit\controller;
use \Carbon_Fields\Container;
use \Carbon_Fields\Field;

class People{
	public function __construct(){
		$this->add_hooks();
	}
	public function add_hooks(){
		add_action( 'init', array( $this, 'register_taxonomy' ) );
		add_action( 'init', array( $this, 'register_post_type' ) );
		add_action( 'admin_init', array( $this, 'add_custom_capabilities' ), 999 );
		
		add_action( 'plugins_loaded', array( $this, 'register_fields' ) );
	}
	public function register_post_type(){
		$labels = array(
			'name'                  => _x( 'People', 'Post Type General Name', 'freelakit' ),
			'singular_name'         => _x( 'Person', 'Post Type Singular Name', 'freelakit' ),
			'menu_name'             => __( 'People', 'freelakit' ),
			'name_admin_bar'        => __( 'People', 'freelakit' ),
			'archives'              => __( 'Item Archives', 'freelakit' ),
			'attributes'            => __( 'Item Attributes', 'freelakit' ),
			'parent_item_colon'     => __( 'Parent Item:', 'freelakit' ),
			'all_items'             => __( 'All People', 'freelakit' ),
			'add_new_item'          => __( 'Add New Person', 'freelakit' ),
			'add_new'               => __( 'Add Person', 'freelakit' ),
			'new_item'              => __( 'New Person', 'freelakit' ),
			'edit_item'             => __( 'Edit Person', 'freelakit' ),
			'update_item'           => __( 'Update Person', 'freelakit' ),
			'view_item'             => __( 'View Person', 'freelakit' ),
			'view_items'            => __( 'View People', 'freelakit' ),
			'search_items'          => __( 'Search People', 'freelakit' ),
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
			'label'                 => __( 'Person', 'freelakit' ),
			'description'           => __( 'List of people', 'freelakit' ),
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
			'name'                       => _x( 'Person Roles', 'Taxonomy General Name', 'freelakit' ),
			'singular_name'              => _x( 'Person Role', 'Taxonomy Singular Name', 'freelakit' ),
			'menu_name'                  => __( 'Roles', 'freelakit' ),
			'all_items'                  => __( 'All Person Roles', 'freelakit' ),
			'parent_item'                => __( 'Parent Item', 'freelakit' ),
			'parent_item_colon'          => __( 'Parent Item:', 'freelakit' ),
			'new_item_name'              => __( 'New Person Role', 'freelakit' ),
			'add_new_item'               => __( 'Add Person Role', 'freelakit' ),
			'edit_item'                  => __( 'Edit Person Role', 'freelakit' ),
			'update_item'                => __( 'Update Person Role', 'freelakit' ),
			'view_item'                  => __( 'View Person Role', 'freelakit' ),
			'separate_items_with_commas' => __( 'Separate items with commas', 'freelakit' ),
			'add_or_remove_items'        => __( 'Add or remove items', 'freelakit' ),
			'choose_from_most_used'      => __( 'Choose from the most used', 'freelakit' ),
			'popular_items'              => __( 'Popular Items', 'freelakit' ),
			'search_items'               => __( 'Search Items', 'freelakit' ),
			'not_found'                  => __( 'Not Found', 'freelakit' ),
			'no_terms'                   => __( 'No items', 'freelakit' ),
			'items_list'                 => __( 'Items list', 'freelakit' ),
			'items_list_navigation'      => __( 'Items list navigation', 'freelakit' ),
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
	
	public function get_roles_assoc_array(){
		$array = array();
		$terms = get_terms( array(
			'taxonomy' => 'person_role',
			'hide_empty' => false
		) );
		foreach( $terms as $term ){
			$array[$term->term_id] = $term->name;
		}
		return $array;
	}
	
	public function register_fields(){
		Container::make( 'post_meta', __( 'Person Info', 'freelakit' ) )
			->where( 'post_type', '=', 'person' )
			->add_tab( __( 'Profile', 'freelakit' ), array(
				Field::make( 'select', 'person_role', __( 'Person Role', 'frelakit' ) )->set_options( array( $this, 'get_roles_assoc_array' ) ),
			) );
	}
}