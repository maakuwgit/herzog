<?php
/**
* Picture
* -----------------------------------------------------------------------------
*
* @since 1.0
* @author Maakuw
*/
/* Dev Note: I would love to use this, evenutally as the hero image so there's just one pciture for all
but that's low on the importance right now
 *
 * @var array
 * @see data[]
 */

$default_data = [
  'image' => array(
    'title' => '',
    'url' => '//via.placeholder.com/1920x1080',
    'sizes' => array(
      'full' => '//via.placeholder.com/1920x1080',
      'xlarge' => '//via.placeholder.com/1920x1080',
      'large' => '//via.placeholder.com/1600x960',
      'medium' => '//via.placeholder.com/1280x800',
      'thumbnail' => '//via.placeholder.com/320x200'
    )
  )
];

$default_args = [
  'classes' => array(),
  'id' => uniqid('picture-')
];

$data = ll_parse_args( $component_data, $default_data );
$args = ll_parse_args( $component_args, $default_args );

/**
 * component_name_before_display hook
 * Type: Action
 */
do_action( "component_name_before_display", $component_data, $component_args );

if ( ll_empty( $data ) ) return;

$css = ' class="picture flex col';
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
<picture<?php echo $css . $id; ?> data-component="picture">
  <div class="feature container">
    <?php echo ll_format_image($data['image']); ?>
  </div>
</picture>
<?php
/**
 * component_name_after_display hook
 * Type: Action
 */
do_action( "component_name_after_display", $component_data, $component_args ); ?>