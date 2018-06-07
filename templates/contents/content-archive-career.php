<section class="content light-bg">
  <div class="container row end">
    <table class="col">
      <thead>
        <tr>
          <th>Job Title</th>
          <th class="aluminum">Type</th>
          <th class="aluminum">Location</th>
          <th class="aluminum">Division</th>
        </tr>
      </thead>
    <?php
      $args = array(
        'posts_per_page'=> 50,
        'post_status' => 'publish',
        'post_type'   => 'career',
      );

      $careers = new WP_Query( $args );

      while ( $careers->have_posts() ) {
        $careers->the_post();
        include( locate_template('templates/partials/table-row.php') );
      }
//    echo '<tfoot><tr><td colspan="3">';
//      previous_posts_link( 'Older Posts' );
//    echo '</td><td>';
      //next_posts_link( 'Newer Posts', $careers->max_num_pages );
//      echo '</tr><tfoot>';

      wp_reset_postdata();
    ?>
    </table>
  </div>
</section>