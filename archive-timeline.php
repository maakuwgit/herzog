<?php
$yargs = array(
  'posts_per_page' => -1,
  'order'          => 'ASC',
  'orderby'        => 'menu_order',
  'post_status'    => 'publish',
  'post_type'      => 'timeline',
);

$years = new WP_Query( $yargs );

if( $years->have_posts() ) : ?>
  <div class="hope-testimonial-columns" id="timeline" data-component="testimonial-columns">
<?php
  while( $years->have_posts() ) :
    $years->the_post();
    $division = 'HCC';//FPO
    $thumb = false;
     //style="background-image: url(<?php echo get_the_post_thumbnail($years[0]->ID); )"
?>

    <div class="hope-testimonial-columns__column" data-bg="<?php echo $thumb; ?>">

      <span class="hope-testimonial-columns__tab sub-heading"><?php echo $division; ?></span>

      <div class="hope-testimonial-columns__intro">

        <h5 class="display-heading"><?php the_title(); ?></h5>
        <h6 class="sub-heading"><?php echo $division; ?></h6>

        <button class="open-testimonial"></button>
        <button class="open-close-testimonial"></button>

      </div> <!-- /.hope-testimonial-columns__intro -->

      <div class="hope-testimonial-columns__main">

        <div class="hope-testimonial-columns__main-info">
          <h5 class="display-heading"><?php the_title(); ?></h5>
          <h6 class="sub-heading"><?php echo $division; ?></h6>
        </div>

        <?php echo the_content(); ?>

      </div> <!-- /.hope-testimonial-columns__main -->

      <button class="close-testimonial"></button>

    </div> <!-- /.hope-testimonial-columns__column -->

  <?php endwhile; wp_reset_query();?>
</div> <!-- /.hope-testimonial-columns -->
<?php endif; ?>