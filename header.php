<?php
/**
 * The header for our theme.
 *
 * @package Cide
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'cide' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="cide-container header-inner">
			<div class="site-branding">
				<?php the_custom_logo(); ?>
				<div class="site-branding-text">
					<?php
					if ( is_front_page() && is_home() ) :
						?>
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<?php
					else :
						?>
						<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
						<?php
					endif;
					$cide_description = get_bloginfo( 'description', 'display' );
					if ( $cide_description || is_customize_preview() ) :
						?>
						<p class="site-description"><?php echo esc_html( $cide_description ); ?></p>
						<?php
					endif;
					?>
				</div>
			</div>

			<nav id="site-navigation" class="main-navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'cide' ); ?>">
				<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
					<span class="cide-burger" aria-hidden="true"></span>
					<span><?php esc_html_e( 'Menu', 'cide' ); ?></span>
				</button>
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'menu_id'        => 'primary-menu',
						'container'      => false,
						'fallback_cb'    => false,
						'items_wrap'     => '<ul id="%1$s" class="%2$s"><li class="menu-close-item"><button class="menu-close" aria-label="' . esc_attr__( 'Close menu', 'cide' ) . '">&times;</button></li>%3$s</ul>',
					)
				);
				?>
			</nav>
		</div>
	</header>

	<div class="cide-menu-overlay" tabindex="-1" aria-hidden="true"></div>

	<div id="content" class="site-content cide-container">
