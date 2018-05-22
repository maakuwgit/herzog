<li class="col col-xs-6of12 col-sm-4of13 col-md-4of12 col-lg-4of12 col-xl-4of12">
  <figure id="<?php echo basename(get_permalink()); ?>" data-clickthrough class="thumbnail row">
    <div data-background class="relative col no-shadow">
      <div class="feature">
        <?php echo ll_get_featured([267,330]) ?>
      </div>
      <?php
        $category = get_the_category();
        if( $category ) {
          $category = $category[0]->slug . '&nbsp;–&nbsp;';
          $category = '<b>'.ucfirst($category).'</b>';
        }else{
          $category = '';
        }

        $button = [
          'icon'    => 'plus',
          'theme'   => 'dark',
          'link'    => array(
            'url'   => get_the_permalink(),
            'title' => ''
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
      <?php echo format_text($category . get_the_excerpt()); ?>
    </figcaption>
  </figure>
</li>