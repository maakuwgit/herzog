<?php
/**
 * Roots initial setup and constants
 */
function roots_setup() {
  // Enable plugins to manage the document title
  // http://codex.wordpress.org/Function_Reference/add_theme_support#Title_Tag
  add_theme_support('title-tag');

  // Register wp_nav_menu() menus
  // http://codex.wordpress.org/Function_Reference/register_nav_menus
  register_nav_menus(array(
    'primary_navigation' => __('Main Navigation', 'roots'),
    'secondary_navigation' => __('Page Navigation', 'roots')
  ));

  //Register the sidebar that we're using int he primary nav
  register_sidebar(array(
    'name' => __('Primary Nav News', 'll'),
    'id'   => 'sidebar-primary-news',
    'description' => __('This sidebar holds the widgets for the primary nav. Any MegaMenu can showcase widgets'),
    'before_widget' => '',
    'after_widget' => '',
    'before_article' => '<dd class="col col-md-6of12 col-lg-6of12 col-xl-6of12 stretch">',
    'after_article' => '</dd>',
    'before_title' => '<dt class="widgettitle col col-md-6of12 col-lg-6of12 col-xl-6of12">',
    'after_title' => '</dt>'
  ));

  // Add post thumbnails
  // http://codex.wordpress.org/Post_Thumbnails
  // http://codex.wordpress.org/Function_Reference/set_post_thumbnail_size
  // http://codex.wordpress.org/Function_Reference/add_image_size
  add_theme_support('post-thumbnails');
  add_image_size( 'sm', 768, 480 );
  add_image_size( 'xs', 480, 320 );
  add_image_size( 'xxs', 400, 300 );
  // Add post formats
  // http://codex.wordpress.org/Post_Formats
  // add_theme_support('post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'video', 'audio'));

  // Add HTML5 markup for captions
  // http://codex.wordpress.org/Function_Reference/add_theme_support#HTML5
  add_theme_support('html5', array('caption','gallery'));

  // Tell the TinyMCE editor to use a custom stylesheet
  add_editor_style('/assets/css/editor-style.css');
}
add_action('after_setup_theme', 'roots_setup');


//Now let's register the widgets
function ll_register_widget() {
  register_widget( 'Recent_Articles' );
}
add_action( 'widgets_init', 'll_register_widget' );
/**
 * Show/Hide/Modify Existing post types
 */
function roots_remove_menu_item() {
  global $menu;
  global $submenu;
  remove_menu_page( 'edit-comments.php' ); //Removing the Comments (unused)
  $menu[5][0] = 'News';
  $menu[5][6] = 'dashicons-media-document';
  $submenu['edit.php'][5][0] = 'Articles';
  $submenu['edit.php'][10][0] = 'Add Article';
 }
 add_action( 'admin_menu', 'roots_remove_menu_item' );

/**
 * Modify 'Post' page, tooltip and titles to say something else
 */
function roots_admin_labels() {
  global $wp_post_types;
  $labels = &$wp_post_types['post']->labels;
  $labels->name = 'News';
  $labels->singular_name = 'Article';
  $labels->add_new = 'Add Article';
  $labels->add_new_item = 'Add Article';
  $labels->edit_item = 'Edit Article';
  $labels->new_item = 'Article';
  $labels->view_item = 'View Article';
  $labels->search_items = 'Search Articles';
  $labels->not_found = 'No Articles found';
  $labels->not_found_in_trash = 'No Articles found in Trash';
 }
 add_action( 'init', 'roots_admin_labels' );