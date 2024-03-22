<?php // Template Name: FullWidth Page ?>
<?php get_header( apply_filters( 'curly_get_header', esc_attr( get_theme_mod( 'layout_style_header', 'stretch' ) ) ) ); ?>

<div id="content">
	<div <?php post_class( 'container-fluid' ); ?>>
					
		<!-- The Content -->
		<?php while ( have_posts() ) : the_post(); ?>
			<?php the_content() ?>			
		<?php endwhile; ?>
				
	</div>
</div><!-- #content -->
<?php get_footer(); ?>
