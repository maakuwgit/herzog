<?php
/**
* Callout Image
* -----------------------------------------------------------------------------
*
* @since 1.1
* @author Maakuw
*/
/** Default component data.
 *
 * @var array
 * @see data[]
 */

$default_data = [
  'quote'    => "Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia.",
  'cite' => 'Pull Quote Here',
  'background' => array(
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
  'id' => uniqid('callout-image-')
];

$data = ll_parse_args( $component_data, $default_data );
$args = ll_parse_args( $component_args, $default_args );

/**
 * component_name_before_display hook
 * Type: Action
 */
do_action( "component_name_before_display", $component_data, $component_args );

if ( ll_empty( $data ) ) return;

$css = ' class="callout-image flex';
if( $args['classes'] ) {
  if( is_array($args['classes'] ) ) {
    $css .= implode( " ", $args['classes'] );
  }else{
    $css .= ' ' . $args['classes'];
  }
}
$css .= '"';
$id = ($args['id'] ? ' id="' . $args['id'] . '"' : '');
$bg = $data['background'];

//Background for the section element
if ( $bg ) {
 $style = ' data-background';
} else {
 $style = '';
}
?>
<aside<?php echo $id . $css; ?> data-component="callout-image"<?php echo $style;?>>
<?php if( $bg ) : ?>
  <div class="feature">
    <?php echo ll_format_image($bg); ?>
  </div>
<?php endif; ?>
  <div class="container row center">
    <blockquote class="col col-md-8of12 col-lg-10of12 text-left center">
      <?php echo format_text($data['quote']); ?>
      <cite class="col col-md-8of12 col-lg-10of12 text-left"><?php echo $data['cite']; ?></cite>
    </blockquote>
  </div>
</aside>

<?php
/**
 * component_name_after_display hook
 * Type: Action
 */
do_action( "component_name_after_display", $component_data, $component_args ); ?>