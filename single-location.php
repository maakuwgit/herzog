<?php include( locate_template('templates/contents/content-hero--nav.php') ); ?>
<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/contents/content', 'components'); ?>
<?php endwhile; ?>
<?php get_template_part('templates/contents/content', 'callout'); ?>
