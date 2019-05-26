<?php

/**
 * All the assets
 *
 * @package Luuptek WP-Base
 */

/**
 * Admin stuff
 */
add_action( 'admin_enqueue_scripts', function () {
	wp_enqueue_script(
		'luuptek_admin',
		asset_uri( 'scripts/admin.min.js' ),
		[ 'jquery', 'wp-i18n', 'wp-blocks', 'wp-dom-ready' ],
		luuptek_wp_base_theme()->get( 'Version' )
	);
} );

/**
 * Enqueue scripts and styles
 */
add_action( 'wp_enqueue_scripts', function () {

	/**
	 * Main scripts file
	 */
	wp_enqueue_script(
		'luuptek_theme',
		asset_uri( 'scripts/main.min.js' ),
		[ 'jquery' ],
		luuptek_wp_base_theme()->get( 'Version' ),
		true
	);

	/**
	 * Main style
	 */
	wp_enqueue_style(
		'luuptek_style',
		asset_uri( 'styles/main.css' ),
		[],
		luuptek_wp_base_theme()->get( 'Version' )
	);

	// remove gutenberg default stylesheets
	wp_deregister_style( 'wp-block-library-theme' );
	wp_deregister_style( 'wp-block-library' );
} );

/**
 * Enqueue styles for Gutenberg Editor
 */
add_action( 'enqueue_block_editor_assets', function () {

	wp_enqueue_script(
		'luuptek_admin',
		asset_uri( 'scripts/admin.min.js' ),
		[ 'wp-i18n', 'wp-blocks', 'wp-dom-ready' ],
		luuptek_wp_base_theme()->get( 'Version' )
	);


	// overwrite Core block styles with empty styles
	wp_deregister_style( 'wp-block-library' );
	wp_register_style( 'wp-block-library', '' );

	// overwrite Core theme styles with empty styles
	wp_deregister_style( 'wp-block-library-theme' );
	wp_register_style( 'wp-block-library-theme', '' );

}, 10 );