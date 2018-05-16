<?php
  $logo = get_field( 'global_logo', 'option' );
  $href = esc_url(home_url('/'));
  $name = get_bloginfo('name');

  $img_path = get_template_directory_uri() . '/assets/img/';
?>
<header class="navbar" role="banner">
  <div class="wrapper row">
    <figure>
      <a href="<?php echo $href ?>" class="logo block">
    <?php if ( $logo ) : ?>
        <img class="logo logo--header" src="<?php echo $logo['url']; ?>" alt="<?php echo $name; ?>">
    <?php else : ?>
        <?php get_logo(); ?>
    <?php endif; ?>
      </a>
    </figure>
    <?php if (has_nav_menu('primary_navigation')) : ?>
    <nav class="primary-nav" id="primary-nav" role="navigation">
      <?php
      wp_nav_menu(array('theme_location'  => 'primary_navigation',
                        'menu_class'      => 'row'));
      ?>
    </nav>
    <?php endif;?>
    <button type="button" class="navbar-toggle navbar-toggle--stand" data-nav="collapse" data-target="#primary-nav">
      <span class="navbar-toggle__box">
        <span class="navbar-toggle__inner"></span>
      </span><!-- .navbar-toggle__box -->
    </button><!-- .navbar-toggle -->
  </div>
</header>
