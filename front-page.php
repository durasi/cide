<?php
/**
 * The front page template.
 *
 * @package Cide
 */

get_header();
?>
<div class="cide-fullwidth">

	<?php cide_render_hero_slider(); ?>

	<?php cide_render_trust_badges(); ?>

	<?php if ( class_exists( 'WooCommerce' ) ) : ?>

		<?php
		$product_cats = get_terms(
			array(
				'taxonomy'   => 'product_cat',
				'hide_empty' => true,
				'number'     => 6,
			)
		);
		if ( ! is_wp_error( $product_cats ) && ! empty( $product_cats ) ) :
			?>
			<section class="cide-section">
				<div class="cide-section-head">
					<div>
						<h2 class="cide-section-title"><?php esc_html_e( 'Shop by', 'cide' ); ?> <span><?php esc_html_e( 'Category', 'cide' ); ?></span></h2>
						<p class="cide-section-sub"><?php esc_html_e( 'Browse our most popular collections.', 'cide' ); ?></p>
					</div>
				</div>
				<div class="cide-cat-grid">
					<?php foreach ( $product_cats as $cat ) : ?>
						<a class="cide-cat-card" href="<?php echo esc_url( get_term_link( $cat ) ); ?>"
							<?php
							$thumb_id = get_term_meta( $cat->term_id, 'thumbnail_id', true );
							if ( $thumb_id ) {
								$img = wp_get_attachment_image_url( $thumb_id, 'medium_large' );
								if ( $img ) {
									echo ' style="background-image:url(' . esc_url( $img ) . ');background-size:cover;background-position:center;"';
								}
							}
							?>
						>
							<span><?php echo esc_html( $cat->name ); ?></span>
						</a>
					<?php endforeach; ?>
				</div>
			</section>
		<?php endif; ?>

		<section class="cide-section">
			<div class="cide-section-head">
				<div>
					<h2 class="cide-section-title"><?php esc_html_e( 'Featured', 'cide' ); ?> <span><?php esc_html_e( 'Products', 'cide' ); ?></span></h2>
					<p class="cide-section-sub"><?php esc_html_e( 'Hand-picked favourites from our store.', 'cide' ); ?></p>
				</div>
				<a class="cide-section-link" href="<?php echo esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ); ?>"><?php esc_html_e( 'View all', 'cide' ); ?> &rarr;</a>
			</div>
			<?php echo do_shortcode( '[products limit="8" columns="4" visibility="featured"]' ); ?>
		</section>

		<section class="cide-section">
			<div class="cide-section-head">
				<div>
					<h2 class="cide-section-title"><?php esc_html_e( 'New', 'cide' ); ?> <span><?php esc_html_e( 'Arrivals', 'cide' ); ?></span></h2>
					<p class="cide-section-sub"><?php esc_html_e( 'The latest additions to the shop.', 'cide' ); ?></p>
				</div>
				<a class="cide-section-link" href="<?php echo esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ); ?>"><?php esc_html_e( 'View all', 'cide' ); ?> &rarr;</a>
			</div>
			<?php echo do_shortcode( '[products limit="8" columns="4" orderby="date" order="DESC"]' ); ?>
		</section>

	<?php else : ?>

		<section class="cide-section">
			<div class="cide-section-head">
				<div>
					<h2 class="cide-section-title"><?php esc_html_e( 'Latest', 'cide' ); ?> <span><?php esc_html_e( 'Posts', 'cide' ); ?></span></h2>
					<p class="cide-section-sub"><?php esc_html_e( 'Install WooCommerce to turn these into product showcases.', 'cide' ); ?></p>
				</div>
			</div>
			<div class="cide-products">
				<?php
				$recent = new WP_Query(
					array(
						'post_type'      => 'post',
						'posts_per_page' => 8,
						'no_found_rows'  => true,
					)
				);
				if ( $recent->have_posts() ) :
					while ( $recent->have_posts() ) :
						$recent->the_post();
						?>
						<article class="cide-product-card">
							<a class="cide-product-media" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
								<?php
								if ( has_post_thumbnail() ) {
									the_post_thumbnail( 'medium_large' );
								}
								?>
							</a>
							<div class="cide-product-body">
								<h3 class="cide-product-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
								<span class="cide-product-price"><?php echo esc_html( get_the_date() ); ?></span>
							</div>
						</article>
						<?php
					endwhile;
					wp_reset_postdata();
				endif;
				?>
			</div>
		</section>

	<?php endif; ?>

</div>
<?php
get_footer();
