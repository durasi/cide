<?php
/**
 * Template part for displaying a message that posts cannot be found.
 *
 * @package Cide
 */

?>
<section class="no-results not-found hentry">
	<header class="page-header">
		<h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'cide' ); ?></h1>
	</header>

	<div class="page-content">
		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) :
			printf(
				'<p>' . wp_kses(
					/* translators: %s: admin URL to create a new post. */
					__( 'Ready to publish your first post? <a href="%s">Get started here</a>.', 'cide' ),
					array( 'a' => array( 'href' => array() ) )
				) . '</p>',
				esc_url( admin_url( 'post-new.php' ) )
			);
		elseif ( is_search() ) :
			?>
			<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'cide' ); ?></p>
			<?php
			get_search_form();
		else :
			?>
			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'cide' ); ?></p>
			<?php
			get_search_form();
		endif;
		?>
	</div>
</section>
