<li class="col col-xs-6of12 col-sm-4of13 col-md-4of12 col-lg-4of12 col-xl-4of12">
  <figure id="<?php echo basename(get_permalink()); ?>" data-clickthrough class="thumbnail row">
    <div data-background class="relative col">
      <div class="feature">
        <?php echo ll_get_featured([267,330]) ?>
      </div>
      <?php
        $url    = get_field('testimonial_video_url');
        if( !$url ) $url = '#play_video';
        $button = [
          'icon'    => 'chevron',
          'theme'   => 'dark',
          'link'    => array(
            'url'   => $url,
            'title' => 'Play Video'
          )
        ];

        ll_include_component(
          'button',
          $button
        );
      ?>
    </div>
    <figcaption>
      <strong class="h5 text-normal block"><?php the_title(); ?></strong>
      <?php the_content(); ?>
    </figcaption>
  </figure>
</li>