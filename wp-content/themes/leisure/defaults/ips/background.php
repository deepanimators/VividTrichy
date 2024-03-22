<?php

add_filter( 'xtender_ips_array', 'leisure_ips_background', 20, 1 );

function leisure_ips_background( $options ){
  
  $options[] = array(
  	'id'	=> 'bg_tab',
  	'type'	=> 'tab',
  	'name'	=> __( 'Background', 'leisure' )
  );
  $options[] = array(
  	'id'	=> 'bg_color',
  	'type'	=> 'color',
  	'tab'	=> 'bg_tab',
  	'name'	=> __( 'Background Color', 'leisure' )
  );
  $options[] = array(
  	'id'	=> 'bg_image',
  	'type'	=> 'image',
  	'tab'	=> 'bg_tab',
  	'name'	=> __( 'Background Image', 'leisure' )
  );
  $options[] = array(
  	'id'	=> 'bg_position',
  	'type'	=> 'radio',
  	'tab'	=> 'bg_tab',
  	'name'	=> __( 'Background Position', 'leisure' ),
  	'choices' 	=> array(
  		0	=> __( 'Left', 'leisure' ),
  		1	=> __( 'Center', 'leisure' ),
  		2	=> __( 'Right', 'leisure' )
  	) ,
  	'default' => 0
  );
  $options[] = array(
  	'id'	=> 'bg_repeat',
  	'type'	=> 'radio',
  	'tab'	=> 'bg_tab',
  	'name'	=> __( 'Background Repeat', 'leisure' ),
  	'choices' 	=> array(
  		0	=> __( 'Repeat', 'leisure' ),
  		1	=> __( 'No Repeat', 'leisure' ),
  		2	=> __( 'Vertically', 'leisure' ),
  		3	=> __( 'Horizontally', 'leisure' )
  	),
  	'default' => 0
  );
  $options[] = array(
  	'id'	=> 'bg_size',
  	'type'	=> 'radio',
  	'tab'	=> 'bg_tab',
  	'name'	=> __( 'Background Size', 'leisure' ),
  	'choices' 	=> array(
  		0	=> __( 'Auto', 'leisure' ),
  		1	=> __( 'Cover', 'leisure' ),
  		2	=> __( 'Contain', 'leisure' )
  	),
  	'default' => 0
  );
  $options[] = array(
  	'id'	=> 'bg_attachment',
  	'type'	=> 'radio',
  	'tab'	=> 'bg_tab',
  	'name'	=> __( 'Background Attachment', 'leisure' ),
  	'choices' 	=> array(
  		0	=> __( 'Scroll', 'leisure' ),
  		1	=> __( 'Fixed', 'leisure' ),
  		2	=> __( 'Local', 'leisure' )
  	),
  	'default' => 0
  );

  return $options;
}
