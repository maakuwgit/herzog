<?php
/**
* inforgraphic
* -----------------------------------------------------------------------------
*
* inforgraphic component
*/

$default_data = [
  'headline'  => 'Small Town Roots with<br>Continental Reach',
  'content'   => '<h6>Herzog Today</h6>
<p>Herzog started as a small-town company, but today, Herzog has grown to become one of North America’s most respected private rail and heavy/highway construction organizations and operates through a network of offices and projects with over 2,000 highly-trained employees across North America.</p>',
  'columns'   => array(
    array(
      'infor_number'  => '1',
      'text'    => 'Lorem Ipsum'
    ),
    array(
      'infor_number'  => '2',
      'text'    => 'Lorem Ipsum'
    ),
    array(
      'infor_number'  => '3',
      'text'    => 'Lorem Ipsum'
    ),
    array(
      'infor_number'  => '4',
      'text'    => 'Lorem Ipsum'
    )
  )
];

$default_args = [
  'classes' => array(),
  'id' => uniqid('inforgraphic-')
];

$data = ll_parse_args( $component_data, $default_data );
$args = ll_parse_args( $component_data, $default_args );

if ( ll_empty( $data ) ) return;

$classes = $args['classes'] ?: array();
$id      = $args['id'];

?>
<section class="inforgraphic content enter <?php echo implode( " ", $classes ); ?>" <?php echo ( $id ? 'id="'.$id.'"' : '' ) ?> data-component="inforgraphic">
  <div class="container row start">
    <header class="col col-sm-7of12 col-md-7of12 col-lg-7of12 col-xl-7of12">
      <h2><?php echo $data['headline']; ?></h2>
    </header>
  </div>
  <div class="container row flex-end">
    <div class="col col-xs-12of12 col-sm-4of12 col-md-4of12 col-lg-4of12 col-xl-4of12 " data-component="band">
      <?php echo $data['content']; ?>
    </div>
    <?php
    foreach( $data['columns'] as $col ) :
    ?>
    <div class="col col-xs-2of12 col-sm-2of12 col-md-2of12 col-lg-2of12 col-xl-2of12 " data-component="band"><p><span class="h2"><?php echo $col['infor_number']; ?></span><br>
<?php echo $col['text']; ?></p>
    </div>
  <?php endforeach; ?>
</div>
</section>
