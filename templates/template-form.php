<?php
/*
Template Name: Form
*/
$use_form = get_field('form_use');
?>
<?php get_template_part('templates/contents/content', 'hero--nav'); ?>
<article <?php post_class('content'); ?>>
  <div class="container row">
<?php while (have_posts()) : the_post(); ?>
  <?php gravity_form( $use_form, true, true ); ?>
<?php endwhile; ?>
  </div>
</article>
<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/contents/content', 'components'); ?>
<?php endwhile; ?>
<?php get_template_part('templates/contents/content', 'callout'); ?>