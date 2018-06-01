<?php
/**
 *
 * Lifted Logic custom functions
 *
 */
$num_sections = 0;
/**
 * Get post meta shortcut
 */
function meta( $key ) {
  global $post;
  return get_post_meta($post->ID, $key, true);
}

/**
 * Formats text like the default WordPress wysiwyg
 */
function format_text( $content ) {
  $content = apply_filters('the_content', $content);
  return $content;
}

/*
 *
 */
function ll_format_image( $hero, $data='' ) {
  return '<img' . ($data ? ' '.$data : '') . ' alt="'.$hero['title'].'" src="'.$hero['sizes']['medium'].'"
  srcset="'.$hero['sizes']['large'].' 2x, '.$hero['url'].' 3x" data-src-md="'.$hero['sizes']['medium'].'" data-src-lg="'.$hero['sizes']['large'].'" data-src-xl="'.$hero['url'].'">';
}

/**
 * var_dump variable
 * wrap it in a <pre> tag
 */
function _pre_var() {
  $args = func_get_args();

  echo '<pre>';
  call_user_func_array( 'var_dump', $args );
  echo '</pre>';
}

/**
 * Custom background function
 */
function set_post_background() {
  global $post;
  $bgimage = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "Full");
  if (!empty($bgimage)) {
    return '<style type="text/css">body {background-image: url('.$bgimage[0].');} </style>';
  }
}

function ll_get_locations( $use_grid=true, $echo=true ) {
  if( $use_grid ) {
    $css = ' col-sm-8of12 col-md-8of12 col-lg-6of12 col-xl-6of12';
  }
  $args = array(
      'post_type'     => 'location',
      'post_status'   => 'publish',
      'order'         => 'ASC',
      'showposts'     => 6
  );

  $locations = new WP_Query( $args );

  if ( $locations->have_posts() ) {
    $output = '<ul class="no-bullet header__menu' . $css . '"><li>';
    $output .= '<dl class="menu row">';
    while( $locations->have_posts() ) {
      $locations->the_post();
      $id       = get_the_ID();
      $title    = get_the_title();
      $city     = $title;
      $state    = get_the_terms($id, 'state');
      if( $state ) {
        $title .= ',&nbsp;' . strtoupper( $state[0]->slug );
      }
      $street   = get_field('location_street');
      $zip      = get_field('location_zip');
      $country  = get_field('location_country');
      $phone    = get_field('location_phone');
      $email    = get_field('location_email');

      $address  = $street . '<br>' . $title . '&nbsp;' . $zip;
      if( $phone ) {
        $p_href = 'tel:+1' . substr($phone, 0, 3) . substr($phone, 4, 3) . substr($phone, 6);
        $phone  = '+' . substr($phone, 0, 3) . '.' . substr($phone, 4, 3) . '.' . substr($phone, 6);
      }
      if( $email ) {
        $e_href = 'mailto:' . $email;
      }

      $output .= '<div class="col-6of12">';
      $output .= '<dt class="h5">' . $title . '</dt>';
      $output .= '<dd>';
      $output .= '<address>' . $address . '</address>';
      if( $phone ) {
        $output .= '<a class="block" href="' . $p_href . '">' . $phone . '</a>';
      }
      if( $email ) {
        $output .= '<a class="block" href="' . $e_href . '">' . $email . '</a>';
      }
      $output .= '</dd>';
      $output .= '</div>';
    }
  }

  wp_reset_postdata();
  $output .= '</dl></li></ul>';

  if( $echo === true ) {
    echo $output;
  }else{
    return $output;
  }
}

/**
 * Read all the section info and return the Section Nav component
 *  or echo it out
 */
