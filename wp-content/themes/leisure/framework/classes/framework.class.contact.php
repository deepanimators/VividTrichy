<?php

class LeisureContact {

	public function __construct() {
	}

	// Side Content
	public function side( $side ) {
		if (function_exists('curly_shortcode_sanitizer')) {
			echo do_shortcode( curly_shortcode_sanitizer( wpautop( $side ) ) );
		} else {
			echo do_shortcode( wpautop( $side ) );
		}
	}

	// Generate Map
	public function map( $latitude, $longitude, $height, $map_type, $zoom, $theme = null ) {

		// Enqueue Map Scripts
		if( ! wp_script_is('google-maps-js') ) {
			wp_enqueue_script('google-maps-js');
		}

		echo "<div id='map-container' data-zoom='{$zoom}' data-lat='{$latitude}' data-lng='{$longitude}' data-theme='{$theme}' data-type='{$map_type}'></div>";
	}
}

$leisure_contact = new LeisureContact();

?>
