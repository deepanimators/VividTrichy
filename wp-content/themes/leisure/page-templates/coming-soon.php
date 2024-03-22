<?php // Template Name: Coming Soon Page ?>
<?php 
	
	if( ! wp_script_is('curly-vertical-align') ) { 
		wp_enqueue_script('curly-vertical-align');
	}
	
	add_action( 'wp_footer', 'curly_coming_soon_position', 100 );
	
	function curly_coming_soon_position() {
		global $post;
		$leisure_video_cover = get_post_meta( $post->ID, THEMEPREFIX.'_video_cover', true );
		$leisure_video_cover = ( $leisure_video_cover ) ? "poster: '$leisure_video_cover'," : null;
		$leisure_video_mp4 = get_post_meta( $post->ID, THEMEPREFIX.'_video_mp4', true );
		$leisure_video_mp4 = ( $leisure_video_cover ) ? "mp4: '$leisure_video_mp4'," : null;
		$leisure_video_ogg = get_post_meta( $post->ID, THEMEPREFIX.'_video_ogg', true );
		$leisure_video_ogg = ( $leisure_video_cover ) ? "ogg: '$leisure_video_ogg'," : null;
		$leisure_video_webm = get_post_meta( $post->ID, THEMEPREFIX.'_video_webm', true );
		$leisure_video_webm = ( $leisure_video_cover ) ? "webm: '$leisure_video_webm'," : null;
		
		echo "
		<script type='text/javascript'>
			(function ($) {
			    'use strict';
			    $('#coming-soon-container').background({
			    	source: {
			    		$leisure_video_cover
			    		$leisure_video_mp4
			    		$leisure_video_ogg
			    		$leisure_video_webm
			    	}
			    });
			})(jQuery);
			
		</script>";
	}
	
get_header('blank'); ?>
<div id="coming-soon" <?php post_class(); ?>>
	<div class="main-wrapper white-box">
		<div class="container-fluid">
			<div class="row animated">
				<div class="col-sm-6 col-sm-offset-3">
					<?php while ( have_posts() ) : the_post(); ?>
					<?php the_content() ?>		
					<?php endwhile; ?>	
				</div>
			</div><!-- .row -->
		</div><!-- .container -->
	</div>
</div><!-- #coming-soon -->
<div id="coming-soon-container"></div><!-- #coming-soon-container -->
<?php get_footer('blank'); ?>
