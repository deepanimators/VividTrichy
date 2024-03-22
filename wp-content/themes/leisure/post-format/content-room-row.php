<article id="post-<?php the_ID(); ?>" <?php post_class('room-listing-row animated'); ?>>
	<div class="row">
		<div class="col-sm-6">
			<div class="zoom-picture">
				<?php get_template_part( 'template-parts/featured', 'image' ); ?>
			</div>
		</div>
		<div class="col-sm-6">
			<header>
				<h3 class="post-title">
					<a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><?php the_title() ?></a>
					<small><?php get_template_part( 'template-parts/room', 'type' ); ?></small>
				</h3>
			</header>
			<div class="room-content">
				<?php the_excerpt() ?>
			</div>
			<?php get_template_part( 'template-parts/amenities', 'small' ); ?>
		</div>
	</div>
</article>