<div class="entry-meta">
	<?php 
	
	ob_start();
	comments_number(  __( 'No Comments', 'leisure' ), __( '1 Comment', 'leisure' ), __( '% Comments', 'leisure' ));
	$leisure_comments = ob_get_clean();
	
	$leisure_output = __( '<em><i class="fa fa-calendar"></i> %1$s &nbsp;&nbsp; </em><em><i class="fa fa-comments-o"></i> %2$s</em>', 'leisure' );
	
	echo sprintf( $leisure_output, get_the_date(), $leisure_comments );
	
	 ?>
</div>