function ll_section_nav($args) {
  global $num_sections;

  $label  = ( isset($args['section']) ? $args['section'] : false);
  $id     = ( isset($args['id']) ? $args['id'] : false);

  if( $label ) {
    $index = '0'.$num_sections;
    $num_sections++;

    $section = array(
      'anchor_btn_label'  => $label,
      'anchor_btn_target' => $id
    );

    if( $section['anchor_btn_target'] ){
      ll_include_component(
        'section-nav',
        $section,
        array(
          'index' => $index
        )
      );
    }
  }
}

/**
 * Get attachement image
 */
function ll_get_banner_image( $id=null ) {
  global $post;
  if ( !$id ) {
    $id = $post->ID;
  }
  $post_image = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), "Full");
  $banner_image;

  if ( !empty( $post_image ) ) {
    $banner_image = $post_image[0];
  }


  return $banner_image;
}


function ll_format_post_banner( $post_id=null ) {
  global $post;
  if ( !$post_id ) {
    $post_id = $post->ID;
  }

  $hero_banner = array(
    'main_text'        => get_field( 'hero_banner_main_text', $post_id ),
    'sub_text'         => get_field( 'hero_banner_sub_text', $post_id ),
    'call_to_action'   => get_field( 'hero_banner_cta', $post_id ),
    'background_image' => wp_get_attachment_image_src( get_field( 'hero_banner_background_image', $post_id ), 'll_full_image' ),
    'loop_video'       => get_field( 'hero_banner_loop_video', $post_id ),
    'popup_video'      => get_field( 'hero_banner_popup_video', $post_id ),
    'show_icons'       => get_field( 'hero_banner_show_icons', $post_id )
  );

  if ( !$hero_banner['main_text']['text'] ) {
    $hero_banner['main_text']['text'] = get_the_title( $post_id );
    $hero_banner['main_text']['tag'] = 'h1';
  }

  if ( !$hero_banner['sub_text']['text'] ) {

    $categories = wp_get_post_categories( $post_id );

    if ( $categories ) {
      foreach ($categories as $cat_key => $category) {
        if ( $cat_key == 0 ) {
          $hero_banner['sub_text']['text'] .= get_cat_name( $category );
        } else {
          $hero_banner['sub_text']['text'] .= ', '.get_cat_name( $category );
        }
      }

    }
    $hero_banner['sub_text']['tag']  = 'p';
  }

  if ( !$hero_banner['background_image'] ) {
    $hero_banner['background_image'] = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'll_full_image' );
  }

  return $hero_banner;
}
/**
* Converts phone numbers to the formatting standard
*
* @param   String   $num   A unformatted phone number
* @return  String   Returns the formatted phone number
*/
function format_phone( $num,$area = false,$sep='-' ) {

  $num = preg_replace( '/[^0-9]/', '', $num );
  $len = strlen( $num );

  if( $len == 7 ) {

    $num = preg_replace( '/([0-9]{3})([0-9]{4})/', '$1'.$sep.'$2', $num );
  }
  elseif( $len == 10 ) {

    if ( $area )
      $num = preg_replace( '/([0-9]{3})([0-9]{3})([0-9]{4})/','($1) $2'.$sep.'$3', $num );
    else
      $num = preg_replace( '/([0-9]{3})([0-9]{3})([0-9]{4})/','$1'.$sep.'$2'.$sep.'$3', $num );
  }

  return $num;
}

/**
* Strips all non-numeric characters from a string
*
* @param   String   $num   A unformatted phone number
* @return  String   Returns number without any special characters or spaces
*/
function strip_phone($num) {
  $num = preg_replace('/[^0-9]/','',$num);
  return $num;
}

/**
 * returns values from custom site options
 * @param  string $context context name of option i.e global, contact
 * @param  String $option_name key of the option i.e _logo_ or _facebook_
 * @return mixed
 */
function ll_get_option( $context = false, $option_name = 'option' ) {
  global $ll_options;
  $ll_options = get_fields( $option_name );

  if ( $context ) {
    return $ll_options[ $context ];
  } else {
    return $ll_options;
  }
}

