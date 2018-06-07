<?php
  if( function_exists( 'll_format_post_banner' ) ) {
    $cat = get_queried_object();
    $targets = array();

    $button = array(
      'text' => 'About Herzog Careers',
      'target' => '_self',
      'label' => 'About Herzog Careers',
      'url' => get_bloginfo('url') . '/careers/'
    );

    $hero_banner = array(
      'headline'        => array(
        'text'  => 'Open Positions',
        'tag'   => 'h1'
      ),
      'has_cta'     => true,
      'button'      => $button,
      'show_icons'  => get_field( 'career-archive_show_icons', 'options' ),
      'type'        => get_field( 'career-archive_type', 'options' ),
      'gallery'     => get_field( 'career-archive_gallery', 'options' ),
      'bg_image'    => get_field( 'career-archive_background_image', 'options' ),
      'loop_video'  => get_field( 'career-archive_loop_video', 'options' ),
      'popup_video' => get_field( 'career-archive_popup_video', 'options' )
    );


    ll_include_component(
      'hero-w-nav',
      $hero_banner
    );
  }
?>