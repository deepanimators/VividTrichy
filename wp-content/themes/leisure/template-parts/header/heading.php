<?php global $leisure_core; if( $leisure_core->check_heading() === true ) : ?>
<div id="page-heading">
	<div class="main-wrapper">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-12">
					<?php echo $leisure_core->get_page_heading('<h1 class="page-title">', '</h1>'); ?>
				</div><!-- .col-sm-12 -->
			</div><!-- .row -->
		</div><!-- .container -->
	</div>
</div><!-- #page-heading -->
<?php endif; ?>
