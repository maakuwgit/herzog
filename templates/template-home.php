<?php
/*
Template Name: Home
*/
?>
<?php get_template_part('templates/contents/content', 'hero'); ?>
<article <?php post_class('content'); ?>>
  <div class="row">
<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/contents/content', 'components'); ?>
<?php endwhile; ?>
  </div>
</article>
<?php get_template_part('templates/contents/content', 'callout'); ?>