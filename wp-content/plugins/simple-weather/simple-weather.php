<?php
/*
Plugin Name: Simple Weather
Plugin URI: https://demo.curlythemes.com/weather/
Description: This plugin gives you a simple shortcode & widget to display the weather.
Version: 4.4.1
Author: Curly Themes
Author URI: http://www.curlythemes.com
*/


$sw_atts_array = array();
$sw_feeds_array = array();

define( 'SIMPLER_WEATHER_FILE', __FILE__ );
define( 'SIMPLER_WEATHER_PATH', untrailingslashit( plugin_dir_path( SIMPLER_WEATHER_FILE ) ) );

require_once('class.wp.rest.api.php');
require_once('class.settings.php');


function simple_weather_get_template_part( $slug, $name = '' ) {

    $template = '';

    if ( $name ) {
        $template = locate_template( array( "{$slug}-{$name}.php", apply_filters( 'simple_weather_template_path', 'simple_weather_templates/' ) . "{$slug}-{$name}.php" ) );
    }

    if ( ! $template && $name && file_exists( SIMPLER_WEATHER_PATH . "/templates/{$slug}-{$name}.php" ) ) {
        $template = SIMPLER_WEATHER_PATH . "/templates/{$slug}-{$name}.php";
    }

    if ( ! $template ) {
        $template = locate_template( array( "{$slug}.php", apply_filters( 'simple_weather_template_path', 'simple_weather_templates/' ) . "{$slug}.php" ) );
    }

    if ( ! $template && file_exists( SIMPLER_WEATHER_PATH . "/templates/{$slug}.php" ) ) {
	    $template = SIMPLER_WEATHER_PATH . "/templates/{$slug}.php";
    }

    $template = apply_filters( 'simple_weather_get_template_part', $template, $slug, $name );

    if ( $template ) {
        return $template;
    }
}


