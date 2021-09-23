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

		acf_register_block_type(
			[
				'name'            => 'latest-posts', // don't need acf/block-name
				'title'           => __( 'Viimeisimmät julkaisut', 'luuptek_wp_base' ),
				'render_template' => 'partials/gb-blocks/gb-acf-latest-posts.php',
				'category'        => 'formatting',
				'icon'            => 'layout',
				'mode'            => 'edit',
				'supports'        => [
					'align'  => [ 'full' ],
					'anchor' => true,
				],
				'align'           => 'full',
			]
		);

		acf_register_block_type(
			[
				'name'            => 'page-lifts', // don't need acf/block-name
				'title'           => __( 'Sivunostot', 'luuptek_wp_base' ),
				'render_template' => 'partials/gb-blocks/gb-acf-page-lifts.php',
				'category'        => 'formatting',
				'icon'            => 'layout',
				'mode'            => 'edit',
				'supports'        => [
					'align'  => [ 'full' ],
					'anchor' => true,
 				],
				'align'           => 'full',
			]
		);
	}
}
