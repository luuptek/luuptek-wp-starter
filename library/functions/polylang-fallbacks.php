<?php

/**
 * Polylang fallbacks (preserve functionality without the plugin)
 *
 * From: aucor/aucor-starter
 */
function luuptek_get_site_locale() {
	$locale = get_locale();
	if ( strlen( $locale ) >= 2 ) {
		return substr( $locale, 0, 2 );
	}

	// invalid locale
	return '';
}

add_action( 'wp_head', function () {
	if ( is_plugin_active( 'polylang-pro/polylang.php' ) || is_plugin_active( 'polylang/polylang.php' ) ) {
		return;
	}

	function pll__( $s ) {
		return $s;
	}

	function pll_e( $s ) {
		echo $s;
	}

	function pll_esc_html_e( $s ) {
		echo esc_html( $s );
	}

	function pll_esc_html__( $s ) {
		return esc_html( $s );
	}

	function pll_esc_attr_e( $s ) {
		echo esc_attr( $s );
	}

	function pll_esc_attr__( $s ) {
		return esc_attr( $s );
	}

	function pll_current_language() {
		return luuptek_get_site_locale();
	}

	function pll_get_post_language( $id ) {
		return luuptek_get_site_locale();
	}

	function pll_get_post( $post_id, $slug = '' ) {
		return $post_id;
	}

	function pll_set_post_language( $post_id, $post_language ) {
		// Not really much to do here
	}

	function pll_get_term( $term_id, $slug = '' ) {
		return $term_id;
	}

	function pll_translate_string( $str, $lang = '' ) {
		return $str;
	}

	function pll_home_url( $slug = '' ) {
		return get_home_url();
	}
} );
