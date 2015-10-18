<?php
/*
 * Template Name: Masonry Gallery
 * Description: Shows the page's attached images with a masonry layout.
 */ ?>
<?php get_header(); ?>
<?php switch (of_get_option( 'page_header')) {
      case "parallax-cover": ?>
        <?php get_template_part('partials/header', 'parallax') ?>
        <?php break;
          case "cover-image": ?>
          <?php get_template_part('partials/header', 'cover') ?>
          <?php break; ?>
    <?php } ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<main id="main">
  <div class="the-content <?php shoelace_container(); ?>">
    <div class="row">
      <div class="col-md-12">
        <div class="breadcrumbs">
          <?php if ( function_exists( 'yoast_breadcrumb' ) ) { yoast_breadcrumb(); } ?>
        </div>
        <?php get_template_part( 'partials/content', 'page' ); ?>
      </div>
    </div>
  </div>

  <div class="<?php shoelace_container(); ?>">
  <div class="row">
    <div class="col-md-12">
      <?php $thumb_ID = get_post_thumbnail_id( $post->ID );
        $first = wp_get_attachment_image_src( $thumb_ID, 'full');
        if ( $images = get_posts(array(
      		'post_parent' => $post->ID,
      		'post_type' => 'attachment',
      		'numberposts' => -1,
      		'orderby'        => 'title',
      		'post_mime_type' => 'image',
      		)))
      	{ ?>

      <div class="grid row masonry">
        <?php $i=0; ?>
        <?php foreach ($images as $image) {
        	$imagedata = wp_get_attachment_image_src($image->ID, 'full'); ?>
        	<div class="item col-xs-6 col-sm-4 col-md-3">
            <img data-action="zoom" class="img-responsive lazy" src="<?php echo $imagedata[0];?>" />
        	</div>
        	<?php $i++;?>
        <?php } ?>
      </div>

   <?php } ?>
    </div>
  </div>
</main>

<?php endwhile; else : ?>
  <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>
<?php get_footer(); ?>
<script>
  (function($) {

  	var $container = $('.row.masonry');
  	$container.imagesLoaded( function () {
  		$container.masonry({
  			columnWidth: '.item',
  			itemSelector: '.item'
  		});
  	});
  })(jQuery);
</script>