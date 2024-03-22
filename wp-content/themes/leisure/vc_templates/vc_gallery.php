<?php
$output = $title = $type = $onclick = $custom_links = $img_size = $custom_links_target = $images = $el_class = $interval = '';
extract( shortcode_atts( array(
	'title' => '',
	'onclick' => 'link_image',
	'custom_links' => '',
	'custom_links_target' => '',
	'img_size' => 'thumbnail',
	'images' => '',
	'el_class' => '',
	'masonry' => 'fitRows'
), $atts ) );
$gal_images = '';
$link_start = '';
$link_end = '';
$el_start = '';
$el_end = '';
$slides_wrap_start = '';
$slides_wrap_end = '';

$gallery_carousel_id = uniqid();

$el_class = $this->getExtraClass( $el_class );
//$images = substr( $images, 0, -1 );
$images	= LeisureVisualComposer::check_against( $images, explode( ',', $images ) );
$links 	= LeisureVisualComposer::check_against( $custom_links, explode( ',', $custom_links ) );

if ( ! wp_script_is( 'isotope', 'enqueued' ) ) {
	wp_enqueue_script('isotope');
}


$output .= wpb_widget_title( array( 'title' => $title, 'extraclass' => 'wpb_gallery_heading' ) );
$output .= '<div class="gallery-container"><div class="gallery gallery-columns-'.$atts['columns'].' '.$el_class.'" data-masonry-layout="' . $masonry . '">';
if ( is_array( $images ) ) {
	foreach ( $images as $key => $image ) {
		$output .= '<div class="gallery-item">';
		$output .= $onclick == 'link_image' ? '<a href="'.wp_get_attachment_url($image).'" rel="lightbox" data-lightbox-gallery="'.$gallery_carousel_id.'" class="link-image" title="'.get_the_title($image).'">' : null;
		$output .= $onclick == 'custom_link' ? '<a href="'.$links[$key].'" title="'.get_the_title($image).'" target="'.( isset( $custom_links_target ) ? $custom_links_target : null ).'" >' : null;
		$output .= wp_get_attachment_image( $image, $img_size, false, array( 'class' => 'img-responsive' ) );
		$output .= $onclick == 'link_image' || $onclick == 'custom_link' ? '</a>' : null;
		$output .= '</div>';
	}
}
$output .= '</div></div>';

echo $output;
