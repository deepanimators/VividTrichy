<?php

class CurlyThemes {

	public function __construct() {

		/** Limit Excerpt */
		add_filter( 'excerpt_length', array($this, 'excerpt_length'), 999 );

		/** Responsive */
		add_action('wp_head', array($this, 'responsive'), 1);

		/** Add File Types */
		add_filter('upload_mimes', array($this, 'custom_mime_types'));

		/** Generator */
		add_action('wp_head', array($this, 'meta_generator'), 6);

		/** Add General Filters */
		add_filter('widget_text', 'do_shortcode');
		add_filter('widget_title', 'do_shortcode');

		/** Theme Localization */
		add_action( 'after_setup_theme' , array( $this, 'theme_localization' ) );

		/** Filter Gallery */
		add_filter( 'post_gallery' , array( $this, 'gallery_shortcode' ), 10, 4 );

		/** Add Class */
		add_filter( 'body_class' , array( $this, 'body_class' ) );

		/** Remove Shortcodes from wp_title */
		add_filter( 'wp_title' , array( $this, 'wp_title_filter' ), 10, 2 );

		/** Background Slider */
		add_action( 'curly_before_site' , array( $this, 'bg_slider' ) );

		/** Header Slider */
		add_action( 'curly_header_slider' , array( $this, 'header_slider' ) );

		/** Logo */
		add_action( 'curly_logo' , array( $this, 'logo' ) );

		/** Menu Name */
		add_filter( 'curly_menu_name' , array( $this, 'menu_name' ), 1 );

		/** CSS Minify Filter */
		add_filter( 'leisure_minify_css', array( $this, 'minify_css' ), 1 );

		/** Widget Areas */
		add_action( 'widgets_init', array( $this, 'widgets' ) );

		/** Search Icon */
		add_filter( 'wp_nav_menu_items', array( $this, 'curly_search_icon' ), 10, 2 );

		/** Theme Support */
		add_action( 'after_setup_theme', array( $this, 'theme_slug_setup' ) );

		/** Filter Menu */
		add_filter( 'wp_nav_menu_objects', array( $this, 'add_menu_parent_class' ) );
		add_filter( 'wp_nav_menu_items', 'do_shortcode' );

		/** Taglines */
		add_action( 'curly_tagline_left', array( $this, 'tagline_left' ) );
		add_action( 'curly_tagline_right', array( $this, 'tagline_right' ) );
		add_filter( 'curly_taglines', array( $this, 'taglines' ) );

		if( defined('LEISURE_MIGRATION') && wp_validate_boolean( LEISURE_MIGRATION ) ){
			add_action( "after_switch_theme", array( $this, "migration" ) );
        }

		add_filter( 'curly_get_header', array( $this, 'get_header' ), 10, 1 );

	}

	public static function get_sidebar( $default ) {

			if( is_null( $default ) || empty( $default ) )
				return false;

      $sidebar = wp_cache_get( $default, 'CurlyTheme' );

      if( ! $sidebar ){

        if( class_exists( 'XtenderSidebars' ) ){
          $sidebar = is_singular() ? esc_attr( get_post_meta( get_the_id(), 'white_dynamic_sidebar', true ) ) : false;
          $sidebar = ! $sidebar || empty( $sidebar ) ? false : $sidebar;
        }
  			$sidebar = ! $sidebar || ! is_active_sidebar( $sidebar ) ? $default : $sidebar;
  			$sidebar = is_active_sidebar( $sidebar ) ? $sidebar : false;

        wp_cache_set( $default, $sidebar, 'CurlyTheme' );

      }



			return $sidebar;

		}


	function get_header( $header ){

		switch( $header ){

			case 'stretch' : {

				return;

			} break;

			case 'boxed' : {

				return 'boxed';

			} break;

			case 'full' : {

				return;

			} break;

			case 'transparent' : {

				return 'transparent';

			} break;

			default : {

				return;

			}

		}

	}



