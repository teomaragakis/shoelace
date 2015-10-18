<?php
/**
 * The template used for displaying page content
 *
 * @package Shoelace
 * @since 0.1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if (
  	(!has_post_thumbnail())
  	|| ( is_single() && (of_get_option( 'post_header')=="none") )
  	|| ( is_page() && (of_get_option( 'page_header')=="none") )
  ) { ?>
    <header class="entry-header">
		  <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	  </header><!-- .entry-header -->
  <?php } ?>

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'shoelace' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'shoelace' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );
		?>
	</div><!-- .entry-content -->

	<?php edit_post_link( __( 'Edit', 'shoelace' ), '<div class="entry-footer"><span class="edit-link">', '</span></div><!-- .entry-footer -->' ); ?>
</article><!-- #post-## -->