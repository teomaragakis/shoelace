<?php
/**
 * The template for displaying comments
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package Shoelace
 * @since 0.1.0
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

	<?php if ( have_comments() ) : ?>
		<h3 class="comments-title">
			<?php
				printf( _nx( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'shoelace' ),
					number_format_i18n( get_comments_number() ), get_the_title() );
			?>
		</h3>


		<ul class="comment-list list-unstyled media">
			<?php
				wp_list_comments( array(
					'style'       => 'ul',
					'short_ping'  => true,
					'avatar_size' => 64,
					'walker' => new Bootstrap_Comment_Walker(),
				) );
			?>
		</ul><!-- .comment-list -->


	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'shoelace' ); ?></p>
	<?php endif;

	$commenter = wp_get_current_commenter();
  $req = get_option( 'require_name_email' );
  $aria_req = ( $req ? " aria-required='true'" : '' );

	$comment_args = array(
  	'class_submit' => 'btn btn-default',
  	'comment_field' =>  '<div class="form-group comment-form-comment"><label for="comment" class="control-label">' . _x( 'Comment', 'noun' ) .
    '</label><textarea id="comment" class="form-control" name="comment" rows="3" aria-required="true">' .
    '</textarea></div>',
    'fields' => array(

      'author' =>
        '<div class="form-group comment-form-author"><label class="control-label" for="author">' . __( 'Name', 'shoelace' ) . '</label> ' .
        ( $req ? '<span class="required">*</span>' : '' ) .
        '<input id="author" class="form-control" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
        '"' . $aria_req . ' /></div>',

      'email' =>
        '<div class="form-group comment-form-email"><label class="control-label" for="email">' . __( 'Email', 'shoelace' ) . '</label> ' .
        ( $req ? '<span class="required">*</span>' : '' ) .
        '<input id="email" class="form-control" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
        '"' . $aria_req . ' /></div>',

      'url' =>
        '<div class="form-group comment-form-url"><label class="control-label" for="url">' . __( 'Website', 'shoelace' ) . '</label>' .
        '<input id="url" class="form-control" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
        '" /></div>',
    ),
	);

	comment_form($comment_args); ?>

  </div><!-- .comments-area -->
