<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 */
function optionsframework_option_name() {

	// Change this to use your theme slug
	return 'shoelace-options';
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'shoelace'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options() {


	$post_header_array = array(
		'none' => __('None', 'shoelace'),
		'parallax-cover' => __('Parallax cover', 'shoelace'),
		'cover-image' => __('Cover image', 'shoelace')
	);
	/*
	// Background Defaults
	$background_defaults = array(
		'color' => '',
		'image' => '',
		'repeat' => 'repeat',
		'position' => 'top center',
		'attachment'=>'scroll' );

	// Typography Defaults
	$typography_defaults = array(
		'size' => '15px',
		'face' => 'georgia',
		'style' => 'bold',
		'color' => '#bada55' );

	// Typography Options
	$typography_options = array(
		'sizes' => array( '6','12','14','16','20' ),
		'faces' => array( 'Helvetica Neue' => 'Helvetica Neue','Arial' => 'Arial' ),
		'styles' => array( 'normal' => 'Normal','bold' => 'Bold' ),
		'color' => false
	); */

	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}

	// Pull all tags into an array
	$options_tags = array();
	$options_tags_obj = get_tags();
	foreach ( $options_tags_obj as $tag ) {
		$options_tags[$tag->term_id] = $tag->name;
	}

	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}

	// Navigation positioning
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}

	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/core/options-framework/images/';

	$options = array();

	$options[] = array(
    'name' => __('Style', 'shoelace'),
    'type' => 'heading'
  );

  $options[] = array(
		'name' => __('Website Logo', 'shoelace'),
		'desc' => __('Upload a logo image. It will appear in the header.', 'shoelace'),
		'id' => 'logo_image',
		'type' => 'upload'
  );
  $options[] = array(
		'name' => __('Inverted Logo', 'shoelace'),
		'desc' => __('Upload an inverted logo image. It is used in special locations.', 'shoelace'),
		'id' => 'inv_logo_image',
		'type' => 'upload'
  );

  $options[] = array(
		'name' => __('Favicon', 'shoelace'),
		'desc' => __('Upload or select a favicon.', 'shoelace'),
		'id' => 'favicon',
		'type' => 'upload'
  );

  $options[] = array(
		'name' => __('Footer Rows', 'shoelace'),
		'desc' => __('Choose which rows to enable in the footer.', 'shoelace'),
		'id' => 'footer_rows',
		'std' =>  array('widgets'),
		'type' => 'multicheck',
		'options' =>  array(
      'widgets' => __('Widgetized area', 'shoelace'),
      'menu' => __('Menu', 'shoelace'),
      'static' => __('Static content row', 'shoelace')
    ));

  $options[] = array(
		'name' => __('Footer columns', 'shoelace'),
		'desc' => __('Choose the mumber of widgetized columns to show in the footer.', 'shoelace'),
		'id' => 'footer_columns',
		'type' => 'select',
		'std' =>  4,
		'options' => array(
  		0 => __('No classes added', 'shoelace'),
  		2 => __('Two', 'shoelace'),
  		3 => __('Three', 'shoelace'),
  		4 => __('Four', 'shoelace')
  	));

  $options[] = array(
		'name' => __('Footer Text', 'shoelace'),
		'desc' => __('The text which will appear at the footer.', 'shoelace'),
		'id' => 'footer_text',
		'std' => 'Copyright 2015.',
		'type' => 'textarea');

  /*
	$options[] = array(
    'name' => __('Input Text Mini', 'shoelace'),
    'desc' => __('A mini text input field.', 'shoelace'),
    'id' => 'example_text_mini',
    'std' => 'Default',
    'class' => 'mini',
    'type' => 'text'
  );

	$options[] = array(
		'name' => __('Input Text', 'shoelace'),
		'desc' => __('A text input field.', 'shoelace'),
		'id' => 'example_text',
		'std' => 'Default Value',
		'type' => 'text');

	$options[] = array(
		'name' => __('Input with Placeholder', 'shoelace'),
		'desc' => __('A text input field with an HTML5 placeholder.', 'shoelace'),
		'id' => 'example_placeholder',
		'placeholder' => 'Placeholder',
		'type' => 'text');

	$options[] = array(
		'name' => __('Textarea', 'shoelace'),
		'desc' => __('Textarea description.', 'shoelace'),
		'id' => 'example_textarea',
		'std' => 'Default Text',
		'type' => 'textarea');

	$options[] = array(
		'name' => __('Input Select Small', 'shoelace'),
		'desc' => __('Small Select Box.', 'shoelace'),
		'id' => 'example_select',
		'std' => 'three',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $test_array);

	$options[] = array(
		'name' => __('Input Select Wide', 'shoelace'),
		'desc' => __('A wider select box.', 'shoelace'),
		'id' => 'example_select_wide',
		'std' => 'two',
		'type' => 'select',
		'options' => $test_array);

	if ( $options_categories ) {
	$options[] = array(
		'name' => __('Select a Category', 'shoelace'),
		'desc' => __('Passed an array of categories with cat_ID and cat_name', 'shoelace'),
		'id' => 'example_select_categories',
		'type' => 'select',
		'options' => $options_categories);
	}

	if ( $options_tags ) {
	$options[] = array(
		'name' => __('Select a Tag', 'options_check'),
		'desc' => __('Passed an array of tags with term_id and term_name', 'options_check'),
		'id' => 'example_select_tags',
		'type' => 'select',
		'options' => $options_tags);
	}

	$options[] = array(
		'name' => __('Select a Page', 'shoelace'),
		'desc' => __('Passed an pages with ID and post_title', 'shoelace'),
		'id' => 'example_select_pages',
		'type' => 'select',
		'options' => $options_pages);

	$options[] = array(
		'name' => __('Input Radio (one)', 'shoelace'),
		'desc' => __('Radio select with default options "one".', 'shoelace'),
		'id' => 'example_radio',
		'std' => 'one',
		'type' => 'radio',
		'options' => $test_array);

	$options[] = array(
		'name' => __('Example Info', 'shoelace'),
		'desc' => __('This is just some example information you can put in the panel.', 'shoelace'),
		'type' => 'info');

	$options[] = array(
		'name' => __('Input Checkbox', 'shoelace'),
		'desc' => __('Example checkbox, defaults to true.', 'shoelace'),
		'id' => 'example_checkbox',
		'std' => '1',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('Post Types', 'shoelace'),
		'desc' => __('Choose which post types to enable.', 'shoelace'),
		'id' => 'post_types',
		'std' => null, // These items get checked by default
		'type' => 'multicheck',
		'options' =>  array(
		  'portfolio' => __('Portfolio', 'shoelace'))
  ); */


