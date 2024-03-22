<?php

class SimpleWeatherSettings{

  public function __construct(){

    add_action( 'admin_enqueue_scripts', array( $this, 'load_admin_scripts') );
    add_action( 'admin_menu', array( $this, 'register_options_page' ) );
    add_filter( 'simple_weather_locale_element_ui', array( $this, 'default_element_ui_locale' ) );

  }

  function default_element_ui_locale( $out ){
    $out['colorpicker'] = array(
    'confirm' => esc_html__( 'OK', 'simple-weather'),
    'clear' => esc_html__( 'Clear', 'simple-weather')
  );
  $out['datepicker'] = array(
    'now' => esc_html__( 'Now', 'simple-weather'),
    'today' => esc_html__( 'Today', 'simple-weather'),
    'cancel' => esc_html__( 'Cancel', 'simple-weather'),
    'clear' => esc_html__( 'Clear', 'simple-weather'),
    'confirm' => esc_html__( 'OK', 'simple-weather'),
    'selectDate' => esc_html__( 'Select date', 'simple-weather'),
    'selectTime' => esc_html__( 'Select time', 'simple-weather'),
    'startDate' => esc_html__( 'Start Date', 'simple-weather'),
    'startTime' => esc_html__( 'Start Time', 'simple-weather'),
    'endDate' => esc_html__( 'End Date', 'simple-weather'),
    'endTime' => esc_html__( 'End Time', 'simple-weather'),
    'year' => '',
    'month1' => esc_html__( 'Jan', 'simple-weather'),
    'month2' => esc_html__( 'Feb', 'simple-weather'),
    'month3' => esc_html__( 'Mar', 'simple-weather'),
    'month4' => esc_html__( 'Apr', 'simple-weather'),
    'month5' => esc_html__( 'May', 'simple-weather'),
    'month6' => esc_html__( 'Jun', 'simple-weather'),
    'month7' => esc_html__( 'Jul', 'simple-weather'),
    'month8' => esc_html__( 'Aug', 'simple-weather'),
    'month9' => esc_html__( 'Sep', 'simple-weather'),
    'month10' => esc_html__( 'Oct', 'simple-weather'),
    'month11' => esc_html__( 'Nov', 'simple-weather'),
    'month12' => esc_html__( 'Dec', 'simple-weather'),
    'weeks' =>  array(
      'sun' => esc_html__( 'Sun', 'simple-weather'),
      'mon' => esc_html__( 'Mon', 'simple-weather'),
      'tue' => esc_html__( 'Tue', 'simple-weather'),
      'wed' => esc_html__( 'Wed', 'simple-weather'),
      'thu' => esc_html__( 'Thu', 'simple-weather'),
      'fri' => esc_html__( 'Fri', 'simple-weather'),
      'sat' => esc_html__( 'Sat', 'simple-weather')
    ),
    'months' => array(
      'jan' => esc_html__( 'Jan', 'simple-weather'),
      'feb' => esc_html__( 'Feb', 'simple-weather'),
      'mar' => esc_html__( 'Mar', 'simple-weather'),
      'apr' => esc_html__( 'Apr', 'simple-weather'),
      'may' => esc_html__( 'May', 'simple-weather'),
      'jun' => esc_html__( 'Jun', 'simple-weather'),
      'jul' => esc_html__( 'Jul', 'simple-weather'),
      'aug' => esc_html__( 'Aug', 'simple-weather'),
      'sep' => esc_html__( 'Sep', 'simple-weather'),
      'oct' => esc_html__( 'Oct', 'simple-weather'),
      'nov' => esc_html__( 'Nov', 'simple-weather'),
      'dec' => esc_html__( 'Dec', 'simple-weather')
    )
  );
  $out['select'] = array(
    'loading' => esc_html__( 'Loading', 'simple-weather'),
    'noMatch' => esc_html__( 'No matching data', 'simple-weather'),
    'noData' => esc_html__( 'No data', 'simple-weather'),
    'placeholder' => esc_html__( 'Select', 'simple-weather')
  );
  $out['cascader'] = array(
    'noMatch' => esc_html__( 'No matching data', 'simple-weather'),
    'loading' => esc_html__( 'Loading', 'simple-weather'),
    'placeholder' => esc_html__( 'Select', 'simple-weather')
  );
  $out['pagination'] = array(
   'goto' => esc_html__( 'Go to', 'simple-weather'),
   'pagesize' => esc_html__( '/page', 'simple-weather'),
   'total' => esc_html__( 'Total {total}', 'simple-weather'),
   'pageClassifier' => ''
 );
 $out['messagebox'] = array(
    'title' => esc_html__( 'Message', 'simple-weather'),
    'confirm' => esc_html__( 'OK', 'simple-weather'),
    'cancel' => esc_html__( 'Cancel', 'simple-weather'),
    'error' => esc_html__( 'Illegal input', 'simple-weather')
  );
  $out['upload'] = array(
    'deleteTip' => esc_html__( 'press delete to remove', 'simple-weather'),
    'delete' => esc_html__( 'Delete', 'simple-weather'),
    'preview' => esc_html__( 'Preview', 'simple-weather'),
    'continue' => esc_html__( 'Continue', 'simple-weather')
  );
  $out['table'] = array(
    'emptyText' => esc_html__( 'No Data', 'simple-weather'),
    'confirmFilter' => esc_html__( 'Confirm', 'simple-weather'),
    'resetFilter' => esc_html__( 'Reset', 'simple-weather'),
    'clearFilter' => esc_html__( 'All', 'simple-weather'),
    'sumText' => esc_html__( 'Sum', 'simple-weather')
  );
  $out['tree'] = array(
   'emptyText' => esc_html__( 'No Data', 'simple-weather')
 );
 $out['transfer'] = array(
    'noMatch' => esc_html__( 'No matching data', 'simple-weather'),
    'noData' => esc_html__( 'No data', 'simple-weather'),
    'titles' => [ esc_html__( 'List 1', 'simple-weather'), esc_html__('List 2', 'simple-weather')],
    'filterPlaceholder' => esc_html__( 'Enter keyword', 'simple-weather'),
    'noCheckedFormat' => esc_html__( '{total} items', 'simple-weather'),
    'hasCheckedFormat' => esc_html__( '{checked}/{total} checked', 'simple-weather')
  );
  return $out;
  }

