<?php include( locate_template('templates/contents/content-hero.php') ); ?>
<article <?php post_class('content'); ?>>
  <div class="container row">
<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/contents/content', get_post_type()); ?>
<?php endwhile; ?>
  </div>
</article>
<?php get_template_part('templates/contents/content', 'callout'); ?>
<?php
  $links = get_field('relationships');

  ll_include_component(
    'related-nav',
    array(
      'links' => $links
    )
  );
?>