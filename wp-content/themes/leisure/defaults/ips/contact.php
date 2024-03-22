<?php

add_filter( 'xtender_ips_array', 'leisure_ips_contact', 20, 1 );

function leisure_ips_contact( $options ){

  $options[] = array(
  	'id'	=> 'contact_tab',
  	'type'	=> 'tab',
  	'name'	=> __( 'Contact Details', 'leisure' ),
  	'template'	=> array( 'page-templates/contact.php', 'page-templates/contact-2.php', 'page-templates/contact-3.php' )
  );
  $options[] = array(
  	'id'	=> 'contact_side',
  	'type'	=> 'editor',
  	'tab'	=> 'contact_tab',
  	'name'	=> __( 'Side Content', 'leisure' )
  );
  $options[] = array(
  	'id'	=> 'latitude',
  	'type'	=> 'text',
  	'tab'	=> 'contact_tab',
  	'name'	=> __( 'Map Latitude', 'leisure' ),
  	'desc'	=> __( 'Latitude Coordinates (Please use decimal coordinates. ie. 51.508056)', 'leisure' )
  );
  $options[] = array(
  	'id'	=> 'longitude',
  	'type'	=> 'text',
  	'tab'	=> 'contact_tab',
  	'name'	=> __( 'Map Longitude', 'leisure' ),
  	'desc'	=> __( 'Longitude Coordinates (Please use decimal coordinates. ie. -0.128056)', 'leisure' )
  );
  $options[] = array(
  	'id'	=> 'map_type',
  	'type'	=> 'radio',
  	'tab'	=> 'contact_tab',
  	'name'	=> __( 'Map Type', 'leisure' ),
  	'choices' 	=> array(
  		'roadmap'	=> __( 'Roadmap', 'leisure' ),
  		'satellite'	=> __( 'Satellite', 'leisure' ),
  		'hybrid'	=> __( 'Hybrid', 'leisure' ),
  		'terrain'	=> __( 'Terrain', 'leisure' )
  	),
  	'default' => 'roadmap'
  );
  $options[] = array(
  	'id'	=> 'map_theme',
  	'type'	=> 'radio',
  	'tab'	=> 'contact_tab',
  	'name'	=> __( 'Map Color Theme', 'leisure' ),
  	'choices' 	=> array(
  		'default'	=> __( 'Light (default)', 'leisure' ),
  		'dark'		=> __( 'Dark', 'leisure' )
  	),
  	'default' => 'default'
  );
  $options[] = array(
  	'id'	=> 'map_height',
  	'type'	=> 'slider',
  	'tab'	=> 'contact_tab',
  	'name'	=> __( 'Map Height', 'leisure' ),
  	'atts'	=> array( 'step' => 1, 'min' => 100, 'max' => 800, 'suf' => 'px' ),
  	'desc'	=> __( 'Choose the map height. Default is 400px.', 'leisure' ),
  	'default' => 400
  );
  $options[] = array(
  	'id'	=> 'map_zoom',
  	'type'	=> 'slider',
  	'tab'	=> 'contact_tab',
  	'name'	=> __( 'Map Zoom', 'leisure' ),
  	'atts'	=> array( 'step' => 1, 'min' => 1, 'max' => 18, 'suf' => null ),
  	'desc'	=> __( 'Choose the map zoom level. Default level is 15', 'leisure' ),
  	'default' => 12
  );

  return $options;
}
