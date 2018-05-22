<?php
$yargs = array(
  'posts_per_page' => -1,
  'order'          => 'ASC',
  'orderby'        => 'menu_order',
  'post_status'    => 'publish',
  'post_type'      => 'timeline',
);

$years = new WP_Query( $yargs );

if( $years->have_posts() ) :
  while( $years->have_posts() ) :
    $years->the_post();
?>
  Year here
<?php
  endwhile;
endif;
?>