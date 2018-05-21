<?php
/**
* headline
* -----------------------------------------------------------------------------
*
* headline component
* @since 1.0.0
* @author MaakuW
*/
global $post;

/**
 * Default component data.
 *
 * @var array
 * @see data[]
 */

$default_data = [
  'text' => "Lorem Ipsum.",
  'tag'  => "h2",
  'colspan' => 12
];

$default_args = [
  'classes' => array(),
  'section' => $default_data['text'],
  'index'   => '00',
  'id'      => uniqid('headline-')
];

$data = ll_parse_args( $component_data, $default_data );
$args = ll_parse_args( $component_args, $default_args );

$text = $data['text'];
$tag  = $data['tag'];
$id   = ($args['id'] ? ' id="'.$args['id'].'"' : false);
$colspan = $data['colspan'];
$css = ' class="headline';
if( $args['classes'] ) {
  if( is_array($args['classes'] ) ) {
    $css .= implode( " ", $args['classes'] );
  }else{
    $css .= ' ' . $args['classes'];
  }
}
$css .= '"';
/**
 * component_name_before_display hook
 * Type: Action
 */
do_action( "component_name_before_display", $component_data, $component_args );
?>
<section<?php echo $id . $css; ?> data-component="headline">
  <div class="container row start">
    <?php if ( $text ) : ?>
      <header class="col col-sm-<?php echo $colspan;?>of12 col-md-<?php echo $colspan;?>of12 col-lg-<?php echo $colspan;?>of12 col-xl-<?php echo $colspan;?>of12">
        <<?php echo $tag ?>><?php echo $text; ?></<?php echo $tag; ?>>
      </header>
    <?php endif; ?>
  </div>
</section>
<?php
/**
 * component_name_after_display hook
 * Type: Action
 */
do_action( "component_name_after_display", $component_data, $component_args ); ?>
