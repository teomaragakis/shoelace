<?php
  $thumb_ID = get_post_thumbnail_id( $post->ID );
  $first = wp_get_attachment_image_src( $thumb_ID, 'full');
  if ( $images = get_posts(array(
		'post_parent' => $post->ID,
		'post_type' => 'attachment',
		'numberposts' => -1,
		'orderby'        => 'title',
		'order'           => 'ASC',
		'post_mime_type' => 'image',
		'exclude' => $thumb_ID,
		)))
	{ ?>
<section id="carousel" class="carousel slide" data-ride="carousel">
  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <div class="item active">
      <div class="fill" style="background-image:url('<?php echo $first[0]; ?>');"></div>
      </div>
    <?php foreach ($images as $image) {
    	$imagedata = wp_get_attachment_image_src($image->ID, 'full'); ?>
    	<div class="item">
      <div class="fill" style="background-image:url('<?php echo $imagedata[0];?>');"></div>
    	</div>
  <?php } ?>

  </div>
  <!-- Controls -->
  <a class="left carousel-control" href="#carousel" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</section>
<style>

.carousel .fill{width:100%;height:800px;background-position:center;background-size:cover;}
@media only screen and (max-width: 768px) {
.carousel .fill{width:100%;height:500px;background-position:left;background-size:cover;}

}
</style>
<?php } ?>