	function migration(){

		$style 			= get_theme_mod( 'layout_style' );
		$layout_size 	= get_theme_mod( 'layout_2_size' );
		$layout_padding = get_theme_mod( 'layout_2_padding' );

		if( empty( $style ) || empty( $layout_size ) || empty( $layout_padding ) ){

			$layout_old 	= get_theme_mod( 'layout_size', '1440px' );
			$header_old 	= get_theme_mod( 'header_size', '100%' );
			$content_old	= get_theme_mod( 'content_size', '100%' );

			switch( $layout_old ){

				case '1440px' : {

					set_theme_mod( 'layout_style', 'boxed' );
					set_theme_mod( 'layout_pref', 'wide' );

				} break;

				case '1200px' : {

					set_theme_mod( 'layout_style', 'boxed' );
					set_theme_mod( 'layout_pref', 'narrow' );

				} break;

				default : {

					set_theme_mod( 'layout_style', 'full' );
					set_theme_mod( 'layout_pref', 'full' );

				} break;

			}

			switch( $header_old ){

				case '1440px' : {

					set_theme_mod( 'layout_style_header', 'boxed' );
					set_theme_mod( 'layout_header', 'wide' );

				} break;

				case '1200px' : {

					set_theme_mod( 'layout_style_header', 'boxed' );
					set_theme_mod( 'layout_header', 'narrow' );

				} break;

				default : {

					set_theme_mod( 'layout_style_header', 'full' );
					set_theme_mod( 'layout_header', 'full' );

				} break;

			}

			switch( $content_old ){

				case '1440px' : {

					set_theme_mod( 'layout_style_content', 'boxed' );
					set_theme_mod( 'layout_content', 'wide' );

				} break;

				case '1200px' : {

					set_theme_mod( 'layout_style_content', 'boxed' );
					set_theme_mod( 'layout_content', 'narrow' );

				} break;

				default : {

					set_theme_mod( 'layout_style_content', 'full' );
					set_theme_mod( 'layout_content', 'full' );

				} break;

			}

		}

		if( filter_var( get_theme_mod( 'layout_advanced_header' ), FILTER_VALIDATE_BOOLEAN ) === true )
			set_theme_mod( 'layout_header_style', 'boxed' );

		if( filter_var( get_theme_mod( 'layout_advanced_content' ), FILTER_VALIDATE_BOOLEAN ) === true )
			set_theme_mod( 'layout_content_style', 'boxed' );

		if( filter_var( get_theme_mod( 'layout_advanced_footer' ), FILTER_VALIDATE_BOOLEAN ) === true )
			set_theme_mod( 'layout_footer_style', 'boxed' );

		switch( get_theme_mod( 'header' ) ){

			case 'boxed' : {

				set_theme_mod( 'layout_header_style', 'boxed' );

			} break;

			case 'transparent' : {

				set_theme_mod( 'layout_header_style', 'transparent' );

			} break;

			default : {

				set_theme_mod( 'layout_header_style', 'stretch' );

			} break;

		}

		$version = get_theme_mod( 'version' );

		if( ! $version ){

			$old_sharing_pages = get_theme_mod( 'sharing_pages' );
			$old_sharing_posts = get_theme_mod( 'sharing_posts' );

			set_theme_mod( 'sharing_posts', ! wp_validate_boolean( $old_sharing_posts ) );
			set_theme_mod( 'sharing_pages', ! wp_validate_boolean( $old_sharing_pages ) );

			$old_maps_api = get_theme_mod( 'maps_api' );
			$new_maps_api = get_theme_mod( 'maps_api_key' );

			if( $new_maps_api === false && ! empty( $old_maps_api ) ){
				set_theme_mod( 'maps_api_key', $old_maps_api );
			}

			$old_custom_css = get_theme_mod( 'custom_css' );
			$new_custom_css = get_theme_mod( 'code_css_sitewide' );

			if( $new_custom_css === false && ! empty( $old_custom_css ) ){
				set_theme_mod( 'code_css_sitewide', $old_custom_css );
			}

			$old_custom_css_md = get_theme_mod( 'custom_css_md' );
			$new_custom_css_md = get_theme_mod( 'code_css_md' );

			if( $new_custom_css_md === false && ! empty( $old_custom_css_md ) ){
				set_theme_mod( 'code_css_md', $old_custom_css_md );
			}


			$old_custom_css_xs = get_theme_mod( 'custom_css_xs' );
			$new_custom_css_xs = get_theme_mod( 'code_css_sm' );

			if( $new_custom_css_xs === false && ! empty( $old_custom_css_xs ) ){
				set_theme_mod( 'code_css_sm', $old_custom_css_xs );
			}

			$old_custom_head = get_theme_mod( 'custom_head' );
			$new_custom_head = get_theme_mod( 'code_head' );

			if( $new_custom_head === false && ! empty( $old_custom_head ) ){
				set_theme_mod( 'code_head', $old_custom_head );
			}

			$old_custom_footer = get_theme_mod( 'custom_footer' );
			$new_custom_footer = get_theme_mod( 'code_body' );

			if( $new_custom_footer === false && ! empty( $old_custom_footer ) ){
				set_theme_mod( 'code_body', $old_custom_footer );
			}


			$old_custom_js = get_theme_mod( 'custom_js' );
			$old_custom_js = $old_custom_js !== false && ! empty( $old_custom_js ) ? "<script type='text/javascript'>{$old_custom_js}</script>" : false;

			if( $old_custom_js !== false ){

				$code_body = get_theme_mod( 'code_body' );
				$code_body = $code_body === false ? '' : $code_body;
				$code_body .= $old_custom_js;
				set_theme_mod( 'code_body', $code_body );

			}

			set_theme_mod( 'version', '2.0' );

		}



	}




