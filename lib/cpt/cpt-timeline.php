<?php
/**
 * Register the Timeline custom post type
 */
if ( ! function_exists('register_timeline_custom_post_type') ) {

  // Register Custom Post Type
  function register_timeline_custom_post_type() {

    $labels = array(
      'name'                => 'Timeline',
      'singular_name'       => 'Timeline',
      'menu_name'           => 'Timeline',
      'parent_item_colon'   => 'Parent Timeline',
      'all_items'           => 'All Years',
      'view_item'           => 'View Year',
      'add_new_item'        => 'Add New Year',
      'add_new'             => 'New Year',
      'edit_item'           => 'Edit Year',
      'update_item'         => 'Update Year',
      'search_items'        => 'Search Year',
      'not_found'           => 'No year found',
      'not_found_in_trash'  => 'No year found in Trash',
    );
    $args = array(
      'label'               => 'timeline',
      'description'         => 'Timeline description',
      'supports'            => array( 'title', 'excerpt', 'editor', 'thumbnail', 'page-attributes' ),
      'labels'              => $labels,
      'with_front'          => true,
      'rewrite'             => array( 'slug' => 'timeline' ),
      'hierarchical'        => true,
      'public'              => true,
      'show_ui'             => true,
      'show_in_menu'        => true,
      'show_in_nav_menus'   => false,
      'show_in_admin_bar'   => true,
      'menu_position'       => 21,
      'menu_icon'           => 'dashicons-chart-area',
      'can_export'          => true,
      'has_archive'         => true,
      'exclude_from_search' => true,
      'publicly_queryable'  => true,
      'capability_type'     => 'post',
    );
    register_post_type( 'timeline', $args );

  }

  // Hook into the 'init' action
  add_action( 'init', 'register_timeline_custom_post_type', 0 );

}

/**
 * Custom taxonomies
 */
if ( ! function_exists('register_timeline_taxonomies') ) {

  function register_timeline_taxonomies() {

    // Add new taxonomy, make it hierarchical (like categories)
    $labels = array(
      'name'                => _x( 'Timeline Types', 'taxonomy general name' ),
      'singular_name'       => _x( 'Type', 'taxonomy singular name' ),
      'search_items'        => __( 'Search Types' ),
      'all_items'           => __( 'All Types' ),
      'parent_item'         => __( 'Parent Type' ),
      'parent_item_colon'   => __( 'Parent Type:' ),
      'edit_item'           => __( 'Edit Type' ),
      'update_item'         => __( 'Update Type' ),
      'add_new_item'        => __( 'Add New Type' ),
      'new_item_name'       => __( 'New Type Name' ),
      'menu_name'           => __( 'Types' )
    );

    $args = array(
      'hierarchical'        => false,
      'labels'              => $labels,
      'show_ui'             => true,
      'show_admin_column'   => true,
      'query_var'           => true,
      'rewrite'             => array( 'slug' => 'timeline' )
    );

    register_taxonomy( 'type', array( 'timeline' ), $args ); // Must include custom post type name

  }

  add_action( 'init', 'register_timeline_taxonomies', 0 );

}