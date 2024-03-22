<?php

/**
 * Render Global CSS
 * This will render out all the theme mod's CSS reules
 *
 * @since 4.0
 */
class LeisureRenderCSS{

	/** Colors */
	public $_color_text;
	public $_color_link;
	public $_color_primary;
	public $_color_bg;
	public $_color_bg_box;
	public $_color_h1;
	public $_color_h2;
	public $_color_h3;
	public $_color_h4;
	public $_color_h5;
	public $_color_h6;
	public $_color_footer;
	public $_color_footer_link;
	public $_color_footer_title;
	public $_color_footer_bg;
	public $_color_header_navigation;
	public $_color_header_navigation_text;
	public $_color_header_navigation_special;
	public $_color_header;
	public $_color_header_bg;

	/** SVG */
	public $_svg_dropdown;
	public $_svg_search;
	public $_svg_content_before;

	/** Typography */
	public $_typography;

	/** Settings */
	public $_header_opacity;
	public $_header_height;
	public $_header_align;

	/** Individual Page Settings */
	public $_post_meta;

	/** Setup Sizes */
	public $_boxed;
	public $_layout_style;
	public $_layout_size;
	public $_layout;
	public $_layout_padd;

	public $_layout_header;
	public $_layout_header_size;
	public $_layout_header_style;
	public $_layout_header_pad;
	public $_layout_content;
	public $_layout_content_size;
	public $_layout_content_style;
	public $_layout_content_pad;
	public $_layout_footer;
	public $_layout_footer_size;
	public $_layout_footer_style;
	public $_layout_footer_pad;


	public function __construct(){

		/** Editor Style */
		add_action( 'after_setup_theme', array( $this, 'mce_styles' ) );

		/** Colors */
		$this->_color_text =
			new LeisureColor( get_theme_mod('text_color', '#667279') );
		$this->_color_link =
			new LeisureColor( get_theme_mod('link_color', '#363D40') );
		$this->_color_primary =
			new LeisureColor( get_theme_mod('primary_color', '#C0392B' ) );
		$this->_color_bg =
			new LeisureColor( get_theme_mod('background_color_body', '#ffffff') );
		$this->_color_bg_box =
			new LeisureColor( get_theme_mod('background_color_box', '#ffffff') );
		$this->_color_h1 =
			new LeisureColor( get_theme_mod('color_h1', '#363d40' ) );
		$this->_color_h2 =
			new LeisureColor( get_theme_mod('color_h2', '#363D40' ) );
		$this->_color_h3 =
			new LeisureColor( get_theme_mod('color_h3', '#363D40' ) );
		$this->_color_h4 =
			new LeisureColor( get_theme_mod('color_h4', '#363D40' ) );
		$this->_color_h5 =
			new LeisureColor( get_theme_mod('color_h5', '#C0392B' ) );
		$this->_color_h6 =
			new LeisureColor( get_theme_mod('color_h6', '#363D40' ) );
		$this->_color_footer =
			new LeisureColor( get_theme_mod('footer_color_text', '#667279' ) );
		$this->_color_footer_link =
			new LeisureColor( get_theme_mod('footer_color_links', '#667279' ) );
		$this->_color_footer_title =
			new LeisureColor( get_theme_mod('footer_color_titles', '#363D40' ) );
		$this->_color_footer_bg =
			new LeisureColor( get_theme_mod('footer_color_bg', '#F0F1F2' ) );
		$this->_color_header_navigation =
			new LeisureColor( get_theme_mod('header_navigation', '#ffffff' ) );
		$this->_color_header_navigation_text =
			new LeisureColor( get_theme_mod('header_navigation_text' ) );
		$this->_color_header_navigation_special =
			new LeisureColor( get_theme_mod('header_navigation_special' ) );
		$this->_color_header =
			new LeisureColor( get_theme_mod('header_text_color', '#ffffff' ) );
		$this->_color_header_bg	=
			new LeisureColor( get_theme_mod('header_shading_color', 'rgba(0,0,0, 0.15)' ) );

		if( empty( $this->_color_header_navigation->_color ) ) {
			$this->_color_header_navigation = $this->_color_bg;
		}
		if( empty( $this->_color_header_navigation_text->_color ) ) {
			$this->_color_header_navigation_text = $this->_color_link;
		}
		if( empty( $this->_color_header_navigation_special->_color ) ) {
			$this->_color_header_navigation_special = $this->_color_primary;
		}

		/** SVG */
		$this->_svg_dropdown = '<?xml version="1.0" encoding="UTF-8" standalone="no"?>
					<svg width="40px" height="15px" viewBox="0 0 40 15" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
					    <defs></defs>
					    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
					        <path d="M20,15 L0,15 L10,0 L20,15 Z" id="Triangle-1" fill="'.$this->_color_text.'" sketch:type="MSShapeGroup" transform="translate(10.000000, 7.500000) rotate(-180.000000) translate(-10.000000, -7.500000) "></path>
					    </g>
					</svg>';

		$this->_svg_search = '<?xml version="1.0" encoding="UTF-8" standalone="no"?>
						<svg width="40px" height="23px" viewBox="0 0 40 23" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
						    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
						        <path d="M20,19.6703297 C20,20.1078319 19.8477579,20.4864338 19.5432692,20.806147 C19.2387805,21.1258601 18.8782072,21.2857143 18.4615385,21.2857143 C18.028844,21.2857143 17.6682707,21.1258601 17.3798077,20.806147 L13.2572115,16.4900412 C11.8229095,17.5333157 10.2243678,18.0549451 8.46153846,18.0549451 C7.3156994,18.0549451 6.21995715,17.8214738 5.17427885,17.3545244 C4.12860054,16.8875749 3.22716725,16.2565716 2.46995192,15.4614955 C1.7127366,14.6664194 1.11178107,13.7199145 0.667067308,12.6219523 C0.222353546,11.52399 0,10.3734607 0,9.17032967 C0,7.96719865 0.222353546,6.81666929 0.667067308,5.71870707 C1.11178107,4.62074485 1.7127366,3.6742399 2.46995192,2.8791638 C3.22716725,2.08408771 4.12860054,1.45308441 5.17427885,0.986134959 C6.21995715,0.519185509 7.3156994,0.285714286 8.46153846,0.285714286 C9.60737752,0.285714286 10.7031198,0.519185509 11.7487981,0.986134959 C12.7944764,1.45308441 13.6959097,2.08408771 14.453125,2.8791638 C15.2103403,3.6742399 15.8112959,4.62074485 16.2560096,5.71870707 C16.7007234,6.81666929 16.9230769,7.96719865 16.9230769,9.17032967 C16.9230769,11.0213005 16.426287,12.6997693 15.4326923,14.2057864 L19.5552885,18.5345124 C19.8517643,18.845812 20,19.224414 20,19.6703297 Z M13.8461538,9.17032967 C13.8461538,7.6138315 13.3193162,6.28241453 12.265625,5.1760388 C11.2119338,4.06966308 9.94391767,3.51648352 8.46153846,3.51648352 C6.97915925,3.51648352 5.71114309,4.06966308 4.65745192,5.1760388 C3.60376076,6.28241453 3.07692308,7.6138315 3.07692308,9.17032967 C3.07692308,10.7268278 3.60376076,12.0582448 4.65745192,13.1646205 C5.71114309,14.2709963 6.97915925,14.8241758 8.46153846,14.8241758 C9.94391767,14.8241758 11.2119338,14.2709963 12.265625,13.1646205 C13.3193162,12.0582448 13.8461538,10.7268278 13.8461538,9.17032967 Z" id="Type-something" fill="'.$this->_color_text.'" sketch:type="MSShapeGroup"></path>
						    </g>
						</svg>';

		/** Settings */
		$this->_header_opacity	= $this->header_opacity( get_theme_mod( 'header_shading_color', 'rgba(0,0,0, 0.15)' ) );
		$this->_header_height	= get_theme_mod( 'header_height', 80 );
		$this->_header_align	= get_theme_mod( 'header_align', 'right' );

		/** Setup Post Meta */
		add_action( 'wp_enqueue_scripts', array( $this, 'setup_post_meta' ) );

		/** Render Typography */
		add_action( 'wp_enqueue_scripts', array( $this, 'render_typography' ) );

		/** Render Backgrounds */
		add_action( 'wp_enqueue_scripts', array( $this, 'render_backgrounds' ) );

		/** Render Colors */
		add_action( 'wp_enqueue_scripts', array( $this, 'render_colors' ) );

		/** Render Sizes */
		add_action( 'wp_enqueue_scripts', array( $this, 'render_sizes' ) );

		/** Individual Page Settings */
		add_action( 'wp_enqueue_scripts', array( $this, 'render_settings' ) );

		/** Custom CSS */
		add_action( 'wp_enqueue_scripts', array( $this, 'render_custom' ) );

		/** Render Editor Typography */
		add_action( 'curly_editor_style', array( $this, 'render_typography' ), 10, 1 );
		add_action( 'curly_editor_style_import', array( $this, 'render_editor_typography' ), 10, 1 );

		/** Render Editor Backgrounds */
		add_action( 'curly_editor_style', array( $this, 'render_backgrounds' ), 20, 1 );

		/** Render Editor Colors */
		add_action( 'curly_editor_style', array( $this, 'render_colors' ), 30, 1 );

		/** Render Editor Sizes */
		add_action( 'curly_editor_style', array( $this, 'render_sizes' ), 40, 1 );

		/** Setup Size */
		$this->_layout_style			= esc_attr( get_theme_mod( 'layout_style', 'full' ) );
		$this->_layout						= esc_attr( get_theme_mod( 'layout_pref', 'wide' ) );
		$this->_layout_pad 				= esc_attr( get_theme_mod( 'layout_2_padding', 135 ) );
		$this->_layout_size 			= esc_attr( get_theme_mod( 'layout_2_size', 1440 ) );

		$this->_layout_header_style 	= esc_attr( get_theme_mod( 'layout_style_header', 'stretch' ) );
		$this->_layout_header 				= esc_attr( get_theme_mod( 'layout_size_header', 'wide' ) );
		$this->_layout_header_pad 		= esc_attr( get_theme_mod( 'layout_2_header_padding', 135 ) );
		$this->_layout_header_size 		= esc_attr( get_theme_mod( 'layout_2_header_size', 1440 ) );

		$this->_layout_content_style	= esc_attr( get_theme_mod( 'layout_style_content' ) );
		$this->_layout_content				= esc_attr( get_theme_mod( 'layout_size_content' ) );
		$this->_layout_content_pad 		= esc_attr( get_theme_mod( 'layout_2_content_padding', 135 ) );
		$this->_layout_content_size 	= esc_attr( get_theme_mod( 'layout_2_content_size', 1440 ) );

		$this->_layout_footer_style 	= esc_attr( get_theme_mod( 'layout_style_footer', 'stretch' ) );
		$this->_layout_footer 				= esc_attr( get_theme_mod( 'layout_size_footer', 'wide' ) );
		$this->_layout_footer_pad 		= esc_attr( get_theme_mod( 'layout_2_footer_padding', 135 ) );
		$this->_layout_footer_size 		= esc_attr( get_theme_mod( 'layout_2_footer_size', 1440 ) );

		$this->_layout_header_size 		= empty( $this->_layout_header ) 	? false : $this->_layout_header_size;
		$this->_layout_content_size 	= empty( $this->_layout_content ) ? false : $this->_layout_content_size;
		$this->_layout_footer_size 		= empty( $this->_layout_footer ) 	? false : $this->_layout_footer_size;

		if( $this->_layout_style === 'boxed' || $this->_layout_content === 'boxed' ) {
			$this->_boxed = true;
		}

	}

