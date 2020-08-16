<?php

/**
 * WP-nav-menus
 *
 * @package Luuptek WP-Base
 */

/**
 * Main menu
 */
function luuptek_wp_base_main_menu() {
	wp_nav_menu(
		[
			'theme_location'  => 'top_nav',
			'container'       => false,
			'container_class' => '',
			'container_id'    => '',
			'menu_class'      => 'menu',
			'menu_id'         => '',
			'echo'            => true,
			'fallback_cb'     => '',
			'before'          => '',
			'after'           => '',
			'link_before'     => '',
			'link_after'      => '',
			'items_wrap'      => '%3$s',
			'depth'           => 4,
			'walker'          => new WP_Bootstrap_Navwalker,
		]
	);
}

/**
 * Register the menu
 */
register_nav_menus(
	[
		'top_nav' => __( 'Main menu', 'luuptek_wp_base' ),
	]
);
