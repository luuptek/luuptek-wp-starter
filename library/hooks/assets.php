<?php

/**
 * All the assets
 *
 * @package Luuptek WP-Base
 */

/**
 * Admin stuff
 */
add_action(
	'admin_enqueue_scripts',
	function () {
		wp_enqueue_script(
			'luuptek_admin',
			asset_uri( 'scripts/admin.min.js' ),
			[ 'jquery', 'wp-i18n', 'wp-blocks', 'wp-dom-ready' ],
			filemtime( get_theme_file_path( 'assets/dist/scripts/admin.min.js' ) )
		);

		/**
		 * Main admin style
		 */
		wp_enqueue_style(
			'luuptek_admin_style',
			asset_uri( 'styles/admin.css' ),
			[],
			filemtime( get_theme_file_path( 'assets/dist/styles/admin.css' ) )
		);
	}
);

/**
 * Login stuff
 */
add_action(
	'login_enqueue_scripts',
	function () {
		/**
		 * Main admin style
		 */
		wp_enqueue_style(
			'luuptek_admin_style',
			asset_uri( 'styles/admin.css' ),
			[],
			filemtime( get_theme_file_path( 'assets/dist/styles/admin.css' ) )
		);
	}
);

/**
 * Enqueue scripts and styles
 */
add_action(
	'wp_enqueue_scripts',
	function () {

		/**
		 * Main scripts file
		 */
		wp_enqueue_script(
			'luuptek_theme',
			asset_uri( 'scripts/main.min.js' ),
			[ 'jquery' ],
			filemtime( get_theme_file_path( 'assets/dist/scripts/main.min.js' ) ),
			true
		);

		/**
		 * Main style
		 */
		// Check if the .DEV-ONGOING file exists in the theme root folder.
		if ( ! file_exists( get_theme_file_path( '.DEV-ONGOING' ) ) ) {
			wp_enqueue_style(
				'luuptek_style',
				asset_uri( 'styles/main.css' ),
				[],
				filemtime( get_theme_file_path( 'assets/dist/styles/main.css' ) )
			);
		}

		/**
		 * Move jquery to footer
		 */
		wp_scripts()->add_data( 'jquery', 'group', 1 );
		wp_scripts()->add_data( 'jquery-core', 'group', 1 );
		wp_scripts()->add_data( 'jquery-migrate', 'group', 1 );

	}
);

/**
 * Enqueue styles for Gutenberg Editor
 */
add_action(
	'enqueue_block_editor_assets',
	function () {

		wp_enqueue_script(
			'luuptek_admin',
			asset_uri( 'scripts/admin.min.js' ),
			[ 'wp-i18n', 'wp-blocks', 'wp-dom-ready', 'wp-edit-post' ],
			filemtime( get_theme_file_path( 'assets/dist/scripts/admin.min.js' ) )
		);

	},
	10
);
