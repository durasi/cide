<?php
/**
 * Template part for displaying single posts.
 *
 * @package Cide
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<?php if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta"><?php cide_posted_on(); ?></div>
		<?php endif; ?>
	</header>

	<?php if ( has_post_thumbnail() ) : ?>
		<div class="post-thumbnail"><?php the_post_thumbnail( 'large' ); ?></div>
	<?php endif; ?>

	<div class="entry-content">
		<?php
		the_content();
		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'cide' ),
				'after'  => '</div>',
			)
		);
		?>
	</div>

	<footer class="entry-footer">
		<?php cide_entry_footer(); ?>
	</footer>
</article>
