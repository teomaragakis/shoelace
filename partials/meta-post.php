<?php $categories = get_the_category(); ?>
<div class="meta">
  <?php _e('Posted on','shoelace'); ?> <?php echo the_date('Y-m-d','<span itemprop="datePublished">', '</span>' ); ?>
  <?php _e('under','shoelace'); ?> <?php //the_category(', '); ?>
  <? foreach ( $categories as $category ) {
    //print_r($category); ?>
    <span itemprop="articleSection"><?php echo esc_attr( $category->name ); ?></span>
  <?php } ?>
</div>