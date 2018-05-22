<?php
  if( function_exists( 'll_format_post_banner' ) ) {
    $cat = get_queried_object();
    $targets = array();

    $hero_banner = array(
      'headline'        => array(
        'text'  => 'Herzog News',
        'tag'   => 'h1'
      ),
      'has_cta'     => get_field( 'archive_has_cta', 'options' ),
      'show_icons'  => get_field( 'archive_show_icons', 'options' ),
      'type'        => get_field( 'archive_type', 'options' ),
      'link'        => get_field( 'archive_button_link', 'options' ),
      'gallery'     => get_field( 'archive_gallery', 'options' ),
      'bg_image'    => get_field( 'archive_background_image', 'options' ),
      'loop_video'  => get_field( 'archive_loop_video', 'options' ),
      'popup_video' => get_field( 'archive_popup_video', 'options' )
    );

    $cats = get_categories();

    if( $cats ) {
      foreach ( $cats as $anchor ) {
        $targets[] = array(
          'anchor_btn_label' => $anchor->name,
          'anchor_btn_target' => '#'.$anchor->slug
        );
      }
    }

    ll_include_component(
      'hero-w-nav',
      $hero_banner,
      array(
        'targets' => $targets
      )
    );
  }
?>