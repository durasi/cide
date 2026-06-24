<?php
/**
 * The template for displaying the blog posts index.
 *
 * This is the template that displays the posts page when a static front page
 * is set under Settings > Reading. It ensures the correct content is shown
 * according to the front page display setting.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#home-page-display
 *
 * @package Cide
 */

get_header();
?>
<main id="primary" class="content-area">
	<?php
	if ( have_posts() ) :

		if ( is_home() && ! is_front_page() ) :
			?>
			<header class="page-header">
				<h1 class="page-title"><?php single_post_title(); ?></h1>
			</header>
			<?php
		endif;

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
