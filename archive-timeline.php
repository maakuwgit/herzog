<?php
$img_base_url = get_bloginfo('url') . '/wp-content/uploads/';

$yargs = array(
  'posts_per_page' => -1,
  'order'          => 'ASC',
  'orderby'        => 'menu_order',
  'post_status'    => 'publish',
  'post_type'      => 'timeline',
);

$years = new WP_Query( $yargs );
$first_image = '';
if( $years->have_posts() ) :
  while( $years->have_posts() ) :
    $years->the_post();
    if( ! $first_image ) $first_image = wp_get_attachment_metadata(get_post_thumbnail_id(get_the_ID()));
  endwhile;
  wp_reset_query();
?>
  <div class="hope-testimonial-columns" id="timeline" data-component="testimonial-columns" style="background-image: url(<?php echo $img_base_url . $first_image['file'];?> )">
<?php
  while( $years->have_posts() ) :
    $years->the_post();
    $division = 'HCC';//FPO
    $thumb = wp_get_attachment_metadata(get_post_thumbnail_id(get_the_ID()));
    if( !$thumb ) {
      $thumb = $args['client_hero'];
    }else{
      $thumb = array(
        'image' => array(
          'title' => $thumb['image_meta']['title'],
          'url' => $img_base_url . $thumb['file'],
          'sizes' => array(
            'full' => $img_base_url . $thumb['sizes']['large']['file'],
            'xlarge' => $img_base_url . $thumb['sizes']['large']['file'],
            'large' => $img_base_url . $thumb['sizes']['large']['file'],
            'medium' => $img_base_url . $thumb['sizes']['medium']['file'],
            'thumbnail' => $img_base_url . $thumb['sizes']['sm']['file']
          )
        )
      );
    }
?>

    <div class="hope-testimonial-columns__column" data-bg="<?php echo $thumb['image']['url']; ?>">

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