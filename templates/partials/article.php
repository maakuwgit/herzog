<?php
  $thumb = get_the_post_thumbnail($article->ID);
  if( !$thumb ) {
    $thumb = '<img alt="" href="//via.placeholder.com/260x446" srcset="//via.placeholder.com/600x402 2x, //via.placeholder.com/1040x1984 3x" data-src-xl="//via.placeholder.com/1040x1984" data-src-lg="//via.placeholder.com/520x992" data-src-md="//via.placeholder.com/390x669">';
  }
?>
<figure class="thumbnail">
  <div data-background>
    <div class="feature">
      <?php echo $thumb; ?>
    </div>
  </div>
  <figcaption>
    <strong class="h5 text-normal block"><?php echo $article->post_title; ?></strong>
    <?php echo format_text($article->post_excerpt); ?>
  </figcaption>
</figure>