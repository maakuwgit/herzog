<?php
  $cat        = false;
  $titles     = false;
  $position   = false;
  $positions  = $ls = $abbr = $output = '';
  $divisions  = get_field('member_division');

  if( $divisions ) {
    $d = 0;
    foreach( $divisions as $division ) {
      $position     = get_term($division);
      $details      = get_field('division', $position);
      $positions[]  = $details[0]->post_title.' '.$position->name;
      $d++;
    }

    if( sizeof($positions) > 0 ) {
      for( $p = 0; $p < sizeof($positions); $p++) {
        $titles .= $positions[$p];
        if( sizeof($positions) === 2 && $p == 0) {
          $titles .= ' & ';
        }
      }
    }
  }
?>
<main <?php post_class('content ebony'); ?> id="member-<?php the_ID(); ?>">
  <div class="container row">
<?php while (have_posts()) : the_post(); ?>
    <article>
      <div class="container row">
        <?php include( locate_template('templates/partials/details-member.php') ); ?>
      </div>
    </article>
<?php endwhile; ?>
  </div>
</main>