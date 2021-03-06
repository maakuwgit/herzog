<?php if (!have_posts()) : ?>
  <main class="content">
    <div class="container row">
      <h2><?php _e('Sorry, no results were found.', 'roots'); ?></h2>
      <?php get_search_form(); ?>
    </div>
  </main>
<?php else; ?>
<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/contents/content'); ?>
<?php endwhile; ?>
<?php get_template_part('templates/contents/content', 'callout'); ?>
<?php endif; ?>
<?php if ($wp_query->max_num_pages > 1) : ?>
  <nav class="post-nav">
    <ul class="pager">
      <li class="previous"><?php next_posts_link(__('&larr; Older posts', 'roots')); ?></li>
      <li class="next"><?php previous_posts_link(__('Newer posts &rarr;', 'roots')); ?></li>
    </ul>
  </nav>
<?php endif; ?>
