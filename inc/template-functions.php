<?php
/**
 * Functions which enhance the theme by hooking into WordPress.
 *
 * @package Cide
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function cide_body_classes( $classes ) {
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	$menu_style = get_theme_mod( 'cide_menu_style', 'pill' );
	$valid      = array( 'pill', 'underline', 'minimal', 'boxed', 'gradient' );
	if ( ! in_array( $menu_style, $valid, true ) ) {
		$menu_style = 'pill';
	}
	$classes[] = 'menu-style-' . $menu_style;

	return $classes;
}
add_filter( 'body_class', 'cide_body_classes' );
