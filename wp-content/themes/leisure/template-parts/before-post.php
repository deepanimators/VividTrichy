<?php if( leisure_is_blog() ) : ?>
<aside class="blog-sort">
	<div class="main-wrapper">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12 text-right">
					<?php echo '<a href="'.get_permalink(get_option('page_for_posts')).'" class="pull-left">'.__('Return to ', 'leisure').get_the_title(get_option('page_for_posts')).'</a>';  ?>
					
					<?php previous_post_link('%link', __('<span class="nav-links no-wrap"><i class="fa fa-angle-left"></i> Previous Post</span>', 'leisure')); ?>
					<?php next_post_link('%link', __('<span class="nav-links no-wrap nav-links-next">Next Post <i class="fa fa-angle-right"></i></span>', 'leisure')); ?> 
				</div>
			</div>
		</div>
	</div>
</aside>
<?php endif; ?>