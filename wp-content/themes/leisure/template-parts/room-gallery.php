<?php 
	
	$room_gallery = get_post_meta( get_the_id(), '_' . THEMEPREFIX . '_gallery', true ); 
	
	if( ! empty( $room_gallery ) ) { 
		
		$room_gallery = explode( ',', substr( $room_gallery, 0, -1 ) );
		
	?>
	
		<div class="gallery gallery-columns-8" data-masonry-layout="fitRows">
		<?php 
			foreach ( $room_gallery as $key => $image ) {
			echo '<div class="gallery-item"><a href="'.wp_get_attachment_url($image).'"  rel="lightbox" data-lightbox-gallery="room-gallery" class="link-image">'.wp_get_attachment_image( $image, 'thumbnail', null, array( 'class' => '' ) ).'</a></div>';
			} 
		?>
		</div>
		<?php 
	}
?>
