<?php

add_filter( 'leisure_theme_mods', 'leisure_default_theme_mods' );

function leisure_default_theme_mods( $options ){

	/** Font Styles */
	$font_styles = array(
		0 => __( 'Light', 'leisure' ),
		1 => __( 'Light Italic', 'leisure' ),
		2 => __( 'Normal', 'leisure' ),
		4 => __( 'Italic', 'leisure' ),
		3 => __( 'Bold', 'leisure' ),
		5 => __( 'Bold Italic', 'leisure' )
	);

	/** Font Variants */
	$font_variants = array(
		0 => __( 'Normal', 'leisure' ),
		1 => __( 'Capitalize', 'leisure' ),
		2 => __( 'Uppercase', 'leisure' ),
		3 => __( 'Small Caps', 'leisure' )
	);

	/** Google Fonts Array */
	$font_list = array();
	if ( ! isset( $_SESSION['curly_google_font_list'] ) ) {
		$_SESSION['curly_google_font_list'] = json_decode( get_option( THEMEPREFIX.'_google_font_list' ) , true );
	}
	foreach ( $_SESSION['curly_google_font_list']['items'] as $key => $font ) {
		$font_list[ $font['family'] ] = $font['family'];
	}

	/** Slider Revolution Array */
	if( function_exists( 'set_revslider_as_theme' ) ){
		global $wpdb;
		$sliders = $wpdb->get_results('SELECT * FROM '.$wpdb->prefix.'revslider_sliders');
		$revsliders[0] = __( '- Select Revolution Slider -', 'leisure' );
		if( $sliders ) {
			foreach( $sliders as $value ) {
				$revsliders[$value->alias] = $value->title;
			}
		}
	} else {
		$revsliders = array(0);
	}

	/* !Remove Sections & Controls */
	$options[] = array(
		'type'		=> 'remove',
		'id'		=> 'display_header_text'
	);
	$options[] = array(
		'type'		=> 'remove',
		'id'		=> 'header_textcolor'
	);
	$options[] = array(
		'type'		=> 'remove',
		'id'		=> 'background_color'
	);
	$options[] = array(
		'type'		=> 'remove',
		'id'		=> 'blogdescription'
	);


	/* !Header Panel */
	$options[] = array(
		'label'    	=> __( 'Header', 'leisure' ),
		'type'		=> 'panel',
		'id'   		=> 'header_panel',
		'desc'		=> __( 'In this section you can customize the website header using the following options:', 'leisure' ),
		'priority'	=> 10
	);
	$options[] = array(
		'label'    	=> __( 'Tagline', 'leisure' ),
		'type'		=> 'text',
		'id'   		=> 'tagline_left',
		'default'	=> get_bloginfo( 'description' ),
		'section'	=> 'title_tagline',
		'transport' => 'refresh'
	);
	$options[] = array(
		'label'    	=> __( 'Right Tagline', 'leisure' ),
		'type'		=> 'text',
		'id'   		=> 'tagline',
		'section'	=> 'title_tagline',
		'transport' => 'refresh'
	);
	$options[] = array(
		'label'    	=> __( 'Disable WPML Language Selector', 'leisure' ),
		'type'		=> 'checkbox',
		'section'   => 'title_tagline',
		'id' 		=> 'wpml',
		'active_cb'	=> 'curly_cb_wpml'
	);




	/* !Logo */
	$options[] = array(
		'label'    	=> __('Site Logo','leisure'),
		'type'		=> 'section',
		'id'   		=> 'logo_section',
		'panel'		=> 'header_panel',
		'priority'	=> 20
	);
	$options[] = array(
		'label'    	=> __( 'Logo', 'leisure' ),
		'type'		=> 'image',
		'section'   => 'logo_section',
		'id' 		=> 'logo',
		'transport' => 'refresh'
	);
	$options[] = array(
		'label'    	=> __( 'Retina Logo (@2x)', 'leisure' ),
		'type'		=> 'image',
		'section'   => 'logo_section',
		'id' 		=> 'logo_retina',
		'transport' => 'refresh'
	);
	$options[] = array(
		'label'    	=> __( 'Small Devices Logo', 'leisure' ),
		'type'		=> 'image',
		'section'   => 'logo_section',
		'id' 		=> 'logo_xs',
		'transport' => 'refresh'
	);
	$options[] = array(
		'label'    	=> __( 'Small Devices Retina Logo (@2x)', 'leisure' ),
		'type'		=> 'image',
		'section'   => 'logo_section',
		'id' 		=> 'logo_retina_xs',
		'transport' => 'refresh'
	);
	$options[] = array(
		'label'    	=> __( 'Sticky Logo', 'leisure' ),
		'type'		=> 'image',
		'section'   => 'logo_section',
		'id' 		=> 'logo_sticky',
		'transport' => 'refresh',
		'active_cb' => 'curly_cb_sticky'
	);
	$options[] = array(
		'label'    	=> __( 'Sticky Retina Logo (@2x)', 'leisure' ),
		'type'		=> 'image',
		'section'   => 'logo_section',
		'id' 		=> 'logo_retina_sticky',
		'transport' => 'refresh',
		'active_cb' => 'curly_cb_sticky'
	);

	/** Header Slider Section */
	$options[] = array(
		'label'    	=> __( 'Header Slider', 'leisure' ),
		'type'		=> 'section',
		'id'   		=> 'header_slider_section',
		'panel'		=> 'header_panel',
		'desc' 		=> __( 'When adding a header slider, you have to bear in mind that the header height will increase to match the height of the slider. Minimum slider height should be 370px; also please note that this a global setting.', 'leisure' ),
		'priority'	=> 50,
		'transport' => 'refresh'
	);
	$options[] = array(
		'label'    	=> __( 'Header Slider', 'leisure' ),
		'type'		=> 'select',
		'section'   => 'header_slider_section',
		'id' 		=> 'header_slider',
		'choices'  	=> $revsliders,
		'active_cb' => 'curly_cb_rev'
	);


	/* !General Panel */
	$options[] = array(
		'label'    	=> __( 'Developer Tools', 'leisure' ),
		'type'		=> 'panel',
		'id'   		=> 'panel_dev',
		'priority'	=> 80,
		'desc'		=> __( 'In the General section you can configure general options that apply to all pages such as:', 'leisure' )
	);
	$options[] = array(
		'label'    	=> __('General Options','leisure'),
		'type'		=> 'section',
		'id'   		=> 'general_section',
		'panel'		=> 'panel_dev'
	);
	$options[] = array(
		'label'    	=> __( 'Disable Theme Animations', 'leisure' ),
		'type'		=> 'checkbox',
		'section'   => 'general_section',
		'id' 		=> 'animations'
	);
	$options[] = array(
		'label'    	=> __( 'Hide Comments For Pages', 'leisure' ),
		'type'		=> 'checkbox',
		'section'   => 'general_section',
		'id' 		=> 'comments',
		'default'	=> true
	);
	$options[] = array(
		'label'    	=> __( 'Hide Author Box', 'leisure' ),
		'type'		=> 'checkbox',
		'section'   => 'general_section',
		'id' 		=> 'author',
		'default'	=> true
	);
	$options[] = array(
		'label'    	=> __( 'Hide Post Navigation', 'leisure' ),
		'type'		=> 'checkbox',
		'section'   => 'general_section',
		'id' 		=> 'post_navigation',
		'default'	=> false
	);

	/* !Typography Panel */
	$options[] = array(
		'label'    	=> __( 'Typography', 'leisure' ),
		'type'		=> 'panel',
		'id'   		=> 'typography_panel',
		'priority'	=> 30,
		'desc'		=> __( 'In this section you can customize the typography settings using the following options:', 'leisure' )
	);
	$options[] = array(
		'label'    	=> __('Font Pairings','leisure'),
		'type'		=> 'section',
		'id'   		=> 'schemes_fonts',
		'panel'		=> 'typography_panel',
		'desc'		=> __( 'Choosing a font pair will change all your existing typography settings', 'leisure' ),
		'priority'	=> 0
	);
	$options[] = array(
		'label'    	=> __( 'Font Pairs', 'leisure' ),
		'type'		=> 'radio',
		'section'   => 'schemes_fonts',
		'id' 		=> 'scheme_font',
		'default'	=> 0,
		'choices'	=> array(
			0	=> __( 'Resort Type', 'leisure' ),
			1	=> __( 'Hotel Type', 'leisure' )
		),
		'desc'	=> __( 'You have two available font pairs. Choose one as your default' , 'leisure' )
	);
	$options[] = array(
		'label'    	=> __('General Typography (all texts)','leisure'),
		'type'		=> 'section',
		'id'   		=> 'typography_section',
		'panel'		=> 'typography_panel'
	);
	$options[] = array(
		'label'    	=> __( 'Font Family', 'leisure' ),
		'type'		=> 'select',
		'section'   => 'typography_section',
		'id' 		=> 'font',
		'default'	=> 'Roboto',
		'choices'	=> $font_list,
		'transport' => 'refresh'
	);
	$options[] = array(
		'label'    	=> __( 'Font Style', 'leisure' ),
		'type'		=> 'select',
		'section'   => 'typography_section',
		'id' 		=> 'font_style',
		'default'	=> 0,
		'choices'	=> $font_styles,
		'transport' => 'refresh'
	);
	$options[] = array(
		'label'    	=> __( 'Font Variant', 'leisure' ),
		'type'		=> 'select',
		'section'   => 'typography_section',
		'id' 		=> 'font_variant',
		'default'	=> 0,
		'choices'	=> $font_variants,
		'transport' => 'refresh'
	);
	$options[] = array(
		'label'    	=> __( 'Font Size', 'leisure' ),
		'type'		=> 'slider',
		'section'   => 'typography_section',
		'id' 		=> 'font_size',
		'default'	=> 14,
		'input_attr'=> array( 'min' => 10, 'max' => 20, 'step' => 1, 'suffix' => 'px' ),
		'transport' => 'refresh'
	);
	$options[] = array(
		'label'    	=> __( 'Include Special Characters', 'leisure' ),
		'type'		=> 'radio',
		'section'   => 'typography_section',
		'id' 		=> 'subset',
		'default'	=> 0,
		'choices' 	=> array(
			0 => __( 'No Subset - Standard Latin', 'leisure' ),
			1 => __( 'Cyrillic Extended (cyrillic-ext)', 'leisure' ),
			2 => __( 'Greek Extended (greek-ext)', 'leisure' ),
			3 => __( 'Greek (greek)', 'leisure' ),
			4 => __( 'Vietnamese (vietnamese)', 'leisure' ),
			5 => __( 'Latin Extended (latin-ext)', 'leisure' ),
			6 => __( 'Cyrillic (cyrillic)', 'leisure' )
		),
		'transport' => 'refresh'
	);
	$options[] = array(
		'label'    	=> __('Main Menu','leisure'),
		'type'		=> 'section',
		'id'   		=> 'menu_section',
		'panel'		=> 'typography_panel'
	);
	$options[] = array(
		'label'    	=> __( 'Font Family', 'leisure' ),
		'type'		=> 'select',
		'section'   => 'menu_section',
		'id' 		=> 'font_menu',
		'default'	=> 'Roboto',
		'choices'	=> $font_list,
		'transport' => 'refresh'
	);
	$options[] = array(
		'label'    	=> __( 'Font Style', 'leisure' ),
		'type'		=> 'select',
		'section'   => 'menu_section',
		'id' 		=> 'font_menu_style',
		'default'	=> 2,
		'choices'	=> $font_styles,
		'transport' => 'refresh'
	);
	$options[] = array(
		'label'    	=> __( 'Font Variant', 'leisure' ),
		'type'		=> 'select',
		'section'   => 'menu_section',
		'id' 		=> 'font_menu_variant',
		'default'	=> 2,
		'choices'	=> $font_variants,
		'transport' => 'refresh'
	);
	$options[] = array(
		'label'    	=> __( 'Font Size', 'leisure' ),
		'type'		=> 'slider',
		'section'   => 'menu_section',
		'id' 		=> 'font_menu_size',
		'default'	=> 14,
		'input_attr'=> array( 'min' => 12, 'max' => 18, 'step' => 1, 'suffix' => 'px' ),
		'transport' => 'refresh'
	);
	$options[] = array(
		'label'    	=> __('Secondary Menu','leisure'),
		'type'		=> 'section',
		'id'   		=> 'secondary_menu_section',
		'panel'		=> 'typography_panel'
	);
	$options[] = array(
		'label'    	=> __( 'Font Family', 'leisure' ),
		'type'		=> 'select',
		'section'   => 'secondary_menu_section',
		'id' 		=> 'font_secondary_menu',
		'default'	=> 'Roboto',
		'choices'	=> $font_list,
		'transport' => 'refresh'
	);
	$options[] = array(
		'label'    	=> __( 'Font Style', 'leisure' ),
		'type'		=> 'select',
		'section'   => 'secondary_menu_section',
		'id' 		=> 'font_secondary_menu_style',
		'default'	=> 2,
		'choices'	=> $font_styles,
		'transport' => 'refresh'
	);
	$options[] = array(
		'label'    	=> __( 'Font Variant', 'leisure' ),
		'type'		=> 'select',
		'section'   => 'secondary_menu_section',
		'id' 		=> 'font_secondary_menu_variant',
		'default'	=> 2,
		'choices'	=> $font_variants,
		'transport' => 'refresh'
	);
	$options[] = array(
		'label'    	=> __( 'Font Size', 'leisure' ),
		'type'		=> 'slider',
		'section'   => 'secondary_menu_section',
		'id' 		=> 'font_secondary_menu_size',
		'default'	=> 14,
		'input_attr'=> array( 'min' => 12, 'max' => 18, 'step' => 1, 'suffix' => 'px' ),
		'transport' => 'refresh'
	);
	$options[] = array(
		'label'    	=> __('H1 Heading','leisure'),
		'type'		=> 'section',
		'id'   		=> 'h1_section',
		'panel'		=> 'typography_panel'
	);
	$options[] = array(
		'label'    	=> __( 'Font Family', 'leisure' ),
		'type'		=> 'select',
		'section'   => 'h1_section',
		'id' 		=> 'font_h1',
		'default'	=> 'Domine',
		'choices'	=> $font_list,
		'transport' => 'refresh'
	);
	$options[] = array(
		'label'    	=> __( 'Font Style', 'leisure' ),
		'type'		=> 'select',
		'section'   => 'h1_section',
		'id' 		=> 'font_h1_style',
		'default'	=> 2,
		'choices'	=> $font_styles,
		'transport' => 'refresh'
	);
	$options[] = array(
		'label'    	=> __( 'Font Variant', 'leisure' ),
		'type'		=> 'select',
		'section'   => 'h1_section',
		'id' 		=> 'font_h1_variant',
		'default'	=> 0,
		'choices'	=> $font_variants,
		'transport' => 'refresh'
	);
	$options[] = array(
		'label'    	=> __( 'Font Size', 'leisure' ),
		'type'		=> 'slider',
		'section'   => 'h1_section',
		'id' 		=> 'font_h1_size',
		'default'	=> 36,
		'input_attr'=> array( 'min' => 30, 'max' => 72, 'step' => 1, 'suffix' => 'px' ),
		'transport' => 'refresh'
	);
	$options[] = array(
		'label'    	=> __('H2 Heading','leisure'),
		'type'		=> 'section',
		'id'   		=> 'h2_section',
		'panel'		=> 'typography_panel'
	);
	$options[] = array(
		'label'    	=> __( 'Font Family', 'leisure' ),
		'type'		=> 'select',
		'section'   => 'h2_section',
		'id' 		=> 'font_h2',
		'default'	=> 'Domine',
		'choices'	=> $font_list,
		'transport' => 'refresh'
	);
	$options[] = array(
		'label'    	=> __( 'Font Style', 'leisure' ),
		'type'		=> 'select',
		'section'   => 'h2_section',
		'id' 		=> 'font_h2_style',
		'default'	=> 2,
		'choices'	=> $font_styles,
		'transport' => 'refresh'
	);
	$options[] = array(
		'label'    	=> __( 'Font Variant', 'leisure' ),
		'type'		=> 'select',
		'section'   => 'h2_section',
		'id' 		=> 'font_h2_variant',
		'default'	=> 0,
		'choices'	=> $font_variants,
		'transport' => 'refresh'
	);
	$options[] = array(
		'label'    	=> __( 'Font Size', 'leisure' ),
		'type'		=> 'slider',
		'section'   => 'h2_section',
		'id' 		=> 'font_h2_size',
		'default'	=> 30,
		'input_attr'=> array( 'min' => 20, 'max' => 68, 'step' => 1, 'suffix' => 'px' ),
		'transport' => 'refresh'
	);
	$options[] = array(
		'label'    	=> __('H3 Heading','leisure'),
		'type'		=> 'section',
		'id'   		=> 'h3_section',
		'panel'		=> 'typography_panel'
	);
	$options[] = array(
		'label'    	=> __( 'Font Family', 'leisure' ),
		'type'		=> 'select',
		'section'   => 'h3_section',
		'id' 		=> 'font_h3',
		'default'	=> 'Domine',
		'choices'	=> $font_list,
		'transport' => 'refresh'
	);
	$options[] = array(
		'label'    	=> __( 'Font Style', 'leisure' ),
		'type'		=> 'select',
		'section'   => 'h3_section',
		'id' 		=> 'font_h3_style',
		'default'	=> 2,
		'choices'	=> $font_styles,
		'transport' => 'refresh'
	);
	$options[] = array(
		'label'    	=> __( 'Font Variant', 'leisure' ),
		'type'		=> 'select',
		'section'   => 'h3_section',
		'id' 		=> 'font_h3_variant',
		'default'	=> 0,
		'choices'	=> $font_variants,
		'transport' => 'refresh'
	);
	$options[] = array(
		'label'    	=> __( 'Font Size', 'leisure' ),
		'type'		=> 'slider',
		'section'   => 'h3_section',
		'id' 		=> 'font_h3_size',
		'default'	=> 24,
		'input_attr'=> array( 'min' => 15, 'max' => 48, 'step' => 1, 'suffix' => 'px' ),
		'transport' => 'refresh'
	);
	$options[] = array(
		'label'    	=> __('H4 Heading','leisure'),
		'type'		=> 'section',
		'id'   		=> 'h4_section',
		'panel'		=> 'typography_panel'
	);
	$options[] = array(
		'label'    	=> __( 'Font Family', 'leisure' ),
		'type'		=> 'select',
		'section'   => 'h4_section',
		'id' 		=> 'font_h4',
		'default'	=> 'Domine',
		'choices'	=> $font_list,
		'transport' => 'refresh'
	);
	$options[] = array(
		'label'    	=> __( 'Font Style', 'leisure' ),
		'type'		=> 'select',
		'section'   => 'h4_section',
		'id' 		=> 'font_h4_style',
		'default'	=> 2,
		'choices'	=> $font_styles,
		'transport' => 'refresh'
	);
	$options[] = array(
		'label'    	=> __( 'Font Variant', 'leisure' ),
		'type'		=> 'select',
		'section'   => 'h4_section',
		'id' 		=> 'font_h4_variant',
		'default'	=> 0,
		'choices'	=> $font_variants,
		'transport' => 'refresh'
	);
	$options[] = array(
		'label'    	=> __( 'Font Size', 'leisure' ),
		'type'		=> 'slider',
		'section'   => 'h4_section',
		'id' 		=> 'font_h4_size',
		'default'	=> 18,
		'input_attr'=> array( 'min' => 14, 'max' => 32, 'step' => 1, 'suffix' => 'px' ),
		'transport' => 'refresh'
	);
	$options[] = array(
		'label'    	=> __('H5 Heading','leisure'),
		'type'		=> 'section',
		'id'   		=> 'h5_section',
		'panel'		=> 'typography_panel'
	);
	$options[] = array(
		'label'    	=> __( 'Font Family', 'leisure' ),
		'type'		=> 'select',
		'section'   => 'h5_section',
		'id' 		=> 'font_h5',
		'default'	=> 'Domine',
		'choices'	=> $font_list,
		'transport' => 'refresh'
	);
	$options[] = array(
		'label'    	=> __( 'Font Style', 'leisure' ),
		'type'		=> 'select',
		'section'   => 'h5_section',
		'id' 		=> 'font_h5_style',
		'default'	=> 2,
		'choices'	=> $font_styles,
		'transport' => 'refresh'
	);
	$options[] = array(
		'label'    	=> __( 'Font Variant', 'leisure' ),
		'type'		=> 'select',
		'section'   => 'h5_section',
		'id' 		=> 'font_h5_variant',
		'default'	=> 0,
		'choices'	=> $font_variants,
		'transport' => 'refresh'
	);
	$options[] = array(
		'label'    	=> __( 'Font Size', 'leisure' ),
		'type'		=> 'slider',
		'section'   => 'h5_section',
		'id' 		=> 'font_h5_size',
		'default'	=> 16,
		'input_attr'=> array( 'min' => 14, 'max' => 32, 'step' => 1, 'suffix' => 'px' ),
		'transport' => 'refresh'
	);
	$options[] = array(
		'label'    	=> __('H6 Heading','leisure'),
		'type'		=> 'section',
		'id'   		=> 'h6_section',
		'panel'		=> 'typography_panel'
	);
	$options[] = array(
		'label'    	=> __( 'Font Family', 'leisure' ),
		'type'		=> 'select',
		'section'   => 'h6_section',
		'id' 		=> 'font_h6',
		'default'	=> 'Domine',
		'choices'	=> $font_list,
		'transport' => 'refresh'
	);
	$options[] = array(
		'label'    	=> __( 'Font Style', 'leisure' ),
		'type'		=> 'select',
		'section'   => 'h6_section',
		'id' 		=> 'font_h6_style',
		'default'	=> 2,
		'choices'	=> $font_styles,
		'transport' => 'refresh'
	);
	$options[] = array(
		'label'    	=> __( 'Font Variant', 'leisure' ),
		'type'		=> 'select',
		'section'   => 'h6_section',
		'id' 		=> 'font_h6_variant',
		'default'	=> 0,
		'choices'	=> $font_variants,
		'transport' => 'refresh'
	);
	$options[] = array(
		'label'    	=> __( 'Font Size', 'leisure' ),
		'type'		=> 'slider',
		'section'   => 'h6_section',
		'id' 		=> 'font_h6_size',
		'default'	=> 14,
		'input_attr'=> array( 'min' => 14, 'max' => 32, 'step' => 1, 'suffix' => 'px' ),
		'transport' => 'refresh'
	);
	$options[] = array(
		'label'    	=> __('Blockquote','leisure'),
		'type'		=> 'section',
		'id'   		=> 'blockquote_section',
		'panel'		=> 'typography_panel'
	);
	$options[] = array(
		'label'    	=> __( 'Font Family', 'leisure' ),
		'type'		=> 'select',
		'section'   => 'blockquote_section',
		'id' 		=> 'font_blockquote',
		'default'	=> 'Domine',
		'choices'	=> $font_list,
		'transport' => 'refresh'
	);
	$options[] = array(
		'label'    	=> __( 'Font Style', 'leisure' ),
		'type'		=> 'select',
		'section'   => 'blockquote_section',
		'id' 		=> 'font_blockquote_style',
		'default'	=> 2,
		'choices'	=> $font_styles,
		'transport' => 'refresh'
	);
	$options[] = array(
		'label'    	=> __( 'Font Variant', 'leisure' ),
		'type'		=> 'select',
		'section'   => 'blockquote_section',
		'id' 		=> 'font_blockquote_variant',
		'default'	=> 0,
		'choices'	=> $font_variants,
		'transport' => 'refresh'
	);
	$options[] = array(
		'label'    	=> __( 'Font Size', 'leisure' ),
		'type'		=> 'slider',
		'section'   => 'blockquote_section',
		'id' 		=> 'font_blockquote_size',
		'default'	=> 18,
		'input_attr'=> array( 'min' => 14, 'max' => 32, 'step' => 1, 'suffix' => 'px' ),
		'transport' => 'refresh'
	);



	/* !Colors Panel */
	$options[] = array(
		'label'    	=> __( 'Colors', 'leisure' ),
		'type'		=> 'panel',
		'id'   		=> 'colors_panel',
		'priority'	=> 20,
		'desc'		=> __( 'In this section you can customize the typography settings using the following options:', 'leisure' )
	);
	$options[] = array(
		'label'    	=> __('Color Schemes','leisure'),
		'type'		=> 'section',
		'id'   		=> 'schemes_colors',
		'panel'		=> 'colors_panel',
		'desc'		=> __( 'Choosing a color scheme will change all your existing color settings', 'leisure' ),
		'priority'	=> 0
	);
	$options[] = array(
		'label'    	=> __( 'Color Scheme', 'leisure' ),
		'type'		=> 'radio',
		'section'   => 'schemes_colors',
		'id' 		=> 'scheme_color',
		'default'	=> 0,
		'choices'	=> array(
			0	=> __( 'Resort White Mode', 'leisure' ),
			1	=> __( 'Hotel Dark Mode', 'leisure' )
		),
		'desc'	=> __( 'You have two available color schemes. Choose one as your default' , 'leisure' )
	);
	$options[] = array(
		'label'    	=> __( 'Background Color', 'leisure' ),
		'type'		=> 'alpha-color',
		'section'   => 'colors',
		'id' 		=> 'background_color_body',
		'default'	=> '#FFFFFF'
	);
	$options[] = array(
		'label'    	=> __( 'Boxed Background Color', 'leisure' ),
		'type'		=> 'alpha-color',
		'section'   => 'colors',
		'id' 		=> 'background_color_box',
		'default'	=> '#ffffff',
		'active_cb'	=> 'curly_cb_boxed'
	);
	$options[] = array(
		'label'    	=> __( 'Text Color', 'leisure' ),
		'type'		=> 'alpha-color',
		'section'   => 'colors',
		'id' 		=> 'text_color',
		'default'	=> '#667279'
	);
	$options[] = array(
		'label'    	=> __( 'Link Color', 'leisure' ),
		'type'		=> 'alpha-color',
		'section'   => 'colors',
		'id' 		=> 'link_color',
		'default'	=> '#363D40'
	);
	$options[] = array(
		'label'    	=> __( 'Primary Color', 'leisure' ),
		'type'		=> 'alpha-color',
		'section'   => 'colors',
		'id' 		=> 'primary_color',
		'default'	=> '#C0392B'
	);
	$options[] = array(
		'label'    	=> __( 'Add Content Shadow', 'leisure' ),
		'type'		=> 'checkbox',
		'section'   => 'colors',
		'id' 		=> 'shadow_content'
	);
	$options[] = array(
		'label'    	=> __('Header','leisure'),
		'type'		=> 'section',
		'id'   		=> 'header_colors',
		'panel'		=> 'colors_panel'
	);
	$options[] = array(
		'label'    	=> __( 'Navigation Color', 'leisure' ),
		'type'		=> 'alpha-color',
		'section'   => 'header_colors',
		'id' 		=> 'header_navigation',
		'default'	=> '#ffffff'
	);
	$options[] = array(
		'label'    	=> __( 'Navigation Link Color', 'leisure' ),
		'type'		=> 'alpha-color',
		'section'   => 'header_colors',
		'id' 		=> 'header_navigation_text',
		'default'	=> null
	);
	$options[] = array(
		'label'    	=> __( 'Navigation Special Color', 'leisure' ),
		'type'		=> 'alpha-color',
		'section'   => 'header_colors',
		'id' 		=> 'header_navigation_special',
		'default'	=> null
	);
	$options[] = array(
		'label'    	=> __( 'Header Texts Color', 'leisure' ),
		'type'		=> 'alpha-color',
		'section'   => 'header_colors',
		'id' 		=> 'header_text_color',
		'default'	=> '#ffffff'
	);
	$options[] = array(
		'label'    	=> __( 'Shading Color', 'leisure' ),
		'type'		=> 'alpha-color',
		'section'   => 'header_colors',
		'id' 		=> 'header_shading_color',
		'default'	=> 'rgba(0, 0, 0, 0.15)'
	);
	$options[] = array(
		'label'    	=> __( 'Add Header Shadow', 'leisure' ),
		'type'		=> 'checkbox',
		'section'   => 'header_colors',
		'id' 		=> 'shadow_header'
	);
	$options[] = array(
		'label'    	=> __('Footer','leisure'),
		'type'		=> 'section',
		'id'   		=> 'footer_colors',
		'panel'		=> 'colors_panel'
	);
	$options[] = array(
		'label'    	=> __( 'Background', 'leisure' ),
		'type'		=> 'alpha-color',
		'section'   => 'footer_colors',
		'id' 		=> 'footer_color_bg',
		'default'	=> '#F0F1F2'
	);
	$options[] = array(
		'label'    	=> __( 'Text', 'leisure' ),
		'type'		=> 'alpha-color',
		'section'   => 'footer_colors',
		'id' 		=> 'footer_color_text',
		'default'	=> '#667279'
	);
	$options[] = array(
		'label'    	=> __( 'Links', 'leisure' ),
		'type'		=> 'alpha-color',
		'section'   => 'footer_colors',
		'id' 		=> 'footer_color_links',
		'default'	=> '#667279'
	);
	$options[] = array(
		'label'    	=> __( 'Titles', 'leisure' ),
		'type'		=> 'alpha-color',
		'section'   => 'footer_colors',
		'id' 		=> 'footer_color_titles',
		'default'	=> '#363D40'
	);
	$options[] = array(
		'label'    	=> __('Others','leisure'),
		'type'		=> 'section',
		'id'   		=> 'heading_colors',
		'panel'		=> 'colors_panel'
	);
	$options[] = array(
		'label'    	=> __( 'H1 Heading', 'leisure' ),
		'type'		=> 'alpha-color',
		'section'   => 'heading_colors',
		'id' 		=> 'color_h1',
		'default'	=> '#363d40'
	);
	$options[] = array(
		'label'    	=> __( 'H2 Heading', 'leisure' ),
		'type'		=> 'alpha-color',
		'section'   => 'heading_colors',
		'id' 		=> 'color_h2',
		'default'	=> '#363d40'
	);
	$options[] = array(
		'label'    	=> __( 'H3 Heading', 'leisure' ),
		'type'		=> 'alpha-color',
		'section'   => 'heading_colors',
		'id' 		=> 'color_h3',
		'default'	=> '#363d40'
	);
	$options[] = array(
		'label'    	=> __( 'H4 Heading', 'leisure' ),
		'type'		=> 'alpha-color',
		'section'   => 'heading_colors',
		'id' 		=> 'color_h4',
		'default'	=> '#363d40'
	);
	$options[] = array(
		'label'    	=> __( 'H5 Heading', 'leisure' ),
		'type'		=> 'alpha-color',
		'section'   => 'heading_colors',
		'id' 		=> 'color_h5',
		'default'	=> '#C0392B'
	);
	$options[] = array(
		'label'    	=> __( 'H6 Heading', 'leisure' ),
		'type'		=> 'alpha-color',
		'section'   => 'heading_colors',
		'id' 		=> 'color_h6',
		'default'	=> '#363d40'
	);



	/* !Footer Section */
	$options[] = array(
		'label'    	=> __( 'Footer', 'leisure' ),
		'type'		=> 'section',
		'id'   		=> 'footer',
		'priority'	=> 20
	);
	$options[] = array(
		'label'    	=> __( 'Columns', 'leisure' ),
		'type'		=> 'select',
		'id'   		=> 'footer_columns',
		'section'	=> 'footer',
		'default'	=> 6,
		'choices'	=> array(
			1 => __( 'One Column', 'leisure' ),
			2 => __( 'Two Columns', 'leisure' ),
			3 => __( 'Three Columns', 'leisure' ),
			4 => __( 'Four Columns', 'leisure' ),
			6 => __( 'Six Columns', 'leisure' ),
		)
	);
	$options[] = array(
		'label'    	=> __( 'Copyright Text', 'leisure' ),
		'type'		=> 'textarea',
		'id'   		=> 'footer_copyright',
		'section'	=> 'footer',
		'default'	=> esc_html__( 'Leisure - Hotel, Resort & Spa Wordpress Theme. Designed with special care by Curly Themes. All Rights Reserved.<span class="pull-right">[icon icon=rss boxed=yes] [icon icon="fab fa-pinterest" boxed=yes] [icon icon="fab fa-facebook" boxed=yes] [icon icon="fab fa-twitter" boxed=yes]</span>', 'leisure' )
	);



	/* !Layout Section */
	$options[] = array(
		'label'    	=> __( 'Layout', 'leisure' ),
		'type'		=> 'panel',
		'id'   		=> 'layout_panel',
		'priority'	=> 40
	);
	$options[] = array(
		'label'    	=> __( 'General Layout', 'leisure' ),
		'type'		=> 'section',
		'panel'		=> 'layout_panel',
		'id'   		=> 'layout',
		'priority'	=> 40
	);
	$options[] = array(
		'label'    	=> __('Layout Mode','leisure'),
		'desc'		=> __( 'You have two layout modes available:', 'leisure' ),
		'type'		=> 'radio',
		'id'   		=> 'layout_style',
		'section'	=> 'layout',
		'transport' => 'refresh',
		'default'	=> 'full',
		'choices'	=> array(
			'boxed' => __( 'Boxed', 'leisure' ),
			'full' 	=> __( 'Full-width (default)', 'leisure' )
		)
	);
	$options[] = array(
		'label'    	=> __('Layout Style','leisure'),
		'desc'		=> __( 'You have four layout styles available:', 'leisure' ),
		'type'		=> 'radio',
		'id'   		=> 'layout_pref',
		'section'	=> 'layout',
		'transport' => 'refresh',
		'default'	=> 'wide',
		'choices'	=> array(
			'wide' 	=> __( 'Wide and Large Padding (default)', 'leisure' ),
			'narrow'=> __( 'Narrow and Small Padding', 'leisure' ),
			'full' 	=> __( 'Full-width and No Padding', 'leisure' ),
			'custom'=> __( 'Custom Layout Style', 'leisure' )
		)
	);
	$options[] = array(
		'label'    	=> __( 'Custom Layout Size', 'leisure' ),
		'type'		=> 'slider',
		'section'   => 'layout',
		'id' 		=> 'layout_2_size',
		'default'	=> 1440,
		'input_attr'=> array( 'min' => 600, 'max' => 1920, 'step' => 1, 'suffix' => 'px' ),
		'transport' => 'refresh',
		'active_cb'	=> 'curly_cb_layout_pref'
	);
	$options[] = array(
		'label'    	=> __( 'Custom Layout Padding', 'leisure' ),
		'type'		=> 'slider',
		'section'   => 'layout',
		'id' 		=> 'layout_2_padding',
		'default'	=> 135,
		'input_attr'=> array( 'min' => 0, 'max' => 500, 'step' => 1, 'suffix' => 'px' ),
		'transport' => 'refresh',
		'active_cb'	=> 'curly_cb_layout_pref_padding'
	);
	$options[] = array(
		'label'    	=> __( 'Header Layout', 'leisure' ),
		'type'		=> 'section',
		'panel'		=> 'layout_panel',
		'id'   		=> 'layout_header',
		'priority'	=> 40
	);
	$options[] = array(
		'label'    	=> __( 'Header Mode', 'leisure' ),
		'type'		=> 'radio',
		'section'   => 'layout_header',
		'id' 		=> 'layout_style_header',
		'transport' => 'refresh',
		'default'	=> 'stretch',
		'desc'		=> __( 'You have four header modes available:', 'leisure' ),
		'choices'	=> array(
			''		=> __( 'Same as General Layout Mode', 'leisure' ),
			'stretch'		=> __( 'Stretched (default)', 'leisure' ),
			'boxed'			=> __( 'Boxed', 'leisure' ),
			'full'			=> __( 'Full-width', 'leisure' ),
			'transparent'	=> __( 'Transparent', 'leisure' )
		)
	);
	$options[] = array(
		'label'    	=> __('Header Style','leisure'),
		'desc'		=> __( 'You have four header styles available:', 'leisure' ),
		'type'		=> 'radio',
		'id'   		=> 'layout_size_header',
		'section'	=> 'layout_header',
		'default'	=> '',
		'transport' => 'refresh',
		'choices'	=> array(
			''		=> __( 'Same as General Layout Style (default)', 'leisure' ),
			'wide' 	=> __( 'Wide and Large Padding ', 'leisure' ),
			'narrow'=> __( 'Narrow and Small Padding', 'leisure' ),
			'full' 	=> __( 'Full-width and No Padding', 'leisure' ),
			'custom'=> __( 'Custom Header Style', 'leisure' )
		)
	);
	$options[] = array(
		'label'    	=> __( 'Custom Header Size', 'leisure' ),
		'type'		=> 'slider',
		'section'   => 'layout_header',
		'id' 		=> 'layout_2_header_size',
		'default'	=> 1440,
		'input_attr'=> array( 'min' => 600, 'max' => 1920, 'step' => 10, 'suffix' => 'px' ),
		'transport' => 'refresh',
		'active_cb'	=> 'curly_cb_layout_header'
	);
	$options[] = array(
		'label'    	=> __( 'Custom Header Padding', 'leisure' ),
		'type'		=> 'slider',
		'section'   => 'layout_header',
		'id' 		=> 'layout_2_header_padding',
		'default'	=> 135,
		'input_attr'=> array( 'min' => 0, 'max' => 500, 'step' => 1, 'suffix' => 'px' ),
		'transport' => 'refresh',
		'active_cb'	=> 'curly_cb_layout_header_padding'
	);
	$options[] = array(
		'label'    	=> __( 'Content Layout', 'leisure' ),
		'type'		=> 'section',
		'panel'		=> 'layout_panel',
		'id'   		=> 'layout_content',
		'priority'	=> 40
	);
	$options[] = array(
		'label'    	=> __( 'Content Mode', 'leisure' ),
		'type'		=> 'radio',
		'section'   => 'layout_content',
		'id' 		=> 'layout_style_content',
		'transport' => 'refresh',
		'desc'		=> __( 'You have four content modes available:', 'leisure' ),
		'choices'	=> array(
			''		=> __( 'Same as General Layout Mode (default)', 'leisure' ),
			'boxed'	=> __( 'Boxed', 'leisure' ),
			'full'	=> __( 'Full-width', 'leisure' )
		)
	);
	$options[] = array(
		'label'    	=> __('Content Style','leisure'),
		'desc'		=> __( 'You have four content styles available:', 'leisure' ),
		'type'		=> 'radio',
		'id'   		=> 'layout_size_content',
		'section'	=> 'layout_content',
		'default'	=> '',
		'choices'	=> array(
			''		=> __( 'Same as General Layout Style (default)', 'leisure' ),
			'wide' 	=> __( 'Wide and Large Padding', 'leisure' ),
			'narrow'=> __( 'Narrow and Small Padding', 'leisure' ),
			'full' 	=> __( 'Full-width and No Padding', 'leisure' ),
			'custom'=> __( 'Custom Content Style', 'leisure' )
		)
	);
	$options[] = array(
		'label'    	=> __( 'Custom Content Size', 'leisure' ),
		'type'		=> 'slider',
		'section'   => 'layout_content',
		'id' 		=> 'layout_2_content_size',
		'default'	=> 1440,
		'input_attr'=> array( 'min' => 600, 'max' => 1920, 'step' => 10, 'suffix' => 'px' ),
		'transport' => 'refresh',
		'active_cb'	=> 'curly_cb_layout_content'
	);
	$options[] = array(
		'label'    	=> __( 'Custom Content Padding', 'leisure' ),
		'type'		=> 'slider',
		'section'   => 'layout_content',
		'id' 		=> 'layout_2_content_padding',
		'default'	=> 135,
		'input_attr'=> array( 'min' => 0, 'max' => 500, 'step' => 1, 'suffix' => 'px' ),
		'transport' => 'refresh',
		'active_cb'	=> 'curly_cb_layout_content_padding'
	);
	$options[] = array(
		'label'    	=> __( 'Footer Layout', 'leisure' ),
		'type'		=> 'section',
		'panel'		=> 'layout_panel',
		'id'   		=> 'layout_footer',
		'priority'	=> 40
	);
	$options[] = array(
		'label'    	=> __( 'Footer Mode', 'leisure' ),
		'type'		=> 'radio',
		'section'   => 'layout_footer',
		'id' 		=> 'layout_style_footer',
		'default'	=> 'stretch',
		'transport' => 'refresh',
		'desc'		=> __( 'You have four footer modes available:', 'leisure' ),
		'choices'	=> array(
			''		=> __( 'Same as General Layout Mode', 'leisure' ),
			'stretch'		=> __( 'Stretched (default)', 'leisure' ),
			'boxed'	=> __( 'Boxed', 'leisure' ),
			'full'	=> __( 'Full-width', 'leisure' )
		)
	);
	$options[] = array(
		'label'    	=> __('Footer Style','leisure'),
		'desc'		=> __( 'You have four footer styles available:', 'leisure' ),
		'type'		=> 'radio',
		'id'   		=> 'layout_size_footer',
		'section'	=> 'layout_footer',
		'transport' => 'refresh',
		'default'	=> '',
		'choices'	=> array(
			''		=> __( 'Same as General Layout Style (default)', 'leisure' ),
			'wide' 	=> __( 'Wide and Large Padding', 'leisure' ),
			'narrow'=> __( 'Narrow and Small Padding', 'leisure' ),
			'full' 	=> __( 'Full-width and No Padding', 'leisure' ),
			'custom'=> __( 'Custom Footer Style', 'leisure' )
		)
	);
	$options[] = array(
		'label'    	=> __( 'Custom Footer Size', 'leisure' ),
		'type'		=> 'slider',
		'section'   => 'layout_footer',
		'id' 		=> 'layout_2_footer_size',
		'default'	=> 1440,
		'input_attr'=> array( 'min' => 600, 'max' => 1920, 'step' => 1, 'suffix' => 'px' ),
		'transport' => 'refresh',
		'active_cb'	=> 'curly_cb_layout_footer'
	);
	$options[] = array(
		'label'    	=> __( 'Custom Footer Padding', 'leisure' ),
		'type'		=> 'slider',
		'section'   => 'layout_footer',
		'id' 		=> 'layout_2_footer_padding',
		'default'	=> 135,
		'input_attr'=> array( 'min' => 0, 'max' => 500, 'step' => 1, 'suffix' => 'px' ),
		'transport' => 'refresh',
		'active_cb'	=> 'curly_cb_layout_footer_padding'
	);



	/* !Rooms Section */
	$options[] = array(
		'label'    	=> __( 'Rooms Settings', 'leisure' ),
		'type'		=> 'section',
		'id'   		=> 'rooms_section',
		'priority'	=> 140
	);
	$options[] = array(
		'label'    	=> __( 'Rooms Listing Title', 'leisure' ),
		'type'		=> 'text',
		'section'   => 'rooms_section',
		'id' 		=> 'rooms_listing_title',
		'desc'		=> __( 'Enter the title for the rooms listing page', 'leisure' ),
		'default'	=> __( 'Rooms', 'leisure' )
	);
	$options[] = array(
		'label'    	=> __( 'Disable Room Reviews', 'leisure' ),
		'type'		=> 'checkbox',
		'section'   => 'rooms_section',
		'id' 		=> 'rooms',
		'desc'		=> __( 'Check this to hide the room reviews', 'leisure' ),
	);
	$options[] = array(
		'label'    	=> __( 'Rating Summary', 'leisure' ),
		'type'		=> 'text',
		'section'   => 'rooms_section',
		'id' 		=> 'rating_1',
		'desc'		=> __( 'Example: Comfort', 'leisure' ),
		'default'	=> __( 'Comfort', 'leisure' ),
		'active_cb'	=> 'curly_cb_ratings'
	);
	$options[] = array(
		'label'    	=> __( 'Rating Summary', 'leisure' ),
		'type'		=> 'text',
		'section'   => 'rooms_section',
		'id' 		=> 'rating_2',
		'desc'		=> __( 'Example: Position', 'leisure' ),
		'default'	=> __( 'Position', 'leisure' ),
		'active_cb'	=> 'curly_cb_ratings'
	);
	$options[] = array(
		'label'    	=> __( 'Rating Summary', 'leisure' ),
		'type'		=> 'text',
		'section'   => 'rooms_section',
		'id' 		=> 'rating_3',
		'desc'		=> __( 'Example: Price', 'leisure' ),
		'default'	=> __( 'Price', 'leisure' ),
		'active_cb'	=> 'curly_cb_ratings'
	);
	$options[] = array(
		'label'    	=> __( 'Rating Summary', 'leisure' ),
		'type'		=> 'text',
		'section'   => 'rooms_section',
		'id' 		=> 'rating_4',
		'desc'		=> __( 'Example: Quality', 'leisure' ),
		'default'	=> __( 'Quality', 'leisure' ),
		'active_cb'	=> 'curly_cb_ratings'
	);
	$options[] = array(
		'label'    	=> __( 'Rooms Link Slug', 'leisure' ),
		'type'		=> 'text',
		'section'   => 'rooms_section',
		'id' 		=> 'rooms_slug',
		'desc'		=> __( 'Example: http://yourdomain.com/YOUR_SLUG/ Please change only if necessary.', 'leisure' ),
		'default'	=> __( 'rooms', 'leisure' )
	);




	/* !Add Controls to Static Front Page Section */
	$options[] = array(
		'label'    	=> __( 'Posts Listing Style', 'leisure' ),
		'desc'		=> __( 'You have two layout styles available:', 'leisure' ),
		'type'		=> 'radio',
		'id'   		=> 'blog_style',
		'section'	=> 'static_front_page',
		'choices'	=> array(
			'' 		=> __( 'List with large image (default)', 'leisure' ),
			'medium'=> __( 'List with small image', 'leisure' )
		)
	);
	$options[] = array(
		'label'    	=> __( 'Posts Description', 'leisure' ),
		'type'		=> 'slider',
		'section'   => 'static_front_page',
		'id' 		=> 'excerpt',
		'default'	=> 20,
		'input_attr'=> array( 'min' => 10, 'max' => 500, 'step' => 5, 'suffix' => 'words' )
	);



	/* !Add Controls to Navigation */
	$options[] = array(
		'label'    	=> __( 'Menu Settings', 'leisure' ),
		'type'		=> 'section',
		'id'   		=> 'nav',
		'panel'		=> 'nav_menus'
	);
	$options[] = array(
		'label'    	=> __( 'Enable Sticky Navigation', 'leisure' ),
		'type'		=> 'checkbox',
		'section'   => 'nav',
		'id' 		=> 'sticky_menu',
		'default'	=> true
	);
	$options[] = array(
		'label'    	=> __( 'Enable Search in Navigation', 'leisure' ),
		'type'		=> 'checkbox',
		'section'   => 'nav',
		'id' 		=> 'search_menu',
		'default'	=> true
	);
	$options[] = array(
		'label'    	=> __( 'Main Menu Height', 'leisure' ),
		'type'		=> 'slider',
		'section'   => 'nav',
		'id' 		=> 'header_height',
		'default'	=> 80,
		'input_attr'=> array( 'min' => 40, 'max' => 300, 'step' => 1, 'suffix' => 'px' )
	);
	$options[] = array(
		'label'    	=> __( 'Main Menu Alignment', 'leisure' ),
		'type'		=> 'radio',
		'section'   => 'nav',
		'id' 		=> 'header_alignment',
		'default'	=> 'right',
		'choices'  	=> array(
			'right' => __( 'Right Aligned (default)', 'leisure' ),
			'left' => __( 'Left Aligned', 'leisure' )
		)
	);



	/* !Add Controls to Background */
	$options[] = array(
		'label'    	=> __( 'Background Slider', 'leisure' ),
		'type'		=> 'select',
		'section'   => 'background_image',
		'id' 		=> 'bg_slider',
		'choices'  	=> $revsliders,
		'transport' => 'refresh',
		'active_cb' => 'curly_cb_rev'
	);

	/* !Update Sections */
	$options[] = array(
		'type'		=> 'update_section',
		'id'		=> 'background_image',
		'priority'	=> 12
	);
	$options[] = array(
		'type'		=> 'update_section',
		'id'		=> 'colors',
		'panel'		=> 'colors_panel',
		'title'		=> __( 'General Colors', 'leisure' ),
		'priority'	=> 10
	);
	$options[] = array(
		'type'		=> 'update_section',
		'id'		=> 'title_tagline',
		'panel'		=> 'header_panel',
		'title'		=> __( 'Site Title & Taglines', 'leisure' )
	);
	$options[] = array(
		'type'		=> 'update_section',
		'id'		=> 'header_image',
		'panel'		=> 'header_panel',
		'priority'	=> 30
	);

	return $options;
}



