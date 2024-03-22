<?php

class CurlyComments extends Walker_Comment {
	var $tree_type = 'comment';
	var $db_fields = array( 'parent' => 'comment_parent', 'id' => 'comment_ID' );

	function __construct() { ?>

		<section id="comments" class="comments-list comments">

	<?php }

	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$GLOBALS['comment_depth'] = $depth + 2; ?>

		<section class="child-comments comments-list">

	<?php }

	function end_lvl( &$output, $depth = 0, $args = array() ) {
		$GLOBALS['comment_depth'] = $depth + 2; ?>

		</section>

	<?php }

	function start_el( &$output, $comment, $depth = 0, $args = array(), $id = 0 ) {
		$depth++;
		$GLOBALS['comment_depth'] = $depth;
		$GLOBALS['comment'] = $comment;
		$parent_class = ( empty( $args['has_children'] ) ? '' : 'parent' );

		if ( 'article' === $args['style'] ) {
			$tag = 'article';
			$add_below = 'comment';
		} else {
			$tag = 'article';
			$add_below = 'comment';
		} ?>

		<article <?php comment_class( isset( $args['has_children'] ) && empty( $args['has_children'] ) ? '' :'parent') ?> id="comment-<?php comment_ID() ?>" itemprop="comment" itemscope itemtype="http://schema.org/Comment" class="comment">
			<figure class="gravatar"><?php echo get_avatar( $comment, 60, 'http://s.gravatar.com/avatar/b47c7de6004b91a4f1ffaebff8f3a4a1?s=80', 'Author\'s gravatar' ); ?></figure>
			<div class="comment-meta post-meta" role="complementary">
				<h2 class="comment-author" itemprop="author">
					<?php comment_author(); ?>
				</h2>
				<time class="comment-meta-item" datetime="<?php comment_date('Y-m-d') ?>T<?php comment_time('H:iP') ?>" itemprop="datePublished"><?php comment_date('jS F Y') ?> @ <a href="#comment-<?php comment_ID() ?>" itemprop="url"><?php comment_time() ?></a></time>
				<?php if ( intval( $comment->comment_approved ) === 0 ) : ?>
				<p class="comment-meta-item"><?php _e( 'Your comment is awaiting moderation.', 'leisure' ) ?></p>
				<?php endif; ?>
			</div>
			<div class="comment-content post-content" itemprop="text">
				<?php comment_text() ?>
				<?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?><?php edit_comment_link('Edit','',''); ?>
			</div>

	<?php }

	function end_el(&$output, $comment, $depth = 0, $args = array() ) { ?>

		</article>

	<?php }

	function __destruct() { ?>

		</section>

	<?php }

}

/*	Threaded Comments
	================================================= */
	function curly_xtreme_enqueue_comments_reply() {
	    if( get_option( 'thread_comments' ) )  {
	        wp_enqueue_script( 'comment-reply' );
	    }
	}
	add_action( 'comment_form_before', 'curly_xtreme_enqueue_comments_reply' );

/*	Hide Comments
	================================================= */
	if ( get_theme_mod( 'comments', true ) === true ) {
		add_filter( 'comments_open', 'curly_comments_open', 10, 2 );

		function curly_comments_open( $open, $post_id ) {
			$post = get_post( $post_id );

				if ( 'page' == $post->post_type )
					$open = false;

				return $open;
		}
	}

?>
