<?php
/**
* Anchor Navigation (Homepage Template)
* -----------------------------------------------------------------------------
*
* Band component
* @since 1.0.0
* @author MaakuW
*/
global $post;

$default_data = [
  array(
    'anchor_btn_abbr'  => 'XXX',
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
$is_home = is_front_page();
$btns = '';

foreach( $data as $btn ) {
  $btns .= '<li>';
  $btns .= '<a href="' . $btn['anchor_btn_target'] . '" class="block button">';
  $btns .= '<small class="block aluminum">' . $btn['anchor_btn_abbr'] . '</small>';
  $btns .= $btn['anchor_btn_label'].'</a>';
  $btns .= '</a>';
  $btns .= '</li>';
}
?>
<nav<?php echo $id . $css;?> data-component="anchor-nav-home" class="anchor_nav">
  <ul class="wrapper row no-bullet">
    <?php echo $btns; ?>
  </ul>
</nav>
<?php
/**
 * component_name_after_display hook
 * Type: Action
 */
do_action( "component_name_after_display", $component_data, $component_args ); ?>
