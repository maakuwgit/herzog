<?php
/**
* gallery-masonry
* -----------------------------------------------------------------------------
*
* gallery-masonry component
*/

$default_data = [
  'gallery' => array(
    array(
      'gallery_image' => array(
        'title' => 'Image 1',
        'url' => '//via.placeholder.com/1200x805',
        'sizes' => array(
          'full' => '//via.placeholder.com/1200x805',
          'xlarge' => '//via.placeholder.com/800x550',
          'large' => '//via.placeholder.com/600x402',
          'medium' => '//via.placeholder.com/400x275',
          'thumbnail' => '//via.placeholder.com/200x135'
        )
      )
    ),
    array(
      'gallery_image' => array(
        'title' => 'Image 1',
        'url' => '//via.placeholder.com/1200x805',
        'sizes' => array(
          'full' => '//via.placeholder.com/1200x805',
          'xlarge' => '//via.placeholder.com/800x550',
          'large' => '//via.placeholder.com/600x402',
          'medium' => '//via.placeholder.com/400x275',
          'thumbnail' => '//via.placeholder.com/200x135'
        )
      )
    ),
    array(
      'gallery_image' => array(
        'title' => 'Image 1',
        'url' => '//via.placeholder.com/1200x805',
        'sizes' => array(
          'full' => '//via.placeholder.com/1200x805',
          'xlarge' => '//via.placeholder.com/800x550',
          'large' => '//via.placeholder.com/600x402',
          'medium' => '//via.placeholder.com/400x275',
          'thumbnail' => '//via.placeholder.com/200x135'
        )
      )
    )
  )
];

$default_args = [
  'id'            => uniqid('gallery-masonry-'),
  'classes'       => array(),
  'cascade'     => 'center'
];

$data = ll_parse_args( $component_data, $default_data );
$args = ll_parse_args( $component_args, $default_args );

//if ( ll_empty( $data ) ) return;
/*Dev Note: we are using placeholders, so show it even if it's empty for placement*/
$classes = $args['classes'] ?: array();
$id      = $args['id'];
$gallery = false;

if( sizeof($data['gallery']) > 0 ){
  if( $data['gallery'][0]['gallery_image'] ) {
    $gallery = $data['gallery'];
  }else{
    $gallery = $default_data['gallery'];
  }
}

$handed = $args['cascade'];
?>
  <section class="gallery-masonry <?php echo $handed; ?>" data-component="gallery-masonry">
    <div class="container row end">
      <?php if( $gallery ) : ?>
      <ul class="row no-bullet<?php echo implode( " ", $classes ); ?>" <?php echo ( $id ? 'id="'.$id.'"' : '' ) ?>>
        <?php foreach($gallery as $slides) : ?>
        <li class="brick col col-sm-6of12 col-md-4of12 col-lg-4of12 col-xl-4of12">
          <picture class="picture" data-background>
            <?php $slide = $slides['gallery_image'];?>
            <div class="feature">
            <?php echo ll_format_image($slide); ?>
            </div>
          </picture>
        </li>
        <?php endforeach; ?>
      </ul>
    <?php else: ?>
      <p>No images were selected for this Masonry Gallery</p>
    <?php endif; ?>
    </div>
  </section>