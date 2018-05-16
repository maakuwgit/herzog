<?php
  if( function_exists( 'll_format_post_banner' ) ) {
    $headline = get_field( 'hero_text' );

    $hero = array(
      'headline'        => array(
        'text'  => $headline['text'],
        'tag'   => $headline['tag']
      ),
      'has_cta'     => get_field( 'hero_has_cta' ),
      'show_icons'  => get_field( 'hero_show_icons' ),
      'type'        => get_field( 'hero_type' ),
      'link'        => get_field( 'hero_button_link' ),
      'gallery'     => get_field( 'hero_gallery' ),
      'bg_image'    => get_field( 'hero_background_image' ),
      'loop_video'  => get_field( 'hero_loop_video' ),
      'popup_video' => get_field( 'hero_popup_video' )
    );

    ll_include_component(
      'hero',
      $hero
    );
  }
?>