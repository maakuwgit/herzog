<?php
/**
 * Cleaner walker for wp_nav_menu()
 *
 * Walker_Nav_Menu (WordPress default) example output:
 *   <li id="menu-item-8" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-8"><a href="/">Home</a></li>
 *   <li id="menu-item-9" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-9"><a href="/sample-page/">Sample Page</a></l
 *
 * Roots_Nav_Walker example output:
 *   <li class="menu-home"><a href="/">Home</a></li>
 *   <li class="menu-sample-page"><a href="/sample-page/">Sample Page</a></li>
 */
class Roots_Nav_Walker extends Walker_Nav_Menu {
  private $curItem;

  function check_current($classes) {
    return preg_match('/(current[-_])|active|dropdown/', $classes);
  }

  function start_lvl(&$output, $depth = 0, $args = array()) {
    $output .= "\n<ul class=\" collapsed dropdown-menu wrapper\" id=\"dropdown-".$this->curItem."\"  data-content=\"collapse\">\n";
  }

  function end_lvl(&$output, $depth = 0, $args = array()) {
    if( $depth == 0 ) {
      //Since the sidebar is created dynamically, lets buffer the
      //output, then push it into a variable, then dump the output
      $output .= '<li class="news widget"><dl class="row">';
      ob_start();
      get_sidebar();
      $output .= ob_get_contents();
      ob_end_clean();
      $output .= '</dl></li>';
    }
    $output .= "</ul>";
  }

  function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
    $this->curItem = $item->ID;
    $item_html = '';
    parent::start_el($item_html, $item, $depth, $args);
    $menu = wp_get_nav_menu_object($args->menu);
    $menu_hero = get_field('menu_hero', $item);
    $is_mega = get_field('is_megamenu', $item);
    $use_sidebar = get_field('use_sidebar', $item);
    $title = $item->post_excerpt;
    $description = $item->post_content;
    if ($item->is_dropdown && ($depth === 0)) {
      $item_html = str_replace('<a', '<a class="dropdown-toggle" data-toggle="collapse" data-target="#dropdown-'.$item->ID.'"', $item_html);
      $item_html = str_replace('</a>', '<b class="caret"></b></a>', $item_html);
    }
    elseif (stristr($item_html, 'li class="divider')) {
      $item_html = preg_replace('/<a[^>]*>.*?<\/a>/iU', '', $item_html);
    }
    elseif (stristr($item_html, 'li class="dropdown-header')) {
      $item_html = preg_replace('/<a[^>]*>(.*)<\/a>/iU', '$1', $item_html);
    }
    if ( $menu_hero ) {
      $img = '<img alt="'.$menu_hero['title'].'" src="'.$menu_hero['url'].'">';
      if ( $title || $description ) {
        $content = '';
        if ( $title ) $content .= '<small class="text-bold">' . $title . '</small>';
        if ( $description ) $content .= format_text($description);
        $item_html .= '<figure>'.$img.'<figcaption>'.$content.'</figcaption></figure>';
      }else{
        $item_html .= $img;
      }
    }

    $item_html = apply_filters('roots/wp_nav_menu_item', $item_html);
    $output .= $item_html;
  }

  function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output) {
    $element->is_dropdown = ((!empty($children_elements[$element->ID]) && (($depth + 1) < $max_depth || ($max_depth === 0))));
    $element->is_mega     = get_field('is_megamenu', $element);
    $element->use_sidebar = get_field('use_sidebar', $element);

    if( $element->is_mega ) {
     $element->classes[] = 'mega_menu';
    }

    if( $element->use_sidebar ) {
     $element->classes[] = 'has_sidebar';
    }

    if ($element->is_dropdown) {
      $element->classes[] = 'dropdown';
    }

    parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
  }
}

/**
 * Remove the id="" on nav menu items
 * Return 'menu-slug' for nav menu classes
 */
function roots_nav_menu_css_class($classes, $item) {
  $slug = sanitize_title($item->title);
  $classes = preg_replace('/(current(-menu-|[-_]page[-_])(item|parent|ancestor))/', 'active', $classes);
  $classes = preg_replace('/^((menu|page)[-_\w+]+)+/', '', $classes);

  $classes[] = 'menu-item menu-' . $slug;

  $classes = array_unique($classes);

  //highlight custom post type nav menu. Excempt product because woocommerce already handles this
  if ( (get_post_type() !== 'post') && (get_post_type() !== 'page' && ( get_post_type() !== 'product' ) ) ) {
    $post_type = get_post_type();

    // remove unwanted classes if found
    $post_type_link = rtrim(get_post_type_archive_link($post_type),'/');
    $classes = str_replace( 'active', '', $classes );
    // find the url you want and add the class you want
    if ( $item->url == $post_type_link ) {
      $classes = str_replace( 'menu-'.$slug.'', 'menu-'.$slug.'. active', $classes );
    }
  }

  return array_filter($classes, 'is_element_empty');
}
add_filter('nav_menu_css_class', 'roots_nav_menu_css_class', 10, 2);
add_filter('nav_menu_item_id', '__return_null');

/**
 * Clean up wp_nav_menu_args
 *
 * Remove the container
 * Use Roots_Nav_Walker() by default
 */
function roots_nav_menu_args($args = '') {
  $roots_nav_menu_args = array();

  $roots_nav_menu_args['container'] = false;

  if (!$args['items_wrap']) {
    $roots_nav_menu_args['items_wrap'] = '<ul class="%2$s">%3$s</ul>';
  }

  if (!$args['depth']) {
    $roots_nav_menu_args['depth'] = 3;
  }

  if (!$args['walker']) {
    $roots_nav_menu_args['walker'] = new Roots_Nav_Walker();
  }

  return array_merge($args, $roots_nav_menu_args);
}
add_filter('wp_nav_menu_args', 'roots_nav_menu_args');
