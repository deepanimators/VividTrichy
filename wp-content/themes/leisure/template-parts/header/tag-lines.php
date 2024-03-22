<?php if( apply_filters( 'curly_taglines', true ) === true ) : ?>
<div class="main-wrapper">
<div class="container-fluid">
	<div class="row">
		<div class="col-xs-12 absolute-header text-uppercase">
			<div class="pull-left">
				<?php do_action( 'curly_tagline_left' ); ?>
			</div><!-- .pull-left -->
			<div class="pull-right">
				<?php do_action( 'curly_tagline_right' ); ?>
			</div><!-- .pull-right -->
		</div><!-- .absolute-header -->
	</div><!-- .row -->
</div><!-- .container -->
</div>

<?php endif; ?>