<?php

/**
 * User Profile
 *
 * @package bbPress
 * @subpackage Theme
 */

?>
	<?php do_action( 'bbp_template_before_user_profile' ); ?>
	
	<div id="bbp-user-profile" class="bbp-user-profile">
		<h2><?php _e( 'Profile', 'leisure' ); ?></h2>
		<div class="bbp-user-section">

			<?php if ( bbp_get_displayed_user_field( 'description' ) ) : ?>

				<p><?php bbp_displayed_user_field( 'description' ); ?></p>

			<?php endif; ?>

			<p><?php  printf( __( 'Forum Role: %s',      'leisure' ), bbp_get_user_display_role()    ); ?><br>
			<?php printf( __( 'Topics Started: %s',  'leisure' ), bbp_get_user_topic_count_raw() ); ?><br />
			<?php printf( __( 'Replies Created: %s', 'leisure' ), bbp_get_user_reply_count_raw() ); ?></p>
		</div>
	</div><!-- #bbp-author-topics-started -->

	<?php do_action( 'bbp_template_after_user_profile' ); ?>
	