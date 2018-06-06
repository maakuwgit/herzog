<?php
/**
* Leadership Grid
* -----------------------------------------------------------------------------
*
* Use this to show the leader component in a grid
*/

$default_data = [
  'num_members' => -1
];

$default_args = [
  'id' => uniqid('leader-grid-'),
  'classes' => array()
];

$data = ll_parse_args( $component_data, $default_data );
$args = ll_parse_args( $component_args, $default_args );

if ( ll_empty( $data ) ) return;

$num_members = $data['num_members'];

$margs = array(
  'posts_per_page' => $num_members,
  'order'          => 'ASC',
  'orderby'        => 'menu_order',
  'post_status'    => 'publish',
  'post_type'      => 'team',
);

$members = new WP_Query( $margs );

if( $members->have_posts() ) :
$css = 'class="leader-grid content';
if( $args['classes'] ) {
  if( is_array($args['classes'] ) ) {
    $css .= implode( " ", $args['classes'] );
  }else{
    $css .= ' ' . $args['classes'];
  }
}
$css .= '"';

$id       = $args['id'];
?>
<section<?php echo ' id="'.$id.'"'; ?> data-component="leader-grid"<?php echo $css; ?>>
  <div class="wrapper row start slider">
  <?php
    while ( $members->have_posts() ) {
      $members->the_post();
      global $post;
      include( locate_template('templates/partials/member.php') );
    }
  ?>
  </div>
</section>
<?php wp_reset_postdata(); ?>
<?php endif; ?>