/**
 * Callbacks
 */

/** Allow JS */
function curly_cb_allow_js(){
	if( get_theme_mod( 'custom_js_check', false ) === true ) return true; else return false;
}

/** Check for Boxed */
function curly_cb_boxed(){

	$layout 	= esc_attr( get_theme_mod( 'layout_style', 'full' ) );
	$content 	= filter_var( esc_attr( get_theme_mod( 'layout_advanced_content' ) ), FILTER_VALIDATE_BOOLEAN );

	if( $content === true ){
		return true;
	} elseif( $layout === 'boxed' ){
		return true;
	} else {
		return false;
	}
}


/** Check for Sticky */
function curly_cb_sticky(){
	if( get_theme_mod( 'sticky_menu', true ) === true ) return true; else return false;
}

/** Check for Wide */
function curly_cb_layout_advanced_header(){
	if( filter_var( esc_attr( get_theme_mod( 'layout_advanced_header' ) ), FILTER_VALIDATE_BOOLEAN ) === true ) return true; else return false;
}
function curly_cb_layout_advanced_content(){
	if( filter_var( esc_attr( get_theme_mod( 'layout_advanced_content' ) ), FILTER_VALIDATE_BOOLEAN ) === true ) return true; else return false;
}
function curly_cb_layout_advanced_footer(){
	if( filter_var( esc_attr( get_theme_mod( 'layout_advanced_footer' ) ), FILTER_VALIDATE_BOOLEAN ) === true ) return true; else return false;
}
function curly_cb_layout_style(){
	if( esc_attr( get_theme_mod( 'layout_style', 'full' ) ) === 'boxed' ) return true; else return false;
}


