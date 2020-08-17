<?php

/**
 * The main template for post lift
 *
 * @package Luuptek WP-Base
 *
 */

$args = [
	'title'    => get_the_title(),
	'url'      => get_the_permalink(),
	'image_id' => get_post_thumbnail_id( get_the_ID() ),
	'excerpt'  => get_the_excerpt(),
	'date'     => get_the_date(),
];

get_template_part( 'partials/components/post-lift', '', $args );
