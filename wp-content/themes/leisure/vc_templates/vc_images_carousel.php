<?php
$output = $title = $onclick = $custom_links = $img_size = $custom_links_target = $images = $el_class = $partial_view = '';
$mode = $slides_per_view = $wrap = $autoplay = $hide_pagination_control = $hide_prev_next_buttons = $speed = '';
extract( shortcode_atts( array(
	'title' => '',
	'onclick' => 'link_image',
	'custom_links' => null,
	'custom_links_target' => null,
	'img_size' => 'thumbnail',
	'images' => '',
	'el_class' => null,
	'slides_per_view' => '1',
	'wrap' => 'false',
	'autoplay' => 'true',
	'hide_pagination_control' => '',
	'hide_prev_next_buttons' => '',
	'speed' => '5000',
	'next' => null,
	'prev' => null
), $atts ) );

$el_class = $this->getExtraClass( $el_class );

$gallery_carousel_id = uniqid();

$images	= LeisureVisualComposer::check_against( $images, explode( ',', $images ) );
$links 	= LeisureVisualComposer::check_against( $custom_links, explode( ',', $custom_links ) );
$items 	= LeisureVisualComposer::check_against( $slides_per_view, $slides_per_view, 1 );
$nav 	= LeisureVisualComposer::check_against( $hide_prev_next_buttons, 'false', 'true', null, null, true );
$dots 	= LeisureVisualComposer::check_against( $hide_pagination_control, 'false', 'true', null, null, true );
$loop 	= filter_var( $wrap, FILTER_VALIDATE_BOOLEAN ) ? 'true' : 'false';
$autoplay 	= LeisureVisualComposer::check_against( $autoplay, 'true', 'false', null, null, true );
$autoplay_speed = LeisureVisualComposer::check_against( $speed, $speed, 5000 );
$nav_text = ( isset( $next ) && isset( $prev ) ) ? '["'.$prev .'","'.$next.'"]' : '[]';

$output  = wpb_widget_title( array( 'title' => $title, 'extraclass' => 'wpb_gallery_heading' ) );

if ( $nav == 'false' ) {
	$el_class .= ' owl-with-navigation';
}

if ( 'custom_link' === $onclick ) {
	$links = vc_value_from_safe( $custom_links );
	$links = explode( ',', $links );
}

$el_class .= ' gallery-carousel';

$output .= "<div class='gallery-carousel-container'><div data-owl-items='$items' data-owl-nav='$nav' data-owl-nav-text='$nav_text' data-owl-loop='$loop' data-owl-autoplay='$autoplay' data-owl-speed='$autoplay_speed' data-owl-dots='$dots' " . LeisureVisualComposer::check_against( $el_class, null, null, 'class="', '"' ) . ">";

if ( is_array( $images ) ) {
	foreach ( $images as $key => $image ) {
		$output .= '<div class="item">';
		$output .= $onclick == 'link_image' ? '<a href="'.wp_get_attachment_url($image).'" rel="lightbox" data-lightbox-gallery="'.$gallery_carousel_id.'" title="'.get_the_title($image).'">' : null;
		$output .= $onclick == 'custom_link' ? '<a href="'.$links[$key].'" title="'.get_the_title($image).'" target="'.LeisureVisualComposer::check_against( $custom_links_target ).'" >' : null;
		$output .= wp_get_attachment_image( $image, 'full' );
		$output .= $onclick == 'link_image' || $onclick == 'custom_link' ? '</a>' : null;
		$output .= '</div>';
	}
}
$output .= '</div></div>';

echo $output;

?>