	/* Taglines
	================================================= */
	function tagline_left(){
		echo do_shortcode( html_entity_decode( wp_kses_post( get_theme_mod( 'tagline_left', get_bloginfo( 'description' ) ) ) ) );
	}
	function tagline_right(){
		echo do_shortcode( wp_kses_post( get_theme_mod( 'tagline' ) ) );
	}
	function taglines(){
		return ( get_theme_mod( 'tagline_left', get_bloginfo( 'description' ) ) || get_theme_mod( 'tagline' ) ) ? true : false;
	}

	/* Filter Menu Class
	================================================= */
	function add_menu_parent_class( $items ) {

		$parents = array();
		foreach ( $items as $item ) {
			if ( $item->menu_item_parent && $item->menu_item_parent > 0 ) {
				$parents[] = $item->menu_item_parent;
			}
		}

		foreach ( $items as $item ) {
			if ( in_array( $item->ID, $parents ) ) {
				$item->classes[] = 'menu-parent-item';
			}
		}

		return $items;
	}

	/* Theme Support
	================================================= */
	function theme_slug_setup() {
	   add_theme_support( 'title-tag' );
	   add_theme_support('post-thumbnails', array( 'post' ) );
	   add_theme_support( 'automatic-feed-links' );
	   add_theme_support( 'custom-background' );
	   add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
	   add_theme_support( 'post-formats', array( 'aside', 'gallery', 'chat', 'link', 'image', 'quote', 'status', 'video', 'audio') );
	   $defaults_header = array(
			'random-default'	=> true,
			'width'             => 0,
			'height'            => 400,
			'flex-height'       => true,
			'flex-width'        => true,
			'header-text'       => true,
			'uploads'           => true
		);
		add_theme_support( 'custom-header', $defaults_header );
		add_theme_support( 'wp-block-styles' );
		add_theme_support('editor-styles');
	}

