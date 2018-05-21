<?php
/**
* button
* -----------------------------------------------------------------------------
*
* button component
* @since 1.2
* @author First Last
*/

/**
 * Default component data.
 *
 * @var array
 * @see data[]
 */
$default_data = [
  'icon'    => 'chevron',
  'theme'   => 'light',
  'link'    => array(
      'title'   => 'Learn More',
      'url'     => '/',
      'target'  => '_self'
    )
];

$default_args = [
  'id'       => uniqid('button-'),
  'classes'  => array(),
  'modal'    => false,
  'modal_id' => false
];

$data = ll_parse_args( $component_data, $default_data );
$args = ll_parse_args( $component_args, $default_args );

/**
 * component_name_before_display hook
 * Type: Action
 */
do_action( "component_name_before_display", $component_data, $component_args );

if ( ll_empty( $data ) ) return;

$modal = '';
$use_modal = $args['modal'];
if( $use_modal ) {
  $modal = ' data-mfp-src="#'.$args['modal_id'].'"';
}
$css = ' class="button';
if( is_array($args['classes'] ) ) {
  $css .= implode( " ", $args['classes'] );
}else{
  $css .= ' ' . $args['classes'];
}
$css .= ' ' . $data['theme'] . '"';

$id = ($args['id'] ? ' id="' . $args['id'] . '"' : '');

$title = ($data['link']['title'] ? ' title="'.$data['link']['title'].'"' : '');
?>
<a
  <?php echo $id . $css . $title ?>
  href="<?php echo $data['link']['url']; ?>"
  data-component="button"
  target="<?php echo $data['link']['target']; ?>"
>
  <?php if( $data['icon'] === 'chevron' ) : ?>
    <svg class="icon icon-chevron-right"><use xlink:href="#icon-chevron-right"></use></svg>
  <?php else: ?>
    <span class="icon icon-plus">+</span>
  <?php endif; ?>
  <?php if( $data['link']['title'] ) : ?>
    <span><?php echo $data['link']['title']; ?></span>
  <?php endif; ?>
</a>

<?php
/**
 * component_name_after_display hook
 * Type: Action
 */
do_action( "component_name_after_display", $component_data, $component_args ); ?>