	/** Editor Styles */
	function mce_styles() {
		add_editor_style( 'editor-style.php' );
	}

	/** Header Opacity */
	public static function header_opacity( $color ){
		if( $color === 'transparent' ){
			return 0;
		} elseif( substr( trim( $color ), 0, 4 ) === 'rgb(' ){
			return 1;
		} elseif( substr( trim( $color ), 0, 4 ) === 'rgba' ){
			$out = trim( $color );
			$out = substr( $out, 5, -1 );
			$out = explode( ',', $out );
			return $out[3];
		} elseif( strlen( trim( $color ) ) === 6 ){
			return 1;
		} elseif( substr( trim( $color ), 0, 1 ) === '#' ){
			return 1;
		} else {
			return 0;
		}
	}

	/** Setup Post Meta */
	function setup_post_meta(){
		$this->_post_meta = leisure_is_blog() && ! is_single( get_queried_object_id() ) ? get_post_meta( get_option( 'page_for_posts' ) ) : get_post_meta( get_queried_object_id() );
	}

	/** Render Typography */
	function render_typography( $echo = false ){

		$fonts = array();

		/** Body Font */
		$fonts = LeisureLoadFont::fonts_array(
			$fonts,
			get_theme_mod( 'font', 'Roboto' ),
			LeisureLoadFont::font_weight( get_theme_mod( 'font_style', 0 ) )
		);

		/** H1 Font */
		$fonts = LeisureLoadFont::fonts_array(
			$fonts,
			get_theme_mod( 'font_h1', 'Domine' ),
			LeisureLoadFont::font_weight( get_theme_mod( 'font_h1_style', 2 ) )
		);

		/** H2 Font */
		$fonts = LeisureLoadFont::fonts_array(
			$fonts,
			get_theme_mod( 'font_h2', 'Domine' ),
			LeisureLoadFont::font_weight( get_theme_mod( 'font_h2_style', 2 ) )
		);

		/** H3 Font */
		$fonts = LeisureLoadFont::fonts_array(
			$fonts,
			get_theme_mod( 'font_h3', 'Domine' ),
			LeisureLoadFont::font_weight( get_theme_mod( 'font_h3_style', 2 ) )
		);

		/** H4 Font */
		$fonts = LeisureLoadFont::fonts_array(
			$fonts,
			get_theme_mod( 'font_h4', 'Domine' ),
			LeisureLoadFont::font_weight( get_theme_mod( 'font_h4_style', 2 ) )
		);

		/** H5 Font */
		$fonts = LeisureLoadFont::fonts_array(
			$fonts,
			get_theme_mod( 'fonts_h5', 'Domine' ),
			LeisureLoadFont::font_weight( get_theme_mod( 'fonts_h5_style', 2 ) )
		);

		/** H6 Font */
		$fonts = LeisureLoadFont::fonts_array(
			$fonts,
			get_theme_mod( 'font_h6', 'Domine' ),
			LeisureLoadFont::font_weight( get_theme_mod( 'font_h6_style', 2 ) )
		);

		/** Blockquote Font */
		$fonts = LeisureLoadFont::fonts_array(
			$fonts,
			get_theme_mod( 'font_blockquote', 'Domine' ),
			LeisureLoadFont::font_weight( get_theme_mod( 'font_blockquote_style', 2 ) )
		);

		/** Menu Font */
		$fonts = LeisureLoadFont::fonts_array(
			$fonts,
			get_theme_mod( 'font_menu', 'Roboto' ),
			LeisureLoadFont::font_weight( get_theme_mod( 'font_menu_style', 2 ) )
		);

		/** Secondary Menu Font */
		$fonts = LeisureLoadFont::fonts_array(
			$fonts,
			get_theme_mod( 'font_secondary_menu', 'Roboto' ),
			LeisureLoadFont::font_weight( get_theme_mod( 'font_secondary_menu_style', 2 ) )
		);

		$this->_typography = $fonts;

		wp_enqueue_style('curly-google-fonts', LeisureLoadFont::fonts( $fonts ) );

		/** Custom Typography */
		$font_body = new LeisureFont(
			get_theme_mod( 'font', 'Roboto' ),
			get_theme_mod( 'font_size', 14 ),
			get_theme_mod( 'font_style', 0 ),
			get_theme_mod( 'font_variant', 0 )
		);
		$font_h1 = new LeisureFont(
			get_theme_mod( 'font_h1', 'Domine' ),
			get_theme_mod( 'font_h1_size', 36 ),
			get_theme_mod( 'font_h1_style', 2 ),
			get_theme_mod( 'font_h1_variant', 0 )
		);
		$font_h2 = new LeisureFont(
			get_theme_mod( 'font_h2', 'Domine' ),
			get_theme_mod( 'font_h2_size', 30 ),
			get_theme_mod( 'font_h2_style', 2 ),
			get_theme_mod( 'font_h2_variant', 0 )
		);
		$font_h3 = new LeisureFont(
			get_theme_mod( 'font_h3', 'Domine' ),
			get_theme_mod( 'font_h3_size', 24 ),
			get_theme_mod( 'font_h3_style', 2 ),
			get_theme_mod( 'font_h3_variant', 0 )
		);
		$font_h4 = new LeisureFont(
			get_theme_mod( 'font_h4', 'Domine' ),
			get_theme_mod( 'font_h4_size', 18 ),
			get_theme_mod( 'font_h4_style', 2 ),
			get_theme_mod( 'font_h4_variant', 0 )
		);
		$font_h5 = new LeisureFont(
			get_theme_mod( 'font_h5', 'Domine' ),
			get_theme_mod( 'font_h5_size', 16 ),
			get_theme_mod( 'font_h5_style', 2 ),
			get_theme_mod( 'font_h5_variant', 0 )
		);
		$font_h6 = new LeisureFont(
			get_theme_mod( 'font_h6', 'Domine' ),
			get_theme_mod( 'font_h6_size', 16 ),
			get_theme_mod( 'font_h6_style', 2 ),
			get_theme_mod( 'font_h6_variant', 0 )
		);
		$font_quote = new LeisureFont(
			get_theme_mod( 'font_blockquote', 'Domine' ),
			get_theme_mod( 'font_blockquote_size', 18 ),
			get_theme_mod( 'font_blockquote_style', 2 ),
			get_theme_mod( 'font_blockquote_variant', 0 )
		);
		$font_menu = new LeisureFont(
			get_theme_mod( 'font_menu', 'Roboto' ),
			get_theme_mod( 'font_menu_size', 14 ),
			get_theme_mod( 'font_menu_style', 2 ),
			get_theme_mod( 'font_menu_variant', 2 )
		);
		$font_sec_menu = new LeisureFont(
			get_theme_mod( 'font_secondary_menu', 'Roboto' ),
			get_theme_mod( 'font_secondary_menu_size', 14 ),
			get_theme_mod( 'font_secondary_menu_style', 2 ),
			get_theme_mod( 'font_secondary_menu_variant', 2 )
		);

		$css = "
			body, p, li, #footer{
				$font_body->_family
				$font_body->_style
				$font_body->_variant
				$font_body->_rem
			}
			h1, .h1,
			.page-title,
			.pricing-row h3{
				$font_h1->_family
				$font_h1->_style
				$font_h1->_variant
				$font_h1->_rem
			}
			h2, .h2,
			#logo{
				$font_h2->_family
				$font_h2->_style
				$font_h2->_variant
				$font_h2->_rem
			}
			h3, .h3{
				$font_h3->_family
				$font_h3->_style
				$font_h3->_variant
				$font_h3->_rem
			}
			h4, .h4,
			.panel-title,
			.nav-tabs > li > a{
				$font_h4->_family
				$font_h4->_style
				$font_h4->_variant
				$font_h4->_rem
			}
			h5, .h5{
				$font_h5->_family
				$font_h5->_style
				$font_h5->_variant
				$font_h5->_rem
			}
			h6 .h6{
				$font_h6->_family
				$font_h6->_style
				$font_h6->_variant
				$font_h6->_rem
			}
			blockquote,
			blockquote p,
			.pullquote{
				$font_quote->_family
				$font_quote->_style
				$font_quote->_variant
				$font_quote->_rem
			}
			blockquote cite{
				$font_body->_rem
			}
			#main-nav ul.menu > .menu-item > a,
			#main-nav div.menu > ul > li[class*=page-item] > a{
				$font_menu->_family
				$font_menu->_style
				$font_menu->_variant
				$font_menu->_rem
			}
			#secondary-nav .menu-item > a,
			#secondary-nav .menu-item .nav_desc{
				$font_sec_menu->_family
				$font_sec_menu->_style
				$font_sec_menu->_variant
				$font_sec_menu->_rem
			}
			#footer .widget-title,
			.services-carousel p,
			.meta,
			.isotope p{
				$font_body->_rem
			}
			.absolute-header,
			.absolute-header span,
			.absolute-header em{
				$font_sec_menu->_family
				$font_sec_menu->_style
				$font_sec_menu->_variant
				font-size: ".(round($font_body->_size/1.15/10 , 1))."rem;
			}
			.dropcap{
				$font_quote->_family
			}
			#footer,
			#footer p,
			#footer li{
				font-size: ".(($font_body->_size - 2) / 10 )."rem
			}
			.input-sm,
			.btn-sm{
				font-size: ".(($font_body->_size - 2) / 10 )."rem
			}
			.input-lg,
			.btn-lg{
				font-size: ".(($font_body->_size + 2) / 10 )."rem
			}
			.ninja-forms-form .ninja-forms-all-fields-wrap .field-wrap{
				$font_body->_rem
			}
			input[type=text],
			input[type=search],
			input[type=password],
			input[type=email],
			input[type=number],
			input[type=url],
			input[type=date],
			input[type=tel],
			select,
			textarea,
			.form-control,
			input[type=submit],
			input[type=submit]:hover,
			input[type=button],
			input[type=button]:hover,
			.btn{
				$font_sec_menu->_family
				$font_sec_menu->_rem
			}
			button.vc_general{
				$font_sec_menu->_family
			}
		";

		if( $echo === true ){
			echo apply_filters( 'leisure_minify_css', htmlspecialchars_decode( $css ) );
		} else {
			wp_add_inline_style( 'leisure-style', apply_filters( 'leisure_minify_css', htmlspecialchars_decode( $css ) ) );
		}
	}

	/** Render Sizes */
	function render_sizes( $echo = false, $css = '' ){

		/* !Layout */
		if( $this->_layout_header === 'custom' ){

			switch ( $this->_layout_header_style ){

				case 'stretch' : {

					$css .= ".layout-header-size-custom #header .main-wrapper{
						max-width: {$this->_layout_header_size}px;
					}";

				} break;

				case 'boxed' : {

					$css .= ".layout-header-size-custom #header{
						max-width: " . ( $this->_layout_header_size + $this->_layout_header_pad * 2 ) . "px;
					}
					.layout-header-size-custom #header .main-wrapper{
						max-width: {$this->_layout_header_size}px;
					}";

				} break;

				case 'full' : {

					$css .= "
						@media (min-width: 992px) {
							.layout-header-size-custom #header .main-wrapper{
								padding: 0 " . round( $this->_layout_header_pad / 2 ) . "px;
							}
						}
						@media (min-width: 1200px) {
							.layout-header-size-custom #header .main-wrapper{
								padding: 0 {$this->_layout_header_pad}px;
							}
						}
					";

				} break;

				case 'transparent' : {

					$css .= ".layout-header-size-custom #header .main-wrapper{
						max-width: {$this->_layout_header_size}px;
					}";

				} break;

				default : {

					if( $this->_layout_style === 'boxed' ){

						$css .= ".layout-header-size-custom #header{
							max-width: " . ( $this->_layout_header_size + $this->_layout_header_pad * 2 ) . "px;
						}
						.layout-header-size-custom #header .main-wrapper{
							max-width: {$this->_layout_header_size}px;
						}";

					} else {

						$css .= "
							@media (min-width: 992px) {
								.layout-header-size-custom #header .main-wrapper{
									padding: 0 " . round( $this->_layout_header_pad / 2 ) . "px;
								}
							}
							@media (min-width: 1200px) {
								.layout-header-size-custom #header .main-wrapper{
									padding: 0 {$this->_layout_header_pad}px;
								}
							}
						";

					}

				} break;

			}

		}


		if( $this->_layout_header_size === false && $this->_layout === 'custom' ){

			if( $this->_layout_style === 'boxed' ){

				$css .= ".layout-header-size-inherit #header{
					max-width: " . ( $this->_layout_size + $this->_layout_pad * 2 ) . "px;
				}
				.layout-header-size-inherit #header .main-wrapper{
					max-width: {$this->_layout_size}px;
				}";

			} else {

				$css .= "
					@media (min-width: 992px) {
						.layout-header-size-custom #header .main-wrapper,
						.layout-header-size-inherit.layout-size-custom #header .main-wrapper{
							padding: 0 " . round( $this->_layout_pad / 2 ) . "px;
						}
					}
					@media (min-width: 1200px) {
						.layout-header-size-custom #header .main-wrapper,
						.layout-header-size-inherit.layout-size-custom #header .main-wrapper{
							padding: 0 {$this->_layout_pad}px;
						}
					}
				";

			}

		}


		if( $this->_layout_content === 'custom' ){

			switch ( $this->_layout_content_style ){

				case 'boxed' : {

					$css .= ".layout-content-size-custom #content{
						max-width: " . ( $this->_layout_content_size + $this->_layout_content_pad * 2 ) . "px;
					}
					.layout-content-size-custom #content .main-wrapper{
						max-width: {$this->_layout_content_size}px;
					}";

				} break;

				case 'full' : {

					if( $this->_layout_content_size === false ){
						$css .= ".layout-content-size-inherit #content{
							max-width: " . ( $this->_layout_content_size + $this->_layout_content_pad * 2 ) . "px;
						}
						.layout-content-size-inherit #content .main-wrapper{
							max-width: {$this->_layout_content_size}px;
						}";
					}

					$css .= "
						@media (min-width: 992px) {
							.layout-content-size-custom #content .main-wrapper{
								padding: 0 " . round( $this->_layout_content_pad / 2 ) . "px;
							}
						}
						@media (min-width: 1200px) {
							.layout-content-size-custom #content .main-wrapper{
								padding: 0 {$this->_layout_content_pad}px;
							}
						}
					";

				} break;

				default : {

					if( $this->_layout_style === 'boxed' ){

						$css .= ".layout-content-size-custom #content{
							max-width: " . ( $this->_layout_content_size + $this->_layout_content_pad * 2 ) . "px;
						}
						.layout-content-size-custom #content .main-wrapper{
							max-width: {$this->_layout_content_size}px;
						}";

					} else {

						$css .= "
							@media (min-width: 992px) {
								.layout-content-size-custom #content .main-wrapper{
									padding: 0 " . round( $this->_layout_content_pad / 2 ) . "px;
								}
							}
							@media (min-width: 1200px) {
								.layout-content-size-custom #content .main-wrapper{
									padding: 0 {$this->_layout_content_pad}px;
								}
							}
						";

					}

				} break;

			}

		}


		if( $this->_layout_content_size === false && $this->_layout === 'custom' ){

			if( $this->_layout_style === 'boxed' ){

				$css .= ".layout-content-size-inherit #content{
					max-width: " . ( $this->_layout_size + $this->_layout_pad * 2 ) . "px;
				}
				.layout-content-size-inherit #content .main-wrapper{
					max-width: {$this->_layout_size}px;
				}";

			} else {

				$css .= "
					@media (min-width: 992px) {
						.layout-content-size-custom #content .main-wrapper,
						.layout-content-inherit.layout-size-custom #content .main-wrapper{
							padding: 0 " . round( $this->_layout_pad / 2 ) . "px;
						}
					}
					@media (min-width: 1200px) {
						.layout-content-size-custom #content .main-wrapper,
						.layout-content-inherit.layout-size-custom #content .main-wrapper{
							padding: 0 {$this->_layout_pad}px;
						}
					}
				";

			}

		}


		if( $this->_layout_footer === 'custom' ){

			switch ( $this->_layout_footer_style ){

				case 'stretch' : {

					$css .= ".layout-footer-size-custom #footer .main-wrapper{
						max-width: {$this->_layout_footer_size}px;
					}";

				} break;

				case 'boxed' : {

					$css .= ".layout-footer-size-custom #footer{
						max-width: " . ( $this->_layout_footer_size + $this->_layout_footer_pad * 2 ) . "px;
					}
					.layout-footer-size-custom #footer .main-wrapper{
						max-width: {$this->_layout_footer_size}px;
					}";

				} break;

				case 'full' : {

					$css .= "
						@media (min-width: 992px) {
							.layout-footer-size-custom #footer .main-wrapper{
								padding: 0 " . round( $this->_layout_footer_pad / 2 ) . "px;
							}
						}
						@media (min-width: 1200px) {
							.layout-footer-size-custom #footer .main-wrapper{
								padding: 0 {$this->_layout_footer_pad}px;
							}
						}
					";

				} break;

				case 'transparent' : {

					$css .= ".layout-footer-size-custom #footer .main-wrapper{
						max-width: {$this->_layout_footer_size}px;
					}";

				} break;

				default : {

					if( $this->_layout_style === 'boxed' ){

						$css .= ".layout-footer-size-custom #footer{
							max-width: " . ( $this->_layout_footer_size + $this->_layout_footer_pad * 2 ) . "px;
						}
						.layout-footer-size-custom #footer .main-wrapper{
							max-width: {$this->_layout_footer_size}px;
						}";

					} else {

						$css .= "
							@media (min-width: 992px) {
								.layout-footer-size-custom #footer .main-wrapper{
									padding: 0 " . round( $this->_layout_footer_pad / 2 ) . "px;
								}
							}
							@media (min-width: 1200px) {
								.layout-footer-size-custom #footer .main-wrapper{
									padding: 0 {$this->_layout_footer_pad}px;
								}
							}
						";

					}

				} break;

			}

		}


		if( $this->_layout_footer_size === false && $this->_layout === 'custom' ){

			if( $this->_layout_style === 'boxed' ){

				$css .= ".layout-footer-size-inherit #footer{
					max-width: " . ( $this->_layout_size + $this->_layout_pad * 2 ) . "px;
				}
				.layout-footer-size-inherit #footer .main-wrapper{
					max-width: {$this->_layout_size}px;
				}";

			} else {

				$css .= "
					@media (min-width: 992px) {
						.layout-footer-size-custom #footer .main-wrapper,
						.layout-footer-size-inherit.layout-size-custom #footer .main-wrapper{
							padding: 0 " . round( $this->_layout_pad / 2 ) . "px;
						}
					}
					@media (min-width: 1200px) {
						.layout-footer-size-custom #footer .main-wrapper,
						.layout-footer-size-inherit.layout-size-custom #footer .main-wrapper{
							padding: 0 {$this->_layout_pad}px;
						}
					}
				";

			}

		}



		/** Navigation Alignment & Size */
		switch ( get_theme_mod( 'header_align', 'right' ) ) {
			case 0 	:
				$header_align = 'right';
				$header_margin = '0';
				break;
			case 1 :
				$header_align = 'center';
				$header_margin = '0';
				break;
			case 2 	:
				$header_align = 'left';
				$header_margin = '2.8rem';
				break;
			default	:
				$header_align = 'right';
				$header_margin = '0';
		}

		$header_height = $this->_header_height;

		$css .= "
			#main-nav ul.menu > .menu-item > a,
			#main-nav div.menu > ul > .page_item > a,
			#logo{
				height: {$header_height}px;
				line-height: {$header_height}px;
			}
			#main-nav ul.menu > .current-menu-item > a,
			#main-nav ul.menu > .current-menu-ancestor > a,
			#main-nav ul.menu > .current_page_parent > a,
			#main-nav div.menu > ul > .current_page_item > a,
			#main-nav div.menu > ul > .current_page_parent > a,
			#main-nav div.menu > ul > .current_page_ancestor > a{
				height: {$header_height}px;
				line-height: ".($header_height - 6)."px;
			}
			.sticky-wrapper #main-nav.stuck ul.menu > .menu-item > a,
			.sticky-wrapper #main-nav.stuck div.menu > ul > .page_item > a{
				height: ".( floor( $header_height / 1.333333333 ) )."px;
				line-height: ".( floor( $header_height / 1.333333333 ) )."px;
			}
			.sticky-wrapper #main-nav.stuck ul.menu > .current-menu-item > a,
			.sticky-wrapper #main-nav.stuck ul.menu > .current-menu-ancestor > a,
			.sticky-wrapper #main-nav.stuck ul.menu > .current_page_parent > a,
			.sticky-wrapper #main-nav.stuck div.menu > ul > .current_page_item > a,
			.sticky-wrapper #main-nav.stuck div.menu > ul > .current_page_parent > a,
			.sticky-wrapper #main-nav.stuck div.menu > ul > .current_page_ancestor > a{
				height: ".( floor( ( $header_height / 1.333333333 ) ) )."px;
				line-height: ".( floor( ( $header_height / 1.333333333 ) - 6) )."px;
			}

			#search-form .search-field{
				height: ".($header_height)."px;
			}
			#search-form .close-search{
				line-height: ".($header_height)."px;
			}
			.sticky-wrapper #main-nav.stuck #search-form .search-field{
				height: ".( floor( ( $header_height / 1.333333333 ) ) )."px;
			}
			.stuck #search-form .close-search{
				line-height: ".( floor( ( $header_height / 1.333333333 ) ) )."px;
			}
			.stuck #logo{
				height: ".( floor( ( $header_height / 1.333333333 ) ) )."px;
				line-height: ".( floor( ( $header_height / 1.333333333 ) ) )."px;
			}
			#main-nav ul.menu,
			#main-nav div.menu > ul{
				float: $header_align;
				margin-left: $header_margin;
			}
			.sticky-wrapper{
				min-height: {$header_height}px !important;
		}";

		if( $echo === true ){
			echo apply_filters( 'leisure_minify_css', htmlspecialchars_decode( $css ) );
		} else {
			wp_add_inline_style( 'leisure-style', apply_filters( 'leisure_minify_css', htmlspecialchars_decode( $css ) ) );
		}


	}

	/** Render Backgrounds */
	function render_backgrounds( $echo = false ){
		$css = "
			html, body{
				background-color: $this->_color_bg;
			}
			#footer{
				background-color: $this->_color_footer_bg;
			}
		";

		if( has_header_image() ){
			$css .= "
				#header{
					background-image: url(".get_header_image().");
				}
			";
		} elseif( get_theme_mod('background_image') !== '' ){
			$css .= "
				#header{
					background-color: $this->_color_header_bg;
				}
			";
		} else {
			$css .= "
				#header{
					background-color: $this->_color_link;
				}
			";
		}

		if( filter_var( get_theme_mod( 'shadow_header' ), FILTER_VALIDATE_BOOLEAN ) ){
			$css .= "#header{
				box-shadow: inset 0px -1px 3px {$this->_color_header_bg->opacity(0.15)};
			}";
		}


		if( filter_var( get_theme_mod( 'shadow_content' ), FILTER_VALIDATE_BOOLEAN ) ){
			$css .= "#footer{
				box-shadow: inset 0px 1px 3px -1px {$this->_color_text->opacity(0.25)};
			}";
		}


		if ( ! $this->_boxed ) {

			$css .= "
				#site{
					background-color: $this->_color_bg;
					background-image: url( ".get_theme_mod('background_image')." );
					background-repeat: ".get_theme_mod('background_repeat').";
					background-position: ".get_theme_mod('background_position_x').";
					background-attachment: ".get_theme_mod('background_attachment').";
				}
			";

			if( $this->_boxed === true ){
				$css .= "
					#content{
						background-color: ".$this->_color_bg_box.";
					}
				";
			}

		} else {
			$css .= "
				#content{
					background-color: ".$this->_color_bg_box.";
				}
			";
		}
		$css .= "
			::selection {
				background: ".$this->_color_primary->opacity(0.9).";
			}
			::-moz-selection{
				background: ".$this->_color_primary->opacity(0.9).";
			}
			input[type=submit],
			input[type=submit]:hover,
			input[type=button],
			input[type=button]:hover{
				background-color: {$this->_color_primary};
			}
			select,
			.chosen-single{
				background-image: url(data:image/svg+xml;base"."64,".CurlyThemes::_encode( $this->_svg_dropdown ).") !important;
			}
			.widget_search .search-field,
			input[type=text]#s,
			.chosen-search > input[type=text],
			#bbp_search{
				background-image: url(data:image/svg+xml;base"."64,".CurlyThemes::_encode( $this->_svg_search ).");
			}
		";

		if( $echo === true ){
			echo apply_filters( 'leisure_minify_css', htmlspecialchars_decode( $css ) );
		} else {
			wp_add_inline_style( 'leisure-style', apply_filters( 'leisure_minify_css', htmlspecialchars_decode( $css ) ) );
		}
	}

	/** Render Colors */
	function render_colors( $echo = false ){

		/** Basic */
		$css = "
			html, body {
				color: $this->_color_text;
			}
			table th{
				color: $this->_color_link;
			}
			#site{
				color: $this->_color_text
			}
			a{
				color: $this->_color_link;
			}
			a:hover,
			.btn:hover{
				color: $this->_color_text;
			}
			::selection {
			  color: ".$this->_color_primary->contrast(1).";
			}
			::-moz-selection {
			  color: ".$this->_color_primary->contrast(1).";
			}
			input[type=submit],
			input[type=submit]:not(.btn-link):hover,
			input[type=button],
			input[type=button]:not(.btn-link):hover{
				border-color: $this->_color_primary;
				color: ".$this->_color_primary->contrast(1).";
			}
			input[type=text],
			input[type=search],
			input[type=password],
			input[type=email],
			input[type=number],
			input[type=url],
			input[type=date],
			input[type=tel],
			select,
			textarea,
			.form-control{
				border-color: ".$this->_color_text->opacity(0.25).";
				background-color: ".( $this->_boxed ===  true ? $this->_color_bg_box : $this->_color_bg ).";
				color: $this->_color_text;
			}
			input[type=text]:focus,
			input[type=search]:focus,
			input[type=password]:focus,
			input[type=email]:focus,
			input[type=number]:focus,
			input[type=url]:focus,
			input[type=date]:focus,
			input[type=tel]:focus,
			select:focus,
			textarea:focus{
				border-color: ".$this->_color_text->opacity(0.65).";
			}
			code{
				color: $this->_color_primary;
			}
			kbd{
				color: ".$this->_color_text->contrast(1)."
			}
			pre{
				color: $this->_color_text;
				border-color: ".$this->_color_text->opacity(0.25)."
			}
			.modal-backdrop{
				background: ".( $this->_boxed ===  true ? $this->_color_bg_box->opacity(100) : $this->_color_bg->opacity(100) ).";
			}
			.form-group[data-required]::before,
			div[data-required]::before{
				color: $this->_color_primary;
			}
			.widget_archive li,
			.widget_pages li,
			.widget_categories li,
			.sidebar-widget li{
				border-color: ".$this->_color_text->opacity(0.25)."
			}
			.owl-theme .owl-controls .owl-nav [class*=owl-]:hover{
				color: $this->_color_primary;
			}
			.owl-theme .owl-controls .owl-nav [class*=owl-]{
				color: $this->_color_link;
			}
			.owl-theme .owl-dots .owl-dot.active span,
			.owl-theme .owl-dots .owl-dot:hover span,
			.owl-theme .owl-controls .owl-nav .owl-next:after,
			.owl-theme .owl-controls .owl-nav .owl-prev:before,
			.owl-theme .owl-dots.active .owl-dot span{
				color: $this->_color_primary;
			}
			.owl-theme .owl-dots .owl-dot.active span,
			.owl-theme .owl-dots .owl-dot:hover span{
				border-color: $this->_color_primary;
			}
			.owl-theme .owl-dots .owl-dot span{
				border-color: ".$this->_color_text->opacity(0.25).";
			}
			#content .vc_toggle_title.vc_toggle_title h4{
				color: $this->_color_link;
			}
			#content .vc_toggle.vc_toggle .wpb_toggle_title_active h4{
				color: $this->_color_primary;
			}
			.services-carousel .item-content{
				border-color: ".$this->_color_text->opacity(0.1).";
			}
			#goog-wm-qt{
				border-color: ".$this->_color_text->opacity(0.25).";
				color: $this->_color_text
			}
			#goog-wm-sb{
				border-color: $this->_color_primary;
				color: ".$this->_color_primary->contrast(1).";
			}
			.fa-boxed{
				color: ".$this->_color_link->contrast(1)."
			}
			.meta .fa{
				color: $this->_color_primary;
			}
			.about-author{
				background-color: ".$this->_color_text->opacity(0.05).";
			}
			.pullquote.pull-left{
				border-right: 3px solid ".$this->_color_text->opacity(0.25).";
			}
			.pullquote.pull-right{
				border-left: 3px solid ".$this->_color_text->opacity(0.25).";
			}
			.isotope .item-content{
				background-color: ".$this->_color_text->opacity(0.05).";
				border-color: ".$this->_color_text->opacity(0.1).";
			}
			.pagination .nav-links .page-numbers{
				background-color: ".$this->_color_text->opacity(0.1).";
				color: $this->_color_text;
			}
			.pagination .nav-links .page-numbers:hover{
				background-color: $this->_color_bg;
				color: $this->_color_text
			}
			.pagination .nav-links .current,
			.pagination .nav-links .current:hover,
			.pagination .nav-links .current:focus{
				background-color: $this->_color_primary;
				border-color: $this->_color_primary;
				color: $this->_color_bg
			}
			.post-navigation{
				border-top: 1px solid ".$this->_color_text->opacity(0.1).";
				border-bottom: 1px solid ".$this->_color_text->opacity(0.1)."
			}
			.post-navigation .nav-previous{
				border-right: 1px solid ".$this->_color_text->opacity(0.1)."
			}
			.post-navigation .nav-previous::before, .post-navigation .nav-next::after{
				color: $this->_color_primary;
			}
			code{
				background-color: ".$this->_color_primary->opacity(0.1)."
			}
			kbd{
				background-color: $this->_color_text;
			}
			pre{
				background-color: ".$this->_color_text->opacity(0.1).";
			}
			#content .vc_toggle.vc_toggle h4{
				background-color: ".$this->_color_text->opacity(0.1).";
			}
			.services-carousel .item:hover .item-content,
			.pricing-table .content-column,
			.vc_toggle_content{
				background-color: ".$this->_color_text->opacity(0.1).";
			}
			.owl-theme .owl-dots .owl-dot.active span,
			.owl-theme .owl-dots .owl-dot:hover span{
				background: $this->_color_primary;
			}
			.list-services a:hover{
				background-color: ".$this->_color_text->opacity(0.05).";
			}
			#goog-wm-sb{
				background-color: $this->_color_primary;
			}
			.fa-boxed{
				background-color: ".$this->_color_link->opacity(0.85).";
			}
			.hi-boxed{
				background-color: {$this->_color_text->opacity(0.05)};
			}


		";

		/** Typography */
		$css .= "
			h1, .h1,
			.color-h1{
				color: $this->_color_h1
			}
			h2, .h2,
			.color-h2{
				color: $this->_color_h2
			}
			h3, .h3,
			.color-h3{
				color: $this->_color_h3
			}
			h4, .h4{
				color: $this->_color_h4
			}
			h5, .h5{
				color: $this->_color_h5
			}
			h6, .h6{
				color: $this->_color_h6
			}
			blockquote p,
			.pullquote,
			.sidebar-widget h5{
				color: $this->_color_text;
			}
			.dropcap{
				color: $this->_color_primary;
			}
			h5:not(.widget-title),
			blockquote{
				color: $this->_color_primary;
			}
			#content h1[style*='center']::after,
			#content h2[style*='center']::after,
			#content h3[style*='center']::after,
			#content h4[style*='center']::after,
			#content h5[style*='center']::after,
			#content h6[style*='center']::after,
			#content h1.text-center::after,
			#content h2.text-center::after,
			#content h3.text-center::after,
			#content h4.text-center::after,
			#content h5.text-center::after,
			#content h6.text-center::after{
				border-bottom-color: $this->_color_primary;
			}
		";

		/** Header */
		$css .= "
			.header-row{
				background-color: $this->_color_header_bg;
				color: {$this->_color_header->opacity(0.75)};
			}
			.absolute-header a{
				color: {$this->_color_header->opacity(0.75)};
			}
			#main-nav{
				background-color: $this->_color_header_navigation;
				color: $this->_color_text
			}
			#search-form{
				background-color: {$this->_color_header_navigation->opacity(0.95)};
			}
			#search-form .search-field,
			#search-form .close-search,
			#search-form-inline .search-field,
			#custom-search-form{
				color: $this->_color_link
			}
			#search-form .search-field{
				background-color: {$this->_color_header_navigation->opacity(1)};
				color: $this->_color_text
			}
			#search-form-inline{
				border-top: 1px solid {$this->_color_text->opacity(0.1)};
			}
			#main-nav .sub-menu,
			#main-nav .children{
				background-color: {$this->_color_header_navigation->opacity(0.975)};
				color: $this->_color_header_navigation_special;
				border-color: $this->_color_header_navigation_special;
			}
			#main-nav .menu > .menu-item > a,
			#main-nav .sub-menu .menu-item > a,
			#main-nav .menu > .page_item > a,
			#main-nav .children .page_item > a{
				color: $this->_color_header_navigation_text
			}
			#main-nav .menu > .menu-item:hover:not(.current-menu-item):not(.current-menu-ancestor):not(.current_page_parent):not(.current_page_item) > a{
				color: {$this->_color_header_navigation_text->opacity(0.5)};
			}
			#main-nav .sub-menu .menu-item:hover > a,
			#main-nav .children .page_item:hover > a{
				color: $this->_color_header_navigation_text;
				background: {$this->_color_header_navigation_text->opacity(0.1)};
			}
			#main-nav .menu > .current-menu-item > a,
			#main-nav .menu > .current-menu-ancestor > a,
			#main-nav .menu > .current_page_parent > a,
			#main-nav div.menu > ul > .current_page_item > a,
			#main-nav div.menu > ul > .current_page_parent > a,
			#main-nav div.menu > ul > .current_page_ancestor > a{
				color: $this->_color_header_navigation_special
			}
			@media (max-width:767px) {
				#main-nav ul.menu,
				#main-nav div.menu > ul{
					background-color: $this->_color_header_navigation;
				}
				#main-nav ul.menu > .menu-item > a,
				#main-nav .sub-menu .menu-item > a,
				#main-nav .sub-menu > .menu-item > a::before,
				#main-nav .sub-menu .sub-menu > .menu-item > a::before,
				#main-nav div.menu > ul > .page_item > a{
					border-color: {$this->_color_header_navigation_text->opacity(0.1)}
				}
			}
			#secondary-nav .sub-menu{
				background-color: $this->_color_text;
			}
			#secondary-nav .menu > .menu-item > a{
				color: $this->_color_header;
				border-color: {$this->_color_header->opacity(0.25)};
			}
			#secondary-nav .menu > .menu-item:hover > a{
				color: ".$this->_color_header->opacity(0.65).";
			}
			@media (max-width:767px) {
				#secondary-nav .menu{
					background: ".( $this->_boxed === true ? $this->_color_bg_box : $this->_color_bg ).";
				}
				#secondary-nav .menu > .menu-item{
					border-color: ".$this->_color_text->opacity(0.25).";
				}
				#secondary-nav .menu > .menu-item > a,
				#secondary-nav .menu > .menu-item > a em{
					color: $this->_color_link !important
				}
			}
			.sticky-wrapper #main-nav.stuck{
				background-color: ".$this->_color_header_navigation->opacity(0.97)."
			}
			nav#main-nav,
			nav#secondary-nav{
				border-color: {$this->_color_header->opacity(0.25)};
			}
		";

		/** Footer */
		$css .= "
			#footer,
			#footer abbr{
				color: $this->_color_footer;
			}
			#footer a{
				color: $this->_color_footer_link;
			}
			#footer a:hover{
				color: ".$this->_color_footer_link->opacity(0.5).";
			}
			#footer .widget-title{
				color: $this->_color_footer_title
			}
			#main-footer + #absolute-footer .widget{
				border-top: 1px solid ".$this->_color_footer_title->opacity(0.1)."
			}
		";

		/** Bootstrap Overwrite */
		$css .= "
			.color-primary{
				color: $this->_color_primary
			}
			.color-bg{
				color: $this->_color_bg
			}
			.color-text{
				color: $this->_color_text
			}
			.form-control{
				border-color: ".$this->_color_text->opacity(0.25).";
				color: $this->_color_text
			}
			.form-control:focus{
				border-color: ".$this->_color_text->opacity(0.65).";
			}
			.btn.btn-default{
				color: $this->_color_link;
				border-color: ".$this->_color_link->opacity(0.1).";
				background-color: ".$this->_color_link->opacity(0.1).";
			}
			.btn.btn-default:hover{
				color: $this->_color_link;
				border-color: ".$this->_color_link->opacity(0.25).";
				background-color: ".$this->_color_link->opacity(0.15).";
			}
			.btn.btn-link{
				color: $this->_color_link
			}
			.btn.btn-link::before{
				color: $this->_color_primary
			}
			.btn.btn-link:hover{
				color: $this->_color_text;
			}
			.btn.btn-link:hover::before{
				color: ".$this->_color_primary->darken(20).";
			}
			.btn.btn-primary{
				background-color: $this->_color_primary;
				border-color: $this->_color_primary;
				color: ".$this->_color_primary->contrast(1).";
			}
			.btn.btn-primary:hover{
				background-color: ".$this->_color_primary->darken(20).";
				border-color: ".$this->_color_primary->darken(20).";
				color: ".$this->_color_primary->contrast(1).";
			}
			.list-bullet li::before,
			.list-square li::before,
			.list-center li::before,
			.list-center li::after{
				color: $this->_color_primary
			}
			.list-center li::before,
			.list-center li::after{
				color: $this->_color_primary
			}
			.list-pointer li::before{
				border-color: transparent transparent transparent $this->_color_primary
			}
			.list-services li,
			.panel.panel-default,
			.list-underline{
				border-color: {$this->_color_text->opacity(0.25)}
			}
			.nav-tabs{
				border-color: $this->_color_primary;
			}
			.nav-tabs>li.active>a, .nav-tabs>li.active>a:hover, .nav-tabs>li.active>a:focus{
				background-color: $this->_color_primary;
				border-color: $this->_color_primary;
				color: ".$this->_color_primary->contrast(1)."
			}
			.nav>li>a:hover, .nav>li>a:focus{
				background-color: {$this->_color_text->opacity(0.1)};
			}
			.panel-default > .panel-heading .accordion-toggle.collapsed{
				background-color: {$this->_color_text->opacity(0.1)};
			}
			.panel-default > .panel-heading .accordion-toggle{
				color: $this->_color_primary
			}
			.modal{
				background: ".$this->_color_bg->opacity(0.975)."
			}
			.modal .close{
				color: $this->_color_link
			}
			.modal .close:hover{
				color: $this->_color_primary
			}
			.table>thead>tr>th, .table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td{
				border-top-color: {$this->_color_text->opacity(0.1)}
			}
			.table-hover>tbody>tr:hover>td, .table-hover>tbody>tr:hover>th,
			.table-striped>tbody>tr:nth-child(odd)>td, .table-striped>tbody>tr:nth-child(odd)>th{
				background-color: {$this->_color_text->opacity(0.05)}
			}
			.table>thead>tr>th{
				border-bottom-color: $this->_color_primary
			}
			.well{
				background-color: {$this->_color_text->opacity(0.05)};
				border-color: {$this->_color_text->opacity(0.1)}
			}
		";

		/** WordPress */
		$css .= "
			.entry{
				border-color: ".$this->_color_text->opacity(0.25)."
			}
			.entry-meta,
			.entry-meta a,
			.entry h1 > small,
			.entry h2 > small,
			.entry h3 > small,
			.entry.quote blockquote > small{
				color: $this->_color_primary;
			}
			.entry.format-quote{
				background-color: {$this->_color_text->opacity(0.1)};
			}
			#wp-calendar thead th,
			#wp-calendar tbody td{
				border-color: ".$this->_color_text->opacity(0.1)."
			}
			#wp-calendar thead th{
				background-color: ".$this->_color_text->opacity(0.05).";
			}
			#wp-calendar caption{
				background-color: $this->_color_primary;
				border-color: $this->_color_primary;
				color: $this->_color_bg
			}
			.entry.sticky,
			.wp-caption-text{
				color: $this->_color_text;
				background: ".$this->_color_text->opacity(0.1).";
			}
			.comment-reply-link::before,
			#comments .bypostauthor h2{
				color: $this->_color_primary;
			}
			#comments .child-comments{
				border-left: 1px solid ".$this->_color_text->opacity(0.25).";
			}
			#comments h2{
				border-bottom: 1px solid ".$this->_color_text->opacity(0.25).";
			}
		";

		/** Templating */
		$css .= "
			#map-description .col-lg-4 > div{
				background-color: $this->_color_bg;
				color: $this->_color_text
			}
			.white-box{
				background-color: {$this->_color_bg->opacity(0.85)};
			}
			.person-mini img,
			.person-large img{
				border-color: {$this->_color_text->opacity(0.25)};
			}
			.amenities.full{
				border-bottom-color: {$this->_color_text->opacity(0.15)};
			}
			.amenities.full .col-xs-6{
				border-right-color: {$this->_color_text->opacity(0.15)};
			}
			.amenities.full .col-xs-6::after{
				border-top-color: {$this->_color_text->opacity(0.15)};
			}
			.fs-lightbox-overlay,
			.fs-lightbox,
			.fs-lightbox-meta{
				background: $this->_color_bg;
				color: $this->_color_text
			}
			.isotope-filter .selected a{
				color: $this->_color_primary;
			}
			.stars-rating input + span::after{
				color: {$this->_color_text->opacity(0.55)}
			}
			.stars-rating label[class^='stars-']:hover{
				background-color: {$this->_color_text->opacity(0.05)}
			}
			.stars-rating input:checked + span::after{
				color: $this->_color_primary
			}
			.stars-rating{
				border-bottom-color: {$this->_color_text->opacity(0.1)}
			}
			.stars-rating::after{
				color: $this->_color_primary
			}
			.review-content{
				border-top-color: {$this->_color_text->opacity(0.1)}
			}
			.room-listing-row{
				border-bottom-color: {$this->_color_text->opacity(0.1)}
			}
			.overlay-primary-50 .overlay{
				background-color: {$this->_color_primary->opacity(0.5)}
			}
			.overlay-primary-60 .overlay{
				background-color: {$this->_color_primary->opacity(0.6)}
			}
			.overlay-primary-70 .overlay{
				background-color: {$this->_color_primary->opacity(0.7)}
			}
			.overlay-primary-80 .overlay{
				background-color: {$this->_color_primary->opacity(0.8)}
			}
			.overlay-primary-90 .overlay{
				background-color: {$this->_color_primary->opacity(0.9)}
			}
			.overlay-bg-50 .overlay{
				background-color: {$this->_color_bg->opacity(0.5)}
			}
			.overlay-bg-60 .overlay{
				background-color: {$this->_color_bg->opacity(0.6)}
			}
			.overlay-bg-70 .overlay{
				background-color: {$this->_color_bg->opacity(0.7)}
			}
			.overlay-bg-80 .overlay{
				background-color: {$this->_color_bg->opacity(0.8)}
			}
			.overlay-bg-90 .overlay{
				background-color: {$this->_color_bg->opacity(0.9)}
			}
			.overlay-text-50 .overlay{
				background-color: {$this->_color_bg->opacity(0.5)}
			}
			.overlay-text-60 .overlay{
				background-color: {$this->_color_bg->opacity(0.6)}
			}
			.overlay-text-70 .overlay{
				background-color: {$this->_color_bg->opacity(0.7)}
			}
			.overlay-text-80 .overlay{
				background-color: {$this->_color_bg->opacity(0.8)}
			}
			.overlay-text-90 .overlay{
				background-color: {$this->_color_bg->opacity(0.9)}
			}
		";

		if( $echo === true ){
			if( $this->_boxed ===  true ){
				$css .= "
				html, body {
					background-color: $this->_color_bg_box;
				}";
			}
			echo apply_filters( 'leisure_minify_css', htmlspecialchars_decode( $css ) );
		} else {
			wp_add_inline_style( 'leisure-style', apply_filters( 'leisure_minify_css', htmlspecialchars_decode( $css ) ) );
		}
	}

	/** Render Settings */
	function render_settings(){
		//if( leisure_is_blog() && ! is_single( get_queried_object_id() ) ) echo 'da'; else echo 'nu';
		function check_for_blog(){
			if( leisure_is_blog() && ! is_single( get_queried_object_id() ) ) return true; else return false;
		}

		if( ! in_array( true, array( is_single( get_queried_object_id() ), is_page( get_queried_object_id() ), check_for_blog() ) ) ) return;

		$header_img 	=
			isset( $this->_post_meta[THEMEPREFIX.'_header_image'] ) ?  $this->_post_meta[THEMEPREFIX.'_header_image'][0] : '';
		$header_size	=
			isset( $this->_post_meta[THEMEPREFIX.'_header_height'] ) ? $this->_post_meta[THEMEPREFIX.'_header_height'][0] : '';
		$header_height	=
			isset( $this->_post_meta[THEMEPREFIX.'_header_height_value'] ) ? $this->_post_meta[THEMEPREFIX.'_header_height_value'][0] : '';
		$header_slider	=
			isset( $this->_post_meta[THEMEPREFIX.'_header_slider'] ) ? $this->_post_meta[THEMEPREFIX.'_header_slider'][0] : '';
		$header_align	=
			isset( $this->_post_meta[THEMEPREFIX.'_header_align'] ) ? $this->_post_meta[THEMEPREFIX.'_header_align'][0] : '';
		$header_color	=
			isset( $this->_post_meta[THEMEPREFIX.'_header_text'] ) ? new LeisureColor( $this->_post_meta[THEMEPREFIX.'_header_text'][0] ) : '';
		$header_bg		=
			isset( $this->_post_meta[THEMEPREFIX.'_header_bg_color'] ) ?
			new LeisureColor( $this->_post_meta[THEMEPREFIX.'_header_bg_color'][0] ) : '';
		$bg_color		=
			isset( $this->_post_meta[THEMEPREFIX.'_bg_color'] ) ? new LeisureColor( $this->_post_meta[THEMEPREFIX.'_bg_color'][0] ) : '';
		$bg_image		=
			isset( $this->_post_meta[THEMEPREFIX.'_bg_image'] ) ? $this->_post_meta[THEMEPREFIX.'_bg_image'][0] : '';
		$bg_position	=
			isset( $this->_post_meta[THEMEPREFIX.'_bg_position'] ) ? $this->_post_meta[THEMEPREFIX.'_bg_position'][0] : '';
		$bg_repeat		=
			isset( $this->_post_meta[THEMEPREFIX.'_bg_repeat'] ) ? $this->_post_meta[THEMEPREFIX.'_bg_repeat'][0] : '';
		$bg_size		=
			isset( $this->_post_meta[THEMEPREFIX.'_bg_size'] ) ? $this->_post_meta[THEMEPREFIX.'_bg_size'][0] : '';
		$bg_att			=
			isset( $this->_post_meta[THEMEPREFIX.'_bg_attachment'] ) ? $this->_post_meta[THEMEPREFIX.'_bg_attachment'][0] : '';

		$css = null;

		/** Header Image */
		if( $header_img ){
			$css .= "
				#header#header{
					background-image: url( $header_img );
					background-size: cover;
					background-position: center top;
				}
			";
		}

		/** Header Size */
		if ( $header_size == 1 && $header_img ) {
			list( $width, $height, $type, $attr ) = getimagesize( $header_img );
		}
		if ( $header_size == 3 ) {
			$height = $header_height;
		}
		if ( ! empty( $height ) ) {
			$css .= "
				#header{
					min-height: ".$height."px !important;
				}
			";
		}

		/** Header Slider */
		if( ! empty( $header_slider ) ){
			$css .= "
				#header{
					background-image: none;
					background-color: transparent;
				}
			";
		}

		/** Title Color */
		if ( ! empty( $header_color ) && $header_color->life() ) {
			$css .= "
				#page-heading .page-title{
					color: $header_color;
					text-shadow: none;
				}
			";
		}

		/** Header Color */
		if ( ! empty( $header_bg ) && $header_bg->life() ) {
			$css .= "
				.header-row{
					background-color: $header_bg
				}
			";
		}

		/** Background Color */
		if ( ! empty( $bg_color ) && $bg_color->life() ) {
			$css .= "
				#site,
				#map-description .col-lg-4 > div{
					background-color: $bg_color !important;
				}
			";
		}

		/** Background Image */
		if ( $bg_image ) {
			switch ( $bg_position ) {
				case 0 : $bg_position = 'left'; break;
				case 1 : $bg_position = 'center'; break;
				case 2 : $bg_position = 'right'; break;
				default: $bg_position = 'left';
			}
			switch ( $bg_repeat ) {
				case 0 : $bg_repeat = 'repeat'; break;
				case 1 : $bg_repeat = 'no-repeat'; break;
				case 2 : $bg_repeat = 'repeat-y'; break;
				case 3 : $bg_repeat = 'repeat-x'; break;
				default: $bg_repeat = 'repeat';
			}
			switch ( $bg_size ) {
				case 0 : $bg_size = 'auto'; break;
				case 1 : $bg_size = 'cover'; break;
				case 2 : $bg_size = 'contain'; break;
				default: $bg_size = 'auto';
			}
			switch ( $bg_att ) {
				case 0 : $bg_att = 'scroll'; break;
				case 1 : $bg_att = 'fixed'; break;
				case 2 : $bg_att = 'local'; break;
				default: $bg_att = 'scroll';
			}

			$layout_content_temp = get_theme_mod( 'layout_style_content' );
			$layout_content_size_temp = get_theme_mod( 'layout_style_content' );


			if( get_theme_mod( 'layout_style', 'full' ) === 'boxed' || ( get_theme_mod( 'layout_style', 'full' ) === 'boxed' && empty( $layout_content_temp ) ) || $layout_content_size_temp === 'boxed' ){
				$css .= "
					#site{
						background-image: url($bg_image);
						background-position: $bg_position;
						background-repeat: $bg_repeat;
						background-size: $bg_size;
						background-attachment: $bg_att;
					}
				";

			} else {
				$css .= "
					body.custom-background{
						background-image: url($bg_image) !important;
						background-position: $bg_position !important;
						background-repeat: $bg_repeat !important;
						background-size: $bg_size !important;
						background-attachment: $bg_att !important;
					}
				";
			}
		}

		/** Header Alignment */
		switch ( $header_align ) {
			case 0 : $header_align = 'left'; break;
			case 1 : $header_align = 'center'; break;
			case 2 : $header_align = 'right'; break;
		}
		$css .= "
			#page-heading .page-title,
			#page-heading .page-title small{
				text-align: $header_align;
			}
		";

		wp_add_inline_style( 'leisure-style', apply_filters( 'leisure_minify_css', htmlspecialchars_decode( $css ) ) );
	}

	/** Render Custom */
	function render_custom(){

		/** Custom CSS */
		$css = esc_html( get_theme_mod( 'custom_css' ) ) . '@media (min-width: 768px) and (max-width: 991px) {' . esc_html( get_theme_mod( 'custom_css_md' ) ) . '} @media (max-width: 767px) {' . esc_html( get_theme_mod( 'custom_css_xs' ) ) . '}';

		wp_add_inline_style( 'leisure-style', apply_filters( 'leisure_minify_css', htmlspecialchars_decode( $css ) ) );
	}

	/** Editor Typography */
	function render_editor_typography() {

		$this->render_typography( false );

		$url = LeisureLoadFont::fonts( $this->_typography );
		echo "@import url('$url');";
	}
}
$leisure_rendercss = new LeisureRenderCSS();
?>
