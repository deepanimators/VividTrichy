<?php

class SimpleWeatherRestApi {

  private $_version;
  private $_namespace;

  public function __construct(){

    $this->_version = '1';
    $this->_namespace = "simple-weather/v{$this->_version}";

    add_action( 'rest_api_init', array( $this, 'register_api_routes' ) );

  }

  function register_api_routes(){

    register_rest_route( $this->_namespace, '/' . 'get_weather', array(
      'methods'  => WP_REST_Server::CREATABLE,
      'callback' => array( $this, 'get_weather' )
    ));

    register_rest_route( $this->_namespace, '/options', array(
      array(
          'methods'  => WP_REST_Server::READABLE,
          'callback' => array( $this, 'get_options' ),
          'permission_callback' => array( $this, 'get_private_data_permissions_check' )
      ),
      array(
          'methods'  => WP_REST_Server::CREATABLE,
          'callback' => array( $this, 'update_options' ),
          'permission_callback' => array( $this, 'get_private_data_permissions_check' )
      )
    ));

  }

  public function get_options(){
    $default_options = apply_filters( 'simple-weather-options', array() );
    $options = get_option( 'simple-weather-options', $default_options );
    $options['async'] = wp_validate_boolean( $options['async'] );
    $options['freq'] = intval( $options['freq'] );
    $options['timeout'] = intval( $options['timeout'] );
    $options['console_log'] = wp_validate_boolean( isset( $options['console_log'] ) ? $options['console_log'] : $default_options['console_log'] );
    return rest_ensure_response( $options );
  }

  public function update_options( $request ){
    $params = $request->get_body_params();
    foreach( $params as $key => $param ){
      $params[$key] = esc_attr( $param );
    }
    update_option( 'simple-weather-options', $params, true );
    return rest_ensure_response( 'Options updated.' );
  }

  function get_private_data_permissions_check() {
    if ( ! current_user_can('edit_posts') ) {
      return new WP_Error( 'rest_forbidden', esc_html__( 'OMG you can not view private data.', 'my-text-domain' ), array( 'status' => 401 ) );
    }

    return true;
  }

  function get_weather( WP_REST_Request $request ){

    $params = $request->get_body_params();

    return CurlySimpleWeather::get_weather_file_new( $params  );

  }

}

new SimpleWeatherRestApi();
