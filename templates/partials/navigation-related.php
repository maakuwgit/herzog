<?php
  $links = get_field('relationships');
  if( $links ) {
    ll_include_component(
      'related-nav',
      array(
        'links' => $links
      )
    );
  }
?>