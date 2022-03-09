<?php
/**
 * Watch Store Theme Customizer
 *
 * @package Watch Store
 */

/**
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */

/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class Watch_Store_Customize {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	 */
	public function sections( $manager ) {

		// Load custom sections.
		load_template( trailingslashit( get_template_directory() ) . '/inc/section-pro.php' );

		// Register custom section types.
		$manager->register_section_type( 'Watch_Store_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section(
			new Watch_Store_Customize_Section_Pro(
				$manager,
				'example_1',
				array(
					'priority' => 9,
					'title'    => esc_html__( 'Watch Store Pro', 'watch-store' ),
					'pro_text' => esc_html__( 'Go Pro', 'watch-store' ),
					'pro_url'  => esc_url( 'https://www.logicalthemes.com/themes/watch-store-wordpress-theme/' ),
				)
			)
		);
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'watch-store-customize-controls', trailingslashit( esc_url(get_template_directory_uri()) ) . '/assets/js/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'watch-store-customize-controls', trailingslashit( esc_url(get_template_directory_uri()) ) . '/assets/css/customize-controls.css' );
	}
}

// Doing this customizer thang!
Watch_Store_Customize::get_instance();

function watch_store_customize_register( $wp_customize ) {	

	//add home page setting pannel
	$wp_customize->add_panel( 'watch_store_panel_id', array(
	    'priority' => 10,
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => esc_html__( 'LT Settings', 'watch-store' ),
	) );

	//Layout Setting
	$wp_customize->add_section( 'watch_store_left_right' , array(
    	'title'      => esc_html__( 'General Settings', 'watch-store' ),
		'priority'   => null,
		'panel' => 'watch_store_panel_id'
	) );

	$wp_customize->add_setting('watch_store_theme_options',array(
        'default' => 'Right Sidebar',
        'sanitize_callback' => 'watch_store_sanitize_choices'
	));
	$wp_customize->add_control('watch_store_theme_options',array(
        'type' => 'radio',
        'description' => __( 'Choose sidebar between different options', 'watch-store' ),
        'label' => esc_html__( 'Post Sidebar Layout.', 'watch-store' ),
        'section' => 'watch_store_left_right',
        'choices' => array(
            'One Column' => esc_html__('One Column ','watch-store'),
            'Three Columns' => esc_html__('Three Columns','watch-store'),
            'Four Columns' => esc_html__('Four Columns','watch-store'),
            'Right Sidebar' => esc_html__('Right Sidebar','watch-store'),
            'Left Sidebar' => esc_html__('Left Sidebar','watch-store'),
            'Grid Layout' => esc_html__('Grid Layout','watch-store')
        ),
	));

	$watch_store_font_array = array(
        '' =>'No Fonts',
        'Abril Fatface' => 'Abril Fatface',
        'Acme' =>'Acme', 
        'Anton' => 'Anton', 
        'Architects Daughter' =>'Architects Daughter',
        'Arimo' => 'Arimo', 
        'Arsenal' =>'Arsenal',
        'Arvo' =>'Arvo',
        'Alegreya' =>'Alegreya',
        'Alfa Slab One' =>'Alfa Slab One',
        'Averia Serif Libre' =>'Averia Serif Libre', 
        'Bangers' =>'Bangers', 
        'Boogaloo' =>'Boogaloo', 
        'Bad Script' =>'Bad Script',
        'Bitter' =>'Bitter', 
        'Bree Serif' =>'Bree Serif', 
        'BenchNine' =>'BenchNine',
        'Cabin' =>'Cabin',
        'Cardo' =>'Cardo', 
        'Courgette' =>'Courgette', 
        'Cherry Swash' =>'Cherry Swash',
        'Cormorant Garamond' =>'Cormorant Garamond', 
        'Crimson Text' =>'Crimson Text',
        'Cuprum' =>'Cuprum', 
        'Cookie' =>'Cookie',
        'Chewy' =>'Chewy',
        'Days One' =>'Days One',
        'Dosis' =>'Dosis',
        'Droid Sans' =>'Droid Sans', 
        'Economica' =>'Economica', 
        'Fredoka One' =>'Fredoka One',
        'Fjalla One' =>'Fjalla One',
        'Francois One' =>'Francois One', 
        'Frank Ruhl Libre' => 'Frank Ruhl Libre', 
        'Gloria Hallelujah' =>'Gloria Hallelujah',
        'Great Vibes' =>'Great Vibes', 
        'Handlee' =>'Handlee', 
        'Hammersmith One' =>'Hammersmith One',
        'Inconsolata' =>'Inconsolata',
        'Indie Flower' =>'Indie Flower', 
        'IM Fell English SC' =>'IM Fell English SC',
        'Julius Sans One' =>'Julius Sans One',
        'Josefin Slab' =>'Josefin Slab',
        'Josefin Sans' =>'Josefin Sans',
        'Kanit' =>'Kanit',
        'Lobster' =>'Lobster',
        'Lato' => 'Lato',
        'Lora' =>'Lora', 
        'Libre Baskerville' =>'Libre Baskerville',
        'Lobster Two' => 'Lobster Two',
        'Merriweather' =>'Merriweather',
        'Monda' =>'Monda',
        'Montserrat' =>'Montserrat',
        'Muli' =>'Muli',
        'Marck Script' =>'Marck Script',
        'Noto Serif' =>'Noto Serif',
        'Open Sans' =>'Open Sans',
        'Overpass' => 'Overpass', 
        'Overpass Mono' =>'Overpass Mono',
        'Oxygen' =>'Oxygen',
        'Orbitron' =>'Orbitron',
        'Patua One' =>'Patua One',
        'Pacifico' =>'Pacifico',
        'Padauk' =>'Padauk',
        'Playball' =>'Playball',
        'Playfair Display' =>'Playfair Display',
        'PT Sans' =>'PT Sans',
        'Philosopher' =>'Philosopher',
        'Permanent Marker' =>'Permanent Marker',
        'Poiret One' =>'Poiret One',
        'Quicksand' =>'Quicksand',
        'Quattrocento Sans' =>'Quattrocento Sans',
        'Raleway' =>'Raleway',
        'Rubik' =>'Rubik',
        'Rokkitt' =>'Rokkitt',
        'Russo One' => 'Russo One', 
        'Righteous' =>'Righteous', 
        'Slabo' =>'Slabo', 
        'Source Sans Pro' =>'Source Sans Pro',
        'Shadows Into Light Two' =>'Shadows Into Light Two',
        'Shadows Into Light' =>  'Shadows Into Light',
        'Sacramento' =>'Sacramento',
        'Shrikhand' =>'Shrikhand',
        'Tangerine' => 'Tangerine',
        'Ubuntu' =>'Ubuntu',
        'VT323' =>'VT323',
        'Varela Round' =>'Varela Round',
        'Vampiro One' =>'Vampiro One',
        'Vollkorn' => 'Vollkorn',
        'Volkhov' =>'Volkhov',
        'Yanone Kaffeesatz' =>'Yanone Kaffeesatz'
    );

	//Typography
	$wp_customize->add_section( 'watch_store_typography', array(
    	'title'      => __( 'Typography', 'watch-store' ),
		'priority'   => null,
		'panel' => 'watch_store_panel_id'
	) );
	
	// This is Paragraph Color picker setting
	$wp_customize->add_setting( 'watch_store_paragraph_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'watch_store_paragraph_color', array(
		'label' => __('Paragraph Color', 'watch-store'),
		'section' => 'watch_store_typography',
		'settings' => 'watch_store_paragraph_color',
	)));

	//This is Paragraph FontFamily picker setting
	$wp_customize->add_setting('watch_store_paragraph_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'watch_store_sanitize_choices'
	));
	$wp_customize->add_control(
	    'watch_store_paragraph_font_family', array(
	    'section'  => 'watch_store_typography',
	    'label'    => __( 'Paragraph Fonts','watch-store'),
	    'type'     => 'select',
	    'choices'  => $watch_store_font_array,
	));

	$wp_customize->add_setting('watch_store_paragraph_font_size',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('watch_store_paragraph_font_size',array(
		'label'	=> __('Paragraph Font Size','watch-store'),
		'section'	=> 'watch_store_typography',
		'setting'	=> 'watch_store_paragraph_font_size',
		'type'	=> 'text'
	));

	// This is "a" Tag Color picker setting
	$wp_customize->add_setting( 'watch_store_atag_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'watch_store_atag_color', array(
		'label' => __('"a" Tag Color', 'watch-store'),
		'section' => 'watch_store_typography',
		'settings' => 'watch_store_atag_color',
	)));

	//This is "a" Tag FontFamily picker setting
	$wp_customize->add_setting('watch_store_atag_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'watch_store_sanitize_choices'
	));
	$wp_customize->add_control(
	    'watch_store_atag_font_family', array(
	    'section'  => 'watch_store_typography',
	    'label'    => __( '"a" Tag Fonts','watch-store'),
	    'type'     => 'select',
	    'choices'  => $watch_store_font_array,
	));

	// This is "a" Tag Color picker setting
	$wp_customize->add_setting( 'watch_store_li_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'watch_store_li_color', array(
		'label' => __('"li" Tag Color', 'watch-store'),
		'section' => 'watch_store_typography',
		'settings' => 'watch_store_li_color',
	)));

	//This is "li" Tag FontFamily picker setting
	$wp_customize->add_setting('watch_store_li_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'watch_store_sanitize_choices'
	));
	$wp_customize->add_control(
	    'watch_store_li_font_family', array(
	    'section'  => 'watch_store_typography',
	    'label'    => __( '"li" Tag Fonts','watch-store'),
	    'type'     => 'select',
	    'choices'  => $watch_store_font_array,
	));

	// This is H1 Color picker setting
	$wp_customize->add_setting( 'watch_store_h1_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'watch_store_h1_color', array(
		'label' => __('H1 Color', 'watch-store'),
		'section' => 'watch_store_typography',
		'settings' => 'watch_store_h1_color',
	)));

	//This is H1 FontFamily picker setting
	$wp_customize->add_setting('watch_store_h1_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'watch_store_sanitize_choices'
	));
	$wp_customize->add_control(
	    'watch_store_h1_font_family', array(
	    'section'  => 'watch_store_typography',
	    'label'    => __( 'H1 Fonts','watch-store'),
	    'type'     => 'select',
	    'choices'  => $watch_store_font_array,
	));

	//This is H1 FontSize setting
	$wp_customize->add_setting('watch_store_h1_font_size',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('watch_store_h1_font_size',array(
		'label'	=> __('H1 Font Size','watch-store'),
		'section'	=> 'watch_store_typography',
		'setting'	=> 'watch_store_h1_font_size',
		'type'	=> 'text'
	));

	// This is H2 Color picker setting
	$wp_customize->add_setting( 'watch_store_h2_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'watch_store_h2_color', array(
		'label' => __('H2 Color', 'watch-store'),
		'section' => 'watch_store_typography',
		'settings' => 'watch_store_h2_color',
	)));

	//This is H2 FontFamily picker setting
	$wp_customize->add_setting('watch_store_h2_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'watch_store_sanitize_choices'
	));
	$wp_customize->add_control(
	    'watch_store_h2_font_family', array(
	    'section'  => 'watch_store_typography',
	    'label'    => __( 'H2 Fonts','watch-store'),
	    'type'     => 'select',
	    'choices'  => $watch_store_font_array,
	));

	//This is H2 FontSize setting
	$wp_customize->add_setting('watch_store_h2_font_size',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('watch_store_h2_font_size',array(
		'label'	=> __('H2 Font Size','watch-store'),
		'section'	=> 'watch_store_typography',
		'setting'	=> 'watch_store_h2_font_size',
		'type'	=> 'text'
	));

	// This is H3 Color picker setting
	$wp_customize->add_setting( 'watch_store_h3_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'watch_store_h3_color', array(
		'label' => __('H3 Color', 'watch-store'),
		'section' => 'watch_store_typography',
		'settings' => 'watch_store_h3_color',
	)));

	//This is H3 FontFamily picker setting
	$wp_customize->add_setting('watch_store_h3_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'watch_store_sanitize_choices'
	));
	$wp_customize->add_control(
	    'watch_store_h3_font_family', array(
	    'section'  => 'watch_store_typography',
	    'label'    => __( 'H3 Fonts','watch-store'),
	    'type'     => 'select',
	    'choices'  => $watch_store_font_array,
	));

	//This is H3 FontSize setting
	$wp_customize->add_setting('watch_store_h3_font_size',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('watch_store_h3_font_size',array(
		'label'	=> __('H3 Font Size','watch-store'),
		'section'	=> 'watch_store_typography',
		'setting'	=> 'watch_store_h3_font_size',
		'type'	=> 'text'
	));

	// This is H4 Color picker setting
	$wp_customize->add_setting( 'watch_store_h4_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'watch_store_h4_color', array(
		'label' => __('H4 Color', 'watch-store'),
		'section' => 'watch_store_typography',
		'settings' => 'watch_store_h4_color',
	)));

	//This is H4 FontFamily picker setting
	$wp_customize->add_setting('watch_store_h4_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'watch_store_sanitize_choices'
	));
	$wp_customize->add_control(
	    'watch_store_h4_font_family', array(
	    'section'  => 'watch_store_typography',
	    'label'    => __( 'H4 Fonts','watch-store'),
	    'type'     => 'select',
	    'choices'  => $watch_store_font_array,
	));

	//This is H4 FontSize setting
	$wp_customize->add_setting('watch_store_h4_font_size',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('watch_store_h4_font_size',array(
		'label'	=> __('H4 Font Size','watch-store'),
		'section'	=> 'watch_store_typography',
		'setting'	=> 'watch_store_h4_font_size',
		'type'	=> 'text'
	));

	// This is H5 Color picker setting
	$wp_customize->add_setting( 'watch_store_h5_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'watch_store_h5_color', array(
		'label' => __('H5 Color', 'watch-store'),
		'section' => 'watch_store_typography',
		'settings' => 'watch_store_h5_color',
	)));

	//This is H5 FontFamily picker setting
	$wp_customize->add_setting('watch_store_h5_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'watch_store_sanitize_choices'
	));
	$wp_customize->add_control(
	    'watch_store_h5_font_family', array(
	    'section'  => 'watch_store_typography',
	    'label'    => __( 'H5 Fonts','watch-store'),
	    'type'     => 'select',
	    'choices'  => $watch_store_font_array,
	));

	//This is H5 FontSize setting
	$wp_customize->add_setting('watch_store_h5_font_size',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('watch_store_h5_font_size',array(
		'label'	=> __('H5 Font Size','watch-store'),
		'section'	=> 'watch_store_typography',
		'setting'	=> 'watch_store_h5_font_size',
		'type'	=> 'text'
	));

	// This is H6 Color picker setting
	$wp_customize->add_setting( 'watch_store_h6_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'watch_store_h6_color', array(
		'label' => __('H6 Color', 'watch-store'),
		'section' => 'watch_store_typography',
		'settings' => 'watch_store_h6_color',
	)));

	//This is H6 FontFamily picker setting
	$wp_customize->add_setting('watch_store_h6_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'watch_store_sanitize_choices'
	));
	$wp_customize->add_control(
	    'watch_store_h6_font_family', array(
	    'section'  => 'watch_store_typography',
	    'label'    => __( 'H6 Fonts','watch-store'),
	    'type'     => 'select',
	    'choices'  => $watch_store_font_array,
	));

	//This is H6 FontSize setting
	$wp_customize->add_setting('watch_store_h6_font_size',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('watch_store_h6_font_size',array(
		'label'	=> __('H6 Font Size','watch-store'),
		'section'	=> 'watch_store_typography',
		'setting'	=> 'watch_store_h6_font_size',
		'type'	=> 'text'
	));

	//Topbar section
	$wp_customize->add_section('watch_store_topbar',array(
		'title'	=> esc_html__('Topbar','watch-store'),
		'priority'	=> null,
		'panel' => 'watch_store_panel_id',
	));

	$wp_customize->add_setting( 'watch_store_sticky_header',array(
		'default'	=> false,
      	'sanitize_callback'	=> 'watch_store_sanitize_checkbox'
    ) );
    $wp_customize->add_control('watch_store_sticky_header',array(
    	'type' => 'checkbox',
    	'description' => __( 'Click on the checkbox to enable sticky header.', 'watch-store' ),
        'label' => __( 'Sticky Header','watch-store' ),
        'section' => 'watch_store_topbar'
    ));

    //Show /Hide Topbar
	$wp_customize->add_setting( 'watch_store_show_topbar',array(
		'default' => false,
      	'sanitize_callback'	=> 'watch_store_sanitize_checkbox'
    ) );
    $wp_customize->add_control('watch_store_show_topbar',array(
    	'type' => 'checkbox',
    	'description' => __( 'Click on the checkbox to enable Topbar.', 'watch-store' ),
        'label' => __( 'Topbar','watch-store' ),
        'section' => 'watch_store_topbar'
    ));

	$wp_customize->add_setting('watch_store_topar_text',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('watch_store_topar_text',array(
		'label'	=> __('Topbar Text','watch-store'),
		'section' => 'watch_store_topbar',
		'type'	 => 'text'
	));

	$wp_customize->add_setting('watch_store_sale_text',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('watch_store_sale_text',array(
		'label'	=> __('Add Sale Text','watch-store'),
		'section' => 'watch_store_topbar',
		'type'	 => 'text'
	));

	$wp_customize->add_setting('watch_store_sale_button_text',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('watch_store_sale_button_text',array(
		'label'	=> __('Add Sale Button Text','watch-store'),
		'section' => 'watch_store_topbar',
		'type'	  => 'text'
	));

	$wp_customize->add_setting('watch_store_sale_button_link',array(
		'default' => '',
		'sanitize_callback'	=> 'esc_url_raw'
	));	
	$wp_customize->add_control('watch_store_sale_button_link',array(
		'label'	=> __('Add Sale Button Link','watch-store'),
		'section' => 'watch_store_topbar',
		'type'	  => 'url'
	));	

	//home page slider
	$wp_customize->add_section( 'watch_store_slidersettings' , array(
    	'title'      => esc_html__( 'Slider Settings', 'watch-store' ),
		'priority'   => null,
		'panel' => 'watch_store_panel_id'
	) );

	$wp_customize->add_setting('watch_store_slider_hide_show',array(
       'default' => false,
       'sanitize_callback'	=> 'watch_store_sanitize_checkbox'
	));
	$wp_customize->add_control('watch_store_slider_hide_show',array(
	   'type' => 'checkbox',
	   'description' => __( 'Click on the checkbox to enable slider.', 'watch-store' ),
	   'label' => esc_html__('Show / Hide slider','watch-store'),
	   'section' => 'watch_store_slidersettings',
	));

	for ( $count = 1; $count <= 4; $count++ ) {
		$wp_customize->add_setting( 'watch_store_slider_page' . $count, array(
			'default'           => '',
			'sanitize_callback' => 'watch_store_sanitize_dropdown_pages'
		) );
		$wp_customize->add_control( 'watch_store_slider_page' . $count, array(
			'label'    => esc_html__( 'Select Slider Page', 'watch-store' ),
	   		'description' => __( 'Slider Image Size (1200px x 650px)', 'watch-store' ),
			'section'  => 'watch_store_slidersettings',
			'type'     => 'dropdown-pages'
		) );
	}

	// Best Seller
	$wp_customize->add_section('watch_store_bestseller_section',array(
		'title'	=> __('Best Seller','watch-store'),
		'panel' => 'watch_store_panel_id',
	));

	$wp_customize->add_setting('watch_store_bestseller_section_title',array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('watch_store_bestseller_section_title',array(
		'label'	=> __('Section Title','watch-store'),
		'section' => 'watch_store_bestseller_section',
		'type'	  => 'text'
	));

	$wp_customize->add_setting('watch_store_bestseller_section_text',array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('watch_store_bestseller_section_text',array(
		'label'	=> __('Section Text','watch-store'),
		'section' => 'watch_store_bestseller_section',
		'type'	  => 'text'
	));
	
	$wp_customize->add_setting( 'watch_store_bestseller_products', array(
		'default'           => '',
		'sanitize_callback' => 'watch_store_sanitize_dropdown_pages'
	));
	$wp_customize->add_control( 'watch_store_bestseller_products', array(
		'label'    => __( 'Select Product Page', 'watch-store' ),
		'section'  => 'watch_store_bestseller_section',
		'type'     => 'dropdown-pages'
	));

	//footer
	$wp_customize->add_section('watch_store_footer_section',array(
		'title'	=> esc_html__('Footer Text','watch-store'),
		'panel' => 'watch_store_panel_id'
	));
	
	$wp_customize->add_setting('watch_store_footer_copy',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('watch_store_footer_copy',array(
		'label'	=> esc_html__('Copyright Text','watch-store'),
		'section'	=> 'watch_store_footer_section',
		'type'		=> 'text'
	));

	//Wocommerce Shop Page
	$wp_customize->add_section('watch_store_woocommerce_shop_page',array(
		'title'	=> __('Woocommerce Shop Page','watch-store'),
		'panel' => 'watch_store_panel_id'
	));

	$wp_customize->add_setting( 'watch_store_products_per_column' , array(
		'default'           => 3,
		'transport'         => 'refresh',
		'sanitize_callback' => 'watch_store_sanitize_choices',
	) );
	$wp_customize->add_control( 'watch_store_products_per_column', array(
		'label'    => __( 'Product Per Columns', 'watch-store' ),
		'description'	=> __('How many products should be shown per Column?','watch-store'),
		'section'  => 'watch_store_woocommerce_shop_page',
		'type'     => 'select',
		'choices'  => array(
			'2' => '2',
			'3' => '3',
			'4' => '4',
			'5' => '5',
		),
	)  );

	$wp_customize->add_setting('watch_store_products_per_page',array(
		'default'	=> 9,
		'sanitize_callback'	=> 'watch_store_sanitize_float',
	));	
	$wp_customize->add_control('watch_store_products_per_page',array(
		'label'	=> __('Product Per Page','watch-store'),
		'description'	=> __('How many products should be shown per page?','watch-store'),
		'section'	=> 'watch_store_woocommerce_shop_page',
		'type'		=> 'number'
	));

	// logo site title
	$wp_customize->add_setting('watch_store_site_title_tagline',array(
       'default' => true,
       'sanitize_callback'	=> 'watch_store_sanitize_checkbox'
    ));
    $wp_customize->add_control('watch_store_site_title_tagline',array(
       'type' => 'checkbox',
       'label' => __('Display Site Title and Tagline in Header','watch-store'),
       'section' => 'title_tagline'
    ));
}
add_action( 'customize_register', 'watch_store_customize_register' );