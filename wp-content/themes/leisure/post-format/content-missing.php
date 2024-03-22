<article id="post-<?php the_ID(); ?>" <?php post_class('entry animated'); ?>>
	<header>
		<h2 class="post-title"><?php _e( 'Nothing Found', 'leisure' ); ?></h2>
	</header>
	
	<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'leisure' ); ?></p>
	<?php get_search_form(); ?>
</article>