/*== Layout Settings == */

$options[] = array(
	'name' => __('Layout', 'shoelace'),
	'type' => 'heading'
);

$options[] = array(
	'name' => "Container Type",
	'desc' => "Should containers be flexible or fixed?",
	'id' => "container",
	'std' => "contained",
	'type' => "images",
	'options' => array(
		'contained' => $imagepath . 'fixed.png',
		'flexible' => $imagepath . 'flex.png')
);

$options[] = array(
	'name' => __('Navbar position', 'shoelace'),
	'desc' => __('How you want the navbar position set.', 'shoelace'),
	'id' => 'navbar_pos',
	'std' => 'none',
	'type' => 'radio',
	'options' => array(
		'none' => __('None', 'shoelace'),
		'fixed-top' => __('Fixed on top', 'shoelace')
	)
);

$options[] = array(
	'name' => "Archive Layout",
	'desc' => "Layout of archive pages.",
	'id' => "archive_layout",
	'std' => "fullwidth",
	'type' => "images",
	'options' => array(
		'fullwidth' => $imagepath . 'full.png',
		'2c-l-fixed' => $imagepath . '2cl.png',
		'2c-r-fixed' => $imagepath . '2cr.png'
	)
);

$options[] = array(
	'name' => __('Archive Contents', 'shoelace'),
	'desc' => __('How would you like the archive page to appear?', 'shoelace'),
	'id' => 'archive_contents',
	'std' => 'masonry',
	'type' => 'radio',
	'options' => array(
  	'masonry' => __('Grid (Masonry)', 'shoelace'),
  	'list' => __('List', 'shoelace')
	)
);

$options[] = array(
	'name' => __('Post Header', 'shoelace'),
	'desc' => __('Which type of header would you like for regular posts?', 'shoelace'),
	'id' => 'post_header',
	'std' => 'none',
	'type' => 'radio',
	'options' => $post_header_array
);

$options[] = array(
	'name' => "Post Layout",
	'desc' => "Layout of blog posts.",
	'id' => "post_layout",
	'std' => "fullwidth",
	'type' => "images",
	'options' => array(
		'fullwidth' => $imagepath . 'full.png',
		'2c-l-fixed' => $imagepath . '2cl.png',
		'2c-r-fixed' => $imagepath . '2cr.png'
	)
);

	$options[] = array(
		'name' => __('Page Header', 'shoelace'),
		'desc' => __('Which type of header would you like for regular posts?', 'shoelace'),
		'id' => 'page_header',
		'std' => 'none',
		'type' => 'radio',
		'options' => $post_header_array
  );

  $options[] = array(
		'name' => "Page Layout",
		'desc' => "Layout of pages.",
		'id' => "page_layout",
		'std' => "fullwidth",
		'type' => "images",
		'options' => array(
			'fullwidth' => $imagepath . 'full.png',
			'2c-l-fixed' => $imagepath . '2cl.png',
			'2c-r-fixed' => $imagepath . '2cr.png')
	);

	$options[] = array(
		'name' => __('Show comments on pages', 'shoelace'),
		'desc' => __('Check to show comments on pages.', 'shoelace'),
		'id' => 'page_comments',
		'type' => 'checkbox'
  );



    $options[] = array(
    	'name' => __('Development', 'shoelace'),
    	'type' => 'heading'
    );

		$options[] = array(
		'name' => __('Scripts', 'shoelace'),
		'desc' => __('Select which scripts to enable.', 'shoelace'),
		'id' => 'dev_scripts',
		'std' => array(
  		'fontawesome' => '1',
  		'zoomjs' => '1'
  	), // These items get checked by default
		'type' => 'multicheck',
		'options' => array(
  		'fontawesome' => 'Font Awesome',
  		'zoomjs' => 'zoom.js',
  		'masonry' => 'Masonry',
  		'dropcap' => 'dropcap.js',
  		'highlight' => 'highlight.js'
    ));

		$options[] = array(
		'name' => __('jQuery Plugins', 'shoelace'),
		'desc' => __('Select which jQuery plugins to enable.', 'shoelace'),
		'id' => 'dev_jquery',
		'std' => array(
  		'fitvids' => '1'
		), // These items get checked by default
		'type' => 'multicheck',
		'options' => array(
    	'fittext' => 'FitText', //
    	'fitvids' => 'FitVids', // https://github.com/davatron5000/FitVids.js
    	'lazyload' => 'Lazy Load', //
    	'lettering' => 'lettering.js', // https://github.com/davatron5000/Lettering.js
    	'scrollme' => 'ScrollMe' // https://github.com/nckprsn/scrollme
  	));

  	$options[] = array(
		'name' => __('Other', 'shoelace'),
		'desc' => __('Select other developer goodies to enable.', 'shoelace'),
		'id' => 'dev_other',
		'std' => array(
  		'bs_shortcodes' => '1'
		), // These items get checked by default
		'type' => 'multicheck',
		'options' => array(
    	'bs_shortcodes' => 'Bootstrap 3 Shortcodes'
  	));


