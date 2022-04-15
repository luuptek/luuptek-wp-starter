<?php

/**
 * Filters related to Luuptek MU plugin
 */

// Color palette for Gutenberg
add_filter(
	'luuptek_add_editor_color_palette',
	function () {
		return [
			[
				'name'  => __( 'Teeman pääväri', 'luuptek_wp_base' ),
				'slug'  => 'theme-primary',
				'color' => '#5b9279',
			],
			[
				'name'  => __( 'Teeman toissijainen väri', 'luuptek_wp_base' ),
				'slug'  => 'theme-secondary',
				'color' => '#2e3532',
			],
			[
				'name'  => __( 'Täysin musta', 'luuptek_wp_base' ),
				'slug'  => 'solid-black',
				'color' => '#000',
			],
			[
				'name'  => __( 'Täysin valkoinen', 'luuptek_wp_base' ),
				'slug'  => 'solid-white',
				'color' => '#FFF',
			],
		];
	}
);

/**
 * Allow all blocks
 */
add_filter( 'disable_luuptek_allowed_blocks', '__return_true' );

/**
 * Notification email
 */
add_filter(
	'luuptek_update_notifications_recipients',
	function () {
		return 'asiakas@mail.com';
	}
);
