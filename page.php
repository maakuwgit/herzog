<?php get_template_part('templates/contents/content', 'hero--nav'); ?>
<article <?php post_class('content'); ?>>
  <div class="container row">
<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/contents/content', 'components'); ?>
<?php endwhile; ?>
  </div>
</article>
<?php get_template_part('templates/contents/content', 'callout'); ?>
<?php
  ll_include_component(
    'related-nav',
    array(
      'links' => false
    )
  );
?>