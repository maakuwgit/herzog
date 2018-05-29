<?php
/**
* Capability Card
* -----------------------------------------------------------------------------
*
 * Similar to the Division Card, show related information
*/

$default_data = [
  'headline'      => 'Lorem Ipsum',
  'divisions'     => false,
  'capabilities'  => false,
  'started'       => false,
  'completed'     => 'Ongoing',
  'delivery'      => 'Sin dolor',
  'overview'      => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.'
];

$default_args = [
  'id' => uniqid('completion-details-'),
  'classes' => array()
];

$data = ll_parse_args( $component_data, $default_data );
$args = ll_parse_args( $component_args, $default_args );

if ( ll_empty( $data ) ) return;

$css = ' class="completion-details';
if( $args['classes'] ) {
  if( is_array($args['classes'] ) ) {
    $css .= implode( " ", $args['classes'] );
  }else{
    $css .= ' ' . $args['classes'];
  }
}
$css .= '"';
$id = ($args['id'] ? ' id="' . $args['id'] . '"' : '');

$headline     = $data['headline'];
$divisions    = $data['divisions'];
$capabilities = $data['capabilities'];
$started      = $data['started'];
$completed    = $data['completed'];
$delivery     = $data['delivery'];
$overview     = $data['overview'];
?>
<section<?php echo $id . $css; ?> data-component="completion-details">
  <div class="container row stretch">
    <header class="col">
      <h2><?php echo $headline; ?></h2>
    </header>
  </div>
  <div class="container row stretch">
    <div class="col col-md-6of12 col-lg-6of12 col-xl-6of12">
      <h3 class="h6 text-bold">Details</h3>
      <dl>
      <?php if( $divisions ) : ?>
        <?php if( sizeof($divisions) > 1 ) : ?>
        <dt>Divisions</dt>
        <dd>
          <ul class="no-bullet">
          <?php
            foreach( $divisions as $division ) :
              $abbr = get_field('division_abbreviation', $division->ID);
            ?>
            <li><?php echo $abbr; ?></li>
          <?php endforeach;?>
          </ul>
        </dd>
        <?php
          else :
          $abbr = get_field('division_abbreviation', $divisions[0]->ID);
        ?>
        <dt>Division</dt>
        <dd><?php echo $abbr; ?></dd>
        <?php endif; ?>
      <?php endif; ?>
      <?php if( $capabilities ) : ?>
        <?php if( sizeof($capabilities) > 1 ) : ?>
        <dt>Capabilities</dt>
        <dd>
          <ul class="no-bullet">
          <?php foreach( $capabilities as $capability ) : ?>
            <li><?php echo $capability->post_title; ?></li>
          <?php endforeach;?>
          </ul>
        </dd>
        <?php else : ?>
        <dt>Capability</dt>
        <dd><?php echo $capabilities[0]->post_title; ?></dd>
        <?php endif; ?>
      <?php endif; ?>
      <?php if( $started) : ?>
        <dt>Year Started</dt>
        <dd><?php echo $started; ?></dd>
      <?php endif; ?>
        <dt>Year Completed</dt>
        <dd><?php echo $completed; ?></dd>
      </dl>
    </div>
    <div class="col col-md-6of12 col-lg-6of12 col-xl-6of12">
      <h3 class="h6 text-bold">Overview</h3>
      <?php echo format_text($overview); ?>
    </div>
  </div>
</section>
<?php
/**
 * component_name_after_display hook
 * Type: Action
 */
do_action( "component_name_after_display", $component_data, $component_args ); ?>