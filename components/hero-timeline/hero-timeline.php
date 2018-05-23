<?php
/**
* Hero Banner
* -----------------------------------------------------------------------------
*
* Creates a flexible image and video component that levages the gallery and
* anchor-nav components.
*/
$defaults = [
  'text' => array(
    'headline'     => 'Lorem Ipsum',
    'subheadline'  => 'Sin dolor',
  ),
  'bg_image'  => false
];

$args = [
  'id' => uniqid('hero-'),
  'classes' => array()
];

$data = ll_parse_args( $component_data, $defaults );
$args = ll_parse_args( $component_args, $args );

$text            = $data['text'];
$background      = $data['bg_image'];

$data_background = '';
if( $background ) {
  $data_background = ' data-background="'.$background['url'].'"';
}

$classes = ( $args['classes'] ? $args['classes'] : array() );
$classes = implode( " ", $classes );
if( !$classes ) {
  $classes = ' background';
}else{
  $classes = ' ' . $classes . ' background col-lg-6of12 col-xl-5of12';
}
/**
 * ID to apply to the main component container.
 *
 * @var array
 * @see args['id']
 */
$id   = $args['id'];
?>

<?php if ( ll_empty( $data ) ) return; ?>
<main class="content hero-timeline">
  <div class="wrapper row start">
    <h1 class="text-bold col col-lg-10of12 col-offset-2of12 center"><?php echo $text['headline']; ?></h1>
    <h2 class="text-normal col col-lg-10of12 col-offset-2of12 center"><?php echo $text['subheadline']; ?></h2>
    <picture class="picture col<?php echo $classes; ?>" <?php echo ( $id ? 'id="'.$id.'"' : '' ) ?> data-component="hero-timeline" <?php echo $data_background;?>>
      <div class="feature">
        <?php echo ll_format_image($background); ?>
      </div>
    </picture>
  </div>
  <div class="wrapper row start">
    <figure class="graphics col col-lg-10of12 col-offset-2of12 center">
      <?php echo get_mouse_icon(); ?>
      <?php echo get_finger_icon(); ?>
      <figcaption>
        <p>Scroll or click and drag to explore our company milestones &amp; innovations</p>
      </figcaption>
    </figure>
  </div>
</main>