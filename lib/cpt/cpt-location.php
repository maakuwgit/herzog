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
      'name'                => _x( 'States', 'taxonomy general name' ),
      'singular_name'       => _x( 'State', 'taxonomy singular name' ),
      'search_items'        => __( 'Search States' ),
      'all_items'           => __( 'All States' ),
      'parent_item'         => __( 'Parent State' ),
      'parent_item_colon'   => __( 'Parent State:' ),
      'edit_item'           => __( 'Edit State' ),
      'update_item'         => __( 'Update State' ),
      'add_new_item'        => __( 'Add New State' ),
      'new_item_name'       => __( 'New State Name' ),
      'menu_name'           => __( 'States' )
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
//Dev Note: potentional crash here, shouldn't happen but just might....
    register_taxonomy( 'location_state', array( 'location' ), $args ); // Must include custom post type name

  }

  add_action( 'init', 'register_state_taxonomy', 0 );

}