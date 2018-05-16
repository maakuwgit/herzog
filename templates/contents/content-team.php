<?php
  $division = get_field('member_division');
  $position = get_the_terms(get_the_ID(), 'team_position');

  if( $position ) {
    $pdescription = $position[0]->description;
    $position = $position[0]->name;
  }
?>
<main <?php post_class('content'); ?>>
  <div class="container row">
    <?php include( locate_template('templates/partials/leader-grid.php') ); ?>
  </div>
</main>