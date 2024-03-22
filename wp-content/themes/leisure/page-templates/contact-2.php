<?php

// Template Name: Contact Page 2

get_header( apply_filters( 'curly_get_header', esc_attr( get_theme_mod( 'layout_style_header', 'stretch' ) ) ) );

$leisure_latitude 	= get_post_meta( $post->ID, THEMEPREFIX . '_latitude', true );
$leisure_longitude 	= get_post_meta( $post->ID, THEMEPREFIX . '_longitude', true );
$leisure_height 		= get_post_meta( $post->ID, THEMEPREFIX . '_map_height', true );
$leisure_zoom 		= get_post_meta( $post->ID, THEMEPREFIX . '_map_zoom', true );
$leisure_map_type 	= get_post_meta( $post->ID, THEMEPREFIX . '_map_type', true );
$leisure_theme 		= get_post_meta( $post->ID, THEMEPREFIX . '_map_theme', true );
$leisure_side 		= get_post_meta( $post->ID, THEMEPREFIX . '_contact_side', true );

$leisure_height 	= $leisure_height ? $leisure_height : 400;
$leisure_zoom   	= $leisure_zoom ? $leisure_zoom : 12;
$leisure_map_type = $leisure_map_type ? $leisure_map_type : 'roadmap';
$leisure_theme 	= $leisure_theme ? $leisure_theme : 'default';

?>
<div id="content">
	<article <?php post_class(); ?>>
		<div class="main-wrapper">
			<section class="container-fluid">
				<div class="row content-padding visible-xs">
					<div class="col-xs-12">
						<?php $leisure_contact->side( $leisure_side ); ?>
					</div>
				</div><!-- .row -->
				<div class="row animated">
					<div class="col-sm-12">
						<?php while ( have_posts() ) : the_post(); ?>

						<?php the_content(); ?>

						<?php endwhile; ?>
					</div><!-- #side -->
				</div><!-- .row -->
			</section><!-- .container -->
		</div>
		<section id="map-holder" <?php echo ( $leisure_height ) ? 'style="min-height: '.$leisure_height.'px"' : null ?>>
			<?php if ( $leisure_side ) : ?>
			<div id="map-description" class="hidden-xs content-padding">
				<div class="main-wrapper">
					<div class="container-fluid">
						<div class="row animated">
							<div class="col-lg-4 col-lg-offset-8 col-sm-5 col-sm-offset-7">
								<div>
									<?php $leisure_contact->side( $leisure_side ); ?>
								</div>
							</div>
						</div><!-- .row -->
					</div><!-- .container -->
				</div>
			</div><!-- #map-description -->
			<?php endif; ?>
			<?php $leisure_contact->map( $leisure_latitude, $leisure_longitude, $leisure_height, $leisure_map_type, $leisure_zoom, $leisure_theme ); ?>
		</section><!-- #map-holder -->
	</article>
</div><!-- #content -->
<?php get_footer(); ?>
