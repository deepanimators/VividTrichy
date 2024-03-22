<?php $taxonomies = get_the_terms( get_the_id(), 'amenity' );  if( is_array( $taxonomies ) ) { ?>

	<div class="amenities full">
		<div class="row">
			<?php 
				
				foreach( $taxonomies as $tax ) {
					$t_id = $tax->term_id;
					$term_meta = get_option( "taxonomy_term_$t_id" );
					$icon = is_array( $term_meta ) ? $term_meta['icon'] : null;
			?>
				<div class="col-lg-2 col-sm-3 col-xs-6">
					<?php if( $icon ) echo do_shortcode("[hotel-icon icon=$icon size=2x class=color-primary tooltip='{$tax->description}']"); ?>
					<span class="center-block color-h1"><?php echo $tax->name ?></span>
				</div>
			<?php } ?>
		</div>
	</div>
	
<?php } ?>