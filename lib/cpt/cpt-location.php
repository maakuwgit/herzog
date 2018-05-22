<?php
/**
 * Register the Location custom post type
 */
if ( ! function_exists('register_location_custom_post_type') ) {

  // Register Custom Post Type
  function register_location_custom_post_type() {

    $labels = array(
      'name'                => 'Divisions',
      'singular_name'       => 'Division',
      'menu_name'           => 'Divisions',
      'parent_item_colon'   => 'Parent Division',
      'all_items'           => 'All Divisions',
      'view_item'           => 'View Division',
      'add_new_item'        => 'Add New Division',
      'add_new'             => 'New Division',
      'edit_item'           => 'Edit Division',
      'update_item'         => 'Update Division',
      'search_items'        => 'Search Division',
      'not_found'           => 'No division found',
      'not_found_in_trash'  => 'No divisions found in Trash',
    );
    $args = array(
      'label'               => 'division',
      'description'         => 'Division description',
      'labels'              => $labels,
      'supports'            => array( 'title' ),
      'hierarchical'        => true,
      'public'              => true,
      'show_ui'             => true,
      'show_in_menu'        => true,
      'show_in_nav_menus'   => true,
      'show_in_admin_bar'   => true,
      'menu_position'       => 2,
      'menu_icon'           => 'dashicons-location-alt',
      'can_export'          => true,
      'has_archive'         => true,
      'exclude_from_search' => false,
      'publicly_queryable'  => true,
      'capability_type'     => 'post',
    );
    register_post_type( 'location', $args );

  }

  // Hook into the 'init' action
  add_action( 'init', 'register_location_custom_post_type', 0 );

}

/**
 * Custom taxonomies
 */
if ( ! function_exists('register_state_taxonomy') ) {

  function register_state_taxonomy() {

    // Add new taxonomy, make it hierarchical (like categories)
    $labels = array(
      'name'                => _x( 'Locations', 'taxonomy general name' ),
      'singular_name'       => _x( 'Location', 'taxonomy singular name' ),
      'search_items'        => __( 'Search Locations' ),
      'all_items'           => __( 'All Locations' ),
      'parent_item'         => __( 'Parent Location' ),
      'parent_item_colon'   => __( 'Parent Location:' ),
      'edit_item'           => __( 'Edit Location' ),
      'update_item'         => __( 'Update Location' ),
      'add_new_item'        => __( 'Add New Location' ),
      'new_item_name'       => __( 'New Location Name' ),
      'menu_name'           => __( 'Locations' )
    );

    $args = array(
      'hierarchical'        => true,
      'labels'              => $labels,
      'public'              => true,
      'show_ui'             => true,
      'show_admin_column'   => true,
      'query_var'           => true,
      'rewrite'             => array( 'slug' => 'location' )
    );
    register_taxonomy( 'location_state', array( 'location' ), $args ); // Must include custom post type name

  }

  add_action( 'init', 'register_state_taxonomy', 0 );

}
if ( ! function_exists('register_location_group_taxonomy') ) {

  function register_location_group_taxonomy() {

    // Add new taxonomy, make it hierarchical (like categories)
    $labels = array(
      'name'                => _x( 'Groups', 'taxonomy general name' ),
      'singular_name'       => _x( 'Group', 'taxonomy singular name' ),
      'search_items'        => __( 'Search Location Group' ),
      'all_items'           => __( 'All Groups' ),
      'parent_item'         => __( 'Parent Group' ),
      'parent_item_colon'   => __( 'Parent Group:' ),
      'edit_item'           => __( 'Edit Group' ),
      'update_item'         => __( 'Update Group' ),
      'add_new_item'        => __( 'Add New Group' ),
      'new_item_name'       => __( 'New Group Name' ),
      'menu_name'           => __( 'Groups' )
    );

    $args = array(
      'hierarchical'        => false,
      'labels'              => $labels,
      'public'              => true,
      'show_ui'             => true,
      'show_admin_column'   => true,
      'query_var'           => true,
      'rewrite'             => array( 'slug' => 'location_group' )
    );
//Dev Note: potentional crash here, shouldn't happen but just might....
    register_taxonomy( 'location_group', array( 'location' ), $args ); // Must include custom post type name

  }

  add_action( 'init', 'register_location_group_taxonomy', 0 );

}