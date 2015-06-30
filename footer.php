<?php
/**
 * The template for displaying the footer.
 *
 * @package Shoelace
 * @since 0.1.0
 */?>
 <footer id="footer" role="contentinfo">
      <div class="container">
        <span>&copy; <?php echo date( 'Y' ); ?> <a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a> - <?php _e( 'All rights reserved', 'shoelace' ); ?> | <?php echo sprintf( __( 'Created by <a href="%s" rel="nofollow" target="_blank">Teo Maragakis</a> and <a href="%s" rel="nofollow" target="_blank">WordPress</a>.', 'shoelace' ), 'http://www.teomaragakis.com/', 'http://wordpress.org/' ); ?></span>
      </div><!-- .site-info -->
    </footer><!-- #footer -->
  <?php wp_footer(); ?>
</body>
</html>
