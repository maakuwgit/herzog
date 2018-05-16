<?php
/**
 * Register the Capability custom post type
 */
if ( ! function_exists('register_capability_custom_post_type') ) {

  // Register Custom Post Type
  function register_capability_custom_post_type() {

    $labels = array(
      'name'                => 'Capabilities',
      'singular_name'       => 'Capability',
      'menu_name'           => 'Capabilities',
      'parent_item_colon'   => 'Parent Capability',
      'all_items'           => 'All Capabilities',
      'view_item'           => 'View Capability',
      'add_new_item'        => 'Add New Capability',
      'add_new'             => 'New Capability',
      'edit_item'           => 'Edit Capability',
      'update_item'         => 'Update Capability',
      'search_items'        => 'Search Capability',
      'not_found'           => 'No capabilities found',
      'not_found_in_trash'  => 'No capabilities found in Trash',
    );
    $args = array(
      'label'               => 'capability',
      'description'         => 'Capability description',
      'labels'              => $labels,
      'supports'            => array( 'title', 'page-attributes' ),
      'hierarchical'        => true,
      'public'              => true,
      'show_ui'             => true,
      'show_in_menu'        => true,
      'show_in_nav_menus'   => true,
      'show_in_admin_bar'   => true,
      'menu_position'       => 2,
      'menu_icon'           => 'dashicons-admin-generic',
      'can_export'          => true,
      'has_archive'         => true,
      'exclude_from_search' => true,
      'publicly_queryable'  => true,
      'capability_type'     => 'post',
    );
    register_post_type( 'capability', $args );

  }

  // Hook into the 'init' action
  add_action( 'init', 'register_capability_custom_post_type', 0 );

}

/**
 * Custom taxonomies
 */
if ( ! function_exists('register_capability_taxonomies') ) {

  function register_capability_taxonomies() {

    // Add new taxonomy, make it hierarchical (like categories)
    $labels = array(
      'name'                => _x( 'Areas', 'taxonomy general name' ),
      'singular_name'       => _x( 'Area', 'taxonomy singular name' ),
      'search_items'        => __( 'Search Area of Expertise' ),
      'all_items'           => __( 'All Areas of Expertise' ),
      'parent_item'         => __( 'Parent Area' ),
      'parent_item_colon'   => __( 'Parent Area:' ),
      'edit_item'           => __( 'Edit Area' ),
      'update_item'         => __( 'Update Area' ),
      'add_new_item'        => __( 'Add New Area of Expertise' ),
      'new_item_name'       => __( 'New Expertise Area Name' ),
      'menu_name'           => __( 'Areas' )
    );

    $args = array(
      'hierarchical'        => true,
      'labels'              => $labels,
      'show_ui'             => true,
      'show_admin_column'   => true,
      'query_var'           => false,
      'rewrite'             => array( 'slug' => 'capabilities' )
    );

    register_taxonomy( 'capabilities', array( 'capability' ), $args ); // Must include custom post type name

  }

  add_action( 'init', 'register_capability_taxonomies', 0 );

}