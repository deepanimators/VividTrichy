<?php if( class_exists( 'XtenderRoomRatings' ) ) : if ( post_password_required() ) return; global $xtender_ratings; ?>


<div id="reviews" class="reviews-area reviews row">
	<div class="col-sm-3">
		<h3 class="review-title">
	        <?php _e( 'Reviews', 'leisure' ); number_format_i18n( get_comments_number() )?>
	    </h3>
    <a href="#" class="btn btn-inline" data-toggle="modal" data-target="#modal-review"><?php _e( 'Sign a Review!', 'leisure' ) ?></a>
	</div>
	<?php if ( have_comments() ) : ?>
    <ul class="review-list col-sm-9">
		<?php wp_list_comments( array( 'callback' => array( $xtender_ratings, 'comments' )  ) ); ?>
    </ul>
    <?php else : ?>
    	<p class="noreviews"><?php _e( 'Currently there are not reviews. Be cool and make our first review!' , 'leisure' ); ?></p>
    <?php endif; if ( ! comments_open() && get_comments_number() ) : ?>
    	<p class="noreviews"><?php _e( 'Reviews are closed.' , 'leisure' ); ?></p>
    <?php endif; ?>

    <?php if ( have_comments() ) : if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
    <nav id="review-nav-below" class="navigation" role="navigation">
        <h1 class="assistive-text section-heading"><?php _e( 'Review navigation', 'leisure' ); ?></h1>
        <div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Reviews', 'leisure' ) ); ?></div>
        <div class="nav-next"><?php next_comments_link( __( 'Newer Reviews &rarr;', 'leisure' ) ); ?></div>
    </nav>
    <?php endif; endif; ?>

    <div class="modal fade" id="modal-review" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="<?php __('Leave Review','leisure') ?>">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" data-toggle="tooltip" title="<?php __( 'Close', 'leisure' ) ?>"><span>&times;</span><span class="sr-only"><?php __( 'Close', 'leisure' ) ?></span></button>
				</div>
				<div class="modal-body">
					<?php
					$curly_comments_args = array(
				        'title_reply' => __('Leave Review','leisure'),
				        'comment_notes_after'  => '',
				        'comment_notes_before' => '<div class="form-group"><div class="col-xs-12">',
				        'label_submit' => __( 'Submit Review' , 'leisure'),
				        'logged_in_as' => '<p>'. sprintf(__('You are logged in as %1$s. %2$sLog out &raquo;%3$s', 'leisure'), '<a href="'.get_option('siteurl').'/wp-admin/profile.php">'.$user_identity.'</a>', '<a href="'.(function_exists('wp_logout_url') ? wp_logout_url(get_permalink()) : get_option('siteurl').'/wp-login.php?action=logout" title="').'" title="'.__('Log Out', 'leisure').'">', '</a>') . '</p>',
				        'comment_field' => '<div class="form-group"><div class="comment-form-content col-lg-12"><label for="comment" class="input-textarea sr-only">' . __('<b>Review</b> ( * )','leisure'). '</label>
						<textarea class="required form-control" name="comment" id="comment" rows="4" placeholder="'.__( 'Review', 'leisure' ).'"></textarea></div></div>',

						'fields' => apply_filters( 'curly_rating_form_fields', array() ),
						);

					comment_form( $curly_comments_args );

					?>
				</div>
			</div>
		</div>
    </div><!-- modal -->
</div>
<?php endif; ?>