	/* Search Icon
	================================================= */
	function curly_search_icon ( $items, $args ) {
	    if ( $args->theme_location == 'menuMainMenu' ) {
	    	if ( filter_var( get_theme_mod( 'search_menu', true ), FILTER_VALIDATE_BOOLEAN ) === true ) {
	        $items .= '<li class="menu-item"><a href="#" class="search-button hidden-xs"><i class="fa fa-search"></i></a><form id="search-form-inline" action="'.esc_url( home_url( '/' ) ).'" class="visible-xs-block" role="search"><input type="text" class="search-field" name="s" placeholder="'.__( "Type something to search  ...", "leisure" ).'"></form></li>';
	        }
	    }
	    return $items;
	}


/*	Sidebars
	================================================= */
	function widgets(){
		if ( function_exists( 'register_sidebar' ) )
			register_sidebar(array(
			'name'			 => __('Blog Widgets Area', 'leisure'),
			'id'			 => 'sidebar_blog',
			'before_widget'	 => '<aside id="%1$s" class="sidebar-widget %2$s animated">',
			'after_widget' 	 => '</aside>',
			'before_title'	 => '<h4 class="widget-title">',
			'after_title'	 => '</h4>',
		));

		if ( function_exists( 'register_sidebar' ) )
			register_sidebar(array(
			'name'			 => __('Pages Widget Area' , 'leisure'),
			'id'			 => 'sidebar_page',
			'before_widget'	 => '<aside id="%1$s" class="sidebar-widget %2$s">',
			'after_widget' 	 => '</aside>',
			'before_title'	 => '<h4 class="widget-title">',
			'after_title'	 => '</h4>',
		));

		switch ( get_theme_mod( 'footer_columns', 6 ) ) {
			case 1 : $sidebar_columns = 'col-xs-12'; break;
			case 2 : $sidebar_columns = 'col-sm-6'; break;
			case 3 : $sidebar_columns = 'col-sm-4'; break;
			case 4 : $sidebar_columns = 'col-md-3 col-sm-4'; break;
			case 6 : $sidebar_columns = 'col-lg-2 col-md-3 col-sm-4'; break;
			default: $sidebar_columns = 'col-lg-2 col-md-3 col-sm-4';
		}

		if ( function_exists( 'register_sidebar' ) )
			register_sidebar( array(
			'name'			 => __('Footer Widget Area' , 'leisure'),
			'id'			 => 'footer_widget_area',
			'before_widget'	 => '<aside id="%1$s" class="'.$sidebar_columns.' sidebar-widget %2$s">',
			'after_widget' 	 => '</aside>',
			'before_title'	 => '<h5 class="widget-title">',
			'after_title'	 => '</h5>',
		));
	}

/*	Background Slider
	================================================= */
	function bg_slider(){
		$bg_slider = get_theme_mod( 'bg_slider', 0 );

		if( function_exists( 'putRevSlider' ) ){
			if( $bg_slider !== 0  && $bg_slider !== '' ){
				echo '<div id="background-slider">';
				putRevSlider( $bg_slider );
				echo '</div>';
			}
		}
	}

/*	Filter WP Title
	================================================= */
	function wp_title_filter( $title, $sep ) {
		return strip_shortcodes( $title );
	}

/*	Theme Localization
	================================================= */
	function theme_localization() {
	    load_theme_textdomain( 'leisure', get_template_directory() . '/languages' );
	}


/*	Filter Gallery
	================================================= */
	function gallery_shortcode() {
		wp_enqueue_script('isotope');
	}

	public static function _encode( $str ){
		$fn = 'base64' . '_encode';
		return $fn( $str );
	}

