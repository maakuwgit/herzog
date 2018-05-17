<?php
/**
* locations
* -----------------------------------------------------------------------------
*
* locations component
*/

$default_data  = [
  'num_locations'   => 6,
  'use_interactions' => true
];
$default_args   = [
  'classes' => array(),
  'id'      => uniqid('locations-')
];

$data = ll_parse_args( $component_data, $default_data );
$args = ll_parse_args( $component_args, $default_args );

/**
 * component_name_before_display hook
 * Type: Action
 */
do_action( "component_name_before_display", $data, $args );

/**
 * Any additional classes to apply to the main component container.
 *
 * @var array
 * @see args['classes']
 */
$classes          = $args['classes'];
$id               = $args['id'];
$use_interactions = $data['use_interactions'];
$num              = $data['num_locations'];

$qargs    = array(
              'post_type'     => 'location',
              'post_status'   => 'publish',
              'order'         => 'ASC',
              'showposts'     => $num
            );

$locations = new WP_Query( $qargs );

if ( $locations->have_posts() ) : ?>
  <dl class="container row <?php echo implode( " ", $classes ); ?>" <?php echo ( $id ? 'id="'.$id.'"' : '' ) ?> data-component="locations"">
      <?php
        while( $locations->have_posts() ) :
          $locations->the_post();

          //Location Info
          $location = array(
            'title'   => get_the_title(),
            'phone'   => get_field('location_phone'),
            'address' => get_field('location_address'),
            'state'   => get_the_terms(get_the_ID(), 'location_state'),
            'hero'    => get_field('hero_background_image')
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

          $contact = false;

          $hero = $location['hero'];
          $abbr = get_field('division_logo_reversed');
          if( $abbr ){
            $abbr = ll_format_image($abbr);
          }else{
            $abbr = '<img alt="" src="//via.placeholder.com/158x100"
  srcset="//via.placeholder.com/632x400 2x, //via.placeholder.com/948x600 3x" data-src-md="//via.placeholder.com/316x200" data-src-lg="//via.placeholder.com/632x400 data-src-xl="//via.placeholder.com/948x600">';
          }
      ?>
        <div class="col col-sm-4of12 col-md-6of12 col-lg-3of12 col-xl-3of12 text-center"<?php if( $use_interactions ) echo ' data-clickthrough';?>>
          <dt class="col text-left"><?php echo $abbr; ?></dt>
          <dd class="col text-left">
            <h6><?php echo $location['title']; ?></h6>
            <?php if( $use_interactions !== true) : ?>
              <?php echo $phone; ?>
              <?php echo $address; ?>
              <?php echo $contact; ?>
            <?php else : ?>
            <a class="button dark" href="<?php the_permalink();?>">
              <span class="icon icon-plus">+</span>Learn More
            </a>
              <?php if( $hero ) : ?>
            <figure>
              <?php echo ll_format_image($hero); ?>
            </figure>
              <?php endif; ?>
            <?php endif; ?>
          </dd>
        </div>
      <?php
        endwhile;
        wp_reset_postdata();
      ?>
  </dl><!-- Divisions -->
<?php endif; ?>

<?php
/**
 * component_name_after_display hook
 * Type: Action
 */
do_action( "component_name_after_display", $data, $args ); ?>
