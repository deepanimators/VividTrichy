<?php $taxonomies = get_the_terms( get_the_id(), 'amenity' );  if( is_array( $taxonomies ) ) { $i = 0; ?>

	<div class="amenities small">
		<ul class="list-inline">
			<?php 
				
				foreach( $taxonomies as $tax ) { $i++;
					$t_id = $tax->term_id;
					$term_meta = get_option( "taxonomy_term_$t_id" );
					$icon = is_array( $term_meta ) ? $term_meta['icon'] : null;
			?>
				<li>
					<?php if( $icon && $i <= 5 ) echo do_shortcode("[hotel-icon icon=$icon size=lg class=color-primary boxed=yes tooltip='{$tax->description}']"); ?>
				</li>
			<?php } ?>
		</ul>
	</div>
	
<?php } ?>