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
<main class="hope-testimonial-columns" id="timeline" data-component="testimonial-columns" style="background-image: url(<?php echo $img_base_url . $first_image['file'];?> )" data-hover-panels>
<?php
  while( $years->have_posts() ) :
    $years->the_post();
    $division = 'HCC';//FPO
    $thumb = wp_get_attachment_metadata(get_post_thumbnail_id(get_the_ID()));
    if( !$thumb ) {
      $thumb = false;//Dev Note: add placeholder $args['client_hero'];
      var_dump($thumb);
    }else{
      $thumb = array(
        'title' => $thumb['image_meta']['title'],
        'url' => $img_base_url . $thumb['file'],
        'sizes' => array(
          'full' => $img_base_url . $thumb['sizes']['large']['file'],
          'xlarge' => $img_base_url . $thumb['sizes']['large']['file'],
          'large' => $img_base_url . $thumb['sizes']['large']['file'],
          'medium' => $img_base_url . $thumb['sizes']['medium']['file'],
          'thumbnail' => $img_base_url . $thumb['sizes']['sm']['file']
        )
      );
    }
?>

    <figure class="panel hope-testimonial-columns__column" data-background>
      <div class="feature"><?php echo ll_format_image($thumb); ?></div>
      <span class="hope-testimonial-columns__tab sub-heading"><?php echo $division; ?></span>

      <div class="hope-testimonial-columns__intro">

        <h2 class="display-heading"><?php the_title(); ?></h2>
        <h3 class="sub-heading"><?php echo $division; ?></h3>
        <?php the_excerpt(); ?>
        <?php
          $button = array(
            'icon'    => 'plus',
            'theme'   => 'light',
            'link'    => array(
                'title'   => '',
                'url'     => '#hover',
                'target'  => '_self'
              )
          );

          ll_include_component(
            'button',
            $button,
            array(
              'classes' => array('button-open open-testimonial')
            )
          );
        ?>
      </div> <!-- /.hope-testimonial-columns__intro -->

      <div class="hope-testimonial-columns__main">

        <div class="hope-testimonial-columns__main-info">
          <h2 class="display-heading"><?php the_title(); ?></h2>
          <h3 class="sub-heading"><?php echo $division; ?></h3>
        </div>

        <?php echo the_content(); ?>

      </div> <!-- /.hope-testimonial-columns__main -->

      <button class="close-testimonial"></button>
    </figure> <!-- /.hope-testimonial-columns__column -->

  <?php endwhile; wp_reset_query();?>
</main>
<?php endif; ?>