<?php
  $band = array(
    'main_text'        => array( 'text' => get_the_title() ),
    'sub_text'         => array( 'text' => '' ),
    'call_to_action'   => array( 'url' => get_the_permalink(),
                                 'target' => '_self' ),
    'background_image' => array( get_the_post_thumbnail_url() ),
    'show_icons'       => false
  );

  ll_include_component(
    'band',
    $band
  );
?>