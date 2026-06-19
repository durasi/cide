<?php
/**
 * The template for displaying archive pages.
 *
 * @package Cide
 */

get_header();
?>
	<main id="primary" class="content-area">
	<?php
	if ( have_posts() ) :
		?>
		<header class="page-header">
			<?php
			the_archive_title( '<h1 class="page-title">', '</h1>' );
			the_archive_description( '<div class="archive-description">', '</div>' );
			?>
		</header>
		<?php
		while ( have_posts() ) :
			the_post();
			get_template_part( 'template-parts/content', get_post_type() );
		endwhile;

		the_posts_pagination(
			array(
				'prev_text' => esc_html__( 'Previous', 'cide' ),
				'next_text' => esc_html__( 'Next', 'cide' ),
			)
		);

	else :
		get_template_part( 'template-parts/content', 'none' );
	endif;
	?>
	</main>
<?php
get_sidebar();
get_footer();
