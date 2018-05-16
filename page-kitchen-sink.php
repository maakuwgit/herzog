<?php get_template_part('templates/contents/content', 'hero--nav'); ?>
<article <?php post_class('content'); ?>>
  <div class="container row">
  <?php while (have_posts()) : the_post(); ?>
    <section class="content" id="content">
      <?php the_content(); ?>
    </section>
  </div>
  <?php endwhile; ?>
</article>
<?php get_template_part('templates/contents/content', 'kitchen-sink'); ?>
<?php get_template_part('templates/contents/content', 'callout'); ?>