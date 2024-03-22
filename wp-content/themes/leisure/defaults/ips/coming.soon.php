<?php

add_filter( 'xtender_ips_array', 'leisure_ips_coming_soon', 20, 1 );

function leisure_ips_coming_soon( $options ){

  $options[] = array(
  	'id'	=> 'soon_tab',
  	'type'	=> 'tab',
  	'name'	=> __( 'Coming Soon', 'leisure' ),
  	'template'	=> array( 'page-templates/coming-soon.php' )
  );
  $options[] = array(
  	'id'	=> 'video_cover',
  	'type'	=> 'image',
  	'tab'	=> 'soon_tab',
  	'name'	=> __( 'Video Background Cover Image', 'leisure' )
  );
  $options[] = array(
  	'id'	=> 'video_mp4',
  	'type'	=> 'video',
  	'tab'	=> 'soon_tab',
  	'name'	=> __( 'Video Background MP4 File', 'leisure' )
  );
  $options[] = array(
  	'id'	=> 'video_webm',
  	'type'	=> 'video',
  	'tab'	=> 'soon_tab',
  	'name'	=> __( 'Video Background WEBM File', 'leisure' )
  );
  $options[] = array(
  	'id'	=> 'video_ogg',
  	'type'	=> 'video',
  	'tab'	=> 'soon_tab',
  	'name'	=> __( 'Video Background OGG File', 'leisure' )
  );

  return $options;
}
