<?php
/**
* capability-teaser
* -----------------------------------------------------------------------------
*
* capability-teaser component
*/
$id = uniqid('capability-teaser-');

$default_data = [
  'teaser_columns'   => array(
    array(
      'teaser_capability'  => false,
      'teaser_headline'    => 'light',
      'teaser_copy'        => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>'
    )
  )
];

$default_args = [
  'classes' => array(),
  'id'      => $id
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
if ( ll_empty( $data ) ) return;

$css = ' class="capability-teaser content';

if( $args['classes'] ) {
  if( is_array($args['classes'] ) ) {
    $css .= implode( " ", $args['classes'] );
  }else{
    $css .= ' ' . $args['classes'];
  }
}
  $css .= '"';

$id = ' id="' . $id . '"';
?>
<section<?php echo $id . $css; ?>>
<?php
    foreach( $data['teaser_columns'] as $teaser ) :
      $capabilities = $teaser['teaser_capability'];
      if( $capabilities ) :
?>
  <div class="container row start">
    <picture class="col col-sm-4of12 col-md-6of12 col-lg-6of12 col-xl-6of12">
      <?php
        $blog_url = get_bloginfo('url') . '/';
        $feature = wp_get_attachment_metadata(get_post_thumbnail_id($capabilities->ID));
        if( !is_array($feature) ){
          $feature = array(
            'title' => 'Lorem Ipsum',
            'url' => '//via.placeholder.com/1920x1080',
            'sizes' => array(
              'full' => '//via.placeholder.com/1920x1080',
              'xlarge' => '//via.placeholder.com/1920x1080',
              'large' => '//via.placeholder.com/1600x960',
              'medium' => '//via.placeholder.com/1280x800',
              'thumbnail' => '//via.placeholder.com/320x200'
            )
          );
          $feature = ll_format_image($feature);
        }else{
          //Dev Note: there's a MUCh easier, better way, but for now this will do as I've wasted an hour looking
          $feature = '<img alt="" src="'.get_bloginfo('url') . '/wp-content/uploads/'.$feature['file'].'">';
        }
        echo $feature;
        $button = array(
          'link'  => array(
            'title' => $capabilities->post_title,
            'url'  => $capabilities->guid
          )
        );

        ll_include_component(
          'button',
          $button
        );
      ?>
    </picture>
    <dl class="col col-sm-8of12 col-md-6of12 col-lg-6of12 col-xl-6of12">
      <dt class="h4"><?php echo $capabilities->post_title; ?></dt>
      <dd>
        <?php echo format_text($capabilities->post_content); ?>
      </dd>
    </dl>
  </div>
  <?php endif; ?>
<?php endforeach; ?>
</section>
<?php
/**
 * component_name_after_display hook
 * Type: Action
 */
do_action( "component_name_after_display", $component_data, $component_args ); ?>