function curly_cb_layout_pref( $control ){

	if( $control->manager->get_setting('layout_pref')->value() === 'custom' && $control->manager->get_setting('layout_style')->value() === 'boxed' )
		return true;
	else
		return false;

}
function curly_cb_layout_pref_padding( $control ){

	if( $control->manager->get_setting('layout_pref')->value() === 'custom' )
		return true;
	else
		return false;

}
function curly_cb_layout_header( $control ){

	$header_style = $control->manager->get_setting('layout_style_header')->value();

	if( $control->manager->get_setting('layout_size_header')->value() !== 'custom' ){
		return false;
	}

	if( empty( $header_style ) && $control->manager->get_setting('layout_style')->value() !== 'boxed' ){
		return false;
	}

	if( $control->manager->get_setting('layout_style_header')->value() === 'full' ){
		return false;
	}

	return true;

}
function curly_cb_layout_header_padding( $control ){

	if( $control->manager->get_setting('layout_size_header')->value() !== 'custom' ){
		return false;
	}

	return true;

}
function curly_cb_layout_content(){

	$content_style = esc_attr( get_theme_mod( 'layout_style_content' ) );

	if( esc_attr( get_theme_mod( 'layout_size_content' ) ) !== 'custom' ){
		return false;
	}

	if( empty( $content_style ) && esc_attr( get_theme_mod( 'layout_style' ) ) !== 'boxed' ){
		return false;
	}

	if( esc_attr( get_theme_mod( 'layout_style_content' ) ) === 'full' ){
		return false;
	}

	return true;

}
function curly_cb_layout_content_padding(){

	if( esc_attr( get_theme_mod( 'layout_size_content' ) ) !== 'custom' ){
		return false;
	}

	return true;

}
function curly_cb_layout_footer(){

	$footer_style = esc_attr( get_theme_mod( 'layout_style_footer' ) );

	if( esc_attr( get_theme_mod( 'layout_size_footer' ) ) !== 'custom' ){
		return false;
	}

	if( empty( $footer_style ) && esc_attr( get_theme_mod( 'layout_style' ) ) !== 'boxed' ){
		return false;
	}

	if( esc_attr( get_theme_mod( 'layout_style_footer' ) ) === 'full' ){
		return false;
	}

	return true;

}
function curly_cb_layout_footer_padding(){

	if( esc_attr( get_theme_mod( 'layout_size_footer' ) ) !== 'custom' ){
		return false;
	}

	return true;

}

/** Check for RevSlider */
function curly_cb_rev(){
	if( function_exists( 'putRevSlider' ) ) return true; else return false;
}

/** Check for Ratings */
function curly_cb_ratings(){
	$ratings = get_theme_mod( 'rooms' );
	if( $ratings !== true ) return true; else return false;
}

/** Check for WPML */
function curly_cb_wpml(){
	if( has_action('icl_language_selector') ) return true; else false;
}

?>
