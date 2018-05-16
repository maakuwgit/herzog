<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/contents/content', get_post_type()); ?>
<?php endwhile; ?>
