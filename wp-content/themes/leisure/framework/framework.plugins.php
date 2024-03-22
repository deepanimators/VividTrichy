<?php
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.4.0
 * @author     Thomas Griffin <thomasgriffinmedia.com>
 * @author     Gary Jones <gamajo.com>
 * @copyright  Copyright (c) 2014, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/thomasgriffin/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 */
require_once( trailingslashit( get_template_directory() ) . 'plugins/class-tgm-plugin-activation.php' );

add_action( 'tgmpa_register', 'leisure_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function leisure_register_required_plugins() {

    /**
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
	$plugins_base = 'https://39mqioqkze.execute-api.us-east-1.amazonaws.com/prod/get-plugin';
	$plugins = array(
		'xtender' => array( '1.5.4', '6cd78e3a-7ecb-43d4-83a6-8fa9144a1c89' ),
		'js_composer' => array( '6.7.0', '4ac55675-3cd9-441f-bdac-1d6ae6e8a575' ),
		'revslider' => array( '6.5.6', 'c231e292-8763-4769-b26d-0b067d9a4aee' ),
		'weekly-class' => array( '2.5.17', '915BD551-FDD3-4A9E-B0DC-A61FC2700149' )
	);
    $plugins = array(
      array(
         'name' 					=> 'WPBakery Page Builder',
         'slug' 					=> 'js_composer',
         'source' 				=> add_query_arg( array( 'id' => $plugins['js_composer'][1] ), $plugins_base ),
         'required' 			=> true,
         'version' 				=> $plugins['js_composer'][0],
         'force_activation' 		=> false,
         'force_deactivation' 	=> false,
         'external_url' 			=> '',
      ),
	    array(
		    'name' 					=> esc_html__( 'Revolution Slider', 'leisure' ),
		    'slug' 					=> 'revslider',
		    'source' 				=> add_query_arg( array( 'id' => $plugins['revslider'][1] ), $plugins_base ),
		    'required' 			    => true,
		    'version' 				=> $plugins['revslider'][0],
		    'force_activation' 		=> false,
		    'force_deactivation' 	=> false,
		    'external_url' 			=> '',
	    ),
      array(
          'name' 					=> 'Simple Weather',
          'slug' 					=> 'simple-weather',
          'source' 				=> add_query_arg( array( 'id' => "8fc0f5e0-5142-4453-bf09-72461ff77c2c" ), $plugins_base ),
          'required' 				=> false,
          'version' 				=> '4.4.1',
          'force_activation' 		=> false,
          'force_deactivation' 	=> false,
          'external_url' 		=> '',
      ),
	    array(
		    'name' 					=> esc_html__( 'xtender', 'leisure' ),
		    'slug' 					=> 'xtender',
		    'source' 				=> add_query_arg( array( 'id' => $plugins['xtender'][1] ), $plugins_base ),
		    'required' 			    => true,
		    'version' 				=> $plugins['xtender'][0],
		    'force_activation' 		=> false,
		    'force_deactivation' 	=> false,
		    'external_url' 			=> '',
	    ),
      array(
          'name' 					=> 'Ninja Forms',
          'slug' 					=> 'ninja-forms',
          'required' 			=> true
      )
    );

    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
    	'domain'       		=> 'leisure',
    	'default_path' 		=> '',
    	'menu'         		=> 'tgmpa-install-plugins',
    	'has_notices'      	=> true,
    	'is_automatic'    	=> false,
    	'dismissable'  		=> true,
    	'message' 			=> '',
        'strings'      => array(
            'page_title'                      => __( 'Install Required Plugins', 'leisure' ),
            'menu_title'                      => __( 'Install Plugins', 'leisure' ),
            'installing'                      => __( 'Installing Plugin: %s', 'leisure' ), // %s = plugin name.
            'oops'                            => __( 'Something went wrong with the plugin API.', 'leisure' ),
            'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'leisure' ), // %1$s = plugin name(s).
            'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'leisure' ), // %1$s = plugin name(s).
            'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'leisure' ), // %1$s = plugin name(s).
            'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'leisure' ), // %1$s = plugin name(s).
            'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'leisure' ), // %1$s = plugin name(s).
            'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'leisure' ), // %1$s = plugin name(s).
            'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'leisure' ),
            'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'leisure' ), // %1$s = plugin name(s).
            'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'leisure' ),
            'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins', 'leisure' ),
            'return'                          => __( 'Return to Required Plugins Installer', 'leisure' ),
            'plugin_activated'                => __( 'Plugin activated successfully.', 'leisure' ),
            'complete'                        => __( 'All plugins installed and activated successfully. %s', 'leisure' ), // %s = dashboard link.
            'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
        )
    );

    tgmpa( $plugins, $config );

}
?>
