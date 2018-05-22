<?php
/**
 * Register the Client custom post type
 */
if ( ! function_exists('register_client_custom_post_type') ) {

  // Register Custom Post Type
  function register_client_custom_post_type() {

    $labels = array(
      'name'                => 'Clients',
      'singular_name'       => 'Client',
      'menu_name'           => 'Clients',
      'parent_item_colon'   => 'Parent Client',
      'all_items'           => 'All Clients',
      'view_item'           => 'View Client',
      'add_new_item'        => 'Add New Client',
      'add_new'             => 'New Client',
      'edit_item'           => 'Edit Client',
      'update_item'         => 'Update Client',
      'search_items'        => 'Search Client',
      'not_found'           => 'No Client found',
      'not_found_in_trash'  => 'No Client found in Trash',
    );
    $args = array(
      'label'               => 'Client',
      'description'         => 'Client description',
      'supports'            => array( 'title', 'thumbnail', 'editor', 'page-attributes' ),
      'labels'              => $labels,
      'with_front'          => true,
      'rewrite'             => array( 'slug' => 'client' ),
      'hierarchical'        => true,
      'public'              => true,
      'show_ui'             => true,
      'show_in_menu'        => true,
      'show_in_nav_menus'   => true,
      'show_in_admin_bar'   => true,
      'menu_position'       => 21,
      'menu_icon'           => 'dashicons-id-alt',
      'can_export'          => true,
      'has_archive'         => true,
      'exclude_from_search' => true,
      'publicly_queryable'  => true,
      'capability_type'     => 'post',
    );
    register_post_type( 'client', $args );

  }

  // Hook into the 'init' action
  add_action( 'init', 'register_client_custom_post_type', 0 );

}