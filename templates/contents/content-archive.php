<section class="content light-bg">
  <div class="container row centered">
<?php
  $args = array(
    'numberposts' => 9,
    'post_status' => 'publish',
    'post_type'   => 'post',
  );

  $articles = new WP_Query( $args );

  while ( $articles->have_posts() ) {
    $articles->the_post();
    include( locate_template('templates/partials/thumbnail.php') );
  }

  wp_reset_postdata();
?>
  </div>
</section>