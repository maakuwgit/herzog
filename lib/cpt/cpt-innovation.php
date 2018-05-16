 <?php
/**
 * Register the Innovation custom post type
 */
if ( ! function_exists('register_innovation_custom_post_type') ) {

  // Register Custom Post Type
  function register_innovation_custom_post_type() {

    $labels = array(
      'name'                => 'Innovations',
      'singular_name'       => 'Innovation',
      'menu_name'           => 'Innovations',
      'parent_item_colon'   => 'Parent Innovation',
      'all_items'           => 'All Innovations',
      'view_item'           => 'View Innovation',
      'add_new_item'        => 'Add New Innovation',
      'add_new'             => 'New Innovation',
      'edit_item'           => 'Edit Innovation',
      'update_item'         => 'Update Innovation',
      'search_items'        => 'Search Innovation',
      'not_found'           => 'No innovations found',
      'not_found_in_trash'  => 'No innovations found in Trash',
    );
    $args = array(
      'label'               => 'innovation',
      'description'         => 'Innovation description',
      'labels'              => $labels,
      'supports'            => array( 'title', 'page-attributes' ),
      'hierarchical'        => true,
      'public'              => true,
      'show_ui'             => true,
      'show_in_menu'        => true,
      'show_in_nav_menus'   => true,
      'show_in_admin_bar'   => true,
      'menu_position'       => 3,
      'menu_icon'           => 'dashicons-lightbulb',
      'can_export'          => true,
      'has_archive'         => true,
      'exclude_from_search' => true,
      'publicly_queryable'  => true,
      'capability_type'     => 'post',
    );
    register_post_type( 'innovation', $args );

  }

  // Hook into the 'init' action
  add_action( 'init', 'register_innovation_custom_post_type', 0 );

}

/**
 * Custom taxonomies
 */
if ( ! function_exists('register_innovation_taxonomies') ) {

  function register_innovation_taxonomies() {

    // Add new taxonomy, make it hierarchical (like categories)
    $labels = array(
      'name'                => _x( 'Types', 'taxonomy general name' ),
      'singular_name'       => _x( 'Type', 'taxonomy singular name' ),
      'search_items'        => __( 'Search Types of Innovation' ),
      'all_items'           => __( 'All Types of Innovation' ),
      'parent_item'         => __( 'Parent Type' ),
      'parent_item_colon'   => __( 'Parent Type:' ),
      'edit_item'           => __( 'Edit Type' ),
      'update_item'         => __( 'Update Type' ),
      'add_new_item'        => __( 'Add New Type of Innovation' ),
      'new_item_name'       => __( 'New Innovation Type Name' ),
      'menu_name'           => __( 'Types' )
    );

    $args = array(
      'hierarchical'        => true,
      'labels'              => $labels,
      'show_ui'             => true,
      'show_admin_column'   => true,
      'query_var'           => false,
      'rewrite'             => array( 'slug' => 'innovation' )
    );

    register_taxonomy( 'innovations', array( 'innovation' ), $args ); // Must include custom post type name

  }

  add_action( 'init', 'register_innovation_taxonomies', 0 );

}