function ll_get_forms_as_options() {
  if ( !class_exists( 'RGFormsModel' ) )
    return;

  $forms = RGFormsModel::get_forms( null, 'title' );
  $options = array();

  if ( empty( $forms ) ) {
    $forms = array();
  };

  foreach ( $forms as $key => $form ) {
    $options[ $form->id ] = $form->title;
  };

  return $options;
}


/**
 * Get all social media options as a key=>value pair of
 * "social_name" => "social_link". To use, make sure all social media
 * options under "Contact Options" are prefixed with _options_contact_social.
 * Example: _options_contact_social_facebook
 * @return Boolean/Array if there is even one single social link, return the array,
 * else, return boolean false
 */
function ll_has_social() {

  $social_media_sites = array(
    'facebook' => get_field( 'social_facebook', 'option' ),
    'twitter' => get_field( 'social_twitter', 'option' ),
    'instagram' => get_field( 'social_instagram', 'option' ),
    'google_plus' => get_field( 'social_google_plus', 'option' ),
    'youtube' => get_field( 'social_youtube', 'option' ),
    'linkedin' => get_field( 'social_linkedin', 'option' ),
    'pinterest' => get_field( 'social_pinterest', 'option' ),
  );

  if ( $social_media_sites ) {
    return $social_media_sites;
  } else {
    return false;
  }
}

/**
 * Get all social media options as a key=>value pair of
 * "social_name" => "social_link". To use, make sure all social media
 * options under "Contact Options" are prefixed with _options_contact_social.
 * Example: _options_contact_social_facebook
 * @param  $css a css class to add to the ul element
 * @return array array of social media sites and links
 */
function ll_get_social_list( $css = '' ) {

  if ( $social_media_sites = ll_has_social() ) {
    if ( $css !== '' ) $css = ' ' . $css;
    echo '<ul class="social-list'.$css.'">';
      foreach ( $social_media_sites as $social => $link ) {
        if( $link ) {
          echo '<li class="social-list__item"><a class="social-list__link '.$social.'" href="'.$link.'" target="_blank"><svg class="icon icon-'.$social.'"><use xlink:href="#icon-'.$social.'"></use></svg></a></li>';
        }
      }
    echo '</ul>';
  }
}


/**
 * Set custom logo for the Wordpress login page
 */
function ll_custom_login_logo() {

  $logo = get_field( 'global_logo', 'option' );

  if ( $logo ) : ?>
    <style type="text/css">
      #login h1 a, .login h1 a {
        background-image: url(<?php echo $logo['url']; ?> );
        width: 100%;
        height: auto;
        min-height: 100px;
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center center;
      }
    </style>
  <?php endif; ?>
<?php }
add_action( 'login_enqueue_scripts', 'll_custom_login_logo' );

function ll_custom_login_logo_url() {
  return home_url();
}
add_filter( 'login_headerurl', 'll_custom_login_logo_url' );

function ll_custom_login_logo_url_title() {
  return get_bloginfo( 'description' );
}
add_filter( 'login_headertitle', 'll_custom_login_logo_url_title' );

/**
* ll_stop_reordering_my_categories
* -----------------------------------------------------------------------------
* Keep categories and taxonomies in their hierarchical order rather than showing selected on top.
*
*/
function ll_stop_reordering_my_categories($args) {
  $args['checked_ontop'] = false;
  return $args;
}
add_filter('wp_terms_checklist_args','ll_stop_reordering_my_categories');

/**
* ll_generate_schema_json
* -----------------------------------------------------------------------------
* Keep categories and taxonomies in their hierarchical order rather than showing selected on top.
*
*/

