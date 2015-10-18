<?php
/**
 * The template used for displaying post content
 *
 * @package Shoelace
 * @since 0.1.0
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope itemtype="https://schema.org/Article">
  <meta itemprop="image"
    content=""
  />
	<?php if (
  	(!has_post_thumbnail())
  	|| ( is_single() && (of_get_option( 'post_header')=="none") )
  	|| ( is_page() && (of_get_option( 'page_header')=="none") )
  ) { ?>
    <header class="entry-header">
		  <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	  </header><!-- .entry-header -->
  <?php } ?>
  <?php get_template_part( 'partials/meta', 'post' ); ?>
	<div class="entry-content" itemprop="articleBody">
  	<?php get_template_part('partials/content', 'edit'); ?>
		<?php the_content(); ?>
	</div><!-- .entry-content -->
<?php wp_link_pages( array(
	'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'shoelace' ) . '</span>',
	'after'       => '</div>',
	'link_before' => '<span>',
	'link_after'  => '</span>',
	'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'shoelace' ) . ' </span>%',
	'separator'   => '<span class="screen-reader-text">, </span>',
)); ?>
</article><!-- #post-## -->