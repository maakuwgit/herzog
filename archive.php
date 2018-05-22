<?php
/*
Template Name: Archive
*/
?>
<?php get_template_part('templates/contents/content', 'hero--archive'); ?>
<article <?php post_class('content'); ?>>
  <div class="container row">
  <?php get_template_part('templates/contents/content', 'archive'); ?>
  <?php get_template_part('templates/contents/content', 'components'); ?>
  </div>
</article>