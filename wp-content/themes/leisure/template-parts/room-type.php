<?php $terms = get_the_terms( get_the_id(), 'type' );  if( is_array( $terms ) ) { ?>
	<ul class="list-inline room-types">
		<?php foreach( $terms as $term ) : ?>
		<li><?php echo $term->name; ?></li>
		<?php endforeach; ?>
	</ul>
<?php } ?>