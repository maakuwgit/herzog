<?php
/**
* Accordion
* -----------------------------------------------------------------------------
*
* Accordion component
* @since 1.3
* @author MaakuW
*/
global $post;

/**
 * Default component data.
 *
 * @var array
 * @see data[]
 */
$bg_img = get_template_directory_uri() . '/assets/img/background-accordion.png';

$default_data = [
  'accordion_background'  => array(
        'url' => $bg_img,
        'sizes' => array(
          'thumbnail' => $bg_img,
          'full'      => $bg_img,
          'large'     => $bg_img,
          'medium'    => $bg_img
        )
      ),
  'accordion_wrapper' => array(
    array(
      'accordion_element' => array(
        array(
          'accordion_headline'    => array(
            'post_name' => 'Lorem ipsum',
            'guid'      => '#'
          ),
          'accordion_content'     => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
          'target_name'            => false,
          'accordion_capabilities'   => false,
          'accordion_case_studies' => false,
          'accordion_careers'      => false,
          'accordion_leaders'      => false
        )
      )
    )
  )
];

$default_args = [
  'classes' => array(),
  'id' => uniqid('accordion-'),
  'default_thumb' => array(
    'file' => '//via.placeholder.com/345x345'
  )
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
$css = ' class="accordion ';
if( is_array($args['classes'] ) ) {
  $css .= implode( " ", $args['classes'] );
}else{
  $css .= ' ' . $args['classes'];
}
$css .= '"';

$id = ($args['id'] ? ' id="' . $args['id'] . '"' : '');
$bg       = $data['accordion_background'];

$accordions = $data['accordion_wrapper'][0]['accordion_element'];

?>
<section<?php echo $id . $css; ?> data-component="accordion" data-background>
  <figure class="feature">
    <?php echo ll_format_image($bg); ?>
  </figure>
<?php if( $accordions ) : ?>
  <dl class="wrapper row">
<?php
  $flag = ' active';
  $aID = 0;
  foreach( $accordions as $accordion ) :
    $division = $accordion['accordion_headline'];
    $url = '#';
    $img_base_url = get_bloginfo('url') . '/wp-content/uploads/';

    $capabilities = $accordion['accordion_capabilities'];
    $case_studies = $accordion['accordion_case_studies'];
    $careers      = $accordion['accordion_careers'];
    $leaders      = $accordion['accordion_leaders'];

    if( $division ) {
      $headline = $division->post_title;
      $url = $division->guid;
    }
?>
    <dt class="col-md-12of12 col-lg-2of12 col-xl-2of12 accordion--trigger<?php echo $flag; ?>" data-content-num="<?php echo $aID; ?>">
      <?php ll_get_featured([158,100],true); ?>
    </dt>
    <dd class="col-md-12of12 col-lg-10of12 col-offset-lg-2of12 col-xl-10of12 col-offset-lg-2of12 col-offset-xl-2of12 accordion<?php echo $flag; ?>">
      <div class="row">
        <div class="col col-md-12of12 col-lg-7of12 col-xl-10of12">
          <h3><?php echo $headline; ?></h3>
          <?php echo format_text($accordion['accordion_content']); ?>
          <?php
            ll_include_component(
              'button',
              array(
              'icon'    => 'chevron',
              'theme'   => 'light',
              'link'    => array(
                  'title' => 'Learn More',
                  'url'  => $url
                )
              )
            );
            ?>
          </div>
          <div class="col col-md-12of12 col-lg-3of12 col-xl-2of12">
            <?php
              ll_include_component(
                'button',
                array(
                'icon'    => 'chevron',
                'theme'   => 'dark',
                'link'    => array(
                    'title' => 'Capabilities',
                    'url'  => get_bloginfo('url') . '/capability'
                  )
                )
              );
              ll_include_component(
                'button',
                array(
                'icon'    => 'chevron',
                'theme'   => 'dark',
                'link'    => array(
                    'title' => 'Innovations',
                    'url'  => get_bloginfo('url') . '/innovation'
                  )
                )
              );
              ll_include_component(
                'button',
                array(
                'icon'    => 'chevron',
                'theme'   => 'dark',
                'link'    => array(
                    'title' => 'Case Studies',
                    'url'  => get_bloginfo('url') . '/case_study'
                  )
                )
              );
              ll_include_component(
                'button',
                array(
                'icon'    => 'chevron',
                'theme'   => 'dark',
                'link'    => array(
                    'title' => $headline . ' Careers',
                    'url'  => get_bloginfo('url') . '/careers'
                  )
                )
              );
              ?>
          </div>
      </div>
    <?php if( $capabilities || $case_studies || $careers || $leaders ) : ?>
      <ul class="container row start no-bullet">
    <?php
      //Capabilities
      if( $capabilities ) :
        foreach( $capabilities as $capability ) :
          $cimg = wp_get_attachment_metadata(get_post_thumbnail_id($capability));
          if( !$cimg ) {
            $cimg = $args['default_thumb'];
          }else{
            $cimg = $img_base_url . $cimg['file'];
          }
      ?>
        <li class="col col-xs-6of12 col-sm-4of12 col-md-3of12 col-lg-3of12 col-xl-3of12">
          <h6 class="text-normal silver">Capabilities</h6>
          <figure class="thumbnail col" data-clickthrough>
            <?php
            ll_include_component(
              'button',
              array(
                'icon'    => 'plus',
                'theme'   => 'dark',
                'link'    => array(
                  'url'   => $capability->guid,
                  'title' => false
                )
              ),
              array()
            );

            ?>
            <div data-background>
              <div class="feature">
                <img alt="" src="<?php echo $cimg['file'];?>">
              </div>
              <figcaption>
                <h3 class="h5 text-medium white"><?php echo $capability->post_title;?></h3>
              </figcaption>
            </div>
          </figure>
        </li>
      <?php endforeach; ?>
    <?php endif; ?>
    <?php
      //Case Studies
      if( $case_studies) :
        foreach( $case_studies as $case_study ) :
          $pimg = wp_get_attachment_metadata(get_post_thumbnail_id($case_study));
          if( !$pimg ) {
            $pimg = $args['default_thumb'];
          }else{
            $pimg = $img_base_url . $pimg['file'];
          }
      ?>
        <li class="col col-xs-6of12 col-sm-4of12 col-md-3of12 col-lg-3of12 col-xl-3of12">
          <h6 class="text-normal silver">Case Study</h6>
          <figure class="thumbnail col" data-clickthrough>
            <?php
            ll_include_component(
              'button',
              array(
                'icon'    => 'plus',
                'theme'   => 'dark',
                'link'    => array(
                  'url'   => $case_study->guid,
                  'title' => false
                )
              ),
              array()
            );
            ?>
            <div data-background>
              <div class="feature">
                <img alt="" src="<?php echo $pimg['file'];?>">
              </div>
              <figcaption>
                <h3 class="h5 text-medium white"><?php echo $case_study->post_title;?></h3>
              </figcaption>
            </div>
          </figure>
        </li>
      <?php endforeach; ?>
    <?php endif; ?>
    <?php
      //Careers
      if( $careers) :
        foreach( $careers as $career ) :
          $jimg = wp_get_attachment_metadata(get_post_thumbnail_id($career));
          if( !$jimg ) {
            $jimg = $args['default_thumb'];
          }else{
            $jimg = $img_base_url . $jimg['file'];
          }
      ?>
        <li class="col col-xs-6of12 col-sm-4of12 col-md-3of12 col-lg-3of12 col-xl-3of12">
          <h6 class="text-normal silver">Careers</h6>
          <figure class="thumbnail col" data-clickthrough>
            <?php
            ll_include_component(
              'button',
              array(
                'icon'    => 'plus',
                'theme'   => 'dark',
                'link'    => array(
                  'url'   => $career->guid,
                  'title' => false
                )
              ),
              array()
            );
            ?>
            <div data-background>
              <div class="feature">
                <img alt="" src="<?php echo $jimg['file'];?>">
              </div>
              <figcaption>
                <h3 class="h5 text-medium white"><?php echo $career->post_title;?></h3>
              </figcaption>
            </div>
          </figure>
        </li>
      <?php endforeach; ?>
    <?php endif; ?>
    <?php
      //Leadership
      if( $leaders ) :
        foreach( $leaders as $leader ) :
          $limg = wp_get_attachment_metadata(get_post_thumbnail_id($leader));
          if( !$limg ) {
            $limg = $args['default_thumb'];
          }else{
            $limg = $img_base_url . $limg['file'];
          }
      ?>
        <li class="col col-xs-6of12 col-sm-4of12 col-md-3of12 col-lg-3of12 col-xl-3of12">
          <h6 class="text-normal silver">Leadership</h6>
          <figure class="thumbnail col" data-clickthrough>
            <?php
            ll_include_component(
              'button',
              array(
                'icon'    => 'plus',
                'theme'   => 'dark',
                'link'    => array(
                  'url'   => $leader->guid,
                  'title' => false
                )
              ),
              array()
            );
            ?>
            <div data-background>
              <div class="feature">
                <img alt="" src="<?php echo $limg;?>">
              </div>
              <figcaption>
                <h3 class="h5 text-medium white"><?php echo $leader->post_title;?></h3>
              </figcaption>
            </div>
          </figure>
        </li>
      <?php endforeach; ?>
      <?php endif; ?>
      </ul>
    <?php endif; ?>
    </dd>
<?php
  $flag = '';
  $aID++;
  endforeach;
?>
  </dl>
  <nav data-accordion-nav class="wrapper row">
    <div class="col-md-12of12 col-lg-2of12 col-xl-2of12">
      <div class="wrapper row">
        <button class="button light" data-accordion-prev>
            <svg class="icon icon-chevron-left"><use xlink:href="#icon-chevron-left"></use></svg>
        </button>
        <button class="button light" data-accordion-next>
            <svg class="icon icon-chevron-right"><use xlink:href="#icon-chevron-right"></use></svg>
        </button>
      </div>
    </div>
    <div class="col-md-12of12 col-lg-10of12 col-xl-10of12">
      Add in the icon here
    </div>
  </nav>
<?php else: ?>
  <p>Oops! No accordion elements are defined in the componenent!</p>
<?php endif; ?>
</section>
<?php
/**
 * component_name_after_display hook
 * Type: Action
 */
do_action( "component_name_after_display", $component_data, $component_args ); ?>
