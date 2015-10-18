<div id="authorarea" class="media" itemprop="author" itemscope itemtype="http://schema.org/Person">
  <div class="media-left">
    <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
      <img class="media-object" itemprop="image"
        src="<?php echo get_avatar_url( get_the_author_meta( 'user_email' ), 300 ); ?>"
        alt="<?php the_author(); ?>">
    </a>
  </div>
  <div class="media-body">
    <h4 class="media-heading">About <span itemprop="name"><?php the_author(); ?></span></h4>
    <div itemprop="description"><?php the_author_meta( 'description' ); ?></div>
  </div>
</div>