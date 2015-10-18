<?php
/**
  * The single post template
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
    <div class="<?php shoelace_container(); ?>">
      <div class="breadcrumbs"><?php if ( function_exists( 'yoast_breadcrumb' ) ) { yoast_breadcrumb(); } ?></div>
      <?php get_template_part( 'partials/content', 'post' ); ?>
      <?php get_template_part( 'partials/meta', 'author' ); ?>
      <?php if ( comments_open() || get_comments_number() ) :
		comments_template();
	endif; ?>

    </div><!-- .container -->
  </main>
<?php endwhile; else : ?>
      	<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
      <?php endif; ?>
 <?php get_footer(); ?>