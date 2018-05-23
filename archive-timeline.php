<?php
if( function_exists( 'll_format_post_banner' ) ) {
  $cat = get_queried_object();
  $targets = array();
  $headline = get_field('timeline_archive_hero_text', 'options' );
  if( !$headline['headline'] ) {
    $headline['headline'] = get_bloginfo('title') . ' ' . ucfirst($cat->name);
  }
  $text = array(
    'headline'    => $headline['headline'],
    'subheadline' => $headline['subheadline']
  );

  $hero_banner = array(
    'text'          => array(
      'headline'    => $text['headline'],
      'subheadline' => $text['subheadline']
    ),
    'bg_image'    => get_field( 'timeline_archive_background_image', 'options' )
  );

  ll_include_component(
    'hero-timeline',
    $hero_banner,
    array(
      'targets' => $targets
    )
  );
}

$img_base_url = get_bloginfo('url') . '/wp-content/uploads/';

$yargs = array(
  'posts_per_page' => -1,
  'order'          => 'ASC',
  'orderby'        => 'slug',
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
<div class="hope-testimonial-columns row start" id="timeline" data-component="testimonial-columns" style="background-image: url(<?php echo $img_base_url . $first_image['file'];?> )" data-hover-panels>
<?php
  while( $years->have_posts() ) :
    $years->the_post();
    $division = 'HCC';//FPO
    $thumb = wp_get_attachment_metadata(get_post_thumbnail_id(get_the_ID()));
    if( !$thumb ) {
      $thumb = false;//Dev Note: add placeholder $args['client_hero'];
    }else{
      $thumb = array(
        'title' => $thumb['image_meta']['title'],
        'url' => $img_base_url . $thumb['file'],
        'sizes' => array(
          'full' => $img_base_url . $thumb['file'],
          'xlarge' => $img_base_url . $thumb['file'],
          'large' => $img_base_url . $thumb['file'],
          'medium' => $img_base_url . $thumb['file'],
          'thumbnail' => $img_base_url . $thumb['file']
        )
      );
    }

    $tags = '';
    $groups = get_the_terms(get_the_ID(), 'type');
    if( is_array( $groups ) ) {
      $tags = '<ul class="no-bullet tags">';
      foreach( $groups as $group ) {
        $tags .= '<li class="aluminum"><b>' . $group->name . '</b></li>';
      }
      $tags .= '</ul>';
    }else{
      $groups = '';
    }
?>

    <div class="panel hope-testimonial-columns__column col col-md-6of12 col-lg-3of12 col-xl-3of12 stretch" data-background>
      <div class="feature"><?php echo ll_format_image($thumb); ?></div>

      <section class="hope-testimonial-columns__intro row">
        <div class="col">
          <h2><?php the_title(); ?></h2>
          <h3><?php echo $division; ?></h3>
          <?php the_excerpt(); ?>
          <?php echo $tags; ?>
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
        </div>
      </section> <!-- /.hope-testimonial-columns__intro -->

      <article class="hope-testimonial-columns__main row">
        <div class="col">
        <?php
            echo the_content();

            $button = array(
              'link'    => array(
                  'title'   => 'Learn More',
                  'url'     => get_the_permalink(),
                  'target'  => '_self'
                )
            );

            ll_include_component(
              'button',
              $button,
              array(
                'classes' => array('button-cta')
              )
            );

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
                'classes' => array('button-close close-testimonial')
              )
            );
          ?>
          </div>
      </article> <!-- /.hope-testimonial-columns__main -->
    </div> <!-- /.hope-testimonial-columns__column -->
  <?php endwhile; wp_reset_query();?>
</div>
<?php endif; ?>