/*==========================

	$options[] = array(
		'name' => __('Advanced Settings', 'shoelace'),
		'type' => 'heading');

	$options[] = array(
		'name' => __('Check to Show a Hidden Text Input', 'shoelace'),
		'desc' => __('Click here and see what happens.', 'shoelace'),
		'id' => 'example_showhidden',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('Hidden Text Input', 'shoelace'),
		'desc' => __('This option is hidden unless activated by a checkbox click.', 'shoelace'),
		'id' => 'example_text_hidden',
		'std' => 'Hello',
		'class' => 'hidden',
		'type' => 'text');

	$options[] = array(
		'name' => __('Uploader Test', 'shoelace'),
		'desc' => __('This creates a full size uploader that previews the image.', 'shoelace'),
		'id' => 'example_uploader',
		'type' => 'upload');

	$options[] = array(
		'name' => "Example Image Selector",
		'desc' => "Images for layout.",
		'id' => "example_images",
		'std' => "2c-l-fixed",
		'type' => "images",
		'options' => array(
			'fullwidth' => $imagepath . 'full.png',
			'2c-l-fixed' => $imagepath . '2cl.png',
			'2c-r-fixed' => $imagepath . '2cr.png')
	);

	$options[] = array(
		'name' =>  __('Example Background', 'shoelace'),
		'desc' => __('Change the background CSS.', 'shoelace'),
		'id' => 'example_background',
		'std' => $background_defaults,
		'type' => 'background' );

	$options[] = array(
		'name' => __('Colorpicker', 'shoelace'),
		'desc' => __('No color selected by default.', 'shoelace'),
		'id' => 'example_colorpicker',
		'std' => '',
		'type' => 'color' );

	$options[] = array( 'name' => __('Typography', 'shoelace'),
		'desc' => __('Example typography.', 'shoelace'),
		'id' => "example_typography",
		'std' => $typography_defaults,
		'type' => 'typography' );

	$options[] = array(
		'name' => __('Custom Typography', 'shoelace'),
		'desc' => __('Custom typography options.', 'shoelace'),
		'id' => "custom_typography",
		'std' => $typography_defaults,
		'type' => 'typography',
		'options' => $typography_options );

	$options[] = array(
		'name' => __('Text Editor', 'shoelace'),
		'type' => 'heading' );

		*/
		if (function_exists('sed_footer_text')) {
  		$options[] = array(
  		'name' => __('SED+', 'shoelace'),
  		'type' => 'heading');

  		$options[] = array(
    		'name' => __('Footer logo', 'shoelace'),
    		'desc' => __('Enable SED+ footer logo.', 'shoelace'),
    		'id' => 'sed_foot_logo',
    		'std' => '1',
    		'type' => 'checkbox');
		}




	/**
	 * For $settings options see:
	 * http://codex.wordpress.org/Function_Reference/wp_editor
	 *
	 * 'media_buttons' are not supported as there is no post to attach items to
	 * 'textarea_name' is set by the 'id' you choose
	 */

	 /*
	$wp_editor_settings = array(
		'wpautop' => true, // Default
		'textarea_rows' => 5,
		'tinymce' => array( 'plugins' => 'wordpress' )
	);

	$options[] = array(
		'name' => __('Default Text Editor', 'shoelace'),
		'desc' => sprintf( __( 'You can also pass settings to the editor.  Read more about wp_editor in <a href="%1$s" target="_blank">the WordPress codex</a>', 'shoelace' ), 'http://codex.wordpress.org/Function_Reference/wp_editor' ),
		'id' => 'example_editor',
		'type' => 'editor',
		'settings' => $wp_editor_settings );

		*/

	return $options;
}