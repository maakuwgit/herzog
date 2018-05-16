<?php
/**
* vertical-timeline
* -----------------------------------------------------------------------------
*
* vertical-timeline component
*/


$default_data = [
  'columns' => array(
    array(
      'headline' => '',
      'content'  => ''
    )
  )
];

$default_args = [
  'id' => uniqid('vertical-timeline-grid-'),
  'classes' => array()
];

$data = ll_parse_args( $component_data, $default_data );
$args = ll_parse_args( $component_args, $default_args );

if ( ll_empty( $data ) ) return;

$css = ' class="vertical-timeline content';
if( $args['classes'] ) {
  if( is_array($args['classes'] ) ) {
    $css .= implode( " ", $args['classes'] );
  }else{
    $css .= ' ' . $args['classes'];
  }
}
$css .= '"';

$id       = $args['id'];
?>

<section<?php echo $id . $css; ?> data-component="vertical-timeline">

<?php
  if( $data['columns'] ) :
    foreach( $data['columns'] as $column ) :
?>
  <div class="container row start">
    <div class="col col-sm-6of12 col-md-6of12 col-lg-6of12 col-xl-6of12">
      <h3><?php echo$column['headline']; ?></h3>
    </div>
    <div class="col col-sm-6of12 col-md-6of12 col-lg-6of12 col-xl-6of12">
      <?php echo $column['content']; ?>
    </div>
  </div>
<?php
    endforeach;
  endif;
?>
</section>