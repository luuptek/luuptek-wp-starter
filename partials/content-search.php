<?php

/**
 * The main template for search-results
 *
 * @package Luuptek WP-Base
 *
 */

$block_args = [
	'url' => get_the_permalink(),
	'title' => get_the_title(),
	'image_id' => get_post_thumbnail_id(),
];

get_template_part('partials/blocks/b-page-lift', '', $block_args);
