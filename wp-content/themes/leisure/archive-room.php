<?php get_header( apply_filters( 'curly_get_header', esc_attr( get_theme_mod( 'layout_style_header', 'stretch' ) ) ) ); ?>

<div id="content">
	<div class="main-wrapper">
		<div class="container-fluid">
			<div class="row animated">
				<div class="col-sm-8" id="rooms">
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					     <?php get_template_part( 'post-format/content' , get_post_type().'-'.get_theme_mod( 'rooms_layout', 'row' ) ); ?>
					     <?php endwhile; ?>
					 <?php else : get_template_part('post-format/content' , 'missing'); endif; ?>

					 <?php get_template_part( 'template-parts/pagination' ); ?>

				</div><!-- .col-sm-8 -->
				<aside class="col-sm-4 col-lg-3 col-lg-offset-1" id="side">
					<?php get_template_part( 'template-parts/sidebar', 'rooms' ); ?>
				</aside><!-- .col-sm-3  -->
			</div><!-- .row -->
		</div><!-- .container -->
	</div>
</div><!-- #content -->

<?php get_footer(); ?>
