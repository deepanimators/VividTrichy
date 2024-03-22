<article id="post-<?php the_ID(); ?>" <?php post_class('entry animated row'); ?>>
	<?php if( has_post_thumbnail( get_the_id() ) ) : ?>
		<div class="col-sm-6">
			<?php get_template_part( 'template-parts/featured', 'image' ); ?>
		</div>
		<div class="col-sm-6"> 
			<header>
				<h3 class="post-title"><a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><?php the_title() ?></a></h3>
			</header>
			<?php get_template_part( 'template-parts/meta' ); ?>
			<div class="post-excerpt">
				<?php the_excerpt(); ?>
			</div>
			<a href="<?php the_permalink(); ?>" title="<?php the_title() ?>" class="btn btn-link">
				<?php echo _e('Read More', 'leisure') ?>
			</a>
			
			<?php wp_link_pages(); ?>
		</div>
	<?php else : ?>
		<div class="col-sm-12"> 
			<header>
				<h3 class="post-title"><a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><?php the_title() ?></a></h3>
			</header>
			<?php get_template_part( 'template-parts/meta' ); ?>
			<div class="post-excerpt">
				<?php the_excerpt(); ?>
			</div>
			<a href="<?php the_permalink(); ?>" title="<?php the_title() ?>" class="btn btn-link">
				<?php echo _e('Read More', 'leisure') ?>
			</a>
			
			<?php wp_link_pages(); ?>
		</div>
	<?php endif; ?>
</article>