<article id="post-<?php the_ID(); ?>" <?php post_class('entry animated'); ?>>
	<header>
		<h2 class="post-title"><a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><?php the_title() ?></a></h2>
		<?php get_template_part( 'template-parts/meta' ); ?>
	</header>

	<?php 
		
		$gallery = get_post_gallery_images( $post->ID );
		if ( $gallery ) {
			$leisure_html = '<div class="gallery-carousel">';
			foreach ( $gallery as $image ) {
				$leisure_html .= '<div class="item"><a href="'.get_the_permalink().'"><img src="'.$image.'"></a></div>';
			}
			$leisure_html .= '</div>';
		}
		
		echo ( isset( $leisure_html ) ) ? $leisure_html : null;
	?>

</article>