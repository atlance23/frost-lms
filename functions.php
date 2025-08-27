<?php
/**
 * This file adds functions to the Frost WordPress theme.
 *
 * @package Frost
 * @author  WP Engine
 * @license GNU General Public License v3
 * @link    https://frostwp.com/
 */

if ( ! function_exists( 'frost_setup' ) ) {

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 *
	 * @since 0.8.0
	 *
	 * @return void
	 */
	function frost_setup() {

		// Make theme available for translation.
		load_theme_textdomain( 'frost', get_template_directory() . '/languages' );

		// Enqueue editor stylesheet.
		add_editor_style( get_template_directory_uri() . '/style.css' );

		// Remove core block patterns.
		remove_theme_support( 'core-block-patterns' );

	}
}
add_action( 'after_setup_theme', 'frost_setup' );

// Enqueue stylesheet.
add_action( 'wp_enqueue_scripts', 'frost_enqueue_stylesheet' );
function frost_enqueue_stylesheet() {

	wp_enqueue_style( 'frost', get_template_directory_uri() . '/style.css', array(), wp_get_theme()->get( 'Version' ) );

}

/**
 * Register block styles.
 *
 * @since 0.9.2
 */
function frost_register_block_styles() {

	$block_styles = array(
		'core/columns' => array(
			'columns-reverse' => __( 'Reverse', 'frost' ),
		),
		'core/group' => array(
			'shadow-light' => __( 'Shadow', 'frost' ),
			'shadow-solid' => __( 'Solid', 'frost' ),
		),
		'core/list' => array(
			'no-disc' => __( 'No Disc', 'frost' ),
		),
		'core/quote' => array(
			'shadow-light' => __( 'Shadow', 'frost' ),
			'shadow-solid' => __( 'Solid', 'frost' ),
		),
		'core/social-links' => array(
			'outline' => __( 'Outline', 'frost' ),
		),
	);

	foreach ( $block_styles as $block => $styles ) {
		foreach ( $styles as $style_name => $style_label ) {
			register_block_style(
				$block,
				array(
					'name'  => $style_name,
					'label' => $style_label,
				)
			);
		}
	}
}
add_action( 'init', 'frost_register_block_styles' );

/**
 * Register block pattern categories.
 *
 * @since 1.0.4
 */
function frost_register_block_pattern_categories() {

	register_block_pattern_category(
		'frost-page',
		array(
			'label'       => __( 'Page', 'frost' ),
			'description' => __( 'Create a full page with multiple patterns that are grouped together.', 'frost' ),
		)
	);
	register_block_pattern_category(
		'frost-pricing',
		array(
			'label'       => __( 'Pricing', 'frost' ),
			'description' => __( 'Compare features for your digital products or service plans.', 'frost' ),
		)
	);

}

/**
 * Enqueue Tailwinds CSS.
 * 
 * @since 1.0.11
 */

function frost_enqueue_tailwind() {
	wp_enqueue_style( 'frost-tailwind', "https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4", array(), wp_get_theme()->get( 'Version' ) );
}

/**
 * Redirect to Frost LMS settings page upon theme activation.
 * 
 * @since 1.0.11
 */

function frost_lms_redirect( $redirect_to, $request, $user ) {
	// Only redirect if user is logged in and $user is a WP_User object
	if ( is_a( $user, 'WP_User' ) && $user->exists() ) {
		if ( in_array( 'administrator', (array) $user->roles ) ) {
			return $redirect_to;
		} else {
			return get_site_url() . '/frost-lms-admin';
		}
	}

	return $redirect_to;
}

/**
 * Add custom admin page for Frost LMS.
 * 
 * @since 1.0.11
 */

// Custom rewrite rule for frontend admin page
function frost_lms_admin_rewrite() {
	add_rewrite_rule('^frost-lms-admin/?$', 'index.php?frost_lms_admin=1', 'top');
}

/**
 * Register query var.
 * 
 * @since 1.0.11
 */

// Register query var
function frost_lms_admin_query_vars($vars) {
	$vars[] = 'frost_lms_admin';
	return $vars;
}

/**
 * Template loader for custom admin page.
 * 
 * @since 1.0.11
 */
// Template loader for custom admin page
function frost_lms_admin_template($template) {
	if (get_query_var('frost_lms_admin')) {
		$admin_template = get_template_directory() . '/patterns/page-admin.php';
		if (file_exists($admin_template)) {
			return $admin_template;
		}
	}
	return $template;
}

// Hook into WordPress

add_action('init', 'frost_lms_admin_rewrite');
add_filter('query_vars', 'frost_lms_admin_query_vars');
add_filter('template_include', 'frost_lms_admin_template');
add_filter('login_redirect', 'frost_lms_redirect', 10, 3);
add_action( 'wp_enqueue_scripts', 'frost_enqueue_tailwind' );
add_action( 'init', 'frost_register_block_pattern_categories' );
