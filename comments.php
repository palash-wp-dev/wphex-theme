<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Bytesed
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) :
		?>
        <h2 class="comments-title">
			<?php
			$bytesed_comment_count = get_comments_number();
			if ( '1' === $bytesed_comment_count ) {
				printf(
				/* translators: 1: title. */
					esc_html__( '1 Comment', 'bytesed' )

				);
			} else {
				printf( // WPCS: XSS OK.
				/* translators: 1: comment count number, 2: title. */
					esc_html( _nx( '%1$s Comments &ldquo;%2$s&rdquo;', '%1$s Comments ', $bytesed_comment_count, 'comments title', 'bytesed' ) ),
					number_format_i18n( $bytesed_comment_count )
				);
			}
			?>
        </h2><!-- .comments-title -->

        <div class="blog-comment-navigation">
			<?php the_comments_navigation(); ?>
        </div>
        <div class="clearfix"></div>
        <ul class="comment-list">
			<?php
			wp_list_comments( array(
				'style'      => 'ul',
				'callback' => 'bytesed_comment_modification',
				'short_ping' => true,
			) );
			?>
        </ul><!-- .comment-list -->
        <div class="blog-comment-navigation">
			<?php the_comments_navigation(); ?>
        </div>
		<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() ) :
			?>
            <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'bytesed' ); ?></p>
		<?php
		endif;

	endif; // Check for have_comments().
	$fields = array(
		'author' => ' <div class="blog_details__comment__form custom-form mt-4"><div class="single-flex-input"><div class="single-input">
                        <label for="firstName" class="label-title">' . esc_html__( "First Name", "bytesed" ) . '</label>
                        <input type="text" name="first-name" id="firstName" class="form--control radius-10" value="' . esc_attr( $commenter['comment_author'] ) . '" placeholder="'.esc_attr__('Enter First Name','bytesed').'">
                    </div><div class="single-input">
                        <label for="lastName" class="label-title">' . esc_html__( "Last Name", "bytesed" ) . '</label>
                        <input type="text" name="last-name" id="lastName" class="form--control radius-10" value="' . esc_attr( $commenter['comment_author'] ) . '" placeholder="'.esc_attr__('Enter Last Name','bytesed').'">
                    </div></div></div>',
	);

    comment_form( array(
		'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
		'comment_notes_before' => '',
		'comment_notes_after'  => '',
		'title_reply'          => esc_html__( 'Leave A Comment', 'bytesed' ),
		'title_reply_to'       => esc_html__( 'Leave A Reply To %s', 'bytesed' ),
		'id_form'              => 'commentform',
		'id_submit'            => 'submit',
		'cancel_reply_link'    => '<i class="fas fa-times"></i>',
		'class_submit'         => 'submit-btn',
		'label_submit'         => esc_html__( 'Submit Comment', 'bytesed' ),
		'comment_field'        => '<div class="blog_details__comment__form custom-form mt-4"><div class="single-input">
                                        <label for="comment" class="label-title">Your Comment</label>
                                        <textarea name="message" class="form-message" id="comment" cols="100" rows="7" placeholder="' . esc_attr__( 'Write Your Comment...', 'bytesed' ) . '"></textarea>
                                    </div></div>'
	) );

	?>

</div><!-- #comments -->
