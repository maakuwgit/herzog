<div class="globe col" id="project-globe" data-globe>
  <!-- Dev Note: put the texture image in here for SEO -->
</div>
<main class="content hero flex column">
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
    <header class="row">
      <div class="container row">
        <div class="col col-12of12">
          <h1><?php the_title(); ?></h1>
          <?php if( $location ) : ?>
          <h2 class="text-normal">
            <svg class="icon icon-location">
              <use xlink:href="#icon-location"></use>
            </svg>
            <?php echo $location; ?>
          </h2>
          <?php endif; ?>
        </div>
      </div>
    </header>
  </div>
  <div class="container row stretch">
    <div class="row">
      <div class="container row">
        <div class="col col-md-6of12 col-lg-6of12 col-xl-6of12">
          <dl class="container row">
          <?php if( $client ) : ?>
            <dt class="col col-md-6of12 col-lg-6of12 col-xl-6of12">Client</dt>
            <dd class="col col-md-6of12 col-lg-6of12 col-xl-6of12"><p><?php echo $client; ?></p></dd>
          <?php endif; ?>
          <?php if( $types ) : ?>
            <?php if( sizeof($types) > 1 ) : ?>
            <dt class="col col-md-6of12 col-lg-6of12 col-xl-6of12">Project Types</dt>
            <dd class="col col-md-6of12 col-lg-6of12 col-xl-6of12">
              <ul class="no-bullet">
              <?php foreach( $types as $type ) : ?>
                <li class="text-bold"><?php echo $type->post_title; ?></li>
              <?php endforeach;?>
              </ul>
            </dd>
            <?php else : ?>
            <dt class="col col-md-6of12 col-lg-6of12 col-xl-6of12">Project Type</dt>
            <dd class="col col-md-6of12 col-lg-6of12 col-xl-6of12"><p><?php echo $types[0]->name; ?></p></dd>
            <?php endif; ?>
          <?php endif; ?>
            <dt class="col col-md-6of12 col-lg-6of12 col-xl-6of12">Year Completed</dt>
            <dd class="col col-md-6of12 col-lg-6of12 col-xl-6of12"><p><?php echo $completed; ?></p></dd>
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
                <li class="text-bold"><?php echo $division->post_title; ?></li>
              <?php endforeach;?>
              </ul>
            </dd>
            <?php
              else :
              $abbr = get_field('division_abbreviation', $divisions[0]->ID);
            ?>
            <dt class="col col-md-6of12 col-lg-6of12 col-xl-6of12">Division</dt>
            <dd class="col col-md-6of12 col-lg-6of12 col-xl-6of12"><p><?php echo $abbr; ?></p></dd>
          <?php endif; ?>
          <?php endif; ?>
          <?php if( $capabilities ) : ?>
            <?php if( sizeof($capabilities) > 1 ) : ?>
            <dt class="col col-md-6of12 col-lg-6of12 col-xl-6of12">Capabilities</dt>
            <dd class="col col-md-6of12 col-lg-6of12 col-xl-6of12">
              <ul class="no-bullet">
              <?php foreach( $capabilities as $capability ) : ?>
                <li class="text-bold"><?php echo $capability->post_title; ?></li>
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

      var i, tweens = [];

      TWEEN.start();

      var data = JSON.parse('<?php echo ll_get_projects_json();?>');
      window.data = data;
      for ( i=0; i<data.items.length; i++ ) {
//        console.log(data.items[i]);
        globe.addData(data.items[i], {format: 'magnitude', name: data.project, animated: true})
      }

      //globe.createPoints();
      globe.animate();
      document.body.style.backgroundImage = 'none'; // remove loading

    }

</script>