<?php

/**
 * Custom post type registering, one per file
 *
 * Use: https://generatewp.com/post-type/
 */
function custom_post_type() {

	$labels = array(
		'name'                  => _x( 'CPT', 'Post Type General Name', 'luuptek_wp_base' ),
		'singular_name'         => _x( 'CPT', 'Post Type Singular Name', 'luuptek_wp_base' ),
		'menu_name'             => __( 'CPT', 'luuptek_wp_base' ),
		'name_admin_bar'        => __( 'CPT', 'luuptek_wp_base' ),
		'archives'              => __( 'Arkistot', 'luuptek_wp_base' ),
		'attributes'            => __( 'Arkistot', 'luuptek_wp_base' ),
		'parent_item_colon'     => __( 'Yläsivu:', 'luuptek_wp_base' ),
		'all_items'             => __( 'Lisää uusi', 'luuptek_wp_base' ),
		'add_new'               => __( 'Lisää uusi', 'luuptek_wp_base' ),
		'new_item'              => __( 'Uusi', 'luuptek_wp_base' ),
		'edit_item'             => __( 'Muokkaa', 'luuptek_wp_base' ),
		'update_item'           => __( 'Päivitä', 'luuptek_wp_base' ),
		'view_item'             => __( 'Katso julkaisu', 'luuptek_wp_base' ),
		'view_items'            => __( 'Katso julkaisut', 'luuptek_wp_base' ),
		'search_items'          => __( 'Etsi julkaisuja', 'luuptek_wp_base' ),
		'not_found'             => __( 'Ei löytynyt', 'luuptek_wp_base' ),
		'not_found_in_trash'    => __( 'Ei löytynyt roskakorista', 'luuptek_wp_base' ),
		'featured_image'        => __( 'Julkaisun kuva', 'luuptek_wp_base' ),
		'set_featured_image'    => __( 'Aseta julkaisun kuva', 'luuptek_wp_base' ),
		'remove_featured_image' => __( 'Poista julkaisun kuva', 'luuptek_wp_base' ),
		'use_featured_image'    => __( 'Käytä julkaisun kuvana', 'luuptek_wp_base' ),
		'insert_into_item'      => __( 'Lisää julkaisuun', 'luuptek_wp_base' ),
		'uploaded_to_this_item' => __( 'Ladattu tähän julkaisuun', 'luuptek_wp_base' ),
		'items_list'            => __( 'Julkaisujen listaus', 'luuptek_wp_base' ),
		'items_list_navigation' => __( 'Julkaisujen vavigointi', 'luuptek_wp_base' ),
		'filter_items_list'     => __( 'Suodata julkaisuja', 'luuptek_wp_base' ),
	);
	$args   = array(
		'label'               => __( 'CPT', 'luuptek_wp_base' ),
		'description'         => __( 'CPT kuvaus', 'luuptek_wp_base' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor' ),
		'taxonomies'          => array( 'category', 'post_tag' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 5,
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
		'show_in_rest'        => true,
	);
	register_post_type( 'custom_post_type', $args );

}

add_action( 'init', 'custom_post_type', 0 );
