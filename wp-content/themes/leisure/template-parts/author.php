<?php if( get_theme_mod( 'author', true ) !== true ) : ?>
<div class="about-author">
	<?php echo get_avatar(get_the_author_meta('email'), '72'); ?>
	<h4><?php the_author(); ?></h4>
    <?php the_author_meta("description"); ?>
</div>
<?php endif; ?>