<?php
$output = $title = '';

extract(shortcode_atts(array(
	'title' => __("Section", "leisure")
), $atts));

$fold = 'curly_accordions_'.$_SESSION['curly_accordion'];
if ( isset( $_SESSION[$fold] ) ) {
	$_SESSION[$fold] = $_SESSION[$fold] + 1;
} else {
	$_SESSION[$fold] = 0;
}

$output .= '<div class="panel panel-default">';
$output .= '<div class="panel-heading">';
$output .= '<h4 class="panel-title">';
$output .= '<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion-'.$_SESSION['curly_accordion'].'" href="#fold-'.$_SESSION['curly_accordion'].'-'.$_SESSION[$fold].'">'.$title.'</a>';
$output .= '</h4>';
$output .= '</div>';
$output .= '<div id="fold-'.$_SESSION['curly_accordion'].'-'.$_SESSION[$fold].'" class="panel-collapse collapse">';
$output .= '<div class="panel-body">';
$output .= do_shortcode( $content );
$output .= '</div>';
$output .= '</div>';
$output .= '</div>';

echo $output;
