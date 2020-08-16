<?php

/**
 * Custom post type registering, one per file
 *
 * Use: https://generatewp.com/post-type/
 */
function custom_post_type() {

	$labels = array(
		'name'                  => _x( 'Post Types', 'Post Type General Name', 'luuptek_wp_base' ),
		'singular_name'         => _x( 'Post Type', 'Post Type Singular Name', 'luuptek_wp_base' ),
		'menu_name'             => __( 'Post Types', 'luuptek_wp_base' ),
		'name_admin_bar'        => __( 'Post Type', 'luuptek_wp_base' ),
		'archives'              => __( 'Item Archives', 'luuptek_wp_base' ),
		'attributes'            => __( 'Item Attributes', 'luuptek_wp_base' ),
		'parent_item_colon'     => __( 'Parent Item:', 'luuptek_wp_base' ),
		'all_items'             => __( 'All Items', 'luuptek_wp_base' ),
		'add_new_item'          => __( 'Add New Item', 'luuptek_wp_base' ),
		'add_new'               => __( 'Add New', 'luuptek_wp_base' ),
		'new_item'              => __( 'New Item', 'luuptek_wp_base' ),
		'edit_item'             => __( 'Edit Item', 'luuptek_wp_base' ),
		'update_item'           => __( 'Update Item', 'luuptek_wp_base' ),
		'view_item'             => __( 'View Item', 'luuptek_wp_base' ),
		'view_items'            => __( 'View Items', 'luuptek_wp_base' ),
		'search_items'          => __( 'Search Item', 'luuptek_wp_base' ),
		'not_found'             => __( 'Not found', 'luuptek_wp_base' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'luuptek_wp_base' ),
		'featured_image'        => __( 'Featured Image', 'luuptek_wp_base' ),
		'set_featured_image'    => __( 'Set featured image', 'luuptek_wp_base' ),
		'remove_featured_image' => __( 'Remove featured image', 'luuptek_wp_base' ),
		'use_featured_image'    => __( 'Use as featured image', 'luuptek_wp_base' ),
		'insert_into_item'      => __( 'Insert into item', 'luuptek_wp_base' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'luuptek_wp_base' ),
		'items_list'            => __( 'Items list', 'luuptek_wp_base' ),
		'items_list_navigation' => __( 'Items list navigation', 'luuptek_wp_base' ),
		'filter_items_list'     => __( 'Filter items list', 'luuptek_wp_base' ),
	);
	$args   = array(
		'label'               => __( 'Post Type', 'luuptek_wp_base' ),
		'description'         => __( 'Post Type Description', 'luuptek_wp_base' ),
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
	register_post_type( 'post_type', $args );

}

add_action( 'init', 'custom_post_type', 0 );
