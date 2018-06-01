<?php
$data = '["test", [';
$pargs    = array(
              'post_type'     => 'project',
              'post_status'   => 'publish',
              'order'         => 'ASC',
              'showposts'     => -1
            );

$projects = new WP_Query( $pargs );

if ( $projects->have_posts() ) {
  while( $projects->have_posts() ) {
    $projects->the_post();

    $latitude   = get_field('city_latitude');
    $longitude  = get_field('city_longitude');
    $magnitude  = get_field('city_magnitude');
    $slug       = get_post_field( 'post_name', get_post() );

    if( $magnitude && $latitude && $longitude ) {
      $data .= $longitude . ', ' . $latitude . ', ' . $magnitude;
    }
  }
}
$data .= ']]';
echo json_encode($data);
?>