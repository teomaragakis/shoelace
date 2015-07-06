<?php
/**
 * The template for displaying the header.
 *
 * @package Shoelace
 * @since 0.1.0
 */
 ?><!DOCTYPE html>
<!--[if IE 7]>
<html class="no-js ie ie7 lt-ie9 lt-ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="no-js ie ie8 lt-ie9" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8) ]><!-->
<html class="no-js" <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php
  	$favicon = get_stylesheet_directory_uri() . '/favicon.png';
  	if (of_get_option('favicon')) $favicon = of_get_option('favicon');
  ?>
	<link href="<?php echo $favicon; ?>" rel="shortcut icon" />
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/assets/js/html5.js"></script>
	<![endif]-->
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
		<header id="header" role="banner">
  		<nav id="main-navigation" class="navbar navbar-default <?php if(of_get_option('navbar_pos')=='fixed-top') { echo 'navbar-fixed-top'; } ?>" role="navigation">
  			<div class="container">
  				<div class="navbar-header">
  					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-navigation">
    					<span class="sr-only"><?php _e( 'Toggle navigation', 'shoelace' ); ?></span>
  						<span class="icon-bar"></span>
  						<span class="icon-bar"></span>
  						<span class="icon-bar"></span>
  					</button>
    				<a class="navbar-brand" href="<?php echo home_url(); ?>" rel="home">
      				<img class="logo img-responsive" src="<?php echo of_get_option('logo_image'); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"/>
      		  </a>
          </div>
          <?php
            wp_nav_menu( array(
                'menu'              => 'main-navigation',
                'theme_location'    => 'main-navigation',
                'depth'             => 2,
                'container'         => 'div',
                'container_class'   => 'collapse navbar-collapse',
        'container_id'      => 'navbar',
                'menu_class'        => 'nav navbar-nav',
                'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                'walker'            => new wp_bootstrap_navwalker())
            );

        ?>
				  <div class="collapse navbar-collapse navbar-main-navigation"></div><!-- .navbar-collapse -->
  			</div><!-- .container -->
			</nav><!-- #main-menu -->

			<?php
				$header_image = get_header_image();
				if ( ! empty( $header_image ) ) :
			?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $header_image ); ?>" height="<?php esc_attr_e( $header_image->height ); ?>" width="<?php esc_attr_e( $header_image->width ); ?>" alt="" /></a>
			<?php endif; ?>
		</header><!-- #header -->
