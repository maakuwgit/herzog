<?php
/*
Template Name: Form
*/
$use_form = get_field('form_use');
?>
<?php get_template_part('templates/contents/content', 'hero--nav'); ?>
<article <?php post_class('content'); ?>>
  <div class="row">
<?php while (have_posts()) : the_post(); ?>
  <section class="gform_wrapper content">
    <div class="gform_wrapper container row start">
      <?php gravity_form( $use_form, true, true ); ?>
    </div>
  </section>
  <?php get_template_part('templates/contents/content', 'components'); ?>
<?php endwhile; ?>
  </div>
</article>
<?php get_template_part('templates/contents/content', 'callout'); ?>