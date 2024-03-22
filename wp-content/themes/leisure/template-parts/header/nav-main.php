<nav id="main-nav">
	<div class="main-wrapper">
		<div class="container-fluid">
			<div class="row">
				<div class="col-xs-12">
					<?php do_action( 'curly_logo' ) ?>
					<input type="checkbox" id="toggle-main-nav" class="toggle-nav-input">
					<?php wp_nav_menu( 
						array( 
							'theme_location' => 'menuMainMenu', 
							'container_class' => 'menu-container'
						)
					); ?>
				</div><!-- .col-xs-12 -->
			</div><!-- .row -->
		</div><!-- .container -->
		<?php if ( get_theme_mod( 'search_menu', true ) == 'true' ) : ?>
			<?php get_template_part( 'template-parts/header/search' ); ?>
		<?php endif; ?>
	</div>
</nav><!-- #main-nav -->