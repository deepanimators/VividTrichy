<?php

add_filter( 'xtender_ips_array', 'leisure_ips_title', 20, 1 );

function leisure_ips_title( $options ){
  $options[] = array(
  	'id'	=> 'page_title_tab',
  	'type'	=> 'tab',
  	'name'	=> __( 'Page Title', 'leisure' )
  );
  $options[] = array(
  	'id'	=> 'header_subtitle',
  	'type'	=> 'text',
  	'tab'	=> 'page_title_tab',
  	'name'	=> __( 'Page Subtitle', 'leisure' ),
  	'desc'	=> __( 'Enter your page subtitle', 'leisure' )
  );
  $options[] = array(
  	'id'	=> 'heading',
  	'type'	=> 'checkbox',
  	'tab'	=> 'page_title_tab',
    'default' => 'false',
  	'name'	=> __( 'Hide Page Title', 'leisure' ),
  	'desc'	=> __( 'Check this to hide the page title', 'leisure' )
  );
  $options[] = array(
  	'id'	=> 'header_align',
  	'type'	=> 'radio',
  	'tab'	=> 'page_title_tab',
  	'name'	=> __( 'Header Alignment', 'leisure' ),
  	'choices' 	=> array(
  		0	=> __( 'Left', 'leisure' ),
  		1	=> __( 'Center', 'leisure' ),
  		2	=> __( 'Right', 'leisure' )
  	)
  );
  $options[] = array(
  	'id'	=> 'header_text',
  	'type'	=> 'color',
  	'tab'	=> 'page_title_tab',
  	'name'	=> __( 'Page Title Color', 'leisure' )
  );

  return $options;
}
