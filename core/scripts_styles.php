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
	wp_enqueue_script( 'bootstrap', PARENT_THEME_URI . '/includes/bootstrap/js/bootstrap.min.js', array(), null, true );

	// Font Awesome
	if ($dev_scripts['fontawesome'] == true) {
  	wp_enqueue_style('font-awesome', PARENT_THEME_URI . '/includes/font-awesome/css/font-awesome.min.css', array(), null, 'all');
	}
	// less.php compiler
  require_once get_template_directory() . '/includes/less.php/Less.php';

  /*$parser = new Less_Parser(array( 'compress'=>true ));
  $parser->parseFile( get_stylesheet_directory() . '/style.less', get_stylesheet_directory_uri() . 'asda' );
  $css = $parser->getCss();*/


  //zoom.js
	if ($dev_scripts['zoomjs'] == true) {
  	wp_enqueue_style('zoom-js', PARENT_THEME_URI . '/includes/zoom.js/zoom.css', array(), null, 'all');
  	wp_enqueue_script( 'zoom-js', PARENT_THEME_URI . '/includes/zoom.js/zoom.js', array(), null, true );
  }

  // Masonry
	if ($dev_scripts['masonry'] == true) {
  	wp_enqueue_script( 'masonry', PARENT_THEME_URI . '/includes/masonry.pkgd.min.js', array(), '3.3.2', true );
	}

	// dropcap.js
	if ($dev_scripts['dropcap'] == true) {
  	wp_enqueue_script( 'dropcap-js', PARENT_THEME_URI . '/includes/dropcap.js-1.0.0/dropcap.min.js', array(), '1.0.0', true );
	}

	// highlight.js
	if ($dev_scripts['highlight'] == true) {
  	wp_enqueue_script( 'highlight-js', PARENT_THEME_URI . '/includes/highlight/highlight.pack.js', array(), '8.8.0', true );
  	wp_enqueue_style('highlight-js', PARENT_THEME_URI . '/includes/highlight/styles/solarized_dark.css', array(), null, 'all');
	}

	// jQuery FitText
	if ($dev_jquery['fittext'] == true) {
  	wp_enqueue_script('fittext', PARENT_THEME_URI.'/includes/jquery.fittext.js', 'jquery', '1.2.0');
	}

	// jQuery FitText
	if ($dev_jquery['lettering'] == true) {
  	wp_enqueue_script('lettering', PARENT_THEME_URI.'/includes/jquery.lettering.js', 'jquery', '0.7.0');
	}

	  // FitVids
	if ($dev_jquery['fitvids'] == true) {
  	wp_enqueue_script( 'fitvids', PARENT_THEME_URI . '/includes/jquery.fitvids.js', 'jquery', '1.1.0');
	}

	//LazyLoad
	if ($dev_jquery['lazyload'] == true) {
  	wp_enqueue_script('lazyload', PARENT_THEME_URI.'/includes/jquery.lazyload.min.js', 'jquery', '1.9.5');
  }

	// jQuery ScrollMe
	if ($dev_jquery['scrollme'] == true) {
  	wp_enqueue_script('scrollme', PARENT_THEME_URI.'/includes/scrollme/jquery.scrollme.min.js', 'jquery', '1.1.0');
	}

	// Theme's js
	wp_enqueue_script( 'shoelace', PARENT_THEME_URI . '/assets/js/shoelace.js', array(), null, true );

 // Child's jQuery
	wp_enqueue_script( 'shoelace-child', CHILD_THEME_URI . '/child.js', array(), null, true );
}

 add_action( 'wp_enqueue_scripts', 'shoelace_scripts_styles' ); ?>