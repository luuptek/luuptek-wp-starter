<?php

/**
 * Main functions and definitions
 *
 * @package Luuptek WP-Base
 */

$sakke_config = json_decode( file_get_contents( __DIR__ . '/sakke.json' ) );

// True when gulp watch is running. See sakke-lib/gulpfile.js
define( 'ASSET_DEV', file_exists( __DIR__ . '/.asset-dev' ) );

/**
 * Require helpers
 */
require dirname( __FILE__ ) . '/library/functions/helpers.php';
require dirname( __FILE__ ) . '/library/functions/polylang-fallbacks.php';

/**
 * Set theme name which will be referenced from style & script registrations
 *
 * @return WP_Theme
 */
function luuptek_wp_base_theme() {
	return wp_get_theme();
}

/**
 * Set custom imagesizes
 *
 * @return array
 */
function luuptek_wp_base_set_imagesizes() {
	return [
		[
			'name'   => 'article_lift',
			'width'  => 500,
			'height' => 277,
			'crop'   => true,
		],
		[
			'name'   => 'hero_slide',
			'width'  => 1920,
			'height' => 700,
			'crop'   => true,
		],
		[
			'name'   => 'square',
			'width'  => 500,
			'height' => 500,
			'crop'   => true,
		],
	];
}

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640;
}

/**
 * Set up theme defaults and register support for various WordPress features.
 */
if ( ! function_exists( 'luuptek_wp_base_setup' ) ) :

	/**
	 * WP base setup here
	 */
	function luuptek_wp_base_setup() {

		global $cap, $content_width;

		/**
		 * Load textdomain
		 */
		load_theme_textdomain( 'luuptek_wp_base', get_template_directory() . '/library/lang' );

		/**
		 * Add editor styling
		 */
		add_editor_style( asset_uri( 'styles/main.css' ) );

		/**
		 * Require ACF stuff
		 */
		require_files( dirname( __FILE__ ) . '/library/acf-blocks' );
		require_files( dirname( __FILE__ ) . '/library/acf-options' );

		/**
		 * Require some classes
		 */
		require_files( dirname( __FILE__ ) . '/library/classes' );

		/**
		 * Require custom post types and taxonomies
		 */
		require_files( dirname( __FILE__ ) . '/library/custom-posts' );
		require_files( dirname( __FILE__ ) . '/library/taxonomies' );

		/**
		 * Require metaboxes
		 */
		require_files( dirname( __FILE__ ) . '/library/metaboxes' );

		/**
		 * Widgets (nav-menus & widgetized areas)
		 */
		require_files( dirname( __FILE__ ) . '/library/widgets' );

		/**
		 * Hooks
		 */
		require_files( dirname( __FILE__ ) . '/library/hooks' );

		/**
		 * Theme supports
		 */
		if ( function_exists( 'add_theme_support' ) ) {
			add_theme_support( 'automatic-feed-links' );
			add_theme_support( 'html5', [ 'caption', 'comment-form', 'comment-list', 'gallery', 'search-form', 'script', 'style' ] );
			add_theme_support( 'post-thumbnails' );
			add_theme_support( 'title-tag' );
			add_theme_support( 'align-wide' );
			add_theme_support( 'responsive-embeds' );
			add_theme_support( 'block-template-parts' );
			add_theme_support( 'appearance-tools' ); // Will be in WP 6.2
		}

		/**
		 * Register custom imagesizes
		 */
		if ( ! empty( luuptek_wp_base_set_imagesizes() ) ) {
			foreach ( luuptek_wp_base_set_imagesizes() as $size ) {
				add_image_size( $size['name'], $size['width'], $size['height'], $size['crop'] );
			}
		}

	}

endif; // luuptek_wp_base_setup

add_action( 'after_setup_theme', 'luuptek_wp_base_setup' );

/**
 * Add text to theme footer
 */
add_filter(
	'admin_footer_text',
	function () {
		return '<span id="footer-thankyou">' . luuptek_wp_base_theme()->Name . ' by: <a href="' . luuptek_wp_base_theme()->AuthorURI . '" target="_blank">' . luuptek_wp_base_theme()->Author . '</a><span>';
	}
);

/**
 * Allow svg-uploads
 */
add_filter(
	'upload_mimes',
	function ( $mimes ) {
		$mimes['svg'] = 'image/svg+xml';

		return $mimes;
	}
);

/**
 * Move WP-templates to templates-folder for cleaner experience on dev
 */
add_filter(
	'stylesheet',
	function ( $stylesheet ) {
		return dirname( $stylesheet );
	}
);

add_action(
	'after_switch_theme',
	function () {
		$stylesheet = get_option( 'stylesheet' );
		if ( basename( $stylesheet ) !== 'templates' ) {
			update_option( 'stylesheet', $stylesheet . '/templates' );
		}
	}
);

/**
 * Register local ACF-json
 */
add_filter(
	'acf/settings/save_json',
	function () {
		return get_stylesheet_directory() . '/library/acf-data';
	}
);

add_filter(
	'acf/settings/load_json',
	function () {
		$paths[] = get_stylesheet_directory() . '/library/acf-data';

		return $paths;
	}
);

/**
 * Update google maps api key for ACF
 */
function update_acf_google_maps_api_key() {

	if ( function_exists( 'acf_update_setting' ) ) {
		acf_update_setting( 'google_api_key', 'your-api-here' );
	}
}

add_action( 'acf/init', 'update_acf_google_maps_api_key' );
