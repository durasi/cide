<?php
/**
 * Cide Theme Customizer.
 *
 * @package Cide
 */

/**
 * Add postMessage support and register theme options.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function cide_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'cide_customize_partial_blogname',
			)
		);
	}

	// ===== Colors section. =====
	$wp_customize->add_section(
		'cide_colors',
		array(
			'title'    => esc_html__( 'Theme Colors', 'cide' ),
			'priority' => 29,
		)
	);

	$cide_color_defaults = array(
		'cide_color_primary'   => '#5b4bff',
		'cide_color_secondary' => '#a435f0',
		'cide_color_accent'    => '#ff5d8f',
	);
	$cide_color_labels = array(
		'cide_color_primary'   => esc_html__( 'Primary color', 'cide' ),
		'cide_color_secondary' => esc_html__( 'Secondary color', 'cide' ),
		'cide_color_accent'    => esc_html__( 'Accent color', 'cide' ),
	);
	foreach ( $cide_color_defaults as $key => $default ) {
		$wp_customize->add_setting(
			$key,
			array(
				'default'           => $default,
				'sanitize_callback' => 'sanitize_hex_color',
				'transport'         => 'refresh',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				$key,
				array(
					'label'   => $cide_color_labels[ $key ],
					'section' => 'cide_colors',
				)
			)
		);
	}

	// ===== Menu style section. =====
	$wp_customize->add_section(
		'cide_header_options',
		array(
			'title'    => esc_html__( 'Header & Menu', 'cide' ),
			'priority' => 30,
		)
	);

	$wp_customize->add_setting(
		'cide_menu_style',
		array(
			'default'           => 'pill',
			'sanitize_callback' => 'cide_sanitize_menu_style',
			'transport'         => 'refresh',
		)
	);
	$wp_customize->add_control(
		'cide_menu_style',
		array(
			'label'   => esc_html__( 'Menu Style', 'cide' ),
			'section' => 'cide_header_options',
			'type'    => 'select',
			'choices' => array(
				'pill'      => esc_html__( 'Pill (filled)', 'cide' ),
				'underline' => esc_html__( 'Underline', 'cide' ),
				'minimal'   => esc_html__( 'Minimal', 'cide' ),
				'boxed'     => esc_html__( 'Boxed', 'cide' ),
				'gradient'  => esc_html__( 'Gradient bar', 'cide' ),
			),
		)
	);

	// ===== Hero slider section. =====
	$wp_customize->add_section(
		'cide_slider',
		array(
			'title'       => esc_html__( 'Hero Slider', 'cide' ),
			'description' => esc_html__( 'Shown on the front page. Leave a slide title empty to hide that slide.', 'cide' ),
			'priority'    => 31,
		)
	);

	$wp_customize->add_setting(
		'cide_slider_enable',
		array(
			'default'           => true,
			'sanitize_callback' => 'cide_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'cide_slider_enable',
		array(
			'label'   => esc_html__( 'Show hero slider on front page', 'cide' ),
			'section' => 'cide_slider',
			'type'    => 'checkbox',
		)
	);

	for ( $i = 1; $i <= 3; $i++ ) {
		$wp_customize->add_setting(
			"cide_slide{$i}_image",
			array(
				'default'           => '',
				'sanitize_callback' => 'esc_url_raw',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				"cide_slide{$i}_image",
				array(
					/* translators: %d: slide number. */
					'label'   => sprintf( esc_html__( 'Slide %d image', 'cide' ), $i ),
					'section' => 'cide_slider',
				)
			)
		);

		$wp_customize->add_setting(
			"cide_slide{$i}_badge",
			array(
				'default'           => '',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control(
			"cide_slide{$i}_badge",
			array(
				/* translators: %d: slide number. */
				'label'   => sprintf( esc_html__( 'Slide %d badge', 'cide' ), $i ),
				'section' => 'cide_slider',
				'type'    => 'text',
			)
		);

		$wp_customize->add_setting(
			"cide_slide{$i}_title",
			array(
				'default'           => ( 1 === $i ) ? esc_html__( 'Shop the new collection', 'cide' ) : '',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control(
			"cide_slide{$i}_title",
			array(
				/* translators: %d: slide number. */
				'label'   => sprintf( esc_html__( 'Slide %d title', 'cide' ), $i ),
				'section' => 'cide_slider',
				'type'    => 'text',
			)
		);

		$wp_customize->add_setting(
			"cide_slide{$i}_text",
			array(
				'default'           => ( 1 === $i ) ? esc_html__( 'Discover quality products with fast shipping and secure checkout.', 'cide' ) : '',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control(
			"cide_slide{$i}_text",
			array(
				/* translators: %d: slide number. */
				'label'   => sprintf( esc_html__( 'Slide %d text', 'cide' ), $i ),
				'section' => 'cide_slider',
				'type'    => 'text',
			)
		);

		$wp_customize->add_setting(
			"cide_slide{$i}_btn_text",
			array(
				'default'           => ( 1 === $i ) ? esc_html__( 'Shop now', 'cide' ) : '',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control(
			"cide_slide{$i}_btn_text",
			array(
				/* translators: %d: slide number. */
				'label'   => sprintf( esc_html__( 'Slide %d button text', 'cide' ), $i ),
				'section' => 'cide_slider',
				'type'    => 'text',
			)
		);

		$wp_customize->add_setting(
			"cide_slide{$i}_btn_url",
			array(
				'default'           => '',
				'sanitize_callback' => 'esc_url_raw',
			)
		);
		$wp_customize->add_control(
			"cide_slide{$i}_btn_url",
			array(
				/* translators: %d: slide number. */
				'label'   => sprintf( esc_html__( 'Slide %d button URL', 'cide' ), $i ),
				'section' => 'cide_slider',
				'type'    => 'url',
			)
		);
	}
}
add_action( 'customize_register', 'cide_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 */
function cide_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Sanitize the menu style choice.
 *
 * @param string $input Raw value.
 * @return string
 */
function cide_sanitize_menu_style( $input ) {
	$valid = array( 'pill', 'underline', 'minimal', 'boxed', 'gradient' );
	return in_array( $input, $valid, true ) ? $input : 'pill';
}

/**
 * Sanitize a checkbox value.
 *
 * @param bool $checked Whether the checkbox is checked.
 * @return bool
 */
function cide_sanitize_checkbox( $checked ) {
	return ( isset( $checked ) && true === (bool) $checked );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function cide_customize_preview_js() {
	wp_enqueue_script( 'cide-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), CIDE_VERSION, true );
}
add_action( 'customize_preview_init', 'cide_customize_preview_js' );

/**
 * Output custom color CSS variables based on Customizer settings.
 */
function cide_custom_colors_css() {
	$primary   = get_theme_mod( 'cide_color_primary', '#5b4bff' );
	$secondary = get_theme_mod( 'cide_color_secondary', '#a435f0' );
	$accent    = get_theme_mod( 'cide_color_accent', '#ff5d8f' );

	// Only output if at least one color differs from the defaults.
	if ( '#5b4bff' === $primary && '#a435f0' === $secondary && '#ff5d8f' === $accent ) {
		return;
	}

	$primary   = sanitize_hex_color( $primary ) ? $primary : '#5b4bff';
	$secondary = sanitize_hex_color( $secondary ) ? $secondary : '#a435f0';
	$accent    = sanitize_hex_color( $accent ) ? $accent : '#ff5d8f';

	$css = ':root{'
		. '--cide-primary:' . $primary . ';'
		. '--cide-primary-2:' . $secondary . ';'
		. '--cide-accent:' . $accent . ';'
		. '--cide-ring:' . $primary . '2e;'
		. '--cide-grad:linear-gradient(120deg,' . $primary . ' 0%,' . $secondary . ' 55%,' . $accent . ' 110%);'
		. '--cide-grad-2:linear-gradient(135deg,' . $primary . ',' . $secondary . ');'
		. '--cide-mesh:'
			. 'radial-gradient(60% 50% at 15% 0%,' . $primary . '2e,transparent 60%),'
			. 'radial-gradient(50% 45% at 95% 5%,' . $accent . '29,transparent 60%),'
			. 'radial-gradient(55% 50% at 85% 95%,' . $secondary . '29,transparent 60%);'
		. '}';

	wp_add_inline_style( 'cide-style', $css );
}
add_action( 'wp_enqueue_scripts', 'cide_custom_colors_css', 20 );

