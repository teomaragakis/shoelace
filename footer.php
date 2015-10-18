      <footer id="footer" role="contentinfo">
        <div class="<?php shoelace_container(); ?>">
          <?php $footer_cols = of_get_option('footer_columns'); ?>
          <?php switch($footer_cols) {
            case 2:
              $col_classes = 'col-sm-6';
              break;
            case 3:
              $col_classes = 'col-sm-4';
              break;
            case 4:
              $col_classes = 'col-sm-3';
              break;
            case 6:
              $col_classes = 'col-sm-2';
              break;
          } ?>
          <?php $footer_rows = of_get_option('footer_rows'); ?>
          <?php if ($footer_rows['widgets']==1) { ?>
            <?php if ( is_active_sidebar( 'footer_widgets' ) ) : ?>
            	<div id="primary-sidebar" class="widget-area row" role="complementary">
            		<?php dynamic_sidebar( 'footer_widgets' ); ?>
            	</div><!-- #primary-sidebar -->
            <?php endif; ?>
          <?php } ?>


          <?php if ($footer_rows['menu']==1) { ?>
            <div class="menu row">
            <?php wp_nav_menu( array(
                'menu'              => 'footer-navigation',
                'theme_location'    => 'footer-navigation',
                'depth'             => 2,
                'container'         => 'div',
                'container_class'   => '',
                'container_id'      => 'footer-nav',
                'menu_class'        => 'nav col-sm-12',
                )
            ); ?>
          </div>
          <?php } ?>
          <?php if ($footer_rows['static']==1) { ?>
            <div class="static row">
              <?php $footer_end_cols = 'col-xs-12 col-sm-12';
                if (function_exists('sed_footer_text') && of_get_option('sed_foot_logo') ){
                  $sed = true;
                  $footer_end_cols = 'col-xs-12 col-sm-10';
                } ?>
              <div class="<?php echo $footer_end_cols;?>">
                <?php if (of_get_option('footer_text')) {
                echo of_get_option('footer_text');
              } else { ?>
                <span>&copy; <?php echo date( 'Y' ); ?> <a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a> - <?php _e( 'All rights reserved', 'shoelace' ); ?> | <?php echo sprintf( __( 'Created by <a href="%s" rel="nofollow" target="_blank">Teo Maragakis</a> and <a href="%s" rel="nofollow" target="_blank">WordPress</a>.', 'shoelace' ), 'http://www.teomaragakis.com/', 'http://wordpress.org/' ); ?></span>
              <?php } ?>
              </div>
              <?php if (of_get_option('sed_foot_logo')==true) { ?>
                <div class="col-xs-12 col-sm-2">
                  <a href="http://www.sedcomunicazione.com" rel="external nofollow" title="" class="ext-link" data-wpel-target="_blank">
                    <img class="img-responsive" src="<?php echo plugins_url();?>/sed/img/sedfoot.png">
                  </a>
                  <div>Foto A. Saba</div>
                </div>
              <?php } ?>
            </div>
          <?php } ?>

        </div>
      </footer><!-- #footer -->
    <?php wp_footer(); ?>
  </body>
</html>