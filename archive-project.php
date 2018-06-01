<div class="globe col" id="project-globe" data-globe>
  <!-- Dev Note: put the texture image in here for SEO -->
</div>
<main class="content hero flex">
<?php
  while (have_posts()) : the_post();
    $location     = get_field('project_location');
    $divisions    = get_field('project_division');
    $capabilities = get_field('project_capabilities');
    $client       = get_field('project_client');
    $completed    = get_field('project_completion');
    $types        = get_the_terms(get_the_ID(), 'project_type');

    if( $location ) {
      $state   = get_term($location[1]);
      $city    = get_the_category_by_ID($location[2]);

      //Failsafes
      if( !$city ) {
        $city = '';
      }
      if( !$state ) {
        $state = '';
      }
      $location = $city . ', <span class="text-uppercase">' . ($state->slug) . '</span>';
    }
?>
  <div class="container row start">
    <header class="col col-12of12">
      <h1><?php the_title(); ?></h1>
      <?php if( $location ) : ?>
      <h2 class="text-normal"><?php echo $location; ?></h2>
      <?php endif; ?>
    </header>
  </div>
  <div class="container row stretch">
    <div class="col col-md-6of12 col-lg-6of12 col-xl-6of12">
      <dl class="container row">
      <?php if( $types ) : ?>
        <?php if( sizeof($types) > 1 ) : ?>
        <dt class="col col-md-6of12 col-lg-6of12 col-xl-6of12">Project Types</dt>
        <dd class="col col-md-6of12 col-lg-6of12 col-xl-6of12">
          <ul class="no-bullet">
          <?php foreach( $types as $type ) : ?>
            <li><?php echo $type->post_title; ?></li>
          <?php endforeach;?>
          </ul>
        </dd>
        <?php else : ?>
        <dt class="col col-md-6of12 col-lg-6of12 col-xl-6of12">Project Type</dt>
        <dd class="col col-md-6of12 col-lg-6of12 col-xl-6of12"><?php echo $types[0]->name; ?></dd>
        <?php endif; ?>
      <?php endif; ?>
        <dt class="col col-md-6of12 col-lg-6of12 col-xl-6of12">Year Completed</dt>
        <dd class="col col-md-6of12 col-lg-6of12 col-xl-6of12"><?php echo $completed; ?></dd>
      </dl>
    </div>
    <div class="col col-md-6of12 col-lg-6of12 col-xl-6of12">
      <dl class="container row">
      <?php if( $divisions ) : ?>
        <?php if( sizeof($divisions) > 1 ) : ?>
        <dt class="col col-md-6of12 col-lg-6of12 col-xl-6of12">Divisions</dt>
        <dd class="col col-md-6of12 col-lg-6of12 col-xl-6of12">
          <ul class="no-bullet">
          <?php foreach( $divisions as $division ) : ?>
            <li><?php echo $division->post_title; ?></li>
          <?php endforeach;?>
          </ul>
        </dd>
        <?php
          else :
          $abbr = get_field('division_abbreviation', $divisions[0]->ID);
        ?>
        <dt class="col col-md-6of12 col-lg-6of12 col-xl-6of12">Division</dt>
        <dd class="col col-md-6of12 col-lg-6of12 col-xl-6of12"><?php echo $abbr; ?></dd>
      <?php endif; ?>
      <?php endif; ?>
      <?php if( $capabilities ) : ?>
        <?php if( sizeof($capabilities) > 1 ) : ?>
        <dt class="col col-md-6of12 col-lg-6of12 col-xl-6of12">Capabilities</dt>
        <dd class="col col-md-6of12 col-lg-6of12 col-xl-6of12">
          <ul class="no-bullet">
          <?php foreach( $capabilities as $capability ) : ?>
            <li><?php echo $capability->post_title; ?></li>
          <?php endforeach;?>
          </ul>
        </dd>
        <?php else : ?>
        <dt class="col col-md-6of12 col-lg-6of12 col-xl-6of12">Capability</dt>
        <dd class="col col-md-6of12 col-lg-6of12 col-xl-6of12"><?php echo $capabilities[0]->post_title; ?></dd>
        <?php endif; ?>
      <?php endif; ?>
      </dl>
    </div>
  </div>
<?php endwhile; ?>
</main>
<article <?php post_class('content'); ?>>
  <div class="container row">
<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/contents/content', 'components'); ?>
<?php endwhile; ?>
  </div>
</article>
<?php get_template_part('templates/contents/content', 'callout'); ?>
<script type="text/javascript" defer>

    if(!Detector.webgl){
      Detector.addGetWebGLMessage();
    } else {

      var container = document.getElementById('project-globe');
      var globe = new DAT.Globe(container);
/*
      particlesJS("project-space", {
        "particles": {
          "number": {
            "value": 355,
            "density": {
              "enable": true,
              "value_area": 789.1476416322727
            }
          },
          "color": {
            "value": "#ffffff"
          },
          "shape": {
            "type": "circle",
            "stroke": {
              "width": 0,
              "color": "#000000"
            },
            "polygon": {
              "nb_sides": 5
            },
            "image": {
              "src": "img/github.svg",
              "width": 100,
              "height": 100
            }
          },
          "opacity": {
            "value": 0.48927153781200905,
            "random": false,
            "anim": {
              "enable": true,
              "speed": 0.2,
              "opacity_min": 0,
              "sync": false
            }
          },
          "size": {
            "value": 2,
            "random": true,
            "anim": {
              "enable": true,
              "speed": 2,
              "size_min": 0,
              "sync": false
            }
          },
          "line_linked": {
            "enable": false,
            "distance": 150,
            "color": "#ffffff",
            "opacity": 0.4,
            "width": 1
          },
          "move": {
            "enable": true,
            "speed": 0.2,
            "direction": "none",
            "random": true,
            "straight": false,
            "out_mode": "out",
            "bounce": false,
            "attract": {
              "enable": false,
              "rotateX": 600,
              "rotateY": 1200
            }
          }
        },
        "interactivity": {
          "detect_on": "canvas",
          "events": {
            "onhover": {
              "enable": true,
              "mode": "bubble"
            },
            "onclick": {
              "enable": true,
              "mode": "push"
            },
            "resize": true
          },
          "modes": {
            "grab": {
              "distance": 400,
              "line_linked": {
                "opacity": 1
              }
            },
            "bubble": {
              "distance": 83.91608391608392,
              "size": 1,
              "duration": 3,
              "opacity": 1,
              "speed": 3
            },
            "repulse": {
              "distance": 200,
              "duration": 0.4
            },
            "push": {
              "particles_nb": 4
            },
            "remove": {
              "particles_nb": 2
            }
          }
        },
        "retina_detect": true
      });
*/
      var i, tweens = [];

      TWEEN.start();

      var data = JSON.parse('<?php echo ll_get_projects_json();?>');
      window.data = data;
      for ( i=0; i<data.items.length; i++ ) {
//        console.log(data.items[i]);
        globe.addData(data.items[i], {format: 'magnitude', name: data.project, animated: true})
      }

      globe.createPoints();
      globe.animate();
      document.body.style.backgroundImage = 'none'; // remove loading

    }

</script>