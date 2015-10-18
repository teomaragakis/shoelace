<?php
/**
 * The main template file
 *
 * @package Shoelace
 * @since 0.1.0
 */ ?>
<?php get_header(); ?>
<?php switch (of_get_option( 'archive_header')) {
  case "parallax-cover":
    get_template_part('partials/header', 'parallax');
    break;
  case "cover-image":
    get_template_part('partials/header', 'cover');
    break;
} ?>
<main id="main">
  <div class="<?php shoelace_container(); ?>">
    <div class="breadcrumbs"><?php if ( function_exists( 'yoast_breadcrumb' ) ) { yoast_breadcrumb(); } ?></div>
    <div class="media">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
      <h3><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>

      <?php the_excerpt(); ?>
    <?php endwhile; else : ?>
    	<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
    <?php endif; ?>
    </div>
  </div><!-- / .container -->
</main>
<?php get_footer(); ?>