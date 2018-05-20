<?php
/**
* gallery
* -----------------------------------------------------------------------------
*
* gallery component
*/

$default_data = [
  'gallery' => array()
];

$default_args = [
  'id'            => uniqid('gallery-'),
  'classes'       => array(),
  'is_hero'       => false,
  'is_fullwidth'  => false,
  'nav_id'        => uniqid('gallery_nav-')
];

$data = ll_parse_args( $component_data, $default_data );
$args = ll_parse_args( $component_args, $default_args );

if ( ll_empty( $data ) ) return;

$classes = $args['classes'] ?: array();

$gallery      = $data['gallery'];
$is_hero      = $args['is_hero'];
$nav_id       = $args['nav_id'];
$fullwidth    = ( $args['is_fullwidth'] ? ' fullwidth' : '');

$css = 'class="col slick-carousel gallery';
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
<?php if( !$is_hero ) : ?>
  <section class="slideshow<?php echo $fullwidth; ?>">
    <div class="container row end">
<?php endif; ?>
  <div<?php echo $id . $css; ?> data-component="gallery" data-gallery-nav="<?php echo $nav_id; ?>">
    <?php foreach($gallery as $slides) : ?>
      <?php $slide = $slides['gallery_image'];?>
      <?php echo ll_format_image($slide); ?>
  <?php endforeach; ?>
  </div>
<?php if( !$is_hero ) : ?>
    </div>
  </section>
  <?php if( sizeof($gallery) > 0 ) : ?>
    <?php include( locate_template('templates/partials/navigation-gallery.php') ); ?>
  <?php endif; ?>
<?php endif; ?>
<?php
/**
 * component_name_after_display hook
 * Type: Action
 */
do_action( "component_name_after_display", $data, $args ); ?>
