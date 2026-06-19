<?php
/**
 * The footer for our theme.
 *
 * @package Cide
 */

?>
	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<svg class="cide-footer-wave" viewBox="0 0 1440 80" preserveAspectRatio="none" aria-hidden="true" focusable="false">
			<path fill="currentColor" d="M0,40 C240,90 480,0 720,30 C960,60 1200,10 1440,40 L1440,80 L0,80 Z"></path>
		</svg>
		<div class="site-footer-inner">
			<div class="cide-container">
				<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
					<div class="footer-widgets">
						<?php dynamic_sidebar( 'footer-1' ); ?>
					</div>
				<?php endif; ?>

				<div class="site-info">
					<?php
					/* translators: %s: WordPress. */
					printf( esc_html__( 'Proudly powered by %s.', 'cide' ), '<a href="' . esc_url( __( 'https://wordpress.org/', 'cide' ) ) . '">WordPress</a>' );
					?>
					<span class="sep"> | </span>
					<?php
					/* translators: 1: Theme name, 2: Theme author. */
					printf( esc_html__( 'Theme: %1$s by %2$s.', 'cide' ), 'Cide', '<a href="https://profiles.wordpress.org/durasi/">durasi</a>' );
					?>
				</div>
			</div>
		</div>
	</footer>
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>
