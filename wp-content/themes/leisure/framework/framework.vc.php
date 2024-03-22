<?php

	class LeisureVisualComposer {

		public function __construct() {

			/** We safely integrate with VC with this hook */
			add_action( 'init', array( $this, 'integrateWithVC' ) );

			add_action( 'admin_init', array( $this, 'hide_notices') );
			add_action( 'admin_enqueue_scripts', array( $this, 'admin_assets' ) );
			add_filter( 'site_transient_update_plugins', array($this, 'hide_updates' ) );

			/** Construct Row */
			add_action( 'vc_before_init', array( $this, 'construct_row' ) );

			/** Construct Icon */
			add_action( 'vc_before_init', array( $this, 'icon_vc' ) );

			/** Filter Inline CSS */
			add_filter( 'curly_vc_css', array( $this, 'inline_css' ), 10, 2 );

			/** Video Bg */
			add_filter( 'curly_video_bg', array( $this, 'video_bg' ), 10, 5 );

			/** Parallax Layer */
			add_filter( 'curly_parallax_layer', array( $this, 'parallax_layer' ), 10, 8 );

		}


		function hide_updates( $value ){
			if( isset( $value->response['js-composer/js_composer.php'] ) ){
				unset( $value->response['js-composer/js_composer.php'] );
			}

		    return $value;
		}


		function hide_notices(){
			setcookie('vchideactivationmsg', '1', strtotime('+3 years'), '/');
	    setcookie('vchideactivationmsg_vc11', (defined('WPB_VC_VERSION') ? WPB_VC_VERSION : '1'), strtotime('+3 years'), '/');
		}


		function admin_assets(){
			wp_enqueue_style( 'curly-admin-vc', get_template_directory_uri() . '/framework/assets/admin/css/admin.css', null, null, 'all');
		}



		/** Parallax Layer */
		function parallax_layer( $layer, $vertical, $horizontal, $ratio, $width, $height, $index, $style ){
			if( empty( $layer ) ) return;

			$src = wp_get_attachment_image_src( $layer, 'full' );
			$vertical = ! empty( $vertical ) ? "$vertical;" : '';
			$horizontal = ! empty( $horizontal ) ? "$horizontal;" : '';
			$width = ! empty( $width ) ? "width: $width;" : '';
			$height = ! empty( $height ) ? "height: $height;" : '';
			$index = ! empty( $index ) ? "z-index: $index;" : '';
			$style = $style === 'yes' ? 'parallax-image' : '';

			return "<img src='{$src[0]}' alt='' style='position: absolute; $vertical $horizontal $width $height $index' data-stellar-ratio='$ratio' class='hidden-xs $style'>";
		}



		/** Video Bg */
		function video_bg( $cover, $video, $mp4, $ogg, $webm ){

			$html = array();

			$cover = wp_get_attachment_image_src($cover, 'full');
			$cover = isset( $cover[0] ) ? $cover[0] : '';

			if( ! empty( $video ) ){
				$html[] = "data-video-bg='video'";
				$html[] = "data-video-cover='$cover'";
				$html[] = "data-video-video='$video'";

				return $html;
			}

			if( ! empty( $mp4 ) && ! empty( $ogg ) && ! empty( $webm ) ){
				$html[] = "data-video-bg='html5'";
				$html[] = "data-video-cover='$cover'";
				$html[] = "data-video-mp4='$mp4'";
				$html[] = "data-video-ogg='$ogg'";
				$html[] = "data-video-webm='$webm'";

				return $html;
			}

			return $html;
		}



		/** Inline CSS */
		function inline_css( $min_height, $background_position ){

			$css_array = array();
			$html 	= '';

			if( $min_height ) $css_array[ 'min-height' ] = $min_height;
			if( $background_position ) $css_array[ 'background-position' ] = $background_position . ' !important';

			if( isset($css_array) ){
				foreach( $css_array as $key => $property ){
					$html .= $key . ':' . $property . ';';
				}
			}


			return "style='$html'";
		}

		/** VC Integration */
		public function integrateWithVC() {
	        if ( ! defined( 'WPB_VC_VERSION' ) ) {
	            return;
	        } else {

        		/** Add Video Type */
						CurlyThemes::_add_vc_function( 'curly_video_file', array( $this, 'video_file' ) , get_template_directory_uri().'/framework/js/video_file.js' );

        		/** Construct Images Carousel Params */
        		$this->construct_images_carousel();

        		/** Construct Image Gallery Params */
        		$this->construct_gallery();

        		/** Remove Elements */
        		vc_remove_element("vc_tour");

        		/** Remove Params */
        		vc_remove_param("vc_images_carousel", "mode");
        		vc_remove_param("vc_images_carousel", "partial_view");
        		vc_remove_param("vc_images_carousel", "img_size");
        		vc_remove_param("vc_gallery", "type");
        		vc_remove_param("vc_gallery", "interval");
        		vc_remove_param("vc_tabs", "interval");
        		vc_remove_param("vc_row", "video_bg");
        		vc_remove_param("vc_row", "video_bg_url");
        		vc_remove_param("vc_row", "video_bg_parallax");

        		/** Update Parameters */
        		add_action( 'admin_init', array( $this, 'update_parameters' ) );

	        }
	    }

	    /** Update Parameters */
	    function update_parameters(){

		    /** Image Gallery - Size */
		    $param = WPBMap::getParam( 'vc_gallery', 'img_size' );
		    $param['description'] = __( 'Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. ', 'leisure' );
		    vc_update_shortcode_param( 'vc_gallery', $param );
	    }

	    /** Check is values are set */
	    public static function check_against( $check, $arg_1 = null, $arg_2 = null, $pre = null, $suf = null, $empty = false ) {

	    	/** Check Arguments */
	    	if ( isset( $arg_1 ) && isset( $arg_2 ) ) {
	    		if ( $empty == true && empty( $check ) ) {
	    			$out = isset( $check ) ? $arg_2 : null;
	    		} else {
	    			$out = isset( $check ) ? $arg_1 : $arg_2;
	    		}
	    	} elseif ( isset( $arg_1 ) ) {
	    		$out = isset( $check ) ? $arg_1 : null;
	    	} elseif ( isset( $check ) ){
	    		$out = $check;
	    	} else {
	    		$out = null;
	    	}

	    	/** Check for empty */
	    	if ( $empty == true ) {
	    		if ( empty( $out ) ) {
	    			$out = null;
	    		}
	    	}

	    	/** Add Prefix & Suffix */
	    	if ( isset( $out ) && isset( $pre ) ) {
	    		$temp = $pre.$out;
	    		$out = $temp;
	    	}

	    	if ( isset( $out ) && isset( $suf ) ) {
	    		$out = $out.$suf;
	    	}

	    	/** Return */
	    	if ( isset( $out ) ) {
	    		return $out;
	    	} else {
	    		return;
	    	}

	    }

		/** Show notice if your plugin is activated but Visual Composer is not */
	    public function showVcVersionNotice() {
	        $plugin_data = get_plugin_data(__FILE__);
	        echo '
	        <div class="updated">
	          <p>'. sprintf( __( '<strong>%s WordPress Theme</strong> requires <strong>Visual Composer plugin to be installed and activated on your site.', 'leisure'), wp_get_theme()->get( 'Name' ) ).'</p>
	        </div>';
	    }

	    /** Visual Composer Icon Shortcode */
	    public function icon_vc() {

	    	vc_map( array(
	    		"name" => __("FontAwesome Icon", "leisure"),
	    		"base" => "icon",
	    		"show_settings_on_create" => true,
	    		"admin_enqueue_css" => array( get_template_directory_uri().'/framework/css/vc-icon.css' ),
	    		"icon" => "curly_icon",
	    		"class" => "",
	    		"category" => __('Curly Themes Extension', "leisure"),
	    		"params" =>
	    			array(
		    			array(
		    				"type" => "textfield",
		    				"heading" => __("FontAwesome Icon", 'leisure'),
		    				"param_name" => "icon",
		    				"description" => __( "You can find a list of all icons available here: <a href='http://fortawesome.github.io/Font-Awesome/icons/' target='_blank'>http://fortawesome.github.io/Font-Awesome/icons/</a>", "leisure" )
		    			),
		    			array(
		    				"type" => "dropdown",
		    				"heading" => __("Icon Size", 'leisure'),
		    				'edit_field_class' => 'vc_col-sm-4 vc_column',
		    				"param_name" => "size",
		    				"value"	=> array(
		    					__('Normal Size', 'leisure') => '',
		    					__('Double Size (2x)', 'leisure') => '2x',
		    					__('Triple Size (3x)', 'leisure') => '3x',
		    					__('Quadruple Size (4x)', 'leisure') => '4x',
		    					__('Quintuple Size (5x)', 'leisure') => '5x'
		    				)
		    			),
		    			array(
		    				"type" => "colorpicker",
		    				"heading" => __("Icon Color", 'leisure'),
		    				'edit_field_class' => 'vc_col-sm-4 vc_column',
		    				"param_name" => "color",
		    			),
		    			array(
		    				"type" => "colorpicker",
		    				"heading" => __("Background Color", 'leisure'),
		    				'edit_field_class' => 'vc_col-sm-4 vc_column',
		    				"param_name" => "background",
		    			),
		    			array(
		    				"type" => "dropdown",
		    				"heading" => __("Border Size", 'leisure'),
		    				'edit_field_class' => 'vc_col-sm-4 vc_column',
		    				"param_name" => "border_size",
		    				'std' => '',
		    				"value" => array( __('Choose size', 'leisure') => '', '1px', '2px', '3px', '4px', '5px', '6px', '7px', '8px', '9px', '10px')
		    			),
		    			array(
		    				"type" => "dropdown",
		    				"heading" => __("Border Style", 'leisure'),
		    				'edit_field_class' => 'vc_col-sm-4 vc_column',
		    				"param_name" => "border_style",
		    				'std' => '',
		    				"value" => array( __('Choose style', 'leisure') => '', 'solid', 'dotted', 'dashed', 'double', 'groove', 'ridge')
		    			),
		    			array(
		    				"type" => "colorpicker",
		    				"heading" => __("Border Color", 'leisure'),
		    				'edit_field_class' => 'vc_col-sm-4 vc_column',
		    				"param_name" => "border_color"
		    			)
	    			)
	    		)
	    	);
	    }



		function normalize_filters(&$item1, $key){
			$item1 = strtolower( sanitize_file_name( $item1 ) );
		}





		/** Video File Param Type */
		public function video_file( $settings, $value ) {

		   return '<div class="button_param">'
		   			 .'<input readonly name="'.$settings['param_name']
		             .'" class="wpb_vc_param_value wpb-textinput '
		             .$settings['param_name'].' '.$settings['type'].'_field" type="text" value="'
		             .$value.'" style="margin-bottom: 10px" />'
		             .'<input class="vc_btn vc_upload_video vc_panel-btn-save vc_btn-primary" type="button" value="'
		             .__('Choose Video', 'leisure').'" style="width: auto" />'
		             .'<input class="vc_btn vc_clear_video vc_panel-btn-save vc_btn-danger" type="button" value="'
		             .__('Clear Video', 'leisure').'" style="width: auto; margin-left: 10px;" />'
		         .'</div>';
		}

		/** Extend VC Row */
		public function construct_row() {

			/** Keep Grid */
			$attributes = array(
				'type' => 'checkbox',
				'heading' => __("Keep content aligned to site grid", "leisure"),
				'param_name' => 'grid'

			);
			vc_add_param('vc_row', $attributes);

			/** Background Image Position */
			$attributes = array(
				'type' => 'dropdown',
				'heading' => __("Background Image Position", 'leisure'),
				'param_name' => 'position',
				'value' => array(
					__('Theme Defaults', 'leisure') => '',
					__('Top Left', 'leisure') 		=> 'left top',
					__('Top Center', 'leisure') 		=> 'center top',
					__('Top Right', 'leisure') 		=> 'right top',
					__('Middle Left', 'leisure') 	=> 'left center',
					__('Middle Center', 'leisure')	=> 'center center',
					__('Middle Right', 'leisure') 	=> 'right center',
					__('Bottom Left', 'leisure') 	=> 'left bottom',
					__('Bottom Center', 'leisure') 	=> 'center bottom',
					__('Bottom Right', 'leisure') 	=> 'right bottom',
				),
				'group' => __( 'Design Options', 'leisure' )
			);
			vc_add_param('vc_row', $attributes);

			/** Minimum Height */
			$attributes = array(
				'type' => 'textfield',
				'heading' => __("Minimum Image Height (Optional)", "leisure"),
				'param_name' => 'min_height',
				"description" => __("Enter the minimum height value in pixels for this row", "leisure"),
				'group' => __( 'Design Options', 'leisure' )

			);
			vc_add_param('vc_row', $attributes);

			/** Parallax Speed */
			$attributes = array(
				'type' => 'textfield',
				'heading' => __("Parallax Ratio", "leisure"),
				'param_name' => 'parallax_ratio',
				'group' => __( 'Parallax', 'leisure' ),
				"description" => __("Enter the parallax ratio (ie. 0.5)", "leisure"),
				'dependency' => array(
					'element' => 'parallax',
					'value' => array( 'yes', 'true' )
				)
			);
			vc_add_param('vc_row', $attributes);

			/** Enable Parallax Layers */
			$attributes = array(
				'type' => 'checkbox',
				'heading' => __("Enable Parallax Layers", "leisure"),
				'param_name' => 'parallax_layers',
				'value' => array( __( 'Yes, enable parallax layers for this container', 'leisure' ) => 'yes' ),
				'group' => __( 'Parallax', 'leisure' )
			);
			vc_add_param('vc_row', $attributes);

			/** Parallax Offset Parrent */
			$attributes = array(
				'type' => 'textfield',
				'heading' => __("Offset Parallax Layers", "leisure"),
				'param_name' => 'parallax_offset',
				'edit_field_class' => 'vc_col-sm-6 vc_column',
				'group' => __( 'Parallax', 'leisure' ),
				"description" => __("Yes, apply style to images", "leisure"),
				'dependency' => array(
					'element' => 'parallax_layers',
					'value' => array( 'yes', 'true' )
				)
			);
			vc_add_param('vc_row', $attributes);

			/** Parallax Style */
			$attributes = array(
				'type' => 'checkbox',
				'heading' => __("Style Parallax Images", "leisure"),
				'param_name' => 'style_images',
				'edit_field_class' => 'vc_col-sm-6 vc_column',
				'group' => __( 'Parallax', 'leisure' ),
				'value' => array( __( 'Yes, style the parallax images', 'leisure' ) => 'yes' ),
				'dependency' => array(
					'element' => 'parallax_layers',
					'value' => array( 'yes', 'true' )
				)
			);
			vc_add_param('vc_row', $attributes);

			/** Parallax Layer #1 Image */
			$attributes = array(
				'type' => 'attach_image',
				'heading' => __("Parallax Layer 1", "leisure"),
				'param_name' => 'layer_1',
				'group' => __( 'Parallax', 'leisure' ),
				"description" => __("Choose an image as parallax layer", "leisure"),
				'dependency' => array(
					'element' => 'parallax_layers',
					'value' => array( 'yes', 'true' )
				)
			);
			vc_add_param('vc_row', $attributes);

			/** Parallax Layer #1 Vertical Value */
			$attributes = array(
				'type' => 'textfield',
				'heading' => __("Layer 1 Vertical", "leisure"),
				'param_name' => 'layer_1_vertical',
				'edit_field_class' => 'vc_col-sm-4 vc_column',
				'group' => __( 'Parallax', 'leisure' ),
				"description" => __("Parallax layer 1 vertical position (ie: top: 50px)", "leisure"),
				'dependency' => array(
					'element' => 'layer_1',
					'not_empty'=> true
				)
			);
			vc_add_param('vc_row', $attributes);

			/** Parallax Layer #1 Horizontal Value */
			$attributes = array(
				'type' => 'textfield',
				'heading' => __("Layer 1 Horizontal", "leisure"),
				'param_name' => 'layer_1_horizontal',
				'edit_field_class' => 'vc_col-sm-4 vc_column',
				'group' => __( 'Parallax', 'leisure' ),
				"description" => __("Parallax layer 1 horizontal position (ie: left: 25%)", "leisure"),
				'dependency' => array(
					'element' => 'layer_1',
					'not_empty'=> true
				)
			);
			vc_add_param('vc_row', $attributes);

			/** Parallax Layer #1 Radio */
			$attributes = array(
				'type' => 'textfield',
				'heading' => __("Layer 1 Parallax Ratio", "leisure"),
				'param_name' => 'layer_1_ratio',
				'edit_field_class' => 'vc_col-sm-4 vc_column',
				'group' => __( 'Parallax', 'leisure' ),
				"description" => __("Enter the parallax ratio (ie. 0.5)", "leisure"),
				'dependency' => array(
					'element' => 'layer_1',
					'not_empty'=> true
				)
			);
			vc_add_param('vc_row', $attributes);

			/** Parallax Layer #1 Radio */
			$attributes = array(
				'type' => 'textfield',
				'heading' => __("Layer 1 Width", "leisure"),
				'param_name' => 'layer_1_width',
				'edit_field_class' => 'vc_col-sm-4 vc_column',
				'group' => __( 'Parallax', 'leisure' ),
				"description" => __("Leave empty for default", "leisure"),
				'dependency' => array(
					'element' => 'layer_1',
					'not_empty'=> true
				)
			);
			vc_add_param('vc_row', $attributes);

			/** Parallax Layer #1 Radio */
			$attributes = array(
				'type' => 'textfield',
				'heading' => __("Layer 1 Height", "leisure"),
				'param_name' => 'layer_1_height',
				'edit_field_class' => 'vc_col-sm-4 vc_column',
				'group' => __( 'Parallax', 'leisure' ),
				"description" => __("Leave empty for default", "leisure"),
				'dependency' => array(
					'element' => 'layer_1',
					'not_empty'=> true
				)
			);
			vc_add_param('vc_row', $attributes);

			/** Parallax Layer #1 Radio */
			$attributes = array(
				'type' => 'textfield',
				'heading' => __("Layer 1 z-index", "leisure"),
				'param_name' => 'layer_1_z',
				'edit_field_class' => 'vc_col-sm-4 vc_column',
				'group' => __( 'Parallax', 'leisure' ),
				"description" => __("Leave empty for default", "leisure"),
				'dependency' => array(
					'element' => 'layer_1',
					'not_empty'=> true
				)
			);
			vc_add_param('vc_row', $attributes);

			/** Parallax Layer #2 Image */
			$attributes = array(
				'type' => 'attach_image',
				'heading' => __("Parallax Layer 2", "leisure"),
				'param_name' => 'layer_2',
				'group' => __( 'Parallax', 'leisure' ),
				"description" => __("Choose an image as parallax layer", "leisure"),
				'dependency' => array(
					'element' => 'layer_1',
					'not_empty'=> true
				)
			);
			vc_add_param('vc_row', $attributes);

			/** Parallax Layer #2 Vertical Value */
			$attributes = array(
				'type' => 'textfield',
				'heading' => __("Layer 2 Vertical", "leisure"),
				'param_name' => 'layer_2_vertical',
				'edit_field_class' => 'vc_col-sm-4 vc_column',
				'group' => __( 'Parallax', 'leisure' ),
				"description" => __("Parallax layer 2 vertical position (ie: top: 50px)", "leisure"),
				'dependency' => array(
					'element' => 'layer_2',
					'not_empty'=> true
				)
			);
			vc_add_param('vc_row', $attributes);

			/** Parallax Layer #2 Horizontal Value */
			$attributes = array(
				'type' => 'textfield',
				'heading' => __("Layer 2 Horizontal", "leisure"),
				'param_name' => 'layer_2_horizontal',
				'edit_field_class' => 'vc_col-sm-4 vc_column',
				'group' => __( 'Parallax', 'leisure' ),
				"description" => __("Parallax layer 2 horizontal position (ie: left: 25%)", "leisure"),
				'dependency' => array(
					'element' => 'layer_2',
					'not_empty'=> true
				)
			);
			vc_add_param('vc_row', $attributes);

			/** Parallax Layer #2 Radio */
			$attributes = array(
				'type' => 'textfield',
				'heading' => __("Layer 2 Parallax Ratio", "leisure"),
				'param_name' => 'layer_2_ratio',
				'edit_field_class' => 'vc_col-sm-4 vc_column',
				'group' => __( 'Parallax', 'leisure' ),
				"description" => __("Enter the parallax ratio (ie. 0.5)", "leisure"),
				'dependency' => array(
					'element' => 'layer_2',
					'not_empty'=> true
				)
			);
			vc_add_param('vc_row', $attributes);

			/** Parallax Layer #1 Radio */
			$attributes = array(
				'type' => 'textfield',
				'heading' => __("Layer 2 Width", "leisure"),
				'param_name' => 'layer_2_width',
				'edit_field_class' => 'vc_col-sm-4 vc_column',
				'group' => __( 'Parallax', 'leisure' ),
				"description" => __("Leave empty for default", "leisure"),
				'dependency' => array(
					'element' => 'layer_2',
					'not_empty'=> true
				)
			);
			vc_add_param('vc_row', $attributes);

			/** Parallax Layer #1 Radio */
			$attributes = array(
				'type' => 'textfield',
				'heading' => __("Layer 2 Height", "leisure"),
				'param_name' => 'layer_2_height',
				'edit_field_class' => 'vc_col-sm-4 vc_column',
				'group' => __( 'Parallax', 'leisure' ),
				"description" => __("Leave empty for default", "leisure"),
				'dependency' => array(
					'element' => 'layer_2',
					'not_empty'=> true
				)
			);
			vc_add_param('vc_row', $attributes);

			/** Parallax Layer #1 Radio */
			$attributes = array(
				'type' => 'textfield',
				'heading' => __("Layer 2 z-index", "leisure"),
				'param_name' => 'layer_2_z',
				'edit_field_class' => 'vc_col-sm-4 vc_column',
				'group' => __( 'Parallax', 'leisure' ),
				"description" => __("Leave empty for default", "leisure"),
				'dependency' => array(
					'element' => 'layer_2',
					'not_empty'=> true
				)
			);
			vc_add_param('vc_row', $attributes);

			/** Parallax Layer #3 Image */
			$attributes = array(
				'type' => 'attach_image',
				'heading' => __("Parallax Layer 3", "leisure"),
				'param_name' => 'layer_3',
				'group' => __( 'Parallax', 'leisure' ),
				"description" => __("Choose an image as parallax layer", "leisure"),
				'dependency' => array(
					'element' => 'layer_2',
					'not_empty'=> true
				)
			);
			vc_add_param('vc_row', $attributes);

			/** Parallax Layer #3 Vertical Value */
			$attributes = array(
				'type' => 'textfield',
				'heading' => __("Layer 3 Vertical", "leisure"),
				'param_name' => 'layer_3_vertical',
				'edit_field_class' => 'vc_col-sm-4 vc_column',
				'group' => __( 'Parallax', 'leisure' ),
				"description" => __("Parallax layer 3 vertical position (ie: top: 50px)", "leisure"),
				'dependency' => array(
					'element' => 'layer_3',
					'not_empty'=> true
				)
			);
			vc_add_param('vc_row', $attributes);

			/** Parallax Layer #3 Horizontal Value */
			$attributes = array(
				'type' => 'textfield',
				'heading' => __("Layer 3 Horizontal", "leisure"),
				'param_name' => 'layer_3_horizontal',
				'edit_field_class' => 'vc_col-sm-4 vc_column',
				'group' => __( 'Parallax', 'leisure' ),
				"description" => __("Parallax layer 3 horizontal position (ie: left: 25%)", "leisure"),
				'dependency' => array(
					'element' => 'layer_3',
					'not_empty'=> true
				)
			);
			vc_add_param('vc_row', $attributes);

			/** Parallax Layer #3 Radio */
			$attributes = array(
				'type' => 'textfield',
				'heading' => __("Layer 3 Parallax Ratio", "leisure"),
				'param_name' => 'layer_3_ratio',
				'edit_field_class' => 'vc_col-sm-4 vc_column',
				'group' => __( 'Parallax', 'leisure' ),
				"description" => __("Enter the parallax ratio (ie. 0.5)", "leisure"),
				'dependency' => array(
					'element' => 'layer_3',
					'not_empty'=> true
				)
			);
			vc_add_param('vc_row', $attributes);

			/** Parallax Layer #1 Radio */
			$attributes = array(
				'type' => 'textfield',
				'heading' => __("Layer 3 Width", "leisure"),
				'param_name' => 'layer_3_width',
				'edit_field_class' => 'vc_col-sm-4 vc_column',
				'group' => __( 'Parallax', 'leisure' ),
				"description" => __("Leave empty for default", "leisure"),
				'dependency' => array(
					'element' => 'layer_3',
					'not_empty'=> true
				)
			);
			vc_add_param('vc_row', $attributes);

			/** Parallax Layer #1 Radio */
			$attributes = array(
				'type' => 'textfield',
				'heading' => __("Layer 3 Height", "leisure"),
				'param_name' => 'layer_3_height',
				'edit_field_class' => 'vc_col-sm-4 vc_column',
				'group' => __( 'Parallax', 'leisure' ),
				"description" => __("Leave empty for default", "leisure"),
				'dependency' => array(
					'element' => 'layer_3',
					'not_empty'=> true
				)
			);
			vc_add_param('vc_row', $attributes);

			/** Parallax Layer #1 Radio */
			$attributes = array(
				'type' => 'textfield',
				'heading' => __("Layer 3 z-index", "leisure"),
				'param_name' => 'layer_3_z',
				'edit_field_class' => 'vc_col-sm-4 vc_column',
				'group' => __( 'Parallax', 'leisure' ),
				"description" => __("Leave empty for default", "leisure"),
				'dependency' => array(
					'element' => 'layer_3',
					'not_empty'=> true
				)
			);
			vc_add_param('vc_row', $attributes);

			/** Video Cover */
			$attributes = array(
				'type' => 'attach_image',
				'heading' => __("Video Background Cover", "leisure"),
				'param_name' => 'video_cover',
				'group' => __( 'Video Background', 'leisure' ),
				"description" => __("Choose an image as your video cover", "leisure")
			);
			vc_add_param('vc_row', $attributes);

			/** External Video */
			$attributes = array(
				'type' => 'textfield',
				'heading' => __("External Video", "leisure"),
				'param_name' => 'video',
				'group' => __( 'Video Background', 'leisure' ),
				"description" => __("Enter the URL of your external YouTube video", "leisure"),
				'dependency' => array(
					'element' => 'video_cover',
					'not_empty'=> true
				)
			);
			vc_add_param('vc_row', $attributes);

			/** MP4 Video File */
			$attributes = array(
				'type' => 'curly_video_file',
				'heading' => __("MP4 File", "leisure"),
				'param_name' => 'video_mp4',
				'group' => __( 'Video Background', 'leisure' ),
				'dependency' => array(
					'element' => 'video_cover',
					'not_empty'=> true
				)
			);
			vc_add_param('vc_row', $attributes);

			/** OGG Video File */
			$attributes = array(
				'type' => 'curly_video_file',
				'heading' => __("OGV File", "leisure"),
				'param_name' => 'video_ogg',
				'group' => __( 'Video Background', 'leisure' ),
				'dependency' => array(
					'element' => 'video_cover',
					'not_empty'=> true
				)
			);
			vc_add_param('vc_row', $attributes);

			/** WEBM Video File */
			$attributes = array(
				'type' => 'curly_video_file',
				'heading' => __("WEBM File", "leisure"),
				'param_name' => 'video_webm',
				'group' => __( 'Video Background', 'leisure' ),
				'dependency' => array(
					'element' => 'video_cover',
					'not_empty'=> true
				)
			);
			vc_add_param('vc_row', $attributes);
		}

		/** Extend VC Images Carousel */
		public function construct_images_carousel() {

			/** Previous Link */
			$attributes = array(
				'type' => 'textfield',
				'heading' => __("Next Link Text", "leisure"),
				'edit_field_class' => 'vc_col-sm-6 vc_column',
				'param_name' => 'next',
				"description" => __("Enter the previous link text", "leisure")
			);
			vc_add_param('vc_images_carousel', $attributes);

			/** Next Link */
			$attributes = array(
				'type' => 'textfield',
				'heading' => __("Previous Link Text", "leisure"),
				'edit_field_class' => 'vc_col-sm-6 vc_column',
				'param_name' => 'prev',
				"description" => __("Enter the previous link text", "leisure")
			);
			vc_add_param('vc_images_carousel', $attributes);

			vc_remove_param( "vc_images_carousel", "autoplay" );
			//vc_remove_param( "vc_images_carousel", "wrap" );
		}


		/** Extend VC Gallery */
		public function construct_gallery() {

			/** Columns */
			$attributes = array(
				'type' => 'dropdown',
				'heading' => __("Gallery Columns", 'leisure'),
				'param_name' => 'columns',
				'value' => array(
					__('Five Columns', 'leisure') => 5,
					__('Four Columns', 'leisure') => 4,
					__('Three Columns', 'leisure') => 3,
					__('Two Columns', 'leisure') => 2,
					__('One Column', 'leisure') => 1,
				)
			);
			vc_add_param('vc_gallery', $attributes);
		}

		/** Set as Theme */
		public static function set_as_theme() {
			vc_set_as_theme( true );

			vc_set_default_editor_post_types( array( 'page', 'post', 'room') );
		}
	}

	/** Check if Visual Composer is Activated */
	if ( defined( 'WPB_VC_VERSION' ) ) {

		/** Initialize the Class */
		new LeisureVisualComposer();

	}

	add_action( 'vc_before_init', array( 'LeisureVisualComposer', 'set_as_theme' ) );


?>
