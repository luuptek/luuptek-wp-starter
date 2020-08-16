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
				'name'            => 'block-name', // don't need acf/block-name
				'title'           => __( 'Block name', 'luuptek_wp_base' ),
				'render_template' => 'partials/blocks/block.php',
				'category'        => 'formatting',
				'supports'        => [
					'align' => [ 'full', 'wide' ],
				],
			]
		);
	}
}
