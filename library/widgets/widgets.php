<?php

/**
 * Widgetized areas
 *
 * @package Luuptek WP-Base
 *
 */

/**
 * Register widgetized areas
 */
add_action(
	'widgets_init',
	function () {
		$footer_widget_base = [
			'before_widget' => '<div class="footer-column widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget__title">',
			'after_title'   => '</h3>',
		];

		register_sidebar(
			[
				'name' => __( 'Alatunniste 1/2', 'luuptek_wp_base' ),
				'id'   => 'footer-1',
			] + $footer_widget_base
		);

		register_sidebar(
			[
				'name' => __( 'Alatunniste 2/2', 'luuptek_wp_base' ),
				'id'   => 'footer-2',
			] + $footer_widget_base
		);
	}
);
