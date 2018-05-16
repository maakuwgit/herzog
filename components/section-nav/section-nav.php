<?php
/**
* Section Navigation
* -----------------------------------------------------------------------------
*
* Band component
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
  'anchor_btn_label'  => 'Lorem',
  'anchor_btn_target' => '#'
];

$default_args = [
  'classes' => array(),
  'index'      => '00',
  'id'      => uniqid('section_nav-')
];

$data = ll_parse_args( $component_data, $default_data );
$args = ll_parse_args( $component_args, $default_args );

/**
 * component_name_before_display hook
 * Type: Action
 */
do_action( "component_name_before_display", $component_data, $component_args );
?>

<?php
if ( ll_empty( $data ) ) return;

$css = ' class="section-nav flex';

if( $args['classes'] ) {
  $css .= ' ' . implode( " ", $args['classes'] );
}
  $css .= '"';

$id = ($args['id'] ? ' id="' . $args['id'] . '" ' : '"');
?>
<aside<?php echo $id . $css;?> data-component="section-nav" data-section="<?php echo $data['anchor_btn_target'];?>">
  <div class="wrap row">
    <nav class="col-2of12">
      <button type="button" class="section-prev">
        <svg><use xlink:href="#icon-chevron-left"></use></svg>
      </button>
      <button type="button" class="section-next">
        <svg><use xlink:href="#icon-chevron-right"></use></svg>
      </button>
    </nav>
    <dl class="col-10of12">
      <dt class="flex"><?php echo $args['index']; ?></dt>
      <dd class="flex"><?php echo $data['anchor_btn_label']; ?></dd>
    </dl>
    <progress value="1" max="2" data-slick-progress>
  </div>
</aside>
<?php
/**
 * component_name_after_display hook
 * Type: Action
 */
do_action( "component_name_after_display", $component_data, $component_args ); ?>
