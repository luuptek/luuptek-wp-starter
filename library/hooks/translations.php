<?php
/**
 * Register all your Polylang custom strings here.
 */

/**
 * Register strings for translation
 *
 * Set group based on theme location for easy filtering on admin page.
 * Use description if translation needs more information.
 *
 * [0]: (required/string) String to translate
 * [1]: (optional/string) Group
 * [2]: (optional/string) Description to show after name
 * [3]: (optional/bool)   Multiline
 *
 * @return array
 */
function theme_strings() {
	return [
		// Minimum settings [ 'String to translate' ],
		// All settings     [ 'String to translate', 'Group', 'Description to show after name', false ],
	];
}

/**
 * String translations
 */
function theme_register_polylang_strings() {
	if ( ! is_plugin_active( 'polylang-pro/polylang.php' ) && ! is_plugin_active( 'polylang/polylang.php' ) ) {
		return;
	}

	foreach ( theme_strings() as $key => $value ) {

		// String to translate
		$string = $value[0];

		// Sanitize and shorten name
		$name = sanitize_title( wp_trim_words( $value[0], 3 ) );

		// Add default context
		$context = 'Teema';
		if ( isset( $value[1] ) ) {
			$context = $value[1];
		}

		// Add description
		if ( isset( $value[2] ) && $value[2] ) {
			$name .= " ($value[2])";
		}

		// Multiline
		$multiline = false;
		if ( isset( $value[3] ) ) {
			$multiline = $value[3];
		}

		pll_register_string( $name, $string, $context, $multiline );
	}
}

add_action(
	'current_screen',
	function () {
		if ( ! is_admin() ) {
			return;
		}

		$current_screen = get_current_screen();
		if ( 'languages_page_mlang_strings' !== $current_screen->base ) {
			return;
		}

		theme_register_polylang_strings();
	}
);
