<?php function shoelace_scripts_styles() {

   /**
  * Enqueue scripts and styles for front-end.
  *
  * @since 0.1.0
  */

  $dev_scripts = of_get_option('dev_scripts');
  $dev_jquery = of_get_option('dev_jquery');

  // jQuery
	wp_enqueue_script( 'jquery' );

	// Parent style.css including Bootstrap
	wp_enqueue_style( 'shoelace', PARENT_THEME_URI . '/style.css', array(), null, 'all' );

	// Child style.css which includes bootstrap theme
	wp_enqueue_style( 'shoelace-child', get_stylesheet_uri(), array(), null, 'all' );

	// Bootstrap JS
	wp_enqueue_script( 'bootstrap', PARENT_THEME_URI . '/assets/vendor/bootstrap/dist/js/bootstrap.min.js', array(), null, true );

	if ($dev_scripts['fontawesome'] == true) { // Font Awesome
  	wp_enqueue_style('font-awesome', PARENT_THEME_URI . '/assets/vendor/font-awesome/css/font-awesome.min.css', array(), null, 'all');
	}
	// less.php compiler
  require_once get_template_directory() . '/includes/less.php/Less.php';

  /*$parser = new Less_Parser(array( 'compress'=>true ));
  $parser->parseFile( get_stylesheet_directory() . '/style.less', get_stylesheet_directory_uri() . 'asda' );
  $css = $parser->getCss();*/



	if ($dev_scripts['zoomjs'] == true) { //zoom.js #todo
  	wp_enqueue_style('zoom-js', PARENT_THEME_URI . '/includes/zoom.js/zoom.css', array(), null, 'all');
  	wp_enqueue_script( 'zoom-js', PARENT_THEME_URI . '/includes/zoom.js/zoom.js', array(), null, true );
  }
	if ($dev_scripts['masonry'] == true) { // Masonry
  	wp_enqueue_script( 'masonry', PARENT_THEME_URI . '/assets/vendor/dist/masonry.pkgd.min.js', array(), null, true );
	}
	if ($dev_scripts['dropcap'] == true) { // dropcap.js
  	wp_enqueue_script( 'dropcap-js', PARENT_THEME_URI . '/assets/vendor/dropcap.js/dropcap.min.js', array(), null, true );
	}
	if ($dev_scripts['parallax'] == true) { // parallax.js
  	wp_enqueue_script( 'parallax-js', PARENT_THEME_URI . '/assets/vendor/parallax.js/parallax.min.js', array(), null, true );
	}
	if ($dev_scripts['highlight'] == true) { // highlight.js
  	wp_enqueue_script( 'highlight-js', PARENT_THEME_URI . '/includes/highlight/highlight.pack.js', array(), null, true );
  	wp_enqueue_style('highlight-js', PARENT_THEME_URI . '/includes/highlight/styles/solarized_dark.css', array(), null, 'all');
	}
	if ($dev_jquery['fittext'] == true) { // jQuery FitText
  	wp_enqueue_script('fittext', PARENT_THEME_URI.'/assets/vendor/FitText.js/jquery.fittext.js', 'jquery', null);
	}
	if ($dev_jquery['lettering'] == true) { // jQuery FitText
  	wp_enqueue_script('lettering', PARENT_THEME_URI.'/assets/vendor/letteringjs/jquery.lettering.js', 'jquery', null);
	}
	if ($dev_jquery['fitvids'] == true) { // FitVids
  	wp_enqueue_script( 'fitvids', PARENT_THEME_URI . '/assets/vendor/jquery.fitvids/jquery.fitvids.js', 'jquery', null);
	}
	if ($dev_jquery['lazyload'] == true) { //LazyLoad
  	wp_enqueue_script('lazyload', PARENT_THEME_URI.'/assets/vendor/jquery_lazyload/jquery.lazyload.js', 'jquery', null);
  }
	// jQuery ScrollMe
	if ($dev_jquery['scrollme'] == true) {
  	wp_enqueue_script('scrollme', PARENT_THEME_URI.'/assets/vendor/scrollme/jquery.scrollme.min.js', 'jquery', null);
	}

	// Theme's js
	wp_enqueue_script( 'shoelace', PARENT_THEME_URI . '/assets/js/shoelace.js', array(), null, true );

 // Child's jQuery
	wp_enqueue_script( 'shoelace-child', CHILD_THEME_URI . '/child.js', array(), null, true );
}

 add_action( 'wp_enqueue_scripts', 'shoelace_scripts_styles' ); ?>