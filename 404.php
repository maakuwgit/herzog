<main class="content">
  <div class="container row">
    <h2><?php _e('Sorry, but the page you were trying to view does not exist.', 'roots'); ?></h2>
    <?php get_search_form(); ?>
    <p><?php _e('It looks like this was the result of either:', 'roots'); ?></p>
    <ul>
      <li><?php _e('a mistyped address', 'roots'); ?></li>
      <li><?php _e('an out-of-date link', 'roots'); ?></li>
    </ul>
  </div>
</main>