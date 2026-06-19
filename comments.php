<?php
/**
 * The template for displaying comments.
 *
 * @package Cide
 */

if ( post_password_required() ) {
	return;
}
?>
<div id="comments" class="comments-area">
	<?php
	if ( have_comments() ) :
		?>
		<h2 class="comments-title">
			<?php
			$cide_comment_count = get_comments_number();
			if ( '1' === $cide_comment_count ) {
				esc_html_e( 'One comment', 'cide' );
			} else {
				printf(
					/* translators: %s: comment count number. */
					esc_html( _nx( '%s comment', '%s comments', $cide_comment_count, 'comments title', 'cide' ) ),
					esc_html( number_format_i18n( $cide_comment_count ) )
				);
			}
			?>
		</h2>

		<ol class="comment-list">
			<?php
			wp_list_comments(
				array(
					'style'      => 'ol',
					'short_ping' => true,
				)
			);
			?>
		</ol>
		<?php
		the_comments_navigation();

		if ( ! comments_open() ) :
			?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'cide' ); ?></p>
			<?php
		endif;

	endif;

	comment_form();
	?>
</div>
