<?php

/**
 * Registering taxonomy: taxonomy_name
 * One per file
 */

function init_some_taxonomy() {
	/**
	 * Change labels according to taxonomy
	 */
	$labels = array(
		'name'                       => _x( 'Blogin kirjoittajat', 'taxonomy_name taxonomy general name', 'luuptek_wp_base' ),
		'singular_name'              => _x( 'Blogin kirjoittaja', 'taxonomy_name taxonomy singular name', 'luuptek_wp_base' ),
		'menu_name'                  => __( 'Blogin kirjoittajat', 'luuptek_wp_base' ),
		'all_items'                  => __( 'Kaikki blogin kirjoittajat', 'luuptek_wp_base' ),
		'parent_item'                => __( 'Blogin kirjoittaja', 'luuptek_wp_base' ),
		'parent_item_colon'          => __( 'Blogin kirjoittaja:', 'luuptek_wp_base' ),
		'new_item_name'              => __( 'Uusi blogin kirjoittaja', 'luuptek_wp_base' ),
		'add_new_item'               => __( 'Lisää uusi blogin kirjoittaja', 'luuptek_wp_base' ),
		'edit_item'                  => __( 'Muokkaa kirjoittajaa', 'luuptek_wp_base' ),
		'update_item'                => __( 'Päivitä blogin kirjoittaja', 'luuptek_wp_base' ),
		'view_item'                  => __( 'Katso blogin kirjoittaja', 'luuptek_wp_base' ),
		'separate_items_with_commas' => __( 'Erottele pilkuilla', 'luuptek_wp_base' ),
		'add_or_remove_items'        => __( 'Lisää ja poista kirjoittajia', 'luuptek_wp_base' ),
		'choose_from_most_used'      => __( 'Valitse eniten käytetyistä', 'luuptek_wp_base' ),
		'popular_items'              => __( 'Suositut blogin kirjoittajat', 'luuptek_wp_base' ),
		'search_items'               => __( 'Etsi', 'luuptek_wp_base' ),
		'not_found'                  => __( 'Ei löytynyt', 'luuptek_wp_base' ),
		'no_terms'                   => __( 'Ei blogin kirjoittajia', 'luuptek_wp_base' ),
		'items_list'                 => __( 'Kirjoittajien listaus', 'luuptek_wp_base' ),
		'items_list_navigation'      => __( 'Kirjoittajien navigointi', 'luuptek_wp_base' ),
	);
	$args   = array(
		'labels'              => $labels,
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_admin_column'   => true,
		'show_in_nav_menus'   => true,
		'show_tagcloud'       => false,
		'show_in_rest'        => true,
	);
	register_taxonomy( 'taxonomy_name', [ 'post' ], $args );

}

add_action( 'init', 'init_some_taxonomy', 0 );
