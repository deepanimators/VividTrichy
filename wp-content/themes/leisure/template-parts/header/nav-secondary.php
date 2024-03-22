<?php if ( has_nav_menu( 'menuSecondaryMenu' ) && class_exists( 'Curly_Extended_Menu' ) ) : ?>
<nav id="secondary-nav">
	<div class="main-wrapper">
		<div class="container-fluid">
			<input type="checkbox" class="toggle-nav-input" id="toggle-secondary-nav">
			<?php wp_nav_menu(
				array(
					'theme_location' => 'menuSecondaryMenu',
					'container' => null,
					'fallback_cb' => false,
					'depth' => 2,
					'walker' => new Curly_Extended_Menu
				)
			); ?>
		</div>
	</div>
</nav><!-- #secondary-nav -->
<?php endif; ?>