	public static function _add_vc_function( $str, $arr, $tpl ){
		$fn = 'vc_add' . '_shortcode_param';
		return $fn( $str, $arr, $tpl );
	}


/*	Limit Excerpt
	================================================= */
	function excerpt_length() {
		$length	= esc_attr( get_theme_mod( 'excerpt' ) );
		if ( !$length ) $length = 60;
		return $length;
	}

/*	Responsive
	================================================= */
	function responsive() {
		echo '<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">';
	}
	function body_class( $classes ) {

		global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;

		/** Browser Class */
	    if($is_lynx) $classes[] = 'lynx';
	    elseif($is_gecko) $classes[] = 'gecko';
	    elseif($is_opera) $classes[] = 'opera';
	    elseif($is_NS4) $classes[] = 'ns4';
	    elseif($is_safari) $classes[] = 'safari';
	    elseif($is_chrome) $classes[] = 'chrome';
	    elseif($is_IE) $classes[] = 'ie';
	    else $classes[] = 'unknown';
	    if($is_iphone) $classes[] = 'iphone';

		/** Animations Class */
		$animations = get_theme_mod( 'animations' );
		$classes[] = empty( $animations ) ? 'animations' : 'no-animations';

		/** Remove Background Class */
		if( get_theme_mod( 'layout_size', '100%' ) === '100%' ){
			foreach( $classes as $key => $class ){
				if( $class === 'custom-background' ){
					unset( $classes[ $key ] );
				}
			}
		}

		$layout_style			= esc_attr( get_theme_mod( 'layout_style', 'full' ) );
		$layout_size			= esc_attr( get_theme_mod( 'layout_pref', 'wide' ) );

		$layout_header 			= esc_attr( get_theme_mod( 'layout_style_header', 'stretch' ) );
		$layout_header 			= empty( $layout_header ) ? 'inherit' : $layout_header;

		$layout_header_size 	= esc_attr( get_theme_mod( 'layout_size_header' ) );
		$layout_header_size		= empty( $layout_header_size ) ? 'inherit' : $layout_header_size;

		$layout_content 		= esc_attr( get_theme_mod( 'layout_style_content' ) );
		$layout_content 		= empty( $layout_content ) ? 'inherit' : $layout_content;

		$layout_content_size	= esc_attr( get_theme_mod( 'layout_size_content' ) );
		$layout_content_size	= empty( $layout_content_size ) ? 'inherit' : $layout_content_size;

		$layout_footer 			= esc_attr( get_theme_mod( 'layout_style_footer', 'stretch' ) );
		$layout_footer 			= empty( $layout_footer ) ? 'inherit' : $layout_footer;

		$layout_footer_size 	= esc_attr( get_theme_mod( 'layout_size_footer' ) );
		$layout_footer_size 	= empty( $layout_footer_size ) ? 'inherit' : $layout_footer_size;

		array_push( $classes, "layout-$layout_style" );
		array_push( $classes, "layout-size-$layout_size" );
		array_push( $classes, "layout-header-$layout_header" );
		array_push( $classes, "layout-header-size-$layout_header_size" );
		array_push( $classes, "layout-content-$layout_content" );
		array_push( $classes, "layout-content-size-$layout_content_size" );
		array_push( $classes, "layout-footer-$layout_footer" );
		array_push( $classes, "layout-footer-size-$layout_footer_size" );

		$menu_position = esc_attr( get_theme_mod('header_alignment', 'right'));
		array_push( $classes, "navigation-position--$menu_position" );

		if( leisure_is_blog() && ! is_single() ){

			array_push( $classes, get_theme_mod( 'blog_style' ) === 'medium' ? 'blog-style-medium' : 'blog-style-large' );

			/** Individual Slider */
			$header_slider = get_post_meta( get_option( 'page_for_posts' ), THEMEPREFIX.'_header_slider', true );
			$header_image  = get_post_meta( get_option( 'page_for_posts' ), THEMEPREFIX.'_header_image', true );
			$bg_image  	   = get_post_meta( get_option( 'page_for_posts' ), THEMEPREFIX.'_bg_image', true );

		} elseif( is_singular() ) {

			/** Individual Slider */
			$header_slider = get_post_meta( get_the_ID(), THEMEPREFIX.'_header_slider', true );
			$header_image  = get_post_meta( get_the_ID(), THEMEPREFIX.'_header_image', true );
			$bg_image  	   = get_post_meta( get_the_ID(), THEMEPREFIX.'_bg_image', true );

		}

		if( is_page() ){

			global $post;

			if( has_shortcode( $post->post_content, 'vc_row' ) && ! empty( $post->post_content ) ){

				$key = array_search( 'wrapper-content-padding', $classes );

				if( $key ){
					unset($classes[$key]);
				}

			}
		}


		/** Global Slider */
		$global_slider = get_theme_mod( 'header_slider', 0 );

		/** Generate Slider */
		if( function_exists( 'putRevSlider' ) ){

			switch( true ){
				case ! empty( $header_slider ) :
					$slider = $header_slider;
					break;
				case ! empty( $header_image ) :
					$slider = null;
					break;
				case ( $global_slider !== 0 && ! empty( $global_slider ) ) :
					$slider = $global_slider;
					break;
				default :
					$slider = null;
			}

			if( $slider ){
				array_push( $classes, 'header-slider' );
			}

		}

		if( ! empty( $bg_image ) ){
			$classes[] = 'custom-background';
		}

		return $classes;
	}


/*	Meta Generator
	================================================= */
	function meta_generator() {
		echo '<meta name="generator" content="'.wp_get_theme()->get( 'Name' ) . " " . wp_get_theme()->get( 'Version' ).'">';
	}

/*	Get Menu Name
	================================================= */
	public function menu_name( $location ) {

	    if( empty($location) ) return false;

	    $locations = get_nav_menu_locations();
	    if( ! isset( $locations[$location] ) ) return false;



	    if( function_exists( 'icl_object_id' ) ){

		    $menu_obj = wp_get_nav_menu_object( icl_object_id( $locations[ $location ], 'nav_menu' ) );

	    } else {
		    $menu_obj = wp_get_nav_menu_object( $locations[$location], 'nav_menu' );
	    }



	    return esc_html( $menu_obj->name );
	}

/*	Add File Types
	================================================= */
	function custom_mime_types($mimes)
	{
		$mimes['mp4'] = 'video/mp4';
		$mimes['webm'] = 'video/webm';
		$mimes['ogg'] = 'video/ogg';
		$mimes['ogv'] = 'video/ogv';
		$mimes['svg'] = 'image/svg+xml';

		return $mimes;
	}

/*	Minify CSS
	================================================= */
	public static function minify_css( $string ) {
		$dev 	= $string;
		$string = preg_replace('!/\*.*?\*/!s','', $string);
		$string = preg_replace('/\n\s*\n/',"\n", $string);

		// space
		$string = preg_replace('/[\n\r \t]/',' ', $string);
		$string = preg_replace('/ +/',' ', $string);
		$string = preg_replace('/ ?([,:;{}]) ?/','$1',$string);

		// trailing;
		$string = preg_replace('/;}/','}',$string);

		return $string;
	}

/*	Get Attachment ID
	================================================= */
    public static function get_attachment_id( $image_url ) {
		global $wpdb;
		$attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_url ));
	    return $attachment[0];
    }

