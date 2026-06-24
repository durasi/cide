<?php
/**
 * Cide functions and definitions.
 *
 * @package Cide
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! defined( 'CIDE_VERSION' ) ) {
	define( 'CIDE_VERSION', '1.0.4' );
}

if ( ! function_exists( 'cide_setup' ) ) {
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 */
	function cide_setup() {
		load_theme_textdomain( 'cide', get_template_directory() . '/languages' );

		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'customize-selective-refresh-widgets' );
		add_theme_support( 'responsive-embeds' );
		add_theme_support( 'align-wide' );
		add_theme_support( 'wp-block-styles' );

		add_theme_support(
			'custom-logo',
			array(
				'height'      => 60,
				'width'       => 240,
				'flex-height' => true,
				'flex-width'  => true,
			)
		);

		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
				'navigation-widgets',
			)
		);

		add_theme_support(
			'custom-background',
			apply_filters(
				'cide_custom_background_args',
				array(
					'default-color' => 'f3f5fc',
					'default-image' => '',
				)
			)
		);

		register_nav_menus(
			array(
				'primary' => esc_html__( 'Primary Menu', 'cide' ),
				'footer'  => esc_html__( 'Footer Menu', 'cide' ),
			)
		);
	}
}
add_action( 'after_setup_theme', 'cide_setup' );

/**
 * Set the content width in pixels.
 */
function cide_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'cide_content_width', 1280 );
}
add_action( 'after_setup_theme', 'cide_content_width', 0 );

/**
 * Register widget areas.
 */
function cide_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'cide' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'cide' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer', 'cide' ),
			'id'            => 'footer-1',
			'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'cide' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'cide_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function cide_scripts() {
	wp_enqueue_style( 'cide-style', get_stylesheet_uri(), array(), CIDE_VERSION );

	wp_enqueue_script( 'cide-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), CIDE_VERSION, true );

	if ( is_front_page() ) {
		wp_enqueue_script( 'cide-slider', get_template_directory_uri() . '/assets/js/slider.js', array(), CIDE_VERSION, true );
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'cide_scripts' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function cide_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'cide_pingback_header' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Theme Customizer.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Hero slider and front-page sections.
 */
require get_template_directory() . '/inc/slider.php';

/**
 * WooCommerce compatibility (loaded only when WooCommerce is active).
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}
