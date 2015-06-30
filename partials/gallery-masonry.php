<?php
/*
* Shows the current posts images (if any) using masonry. Excludes the featured image.
*
*/

$thumb_ID = get_post_thumbnail_id( $post->ID );

if ( $images = get_posts(array(
		'post_parent' => $post->ID,
		'post_type' => 'attachment',
		'numberposts' => -1,
		'orderby'        => 'title',
		'order'           => 'ASC',
		'post_mime_type' => 'image',
		'exclude' => $thumb_ID, // exclude featured image
		)))
	{ ?>
<div id="grid">
	<div id="posts">
  	<?php foreach ($images as $image) {
    	$imagedata = wp_get_attachment_image_src($image->ID, 'full');
    	//$portrait = $imagedata[1] > $imagedata[2];
  	?>
		<div class="post">
			<a href="<?php echo $imagedata[0];?>"><img src="<?php echo $imagedata[0];?>"></a>
		</div>
		<? } ?>
	</div>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/masonry/3.1.5/masonry.pkgd.min.js"></script>
	<script>
  	jQuery(window).load(function () {

	// Takes the gutter width from the bottom margin of .post

	var gutter = parseInt(jQuery('.post').css('marginBottom'));
	var container = jQuery('#posts');



	// Creates an instance of Masonry on #posts

	container.masonry({
		gutter: gutter,
		itemSelector: '.post',
		columnWidth: '.post'
	});



	// This code fires every time a user resizes the screen and only affects .post elements
	// whose parent class isn't .container. Triggers resize first so nothing looks weird.

	jQuery(window).bind('resize', function () {
		if (!jQuery('#posts').parent().hasClass('container')) {



			// Resets all widths to 'auto' to sterilize calculations

			post_width = jQuery('.post').width() + gutter;
			jQuery('#posts, body > #grid').css('width', 'auto');



			// Calculates how many .post elements will actually fit per row. Could this code be cleaner?

			posts_per_row = jQuery('#posts').innerWidth() / post_width;
			floor_posts_width = (Math.floor(posts_per_row) * post_width) - gutter;
			ceil_posts_width = (Math.ceil(posts_per_row) * post_width) - gutter;
			posts_width = (ceil_posts_width > jQuery('#posts').innerWidth()) ? floor_posts_width : ceil_posts_width;
			if (posts_width == jQuery('.post').width()) {
				posts_width = '100%';
			}



			// Ensures that all top-level elements have equal width and stay centered

			jQuery('#posts, #grid').css('width', posts_width);
			jQuery('#grid').css({'margin': '0 auto'});



		}
	}).trigger('resize');



});
	</script>
	<style>

/* Grid */

#posts { margin: 30px auto 0; }
.post {
	margin: 0 0 50px;
	text-align: center;
	width: 100%;
}
.post img { padding: 0 15px; width: 100%; }

#grid.container .post img { padding: 0; }


/* Medium devices */

@media (min-width: 768px) {
	#grid > #posts .post { width: 335px; }
	#grid > #posts .post.cs2 { width: 100%; }
	.post img { padding: 0; }
}



/* Medium devices */

@media (min-width: 992px) {
	#grid > #posts .post { width: 445px; }
	#grid > #posts .post.cs2 { width: 100%; }
}



/* Large devices */

@media (min-width: 1200px) {
	#grid > #posts .post { width: 346px; }
	#grid > #posts .post.cs2 { width: 742px; }
}



/* Large devices min-width (1200px) + a .post margin (50px) * 2 (100px) = 1300px */
/* 1300px gives me the clearance I need to keep the margins of the entire #grid (the
bleed if you will) the same width as the .post margins posts (50px). Basically I'm
being really picky about whitespace. If you don't care, no problem, just delete this.
Can this be done with Masonry options? */

	</style>
</div>
<?php }?>