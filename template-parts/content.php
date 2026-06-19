<?php
/**
 * Template part for displaying posts.
 *
 * @package Cide
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta">
				<?php cide_posted_on(); ?>
			</div>
			<?php
		endif;
		?>
	</header>

	<?php if ( has_post_thumbnail() && ! is_singular() ) : ?>
		<div class="post-thumbnail">
			<a href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<?php the_post_thumbnail( 'large' ); ?>
			</a>
		</div>
	<?php elseif ( has_post_thumbnail() ) : ?>
		<div class="post-thumbnail">
			<?php the_post_thumbnail( 'large' ); ?>
		</div>
	<?php endif; ?>

	<div class="entry-content">
		<?php
		if ( is_singular() ) :
			the_content();
			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'cide' ),
					'after'  => '</div>',
				)
			);
		else :
			the_excerpt();
			?>
			<a class="more-link" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read more', 'cide' ); ?></a>
			<?php
		endif;
		?>
	</div>

	<?php if ( is_singular() ) : ?>
		<footer class="entry-footer">
			<?php cide_entry_footer(); ?>
		</footer>
	<?php endif; ?>
</article>
