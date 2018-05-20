<?php
/**
 * Register the Testimonial custom post type
 */
if ( ! function_exists('register_testimonial_custom_post_type') ) {

  // Register Custom Post Type
  function register_testimonial_custom_post_type() {

    $labels = array(
      'name'                => 'Testimonials',
      'singular_name'       => 'Testimonial',
      'menu_name'           => 'Testimonials',
      'parent_item_colon'   => 'Parent Testimonial',
      'all_items'           => 'All Testimonials',
      'view_item'           => 'View Testimonial',
      'add_new_item'        => 'Add New Testimonial',
      'add_new'             => 'New Testimonial',
      'edit_item'           => 'Edit Testimonial',
      'update_item'         => 'Update Testimonial',
      'search_items'        => 'Search Testimonial',
      'not_found'           => 'No capabilities found',
      'not_found_in_trash'  => 'No capabilities found in Trash',
    );
    $args = array(
      'label'               => 'testimonial',
      'description'         => 'Testimonial description',
      'labels'              => $labels,
      'supports'            => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
      'hierarchical'        => true,
      'public'              => true,
      'show_ui'             => true,
      'show_in_menu'        => true,
      'show_in_nav_menus'   => false,
      'show_in_admin_bar'   => true,
      'menu_position'       => 2,
      'menu_icon'           => 'dashicons-id',
      'can_export'          => true,
      'has_archive'         => true,
      'exclude_from_search' => true,
      'publicly_queryable'  => true,
      'testimonial_type'     => 'post',
    );
    register_post_type( 'testimonial', $args );

  }

  // Hook into the 'init' action
  add_action( 'init', 'register_testimonial_custom_post_type', 0 );

}

/**
 * Create ACF setting page under CPT menu
 */
 if ( function_exists( 'acf_add_options_sub_page' ) ){
   acf_add_options_sub_page(array(
     'page_title' => 'Testimonial Settings',
     'menu_title' => 'Settings',
     'menu_slug'  => 'testimonial_settings',
     'parent'     => 'edit.php?post_type=testimonial',
     'capability' => 'manage_options'
   ));
 }