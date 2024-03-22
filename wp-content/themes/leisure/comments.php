<?php if ( post_password_required() ) return; ?>
<div id="comments" class="comments-area comments content-padding">
	<?php if ( have_comments() ) : ?>
    <h3 class="comments-title">
        <?php
            printf( _n( 'One comment for &ldquo;%2$s&rdquo;', '%1$s comments on &ldquo;%2$s&rdquo;', get_comments_number(), 'leisure' ),
                    number_format_i18n( get_comments_number() ), 
                    '<strong>' . get_the_title() . '</strong>' );
        ?>
    </h3>
    <?php wp_list_comments( array( 'walker' => new CurlyComments() ) ); ?>

    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
    <nav id="comment-nav-below" class="navigation" role="navigation">
        <h1 class="assistive-text section-heading"><?php _e( 'Comment navigation', 'leisure' ); ?></h1>
        <div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'leisure' ) ); ?></div>
        <div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'leisure' ) ); ?></div>
    </nav>
    <?php endif; 
	
    if ( ! comments_open() && get_comments_number() ) : ?>
    <p class="nocomments"><?php _e( 'Comments are closed.' , 'leisure' ); ?></p>
    
    <?php endif; endif; 
	
	$leisure_req = get_option( 'require_name_email' );
	
	$leisure_comments_args = array(
        /*:: Title*/
        'title_reply' => __('Leave Comment','leisure'),
        /*:: After Notes*/
        'comment_notes_after'  => '',
        /*:: Before Notes*/
        'comment_notes_before' => '',
        /*:: Submit*/
        'label_submit' => __( 'Submit Comment' , 'leisure'),
        /*:: Logged In*/
        'logged_in_as' => '<p>'. sprintf(__('You are logged in as %1$s. %2$sLog out &raquo;%3$s', 'leisure'), '<a href="'.get_option('siteurl').'/wp-admin/profile.php">'.$user_identity.'</a>', '<a href="'.(function_exists('wp_logout_url') ? wp_logout_url(get_permalink()) : get_option('siteurl').'/wp-login.php?action=logout" title="').'" title="'.__('Log Out', 'leisure').'">', '</a>') . '</p>',
        /*:: Comment Field*/
        'comment_field' => '<div class="form-group"><div class="comment-form-content col-lg-12"><label for="comment" class="input-textarea sr-only">' . __('<b>Comment</b> ( * )','leisure'). '</label>
		<textarea class="required form-control" name="comment" id="comment" rows="4" placeholder="'.__( 'Comment', 'leisure' ).'"></textarea></div></div>',
		
		'fields' => apply_filters( 'comment_form_default_fields', array(
		
		    'author' =>
		      '<div class="form-group">' .
		      '<div class="comment-form-author col-lg-6" '.( $leisure_req ? "data-required" : null ).'>'.
		      '<label for="author" class="sr-only">'.__( 'Name', 'leisure' ).'</label> ' .
		      '<input class="form-control" id="author" name="author" type="text" placeholder="'.__( 'Name', 'leisure' ).'" value="' . esc_attr( $commenter['comment_author'] ) .'" size="30" /></div>',
		
		    'email' =>
		      '<div class="comment-form-email col-lg-6" '.( $leisure_req ? "data-required" : null ).'><label for="email" class="sr-only">'.__( 'Email', 'leisure' ).'</label> ' .
		      '<input class="form-control" id="email" name="email" type="text" placeholder="'.__( 'Email', 'leisure' ).'" value="'. esc_attr(  $commenter['comment_author_email'] ) .
		      '" size="30" /></div></div>',
		
		    'url' =>
		      '<div class="form-group"><div class="comment-form-url col-lg-12"><label for="url" class="sr-only"><strong>' .
		      __( 'Website', 'leisure' ) . '</strong></label>' .
		      '<input class="form-control" id="url" name="url" type="text" placeholder="'.__( 'Website', 'leisure' ).'"  value="' . esc_attr( $commenter['comment_author_url'] ) .
		      '" size="30" /></div></div>'
		    )
		  ),
		);
		
	comment_form( $leisure_comments_args );
	
	?>	
</div>
