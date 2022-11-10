<?php

/**
 * If using ACF blocks
 * Add the logic here =>
 *
 * @package Luuptek WP-Base
 *
 */

add_action( 'init', 'register_acf_blocks', 5 );
function register_acf_blocks() {
	$folders = get_directories_array( get_template_directory() . '/library/acf-block-json/' );

	if ( is_array( $folders ) ) {
		foreach ( $folders as $folder ) {
			register_block_type( get_template_directory() . '/library/acf-block-json/' . $folder );
		}
	}
}
