<?php get_template_part('templates/contents/content', 'hero'); ?>
<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/contents/content', 'components'); ?>
<?php endwhile; ?>
<?php get_template_part('templates/contents/content', 'callout'); ?>