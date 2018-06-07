<?php
/**
* Testimonial Grid
* -----------------------------------------------------------------------------
*
* Use this to show the testimonial component in a grid
*/

$default_data = [
  'num_testimonials'
];

$default_args = [
  'id' => uniqid('testimonial-grid-'),
  'classes' => array()
];

$data = ll_parse_args( $component_data, $default_data );
$args = ll_parse_args( $component_args, $default_args );

$targs = array(
  'posts_per_page' => -1,
  'order'          => 'ASC',
  'orderby'        => 'menu_order',
  'post_status'    => 'publish',
  'post_type'      => 'testimonial',
);

$testimonials = new WP_Query( $targs );

if( $testimonials->have_posts() ) :
$css = ' class="testimonial-grid';
if( $args['classes'] ) {
  if( is_array($args['classes'] ) ) {
    $css .= implode( " ", $args['classes'] );
  }else{
    $css .= ' ' . $args['classes'];
  }
}
$css .= '"';
$id = ($args['id'] ? ' id="' . $args['id'] . '"' : '');
?>
<section <?php echo $id . $css; ?> data-component="testimonial-grid">
  <div class="container row end">
    <header class="col">
      <h2>Testimonials</h2>
      <?php
        $button = [
          'link'    => array(
            'url'   => get_bloginfo('url') . '/team',
            'title' => 'Leadership Team'
          )
        ];

        ll_include_component(
          'button',
          $button
        );
        ?>
    </header>
  </div>
  <div class="row">
    <ul class="row no-bullet">
      <?php
        while ( $testimonials->have_posts() ) {
          $testimonials->the_post();
          include( locate_template('templates/partials/testimonial.php') );
        }
      ?>
      </ul>
<?php else: ?>
    <h4 class="col text-center">No images were selected for this Gallery with Copy</h4>
<?php endif; ?>
  </div>
  <footer class="container row">
    <div class="col col-md-6of12 col-lg-6of12 col-xl-6of12">
      <p class="small aluminum"><em>It is the policy of Herzog Contracting Corp. to provide equal opportunity in employment for all qualified individuals regardless of race, color, religion, ethnicity, national origin, ancestry, disability, medical condition, age, citizenship, sex, sexual orientation, gender,</em></p>
    </div>
    <div class="col col-md-6of12 col-lg-6of12 col-xl-6of12">
      <p class="small aluminum"><em>gender identity, gender expression, marital status, pregnancy, genetic information, military status, veteran status, and any other characteristic protected by law.</em></p>
    </div>
  </footer>
</section>
<?php wp_reset_postdata(); ?>