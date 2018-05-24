<?php
/**
* logo-grid
* -----------------------------------------------------------------------------
*
* logo-grid component
*/
$default_image = [
  'title' => '',
  'url' => '//via.placeholder.com/165x165',
  'sizes' => array(
    'full' => '//via.placeholder.com/165x165',
    'xlarge' => '//via.placeholder.com/165x165',
    'large' => '//via.placeholder.com/165x165',
    'medium' => '//via.placeholder.com/165x165',
    'thumbnail' => '//via.placeholder.com/165x165'
  )
];

$default_data = [
  'headline'    => '',
  'subheadline' => '',
  'logos'       => array(
    array(
      'logo_image' => $default_image
    )
  )
];

$default_args = [
  'id' => uniqid('logo-grid-'),
  'classes' => array()
];

$data = ll_parse_args( $component_data, $default_data );
$args = ll_parse_args( $component_args, $default_args );

if ( ll_empty( $data ) ) return;

$css = 'class="logo-grid';
if( $args['classes'] ) {
  if( is_array($args['classes'] ) ) {
    $css .= implode( " ", $args['classes'] );
  }else{
    $css .= ' ' . $args['classes'];
  }
}
$css .= '"';

$id          = $args['id'];
$headline    = $data['headline'];
$subheadline = $data['subheadline'];
$logos       = $data['logos'];
?>
<section <?php echo 'id="'.$id.'"'; ?> data-component="logo-grid"<?php echo $css; ?>>
  <div class="container row start">
    <header class="col">
    <?php if( $headline ) :?>
      <h2 class="text-medium"><?php echo $headline; ?></h2>
    <?php endif;?>
    <?php if( $subheadline ) :?>
      <?php echo format_text($subheadline); ?>
    <?php endif; ?>
    </header>
    <ul class="no-bullet row box-grid">
      <?php
        foreach( $logos as $logo ) :
          if( !$logo['logo_image'] ){
            $logo['logo_image'] = $default_image;
          }
      ?>
        <?php if( is_array($logo) && sizeof($logo) > 0 ) : ?>
        <li class="col-xs-6of12 col-sm-4of12 col-md-3of12 col-lg-3of12 col-xl-3of12"><?php echo ll_format_image($logo['logo_image']); ?></li>
        <?php endif; ?>
      <?php endforeach; ?>
    </ul>
  </div>
</section>
