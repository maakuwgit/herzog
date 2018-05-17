<?php
/**
* Banner
* -----------------------------------------------------------------------------
*
* Only the image, video and slideshow markup.
*/
$defaults = [
  'headline' => array(
    'text' => null,
    'tag'  => 'h1'
  ),
  'type'    => 'image',
  'has_cta' => false,
  'button' => null,
  'bg_image'  => false,
  'gallery'   => false,
  'loop_video'    => null,
  'popup_video'   => null
];

$args = [
  'id' => uniqid('banner-'),
  'nav_id' => uniqid('gallery-'),
  'classes' => array(),
  'is_hero'    => false
];

$data = ll_parse_args( $component_data, $defaults );
$args = ll_parse_args( $component_args, $args );

$headline        = $data['headline'];
$button          = $data['button'];
$gallery         = $data['gallery'];
$loop_video      = $data['loop_video'];
$popup_video     = $data['popup_video'];
$background      = $data['bg_image'];
$type            = $data['type'];

$data_background = '';
if( $background &&  $type === 'image' ) {
  $data_background = ' data-background="'.$background['url'].'"';
}
$css = ' class="picture col';
if( is_array($args['classes'] ) ) {
  $css .= implode( " ", $args['classes'] );
}else{
  $css .= ' ' . $args['classes'];
}
if( !$css ) {
  if( $type === 'image' ) {
    $css = ' background';
  }else{
    $css = ' col-lg-8of12 col-xl-9of12 col-offset-lg-4of12 col-offset-xl-3of12';
  }
}else{
  $css = ' ' . $css . ' col-lg-9of12 col-xl-8of12';
}
$css .= '"';

/**
 * ID to apply to the main component container.
 *
 * @var array
 * @see args['id']
 */
$id   = $args['id'];
$nav_id = $args['nav_id'];
?>

<?php if ( ll_empty( $data ) ) return; ?>
<picture<?php echo $css; ?> <?php echo ( $id ? 'id="'.$id.'"' : '' ) ?> data-component="hero" data-gallery-nav="<?php echo $nav_id; ?>"<?php echo $data_background;?>>
  <?php if ( $type === 'image' && $background ) : ?>
  <div class="feature">
    <?php echo ll_format_image($background); ?>
  </div>
  <?php elseif ( $loop_video ) : ?>
    <?php
      ll_include_component(
        'loop-video',
        array(
          'video' => $loop_video,
          'fallback' => $gallery[0]
        )
      );
    ?>
  <?php endif; ?>
  <?php
  if ( $button ) {
      ll_include_component(
        'button',
        array(
        'icon'    => 'chevron',
        'theme'   => 'light',
        'target'  => $button['target'],
        'text'    => 'Learn More',
        'link'    => array(
            'title' => $button['label'],
            'href'  => $button['url']
          )
        )
      );
    }

    if ( $popup_video ) {
      ll_include_component(
        'button',
        array(
        'icon'    => 'chevron',
        'theme'   => 'light',
        'target'  => $button['target'],
        'text'    => 'Play Video',
        'link'    => array(
            'title' => $button['label'],
            'href'  => $popup_video
          )
        ),
        array(
          'classes' => array('play-video-button js-init-video')
        )
      );
    }

    if( sizeof($gallery) > 0 ) {
      ll_include_component(
        'gallery',
        array(
          'gallery' => $gallery
        ),
        array(
          'nav_id'  => $nav_id,
          'is_hero' => true
        )
      );
    }
    //Gallery code
  ?>
</picture>