<?php
/**
* callout
* -----------------------------------------------------------------------------
*
* callout component
* @since 1.3
* @author First Last
*/
global $post;

/**
 * Default component data.
 *
 * @var array
 * @see data[]
 */

$default_data = [
  'headline'    => "Work width <br>the Herzog Team",
  'subheadline' => 'If you would like to partner or subcontract with the Herzog team, contact us today.',
  'button'      => false
];

$default_args = [
  'classes' => array(),
  'id' => uniqid('callout-')
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

$has_prefooter = get_field('has_prefooter', $post->ID);
if ( ll_empty( $data ) || !$has_prefooter || $has_prefooter === null ) return;
$css = ' class="callout ';
if( $args['classes'] ) {
  if( $args['classes'] ) $css .= implode( " ", $args['classes'] );
}
$css .= '"';
$id = ($args['id'] ? ' id="' . $args['id'] . '"' : '');
?>
<aside<?php echo $id . $css; ?> data-component="callout">
  <div class="container row">
    <div class="col col-sm-5of12 col-md-6of12 col-lg-6of12 col-xl-6of12 flex-start">
      <h2><?php echo $data['headline']; ?></h2>
    </div>
    <div class="col col-sm-7of12 col-md-6of12 col-lg-6of12 col-xl-6of12 flex-start">
      <?php echo format_text($data['subheadline']); ?>
      <nav>
      <?php
        if( $data['link'] ) {
          $button = array(
            'link' => $data['link']
          );

          ll_include_component(
            'button',
            $button
          );
        }
      ?>
      </nav>
    </div>
  </div>
</aside>

<?php
/**
 * component_name_after_display hook
 * Type: Action
 */
do_action( "component_name_after_display", $component_data, $component_args ); ?>
