<?php

/**
 * A sample Books post-type
 *
 * @link    http://github.com/jjgrainger/wp-custom-post-type-class/
 *
 */

$labels = [
	'add_new'   => _x( 'Add new', 'Add new string for cpt', TEXT_DOMAIN ),
	'view_item' => _x( 'Edit item', 'View string for cpt', TEXT_DOMAIN ),
];

$cpt = new CPT( [
	'post_type_name'   => 'book',
	'singular'         => _x( 'Book', 'Single', TEXT_DOMAIN ),
	'plural'           => _x( 'Books', 'Plural', TEXT_DOMAIN ),
	'partitive'        => _x( 'Book', 'Partitive', TEXT_DOMAIN ),
	'partitive_plural' => _x( 'Books', 'Partitive plural', TEXT_DOMAIN ),
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
$cpt->set_textdomain( TEXT_DOMAIN );
$cpt->register_taxonomy( [
	'taxonomy_name'    => 'topic',
	'singular'         => _x( 'Topic', 'Single', TEXT_DOMAIN ),
	'plural'           => _x( 'Topics', 'Plural', TEXT_DOMAIN ),
	'partitive'        => _x( 'Topic', 'Partitive', TEXT_DOMAIN ),
	'partitive_plural' => _x( 'Topics', 'Partitive plural', TEXT_DOMAIN ),
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
