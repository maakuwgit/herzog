<?php
/**
* Section Navigation
* -----------------------------------------------------------------------------
*
* Band component
* @since 1.2
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
  'sections'  => false
];

$default_args = [
  'classes' => array(),
  'id'      => uniqid('section_nav-')
];

$data = ll_parse_args( $component_data, $default_data );
$args = ll_parse_args( $component_args, $default_args );

do_action( "component_name_before_display", $component_data, $component_args );

if ( ll_empty( $data ) ) return;

$css = ' class="section-nav flex';
$sections = $data['sections'];

if( $args['classes'] ) {
  $css .= ' ' . implode( " ", $args['classes'] );
}
  $css .= '"';

$id = ($args['id'] ? ' id="' . $args['id'] . '" ' : '"');
?>
<aside<?php echo $id . $css;?> data-component="section-nav" data-section="<?php echo $sections[0]['anchor_btn_target'];?>" data-component="section-nav">
  <div class="wrap row">
    <nav class="col-2of12">
      <button type="button" class="section-next">
        <svg><use xlink:href="#icon-chevron-left"></use></svg>
      </button>
      <button type="button" class="section-prev">
        <svg><use xlink:href="#icon-chevron-right"></use></svg>
      </button>
    </nav>
    <dl class="col-10of12">
      <?php
        $s = 1;
        foreach( $sections as $section ) :
          $sindex = $s;
          if($section['index'] < 10) $sindex = '0'.$sindex;
      ?>
      <dt data-section-id="<?php echo $section['anchor_btn_target'];?>" class="flex<?php if( $s == 1 ) echo ' active'; ?>"><?php echo $sindex; ?></dt>
      <dd class="flex<?php if( $s == 1 ) echo ' active'; ?>"><?php echo $section['anchor_btn_label']; ?></dd>
      <?php
          $s++;
        endforeach;
      ?>
    </dl>
    <!--<progress value="1" max="2" data-slick-progress>-->
  </div>
</aside>
<?php
/**
 * component_name_after_display hook
 * Type: Action
 */
do_action( "component_name_after_display", $component_data, $component_args ); ?>
