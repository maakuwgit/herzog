<aside class="content col col-offset-1of12 col-2of12">
  <h6 class="text-normal">Date</h6>
  <time class="published text-medium" datetime="<?php echo get_the_time('c'); ?>"><?php echo get_the_date(); ?></time>
  <h6 class="text-normal">Category</h6>
  <?php echo get_the_category_list(); ?>
</aside>