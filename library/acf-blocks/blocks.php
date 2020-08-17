<?php

/**
 * If using ACF blocks
 * Add the logic here =>
 *
 * @package Luuptek WP-Base
 *
 */

add_action( 'acf/init', 'register_luuptek_wp_base_acf_blocks' );

/**
 * Function where ACF custom blocks are resgitered
 */
function register_luuptek_wp_base_acf_blocks() {

	// check function exists.
	if ( function_exists( 'acf_register_block_type' ) ) {

		// Registering block
		acf_register_block_type(
			[
				'name'            => 'hero', // don't need acf/block-name
				'title'           => __( 'Hero', 'luuptek_wp_base' ),
				'render_template' => 'partials/gb-blocks/gb-acf-hero.php',
				'category'        => 'formatting',
				'icon'            => 'format-image',
				'supports'        => [
					'align' => [ 'full' ],
				],
			]
		);
	}
}
