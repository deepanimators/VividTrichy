<?php get_header( apply_filters( 'curly_get_header', esc_attr( get_theme_mod( 'layout_style_header', 'stretch' ) ) ) ); ?>

<div id="content">
	<div <?php post_class(); ?>>
		<div class="main-wrapper">
			<div class="container-fluid">
				<article class="row animated">
					<div class="col-sm-12">	
					
						<!-- The Content -->
						<?php while ( have_posts() ) : the_post(); ?>
							<?php the_content() ?>			
						<?php endwhile; ?>
						
						<!-- Sharing -->
						<?php get_template_part( 'template-parts/sharing' ); ?>
						
					</div><!-- .col-sm-12 -->
				</article>
				
				<!-- Comments -->
				<?php get_template_part( 'template-parts/comments' ); ?>
					
			</div><!-- .container -->
		</div>
	</div>
</div><!-- #content -->
<?php get_footer(); ?>