  function load_admin_scripts(){

    $screen = get_current_screen();

		if( $screen->base !== 'settings_page_simple-weather' ) return;

    wp_enqueue_style( 'element-ui', plugins_url( '/css/index.css' , __FILE__ ), false );
    wp_enqueue_style( 'simple-weather-admin', plugins_url( '/css/simple-weather-admin.css' , __FILE__ ), array( 'element-ui' ), rand() );

    if( ! wp_script_is( 'vue-js' ) ) wp_enqueue_script( 'vue-js', plugins_url( '/js/vue.min.js' , __FILE__ ), array( 'jquery' ), null, true );
    if( ! wp_script_is( 'vue-resource' ) ) wp_enqueue_script( 'vue-resource', plugins_url( '/js/vue-resource.min.js' , __FILE__ ), array( 'vue-js' ), null, true );
    if( ! wp_script_is( 'moment-js' ) ) wp_enqueue_script( 'moment-js', plugins_url( '/js/moment.min.js' , __FILE__ ), array( 'vue-js' ), null, true );
    if( ! wp_script_is( 'element-ui' ) ) wp_enqueue_script( 'element-ui', plugins_url( '/js/index.js' , __FILE__ ), array( 'vue-js' ), '1.4.8', true );

    wp_enqueue_script( 'simple-weather-admin', plugins_url( '/js/simple-weather-admin-min.js' , __FILE__ ), array( 'jquery', 'vue-js', 'vue-resource', 'moment-js', 'element-ui' ), rand(), true );

    wp_localize_script( 'simple-weather-admin', 'SimpleWeather', array(
      'rest_route' => esc_url_raw( get_rest_url() ),
      'nonce' => wp_create_nonce( 'wp_rest' ),
      'locale_element_ui' => array( 'el' => apply_filters( 'simple_weather_locale_element_ui', array() ) )
    ) );

  }

