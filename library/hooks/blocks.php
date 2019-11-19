<?php
/**
 * Customising allowed blocks..
 *
 * @package Luuptek WP-Base
 */

add_filter( 'allowed_block_types', function ( $allowed_block_types, $post ) {
	$blocks = [];

	/**
	 * Common blocks
	 */
	$blocks[] = 'core/paragraph';
	$blocks[] = 'core/image';
	$blocks[] = 'core/heading';
	$blocks[] = 'core/gallery';
	$blocks[] = 'core/list';
	$blocks[] = 'core/quote';
	$blocks[] = 'core/file';
	$blocks[] = 'core/cover';

	/**
	 * Formatting
	 */
	$blocks[] = 'core/code';
	$blocks[] = 'core/table';
	$blocks[] = 'core/freeform'; // classic editor

	/**
	 * Layout
	 */
	$blocks[] = 'core/button';
	$blocks[] = 'core/media-text';
	$blocks[] = 'core/columns';
	$blocks[] = 'core/spacer';
	$blocks[] = 'core/separator';
	$blocks[] = 'core/group';

	/**
	 * Widgets
	 */
	$blocks[] = 'core/shortcode';

	/**
	 * Embeds
	 */
	$blocks[] = 'core/embed';
	$blocks[] = 'core-embed/twitter';
	$blocks[] = 'core-embed/youtube';
	$blocks[] = 'core-embed/facebook';
	$blocks[] = 'core-embed/instagram';
	$blocks[] = 'core-embed/soundcloud';
	$blocks[] = 'core-embed/spotify';
	$blocks[] = 'core-embed/flickr';
	$blocks[] = 'core-embed/vimeo';
	$blocks[] = 'core-embed/issuu';
	$blocks[] = 'core-embed/slideshare';

	/**
	 * Reusable blocks
	 */
	$blocks[] = 'core/block';

	/**
	 * Plugins
	 */
	$blocks[] = 'block-gallery/masonry';

	/**
	 * Custom
	 */
	//$blocks[] = 'acf/block-name';

	return $blocks;
}, 10, 2 );