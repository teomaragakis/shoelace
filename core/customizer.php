<?php function shoelace_register_theme_customizer( $wp_customize ) {
  $wp_customize->add_section( 'shoelace_section_layout' , array(
    'title'      => __( 'Grid Layout', 'shoelace' ),
    'priority'   => 30 )
  );
  $wp_customize->add_setting( 'shoelace_footer_color', array('default' => '#ffffff') );
  $wp_customize->add_setting( 'shoelace_header_color', array('default' => '#ffffff') );
  $wp_customize->add_setting( 'shoelace_logo', array() );
  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      'shoelace_footer_color',
      array(
        'label' => __( 'Footer Color', 'shoelace' ),
        'section' => 'colors',
        'settings' => 'shoelace_footer_color'
      )
    )
  );
  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      'shoelace_header_color',
      array(
        'label' => __( 'Header Color', 'shoelace' ),
        'section' => 'colors',
        'settings' => 'shoelace_header_color'
      )
    )
  );
  $wp_customize->add_control(
    new WP_Customize_Image_Control(
      $wp_customize,
      'shoelace_logo',
      array(
        'label' => __( 'Website Logo', 'shoelace' ),
        'section' => 'title_tagline',
        'settings' => 'shoelace_logo'
      )
    )
  );
}
add_action( 'customize_register', 'shoelace_register_theme_customizer' );

function shoelace_customizer_css() { ?>
  <!-- Theme Customizer CSS -->
  <style type="text/css">
    header { background-color: <?php echo get_theme_mod( 'shoelace_header_color' ); ?>; }
    footer { background-color: <?php echo get_theme_mod( 'shoelace_footer_color' ); ?>; }
  </style>
<?php }
add_action( 'wp_head', 'shoelace_customizer_css' );

function shoelace_logo_html() {
  $shoelace_logo = get_theme_mod('shoelace_logo');
  if ($shoelace_logo) { ?>
  <img class="logo img-responsive"
    src="<?php echo $shoelace_logo; ?>"
    alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"
  />
  <?php } else {
    echo esc_attr( get_bloginfo( 'name', 'display' ) );
  }
}
//add_action( 'shoelace_logo', 'shoelace_logo_html' ); ?>