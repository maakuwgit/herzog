<?php
  $position   = false;
  $positions  = $ls = $abbr = $output = '';
  $divisions  = get_field('member_division');

  if( $divisions ) {
    foreach( $divisions as $division ) {
      $position     = get_term($division);
      $positions[]  = $position->name;
      if( get_field('division_abbreviation', $position->term_id) ) {
        $abbr[] = get_field('division_abbreviation', $position->term_id);
      }else{
        //Dev Note: tried a BUNCH of different ways to do this, all ended up with no content coming out of the ACF SHOCKER!!
        $name = preg_split("/\s+/", $position->name);
        foreach ($name as $n) {
          $ls .= $n[0];
        }
        $abbr[] = $ls;
      }
    }

    if( sizeof($positions) > 0 ) {
      for( $p = 0; $p < sizeof($positions); $p++) {
        $output .= '<div class="row">';
        $output .= '<dt class="col-3of12">'.$abbr[$p].'</dt>';
        $output .= '<dd class="col-9of12">'.$positions[$p].'</dd>';
        $output .= '</div>';
      }
    }
  }

  $thumb = ll_get_featured([267,330]);
?>
<figure id="member-thumb-<?php the_ID(); ?>" class="thumbnail col" data-mfp-src="#member-thumb-<?php the_ID(); ?>">
  <div data-background>
    <div class="feature">
      <?php echo $thumb ?>
    </div>
    <?php
      $button = [
        'icon'    => 'plus',
        'theme'   => 'dark',
        'link'    => array(
          'url'   => '#read_bio',
          'title' => false
        )
      ];

      ll_include_component(
        'button',
        $button,
        array(
          'modal'     => true,
          'modal_id'  => 'member-thumb-' . get_the_ID()
        )
      );
    ?>
  </div>
  <figcaption>
    <h3 class="h5"><?php the_title(); ?></h3>
    <?php if( $output ) echo '<dl>'.$output.'</dl>'; ?>
  </figcaption>
</figure>