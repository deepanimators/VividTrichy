<article id="post-<?php the_ID(); ?>" <?php post_class('entry animated'); ?>>
	<header>
		<h2 class="post-title"><a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><?php the_title() ?></a></h2>
		<?php get_template_part( 'template-parts/meta' ); ?>
	</header>

	<?php
		$leisure_attachment = get_attached_media( 'image' );
		$leisure_html = '<a href="'.get_the_permalink().'">'.wp_get_attachment_image( key($leisure_attachment) , 'full', null, array( 'class' => 'wp-post-image' ) ).'</a>';
		
		echo ( isset($leisure_html) ) ? $leisure_html : null;
	?>

</article>