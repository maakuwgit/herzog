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
      $abbr = get_field('division_abbreviation', $division->ID);
      $url = $division->guid;
    }

    $logos = array(
      'muted'     => get_field('division_logo_muted', $division),
      'reversed'  => get_field('division_logo_reversed', $division)
    );

    if( $logos['muted'] ){
      $logo    = ll_format_image($logos['muted']);
      $logo_ov = ll_format_image($logos['reversed'], 'data-hover_img');
    }else{
      $logo    = '<img alt="Placeholder Image" src="http://via.placeholder.com/158x100"
srcset="http://via.placeholder.com/632x400 2x, http://via.placeholder.com/948x600 3x" data-src-md="http://via.placeholder.com/316x200" data-src-lg="http://via.placeholder.com/632x400 data-src-xl="http://via.placeholder.com/948x600">';
      $logo_ov = '<img data-hover_img alt="Placeholder Image" src="//via.placeholder.com/158x100"
srcset="http://via.placeholder.com/632x400 2x, http://via.placeholder.com/948x600 3x" data-src-md="http://via.placeholder.com/316x200" data-src-lg="http://via.placeholder.com/632x400 data-src-xl="http://via.placeholder.com/948x600">';
    }
?>
    <dt class="col-md-12of12 col-lg-2of12 col-xl-2of12 no-shadow accordion--trigger<?php echo $flag; ?>" data-content-num="<?php echo $aID; ?>" data-background>
      <div class="feature">
        <?php echo $logo . $logo_ov; ?>
      </div>
    </dt>
    <dd class="col-md-12of12 col-lg-10of12 col-offset-lg-2of12 col-xl-10of12 col-offset-lg-2of12 col-offset-xl-2of12 accordion<?php echo $flag; ?>">
      <div class="container row between">
        <div class="col col-md-12of12 col-lg-7of12 col-xl-10of12">
          <h2><?php echo $headline; ?></h2>
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
              ),
              array(
                'classes' => 'button-cta'
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
                    'title' => $abbr . ' Careers',
                    'url'  => get_bloginfo('url') . '/careers'
                  )
                )
              );
              ?>
          </div>
      </div>
    <?php if( $capabilities || $case_studies || $careers || $leaders ) : ?>
      <ul class="slider container row start no-bullet">
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
              array(
                'classes' => 'button-large'
              )
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
              )
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
            $limg = $args['default_thumb']['file'];
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
  <nav data-accordion-nav class="accordion-nav wrapper row">
    <div class="col-md-12of12 col-lg-2of12 col-xl-2of12">
      <div class="wrapper row">
        <button class="button button-large light" data-accordion-prev>
            <svg class="icon icon-chevron-left"><use xlink:href="#icon-chevron-left"></use></svg>
        </button>
        <button class="button button-large light" data-accordion-next>
            <svg class="icon icon-chevron-right"><use xlink:href="#icon-chevron-right"></use></svg>
        </button>
      </div>
    </div>
    <div class="col-md-12of12 col-lg-10of12 col-xl-10of12">
      <figure class="accordion-nav__info wrapper row end">
        <figcaption>
          <p class="aluminum">Click and drag to explore</p>
        </figcaption>
        <svg width="33px" height="41px" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
          <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
            <g fill="#FFFFFF" fill-rule="nonzero">
              <path d="M32.1059113,0 L26.9039409,0 C26.4253596,0 26.0369187,0.382693359 26.0369187,0.854193359 C26.0369187,1.32569336 26.4253596,1.70830664 26.9039409,1.70830664 L31.2388892,1.70830664 L31.2388892,5.97911328 C31.2388892,6.45061328 31.62733,6.83330664 32.1059113,6.83330664 C32.5844926,6.83330664 32.9729335,6.45061328 32.9729335,5.97911328 L32.9729335,0.854113281 C32.9729335,0.382693359 32.5844926,0 32.1059113,0 Z"></path>
              <path d="M32.1059113,13.6666934 C31.62733,13.6666934 31.2388892,14.0493867 31.2388892,14.5208867 L31.2388892,18.7916934 L26.9039409,18.7916934 C26.4253596,18.7916934 26.0369187,19.1743867 26.0369187,19.6458867 C26.0369187,20.1173867 26.4253596,20.5 26.9039409,20.5 L32.1059113,20.5 C32.5844926,20.5 32.9729335,20.1173066 32.9729335,19.6458066 L32.9729335,14.5208066 C32.9729335,14.0493066 32.5844926,13.6666934 32.1059113,13.6666934 Z"></path>
              <path d="M18.2339631,0 L13.0319926,0 C12.5534113,0 12.1649704,0.382693359 12.1649704,0.854193359 L12.1649704,5.97919336 C12.1649704,6.45069336 12.5534113,6.83338672 13.0319926,6.83338672 C13.5105739,6.83338672 13.8990148,6.45069336 13.8990148,5.97919336 L13.8990148,1.70830664 L18.2339631,1.70830664 C18.7125443,1.70830664 19.1009852,1.32561328 19.1009852,0.854113281 C19.1009852,0.382613281 18.7125443,0 18.2339631,0 Z"></path>
              <path d="M32.7180369,0.251125 C32.3799089,-0.082 31.8302069,-0.082 31.4920788,0.251125 L26.2901084,5.376125 C25.9519803,5.70925 25.9519803,6.25081836 26.2901084,6.58394336 C26.4600665,6.749625 26.6819631,6.83338672 26.9039409,6.83338672 C27.1259187,6.83338672 27.3478153,6.74970508 27.5160665,6.58394336 L32.7180369,1.45894336 C33.056165,1.12581836 33.056165,0.58425 32.7180369,0.251125 Z"></path>
              <path d="M17.9790665,4.52193164 L13.6441182,0.251125 C13.3059901,-0.082 12.7562882,-0.082 12.4181601,0.251125 C12.080032,0.58425 12.080032,1.12581836 12.4181601,1.45894336 L16.7531084,5.72975 C16.9230665,5.89543164 17.1449631,5.97919336 17.3669409,5.97919336 C17.5889187,5.97919336 17.8108153,5.89551172 17.9790665,5.72975 C18.3171946,5.396625 18.3171946,4.85505664 17.9790665,4.52193164 Z"></path>
              <path d="M32.7180369,19.0428184 L28.3830887,14.7720117 C28.0449606,14.4388867 27.4952586,14.4388867 27.1571305,14.7720117 C26.8190025,15.1051367 26.8190025,15.6467051 27.1571305,15.9798301 L31.4920788,20.2506367 C31.6620369,20.4163184 31.8839335,20.5000801 32.1059113,20.5000801 C32.3278892,20.5000801 32.5497857,20.4163984 32.7180369,20.2506367 C33.056165,19.9174316 33.056165,19.3759434 32.7180369,19.0428184 Z"></path>
              <path d="M25.8479409,27.5093184 C25.4352783,27.1027617 24.9410911,26.8260117 24.4139039,26.6825117 C25.4074803,25.4047051 25.3086429,23.5613867 24.1138966,22.3843184 C23.701234,21.9794434 23.2070468,21.7026934 22.6816478,21.55575 C23.6735172,20.2761816 23.5746798,18.4363066 22.3799335,17.2593184 C21.9758867,16.86125 21.4921034,16.5879434 20.9806034,16.4393184 L24.0532611,13.412125 C25.3433498,12.1394434 25.3433498,10.0689434 24.0428571,8.78769336 C22.7510616,7.51501172 20.6511724,7.51501172 19.3593768,8.78769336 L7.55431773,20.418 L6.45499507,13.51975 C6.18449261,11.6559316 4.54066995,10.25 2.62805172,10.25 C1.19401478,10.25 0.0270665025,11.3996816 0.0270665025,12.8125 L0.0270665025,28.920375 C0.0270665025,31.4299434 1.01893596,33.789125 2.82052463,35.5640566 L5.54806404,38.2512383 C7.34623892,40.0245684 9.73914532,41 12.2829089,41 C14.6585025,41 16.9351773,40.1321934 18.6934433,38.5570566 L25.8582635,32.13375 C27.1484335,30.8610684 27.1484335,28.7905684 25.8479409,27.5093184 Z M24.6618916,30.898625 L17.5264951,37.294625 C16.0890443,38.581 14.2267389,39.2916934 12.2829089,39.2916934 C10.2021207,39.2916934 8.2461798,38.493875 6.77402217,37.0435 L4.04648276,34.3563184 C2.57261823,32.9042617 1.76111084,30.9738184 1.76111084,28.920375 L1.76111084,12.8125 C1.76111084,12.341 2.14955172,11.9583066 2.628133,11.9583066 C3.68242611,11.9583066 4.58927586,12.7338633 4.740133,13.7742383 L6.10654433,22.3397949 C6.15685714,22.6575449 6.38395567,22.9189199 6.694367,23.0197383 C7.00477833,23.1187949 7.3446133,23.0367949 7.5752069,22.8112949 L20.5852537,9.99375 C21.2007931,9.389 22.2013596,9.38731836 22.827303,10.004 C23.4428424,10.6104316 23.4428424,11.5961934 22.827303,12.202625 L14.1522044,20.7494434 C13.9840345,20.9168867 13.8990148,21.1355 13.8990148,21.3541934 C13.8990148,21.5728867 13.9839532,21.7915 14.1522044,21.9572617 C14.4903325,22.2903867 15.0400345,22.2903867 15.3781626,21.9572617 L18.9207044,18.4671367 C19.5362438,17.8623867 20.5368103,17.8607051 21.1627537,18.4773867 C21.7782931,19.0838184 21.7782931,20.0695801 21.1627537,20.6760117 L17.6202118,24.1661367 C17.4520419,24.3335801 17.3670222,24.5521934 17.3670222,24.7708867 C17.3670222,24.9895801 17.4519606,25.2081934 17.6219187,25.3739551 C17.9600468,25.7070801 18.5097488,25.7070801 18.8478768,25.3739551 L20.6564557,23.5921367 C21.2719951,22.9873867 22.2725616,22.9857051 22.8985049,23.6023867 C23.5140443,24.2088184 23.5140443,25.1945801 22.8985049,25.8010117 L21.0899261,27.5828301 C21.0882192,27.5828301 21.0882192,27.5862734 21.086431,27.5862734 C20.751798,27.9210801 20.7535049,28.4592051 21.0899261,28.7906484 C21.4280542,29.1237734 21.9777562,29.1237734 22.3158842,28.7906484 L22.3904187,28.7172168 C22.9869384,28.1295234 24.0169286,28.1210352 24.632468,28.7274668 C25.2480074,29.3338184 25.2480074,30.3195 24.6618916,30.898625 Z"></path>
              <path d="M21.7019704,3.41669336 C18.6501207,3.41669336 15.8618645,5.19675 14.5977857,7.948875 C14.4018177,8.379375 14.5960788,8.88506836 15.0312562,9.07981836 C15.4665148,9.27288672 15.9815099,9.0815 16.1791847,8.65276172 C17.1623571,6.51043164 19.3298719,5.125 21.7019704,5.125 C25.0485443,5.125 27.7709631,7.80705664 27.7709631,11.1041934 C27.7709631,13.4411934 26.3647241,15.5766367 24.1903005,16.5452617 C23.753335,16.7383301 23.5591552,17.2457051 23.75683,17.6744434 C23.9007783,17.9905117 24.2163103,18.1766934 24.5475296,18.1766934 C24.665468,18.1766934 24.7868202,18.15275 24.9029704,18.1015 C27.6981355,16.8578066 29.5049261,14.1108066 29.5049261,11.1041934 C29.5049261,6.86581836 26.004,3.41669336 21.7019704,3.41669336 Z"></path>
            </g>
          </g>
        </svg>
      </figure>
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
