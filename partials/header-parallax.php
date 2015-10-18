<?php $cover = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'cover'); ?>
<section class="parallax">
  <div class="parallax-inner" style="background: rgba(0,0,0,0.8) url('<?php echo $cover[0]; ?>') no-repeat center center; background-size: cover;">
    <div class="content">
      <h1><?php echo get_the_title($post->ID); ?></h1>
      <div class="subtitle"></div>
    </div>
  </div>
</section>