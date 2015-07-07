<?php
/**
 * The main page template
 *
 * @package Shoelace
 * @since 0.1.0
 */ ?>
 <?php get_header(); ?>
 <section id="main">
   <div class="container">
     <?php // Start the loop.
  		while ( have_posts() ) : the_post();

  			// Include the page content template.
  			get_template_part( 'partials/content', 'page' );

  			if(of_get_option('page_comments',true)) {
    			// If comments are open or we have at least one comment, load up the comment template.
    			if ( comments_open() || get_comments_number() ) :
    				comments_template();
    			endif;
  			}



  		// End the loop.
  		endwhile; ?>
   </div>
 </section>
 <?php get_footer(); ?>
