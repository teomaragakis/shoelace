<section class="cover"><div class="container">
  <h1><?php the_title();?></h1></div>
</section>
<?php $cover = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'cover'); ?>
<style>
  .cover {
    background-image: url(<?php echo $cover[0]; ?>);
    background-size: cover;
    height: <?php echo $cover[2]; ?>px;
    background-position: center;
    position: relative;
  }
  .cover h1 {
    position: absolute;
    bottom: 0;
    color: white;
    margin-bottom: 30px;
  }
</style>
