<div class="col-lg-6of12 col-xl-6of12 flex-start">
  <?php if( is_single() ) : ?>
  <h1 class="h2 post__header__title"><?php the_title(); ?></h1>
<?php else: ?>
  <h3 class="post__header__title"><?php the_title(); ?></h3>
<?php endif; ?>
  <hr>
<?php if( $titles ) : ?>
  <h6 class="text-medium"><?php echo $titles; ?></h6>
<?php endif; ?>
  <?php the_content(); ?>
</div>
<figure class="col-lg-6of12 col-xl-6of12 stretch" data-background>
  <div class="feature">
    <?php the_post_thumbnail(); ?>
  </div>
</figure>