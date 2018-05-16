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
  'who_served'      => '',
  'past_projects'   => '',
  'services'        => '',
  'process'         => '',
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
  ),
  'leader_btn'      => array(
    'icon'    => 'chevron',
    'theme'   => 'light',
    'link'    => array(
      'title'   => 'Leadership Team',
      'url'     => '/',
      'target'  => '_self'
    )
  ),
  'timeline_btn'        => array(
    'icon'    => 'chevron',
    'theme'   => 'light',
    'link'    => array(
      'title'   => 'Herzog Timeline',
      'url'     => '/',
      'target'  => '_self'
    )
  ),
  'case_btn'           => array(
    'icon'    => 'chevron',
    'theme'   => 'light',
    'link'    => array(
      'title'   => 'Case Studies',
      'url'     => '/',
      'target'  => '_self'
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
$who_served   = $data['who_served'];
$capabilities = $data['capabilities'];
$projects     = $data['past_projects'];
$services     = $data['services'];
$innovations  = $data['innovations'];
$process      = $data['process'];
$logo         = $data['logo'];
$leader_btn   = $data['leader_btn'];
$timeline_btn = $data['timeline_btn'];
$case_btn     = $data['case_btn'];

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
          <li><?php echo $capabilities->post_title; ?></li>
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
          <li><?php echo $innovations->post_title; ?></li>
        </ul>
        <?php endif; ?>
      <?php endif; ?>
      </figcaption>
    <?php endif; ?>
      <nav>
      <?php
        ll_include_component(
          'button',
          array(
            'link'    => array(
              'title'   => 'Leadership Team',
              'url'     => $base_url . '/team/'
            )
          )
        );
        ll_include_component(
          'button',
          array(
            'link'    => array(
              'title'   => 'Herzog Timeline',
              'url'     => get_bloginfo('url') . '/timeline/'
            )
          )
        );
        ll_include_component(
          'button',
          array(
            'link'    => array(
              'title'   => 'Case Studies',
              'url'     => get_bloginfo('url') . '/project/'
            )
          )
        );
      ?>
      </nav>
    </figure>
    <dl class="col col-sm-8of12 col-md-8of12 col-lg-8of12 col-xl-8of12 center">
    <?php if( $who_served ) : ?>
      <div class="row">
        <dt class="text-bold col col-sm-6of12 col-md-6of12 col-lg-6of12 col-xl-6of12">Who We Serve</dt>
        <dd class="col col-sm-6of12 col-md-6of12 col-lg-6of12 col-xl-6of12"><?php echo $who_served; ?></dd>
      </div>
    <?php endif; ?>
    <?php if( $projects ) : ?>
      <div class="row">
        <dt class="text-bold col col-sm-6of12 col-md-6of12 col-lg-6of12 col-xl-6of12">Past Projects</dt>
        <dd class="col col-sm-6of12 col-md-6of12 col-lg-6of12 col-xl-6of12"><?php echo $projects; ?></dd>
      </div>
    <?php endif; ?>
    <?php if( $services ) : ?>
      <div class="row">
        <dt class="text-bold col col-sm-6of12 col-md-6of12 col-lg-6of12 col-xl-6of12">Capability Services</dt>
        <dd class="col col-sm-6of12 col-md-6of12 col-lg-6of12 col-xl-6of12"><?php echo $services; ?></dd>
      </div>
    <?php endif; ?>
    <?php if( $process ) : ?>
      <div class="row">
        <dt class="text-bold col col-sm-6of12 col-md-6of12 col-lg-6of12 col-xl-6of12">Project Process</dt>
        <dd class="col col-sm-6of12 col-md-6of12 col-lg-6of12 col-xl-6of12"><?php echo $process; ?></dd>
      </div>
    <?php endif; ?>
    </dl>
  </div>
</section>