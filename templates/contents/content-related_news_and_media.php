<?php
  $news = get_field('related_news_and_media');
?>
<aside class="related_news_and_media">
  <div class="container row">
    <header class="col">
      <div class="container row">
        <h3 class="h4 text-medium">Related News & Media</h3>
      </div>
    </header>
    <?php if( $news ) : ?>
      <div class="col">
        <div class="container row">
        <?php
         foreach($news as $article) {
           $article = $article['related_article'];
           include( locate_template('templates/partials/article.php') );
         }
        ?>
        </div>
      </div>
    <?php endif; ?>
  </div>
</aside>