<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="apple-mobile-web-app-capable" content="yes">
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php wp_site_icon(); ?>
<?php wp_head(); ?>
</head>

<body <?php body_class( 'wrapper-content-padding' ); ?>>
	<?php do_action( 'curly_before_site' ); ?>	
	<div id="site">
		<header id="header" class="header-content header-transparent">
			<div class="header-row clearfix">
				<?php get_template_part( 'template-parts/header/tag-lines' ); ?>
				<?php get_template_part( 'template-parts/header/nav', 'main' ) ?>
				<?php get_template_part( 'template-parts/header/nav', 'secondary' ) ?>
				<?php get_template_part( 'template-parts/header/nav', 'togglers' ) ?>
			</div><!-- .header-row -->
			<?php get_template_part( 'template-parts/header/heading' ); ?>
		</header><!-- #header -->
		<?php do_action( 'curly_header_slider' ); ?>