function ll_generate_schema_json() {
  $schema = array(
    '@context'  => 'http://schema.org',
    '@type'     => get_field('schema_type', 'option'),
    'name'      => get_bloginfo('name'),
    'url'       => get_home_url(),
    'telephone' => strip_phone( get_field('contact_phone_number', 'option') ),
    'email' => get_field('contact_email_address', 'option'),
    'address'   => array(
      '@type'           => 'PostalAddress',
      'streetAddress'   => get_field('contact_street_address', 'option'),
      'postalCode'      => get_field('contact_zip', 'option'),
      'addressLocality' => get_field('contact_city', 'option'),
      'addressRegion'   => get_field('contact_state', 'option'),
      'addressCountry'  => get_field('contact_country', 'option')
    )
  );
  /// LOGO
  if (get_field('schema_logo', 'option')) {
    $schema['logo'] = get_field('schema_logo', 'option');
  }
  /// IMAGE
  if (get_field('schema_building_photo', 'option')) {
    $schema['image'] = get_field('schema_building_photo', 'option');
  }
  /// SOCIAL MEDIA
  // Google only looks for these 6 social media sites (and MySpace)
  $social_media_sites = array(
    'facebook' => get_field( 'social_facebook', 'option' ),
    'twitter' => get_field( 'social_twitter', 'option' ),
    'instagram' => get_field( 'social_instagram', 'option' ),
    'google_plus' => get_field( 'social_google_plus', 'option' ),
    'youtube' => get_field( 'social_youtube', 'option' ),
    'linkedin' => get_field( 'social_linkedin', 'option' )
  );

  if ( ll_filter_array( $social_media_sites ) ) {
    $schema['sameAs'] = array();
    foreach ( $social_media_sites as $key => $social_media ) {
      if ( $social_media ) {
        array_push( $schema['sameAs'], $social_media );
      }
    }
  }
  /// OPENING HOURS
  if (have_rows('scehma_openings', 'option')) {
    $schema['openingHoursSpecification'] = array();
    while (have_rows('scehma_openings', 'option')) : the_row();
    $closed = get_sub_field('closed');
    $from   = $closed ? '00:00' : get_sub_field('from');
    $to     = $closed ? '00:00' : get_sub_field('to');
    $openings = array(
      '@type'     => 'OpeningHoursSpecification',
      'dayOfWeek' => get_sub_field('days'),
      'opens'     => $from,
      'closes'    => $to
      );
    array_push($schema['openingHoursSpecification'], $openings);
    endwhile;
    /// VACATIONS / HOLIDAYS
    if (have_rows('schema_special_days', 'option')) {
      while (have_rows('schema_special_days', 'option')) : the_row();
      $closed    = get_sub_field('closed');
      $date_from = get_sub_field('date_from');
      $date_to   = get_sub_field('date_to');
      $time_from = $closed ? '00:00' : get_sub_field('time_from');
      $time_to   = $closed ? '00:00' : get_sub_field('time_to');
      $special_days = array(
        '@type'        => 'OpeningHoursSpecification',
        'validFrom'    => $date_from,
        'validThrough' => $date_to,
        'opens'        => $time_from,
        'closes'       => $time_to
        );
      array_push($schema['openingHoursSpecification'], $special_days);
      endwhile;
    }
  }
  echo '<script type="application/ld+json">' . json_encode($schema) . '</script>';
}
add_action( 'wp_head', 'll_generate_schema_json'  );

