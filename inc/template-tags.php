<?php
/**
 * Custom template tags for this theme.
 *
 * @package Cide
 */

if ( ! function_exists( 'cide_posted_on' ) ) {
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function cide_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		printf(
			'<span class="posted-on">%1$s %2$s</span>',
			esc_html_x( 'Posted on', 'post date', 'cide' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>' // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- already escaped above.
		);

		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', 'cide' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo ' <span class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- already escaped above.
	}
}

if ( ! function_exists( 'cide_entry_footer' ) ) {
	/**
	 * Prints HTML with meta information for categories, tags.
	 */
	function cide_entry_footer() {
		if ( 'post' === get_post_type() ) {
			$categories_list = get_the_category_list( esc_html__( ', ', 'cide' ) );
			if ( $categories_list ) {
				/* translators: %s: list of categories. */
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %s', 'cide' ) . '</span>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- core escapes the list.
			}

			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'cide' ) );
			if ( $tags_list ) {
				/* translators: %s: list of tags. */
				printf( ' <span class="tags-links">' . esc_html__( 'Tagged %s', 'cide' ) . '</span>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- core escapes the list.
			}
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers. */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'cide' ),
					array( 'span' => array( 'class' => array() ) )
				),
				wp_kses_post( get_the_title() )
			),
			' <span class="edit-link">',
			'</span>'
		);
	}
}
