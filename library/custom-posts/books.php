<?php

/**
 * A sample Books post-type
 *
 * @link    http://github.com/jjgrainger/wp-custom-post-type-class/
 *
 */

$labels = [
	'add_new'   => _x( 'Add new', 'Add new string for cpt', 'luuptek_wp_base' ),
	'view_item' => _x( 'Edit item', 'View string for cpt', 'luuptek_wp_base' ),
];

$cpt = new CPT( [
	'post_type_name'   => 'book',
	'singular'         => _x( 'Book', 'Single', 'luuptek_wp_base' ),
	'plural'           => _x( 'Books', 'Plural', 'luuptek_wp_base' ),
	'partitive'        => _x( 'Book', 'Partitive', 'luuptek_wp_base' ),
	'partitive_plural' => _x( 'Books', 'Partitive plural', 'luuptek_wp_base' ),
	'slug'             => 'book'
], [
	'labels'        => $labels,
	'hierarchical'  => true,
	'menu_position' => 20,
	'show_in_rest' => true,
	'supports'      => [
		'title',
		'editor',
		'excerpt',
		'page-attributes'
	],
	'rewrite'       => [
		'with_front' => false
	],
	'has_archive'   => true,
	'query_var'     => 'book'

] );

$cpt->menu_icon( "dashicons-editor-textcolor" );
$cpt->set_textdomain( 'luuptek_wp_base' );
$cpt->register_taxonomy( [
	'taxonomy_name'    => 'topic',
	'singular'         => _x( 'Topic', 'Single', 'luuptek_wp_base' ),
	'plural'           => _x( 'Topics', 'Plural', 'luuptek_wp_base' ),
	'partitive'        => _x( 'Topic', 'Partitive', 'luuptek_wp_base' ),
	'partitive_plural' => _x( 'Topics', 'Partitive plural', 'luuptek_wp_base' ),
	'slug'             => 'topic',
	[
		'query_var' => true,
		'rewrite'   => [
			'slug'         => 'topic',
			'with_front'   => false,
			'hierarchical' => true
		],
		'sort'      => true
	]
] );
