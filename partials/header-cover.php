<?php if ( has_post_thumbnail() ) {
  $cover = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'cover'); ?>
  <section class="cover" style="background-image: url(<?php echo $cover[0]; ?>);">
    <div class="<?php shoelace_container(); ?>">
    <div class="inner">
      <h1><?php the_title();?></h1>
    </div>
    </div>
  </section>
  <?php } ?>