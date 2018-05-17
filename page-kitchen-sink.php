<?php get_template_part('templates/contents/content', 'hero--nav'); ?>
<aside class="content" id="content">
  <div class="container row">
    <h2 class="block">General Content</h2>
  </div>
</aside>
<article id="specialized" class="content">
  <div class="container row start">
    <div class="col col-xs-6of12 col-sm-4of12 col-md-4of12 col-lg-4of12 center">
      <h3>WYSIWYG</h3>
    </div>
    <div class="col col-xs-6of12 col-sm-4of12 col-md-4of12 col-lg-4of12 center">
      <p class="h5">This is how things typed into the WYSYWIG will look. The look-and-feel is shared by the News pages</p>
    </div>
  </div>
</article>
<section <?php post_class('content'); ?>>
  <div class="container row">
  <?php while (have_posts()) : the_post(); ?>
    <div class="col">
      <?php the_content(); ?>
    </div>
  <?php endwhile; ?>
  </div>
</section>
<?php get_template_part('templates/contents/content', 'kitchen-sink'); ?>
<?php get_template_part('templates/contents/content', 'callout'); ?>