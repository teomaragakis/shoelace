<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 */
function optionsframework_option_name() {

	// Change this to use your theme slug
	return 'loki-options';
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'loki'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options() {

	// Test data
	$test_array = array(
		'one' => __('One', 'loki'),
		'two' => __('Two', 'loki'),
		'three' => __('Three', 'loki'),
		'four' => __('Four', 'loki'),
		'five' => __('Five', 'loki')
	);

	// Multicheck Array
	$multicheck_array = array(
		'one' => __('French Toast', 'loki'),
		'two' => __('Pancake', 'loki'),
		'three' => __('Omelette', 'loki'),
		'four' => __('Crepe', 'loki'),
		'five' => __('Waffle', 'loki')
	);

	// Multicheck Defaults
	$multicheck_defaults = array(
		'one' => '1',
		'five' => '1'
	);

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
	);

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

	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/core/options-framework/images/';

	$options = array();

	$options[] = array(
		'name' => __('Basic Settings', 'loki'),
		'type' => 'heading');

	$options[] = array(
		'name' => __('Input Text Mini', 'loki'),
		'desc' => __('A mini text input field.', 'loki'),
		'id' => 'example_text_mini',
		'std' => 'Default',
		'class' => 'mini',
		'type' => 'text');

	$options[] = array(
		'name' => __('Input Text', 'loki'),
		'desc' => __('A text input field.', 'loki'),
		'id' => 'example_text',
		'std' => 'Default Value',
		'type' => 'text');

	$options[] = array(
		'name' => __('Input with Placeholder', 'loki'),
		'desc' => __('A text input field with an HTML5 placeholder.', 'loki'),
		'id' => 'example_placeholder',
		'placeholder' => 'Placeholder',
		'type' => 'text');

	$options[] = array(
		'name' => __('Textarea', 'loki'),
		'desc' => __('Textarea description.', 'loki'),
		'id' => 'example_textarea',
		'std' => 'Default Text',
		'type' => 'textarea');

	$options[] = array(
		'name' => __('Input Select Small', 'loki'),
		'desc' => __('Small Select Box.', 'loki'),
		'id' => 'example_select',
		'std' => 'three',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $test_array);

	$options[] = array(
		'name' => __('Input Select Wide', 'loki'),
		'desc' => __('A wider select box.', 'loki'),
		'id' => 'example_select_wide',
		'std' => 'two',
		'type' => 'select',
		'options' => $test_array);

	if ( $options_categories ) {
	$options[] = array(
		'name' => __('Select a Category', 'loki'),
		'desc' => __('Passed an array of categories with cat_ID and cat_name', 'loki'),
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
		'name' => __('Select a Page', 'loki'),
		'desc' => __('Passed an pages with ID and post_title', 'loki'),
		'id' => 'example_select_pages',
		'type' => 'select',
		'options' => $options_pages);

	$options[] = array(
		'name' => __('Input Radio (one)', 'loki'),
		'desc' => __('Radio select with default options "one".', 'loki'),
		'id' => 'example_radio',
		'std' => 'one',
		'type' => 'radio',
		'options' => $test_array);

	$options[] = array(
		'name' => __('Example Info', 'loki'),
		'desc' => __('This is just some example information you can put in the panel.', 'loki'),
		'type' => 'info');

	$options[] = array(
		'name' => __('Input Checkbox', 'loki'),
		'desc' => __('Example checkbox, defaults to true.', 'loki'),
		'id' => 'example_checkbox',
		'std' => '1',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('Post Types', 'loki'),
		'desc' => __('Choose which post types to enable.', 'loki'),
		'id' => 'post_types',
		'std' => null, // These items get checked by default
		'type' => 'multicheck',
		'options' =>  array(
		                'portfolio' => __('Portfolio', 'loki')
                  )
  );


/*== Layout Settings ==*/

	$options[] = array(
		'name' => __('Layout Settings', 'loki'),
		'type' => 'heading');

		$options[] = array(
  		'name' => "Container Type",
  		'desc' => "Should the container be flexible or fixed?",
  		'id' => "container",
  		'std' => "contained",
  		'type' => "images",
  		'options' => array(
    		'contained' => $imagepath . 'fixed.png',
  			'flexible' => $imagepath . 'flex.png')

  	);

  	$options[] = array(
  		'name' => "Page Layout",
  		'desc' => "Layout of pages.",
  		'id' => "page-layout",
  		'std' => "fullwidth",
  		'type' => "images",
  		'options' => array(
  			'fullwidth' => $imagepath . 'full.png',
  			'2c-l-fixed' => $imagepath . '2cl.png',
  			'2c-r-fixed' => $imagepath . '2cr.png')
  	);

    $options[] = array(
  		'name' => "Post Layout",
  		'desc' => "Layout of blog posts.",
  		'id' => "post-layout",
  		'std' => "fullwidth",
  		'type' => "images",
  		'options' => array(
  			'fullwidth' => $imagepath . 'full.png',
  			'2c-l-fixed' => $imagepath . '2cl.png',
  			'2c-r-fixed' => $imagepath . '2cr.png')
  	);

/*==========================*/

	$options[] = array(
		'name' => __('Advanced Settings', 'loki'),
		'type' => 'heading');

	$options[] = array(
		'name' => __('Check to Show a Hidden Text Input', 'loki'),
		'desc' => __('Click here and see what happens.', 'loki'),
		'id' => 'example_showhidden',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('Hidden Text Input', 'loki'),
		'desc' => __('This option is hidden unless activated by a checkbox click.', 'loki'),
		'id' => 'example_text_hidden',
		'std' => 'Hello',
		'class' => 'hidden',
		'type' => 'text');

	$options[] = array(
		'name' => __('Uploader Test', 'loki'),
		'desc' => __('This creates a full size uploader that previews the image.', 'loki'),
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
		'name' =>  __('Example Background', 'loki'),
		'desc' => __('Change the background CSS.', 'loki'),
		'id' => 'example_background',
		'std' => $background_defaults,
		'type' => 'background' );

	$options[] = array(
		'name' => __('Multicheck', 'loki'),
		'desc' => __('Multicheck description.', 'loki'),
		'id' => 'example_multicheck',
		'std' => $multicheck_defaults, // These items get checked by default
		'type' => 'multicheck',
		'options' => $multicheck_array);

	$options[] = array(
		'name' => __('Colorpicker', 'loki'),
		'desc' => __('No color selected by default.', 'loki'),
		'id' => 'example_colorpicker',
		'std' => '',
		'type' => 'color' );

	$options[] = array( 'name' => __('Typography', 'loki'),
		'desc' => __('Example typography.', 'loki'),
		'id' => "example_typography",
		'std' => $typography_defaults,
		'type' => 'typography' );

	$options[] = array(
		'name' => __('Custom Typography', 'loki'),
		'desc' => __('Custom typography options.', 'loki'),
		'id' => "custom_typography",
		'std' => $typography_defaults,
		'type' => 'typography',
		'options' => $typography_options );

	$options[] = array(
		'name' => __('Text Editor', 'loki'),
		'type' => 'heading' );

	/**
	 * For $settings options see:
	 * http://codex.wordpress.org/Function_Reference/wp_editor
	 *
	 * 'media_buttons' are not supported as there is no post to attach items to
	 * 'textarea_name' is set by the 'id' you choose
	 */

	$wp_editor_settings = array(
		'wpautop' => true, // Default
		'textarea_rows' => 5,
		'tinymce' => array( 'plugins' => 'wordpress' )
	);

	$options[] = array(
		'name' => __('Default Text Editor', 'loki'),
		'desc' => sprintf( __( 'You can also pass settings to the editor.  Read more about wp_editor in <a href="%1$s" target="_blank">the WordPress codex</a>', 'loki' ), 'http://codex.wordpress.org/Function_Reference/wp_editor' ),
		'id' => 'example_editor',
		'type' => 'editor',
		'settings' => $wp_editor_settings );

	return $options;
}