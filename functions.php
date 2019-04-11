<?php

/**
 * Main functions and definitions
 *
 * @package Luuptek WP-Base
 */

/**
 * Require helpers
 */
require dirname( __FILE__ ) . '/library/functions/helpers.php';

/**
 * Set theme name which will be referenced from style & script registrations
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
		//[
		//    'name'   => 'article_lift',
		//    'width'  => 360,
		//    'height' => 200,
		//    'crop'   => true
		//]
	];
}

/**
 * If defined, the feed will be shown on admin dashboard
 */
// define( 'FEED_URI', '' );

/**
 * Define Translation domain which will be used on WP __() & _e() -functions
 *
 * note: change also the one on style.css also
 */
define( 'TEXT_DOMAIN', 'luuptek_wp_base' );

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

	function luuptek_wp_base_setup() {

		global $cap, $content_width;

		/**
		 * Load textdomain
		 */
		load_theme_textdomain( TEXT_DOMAIN, get_template_directory() . '/library/lang' );

		/**
		 * Add editor styling
		 */
		add_editor_style( asset_uri( 'styles/main.css' ) );

		/**
		 * Require some classes
		 */
		require_files( dirname( __FILE__ ) . '/library/classes' );

		/**
		 * Require custom post types
		 */
		require_files( dirname( __FILE__ ) . '/library/custom-posts' );

		/**
		 * Require metaboxes
		 */
		require_files( dirname( __FILE__ ) . '/library/metaboxes' );

		/**
		 * Widgets (nav-menus & widgetized areas)
		 */
		require_files( dirname( __FILE__ ) . '/library/widgets' );

		/**
		 * Functions and helpers
		 */
		require_files( dirname( __FILE__ ) . '/library/functions' );

		/**
		 * Hooks
		 */
		require_files( dirname( __FILE__ ) . '/library/hooks' );

		/**
		 * Theme supports
		 */
		if ( function_exists( 'add_theme_support' ) ) {
			add_theme_support( 'automatic-feed-links' );
			add_theme_support( 'html5', [ 'caption', 'comment-form', 'comment-list', 'gallery', 'search-form' ] );
			add_theme_support( 'post-thumbnails' );
			add_theme_support( 'title-tag' );
			add_theme_support( 'editor-color-palette',
				[
					[
						'name'  => __( 'Theme primary', TEXT_DOMAIN ),
						'slug'  => 'theme-primary',
						'color' => '#5b9279',
					],
					[
						'name'  => __( 'Theme secondary', TEXT_DOMAIN ),
						'slug'  => 'theme-secondary',
						'color' => '#2e3532',
					],
					[
						'name'  => __( 'Solid black', TEXT_DOMAIN ),
						'slug'  => 'solid-black',
						'color' => '#000',
					],
					[
						'name'  => __( 'Solid white', TEXT_DOMAIN ),
						'slug'  => 'solid-white',
						'color' => '#FFF',
					],
				]
			);

			add_theme_support( 'align-wide' );
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
 * Add feed (if defined) to dashboard
 */
add_action( 'wp_dashboard_setup', function () {
	if ( defined( 'FEED_URI' ) ) {
		add_meta_box( 'dashboard_custom_feed', 'Feed', 'luuptek_wp_base_feed', 'dashboard', 'side', 'low' );
	}

	function luuptek_wp_base_feed() {
		echo '<div class="rss-widget">';
		wp_widget_rss_output( [
			'url'          => FEED_URI,
			'title'        => __( 'Title', TEXT_DOMAIN ),
			'items'        => 2,
			'show_title'   => 0,
			'show_summary' => 1,
			'show_author'  => 0,
			'show_date'    => 1
		] );
		echo "</div>";
	}
} );

/**
 * Add admin scripts & styles
 */
function luuptek_wp_base_admin_style() {
	echo '<link rel="stylesheet" href="' . asset_uri( 'styles/admin.css' ) . '" type="text/css" media="all" />';
}

add_action( 'login_head', 'luuptek_wp_base_admin_style' );
add_action( 'admin_head', 'luuptek_wp_base_admin_style' );


/**
 * Add text to theme footer
 */
add_filter( 'admin_footer_text', function () {
	return '<span id="footer-thankyou">' . luuptek_wp_base_theme()->Name . ' by: <a href="' . luuptek_wp_base_theme()->AuthorURI . '" target="_blank">' . luuptek_wp_base_theme()->Author . '</a><span>';
} );

/**
 * Allow svg-uploads
 */
add_filter( 'upload_mimes', function ( $mimes ) {
	$mimes['svg'] = 'image/svg+xml';

	return $mimes;
} );

/**
 * Change default WP-API endpoints
 *
 * @return mixed|void
 */

add_filter( 'rest_url_prefix', function () {
	return 'api';
} );

add_filter( 'json_url_prefix', function () {
	return 'api';
} );

/**
 * Move WP-templates to templates-folder for cleaner experience on dev
 */
add_filter( 'stylesheet', function ( $stylesheet ) {
	return dirname( $stylesheet );
} );

add_action( 'after_switch_theme', function () {
	$stylesheet = get_option( 'stylesheet' );
	if ( basename( $stylesheet ) !== 'templates' ) {
		update_option( 'stylesheet', $stylesheet . '/templates' );
	}
} );

/**
 * Register local ACF-json
 */
add_filter( 'acf/settings/save_json', function () {
	return get_stylesheet_directory() . '/library/acf-data';
} );

add_filter( 'acf/settings/load_json', function () {
	$paths[] = get_stylesheet_directory() . '/library/acf-data';

	return $paths;
} );

/**
 * Update google maps api key for ACF
 */
//function update_acf_google_maps_api_key() {
//
//	acf_update_setting( 'google_api_key', 'your-api-here' );
//}
//add_action( 'acf/init', 'update_acf_google_maps_api_key' );