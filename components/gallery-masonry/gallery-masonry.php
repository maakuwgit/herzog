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
        'title' => 'Placeholder',
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

/*Dev Note: this variable will stagger the image.
It's totally functional :)
$handed = $args['cascade'];
*/
$handed = '';
$css = ' class="gallery-masonry' . $handed;
if( $args['classes'] ) {
  if( is_array($args['classes'] ) ) {
    $css .= implode( " ", $args['classes'] );
  }else{
    $css .= ' ' . $args['classes'];
  }
}
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
  <section<?php echo $id . $css; ?>" data-component="gallery-masonry">
    <div class="container row end">
      <?php if( $gallery ) : ?>
      <ul class="row no-bullet">
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