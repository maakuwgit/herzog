<?php
?>
<tr>
  <td><?php the_title(); ?></td>
  <td><?php
        $category = get_the_category(get_the_ID());
        if( $category ) {
          echo $category[0]->name;
        }
      ?></td>
  <td><?php echo the_field('career-types-location'); ?></td>
  <td><?php echo the_field('career-types-division'); ?></td>
</tr>