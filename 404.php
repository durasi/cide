<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package Cide
 */

get_header();
?>
	<main id="primary" class="content-area">
		<section class="error-404 not-found hentry">
			<header class="page-header">
				<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'cide' ); ?></h1>
			</header>
			<div class="page-content">
				<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'cide' ); ?></p>
				<?php get_search_form(); ?>
			</div>
		</section>
	</main>
<?php
get_sidebar();
get_footer();
