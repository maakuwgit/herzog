<?php
/**
* Case Study
* -----------------------------------------------------------------------------
*
*/
$img_base_url = get_bloginfo('url') . '/wp-content/uploads/';

$default_data = [
  'client'      => false,
  'scope'       => false,
  'outcome'     => false,
  'additionals' => false,
  'headline'    => 'Lorem Ipsum'
];

$default_args = [
  'id' => uniqid('case-study-'),
  'classes' => array(),
  'client_hero' => array(
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

$data = ll_parse_args( $component_data, $default_data );
$args = ll_parse_args( $component_args, $default_args );

//if ( ll_empty( $data ) ) return;

$css = 'class="case-study content';
if( $args['classes'] ) {
  if( is_array($args['classes'] ) ) {
    $css .= implode( " ", $args['classes'] );
  }else{
    $css .= ' ' . $args['classes'];
  }
}
$css .= '"';
$id           = $args['id'];
$headline     = $data['headline'];
$client       = $data['client'];
$scope        = $data['scope'];
$outcome      = $data['outcome'];
$additionals  = $data['additionals'];
$base_url     = get_bloginfo('url');

?>
<section<?php echo ' id="'.$id.'"'; ?> data-component="case-study"<?php echo $css; ?>>
  <div class="container row stretch">
    <header class="col">
      <h2><?php echo $headline; ?></h2>
    </header>
    <?php
      //Use a Big Image for the hero
      $picture = false;
      if( $client ) {
        $picture = wp_get_attachment_metadata(get_post_thumbnail_id($client->ID));
        if( !$picture ) {
          $picture = $args['client_hero'];
        }else{
          $picture = array(
            'image' => array(
              'title' => $picture['image_meta']['title'],
              'url' => $img_base_url . $picture['file'],
              'sizes' => array(
                'full' => $img_base_url . $picture['sizes']['large']['file'],
                'xlarge' => $img_base_url . $picture['sizes']['large']['file'],
                'large' => $img_base_url . $picture['sizes']['large']['file'],
                'medium' => $img_base_url . $picture['sizes']['medium']['file'],
                'thumbnail' => $img_base_url . $picture['sizes']['sm']['file']
              )
            )
          );
        }
      }

      ll_include_component(
        'picture',
        $picture,
        array(
          'classes' => 'enter'
        )
      );
    ?>
    <dl class="row">
      <?php if( $client ) : ?>
      <dt class="h4 col col-md-5of12 col-lg-4of12 col-xl-4of12"><?php echo $client->post_title; ?></dt>
      <dd class="h5 text-normal col col-md-7of12 col-lg-8of12 col-xl-8of12">
        <?php echo $client->post_content; ?>
        <?php
          ll_include_component(
            'button',
            array(
              'link'    => array(
                'title'   => 'Full Case Study',
                'url'     => $client->guid
              )
            )
          );
        ?>
      </dd>
      <?php endif; ?>
      <?php if( $scope ) : ?>
      <dt class="h5 col col-md-5of12 col-lg-4of12 col-xl-4of12">Scope</dt>
      <dd class="col col-md-7of12 col-lg-8of12 col-xl-8of12">
        <?php echo format_text($scope); ?>
      </dd>
      <?php endif; ?>
      <?php if( $outcome ) : ?>
      <dt class="h5 col col-md-5of12 col-lg-4of12 col-xl-4of12">Outcomes</dt>
      <dd class="col col-md-7of12 col-lg-8of12 col-xl-8of12"><?php echo format_text($outcome); ?></dd>
      <?php endif; ?>
    </dl>
  </div>
  <?php if( $additionals ) : ?>
  <div class="container row stretch">
    <footer class="col">
      <div class="row between">
        <h3 class="col col-6of12 center">Additional Project Experience</h3>
        <nav class="col col-6of12 center text-right">
        <?php
          ll_include_component(
            'button',
            array(
              'link'    => array(
                'title'   => 'All Case Studies',
                'url'     => get_bloginfo('url') . '/project/'
              )
            )
          );
          ?>
        </nav>
      </div>
      <div class="row container between">
        <ul class="col">
        <?php
          foreach( $additionals as $additional ) :
            $client = $additional->post_title;
            $location = $additional->post_excerpt;
        ?>
            <li>
              <h6 class="text-bold"><?php echo $client; ?></h6>
              <p><?php echo $location; ?></p>
            </li>
        <?php endforeach; ?>
        </ul>
      </div>
    </footer>
  </div>
  <?php endif; ?>
</section>