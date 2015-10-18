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
define( 'PARENT_THEME_URI', get_template_directory_uri());
define( 'CHILD_THEME_URI', get_stylesheet_directory_uri());

/*
* Loads the Options Panel
*
* If you're loading from a child theme use stylesheet_directory
* instead of template_directory
*/

define( 'OPTIONS_FRAMEWORK_DIRECTORY', PARENT_THEME_URI . '/core/options-framework/' );
require_once dirname( __FILE__ ) . '/core/options-framework/options-framework.php';
require_once get_template_directory() . '/options.php';

/*
 * Helper function to return the theme option value. If no value has been saved, it returns $default.
 * Needed because options are saved as serialized strings.
 *
 * This code allows the theme to work without errors if the Options Framework plugin has been disabled.
 */

if ( !function_exists( 'of_get_option' ) ) {
function of_get_option($name, $default = false) {

	$optionsframework_settings = get_option('optionsframework');

	// Gets the unique option id
	$option_name = $optionsframework_settings['id'];

	if ( get_option($option_name) ) {
		$options = get_option($option_name);
	}

	if ( isset($options[$name]) ) {
		return $options[$name];
	} else {
		return $default;
	}
}
}

function optionsframework_custom_scripts() { ?>

  <script type="text/javascript">
    jQuery(document).ready(function() {

    	jQuery('#example_showhidden').click(function() {
      		jQuery('#section-example_text_hidden').fadeToggle(400);
    	});

    	if (jQuery('#example_showhidden:checked').val() !== undefined) {
    		jQuery('#section-example_text_hidden').show();
    	}

    });
  </script>

<?php }
add_action( 'optionsframework_custom_scripts', 'optionsframework_custom_scripts' );

show_admin_bar( false );
//wp_dequeue_style( 'admin-bar' );

add_theme_support( 'post-thumbnails' );

/*
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
*/

function register_shoelace_sidebars() {

  $footer_cols = of_get_option('footer_columns');
  switch($footer_cols) {
    case 0:
      $col_classes = '';
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
  }

  if (function_exists('register_sidebar')) {
    register_sidebar(array(
      'name' => __( 'Sidebar', 'shoelace' ),
      'id' => 'sidebar',
      'before_widget' => '',
      'after_widget' => '',
      'before_title' => '',
      'after_title' => ''
    ));
    register_sidebar(array(
      'name' => __( 'Footer Widgets', 'shoelace' ),
      'id' => 'footer_widgets',
      'before_widget' => '<div id="%1$s" class="widget %2$s '. $col_classes.'">',
      'after_widget' => '</div>',
      'before_title' => '<h3 class="widget_title">',
      'after_title' => '</h3>'
    ));
  }
}
add_action( 'widgets_init', 'register_shoelace_sidebars' );

$custom_bg = array(
	'default-color' => '',
	'default-image' => '',
);

add_theme_support( 'html5', array( 'comment-list' ) );
add_theme_support( 'custom-background', $custom_bg );

function add_excerpts_to_pages() {
  add_post_type_support( 'page', 'excerpt' );
}
add_action( 'init', 'add_excerpts_to_pages' );

function register_shoelace_menus() {
  register_nav_menu('main-navigation',__( 'Main Navigation' ));
  register_nav_menu('footer-navigation',__( 'Footer Navigation' ));
}
add_action( 'init', 'register_shoelace_menus' );

// Include Walkers
require_once('core/wp_bootstrap_navwalker.php');
require_once('core/class-wp-bootstrap-comment-walker.php');

  // Let WordPress manage the document title (no hard-coded <title> tag in the head).

	add_theme_support( 'title-tag' );

  // Set up theme defaults and register supported WordPress features. @uses load_theme_textdomain() For translation/localization support.

 function shoelace_setup() {
	/**
	 * Makes Shoelace available for translation. Translations can be added to the /lang directory.
	 * If you're building a theme based on Shoelace, use a find and replace
	 * to change 'shoelace' to the name of your theme in all template files.
	 */
	//load_theme_textdomain( 'shoelace', get_template_directory() . '/languages' );
	// http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 }
 //add_action( 'after_setup_theme', 'shoelace_setup' );

require_once 'core/scripts_styles.php';

require_once 'core/layout.php';

 // Add humans.txt and ie conditional html5 shim to the <head> element.
 function shoelace_header_meta() {
	$humans = '<link type="text/plain" rel="author" href="' . get_template_directory_uri() . '/humans.txt" /><!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->';

	echo apply_filters( 'shoelace_humans', $humans );
 }
 add_action( 'wp_head', 'shoelace_header_meta' );

function add_image_classes($content){

  $content = mb_convert_encoding($content, 'HTML-ENTITIES', "UTF-8");
  $document = new DOMDocument();
  libxml_use_internal_errors(true);
  if ($content)
  $document->loadHTML(utf8_decode($content));

  $imgs = $document->getElementsByTagName('img');
  foreach ($imgs as $img) {
    $existing_class = $img->getAttribute('class');
    $img->setAttribute('class', "img-responsive $existing_class lazy");
    $img->setAttribute('data-action','zoom');
  }

  $html = $document->saveHTML();
  return $html;
}

add_filter ('the_content', 'add_image_classes');

// Recommended and required plugins
require_once 'includes/tgm-plugin-activation-2.4.2/plugins.php';

// https://github.com/joshtronic/php-loremipsum
require_once 'core/php-loremipsum/LoremIpsum.php';
require_once 'core/metaboxes.php';
require_once 'core/customizer.php';

/**
 * Improves the WordPress caption shortcode with HTML5 figure & figcaption, microdata & wai-aria attributes
 *
 * Author: @joostkiens
 * Licensed under the MIT license
 *
 * @param  string $val     Empty
 * @param  array  $attr    Shortcode attributes
 * @param  string $content Shortcode content
 * @return string          Shortcode output
 */
function my_img_caption_shortcode_filter( $val, $attr, $content = null ) {
  extract( shortcode_atts( array(
  	'id'      => '',
		'align'   => 'aligncenter',
		'width'   => '',
		'caption' => ''
	), $attr ) );

	// No caption, no dice...
	if ( 1 > (int) $width || empty( $caption ) )
		return $val;

	if ( $id )
		$id = esc_attr( $id );

	// Add itemprop="contentURL" to image - Ugly hack
	$content = str_replace('<img', '<img itemprop="contentURL"', $content);
	return '<figure id="' . $id . '" aria-describedby="figcaption_' . $id . '" class="wp-caption ' . esc_attr($align) . '" itemscope itemtype="http://schema.org/ImageObject">' . do_shortcode( $content ) . '<figcaption id="figcaption_'. $id . '" class="wp-caption-text" itemprop="description">' . $caption . '</figcaption></figure>';
}
add_filter( 'img_caption_shortcode', 'my_img_caption_shortcode_filter', 10, 3 );