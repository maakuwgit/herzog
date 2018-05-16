<?php
    $callout = array(
      'headline'  => get_field('prefooter_headline'),
      'subheadline'  => get_field('prefooter_subheadline'),
      'link'      => get_field('prefooter_button')
    );

    ll_include_component(
      'callout',
      $callout,
      array(
        'classes' => array('row')
      )
    );
?>