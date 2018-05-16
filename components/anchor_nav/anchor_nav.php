<?php
/**
* Anchor Navigation
* -----------------------------------------------------------------------------
*
* Band component
* @since 1.0.0
* @author MaakuW
*/
global $post;

$default_data = [
  array(
    'anchor_btn_label'  => 'Lorem',
    'anchor_btn_target' => '#'
  )
];

$default_args = [
  'classes' => array(),
  'id'      => uniqid('anchor_nav-')
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

$css = '';
if( $args['classes'] ) {
  $css = ' class="';
  if( is_array($args['classes'] ) ) {
    $css .= implode( " ", $args['classes'] );
  }else{
    $css .= ' ' . $args['classes'];
  }
  $css .= '"';

}
$id = ($args['id'] ? ' id="' . $args['id'] . '"' : '');
$btns = '';

foreach( $data as $btn ) {
  $btns .= '<li>';
  $btns .= '<a href="' . $btn['anchor_btn_target'] . '">';
  $btns .= '<span class="iblock">';
  $btns .= $btn['anchor_btn_label'];
  $btns .= '</span></a>';
  $btns .= '</li>';
}
?>
<section<?php echo $id . $css;?>>
  <div class="wrapper row start">
    <nav data-component="anchor_nav" class="anchor_nav col col-lg-6of12 col-xl-5of12">
      <ol>
        <?php echo $btns; ?>
      </ol>
    </nav>
  </div>
</section>
<?php
/**
 * component_name_after_display hook
 * Type: Action
 */
do_action( "component_name_after_display", $component_data, $component_args ); ?>
