<?php
  if( function_exists( 'll_format_post_banner' ) ) {
    $cat = get_queried_object();
    $targets = array();

    $hero_banner = array(
      'headline'        => array(
        'text'  => $cat->label,
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

    $margs = array(
      'posts_per_page' => -1,
      'order'          => 'ASC',
      'orderby'        => 'menu_order',
      'post_status'    => 'publish',
      'post_type'      => 'team',
    );

    $members = new WP_Query( $margs );

    if( $members->have_posts() ) {
      while ( $members->have_posts() ) {
        $members->the_post();
        $targets[] = array(
          'anchor_btn_label' => get_the_title(),
          'anchor_btn_target' => '#'.basename(get_permalink())
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