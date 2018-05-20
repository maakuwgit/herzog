<?php
/**
* Callout Numbers component
* @since 1.0
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
  'has_counting'  => true,
  'headline'      => 'Lorem ispusm',
  'big_prefix'    => '',
  'big_number'    => '3600000',
  'big_suffix'    => '+',
  'subheadline'   => 'Sed ut perspiciatis unde omnis',
  'columns'       => false
];

$default_args = [
  'classes' => array(),
  'id' => uniqid('callout-numbers')
];

$data = ll_parse_args( $component_data, $default_data );
$args = ll_parse_args( $component_args, $default_args );

do_action( "component_name_before_display", $component_data, $component_args );

if ( ll_empty( $data ) ) return;

$css = 'class="testimonial-grid';
if( $args['classes'] ) {
  if( is_array($args['classes'] ) ) {
    $css .= implode( " ", $args['classes'] );
  }else{
    $css .= ' ' . $args['classes'];
  }
}
$css .= '"';
$id = ($args['id'] ? ' id="' . $args['id'] . '"' : '');
$suff = $data['big_suffix'];
$pref = $data['big_prefix'];
$columns = $data['columns'];
$colspan = ( $columns > 0 ? 12/sizeof($columns) : 12 );
$col_css = ' class="col col-md-'.$colspan.'of12 col-lg-'.$colspan.'of12 col-xl-'.$colspan.'of12"';
?>
<aside<?php echo $id . $css; ?> data-component="callout-numbers">
  <div class="container row">
    <div class="col text-center">
      <h2 class="h5"><?php echo $data['headline']; ?></h2>
      <h3 class="h1 text-normal"><?php echo $pref; ?><span data-count="<?php echo $data['big_number']; ?>">0</span><?php echo $suff; ?></h3>
      <?php echo format_text($data['subheadline']); ?>
    </div>
    <?php if( $columns ) : ?>
    <div class="col text-center">
      <dl class="row">
      <?php foreach( $columns as $col ) : ?>
        <div<?php echo $col_css; ?>>
          <dt><?php echo $col['column_title'];?></dt>
          <dd><?php echo $col['column_description'];?></dd>
        </div>
      <?php endforeach; ?>
      </dl>
    </div>
    <?php endif; ?>
  </div>
</aside>
<?php
/**
 * component_name_after_display hook
 * Type: Action
 */
do_action( "component_name_after_display", $component_data, $component_args ); ?>