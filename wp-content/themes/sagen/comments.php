<?php
if ( post_password_required() ) {
	return;
}

if ( comments_open() || get_comments_number() ) { ?>
	<div class="qodef-comment-holder clearfix" id="comments">
		<?php if ( have_comments() ) { ?>
			<div class="qodef-comment-holder-inner">
				<h4 class="qodef-comments-title"><?php esc_html_e( 'Comments', 'sagen' ); ?></h4>
				<div class="qodef-comments">
					<ul class="qodef-comment-list">
						<?php wp_list_comments( array_unique( array_merge( array( 'callback' => 'sagen_select_comment' ), apply_filters( 'sagen_select_filter_comments_callback', array() ) ) ) ); ?>
					</ul>
				</div>
			</div>
		<?php } ?>
		<?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) { ?>
			<p><?php esc_html_e( 'Sorry, the comment form is closed at this time.', 'sagen' ); ?></p>
		<?php } ?>
	</div>
	<?php
		$qodef_commenter = wp_get_current_commenter();
		$qodef_req       = get_option( 'require_name_email' );
		$qodef_aria_req  = ( $qodef_req ? " aria-required='true'" : '' );
		$qodef_consent   = empty( $qodef_commenter['comment_author_email'] ) ? '' : ' checked="checked"';

		$qodef_args = array(
			'id_form'              => 'commentform',
			'id_submit'            => 'submit_comment',
			'title_reply'          => esc_html__( 'Leave a Comment', 'sagen' ),
			'title_reply_before'   => '<h4 id="reply-title" class="comment-reply-title">',
			'title_reply_after'    => '</h4>',
			'title_reply_to'       => esc_html__( 'Post a Reply to %s', 'sagen' ),
			'cancel_reply_link'    => esc_html__( 'cancel reply', 'sagen' ),
			'label_submit'         => esc_html__( 'Send Us a Comment', 'sagen' ),
			'comment_field'        => apply_filters( 'sagen_select_filter_comment_form_textarea_field', '<textarea id="comment" placeholder="' . esc_attr__( 'Comment', 'sagen' ) . '" name="comment" cols="45" rows="1" aria-required="true"></textarea>' ),
			'comment_notes_before' => '',
			'comment_notes_after'  => '',
			'fields'               => apply_filters(
				'sagen_select_filter_comment_form_default_fields',
				array(
					'author'  => '<div class="qodef-grid-row"><div class="qodef-grid-col-4"><input id="author" name="author" placeholder="' . esc_attr__( 'Name', 'sagen' ) . '" type="text" value="' . esc_attr( $qodef_commenter['comment_author'] ) . '" ' . $qodef_aria_req . ' required /></div>',
					'email'   => '<div class="qodef-grid-col-4"><input id="email" name="email" placeholder="' . esc_attr__( 'Email', 'sagen' ) . '" type="text" value="' . esc_attr( $qodef_commenter['comment_author_email'] ) . '" ' . $qodef_aria_req . ' required /></div>',
					'url'     => '<div class="qodef-grid-col-4"><input id="url" name="url" placeholder="' . esc_attr__( 'Website', 'sagen' ) . '" type="text" value="' . esc_attr( $qodef_commenter['comment_author_url'] ) . '" size="30" maxlength="200" required/></div></div>',
					'cookies' => '<p class="comment-form-cookies-consent"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes" ' . $qodef_consent . ' />' .
						'<label for="wp-comment-cookies-consent">' . esc_html__( 'Save my name, email, and website in this browser for the next time I comment.', 'sagen' ) . '</label></p>',
				)
			),
			'submit_button'        => '<button name="%1$s" type="submit" id="%2$s" class="%3$s" value="%4$s"><i class="qodef-icon-ion-icon ion-android-mail qodef-icon-element"></i><span class="qodef-btn-text">%4$s</span></button>',
			'class_submit'         => 'qodef-btn qodef-btn-medium qodef-btn-outline',
		);

		$qodef_args = apply_filters( 'sagen_select_filter_comment_form_final_fields', $qodef_args );

		if ( get_comment_pages_count() > 1 ) {
			?>
		<div class="qodef-comment-pager">
			<p><?php paginate_comments_links(); ?></p>
		</div>
		<?php } ?>

	<?php
	$qodef_show_comment_form = apply_filters( 'sagen_select_filter_show_comment_form_filter', true );
	if ( $qodef_show_comment_form ) {
		?>
		<div class="qodef-comment-form">
			<?php comment_form( $qodef_args ); ?>
		</div>
	<?php } ?>
<?php } ?>
