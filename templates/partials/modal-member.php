<?php
  $position = get_the_terms(get_the_ID(), 'team_position');
  if( $position ) {
    $position = $position[0]->name;
  }
?>
<aside <?php post_class('modal mfp-hide'); ?> id="member-thumb-<?php the_ID(); ?>">
  <div class="container row">
    <?php include( locate_template('templates/partials/details-member.php') ); ?>
  </div>
</aside>