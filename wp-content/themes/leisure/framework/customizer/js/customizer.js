(function($) {
  "use strict";

  	var api = wp.customize;

	/** Allow JS */
	wp.customize( 'custom_js_check', function( value ) {
		value.bind( function( ) {
			$('#customize-control-custom_js').toggle();
		} );
	} );

  wp.customize( 'code', function( value ) {
	value.bind( function( newval ) {

		if( newval === true ){

			wp.customize.control( 'code_head' ).activate();
			wp.customize.control( 'code_body' ).activate();

		} else{

			wp.customize.control( 'code_head' ).deactivate();
			wp.customize.control( 'code_body' ).deactivate();
		}

	});
});

	/** Check Boxed */
	wp.customize( 'layout_style', function( value ) {
		value.bind( function( newval ) {

			var layoutVal 	= api.control('layout_pref').setting();
			var headerVal 	= api.control('layout_size_header').setting();
			var contentVal 	= api.control('layout_size_content').setting();
			var footerVal 	= api.control('layout_size_footer').setting();

			if( newval === 'boxed' ) {

				api.control('background_color_box').activate();

				if( layoutVal === 'custom' ){

					api.control('layout_2_size').activate();
					api.control('layout_2_padding').activate();

				}

				if( headerVal === 'custom' ){

					api.control('layout_2_header_size').activate();

				}

				if( contentVal === 'custom' ){
					api.control('layout_2_content_size').activate();

				}

				if( footerVal === 'custom' ){
					api.control('layout_2_footer_size').activate();

				}



			} else {

				if( layoutVal === 'custom' ){
					api.control('layout_2_padding').activate();

				}

				api.control('layout_2_size').deactivate();
				api.control('layout_2_header_size').deactivate();
				api.control('layout_2_content_size').deactivate();
				api.control('layout_2_footer_size').deactivate();
				api.control('background_color_box').deactivate();

			}

		} );
	} );


	/** Pref */
	wp.customize( 'layout_pref', function( value ) {
		value.bind( function( newval ) {

			var layoutVal = api.control('layout_style').setting();

			if( newval === 'custom' ){

				if( layoutVal === 'boxed' ){

					api.control('layout_2_size').activate();

				} else {

					api.control('layout_2_size').deactivate();

				}

				api.control('layout_2_padding').activate();

			} else {

				api.control('layout_2_size').deactivate();
				api.control('layout_2_padding').deactivate();

				switch( newval ){

					case 'wide' : {

						api.control('layout_2_size').setting(1440);
						api.control('layout_2_padding').setting(135);

					} break;

					case 'narrow' : {

						api.control('layout_2_size').setting(1280);
						api.control('layout_2_padding').setting(55);

					} break;

					case 'full' : {

						api.control('layout_2_size').setting(1440);
						api.control('layout_2_padding').setting(0);

					} break;

				}

				$('#slider-layout_2_size').slider( 'value', api.control('layout_2_size').setting() );
				$('#slider-layout_2_padding').slider( 'value', api.control('layout_2_padding').setting() );

			}

		} );
	} );

	/** Header Style */
	wp.customize( 'layout_style_header', function( value ) {
		value.bind( function( newval ) {

			var layoutVal = api.control('layout_size_header').setting();

			if( layoutVal === 'custom' ){

				if( newval === '' ){

					newval = api.control('layout_style').setting();

					if( newval !== 'full' ){

						api.control('layout_2_header_size').activate();
						api.control('layout_2_header_padding').activate();

					} else {

						api.control('layout_2_header_size').deactivate();
						api.control('layout_2_header_padding').activate();

					}


				} else if( newval !== 'full' ){

					api.control('layout_2_header_size').activate();

				} else {

					api.control('layout_2_header_size').deactivate();

				}

				api.control('layout_2_header_padding').activate();

			} else {

				api.control('layout_2_header_size').deactivate();
				api.control('layout_2_header_padding').deactivate();

			}

		} );
	} );


	/** Header Size */
	wp.customize( 'layout_size_header', function( value ) {
		value.bind( function( newval ) {

			var layoutVal = api.control('layout_style_header').setting();

			if( newval === 'custom' ){

				if( layoutVal === '' ){

					newval = api.control('layout_style').setting();

					if( newval !== 'full' ){

						api.control('layout_2_header_size').activate();
						api.control('layout_2_header_padding').activate();

					} else {

						api.control('layout_2_header_size').deactivate();
						api.control('layout_2_header_padding').activate();

					}

				} else if( layoutVal !== 'full' ){

					api.control('layout_2_header_size').activate();
					api.control('layout_2_header_padding').activate();

				} else {

					api.control('layout_2_header_size').deactivate();
					api.control('layout_2_header_padding').activate();
				}


			} else {

				api.control('layout_2_header_size').deactivate();
				api.control('layout_2_header_padding').deactivate();

				switch( newval ){

					case 'wide' : {

						api.control('layout_2_header_size').setting(1440);
						api.control('layout_2_header_padding').setting(135);

					} break;

					case 'narrow' : {

						api.control('layout_2_header_size').setting(1280);
						api.control('layout_2_header_padding').setting(55);

					} break;

					case 'full' : {

						api.control('layout_2_header_size').setting(1440);
						api.control('layout_2_header_padding').setting(0);

					} break;

					case '' : {

						api.control('layout_2_header_size').setting( api.control('layout_2_size').setting() );
						api.control('layout_2_header_padding').setting( api.control('layout_2_padding').setting() );

					} break;

				}

				$('#slider-layout_2_header_size').slider( 'value', api.control('layout_2_header_size').setting() );
				$('#slider-layout_2_header_padding').slider( 'value', api.control('layout_2_header_padding').setting() );

			}

		} );
	} );


	/** Content Style */
	wp.customize( 'layout_style_content', function( value ) {
		value.bind( function( newval ) {

			var layoutVal = api.control('layout_size_content').setting();

			if( layoutVal === 'custom' ){

				if( newval === '' ){

					newval = api.control('layout_style').setting();

					if( newval !== 'full' ){

						api.control('layout_2_content_size').activate();
						api.control('layout_2_content_padding').activate();

					} else {

						api.control('layout_2_content_size').deactivate();
						api.control('layout_2_content_padding').activate();

					}


				} else if( newval !== 'full' ){

					api.control('layout_2_content_size').activate();

				} else {

					api.control('layout_2_content_size').deactivate();

				}

				api.control('layout_2_content_padding').activate();

			} else {

				api.control('layout_2_content_size').deactivate();
				api.control('layout_2_content_padding').deactivate();

			}

		} );
	} );


	/** Content Size */
	wp.customize( 'layout_size_content', function( value ) {
		value.bind( function( newval ) {

			var layoutVal = api.control('layout_style_content').setting();

			if( newval === 'custom' ){

				if( layoutVal === '' ){

					newval = api.control('layout_style').setting();

					if( newval !== 'full' ){

						api.control('layout_2_content_size').activate();
						api.control('layout_2_content_padding').activate();

					} else {

						api.control('layout_2_content_size').deactivate();
						api.control('layout_2_content_padding').activate();

					}

				} else if( layoutVal !== 'full' ){

					api.control('layout_2_content_size').activate();
					api.control('layout_2_content_padding').activate();

				} else {

					api.control('layout_2_content_size').deactivate();
					api.control('layout_2_content_padding').activate();
				}


			} else {

				api.control('layout_2_content_size').deactivate();
				api.control('layout_2_content_padding').deactivate();

				switch( newval ){

					case 'wide' : {

						api.control('layout_2_content_size').setting(1440);
						api.control('layout_2_content_padding').setting(135);

					} break;

					case 'narrow' : {

						api.control('layout_2_content_size').setting(1280);
						api.control('layout_2_content_padding').setting(55);

					} break;

					case 'full' : {

						api.control('layout_2_content_size').setting(1440);
						api.control('layout_2_content_padding').setting(0);

					} break;

					case '' : {

						api.control('layout_2_content_size').setting( api.control('layout_2_size').setting() );
						api.control('layout_2_content_padding').setting( api.control('layout_2_padding').setting() );

					} break;

				}

				$('#slider-layout_2_content_size').slider( 'value', api.control('layout_2_content_size').setting() );
				$('#slider-layout_2_content_padding').slider( 'value', api.control('layout_2_content_padding').setting() );

			}

		} );
	} );


	/** Footer Style */
	wp.customize( 'layout_style_footer', function( value ) {
		value.bind( function( newval ) {

			var layoutVal = api.control('layout_size_footer').setting();

			if( layoutVal === 'custom' ){

				if( newval === '' ){

					newval = api.control('layout_style').setting();

					if( newval !== 'full' ){

						api.control('layout_2_footer_size').activate();
						api.control('layout_2_footer_padding').activate();

					} else {

						api.control('layout_2_footer_size').deactivate();
						api.control('layout_2_footer_padding').activate();

					}


				} else if( newval !== 'full' ){

					api.control('layout_2_footer_size').activate();

				} else {

					api.control('layout_2_footer_size').deactivate();

				}

				api.control('layout_2_footer_padding').activate();

			} else {

				api.control('layout_2_footer_size').deactivate();
				api.control('layout_2_footer_padding').deactivate();

			}

		} );
	} );


	/** Footer Size */
	wp.customize( 'layout_size_footer', function( value ) {
		value.bind( function( newval ) {

			var layoutVal = api.control('layout_style_footer').setting();

			if( newval === 'custom' ){

				if( layoutVal === '' ){

					newval = api.control('layout_style').setting();

					if( newval !== 'full' ){

						api.control('layout_2_footer_size').activate();
						api.control('layout_2_footer_padding').activate();

					} else {

						api.control('layout_2_footer_size').deactivate();
						api.control('layout_2_footer_padding').activate();

					}

				} else if( layoutVal !== 'full' ){

					api.control('layout_2_footer_size').activate();
					api.control('layout_2_footer_padding').activate();

				} else {

					api.control('layout_2_footer_size').deactivate();
					api.control('layout_2_footer_padding').activate();
				}


			} else {

				api.control('layout_2_footer_size').deactivate();
				api.control('layout_2_footer_padding').deactivate();

				switch( newval ){

					case 'wide' : {

						api.control('layout_2_footer_size').setting(1440);
						api.control('layout_2_footer_padding').setting(135);

					} break;

					case 'narrow' : {

						api.control('layout_2_footer_size').setting(1280);
						api.control('layout_2_footer_padding').setting(55);

					} break;

					case 'full' : {

						api.control('layout_2_footer_size').setting(1440);
						api.control('layout_2_footer_padding').setting(0);

					} break;

					case '' : {

						api.control('layout_2_footer_size').setting( api.control('layout_2_size').setting() );
						api.control('layout_2_footer_padding').setting( api.control('layout_2_padding').setting() );

					} break;

				}

				$('#slider-layout_2_footer_size').slider( 'value', api.control('layout_2_footer_size').setting() );
				$('#slider-layout_2_footer_padding').slider( 'value', api.control('layout_2_footer_padding').setting() );

			}

		} );
	} );


	/** Check for Sticky */
	wp.customize( 'sticky_menu', function( value ) {
		value.bind( function( newval ) {
			if( newval === false ) {
				$('#customize-control-logo_sticky').hide();
				$('#customize-control-logo_retina_sticky').hide();
			} else {
				$('#customize-control-logo_sticky').show();
				$('#customize-control-logo_retina_sticky').show();
			}
		} );
	} );

	/** Ratings Summary */
	wp.customize( 'rooms', function( value ) {
		value.bind( function() {
			wp.customize.control( 'rating_1' ).toggle();
			wp.customize.control( 'rating_2' ).toggle();
			wp.customize.control( 'rating_3' ).toggle();
			wp.customize.control( 'rating_4' ).toggle();
		} );
	} );

	/** Color Scheme */
	wp.customize( 'scheme_color', function( value ) {
		value.bind( function( newval ) {
			if( newval === '1' ) {
				wp.customize.control('background_color_body').setting('#141414');
				wp.customize.control('background_color_box').setting('#141414');
				wp.customize.control('text_color').setting('#90887d');
				wp.customize.control('link_color').setting('#ad854d');
				wp.customize.control('primary_color').setting('#ad854d');
				wp.customize.control('header_navigation').setting('rgba(20,20,20,0.92)');
				wp.customize.control('header_navigation_text').setting('#ffffff');
				wp.customize.control('header_navigation_special').setting('#ad854d');
				wp.customize.control('header_text_color').setting('#a59d90');
				wp.customize.control('header_shading_color').setting('rgba(20,20,20,0.8)');
				wp.customize.control('footer_color_bg').setting('#0a0a0a');
				wp.customize.control('footer_color_text').setting('#717171');
				wp.customize.control('footer_color_links').setting('#717171');
				wp.customize.control('footer_color_titles').setting('#ffffff');
				wp.customize.control('color_h1').setting('#ffffff');
				wp.customize.control('color_h2').setting('#ffffff');
				wp.customize.control('color_h3').setting('#ffffff');
				wp.customize.control('color_h4').setting('#ffffff');
				wp.customize.control('color_h5').setting('#ad854d');
				wp.customize.control('color_h6').setting('#ffffff');
			} else {
				wp.customize.control('background_color_body').setting('#ffffff');
				wp.customize.control('background_color_box').setting('#ffffff');
				wp.customize.control('text_color').setting('#667279');
				wp.customize.control('link_color').setting('#363D40');
				wp.customize.control('primary_color').setting('#C0392B');
				wp.customize.control('header_navigation').setting('#ffffff');
				wp.customize.control('header_navigation_text').setting('#363D40');
				wp.customize.control('header_navigation_special').setting('#C0392B');
				wp.customize.control('header_text_color').setting('#ffffff');
				wp.customize.control('header_shading_color').setting('rgba(0, 0, 0, 0.15)');
				wp.customize.control('footer_color_bg').setting('#F0F1F2');
				wp.customize.control('footer_color_text').setting('#667279');
				wp.customize.control('footer_color_links').setting('#667279');
				wp.customize.control('footer_color_titles').setting('#363D40');
				wp.customize.control('color_h1').setting('#363d40');
				wp.customize.control('color_h2').setting('#363d40');
				wp.customize.control('color_h3').setting('#363d40');
				wp.customize.control('color_h4').setting('#363d40');
				wp.customize.control('color_h5').setting('#C0392B');
				wp.customize.control('color_h6').setting('#363d40');
			}
		} );
	} );

	/** Font Pairings */
	wp.customize( 'scheme_font', function( value ) {
		value.bind( function( newval ) {
			if( newval === '1' ) {
				wp.customize.control('font').setting('Roboto Condensed');
				wp.customize.control('font_style').setting(0);
				wp.customize.control('font_variant').setting(0);
				wp.customize.control('font_size').setting(15);

				wp.customize.control('font_menu').setting('Josefin Sans');
				wp.customize.control('font_menu_style').setting(2);
				wp.customize.control('font_menu_variant').setting(2);
				wp.customize.control('font_menu_size').setting(16);

				wp.customize.control('font_secondary_menu').setting('Roboto Condensed');
				wp.customize.control('font_secondary_menu_style').setting(2);
				wp.customize.control('font_secondary_menu_variant').setting(2);
				wp.customize.control('font_secondary_menu_size').setting(16);

				wp.customize.control('font_h1').setting('Josefin Sans');
				wp.customize.control('font_h1_style').setting(3);
				wp.customize.control('font_h1_variant').setting(2);
				wp.customize.control('font_h1_size').setting(42);

				wp.customize.control('font_h2').setting('Josefin Sans');
				wp.customize.control('font_h2_style').setting(3);
				wp.customize.control('font_h2_variant').setting(2);
				wp.customize.control('font_h2_size').setting(38);

				wp.customize.control('font_h3').setting('Josefin Sans');
				wp.customize.control('font_h3_style').setting(3);
				wp.customize.control('font_h3_variant').setting(2);
				wp.customize.control('font_h3_size').setting(26);

				wp.customize.control('font_h4').setting('Josefin Sans');
				wp.customize.control('font_h4_style').setting(2);
				wp.customize.control('font_h4_variant').setting(2);
				wp.customize.control('font_h4_size').setting(20);

				wp.customize.control('font_h5').setting('Josefin Sans');
				wp.customize.control('font_h5_style').setting(2);
				wp.customize.control('font_h5_variant').setting(2);
				wp.customize.control('font_h5_size').setting(22);

				wp.customize.control('font_h6').setting('Josefin Sans');
				wp.customize.control('font_h6_style').setting(2);
				wp.customize.control('font_h6_variant').setting(2);
				wp.customize.control('font_h6_size').setting(16);

				wp.customize.control('font_blockquote').setting('Domine');
				wp.customize.control('font_blockquote_style').setting(2);
				wp.customize.control('font_blockquote_variant').setting(2);
				wp.customize.control('font_blockquote_size').setting(16);
			} else {
				wp.customize.control('font').setting('Roboto');
				wp.customize.control('font_style').setting(0);
				wp.customize.control('font_variant').setting(0);
				wp.customize.control('font_size').setting(14);

				wp.customize.control('font_menu').setting('Roboto');
				wp.customize.control('font_menu_style').setting(2);
				wp.customize.control('font_menu_variant').setting(2);
				wp.customize.control('font_menu_size').setting(14);

				wp.customize.control('font_secondary_menu').setting('Roboto');
				wp.customize.control('font_secondary_menu_style').setting(2);
				wp.customize.control('font_secondary_menu_variant').setting(2);
				wp.customize.control('font_secondary_menu_size').setting(14);

				wp.customize.control('font_h1').setting('Domine');
				wp.customize.control('font_h1_style').setting(2);
				wp.customize.control('font_h1_variant').setting(0);
				wp.customize.control('font_h1_size').setting(36);

				wp.customize.control('font_h2').setting('Domine');
				wp.customize.control('font_h2_style').setting(2);
				wp.customize.control('font_h2_variant').setting(0);
				wp.customize.control('font_h2_size').setting(30);

				wp.customize.control('font_h3').setting('Domine');
				wp.customize.control('font_h3_style').setting(2);
				wp.customize.control('font_h3_variant').setting(0);
				wp.customize.control('font_h3_size').setting(24);

				wp.customize.control('font_h4').setting('Domine');
				wp.customize.control('font_h4_style').setting(2);
				wp.customize.control('font_h4_variant').setting(0);
				wp.customize.control('font_h4_size').setting(18);

				wp.customize.control('font_h5').setting('Domine');
				wp.customize.control('font_h5_style').setting(2);
				wp.customize.control('font_h5_variant').setting(0);
				wp.customize.control('font_h5_size').setting(16);

				wp.customize.control('font_h6').setting('Domine');
				wp.customize.control('font_h6_style').setting(2);
				wp.customize.control('font_h6_variant').setting(0);
				wp.customize.control('font_h6_size').setting(14);

				wp.customize.control('font_blockquote').setting('Domine');
				wp.customize.control('font_blockquote_style').setting(2);
				wp.customize.control('font_blockquote_variant').setting(0);
				wp.customize.control('font_blockquote_size').setting(18);
			}
		} );
	} );

})(jQuery);
