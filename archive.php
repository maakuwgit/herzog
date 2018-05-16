<?php
/*
Template Name: Archive
*/
$cat = get_queried_object();

$banner_text = array(
  'text' => $cat->name
);
$banner_sub_text = array(
  'text' => false
);
$background_image   = get_field('news_hero_background_image', $cat);
$loop_video         = get_field('news_hero_loop_video', $cat);
$popup_video        = get_field('news_hero_popup_video', $cat);
?>
<?php include( locate_template('templates/contents/content-hero.php') ); ?>
<?php get_template_part('templates/contents/content', 'archive'); ?>
<?php get_template_part('templates/contents/content', 'components'); ?>