if( ! class_exists( 'CurlySimpleWeather' ) ){

	/**
	* Simple Weather
	*/
	class CurlySimpleWeather {

		/** Constructor */
		function __construct(){

			/** Load Scripts */
			add_action( 'wp_enqueue_scripts', array( $this, 'load_scripts' ) );

			/** Textdomain */
			add_action( 'plugins_loaded', array( $this, 'set_textdomain' ) );

			/** Load Widget */
			require_once('simple-weather-widget.php');

			/** Weather Shortcode */
			add_shortcode( 'simple-weather', array( $this, 'weather_shortcode' ) );
			add_action( 'wp_footer', array($this, 'footer') );

            add_filter( 'simple-weather-options', array( $this, 'default_options' ) );

		}

    function default_options(){
      return array(
        'lang_ow' => 'en',
        'lang_ds' => 'en',
        'units' => 'imperial',
        'api_ow' => '',
        'api_ds' => '',
        'async' => true,
        'freq' => 0,
        'timeout' => 30,
        'station' => 'openweather',
        'console_log' => true,
        'api_ipStack' => ''
      );
    }


		public static function get_weather_file_new( $atts ){

      $return = array();

      $options = get_option( 'simple-weather-options', apply_filters( 'simple-weather-options', array() ) );

	$atts['station'] = ! isset( $atts['station'] ) || empty( $atts['station'] ) ? $options['station'] : $atts['station'];
	$atts['station'] = $atts['station'] === 'darksky' ? $atts['station'] : $options['station'];
	$atts['api'] = isset( $atts['api'] ) && ! empty( $atts['api'] ) ? esc_attr( $atts['api'] ) : '';
	$atts['api'] = trim( $atts['api'] );
	$atts['lang'] = isset( $atts['lang'] ) && ! empty( $atts['lang'] ) ? esc_attr( $atts['lang'] ) : '';
	$atts['api'] = empty( $atts['api'] ) && isset( $options['api_ow'] ) && ! empty( $options['api_ow'] ) ? esc_attr( $options['api_ow'] ) : $atts['api'];
	$atts['lang'] = empty( $atts['lang'] ) && isset( $options['lang_ow'] ) && ! empty( $options['lang_ow'] ) ? esc_attr( $options['lang_ow'] ) : 'en';
	$atts['units'] = isset( $atts['units'] ) && ! empty( $atts['units'] ) ? esc_attr( $atts['units'] ) : esc_attr( $options['units'] );
	$atts['freq'] = isset( $atts['freq'] ) && ! empty( $atts['freq'] ) ? intval( $atts['freq'] ) : intval( $options['freq'] );
	$atts['timeout'] = isset( $atts['timeout'] ) && ! empty( $atts['timeout'] ) ? intval( $atts['timeout'] ) : intval( $options['timeout'] );

        $apis = array(
          '3b0095a1f393a1078abe2b5e1e05bcee',
          '88947377c35d3fd16142860b600409f5',
          '5e4c75d656c33b531db6811bcd3dadac',
          'a5ee831f46ebae19e831feeb4cbe2e1c',
          'c17378e872a17f88825519a853a8e52d',
          '1dfdd6d5e5660ce0228defadc1b39ccb',
          'e4bba1baf177bed222b8bd6d34ee7d09',
          '1fda8db4e6a4ee32554c9710525d153e',
          '578ee1253d2b18b6794485e37d2706e9',
          'dad665250260a2362a4863e234cd91da'
        );

        if( empty( $atts['api'] )){
          $atts['api'] 	= $apis[array_rand( $apis, 1 )];
          $atts['freq'] = in_array( $atts['api'], $apis ) ? 120 : $atts['freq'];
        }

        if( empty( $atts['api'] ) || ! $atts['api'] ) return new WP_Error( 'no_api', esc_html__('OpenWeather need an API key', 'simple-weather'), array( 'status' => 403 ) );

        $openweather_route = 'http://api.openweathermap.org/data/2.5/';
        $suffix = '';

        $query_args = array(
          'units' => $atts['units'],
          'lang'  => $atts['lang'],
          'appid' => $atts['api']
        );

				/** Check for auto location */
		if( isset( $atts['location'] ) && $atts['location'] === 'auto' ){
          $location = self::get_location();

          if( is_array( $location ) ){
             $atts['latitude'] = $location[0];
             $atts['longitude'] = $location[1];
          } else if( strlen( $location ) > 0 ){
            $atts['location'] = $location;
          }
		}

		/* Get Open Weather by coordinates */
		if( isset( $atts['latitude'] ) && ! empty( $atts['latitude'] ) && isset( $atts['longitude'] ) && ! empty( $atts['longitude'] ) ){
          $query_args['lat'] = esc_attr( $atts['latitude'] );
          $query_args['lon'] = esc_attr( $atts['longitude'] );
          $suffix = 'onecall';
		}

		/* Get Open Weather by location */
		else if( isset( $atts['location'] ) && ! empty( $atts['location'] ) ){
            $query_args['q'] = esc_attr( $atts['location'] );
            $suffix = 'forecast';
		}

		/* Cannot get weather without location or coordinates */
		else {
			return new WP_Error( 'could_not_get_location', esc_html__('OpenWeather needs a location or latitude & longitude coordinates, in order to show the weather.', 'sd'), array( 'status' => 403 ) );
		}

        if( isset( $atts['show_current'] ) && wp_validate_boolean( $atts['show_current'] ) && $suffix === 'forecast' ){

          $atts['freq'] = isset( $atts['freq'] ) ? intval( $atts['freq'] ) : 120;

          $hash = md5( implode( '', $query_args ) );

          $transient = get_transient( 'sw_dat_cr_' . $hash );

          if( ! $transient || empty( $transient ) ){

            $result = wp_remote_get( esc_url_raw( add_query_arg( $query_args, $openweather_route . 'weather' ) ), array( 'timeout' => intval( $atts['timeout'] ) ) );

            if ( ! is_wp_error( $result ) ) {

              $transient = json_decode( wp_remote_retrieve_body( $result ) );

              $freq = $atts['freq'] > 60 ? 60 : $atts['freq'];

              if( intval( $freq ) > 0 && wp_remote_retrieve_response_code( $result ) === 200 ) set_transient( "sw_dat_cr_$hash", $transient, $freq * MINUTE_IN_SECONDS );

            }

          }

          $return['current'] = $transient;

        }

        $hash = md5( implode( '', $query_args ) );
        $transient = get_transient( 'sw_data_' . $hash );

        if( ! $transient ){
        	if( $suffix === 'onecall' ){
        		$query_args['exclude'] = 'minutely,hourly,alerts';
		        $url = $openweather_route . 'onecall';
	        } else {
		        $url = $openweather_route . 'forecast';
	        }
        	$url_raw = esc_url_raw( add_query_arg( $query_args, $url ) );
            $result = wp_remote_get( $url_raw, array( 'timeout' => intval( $atts['timeout'] ) ) );

          if ( ! is_wp_error( $result ) ) {

            $transient = json_decode( wp_remote_retrieve_body( $result ) );

            $freq = $atts['freq'];

            if( $freq > 0 && wp_remote_retrieve_response_code( $result ) === 200 ) set_transient( "sw_data_$hash", $transient, $freq * MINUTE_IN_SECONDS );

          } else {
            return new WP_Error( 'could_not_get_weather', esc_html__('Could not connect to OpenWeather API', 'simple-weather'), array( 'status' => 503 ) );
          }

        }

            $return['forecast'] = $transient;

			return $return;

		}

		function footer(){

	      global $sw_feeds_array;
	      global $sw_atts_array;

			wp_localize_script( 'simple-weather-main', 'SimpleWeatherAtts', $sw_atts_array );
            wp_localize_script( 'simple-weather-main', 'SimpleWeatherFeeds', $sw_feeds_array );

		}

		/** Load Scripts */
		function load_scripts() {

			if ( ! is_admin() ) {
				wp_enqueue_style( 'simple-weather', plugins_url( '/css/simple-weather.css' , __FILE__ ), null, is_user_logged_in() ? rand() : '4.0'  );

        if( ! wp_script_is( 'vue-js' ) ){
          wp_enqueue_script(
            'vue-js',
            is_user_logged_in() ? plugins_url( '/js/vue.js' , __FILE__ ) : plugins_url( '/js/vue.min.js' , __FILE__ ),
            array( 'jquery' ),
            null,
            true
          );
        }

        if( ! wp_script_is( 'vue-resource' ) ){
          wp_enqueue_script(
            'vue-resource',
            is_user_logged_in() ? plugins_url( '/js/vue-resource.js' , __FILE__ ) : plugins_url( '/js/vue-resource.min.js' , __FILE__ ),
            array( 'vue-js' ),
            null,
            true
          );
        }
				if( ! wp_script_is( 'moment-js' ) ){
          wp_enqueue_script(
            'moment-js',
            is_user_logged_in() ? plugins_url( '/js/moment.js' , __FILE__ ) : plugins_url( '/js/moment.min.js' , __FILE__ ),
            array( 'vue-js' ),
            null,
            true
          );
        }

				wp_enqueue_script( 'simple-weather-main', plugins_url( '/js/simple-weather.js' , __FILE__ ), array( 'jquery', 'vue-js', 'vue-resource', 'moment-js' ), is_user_logged_in() ? rand() : '4.1.1', true );

        global $wp_locale;

        $options = get_option( 'simple-weather-options', apply_filters( 'simple-weather-options', array() ) );

        wp_localize_script( 'simple-weather-main', 'SimpleWeather', array(
          'rest_route' => get_rest_url(),
          'locale' => array(
      			'firstDay' => intval( get_option( 'start_of_week') ),
      			'months' => array_values( $wp_locale->month ),
      			'monthsShort' => array_values( $wp_locale->month_abbrev ),
      			'weekdays' => array_values( $wp_locale->weekday ),
      			'weekdaysShort' => array_values( $wp_locale->weekday_abbrev ),
      			'weekdaysMin' => array_values( $wp_locale->weekday_initial ),
            'gmtOffset' => get_option( 'gmt_offset' ) * HOUR_IN_SECONDS
      		),
          'settings' => array(
            'console_log' => isset( $options['console_log'] ) ? wp_validate_boolean( $options['console_log'] ) : false
          )
        ));

			}
		}

    public static function get_location(){

      $ip = $_SERVER['REMOTE_ADDR'];
      $ip_transient = 'sw_ip_' . md5( $ip );

      $location_data = get_transient( $ip_transient );
      $options = get_option( 'simple-weather-options', apply_filters( 'simple-weather-options', array() ) );

      $access_key = esc_attr( $options['api_ipStack'] );

      if( ! $location_data ){
        $ip_file = wp_remote_get( "http://api.ipstack.com/{$ip}?access_key={$access_key}" );
        if( ! is_wp_error( $ip_file ) ){
            $ip_data = json_decode( $ip_file['body'], true );
            if( ! isset( $ip_data['latitude'] ) && isset( $ip_data['longitude'] ) ){
                $location_data = "{$ip_data['city']}, {$ip_data['country_name']}";
            } else {
                $location_data = array(
                    'lat' => $ip_data['latitude'],
                    'long' => $ip_data['longitude']
                );
            }
        }
      }

      if( ! empty( $location_data ) && is_array( $location_data ) ){
        return array( $location_data['lat'], $location_data['long'] );
      }
      elseif( ! empty( $location_data ) && ! is_array( $location_data ) ) {
        return $location_data;
      }

      return;

    }

		/** Textdomain */
		function set_textdomain() {
			load_plugin_textdomain( 'SIMPLEWEATHER', false, dirname( plugin_basename( __FILE__ ) ). '/languages/' );
		}

		/** Weather Shortcode */
		function weather_shortcode( $atts ) {

      $options = get_option( 'simple-weather-options', apply_filters( 'simple-weather-options', array() ) );

			$atts = shortcode_atts( array(
				'latitude' => null,
				'longitude' => null,
				'location' => 'London, uk',
				'days' => 1,
				'units' => isset( $options['units'] ) ? esc_attr( $options['units'] ) : 'imperial',
				'show_units' => 'yes',
				'show_date'	=> 'yes',
				'night' => 'no',
				'date'	=> 'dddd',
				'api'	=> null,
				'interval' => null,
				'timeout' => null,
				'station' => isset( $options['station'] ) && ! empty( $options['station'] ) ? esc_attr( $options['station'] ) : 'openweather',
				'show_current' => 'yes',
				'text_align'	=> null,
				'display'	=> null,
				'style'		=> null,
        'title' => null,
        'inline_css' => null
			), $atts, 'simple-weather' );

			$template = simple_weather_get_template_part( 'app' );
			$id = md5( htmlspecialchars( json_encode( $atts ), ENT_QUOTES, 'UTF-8') );

      global $sw_feeds_array;
      global $sw_atts_array;

      /* Set atts to footer */
			if( empty( $sw_atts_array ) ){
				$sw_atts_array = array( $id => $atts );
			} else {
				if( ! isset( $sw_atts_array[$id] ) ){
					$sw_atts_array[$id] = $atts;
				}
			}

      /* Preload weather if async is off */
      if( ! wp_validate_boolean( $options['async'] ) ){
        if( empty( $sw_feeds_array ) ){
          $sw_feeds_array = array( $id => self::get_weather_file_new( $atts ) );
        } else {
          if( ! isset( $sw_feeds_array[$id] ) ){
            $sw_feeds_array[$id] = self::get_weather_file_new( $atts );
          }
        }
      }

      ob_start();

			if( isset( $template ) && ! empty( $template ) && $template !== false ) include( $template );

			return ob_get_clean();

		}

	}

	new CurlySimpleWeather();
}
?>
