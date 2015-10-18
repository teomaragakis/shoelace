<?php
/**
  * The main page template
  *
  * @package Shoelace
  * @since 0.1.0
*/ ?>
<?php get_header(); ?>
<?php switch (of_get_option( 'post_header')) {
  case "parallax-cover":
    get_template_part('partials/header', 'parallax');
    break;
  case "cover-image":
    get_template_part('partials/header', 'cover');
    break;
} ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<main id="main">

  <div class="breadcrumbs">
    <div class="<?php shoelace_container(); ?>">
      <?php if ( function_exists( 'yoast_breadcrumb' ) ) { yoast_breadcrumb(); } ?>
    </div>
  </div>
  <div class="<?php shoelace_container(); ?>">
    <?php get_template_part( 'partials/content', 'page' ); ?>
    <?php get_template_part( 'partials', 'comments' ); ?>
   </div>
 </main>
 <?php endwhile; else : ?>
      	<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
      <?php endif; ?>
 <?php get_footer(); ?>