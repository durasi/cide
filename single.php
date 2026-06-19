<?php
/**
 * The template for displaying all single posts.
 *
 * @package Cide
 */

get_header();
?>
	<main id="primary" class="content-area">
	<?php
	while ( have_posts() ) :
		the_post();

		get_template_part( 'template-parts/content', 'single' );

		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;

		the_post_navigation(
			array(
				'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'cide' ) . '</span> <span class="nav-title">%title</span>',
				'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'cide' ) . '</span> <span class="nav-title">%title</span>',
			)
		);

	endwhile;
	?>
	</main>
<?php
get_sidebar();
get_footer();
