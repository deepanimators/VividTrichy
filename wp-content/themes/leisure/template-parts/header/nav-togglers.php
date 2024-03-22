<div id="menu-togglers">
	<?php if ( has_nav_menu( 'menuSecondaryMenu' ) ) : ?>
	<label class="toggle-nav-label" for="toggle-secondary-nav">
		<i class="fa fa-star"></i> <?php echo apply_filters( 'curly_menu_name', 'menuSecondaryMenu' ); ?>
	</label>
	<?php endif; ?>
	<label class="toggle-nav-label" for="toggle-main-nav">
		<i class="fa fa-bars"></i> <?php echo has_nav_menu( 'menuMainMenu' ) ? 
			apply_filters( 'curly_menu_name', 'menuMainMenu' ) : __('Main Menu', 'leisure'); ?>
	</label>
</div><!-- .menu-togglers -->