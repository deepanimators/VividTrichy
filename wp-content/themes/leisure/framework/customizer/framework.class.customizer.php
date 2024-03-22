<?php
new LeisureCustomizer();

/**
 *	Curly Customizer Class
 *
 */
class LeisureCustomizer {

	public function __construct() {

		require_once( get_template_directory().'/framework/customizer/options.php' );

		/** Register Customizer */
		add_action( 'customize_register', array( &$this, 'customizer' ) );

		/** Add Scripts */
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'scripts_styles' ) );

		/** Slider Control */
		require_once( trailingslashit( get_template_directory() ) . 'framework/customizer/controls/control.slider.php' );
		require_once( trailingslashit( get_template_directory() ) . 'framework/customizer/controls/control.alpha.php' );


		/** Live Customizer */
		add_action( 'customize_preview_init', array( $this, 'live_preview' ) );

		/** Theme Activation */
		add_action( 'after_switch_theme', array( $this, 'theme_switch' ), 10 , 2 );

	}

	/** Theme Activation */
	function theme_switch( $oldname, $oldtheme = false ) {

		$options = apply_filters( 'leisure_theme_mods', array() );

		$valid_types = array(
			'text',
			'color',
			'select',
			'range',
			'slider',
			'checkbox',
			'radio',
			'textarea',
			'image',
			'background',
			'background_image'
		);

		$cto 	= unserialize( get_option( THEMEPREFIX.'_theme_options' ) );
		$mods 	= get_theme_mods();
		$mods	= is_array( $mods ) ? $mods : array();

		foreach ( $options as $option ) {
			if( in_array( $option['type'], $valid_types ) === true ){

				$default = isset( $option['default'] ) ? $option['default'] : null;

				if( ! in_array( $option['id'], $mods ) ){

					switch( $option['id'] ){
						case 'animations' 	:
							$default = isset( $cto['general_animations'] ) ? $cto['general_animations'] : $default;
							break;
						case 'comments' 	:
							$default =  isset( $cto['general_comments_pages'] ) ? $cto['general_comments_pages'] : $default;
							break;
						case 'excerpt' 		:
							$default =  isset( $cto['blog_listing_excerpt'] ) ? $cto['blog_listing_excerpt'] : $default;
							break;
						case 'author' 		:
							$default =  isset( $cto['hide_author'] ) ? $cto['hide_author'] : $default;
							break;
						case 'sharing'	 	:
							$default =  isset( $cto['general_sharing'] ) ? $cto['general_sharing'] : $default;
							break;
						case 'sharing_pages':
							$default =  isset( $cto['general_sharing_box_pages'] ) ? $cto['general_sharing_box_pages'] : $default;
							break;
						case 'sharing_posts':
							$default =  isset( $cto['general_sharing_box'] ) ? $cto['general_sharing_box'] : $default;
							break;
						case 'tf_user' 		:
							$default =  isset( $cto['theme_options_username'] ) ? $cto['theme_options_username'] : $default;
							break;
						case 'tf_api' 		:
							$default =  isset( $cto['theme_options_api'] ) ? $cto['theme_options_api'] : $default;
							break;
						case 'analytics' 	:
							$default =  isset( $cto['seo_analytics'] ) ? $cto['seo_analytics'] : $default;
							break;
						case 'webmaster' 	:
							$default =  isset( $cto['seo_webmaster'] ) ? $cto['seo_webmaster'] : $default;
							break;
						case 'header_alignment' :
							$default =  isset( $cto['header_align'] ) ? $cto['header_align'] : $default;
							break;
						case 'header_shading_color' :
							$header_color = new LeisureColor( $cto['header_shading_color'] );
							$default = $header_color->opacity( $cto['header_shading_opacity'] / 100 );
							break;
						case 'font' :
							$default = isset( $cto['fonts_body'] ) ? $cto['fonts_body']	: $default;
							break;
						case 'font_style' :
							$default = isset( $cto['fonts_body_style'] ) ? $cto['fonts_body_style']	: $default;
							break;
						case 'font_variant' :
							$default = isset( $cto['fonts_body_variant'] ) ? $cto['fonts_body_variant']	: $default;
							break;
						case 'font_size' :
							$default = isset( $cto['fonts_body_size'] ) ? $cto['fonts_body_size']	: $default;
							break;
						case 'subset' :
							$default =  isset( $cto['fonts_subset'] ) ? $cto['fonts_subset'] : $default;
							break;
						case 'font_h1' :
							$default = isset( $cto['fonts_h1'] ) ? $cto['fonts_h1']	: $default;
							break;
						case 'font_h1_style' :
							$default = isset( $cto['fonts_h1_style'] ) ? $cto['fonts_h1_style']	: $default;
							break;
						case 'font_h1_variant' :
							$default = isset( $cto['fonts_h1_variant'] ) ? $cto['fonts_h1_variant']	: $default;
							break;
						case 'font_h1_size' :
							$default = isset( $cto['fonts_h1_size'] ) ? $cto['fonts_h1_size']	: $default;
							break;
						case 'font_h2' :
							$default = isset( $cto['fonts_h2'] ) ? $cto['fonts_h2']	: $default;
							break;
						case 'font_h2_style' :
							$default = isset( $cto['fonts_h2_style'] ) ? $cto['fonts_h2_style']	: $default;
							break;
						case 'font_h2_variant' :
							$default = isset( $cto['fonts_h2_variant'] ) ? $cto['fonts_h2_variant']	: $default;
							break;
						case 'font_h2_size' :
							$default = isset( $cto['fonts_h2_size'] ) ? $cto['fonts_h2_size']	: $default;
							break;
						case 'font_h3' :
							$default = isset( $cto['fonts_h3'] ) ? $cto['fonts_h3']	: $default;
							break;
						case 'font_h3_style' :
							$default = isset( $cto['fonts_h3_style'] ) ? $cto['fonts_h3_style']	: $default;
							break;
						case 'font_h3_variant' :
							$default = isset( $cto['fonts_h3_variant'] ) ? $cto['fonts_h3_variant']	: $default;
							break;
						case 'font_h3_size' :
							$default = isset( $cto['fonts_h3_size'] ) ? $cto['fonts_h3_size']	: $default;
							break;
						case 'font_h4' :
							$default = isset( $cto['fonts_h4'] ) ? $cto['fonts_h4']	: $default;
							break;
						case 'font_h4_style' :
							$default = isset( $cto['fonts_h4_style'] ) ? $cto['fonts_h4_style']	: $default;
							break;
						case 'font_h4_variant' :
							$default = isset( $cto['fonts_h4_variant'] ) ? $cto['fonts_h4_variant']	: $default;
							break;
						case 'font_h4_size' :
							$default = isset( $cto['fonts_h4_size'] ) ? $cto['fonts_h4_size']	: $default;
							break;
						case 'font_h5' :
							$default = isset( $cto['fonts_h5'] ) ? $cto['fonts_h5']	: $default;
							break;
						case 'font_h5_style' :
							$default = isset( $cto['fonts_h5_style'] ) ? $cto['fonts_h5_style']	: $default;
							break;
						case 'font_h5_variant' :
							$default = isset( $cto['fonts_h5_variant'] ) ? $cto['fonts_h5_variant']	: $default;
							break;
						case 'font_h5_size' :
							$default = isset( $cto['fonts_h5_size'] ) ? $cto['fonts_h5_size']	: $default;
							break;
						case 'font_h6' :
							$default = isset( $cto['fonts_h6'] ) ? $cto['fonts_h6']	: $default;
							break;
						case 'font_h6_style' :
							$default = isset( $cto['fonts_h6_style'] ) ? $cto['fonts_h6_style']	: $default;
							break;
						case 'font_h6_variant' :
							$default = isset( $cto['fonts_h6_variant'] ) ? $cto['fonts_h6_variant']	: $default;
							break;
						case 'font_h6_size' :
							$default = isset( $cto['fonts_h6_size'] ) ? $cto['fonts_h6_size']	: $default;
							break;
						case 'font_menu' :
							$default = isset( $cto['fonts_menu'] ) ? $cto['fonts_menu']	: $default;
							break;
						case 'font_menu_style' :
							$default = isset( $cto['fonts_menu_style'] ) ? $cto['fonts_menu_style']	: $default;
							break;
						case 'font_menu_variant' :
							$default = isset( $cto['fonts_menu_variant'] ) ? $cto['fonts_menu_variant']	: $default;
							break;
						case 'font_menu_size' :
							$default = isset( $cto['fonts_menu_size'] ) ? $cto['fonts_menu_size']	: $default;
							break;
						case 'font_secondary_menu' :
							$default = isset( $cto['fonts_secondary_menu'] ) ? $cto['fonts_secondary_menu']	: $default;
							break;
						case 'font_secondary_menu_style' :
							$default = isset( $cto['fonts_secondary_menu_style'] ) ? $cto['fonts_secondary_menu_style']	: $default;
							break;
						case 'font_secondary_menu_variant' :
							$default = isset( $cto['fonts_secondary_menu_variant'] ) ? $cto['fonts_secondary_menu_variant']	: $default;
							break;
						case 'font_secondary_menu_size' :
							$default = isset( $cto['fonts_secondary_menu_size'] ) ? $cto['fonts_secondary_menu_size']	: $default;
							break;
						case 'font_blockquote' :
							$default = isset( $cto['fonts_blockquote'] ) ? $cto['fonts_blockquote']	: $default;
							break;
						case 'font_blockquote_style' :
							$default = isset( $cto['fonts_blockquote_style'] ) ? $cto['fonts_blockquote_style']	: $default;
							break;
						case 'font_blockquote_variant' :
							$default = isset( $cto['fonts_blockquote_variant'] ) ? $cto['fonts_blockquote_variant']	: $default;
							break;
						case 'font_blockquote_size' :
							$default = isset( $cto['fonts_blockquote_size'] ) ? $cto['fonts_blockquote_size'] : $default;
							break;
						case 'footer_color_text' :
							$default = isset( $cto['footer_text_color'] ) ? $cto['footer_text_color']	: $default;
							break;
						case 'footer_color_links' :
							$default = isset( $cto['footer_link_color'] ) ? $cto['footer_link_color']	: $default;
							break;
						case 'footer_color_titles' :
							$default = isset( $cto['footer_title_color'] ) ? $cto['footer_title_color']	: $default;
							break;
						case 'favicon' :
							$default = isset( $cto['general_favicon'] ) ? $cto['general_favicon']	: $default;
							break;
						case 'iphone_retina' :
							$default = isset( $cto['general_iphone_favicon_retina'] ) ? $cto['general_iphone_favicon_retina']	: $default;
							break;
						case 'iphone' :
							$default = isset( $cto['general_iphone_favicon'] ) ? $cto['general_iphone_favicon']	: $default;
							break;
						case 'ipad_retina' :
							$default = isset( $cto['general_ipad_favicon_retina'] ) ? $cto['general_ipad_favicon_retina']	: $default;
							break;
						case 'ipad' :
							$default = isset( $cto['general_ipad_favicon'] ) ? $cto['general_ipad_favicon']	: $default;
							break;
						case 'custom_footer' :
							$default = isset( $cto['custom_body'] ) ? $cto['custom_body']	: $default;
							break;
						case 'comments' 	:
							$default = isset( $cto['general_comments_pages'] ) ? $cto['general_comments_pages'] : $default;
							break;
						default	:
							$default = isset( $cto[ $option['id'] ] ) ? $cto[ $option['id'] ] : $default;
					}

					set_theme_mod( $option['id'], $default );
				}
			}
		}
	}

	/** Live Customizer */
	function live_preview(){
		wp_enqueue_script(
			  'curly-live-customizer',
			  get_template_directory_uri().'/framework/customizer/js/live-customizer.js',
			  array( 'jquery','customize-preview' ),
			  rand(1, 46756856),
			  true
		);
	}

	/** Add Scripts */
	public function scripts_styles() {
		wp_enqueue_style(
			'curly-customizer',
			get_template_directory_uri() . '/framework/customizer/css/customizer.css',
			null,
			rand(),
			'all'
		);
		wp_enqueue_script( 'wp-color-picker' );/*
	    wp_enqueue_script(
	    	'color-picker',
	    	get_template_directory_uri() . '/framework/customizer/js/wp-color-picker-alpha.js' ,
	    	array( 'wp-color-picker' ),
	    	'1.0.0',
	    	true
	    );*/
		wp_enqueue_script(
			'curly-customizer',
			get_template_directory_uri() . '/framework/customizer/js/customizer.js',
			array( 'jquery', 'customize-controls' ),
			false,
			true
		);
	}

	public function customizer( $wp_customize ) {
		$this->construct_customizer( $wp_customize );
	}

	public function construct_customizer( $wp_customize ) {

		$options = apply_filters( 'leisure_theme_mods', array() );

		// Add Each Section
		foreach ( $options as $option ) {

			/** Build the Settings Array */
			$settings = array();
			$settings_args = array();

			/** Set Setting Type */
			$settings_args['type'] = 'theme_mod';

			/** Set title */
			if( isset( $option[ 'label' ] ) ){
				$settings[ 'title' ] = $option[ 'label' ];
				$settings[ 'label' ] = $option[ 'label' ];
			}

			/** Set panel */
			if( isset( $option[ 'panel' ] ) ){
				$settings[ 'panel' ] = $option[ 'panel' ];
			}

			/** Set section */
			if( isset( $option[ 'section' ] ) ){
				$settings[ 'section' ] = $option[ 'section' ];
			}

			/** Set type */
			if( isset( $option[ 'type'] ) ){
				$settings[ 'type' ] = $option[ 'type' ];
			}

			/** Set settings */
			if( isset( $option[ 'id' ] ) ){
				$settings[ 'settings' ] = $option[ 'id' ];
				$settings[ 'id' ] = $option[ 'id' ];
			}

			/** Set default */
			if( isset( $option[ 'default' ] ) ) {
				$settings_args[ 'default' ] = $option[ 'default' ];
			}

			/** Set choices */
			if( isset( $option[ 'choices' ] ) ) {
				$settings[ 'choices' ] = $option[ 'choices' ];
			}

			/** Set transport */
			if( isset( $option[ 'transport' ] ) ) {
				$settings_args[ 'transport' ] = $option[ 'transport' ];
			} else{
				$settings_args[ 'transport' ] = 'postMessage';
			}

			/** Set callback */
			if( isset( $option[ 'cb' ] ) ) {
				$settings_args[ 'sanitize_callback' ] = $option[ 'cb' ];
			} else{
				switch( $option['type'] ){
					case 'image' :
						$settings_args[ 'sanitize_callback' ] = 'esc_url_raw';
						break;
					case 'color' :
						$settings_args[ 'sanitize_callback' ] = 'curly_sanitize_color_field';
						$settings_args[ 'sanitize_callback_js' ] = 'maybe_hash_hex_color';
						break;
					case 'text' :
						$settings_args[ 'sanitize_callback' ] = 'wp_kses_post';
						break;
					case 'textarea' :
						$settings_args[ 'sanitize_callback' ] = 'wp_kses_post';
						break;
					case 'select' :
						$settings_args[ 'sanitize_callback' ] = 'curly_sanitize_dropdown_field';
						break;
					case 'range' :
						$settings_args[ 'sanitize_callback' ] = 'is_numeric';
						break;
					case 'number' :
						$settings_args[ 'sanitize_callback' ] = 'is_numeric';
						break;
					case 'checkbox' :
						$settings_args[ 'sanitize_callback' ] = 'curly_sanitize_checkbox_field';
						break;
					default :
						$settings_args[ 'sanitize_callback' ] = 'esc_html';
				}
			}

			/** Set callback_js */
			if( isset( $option[ 'cb_js' ] ) ) {
				$settings_args[ 'sanitize_callback_js' ] = $option[ 'cb_js' ];
			}

			/** Set active_callback */
			if( isset( $option[ 'active_cb' ] ) ) {
				$settings[ 'active_callback' ] = $option[ 'active_cb' ];
			}

			/** Set priority */
			if( isset( $option[ 'priority' ] ) ) {
				$settings[ 'priority' ] = $option[ 'priority' ];
			} else{
				$settings[ 'priority' ] = 10;
			}

			/** Set description */
			if( isset( $option[ 'desc' ] ) ) {
				$settings[ 'description' ] = $option[ 'desc' ];
			}

			/** Set input_attrs */
			if( isset( $option['input_attr'] ) ) {
				$settings[ 'input_attrs' ] = array(
					'min' => $option['input_attr']['min'],
					'max' => $option['input_attr']['max'],
					'step' => $option['input_attr']['step'],
					'prefix' => isset( $option['input_attr']['prefix'] ) ? $option['input_attr']['prefix'].' ' : null,
					'suffix' => isset( $option['input_attr']['suffix'] ) ? ' '.$option['input_attr']['suffix'] : null
				);
			}

			/** Add Control Settings */
			$blacklist = array( 'remove', 'section', 'panel', 'update_section', 'update_panel' );
			if ( ! in_array( $option['type'], $blacklist ) ) {
				//$settings_args
				$wp_customize->add_setting( $option['id'], array(
					'default' 				=> isset( $settings_args['default'] ) ? $settings_args['default'] : null,
					'sanitize_callback' 	=> $settings_args['sanitize_callback'],
					'type'					=> $settings_args['type'],
					'transport'				=> $settings_args['transport'],
					'sanitize_js_callback'	=> isset( $settings_args['sanitize_js_callback'] ) ? $settings_args['sanitize_js_callback'] : null
				 ) );
			}

			/** Remove Default Settings */
			if ( $option['type'] == 'remove' ) {
				$wp_customize->remove_control( $option['id'] );
			}

			/** Update Section */
			elseif ( $option['type'] == 'update_section' ) {

				/** Change the title */
				if ( isset( $option['title'] ) ) {
					$wp_customize->get_section( $option['id'] )->title = $option['title'];
				}

				/** Change the panel */
				if ( isset( $option['panel'] ) ) {
					$wp_customize->get_section( $option['id'] )->panel = $option['panel'];
				}


			}

			/** Update Default Settings */
			elseif ( $option['type'] == 'update' ) {

				/** Update Transport */
				if ( isset( $option['transport'] ) ) {
					$wp_customize->get_setting( $option['id'] )->transport = $option['transport'];
				}

				/** Update Default */
				if ( isset( $option['default'] ) ) {
					$wp_customize->get_setting( $option['id'] )->default = $option['default'];
				}
			}

			elseif ( $option['type'] == 'panel' ) {
				$wp_customize->add_panel( $option['id'], $settings );
			}

			// Generate Sections
			elseif ( $option['type'] == 'section' ) {
				$wp_customize->add_section( $option['id'] , $settings );

			}

			/** Generate Sliders */
			elseif( $option['type'] == 'slider' ) {
				$wp_customize->add_control(
					new Leisure_Slider_Control( $wp_customize, $option['id'], $settings )
				);
			}

			/** Generate Sliders */
			elseif( $option['type'] == 'alpha-color' ) {
				$wp_customize->add_control(
					new Leisure_Alpha_Color_Control( $wp_customize, $option['id'], $settings )
				);
			}

			/** Generate Sidebars */
			elseif( $option['type'] == 'sidebar' ) {
				$wp_customize->add_control(
					new Curly_Sidebar_Control( $wp_customize, $option['id'], $settings )
				);
			}

			// Generate Text & Checkbox Fields
			elseif ( $option['type'] == 'text' || $option['type'] == 'checkbox' || $option['type'] == 'number' || $option['type'] == 'range' || $option['type'] == 'textarea' ) {
				$wp_customize->add_control(
					new WP_Customize_Control( $wp_customize, $option['id'], $settings )
				);
			}

			// Generate Select & Radio Fields
			elseif ( $option['type'] == 'select' || $option['type'] == 'radio' ) {
				$wp_customize->add_control(
					new WP_Customize_Control( $wp_customize, $option['id'], $settings )
				);
			}

			// Generate Color Fields
			elseif ( $option['type'] == 'color' ) {
				$wp_customize->add_control(
					new WP_Customize_Color_Control( $wp_customize, $option['id'], $settings )
				);
			}

			// Generate Upload Fields
			elseif ( $option['type'] == 'upload' ) {
				$wp_customize->add_control(
					new WP_Customize_Upload_Control( $wp_customize, $option['id'], $settings )
				);
			}

			// Generate Image Fields
			elseif ( $option['type'] == 'image' ) {
				$wp_customize->add_control(
					new WP_Customize_Image_Control( $wp_customize, $option['id'], $settings )
				);
			}

			// Generate Typo Fields
			elseif ( $option['type'] == 'background' ) {
				$wp_customize->add_control(
					new WP_Customize_Background_Image_Control( $wp_customize, $option['id'], $settings )
				);
			}
		}
	}
}

/** Sanitize Color */
function curly_sanitize_color_field( $color ) {
	if( $color === 'transparent' ){
		return esc_html( $color );
	}

	elseif( substr( trim( $color ), 0, 4 ) === 'rgb(' ){
		return esc_html( $color );
	}

	elseif( substr( trim( $color ), 0, 4 ) === 'rgba' ){
		return esc_html( $color );
	}

	elseif( strlen( trim( $color ) ) === 6 ){
		return esc_html( $color );
	}

	elseif( substr( trim( $color ), 0, 1 ) === '#' ){
		return esc_html( $color );
	}

	else {
		return esc_html( $color );
	}
}

/** Sanitize Code */
function curly_sanitize_code_field( $input ) {
	return $input;
}

/** Sanitize Dropdown */
function curly_sanitize_dropdown_field( $input ) {
	if( is_numeric( $input ) ) {
        return intval( $input );
    } elseif( is_string( $input ) ){
	    return esc_html( $input );
    }
}

/** Sanitize Checkbox */
function curly_sanitize_checkbox_field( $input ) {
	return is_bool( $input ) ? $input : null;
}

?>
