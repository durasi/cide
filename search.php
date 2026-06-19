<?php
/**
 * The template for displaying search results pages.
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
			<h1 class="page-title">
				<?php
				/* translators: %s: search query. */
				printf( esc_html__( 'Search Results for: %s', 'cide' ), '<span>' . get_search_query() . '</span>' );
				?>
			</h1>
		</header>
		<?php
		while ( have_posts() ) :
			the_post();
			get_template_part( 'template-parts/content', 'search' );
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
