<?php
/**
* Gallery w Copy
* -----------------------------------------------------------------------------
*
* gallery-w-copy component
*/

$default_data = [
  'gallery' => array(
    array(
      'gallery_headline' => 'Lorem Ipsum',
      'gallery_content'  => 'Dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
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
  'id'            => uniqid('gallery-w-copy-'),
  'classes'       => array()
];

$data = ll_parse_args( $component_data, $default_data );
$args = ll_parse_args( $component_args, $default_args );

//if ( ll_empty( $data ) ) return;
/*Dev Note: we are using placeholders, so show it even if it's empty for placement*/
$classes = $args['classes'] ?: array();
$id      = $args['id'];
$gallery = false;

if( sizeof($data['gallery']) > 0 ){
  if( $data['gallery'][0]['gallery_headline'] ) {
    $gallery = $data['gallery'];
  }else{
    $gallery = $default_data['gallery'];
  }
}
?>
  <section class="gallery-w-copy" data-component="gallery-w-copy">
    <div class="container row end">
      <?php if( $gallery ) : ?>
      <ul class="row no-bullet<?php echo implode( " ", $classes ); ?>" <?php echo ( $id ? 'id="'.$id.'"' : '' ) ?>>
        <?php foreach($gallery as $slide) : ?>
        <li class="col col-xs-6of12 col-sm-4of13 col-md-4of12 col-lg-4of12 col-xl-4of12">
          <figure>
            <div data-background>
              <div class="feature">
              <?php
                if($slide['gallery_image']) {
                  echo ll_format_image($slide['gallery_image']);
                }else{
                  echo ll_format_image($default_data['gallery'][0]['gallery_image']);
                } ?>
              </div>
            </div>
            <figcaption>
              <strong class="h5 text-normal block"><?php echo $slide['gallery_headline']; ?></strong>
              <?php echo format_text($slide['gallery_content']); ?>
            </figcaption>
          </figure>
        </li>
        <?php endforeach; ?>
      </ul>
    <?php else: ?>
      <h4 class="col text-center">No images were selected for this Gallery with Copy</h4>
    <?php endif; ?>
    </div>
  </section>