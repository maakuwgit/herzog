<?php
  //Global Info
  $logo = get_field( 'global_logo', 'option' );
  $href = esc_url(home_url('/'));
  $name = get_bloginfo('name');
?>
<footer class="footer" role="contentinfo">
  <figure class="container row start footer__logo">
    <a href="<?php echo $href ?>" class="iblock">
  <?php if ( $logo ) : ?>
      <img class="logo" src="<?php echo $logo['url']; ?>" alt="<?php echo $name; ?>">
  <?php else : ?>
    <?php get_logo(); ?>
  <?php endif; ?>
    </a>
    <figcaption>
      <img width="262" src="<?php echo get_template_directory_uri() . '/assets/img/text-tagline.svg'; ?>" alt="<?php bloginfo('description'); ?>"></figcaption>
  </figure>
  <?php
    ll_include_component(
      'locations',
      array(
        'use_interactions' => false
      ),
      array(
        'use_muted' => true,
        'classes' => array('footer__divisions', 'footer__menu')
      )
    );
  ?>
  <ul class="container row no-bullet footer__disclaimer">
    <li class="footer__copyright col col-sm-6of12 col-md-6of12 col-lg-6of12 col-xl-6of12"><small>Copyright <?php echo date('Y'); ?>. All Rights Reserved.</small>
    </li><!-- .footer__copyright -->
    <li class="footer__ll-logo col col-sm-6of12 col-md-6of12 col-lg-6of12 col-xl-6of12">
      <small>Wed Design in Kansas City by <a href="https://liftedlogic.com/" target="_blank" class="iblock">
        <svg name="Lifted Logic" class="icon icon-LiftedLogic"><use xlink:href="#icon-LiftedLogic"></use></svg>
      </a></small>
    </li><!-- .footer__ll-logo -->
  </ul>
</footer>
<script  id="locations-filterable_script">

  $('#filter_divisions').change(function() {
    var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
    $.post(
        ajaxurl,
        {
            'action'  :   'fetch_posts',
            'fetch' :   'divisions',
        },
        function(output){
          $('[data-component="locations-filterable"] .output').html(output);
        });
  });

</script>