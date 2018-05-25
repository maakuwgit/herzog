<?php include( locate_template('templates/contents/content-hero.php') ); ?>
<article <?php post_class('content'); ?>>
  <div class="container row">
<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/contents/content', get_post_type()); ?>
  <?php get_template_part('templates/partials/post', 'meta'); ?>
<?php endwhile; ?>
  </div>
</article>
<?php get_template_part('templates/contents/content', 'related_news_and_media'); ?>
<?php get_template_part('templates/contents/content', 'callout'); ?>
<?php get_template_part('templates/partials/navigation', 'related'); ?>