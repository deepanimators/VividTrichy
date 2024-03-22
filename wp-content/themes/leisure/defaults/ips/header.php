<?php

add_filter( 'xtender_ips_array', 'leisure_ips_header', 20, 1 );

function leisure_ips_header( $options ){

  /** Revolution Sliders */
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

  $default_header_color 	= get_post_meta( get_the_id(), THEMEPREFIX.'_header_bg_color', true );
  $default_header_color 	= ! empty( $default_header_color ) ? new LeisureColor( $default_header_color ) : null;
  $default_header_opac	= get_post_meta( get_the_id(), THEMEPREFIX.'_header_opacity', true );
  if( ! empty( $default_header_opac ) ){
  	$default_header_color = is_null( $default_header_color ) ?
  		new LeisureColor( get_theme_mod( 'header_shading_color', 'rgba(0, 0, 0, 0.15)' ) ) : $default_header_color;
  	$default_header_color = $default_header_color->opacity( $default_header_opac / 100 );
  }

  $options[] = array(
  	'id'	=> 'header_tab',
  	'type'	=> 'tab',
  	'name'	=> __( 'Header Options', 'leisure' )
  );
  $options[] = array(
  	'id'	=> 'header_image',
  	'type'	=> 'image',
  	'tab'	=> 'header_tab',
  	'name'	=> __( 'Header Image', 'leisure' )
  );
  $options[] = array(
  	'id'	=> 'header_slider',
  	'type'	=> 'select',
  	'tab'	=> 'header_tab',
  	'name'	=> __( 'Header Slider', 'leisure' ),
  	'choices' 	=> $revsliders
  );
  $options[] = array(
  	'id'	=> 'header_height',
  	'type'	=> 'radio',
  	'tab'	=> 'header_tab',
  	'name'	=> __( 'Header Height', 'leisure' ),
  	'choices' 	=> array(
  		0	=> __( 'Default', 'leisure' ),
  		1	=> __( 'Match Image', 'leisure' ),
  		3	=> __( 'Fixed Height', 'leisure' )
  	)
  );
  $options[] = array(
  	'id'	=> 'header_height_value',
  	'type'	=> 'slider',
  	'tab'	=> 'header_tab',
  	'name'	=> __( 'Fixed Header Height', 'leisure' ),
  	'desc'	=> __( 'Header Height must be set to "Fixed Height"', 'leisure' ),
  	'atts'	=> array(
  		'step' => 1,
  		'min' => 200,
  		'max' => 1500,
  		'suf' => 'px'
  	),
  	'default' => 370
  );
  $options[] = array(
  	'id'	=> 'header_bg_color',
  	'type'	=> 'color',
  	'tab'	=> 'header_tab',
  	'name'	=> __( 'Header Background Color', 'leisure' ),
  	'default'	=> $default_header_color
  );

  return $options;
}
