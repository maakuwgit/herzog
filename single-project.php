<?php
  $location = 'Kansas City, MO';
  while (have_posts()) : the_post();
?>
<picture class="globe col" id="<?php echo 'project-'.get_the_ID().'-globe'; ?>" data-globe>
  <!-- Dev Note: put the texture image in here for SEO -->
</picture>
<main class="content hero">
  <div class="wrapper row start">
    <h1 class="col"><?php the_title(); ?></h1>
    <h2 class="text-light col"><?php echo $location; ?></h2>
  </div>
</main>
<?php endwhile; ?>
<article <?php post_class('content'); ?>>
  <div class="container row">
<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/contents/content', 'components'); ?>
<?php endwhile; ?>
  </div>
</article>
<?php get_template_part('templates/contents/content', 'callout'); ?>