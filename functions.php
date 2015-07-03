<?php
/**
 * Shoelace functions and definitions
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * @package Shoelace
 * @since 0.1.0
 */

 // Useful global constants
define( 'SHOELACE_VERSION', '0.1.0' );

add_theme_support( 'post-thumbnails' );

 $custom_header = array(
			'width'         => 0,
			'height'        => 0,
			'flex-height'   => false,
			'flex-width'    => false,
			'header-text'   => false,
			'default-image' => '',
			'uploads'       => true,
		);

add_theme_support( 'custom-header', $custom_header );

$custom_bg = array(
	'default-color' => '',
	'default-image' => '',
);

add_theme_support( 'custom-background', $custom_bg );

function add_excerpts_to_pages() {
  add_post_type_support( 'page', 'excerpt' );
}
add_action( 'init', 'add_excerpts_to_pages' );

function register_main_menu() {
  register_nav_menu('main-navigation',__( 'Main Navigation' ));
}
add_action( 'init', 'register_main_menu' );

// Register Custom Navigation Walker
require_once('core/wp_bootstrap_navwalker.php');

/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

 /**
  * Set up theme defaults and register supported WordPress features.
  *
  * @uses load_theme_textdomain() For translation/localization support.
  *
  * @since 0.1.0
  */
 function shoelace_setup() {
	/**
	 * Makes Shoelace available for translation.
	 *
	 * Translations can be added to the /lang directory.
	 * If you're building a theme based on Shoelace, use a find and replace
	 * to change 'shoelace' to the name of your theme in all template files.
	 */
	load_theme_textdomain( 'shoelace', get_template_directory() . '/languages' );
 }
 add_action( 'after_setup_theme', 'shoelace_setup' );

 /**
  * Enqueue scripts and styles for front-end.
  *
  * @since 0.1.0
  */
 function shoelace_scripts_styles() {
  $parent_theme_uri = get_template_directory_uri();
  $child_theme_uri = get_stylesheet_directory_uri();

  // jQuery
	wp_enqueue_script( 'jquery' );

	// Bootstrap
	wp_enqueue_style( 'bootstrap', $parent_theme_uri . '/includes/bootstrap/css/bootstrap.min.css', array(), null, 'all' );
	wp_enqueue_script( 'bootstrap', $parent_theme_uri . '/includes/bootstrap/js/bootstrap.min.js', array(), null, true );
	wp_enqueue_style( 'bootstrap-theme', $child_theme_uri . '/includes/bootstrap/css/bootstrap-theme.css', array(), null, 'all' );

	// Font Awesome
	wp_enqueue_style('font-awesome', $parent_theme_uri . '/includes/font-awesome/css/font-awesome.min.css', array(), null, 'all');

	// Child and parent stylesheets.
	wp_enqueue_style( 'shoelace', $parent_theme_uri . '/style.css', array(), null, 'all' );
	wp_enqueue_style( 'shoelace-child', get_stylesheet_uri(), array(), null, 'all' );

	/// OTHER

	// FitVids.
	//wp_enqueue_script( 'fitvids', $parent_theme_uri . '/assets/js/jquery.fitvids.js', array(), null, true );

	// Lazy Load
	// ---------
	//wp_enqueue_script( 'lazyload', $parent_theme_uri . '/includes/lazyload/jquery.lazyload.min.js', array(), 'jquery', '1.9.5' );


	//BeLazy
	wp_enqueue_script('belazy', $parent_theme_uri.'/includes/belazy/blazy.min.js', null, '1.3.1');

	// Zoom.js
	wp_enqueue_style('zoom-js', $parent_theme_uri . '/includes/zoom.js/zoom.css', array(), null, 'all');
	wp_enqueue_script( 'zoom-js', $parent_theme_uri . '/includes/zoom.js/zoom.js', array(), null, true );

	// jQuery FitText
	wp_enqueue_script('fittext', $parent_theme_uri.'/includes/fittext/jquery.fittext.js', 'jquery', '1.2.0');

	// jQuery ScrollMe
	wp_enqueue_script('scrollme', $parent_theme_uri.'/includes/scrollme/jquery.scrollme.min.js', 'jquery', '1.1.0');


	// Theme's jQuery.
	wp_enqueue_script( 'shoelace-js', $parent_theme_uri . '/assets/js/shoelace.js', array(), null, true );
 }
 add_action( 'wp_enqueue_scripts', 'shoelace_scripts_styles' );

 /**
  * Add humans.txt to the <head> element.
  */
 function shoelace_header_meta() {
	$humans = '<link type="text/plain" rel="author" href="' . get_template_directory_uri() . '/humans.txt" />';

	echo apply_filters( 'shoelace_humans', $humans );
 }
 add_action( 'wp_head', 'shoelace_header_meta' );

function add_responsive_class($content){

  $content = mb_convert_encoding($content, 'HTML-ENTITIES', "UTF-8");
  $document = new DOMDocument();
  libxml_use_internal_errors(true);
  if ($content)
  $document->loadHTML(utf8_decode($content));

  $imgs = $document->getElementsByTagName('img');
  foreach ($imgs as $img) {
    $existing_class = $img->getAttribute('class');
    $img->setAttribute('class', "img-responsive $existing_class");
    $img->setAttribute('data-action','zoom');
  }

  $html = $document->saveHTML();
  return $html;
}

add_filter ('the_content', 'add_responsive_class');

// less.php compiler
require_once 'includes/less.php/Less.php';

// Recommended and required plugins
require_once 'includes/tgm-plugin-activation-2.4.2/plugins.php';
