<?php
/**
 * Hero slider rendering for the front page.
 *
 * @package Cide
 */

/**
 * Render the hero slider based on Customizer settings.
 */
function cide_render_hero_slider() {
	if ( ! get_theme_mod( 'cide_slider_enable', true ) ) {
		return;
	}

	$slides = array();
	for ( $i = 1; $i <= 3; $i++ ) {
		$title = get_theme_mod( "cide_slide{$i}_title", ( 1 === $i ) ? __( 'Shop the new collection', 'cide' ) : '' );
		if ( '' === trim( (string) $title ) ) {
			continue;
		}
		$slides[] = array(
			'image'    => get_theme_mod( "cide_slide{$i}_image", '' ),
			'badge'    => get_theme_mod( "cide_slide{$i}_badge", '' ),
			'title'    => $title,
			'text'     => get_theme_mod( "cide_slide{$i}_text", '' ),
			'btn_text' => get_theme_mod( "cide_slide{$i}_btn_text", '' ),
			'btn_url'  => get_theme_mod( "cide_slide{$i}_btn_url", '' ),
		);
	}

	if ( empty( $slides ) ) {
		return;
	}
	?>
	<section class="cide-hero-slider" aria-label="<?php esc_attr_e( 'Promotional slider', 'cide' ); ?>">
		<div class="cide-slides">
			<?php foreach ( $slides as $index => $slide ) : ?>
				<?php
				$style = '';
				if ( ! empty( $slide['image'] ) ) {
					$style = 'background-image:url(' . esc_url( $slide['image'] ) . ');';
				} else {
					$style = 'background-image:var(--cide-grad);';
				}
				?>
				<div class="cide-slide<?php echo ( 0 === $index ) ? ' is-active' : ''; ?>" style="<?php echo esc_attr( $style ); ?>" data-slide="<?php echo esc_attr( $index ); ?>"<?php echo ( 0 === $index ) ? '' : ' aria-hidden="true"'; ?>>
					<div class="cide-slide-inner">
						<div class="cide-slide-content">
							<?php if ( ! empty( $slide['badge'] ) ) : ?>
								<span class="cide-slide-badge"><?php echo esc_html( $slide['badge'] ); ?></span>
							<?php endif; ?>
							<h2 class="cide-slide-title"><?php echo esc_html( $slide['title'] ); ?></h2>
							<?php if ( ! empty( $slide['text'] ) ) : ?>
								<p class="cide-slide-text"><?php echo esc_html( $slide['text'] ); ?></p>
							<?php endif; ?>
							<?php if ( ! empty( $slide['btn_text'] ) && ! empty( $slide['btn_url'] ) ) : ?>
								<a class="cide-slide-btn" href="<?php echo esc_url( $slide['btn_url'] ); ?>"><?php echo esc_html( $slide['btn_text'] ); ?></a>
							<?php endif; ?>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>

		<?php if ( count( $slides ) > 1 ) : ?>
			<button class="cide-slider-arrow cide-slider-prev" aria-label="<?php esc_attr_e( 'Previous slide', 'cide' ); ?>">&#8249;</button>
			<button class="cide-slider-arrow cide-slider-next" aria-label="<?php esc_attr_e( 'Next slide', 'cide' ); ?>">&#8250;</button>
			<div class="cide-slider-dots">
				<?php foreach ( $slides as $index => $slide ) : ?>
					<button class="<?php echo ( 0 === $index ) ? 'is-active' : ''; ?>" data-goto="<?php echo esc_attr( $index ); ?>" aria-label="<?php
					/* translators: %d: slide number. */
					echo esc_attr( sprintf( __( 'Go to slide %d', 'cide' ), $index + 1 ) ); ?>"></button>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</section>
	<?php
}

/**
 * Render the trust badges strip.
 */
function cide_render_trust_badges() {
	$badges = array(
		array(
			'title' => __( 'Free Shipping', 'cide' ),
			'sub'   => __( 'On qualifying orders', 'cide' ),
			'icon'  => '<path d="M3 7h11v8H3zM14 10h4l3 3v2h-7z" fill="none" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/><circle cx="7" cy="18" r="1.6" fill="currentColor"/><circle cx="17" cy="18" r="1.6" fill="currentColor"/>',
		),
		array(
			'title' => __( 'Secure Checkout', 'cide' ),
			'sub'   => __( 'Encrypted payments', 'cide' ),
			'icon'  => '<rect x="5" y="10" width="14" height="9" rx="2" fill="none" stroke="currentColor" stroke-width="2"/><path d="M8 10V7a4 4 0 0 1 8 0v3" fill="none" stroke="currentColor" stroke-width="2"/>',
		),
		array(
			'title' => __( 'Easy Returns', 'cide' ),
			'sub'   => __( 'Hassle-free policy', 'cide' ),
			'icon'  => '<path d="M4 9a8 8 0 1 1 1 6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><path d="M4 4v5h5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>',
		),
		array(
			'title' => __( '24/7 Support', 'cide' ),
			'sub'   => __( 'Here to help anytime', 'cide' ),
			'icon'  => '<path d="M5 12a7 7 0 0 1 14 0v4a2 2 0 0 1-2 2h-1v-6h3M5 12v4a2 2 0 0 0 2 2h1v-6H5" fill="none" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>',
		),
	);
	?>
	<div class="cide-trust">
		<div class="cide-trust-grid">
			<?php foreach ( $badges as $badge ) : ?>
				<div class="cide-trust-item">
					<span class="cide-trust-icon" aria-hidden="true">
						<svg viewBox="0 0 24 24"><?php echo wp_kses( $badge['icon'], cide_svg_allowed() ); ?></svg>
					</span>
					<span>
						<span class="cide-trust-title"><?php echo esc_html( $badge['title'] ); ?></span><br>
						<span class="cide-trust-sub"><?php echo esc_html( $badge['sub'] ); ?></span>
					</span>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
	<?php
}

/**
 * Allowed SVG tags for inline icons.
 *
 * @return array
 */
function cide_svg_allowed() {
	return array(
		'path'   => array( 'd' => array(), 'fill' => array(), 'stroke' => array(), 'stroke-width' => array(), 'stroke-linecap' => array(), 'stroke-linejoin' => array() ),
		'rect'   => array( 'x' => array(), 'y' => array(), 'width' => array(), 'height' => array(), 'rx' => array(), 'fill' => array(), 'stroke' => array(), 'stroke-width' => array() ),
		'circle' => array( 'cx' => array(), 'cy' => array(), 'r' => array(), 'fill' => array(), 'stroke' => array(), 'stroke-width' => array() ),
	);
}