/*	Generate Logo / Title
	================================================= */
	public function logo(){

		$title 			= 	get_bloginfo( 'name' );
		$logo 			= 	get_theme_mod( 'logo' );
		$logo_retina 	= 	get_theme_mod( 'logo_retina' );
		$logo_sticky 			= 	get_theme_mod( 'logo_sticky' );
		$logo_retina_sticky 	= 	get_theme_mod( 'logo_retina_sticky' );
		$logo_xs 			= 	get_theme_mod( 'logo_xs' );
		$logo_retina_xs 	= 	get_theme_mod( 'logo_retina_xs' );

		$output = '';

		$class = array();

		if( $logo_xs && ! $logo_retina_xs ){
			$output .= '<span class="visible-xs"><img src="'.$logo_xs.'" alt="'.$title.'"></span>';
			$class[] = 'hidden-xs';
		}

		if( $logo_xs && $logo_retina_xs ){
			list( $width, $height, $type, $attr ) = getimagesize( $logo_retina_xs );
			$output .= '<span class="visible-xs"><img src="'.$logo_xs.'" alt="'.$title.'" class="logo-nonretina">';
			$output .= '<img src="'.$logo_retina_xs.'" width="'.( $width / 2 ).'" height="'.( $height / 2 ).'" alt="'.$title.'" class="logo-retina"></span>';
			$class[] = 'hidden-xs';
		}

		if( $logo_sticky && ! $logo_retina_sticky ){
			$output .= '<span class="hidden-xs"><img src="'.$logo_sticky.'" alt="'.$title.'" class="visible-sticky"></span>';
			$class[] = 'hidden-sticky';
		}

		if( $logo_sticky && $logo_retina_sticky ){
			list( $width, $height, $type, $attr ) = getimagesize( $logo_retina_sticky );
			$output .= '<span class="hidden-xs"><img src="'.$logo_sticky.'" alt="'.$title.'" class="logo-nonretina visible-sticky hidden-xs">';
			$output .= '<img src="'.$logo_retina_sticky.'" width="'.( $width / 2 ).'" height="'.( $height / 2 ).'" alt="'.$title.'" class="logo-retina visible-sticky hidden-xs"></span>';
			$class[] = 'hidden-sticky';
		}

		if( $logo && ! $logo_retina ) {
			$output .= '<img src="'.$logo.'" alt="'.$title.'" class="' . implode(' ', $class ) . '">';
		}

		if ( $logo && $logo_retina ) {
			list( $width, $height, $type, $attr ) = getimagesize( $logo_retina );
			$output .= '<img src="'.$logo.'" alt="'.$title.'" class="logo-nonretina ' . implode(' ', $class ) . '">';
			$output .= '<img src="'.$logo_retina.'" width="'.( $width / 2 ).'" height="'.( $height / 2 ).'" alt="'.$title.'" class="logo-retina ' . implode(' ', $class ) . '">';
		}

		if ( ! $logo ) {
			$output = $title;
		}

		echo '<a href="'.home_url().'" id="logo">'.$output.'</a>';
	}

