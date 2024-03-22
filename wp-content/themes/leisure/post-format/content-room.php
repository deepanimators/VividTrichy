<article id="post-<?php the_ID(); ?>" <?php post_class('entry single'); ?>>
	<?php get_template_part( 'template-parts/featured', 'image' ); ?>
	<?php get_template_part( 'template-parts/room', 'gallery' ); ?>
	<?php get_template_part( 'template-parts/amenities', 'full' ); ?>
	
	<div class="entry-content room">
	
		<!-- Content -->
		<?php the_content() ?>
		
		<!-- Link Pages -->
		<?php wp_link_pages(); ?>	
		
	</div>
	
	<!-- Post Navigation -->
		<?php if( get_theme_mod( 'post_navigation', false ) === false ) the_post_navigation(); ?>
	
	<!-- Comments -->
	<?php if ( get_theme_mod( 'rooms' ) !== true ) comments_template( '/comments-reviews.php' ); ?>
	
</article>