  function register_options_page() {
    add_options_page('Simple Weather Settings', 'Simple Weather', 'manage_options', 'simple-weather', array( $this, 'options_page' ) );
  }

  function options_page(){
    ?>
    <div id="app" class="wrap" v-cloak>
      <h1>Simple Weather Settings</h1>
      <el-form v-if="form" ref="form" :model="form"  label-width="220px" class="simple-weather-settings-form" v-loading="loading">

        <el-tabs v-model="tabs">
          <el-tab-pane label="General" name="general">

            <el-form-item label="Lazy Load Weather">
              <el-switch
                v-model="form.async"
                on-text="Yes"
                off-text="No">
              </el-switch>
              <small>Enabling this option, your website will load faster and loading the weather will bypass static page caching.</small>
            </el-form-item>

            <el-form-item label="Default Weather Station" v-show="false">
              <el-radio-group v-model="form.station">
                <el-radio label="openweather">OpenWeatherMap.org</el-radio>
                <el-radio label="darksky">DarkSky.net</el-radio>
              </el-radio-group>
            </el-form-item>

            <el-form-item label="Default Measuring Units">
              <el-radio-group v-model="form.units">
                <el-radio label="imperial">Imperial (&deg;F)</el-radio>
                <el-radio label="metric">Metric (&deg;C)</el-radio>
              </el-radio-group>
            </el-form-item>

          </el-tab-pane>
          <el-tab-pane label="OpenWeather" name="ow">

            <el-form-item label="OpenWeather API Key">
              <el-input v-model="form.api_ow" placeholder="Enter your OpenWeather API here"></el-input>
              <small>You can improve the overall performance of our plugin, if you use your own API Key from <a href="https://home.openweathermap.org/users/sign_up" target="_blank">OpenWeatherMap.org</a></small>
            </el-form-item>

            <el-form-item label="OpenWeather Language">
              <el-select v-model="form.lang_ow" filterable placeholder="Select Language">
                <el-option label="Arabic" value="ar"></el-option>
                <el-option label="Bulgarian" value="bg"></el-option>
                <el-option label="Catalan" value="ca"></el-option>
                <el-option label="Czech" value="cz"></el-option>
                <el-option label="English" value="en"></el-option>
                <el-option label="German" value="de"></el-option>
                <el-option label="Greek" value="el"></el-option>
                <el-option label="Persian (Farsi)" value="fa"></el-option>
                <el-option label="Finnish" value="fi"></el-option>
                <el-option label="French" value="fr"></el-option>
                <el-option label="Galician" value="gl"></el-option>
                <el-option label="Croatian" value="hr"></el-option>
                <el-option label="Hungarian" value="hu"></el-option>
                <el-option label="Italian" value="it"></el-option>
                <el-option label="Japanese" value="ja"></el-option>
                <el-option label="Korean" value="kr"></el-option>
                <el-option label="Latvian" value="la"></el-option>
                <el-option label="Lithuanian" value="lt"></el-option>
                <el-option label="Macedonian" value="mk"></el-option>
                <el-option label="Dutch" value="nl"></el-option>
                <el-option label="Polish" value="pl"></el-option>
                <el-option label="Portuguese" value="pt"></el-option>
                <el-option label="Romanian" value="ro"></el-option>
                <el-option label="Russian" value="ru"></el-option>
                <el-option label="Swedish" value="se"></el-option>
                <el-option label="Slovak" value="sk"></el-option>
                <el-option label="Slovenian" value="sl"></el-option>
                <el-option label="Spanish" value="es"></el-option>
                <el-option label="Turkish" value="tr"></el-option>
                <el-option label="Ukrainian" value="ua"></el-option>
                <el-option label="Vietnamese" value="vi"></el-option>
                <el-option label="Chinese Simplified" value="zh_cn"></el-option>
                <el-option label="Chinese Traditional" value="zh_tw"></el-option>
              </el-select>
            </el-form-item>

          </el-tab-pane>
          <!--<el-tab-pane label="Dark Sky" name="ds">

            <el-form-item label="DarkSky API Key">
              <el-input v-model="form.api_ds"  placeholder="Enter your DarkSky API here"></el-input>
              <small>You can use the DarkSky API, but you need to use your own API Key which you can generate from <a href="https://darksky.net/dev/register" target="_blank">DarkSky.net</a></small>
            </el-form-item>

            <el-form-item label="DarkSky Language">
              <el-select v-model="form.lang_ds" filterable placeholder="Select Language">
                <el-option label="Arabic" value="ar"></el-option>
                <el-option label="Azerbaijani" value="az"></el-option>
                <el-option label="Belarusian" value="be"></el-option>
                <el-option label="Bulgarian" value="bg"></el-option>
                <el-option label="Bosnian" value="bs"></el-option>
                <el-option label="Catalan" value="ca"></el-option>
                <el-option label="Czech" value="cz"></el-option>
                <el-option label="German" value="de"></el-option>
                <el-option label="Greek" value="el"></el-option>
                <el-option label="English" value="en"></el-option>
                <el-option label="Spanish" value="es"></el-option>
                <el-option label="Estonian" value="et"></el-option>
                <el-option label="French" value="fr"></el-option>
                <el-option label="Croatian" value="hr"></el-option>
                <el-option label="Hungarian" value="hu"></el-option>
                <el-option label="Indonesian" value="id"></el-option>
                <el-option label="Italian" value="it"></el-option>
                <el-option label="Icelandic" value="is"></el-option>
                <el-option label="Cornish" value="kw"></el-option>
                <el-option label="Norwegian Bokmål" value="nb"></el-option>
                <el-option label="Dutch" value="nl"></el-option>
                <el-option label="Polish" value="pl"></el-option>
                <el-option label="Portuguese" value="pt"></el-option>
                <el-option label="Russian" value="ru"></el-option>
                <el-option label="Slovak" value="sk"></el-option>
                <el-option label="Slovenian" value="sl"></el-option>
                <el-option label="Serbian" value="sr"></el-option>
                <el-option label="Swedish" value="sv"></el-option>
                <el-option label="Tetum" value="tet"></el-option>
                <el-option label="Turkish" value="tr"></el-option>
                <el-option label="Ukrainian" value="ua"></el-option>
                <el-option label="Igpay Atinlay" value="x-pig-latin"></el-option>
                <el-option label="Chinese Simplified" value="zh"></el-option>
                <el-option label="Chinese Traditional" value="zh-tw"></el-option>
              </el-select>
            </el-form-item>

          </el-tab-pane>-->
          <el-tab-pane label="Advanced" name="advanced">
            <el-form-item label="Default Weather Check Interval (minutes)">
              <el-slider
                v-model="form.freq"
                :step="1" show-input :min="0" :max="120">
              </el-slider>
            </el-form-item>

            <el-form-item label="Default API Request Timeout (seconds)">
              <el-slider
                v-model="form.timeout"
                :step="1" show-input :min="0" :max="60">
              </el-slider>
            </el-form-item>

            <el-form-item label="Enable Console Log" v-if="form.async">
              <el-switch
                v-model="form.console_log"
                on-text="Yes"
                off-text="No">
              </el-switch>
              <small>Enabling this option, your website will log to the console the API responses from the weather stations.</small>
            </el-form-item>

              <el-form-item label="ipStack Access Key">
                  <el-input v-model="form.api_ipStack"  placeholder="Enter your ipStack Access API here"></el-input>
                  <small>You can use the ipStack Access Key, but you need to use your own Access Key which you can generate from <a href="https://ipstack.com/signup/free" target="_blank">ipstack.com</a></small>
              </el-form-item>

          </el-tab-pane>
        </el-tabs>

        <el-form-item>
          <el-button type="primary" @click="onSubmit">Save Settings</el-button>
        </el-form-item>

      </el-form>



    </div>
    <?php
  }

}

new SimpleWeatherSettings();

?>
