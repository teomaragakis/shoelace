<?php
  $thumb_ID = get_post_thumbnail_id( $post->ID );
  $first = wp_get_attachment_image_src( $thumb_ID, 'full');
  if ( $images = get_posts(array(
		'post_parent' => $post->ID,
		'post_type' => 'attachment',
		'numberposts' => -1,
		'orderby'        => 'title',
		'post_mime_type' => 'image',
		)))
	{ ?>
<section id="carousel" class="carousel slide" data-ride="carousel">
  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">

      <?php $i=0; ?>
    <?php foreach ($images as $image) {
    	$imagedata = wp_get_attachment_image_src($image->ID, 'full'); ?>
    	<div class="item <?php if ($i==0){ echo 'active'; }?>">
      <div class="fill" style="background-image:url('<?php echo $imagedata[0];?>');"></div>
    	</div>
    	<?php $i++;?>
  <?php } ?>

  </div>
  <!-- Controls -->
  <?php if (count($images) > 0) {?>
  <a class="left carousel-control" href="#carousel" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
  <?php } ?>
</section>
<?php } ?>