/**
* ll_update_filterable_divisions
* -----------------------------------------------------------------------------
* Update the component Locations Filterable content
* Dev Note: the AJAX was the last issue I ran into..
function ll_filter_locations() {
  $fetch = esc_sql( $_POST );
  if( $fetch ){
    $query_args = array(
          'post_type'     => 'location',
          'post_status'   => 'publish',
          'order'         => 'ASC',
          'showposts'     => -1,
          'tax_query'     => array(
            array(
              'taxonomy'   => 'location_group',
              'field'      => 'slug',
              'terms'      => $group->slug
            )
          )
        );
        $the_query = new WP_Query( $query_args );

    if ( $the_query->have_posts() ) {
      while ( $the_query->have_posts() ) {
        $the_query->the_post();
        $slug = get_post_field('post_name');
        $return_str.= '<div class="container row start" id="' . $slug . '">';
        $return_str.= '<div class="col col-md-4of12 col-lg-3of12 col-xl-3of12">';
        $return_str.= '<h3 class="h5">' . get_the_title() . '</h3>';
        $return_str.= '</div>';

        $qargs    = array(
                      'post_type'     => 'location',
                      'post_status'   => 'publish',
                      'order'         => 'ASC',
                      'showposts'     => -1,
                      'tax_query'     => array(
                        array(
                          'taxonomy'   => 'location_group',
                          'field'      => 'slug',
                          'terms'      => $slug
                        )
                      )
                    );

        $locations = new WP_Query( $qargs );
        if ( $locations->have_posts() ) {
          $return_str.= '<div class="col col-md-8of12 col-lg-9of12 col-xl-9of12">';
          $return_str.= '<dl class="row start">';

          while( $locations->have_posts() ) {
            $locations->the_post();

            //Location Info
            $location = array(
              'title'   => get_the_title(),
              'phone'   => get_field('location_phone'),
              'address' => get_field('location_address'),
              'state'   => get_the_terms(get_the_ID(), 'location_state')
            );

            $address = $city = $state = $country = '';
            if( $location['address'] ) {
              $address = '<address>' . $location['address'];
              if ( $location['state'] ) {
                $location_ordered = [];

                foreach( $location['state'] as $term ){

                    $depth = count( get_ancestors( $term->term_id, 'location_state' ) );

                    if( ! array_key_exists( $depth, $location_ordered ) ){
                        $location_ordered[$depth] = [];
                    }

                    $location_ordered[$depth][] = $term;

                }

                //First, parse the Country (for later use in the phone)
                $country = $location_ordered[0];
                if( $country ) {
                  if( $country[0]->slug === 'us' ) {
                    $country_code = 1;//get_field('country_code', 'location_state');
                    $country = strtoupper( $country[0]->slug );
                  }else{
                    $country = lcfirst( $country[0]->name );
                  }
                }
                //Parse the State
                if( sizeof( $location_ordered ) > 1) {
                  $state = $location_ordered[1];
                  if( $state ) {
                    $state = strtoupper( $state[0]->slug );
                  }
                }else{
                  $state = false;
                }

                if( sizeof( $location_ordered ) > 1 ) {
                  //First, get the city since it's last in the heirarchy
                  $city = $location_ordered[2];
                  if( $city ) {
                    $city = $city[0]->name;
                  }
                }else{
                  $city = false;
                }

                if( $city && $state ) {
                  //Now add it all to the string
                  $address .=  '<br>' . $city . ',&nbsp;' . $state;
                }
              }
              $address .= '</address>';
            }

            $phone = str_replace( '-', '', $location['phone'] );
            $phone = '<a class="block" href="tel:+' . $country_code . $phone . '">' . $location['phone'] . '</a>';

            $contact = get_field('location_contact');
            $contact = '<a href="mailto:'.$contact.'">Send a message</a>';

            $return_str.= '<div class="col col-sm-4of12 col-md-6of12 col-lg-4of12 col-xl-4of12 text-center">';
            $return_str.= '<dt class="col text-left text-medium">' . $location['title'] . '</dt>';
            $return_str.= '<dd class="col text-left">';
            $return_str.= $phone;
            $return_str.= $address;
            $return_str.= $contact;
            $return_str.= '</dd></div>';
          }

          wp_reset_postdata();
          $return_str.= '</dl><!-- Locations Filterable -->';
          $return_str.= '</div>';
        }

        $return_str .= '</div>';
      }
      wp_reset_postdata();
    }

  echo $return_str;
  var_dump($return_str);
  die;
  }
}

add_action( 'wp_ajax_load-filter', 'll_filter_locations' );
add_action( 'wp_ajax_nopriv_load-filter', 'll_filter_locations' );
*/