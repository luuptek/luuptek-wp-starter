<?php

/**
 * All the assets
 *
 * @package Luuptek WP-Base
 */

/**
 * Inject polyfill loader to the top of the head.
 *
 * The load-polyfill.js loads the 'polyfills' entry if it detects need for it.
 */
function inject_polyfill_loader() {
	$polyfills_uri = AssetHelpers\get_webpack_entry_uri( 'polyfills' );

	echo "\n<script id='polyfills' data-polyfill='" . esc_url($polyfills_uri) . "'>";
	readfile( get_template_directory() . '/dist/scripts/load-polyfills.js' );
	echo "</script>\n";

}
add_action( 'wp_head', __NAMESPACE__ . '\\inject_polyfill_loader', -100 );

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
			filemtime( get_theme_file_path( 'dist/scripts/admin.min.js' ) )
		);

		/**
		 * Main admin style
		 */
		wp_enqueue_style(
			'luuptek_admin_style',
			asset_uri( 'styles/admin.css' ),
			[],
			filemtime( get_theme_file_path( 'dist/styles/admin.css' ) )
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
			filemtime( get_theme_file_path( 'dist/styles/admin.css' ) )
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
		AssetHelpers\enqueue_webpack_entry( 'main', [ 'deps' => [ 'jquery' ] ] );

		if ( ASSET_DEV ) {
			global $sakke_config;
			$host = $sakke_config->livereload->host;
			$port = $sakke_config->livereload->port;
			wp_enqueue_script( 'livereload', "http://$host:$port/livereload.js?snipver=1", [], null, true );
		}

		/**
		 * Main style
		 */
		wp_enqueue_style(
			'luuptek_style',
			asset_uri( 'styles/main.css' ),
			[],
			filemtime( get_theme_file_path( 'dist/styles/main.css' ) )
		);

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
			filemtime( get_theme_file_path( 'dist/scripts/admin.min.js' ) )
		);

	},
	10
);
