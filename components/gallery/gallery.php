<?php
/**
* gallery
* -----------------------------------------------------------------------------
*
* gallery component
*/

$default_data = [
  'gallery' => array(
    array(
      'gallery_image' => array(
        'title' => 'Placeholder',
        'url' => '//via.placeholder.com/1280x1024',
        'sizes' => array(
          'full' => '//via.placeholder.com/1280x1024',
          'xlarge' => '//via.placeholder.com/1600x1200',
          'large' => '//via.placeholder.com/1024x768',
          'medium' => '//via.placeholder.com/968x660',
          'thumbnail' => '//via.placeholder.com/640x560'
        )
      )
    )
  )
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

//if ( ll_empty( $data ) ) return;

$classes = $args['classes'] ?: array();

$is_hero      = $args['is_hero'];
$nav_id       = $args['nav_id'];
$fullwidth    = ( $args['is_fullwidth'] ? ' fullwidth' : '');

$css = ' class="col slick-carousel gallery';
if( $args['classes'] ) {
  if( is_array($args['classes'] ) ) {
    $css .= implode( " ", $args['classes'] );
  }else{
    $css .= ' ' . $args['classes'];
  }
}
$css .= '"';
$id = ($args['id'] ? ' id="' . $args['id'] . '"' : '');

$gallery = false;

if( sizeof($data['gallery']) > 0 ){
  if( $data['gallery'][0]['gallery_image'] ) {
    $gallery = $data['gallery'];
  }else{
    foreach( $data['gallery'] as $temp ){
      $gallery[] = $default_data['gallery'][0];
    }
  }
}
?>
<?php if( !$is_hero ) : ?>
  <section<?php echo $id;?> class="slideshow<?php echo $fullwidth; ?>">
    <div class="container row end">
<?php endif; ?>
      <div<?php echo $css; ?> data-component="gallery" data-gallery-nav="<?php echo $nav_id; ?>" style="width:100%;display:block;align-items: initial;flex: 0 0 auto;">
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
