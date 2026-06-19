<?php
/**
 * WooCommerce compatibility functions.
 *
 * @package Cide
 */

/**
 * Declare WooCommerce support.
 */
function cide_woocommerce_setup() {
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'cide_woocommerce_setup' );

/**
 * Remove default WooCommerce wrappers and add theme wrappers.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

/**
 * Open theme wrapper before WooCommerce content.
 */
function cide_woocommerce_wrapper_before() {
	echo '<main id="primary" class="content-area">';
}
add_action( 'woocommerce_before_main_content', 'cide_woocommerce_wrapper_before', 10 );

/**
 * Close theme wrapper after WooCommerce content.
 */
function cide_woocommerce_wrapper_after() {
	echo '</main>';
}
add_action( 'woocommerce_after_main_content', 'cide_woocommerce_wrapper_after', 10 );
