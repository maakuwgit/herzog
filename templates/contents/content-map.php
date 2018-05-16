<?php
  $args = array(
      'post_type'     => 'location',
      'post_status'   => 'publish',
      'order'         => 'ASC',
      'showposts'     => 6
  );

  $locations = new WP_Query( $args );

  if ( $locations->have_posts() ) :
?>
<article <?php post_class('map'); ?>>
  <div id="contact_map"></div>
  <script>
      function initMap(e) {
      <?php
        $first  = true;
        $pin    = get_template_directory_uri() . '/assets/img/svg/location.svg';

        while( $locations->have_posts() ) :
          $locations->the_post();
          $latitude = get_field('latitude');
          $longitude = get_field('longitude');
          if( $longitude && $latitude ) :
            if ( $first === true ) :
      ?>
        var first_location = {lat:<?php echo $latitude;?>, lng:<?php echo $longitude;?>};
        var map = new google.maps.Map(document.getElementById('contact_map'), {
          zoom: 7,
          center: first_location,
          styles: [
              {
                  "featureType": "water",
                  "elementType": "geometry",
                  "stylers": [
                      {
                          "color": "#e9e9e9"
                      },
                      {
                          "lightness": 17
                      }
                  ]
              },
              {
                  "featureType": "landscape",
                  "elementType": "geometry",
                  "stylers": [
                      {
                          "color": "#f5f5f5"
                      },
                      {
                          "lightness": 20
                      }
                  ]
              },
              {
                  "featureType": "road.highway",
                  "elementType": "geometry.fill",
                  "stylers": [
                      {
                          "color": "#ffffff"
                      },
                      {
                          "lightness": 17
                      }
                  ]
              },
              {
                  "featureType": "road.highway",
                  "elementType": "geometry.stroke",
                  "stylers": [
                      {
                          "color": "#ffffff"
                      },
                      {
                          "lightness": 29
                      },
                      {
                          "weight": 0.2
                      }
                  ]
              },
              {
                  "featureType": "road.arterial",
                  "elementType": "geometry",
                  "stylers": [
                      {
                          "color": "#ffffff"
                      },
                      {
                          "lightness": 18
                      }
                  ]
              },
              {
                  "featureType": "road.local",
                  "elementType": "geometry",
                  "stylers": [
                      {
                          "color": "#ffffff"
                      },
                      {
                          "lightness": 16
                      }
                  ]
              },
              {
                  "featureType": "poi",
                  "elementType": "geometry",
                  "stylers": [
                      {
                          "color": "#f5f5f5"
                      },
                      {
                          "lightness": 21
                      }
                  ]
              },
              {
                  "featureType": "poi.park",
                  "elementType": "geometry",
                  "stylers": [
                      {
                          "color": "#dedede"
                      },
                      {
                          "lightness": 21
                      }
                  ]
              },
              {
                  "elementType": "labels.text.stroke",
                  "stylers": [
                      {
                          "visibility": "on"
                      },
                      {
                          "color": "#ffffff"
                      },
                      {
                          "lightness": 16
                      }
                  ]
              },
              {
                  "elementType": "labels.text.fill",
                  "stylers": [
                      {
                          "saturation": 36
                      },
                      {
                          "color": "#333333"
                      },
                      {
                          "lightness": 40
                      }
                  ]
              },
              {
                  "elementType": "labels.icon",
                  "stylers": [
                      {
                          "visibility": "off"
                      }
                  ]
              },
              {
                  "featureType": "transit",
                  "elementType": "geometry",
                  "stylers": [
                      {
                          "color": "#f2f2f2"
                      },
                      {
                          "lightness": 19
                      }
                  ]
              },
              {
                  "featureType": "administrative",
                  "elementType": "geometry.fill",
                  "stylers": [
                      {
                          "color": "#fefefe"
                      },
                      {
                          "lightness": 20
                      }
                  ]
              },
              {
                  "featureType": "administrative",
                  "elementType": "geometry.stroke",
                  "stylers": [
                      {
                          "color": "#fefefe"
                      },
                      {
                          "lightness": 17
                      },
                      {
                          "weight": 1.2
                      }
                  ]
              }
          ]
        });
      <?php
          $first = false;
          endif;
      ?>

    var location<?php the_ID(); ?> = {lat:<?php echo $latitude;?>, lng:<?php echo $longitude;?>}
        var marker<?php the_ID(); ?> = new google.maps.Marker({
          position: location<?php the_ID(); ?>,
          icon: "<?php echo $pin;?>",
          map: map
        });
          <?php endif; ?>
      <?php endwhile; ?>
      }

      initMap();
  </script>
</article>
<?php wp_reset_query(); ?>
<?php endif; ?>