<?php
/**
* gallery-masonry
* -----------------------------------------------------------------------------
*
* gallery-masonry component
*/

$default_data = [
  'gallery' => array()
];

$default_args = [
  'id'            => uniqid('gallery-masonry-'),
  'classes'       => array()
];

$data = ll_parse_args( $component_data, $default_data );
$args = ll_parse_args( $component_args, $default_args );

if ( ll_empty( $data ) ) return;

$classes = $args['classes'] ?: array();
$id      = $args['id'];

$gallery      = $data['gallery'];
?>
  <section class="gallery-masonry lefty" data-component="gallery-masonry">
    <div class="container row end">
      <ul class="row no-bullet<?php echo implode( " ", $classes ); ?>" <?php echo ( $id ? 'id="'.$id.'"' : '' ) ?>>
        <?php foreach($gallery as $slides) : ?>
        <li class="brick col col-sm-6of12 col-md-4of12 col-lg-4of12 col-xl-4of12">
          <picture data-background>
            <?php $slide = $slides['gallery_image'];?>
            <div class="feature">
            <?php echo ll_format_image($slide); ?>
            </div>
          </picture>
        </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </section>