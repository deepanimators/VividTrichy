<?php

function simple_weather_widget_cb() {
    register_widget( 'Simple_Weather_Widget' );
}
add_action( 'widgets_init', 'simple_weather_widget_cb' );

class Simple_Weather_Widget extends WP_Widget {

	function __construct() {

		/** Admin Scripts */
		add_action( 'load-widgets.php', array( $this, 'admin_scripts' ) );

		parent::__construct(
			'simple-weather',
			__('Simple Weather Widget', 'SIMPLEWEATHER'),
			array(
				'classname' => 'simple-weather',
				'description' => __('This widget displays the weather',
				'SIMPLEWEATHER'
			), 'idbase' => 'simple-weather' ),
			array(
				'width' => 252,
				'idbase' => 'simple-weather'
			)
		);
	}


	/** Admin Scripts */
	function admin_scripts() {
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'wp-color-picker' );
    wp_enqueue_script(
			'simple-weather-depends-on',
			plugins_url( '/js/dependsOn-1.0.2.min.js' , __FILE__ ),
			null,
			null,
			true
		);
		wp_enqueue_script(
			'main-simple-weather',
			plugins_url( '/js/main.js' , __FILE__ ),
			null,
			null,
			true
		);
	}

	/** hex2rgb */
	function hex2rgb( $hex ) {
	   $hex = str_replace("#", "", $hex);

	   if(strlen($hex) == 3) {
	      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
	      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
	      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
	   } else {
	      $r = hexdec(substr($hex,0,2));
	      $g = hexdec(substr($hex,2,2));
	      $b = hexdec(substr($hex,4,2));
	   }
	   $rgb = array($r, $g, $b);
	   return implode(",", $rgb);
	}

	/** Widget */
	function widget( $args, $instance ) {
		extract( $args );

		// Our variables from the widget settings.
		$title = apply_filters('widget_title', $instance['title'] );

    echo $before_widget;

    $station  = isset( $instance['station'] ) ? $instance['station'] : 'owm';
    $units    = esc_attr( $instance['units'] );
    $lang     = esc_attr( $instance['lang'] );
    $bg       = $instance['bg_color'];
    $text     = $instance['text_color'];
    $days     = intval( $instance['days'] );
    $api      = esc_attr( $instance['api'] );
    $interval = isset( $instance['interval'] ) ? $instance['interval'] : 0;
    $timeout  = isset( $instance['timeout'] ) ? $instance['timeout'] : 30;
    $location_type = $instance['location-type'];
    $latitude = esc_attr( $instance['latitude'] );
    $longitude = esc_attr( $instance['longitude'] );
    $location = esc_attr( $instance['location'] );

    $location = $location_type === 'auto' ? 'auto' : $location;

    /** Prepare Styles */
    $style = $classes = array();

    if( ! empty( $bg ) ){
      $style[] = "background-color: $bg";
      $classes[] = 'simple-weather-widget--with-background';
    }


    if( ! empty( $text ) ){
      $style[] = "color: $text";
      $classes[] = 'simple-weather-widget--with-color';
    }

    $style = count( $style ) > 0 ? implode( '; ', $style ) : '';

    $station = 'openweather';

    echo do_shortcode("[simple-weather style='widget' days='{$days}' title='{$title}' interval='{$interval}' timeout='{$timeout}' inline_css='{$style}' station='{$station}' api='{$api}' latitude='{$latitude}' longitude='{$longitude}' location='{$location}' show_current='yes' units='{$units}' lang='{$lang}']");

    echo $after_widget;
	}

	//Update the widget
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		//Strip tags from title and name to remove HTML
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['location-type'] = $new_instance['location-type'];
		$instance['location'] = $new_instance['location'];
		$instance['latitude'] = $new_instance['latitude'];
		$instance['longitude'] = $new_instance['longitude'];
		$instance['units'] = $new_instance['units'];
        $instance['station'] = $new_instance['station'];
		$instance['lang'] = $new_instance['lang'];
        $instance['lang_ds'] = $new_instance['lang_ds'];
		$instance['bg_color'] = $new_instance['bg_color'];
		$instance['text_color'] = $new_instance['text_color'];
		$instance['days'] = $new_instance['days'];
		$instance['api'] = $new_instance['api'];
		$instance['interval'] = $new_instance['interval'];
		$instance['timeout'] = $new_instance['timeout'];

		return $instance;
	}


	function form( $instance ) {

		$defaults = array(
       'title' => null,
       'location' => null,
       'location-type' => 'location',
       'latitude' => null,
       'longitude' => null,
       'bg_color' => null,
       'text_color' => null,
       'units' => 'imperial',
       'station' => 'owm',
       'lang' => 'en',
       'lang_ds' => 'en',
       'days' => 5,
       'api' => null,
       'interval' => 10,
       'timeout' => 30
   );

		//Set up some default widget settings.
		$instance = wp_parse_args( (array) $instance, $defaults); ?>
		<div class="widget-content">
            <p>
                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Widget Title:', 'SIMPLEWEATHER'); ?></label>
                <input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" />
            </p>
            <!--<p>
                <label for="<?php /*echo $this->get_field_id( 'station' ); */?>"><?php /*_e('Weather Station:', 'SIMPLEWEATHER'); */?></label>
                <select class="widefat" id="<?php /*echo $this->get_field_id( 'station' ); */?>" name="<?php /*echo $this->get_field_name( 'station' ); */?>">
                	<option <?php /*selected( $instance['station'], 'owm' ); */?> value="owm">Open Weather Map</option>
                    <option <?php /*selected( $instance['station'], 'ds' ); */?> value="ds">Dark Sky</option>
                </select>
            </p>-->
            <p>
                <label for="<?php echo $this->get_field_id( 'location-type' ); ?>"><?php _e('Location Type:', 'SIMPLEWEATHER'); ?></label>
                <select class="widefat" id="<?php echo $this->get_field_id( 'location-type' ); ?>" name="<?php echo $this->get_field_name( 'location-type' ); ?>">
                	<option <?php selected( $instance['location-type'], 'location' ); ?> value="location">Location</option>
                    <option <?php selected( $instance['location-type'], 'coordinates' ); ?> value="coordinates">Coordinates</option>
                    <option <?php selected( $instance['location-type'], 'auto' ); ?> value="auto">Auto</option>
                </select>
            </p>
            <p class="has-dependency" data-depends-on="#<?php echo $this->get_field_id( 'location-type' ); ?>" data-depends-value="location">
                <label for="<?php echo $this->get_field_id( 'location' ); ?>"><?php _e('Location:', 'SIMPLEWEATHER'); ?></label>
                <input type="text" id="<?php echo $this->get_field_id( 'location' ); ?>" name="<?php echo $this->get_field_name( 'location' ); ?>" value="<?php echo $instance['location']; ?>" class="widefat" />
                <small style="color: gray;">Example: London, Uk</small>
            </p>
            <p class="has-dependency" data-depends-on="#<?php echo $this->get_field_id( 'location-type' ); ?>" data-depends-value="coordinates">
                <label for="<?php echo $this->get_field_id( 'latitude' ); ?>"><?php _e('Location Latitude:', 'SIMPLEWEATHER'); ?></label>
                <input type="text" id="<?php echo $this->get_field_id( 'latitude' ); ?>" name="<?php echo $this->get_field_name( 'latitude' ); ?>" value="<?php echo $instance['latitude']; ?>" class="widefat" />
            </p>
            <p class="has-dependency" data-depends-on="#<?php echo $this->get_field_id( 'location-type' ); ?>" data-depends-value="coordinates">
                <label for="<?php echo $this->get_field_id( 'longitude' ); ?>"><?php _e('Location Longitude:', 'SIMPLEWEATHER'); ?></label>
                <input type="text" id="<?php echo $this->get_field_id( 'longitude' ); ?>" name="<?php echo $this->get_field_name( 'longitude' ); ?>" value="<?php echo $instance['longitude']; ?>" class="widefat" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'units' ); ?>"><?php _e('Units:', 'SIMPLEWEATHER'); ?></label>
                <select class="widefat" id="<?php echo $this->get_field_id( 'units' ); ?>" name="<?php echo $this->get_field_name( 'units' ); ?>">
                	<option <?php selected( $instance['units'], 'imperial' ); ?> value="imperial">Imperial (Farenheit)</option>
                    <option <?php selected( $instance['units'], 'metric' ); ?> value="metric">Metric (Celsius)</option>
                </select>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'days' ); ?>"><?php _e('Days of forecast:', 'SIMPLEWEATHER'); ?></label>
                <select class="widefat" id="<?php echo $this->get_field_id( 'days' ); ?>" name="<?php echo $this->get_field_name( 'days' ); ?>">
                	<option <?php selected( $instance['days'], 0 ); ?> value="0">None</option>
                    <option <?php selected( $instance['days'], 1 ); ?> value="1">1</option>
                    <option <?php selected( $instance['days'], 2 ); ?> value="2">2</option>
                    <option <?php selected( $instance['days'], 3 ); ?> value="3">3</option>
                    <option <?php selected( $instance['days'], 4 ); ?> value="4">4</option>
                    <option <?php selected( $instance['days'], 5 ); ?> value="5">5</option>
                    <option <?php selected( $instance['days'], 6 ); ?> value="6">6</option>
                    <option <?php selected( $instance['days'], 7 ); ?> value="7">7</option>
                </select>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'interval' ); ?>"><?php _e('Weather Check Interval:', 'SIMPLEWEATHER'); ?></label>
                <select class="widefat" id="<?php echo $this->get_field_id( 'interval' ); ?>" name="<?php echo $this->get_field_name( 'interval' ); ?>">
                	<option <?php selected( $instance['interval'], 0 ); ?> value="0">Each Page Refresh</option>
                	<option <?php selected( $instance['interval'], 10 ); ?> value="10">Every 10 minutes</option>
                	<option <?php selected( $instance['interval'], 30 ); ?> value="30">Every 30 minutes</option>
                	<option <?php selected( $instance['interval'], 60 ); ?> value="60">Every 1 hour</option>
                	<option <?php selected( $instance['interval'], 120 ); ?> value="120">Every 2 hours</option>
                </select>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'timeout' ); ?>"><?php _e('Response Timeout:', 'SIMPLEWEATHER'); ?></label>
                <select class="widefat" id="<?php echo $this->get_field_id( 'timeout' ); ?>" name="<?php echo $this->get_field_name( 'timeout' ); ?>">
                	<option <?php selected( $instance['timeout'], 5 ); ?> value="0">5 Seconds</option>
                	<option <?php selected( $instance['timeout'], 10 ); ?> value="10">10 Seconds</option>
                	<option <?php selected( $instance['timeout'], 30 ); ?> value="30">30 Seconds</option>
                	<option <?php selected( $instance['timeout'], 40 ); ?> value="40">40 Seconds</option>
                </select>
            </p>
            <p class="has-dependency" data-depends-on="#<?php echo $this->get_field_id( 'station' ); ?>" data-depends-value="owm">
                <label for="<?php echo $this->get_field_id( 'lang' ); ?>"><?php _e('Language:', 'SIMPLEWEATHER'); ?></label>
                <select class="widefat has-dependency" id="<?php echo $this->get_field_id( 'lang' ); ?>" name="<?php echo $this->get_field_name( 'lang' ); ?>">
                  <option <?php selected( $instance['lang'], 'ar' ); ?> value="ar">Arabic</option>
                  <option <?php selected( $instance['lang'], 'bg' ); ?> value="bg">Bulgarian</option>
                  <option <?php selected( $instance['lang'], 'ca' ); ?> value="tr">Catalan</option>
                  <option <?php selected( $instance['lang'], 'cz' ); ?> value="cz">Czech</option>
                  <option <?php selected( $instance['lang'], 'de' ); ?> value="de">German</option>
                  <option <?php selected( $instance['lang'], 'el' ); ?> value="el">Greek</option>
                  <option <?php selected( $instance['lang'], 'en' ); ?> value="en">English</option>
                  <option <?php selected( $instance['lang'], 'fa' ); ?> value="fa">Persian (Farsi)</option>
                  <option <?php selected( $instance['lang'], 'fi' ); ?> value="fi">Finnish</option>
                  <option <?php selected( $instance['lang'], 'fr' ); ?> value="fr">French</option>
                  <option <?php selected( $instance['lang'], 'gl' ); ?> value="gl">Galician</option>
                  <option <?php selected( $instance['lang'], 'hr' ); ?> value="hr">Croatian</option>
                  <option <?php selected( $instance['lang'], 'hu' ); ?> value="hu">Hungarian</option>
                  <option <?php selected( $instance['lang'], 'it' ); ?> value="it">Italian</option>
                  <option <?php selected( $instance['lang'], 'ja' ); ?> value="ja">Japanese</option>
                  <option <?php selected( $instance['lang'], 'kr' ); ?> value="kr">Korean</option>
                  <option <?php selected( $instance['lang'], 'la' ); ?> value="la">Latvian</option>
                  <option <?php selected( $instance['lang'], 'lt' ); ?> value="lt">Lithuanian</option>
                  <option <?php selected( $instance['lang'], 'mk' ); ?> value="mk">Macedonian</option>
                  <option <?php selected( $instance['lang'], 'nl' ); ?> value="nl">Dutch</option>
                  <option <?php selected( $instance['lang'], 'pl' ); ?> value="pl">Polish</option>
                  <option <?php selected( $instance['lang'], 'pt' ); ?> value="pt">Portuguese</option>
                  <option <?php selected( $instance['lang'], 'ro' ); ?> value="ro">Romanian</option>
                  <option <?php selected( $instance['lang'], 'ru' ); ?> value="ru">Russian</option>
                  <option <?php selected( $instance['lang'], 'se' ); ?> value="se">Swedish</option>
                  <option <?php selected( $instance['lang'], 'se' ); ?> value="se">Swedish</option>
                  <option <?php selected( $instance['lang'], 'sk' ); ?> value="sk">Slovak</option>
                  <option <?php selected( $instance['lang'], 'sl' ); ?> value="sl">Slovenian</option>
                  <option <?php selected( $instance['lang'], 'tr' ); ?> value="tr">Turkish</option>
                  <option <?php selected( $instance['lang'], 'ua' ); ?> value="ua">Ukranian</option>
                  <option <?php selected( $instance['lang'], 'vi' ); ?> value="vi">Vietnamese</option>
                  <option <?php selected( $instance['lang'], 'zh_tw' ); ?> value="zh_tw">Chinese Traditional</option>
                  <option <?php selected( $instance['lang'], 'zh_cn' ); ?> value="zh_cn">Chinese Simplified</option>
                </select>
            </p>
            <p class="has-dependency" data-depends-on="#<?php echo $this->get_field_id( 'station' ); ?>" data-depends-value="ds">
                <label for="<?php echo $this->get_field_id( 'lang_ds' ); ?>"><?php _e('Language:', 'SIMPLEWEATHER'); ?></label>
                <select class="widefat" id="<?php echo $this->get_field_id( 'lang_ds' ); ?>" name="<?php echo $this->get_field_name( 'lang_ds' ); ?>">
                    <option <?php selected( $instance['lang_ds'], 'ar' ); ?> value="ar">Arabic</option>
                    <option <?php selected( $instance['lang_ds'], 'az' ); ?> value="az">Azerbaijani</option>
                    <option <?php selected( $instance['lang_ds'], 'be' ); ?> value="be">Belarusian</option>
                    <option <?php selected( $instance['lang_ds'], 'bg' ); ?> value="bg">Bulgarian</option>
                    <option <?php selected( $instance['lang_ds'], 'bs' ); ?> value="bs">Bosnian</option>
                    <option <?php selected( $instance['lang_ds'], 'ca' ); ?> value="ca">Catalan</option>
                    <option <?php selected( $instance['lang_ds'], 'cz' ); ?> value="cz">Czech</option>
                    <option <?php selected( $instance['lang_ds'], 'de' ); ?> value="de">German</option>
                    <option <?php selected( $instance['lang_ds'], 'el' ); ?> value="el">Greek</option>
                    <option <?php selected( $instance['lang_ds'], 'en' ); ?> value="en">English</option>
                    <option <?php selected( $instance['lang_ds'], 'es' ); ?> value="es">Spanish</option>
                    <option <?php selected( $instance['lang_ds'], 'fr' ); ?> value="fr">French</option>
                    <option <?php selected( $instance['lang_ds'], 'hr' ); ?> value="hr">Croatian</option>
                    <option <?php selected( $instance['lang_ds'], 'hu' ); ?> value="hu">Hungarian</option>
                    <option <?php selected( $instance['lang_ds'], 'id' ); ?> value="id">Indonesian</option>
                  	<option <?php selected( $instance['lang_ds'], 'it' ); ?> value="it">Italian</option>
                    <option <?php selected( $instance['lang_ds'], 'is' ); ?> value="is">Icelandic</option>
                    <option <?php selected( $instance['lang_ds'], 'kw' ); ?> value="kw">Cornish</option>
                    <option <?php selected( $instance['lang_ds'], 'nb' ); ?> value="nb">Norwegian Bokmål</option>
                    <option <?php selected( $instance['lang_ds'], 'nl' ); ?> value="nl">Dutch</option>
                    <option <?php selected( $instance['lang_ds'], 'pl' ); ?> value="pl">Polish</option>
                    <option <?php selected( $instance['lang_ds'], 'pt' ); ?> value="pt">Portuguese</option>
                    <option <?php selected( $instance['lang_ds'], 'ru' ); ?> value="ru">Russian</option>
                    <option <?php selected( $instance['lang_ds'], 'sk' ); ?> value="sk">Slovak</option>
                    <option <?php selected( $instance['lang_ds'], 'sl' ); ?> value="sl">Slovenian</option>
                    <option <?php selected( $instance['lang_ds'], 'sr' ); ?> value="sr">Serbian</option>
                    <option <?php selected( $instance['lang_ds'], 'se' ); ?> value="se">Swedish</option>
                    <option <?php selected( $instance['lang_ds'], 'tet' ); ?> value="tet">Tetum</option>
                    <option <?php selected( $instance['lang_ds'], 'tr' ); ?> value="tr">Turkish</option>
                    <option <?php selected( $instance['lang_ds'], 'ua' ); ?> value="ua">Ukranian</option>
                    <option <?php selected( $instance['lang_ds'], 'zh' ); ?> value="zh">Chinese Simplified</option>
                    <option <?php selected( $instance['lang_ds'], 'zh_tw' ); ?> value="zh_tw">Chinese Traditional</option>
                    <option <?php selected( $instance['lang_ds'], 'x-pig-latin' ); ?> value="x-pig-latin">Igpay Atinlay</option>
                </select>
            </p>
            <h4><?php _e('Widget Styling' , 'SIMPLEWEATHER') ?></h4>

            <p>
            	<label><?php _e('Background Color' , 'SIMPLEWEATHER') ?></label><br>
            	<input type="text" id="<?php echo $this->get_field_id( 'bg_color' ); ?>" name="<?php echo $this->get_field_name( 'bg_color' ); ?>" value="<?php echo esc_attr($instance['bg_color']); ?>" class="wp-color-picker" />
            </p>
            <p>
            	<label><?php _e('Text Color' , 'SIMPLEWEATHER') ?></label><br>
            	<input class="wp-color-picker" type="text" id="<?php echo $this->get_field_id( 'text_color' ); ?>" name="<?php echo $this->get_field_name( 'text_color' ); ?>" value="<?php echo esc_attr($instance['text_color']); ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'api' ); ?>"><?php _e('API Key:', 'SIMPLEWEATHER'); ?></label>
                <input type="text" id="<?php echo $this->get_field_id( 'api' ); ?>" name="<?php echo $this->get_field_name( 'api' ); ?>" value="<?php echo $instance['api']; ?>" class="widefat" />
                <small><?php _e('For better performance it is recommended that you use an API key.', 'SIMPLEWEATHER'); ?></small>
            </p>
		</div>
	<?php
	}
}
?>
