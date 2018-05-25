<?php
/**
* locations
* -----------------------------------------------------------------------------
*
* locations component
*/
$id = uniqid('locations-filterable-');

$default_data  = [];
$default_args   = [
  'classes'  => array(),
  'id'       => $id
];

$data = ll_parse_args( $component_data, $default_data );
$args = ll_parse_args( $component_args, $default_args );

$css = 'class="locations-filterable content';
if( $args['classes'] ) {
  if( is_array($args['classes'] ) ) {
    $css .= implode( " ", $args['classes'] );
  }else{
    $css .= ' ' . $args['classes'];
  }
}
$css .= '"';
$id = ($args['id'] ? ' id="' . $args['id'] . '"' : '');

$groups = get_terms( array(
  'taxonomy'   => 'location_group',
  'hide_empty' => true,
  'order'      => 'DESC'
));

if ( $groups ) :

?>
<section <?php echo $id . $css ?> data-component="locations-filterable">
  <div class="container row start">
    <header class="col">
      <h2>Offices &amp; Locations</h2>
    </header>
  </div>
  <div class="container row start filters">
    <?php if( $groups ) : ?>
    <div class="col col-md-4of12 col-lg-3of12 col-xl-3of12">
      <select id="filter_divisions">
        <option value="">Filter by Division</option>
      <?php foreach( $groups as $division ) : ?>
        <option value="<?php echo $division->slug; ?>"><?php echo $division->name; ?></option>
      <?php endforeach; ?>
      </select>
    </div>
    <?php endif; ?>
    <?php
      $largs    = array(
                    'post_type'     => 'location',
                    'post_status'   => 'publish',
                    'order'         => 'ASC',
                    'showposts'     => -1
                  );

      $locations = new WP_Query( $largs );
      if ( $locations->have_posts() ) : ?>
    <div class="col col-md-4of12 col-lg-3of12 col-xl-3of12">
      <select name="filter_locations" id="filter_locations">
        <option value="">Filter by Location</option>
      <?php
        while( $locations->have_posts() ) :
          $locations->the_post(); ?>
        <option value="<?php echo get_post_field('post_name');?>"><?php the_title(); ?></option>
      <?php endwhile;
        wp_reset_postdata();
      ?>
      </select>
    </div>
    <?php endif; ?>
    <div class="col col-md-4of12 col-lg-6of12 col-xl-6of12">
      <input id="search_locations" value="" placeholder="Search Locations">
    </div>
  </div>
  <div id="divisions">
  <?php foreach( $groups as $group ) : ?>
    <div class="container row start" id="<?php echo $group->slug;?>">
      <div class="col col-md-4of12 col-lg-3of12 col-xl-3of12">
        <h3 class="h5"><?php echo $group->name; ?></h3>
      </div>
    <?php
      $qargs    = array(
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

      $locations = new WP_Query( $qargs );
      if ( $locations->have_posts() ) : ?>
      <div class="col col-md-8of12 col-lg-9of12 col-xl-9of12">
        <dl class="row start">
        <?php
          while( $locations->have_posts() ) :
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
        ?>
          <div class="col col-sm-4of12 col-md-6of12 col-lg-4of12 col-xl-4of12 text-center">
            <dt class="col text-left text-medium"><?php echo $location['title']; ?></dt>
            <dd class="col text-left">
              <?php echo $phone; ?>
              <?php echo $address; ?>
              <?php echo $contact; ?>
            </dd>
          </div>
        <?php
          endwhile;
        wp_reset_postdata();
        ?>
        </dl><!-- Locations Filterable -->
      </div>
    <?php endif; ?>
    </div>
  <?php endforeach; ?>
  </div>
</section>
<?php
endif;
/**
 * component_name_after_display hook
 * Type: Action
 */
do_action( "component_name_after_display", $data, $args ); ?>
