<?php
/**
* Innovation Cared
* -----------------------------------------------------------------------------
*
 * Similar to the Division Card, show the related capabilites CPTs and content about this innovation
*/

$default_data = [
  'capabilities'    => false,
  'innovations'     => false,
  'purpose'         => '',
  'industries'      => '',
  'logo'            => array(
    'title' => '',
    'url'   => '//via.placeholder.com/264x200',
    'sizes' => array(
      'full'      => '//via.placeholder.com/528x400',
      'xlarge'    => '//via.placeholder.com/528x400',
      'large'     => '//via.placeholder.com/264x200',
      'medium'    => '//via.placeholder.com/132x100',
      'thumbnail' => '//via.placeholder.com/66x50'
    )
  )
];

$default_args = [
  'id' => uniqid('innovation-card-'),
  'classes' => array()
];

$data = ll_parse_args( $component_data, $default_data );
$args = ll_parse_args( $component_args, $default_args );

if ( ll_empty( $data ) ) return;

$css = 'class="innovation-card';
if( $args['classes'] ) {
  if( is_array($args['classes'] ) ) {
    $css .= implode( " ", $args['classes'] );
  }else{
    $css .= ' ' . $args['classes'];
  }
}
$css .= '"';
$id           = $args['id'];
$purpose      = $data['purpose'];
$capabilities = $data['capabilities'];
$industries   = $data['industries'];
$innovations  = $data['innovations'];
$logo         = $data['logo'];

$base_url     = get_bloginfo('url');

if( !$logo ) {
  $logo = $default_data['logo'];
}
?>
<section<?php echo ' id="'.$id.'"'; ?> data-component="innovation-card"<?php echo $css; ?>>
  <div class="container row stretch">
    <figure class="col col-sm-4of12 col-md-4of12 col-lg-4of12 col-xl-4of12 center">
    <?php
      if( $logo ) {
       echo ll_format_image($logo);
      }
    ?>
    <?php if( $capabilities || $innovations ) : ?>
      <figcaption>
      <?php if( $capabilities ) : ?>
        <?php if( sizeof($capabilities) > 1 ) : ?>
        <strong class="block">Related Capabilities</strong>
        <ul class="no-bullet">
        <?php foreach( $capabilities as $capability ) : ?>
          <li><?php echo $capability->post_title; ?></li>
        <?php endforeach;?>
        </ul>
        <?php else : ?>
        <strong class="block">Related Capability</strong>
        <ul class="no-bullet">
          <li><?php echo $capabilities[0]->post_title; ?></li>
        </ul>
        <?php endif; ?>
      <?php endif; ?>
      <?php if( $innovations ) : ?>
        <?php if( sizeof($innovations) > 1 ) : ?>
        <strong class="block">Related Innovations</strong>
        <ul class="no-bullet">
        <?php foreach( $innovations as $innovation ) : ?>
          <li><?php echo $innovation->post_title; ?></li>
        <?php endforeach; ?>
        </ul>
        <?php else : ?>
        <strong class="block">Related Innovation</strong>
        <ul class="no-bullet">
          <li><?php echo $innovations[0]->post_title; ?></li>
        </ul>
        <?php endif; ?>
      <?php endif; ?>
      </figcaption>
    <?php endif; ?>
    </figure>
    <dl class="col col-sm-8of12 col-md-8of12 col-lg-8of12 col-xl-8of12 center">
    <?php if( $purpose ) : ?>
      <div class="row">
        <dt class="text-bold col col-sm-6of12 col-md-6of12 col-lg-6of12 col-xl-6of12">Applications + Purpose</dt>
        <dd class="col col-sm-6of12 col-md-6of12 col-lg-6of12 col-xl-6of12"><?php echo $purpose; ?></dd>
      </div>
    <?php endif; ?>
    <?php if( $industries ) : ?>
      <div class="row">
        <dt class="text-bold col col-sm-6of12 col-md-6of12 col-lg-6of12 col-xl-6of12">Related Industries</dt>
        <dd class="col col-sm-6of12 col-md-6of12 col-lg-6of12 col-xl-6of12"><?php echo $industries; ?></dd>
      </div>
    <?php endif; ?>
    </dl>
  </div>
</section>