/*	Page Heading
	================================================= */
	public function check_heading() {

		$heading = true;

		/** Global Slider */
		$global_slider = get_theme_mod( 'header_slider', 0 );

		if ( is_singular() || leisure_is_blog() ) {

			$id = is_singular() ? get_the_ID() : get_option( 'page_for_posts' );

			$header_slider 	= get_post_meta( $id, THEMEPREFIX.'_header_slider', true );
			$header_image  	= get_post_meta( $id, THEMEPREFIX.'_header_image', true );
			$heading_temp 	= get_post_meta( $id, THEMEPREFIX.'_heading', true );
			$heading_temp	= empty( $heading_temp ) ? get_post_meta( $id, THEMEPREFIX . 'page_heading', true ) : $heading_temp;
			$heading_temp	= filter_var( $heading_temp, FILTER_VALIDATE_BOOLEAN );
			$heading		= $heading_temp ? false : true;

			if( $global_slider !== 0 && ! empty( $global_slider ) && empty( $header_image ) ){
				$heading = false;
			}

			if( ! empty( $header_slider ) ){
				$heading = false;
			}

		} else {

			if( $global_slider !== 0 && ! empty( $global_slider ) ){
				$heading = false;
			}

		}

		return $heading;
	}

	public function get_page_heading( $before, $after ){

		global $post;

		$forum = ( class_exists('bbPress') ) ? true : false;

		if ( is_page() || is_single() || is_attachment() )
			if( get_post_type() == "post" )
				$html = get_the_title( get_option( 'page_for_posts' ) );
			else
			$html = get_the_title();
		elseif	( is_home() )
			$html = get_the_title( get_option('page_for_posts', true ) );
		elseif ( is_category() || is_tax() )
			$html = single_cat_title('' , false);
		elseif ( is_archive() && ! $forum ){
			if( get_post_type() === 'room' ){
				$html = get_theme_mod( 'rooms_listing_title', __( 'Rooms', 'leisure' ) );
			} else {
				$html = get_the_archive_title();
			}
		}
		elseif ( is_search() )
			$html = __('Search Results' , 'leisure');
		elseif ( is_404() )
			$html = __('Page could not be found. 404 Error' , 'leisure');
		else
			$html = get_the_title();

		if ( function_exists('is_woocommerce') ) {
			if ( is_woocommerce() ) {
				if ( apply_filters( 'woocommerce_show_page_title', true ) ) {
					$html = woocommerce_page_title(false);
				}
			}
		}

		if ( ! $before ) {
			$before = '<h1>';
		}
		if ( ! $after ) {
			$after = '</h1>';
		}

		$subtitle = is_singular() && isset( $post )  ? get_post_meta( $post->ID, THEMEPREFIX.'_header_subtitle', true ) : null;
		$subtitle = ( $subtitle ) ? '<small>'.$subtitle.'</small>' : null;

		return $before.$html.$subtitle.$after;
	}

/*	Curly Header
	================================================= */
	public function header() {
		get_header();
	}

/*	Curly Footer
	================================================= */
	public function footer() {
		get_footer();
	}

/*	Header Slider
	================================================= */
	public function header_slider() {

		/** Global Slider */
		$global_slider = get_theme_mod( 'header_slider', 0 );

		if( leisure_is_blog() && ! is_single() ){

			/** Individual Slider */
			$header_slider = get_post_meta( get_option( 'page_for_posts' ), THEMEPREFIX.'_header_slider', true );
			$header_image  = get_post_meta( get_option( 'page_for_posts' ), THEMEPREFIX.'_header_image', true );

		} elseif( is_singular() ) {

			/** Individual Slider */
			$header_slider = get_post_meta( get_the_ID(), THEMEPREFIX.'_header_slider', true );
			$header_image  = get_post_meta( get_the_ID(), THEMEPREFIX.'_header_image', true );

		}

		/** Generate Slider */
		if( function_exists( 'putRevSlider' ) ){

			switch( true ){
				case ! empty( $header_slider ) :
					$slider = $header_slider;
					break;
				case ! empty( $header_image ) :
					$slider = null;
					break;
				case ( $global_slider !== 0 && ! empty( $global_slider ) ) :
					$slider = $global_slider;
					break;
				default :
					$slider = null;
			}

			if( $slider ){
				echo '<div id="slider_container">';
				putRevSlider( $slider );
				echo '</div>';
			}

		}
	}


}
$leisure_core = new CurlyThemes();

?>
