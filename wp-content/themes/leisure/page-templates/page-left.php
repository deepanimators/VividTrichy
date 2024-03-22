<?php // Template Name: Left Sidebar Page ?>
<?php get_header( apply_filters( 'curly_get_header', esc_attr( get_theme_mod( 'layout_style_header', 'stretch' ) ) ) ); ?>
<div id="content">
	<article <?php post_class(); ?>>
		<div class="main-wrapper">
			<div class="container-fluid">
				<div class="row animated">
					<div class="col-sm-8 col-sm-push-4">

						<?php while ( have_posts() ) : the_post(); ?>
						<?php the_content() ?>
						<?php endwhile; ?>

						<!-- Sharing -->
						<?php get_template_part( 'template-parts/sharing' ); ?>

						<!-- Comments -->
						<?php get_template_part( 'template-parts/comments' ); ?>

					</div>

					<div class="col-sm-4 col-sm-pull-8 col-lg-3" id="side">
						<?php get_template_part( 'template-parts/sidebar', 'page' ); ?>
					</div>

				</div>
			</div>
		</div>
	</article>
</div><!-- #content -->
<?php get_footer(); ?>
