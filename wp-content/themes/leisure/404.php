<?php get_header( apply_filters( 'curly_get_header', esc_attr( get_theme_mod( 'layout_style_header', 'stretch' ) ) ) ); ?>

<div id="content">
	<article <?php post_class(); ?>>
		<div class="main-wrapper">
			<div class="container-fluid">
				<div class="row animated">
					<div class="not-found col-lg-8 col-lg-offset-2 text-center">

						<!-- Google Script -->
						<script type="text/javascript">
						  var GOOG_FIXURL_LANG = '<?php echo substr( get_bloginfo('language'), 0, 2 ); ?>';
						  var GOOG_FIXURL_SITE = '<?php bloginfo('blog_url'); ?>'
						</script>
						<script type="text/javascript" src="http://linkhelp.clients.google.com/tbproxy/lh/wm/fixurl.js"></script>
						<!-- [end] Google Script -->

					</div>
				</div>
			</div>
		</div>
	</article>
</div><!-- #content -->

<?php get_footer(); ?>
