<tr>
  <td class="text-medium"><?php the_title(); ?></td>
  <td><?php
        $category = get_the_terms(get_the_ID(), 'career_type');
        if( $category ) {
          $type = '';
          $types = false;
          foreach( $category as $type ) {
            $types[] = $type->name;
          }

          if( is_array( $types ) ) {
            $type = implode( ", ", $types );
          }else{
            $type = $types;
          }

          echo $type;
        }
      ?></td>
    <?php
      $places = false;
      $location = get_field('career_location');
      if( sizeof($location) > 2) :
        foreach( $location as $place ) {
          if( $place->parent !== 0 ) {
            if( strlen($place->slug) > 3 ) {
              $places[] = $place->name;
            }else{
              $places[] = strtoupper($place->slug);
            }
          }
        }
        $places = array_reverse($places);

        if( $places ) : ?>
        <td><?php echo implode( ", ", $places ); ?></td>
        <?php endif; ?>
    <?php endif;?>
    <?php
     $division = get_field('career_division');
     if( $division ) :
       $division = get_field('division_abbreviation', $division);
       if( $division ) : ?>
        <td><?php echo $division; ?></td>
      <?php endif; ?>
    <?php endif; ?>
</tr>