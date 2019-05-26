<?php

/**
 * Filter video oembeds and wrap with Foundations flex-video
 *
 * @param $html
 * @param $url
 * @param $attr
 * @param $post_id
 *
 * @return string
 */
add_filter( 'embed_oembed_html', function ( $html, $url, $attr, $post_id ) {
	$matches = [
		'youtube.com',
		'vimeo.com',
		'youtu.be'
	];

	foreach ( $matches as $match ) {
		if ( false !== stripos( $url, $match ) ) {
			return '<div class="framecontainer">' . $html . '</div>';
		}
	}

	return $html;
}, 99, 4 );

/**
 * Remove h1-tag from tinyMCE, show second row by default
 */
add_filter( 'tiny_mce_before_init', function ( $init ) {
	$tinymce['wordpress_adv_hidden'] = false;
	$init['block_formats']           = "Paragraph=p;Address=address;Pre=pre;Heading 2=h2;Heading 3=h3;Heading 4=h4";

	return $init;
} );

/**
 * Add TagManager-script (if defined)
 *
 * @hook luuptek_wp_base_after_body
 */
add_action( 'luuptek_wp_base_after_body', function () {
	$options = get_option( 'luuptek_wp_base_general_options' );

	if ( ! empty( $options['luuptek_wp_base_tagmanager_body'] ) ) :
		echo $options['luuptek_wp_base_tagmanager_body'];
	endif;
} );

/**
 * Hook anything here to output before and after page content
 *
 * @hook luuptek_wp_base_before_page
 */
add_action( 'luuptek_wp_base_before_page', function () {

} );

add_action( 'luuptek_wp_base_after_page', function () {

} );

/**
 * Add favicons / app-icons / manifests to head
 *
 * @hook wp_head
 */
add_action( 'wp_head', function () {
	$options = get_option( 'luuptek_wp_base_general_options' );

	if ( ! empty( $options['luuptek_wp_base_tagmanager_head'] ) ) :
		echo $options['luuptek_wp_base_tagmanager_head'];
	endif;
}, 999 );

/**
 * Modify excerpt lenght and style
 */
//add_filter( 'excerpt_length', function ( $length ) {
//	return 12;
//}, 999 );

add_filter( 'excerpt_more', function () {
	return '...';
} );

/*
 * Let polylang to copy post title, content and excerpt when making a new language version
 */
add_filter( 'default_content', function ( $content ) {
	if ( isset( $_GET['from_post'] ) ) {
		$my_post = get_post( $_GET['from_post'] );
		if ( $my_post ) {
			return $my_post->post_content;
		}
	}

	return $content;
} );
add_filter( 'default_excerpt', function ( $content ) {
	if ( isset( $_GET['from_post'] ) ) {
		$my_post = get_post( $_GET['from_post'] );
		if ( $my_post ) {
			return $my_post->post_excerpt;
		}
	}

	return $content;
} );
add_filter( 'default_title', function ( $content ) {
	if ( isset( $_GET['from_post'] ) ) {
		$my_post = get_post( $_GET['from_post'] );
		if ( $my_post ) {
			return $my_post->post_title;
		}
	}

	return $content;
} );

/**
 * Disable users endpoint in api
 */
add_filter( 'rest_endpoints', function ( $endpoints ) {
	if ( ! current_user_can( 'list_users' ) ) {
		if ( isset( $endpoints['/wp/v2/users'] ) ) {
			unset( $endpoints['/wp/v2/users'] );
		}
		if ( isset( $endpoints['/wp/v2/users/(?P<id>[\d]+)'] ) ) {
			unset( $endpoints['/wp/v2/users/(?P<id>[\d]+)'] );
		}
	}

	return $endpoints;
} );


/**
 * Block rendering filter
 *
 * You can alter the block rendering by block here
 */
add_filter( 'render_block', function ( $block_content, $block ) {

	/**
	 * Adds table-responsive class prior to table
	 */
	if ( $block['blockName'] === 'core/table' ) {

		$classes = '';

		if ( $block['attrs']['align'] === 'full' ) {
			$classes = ' alignfull';
		}

		if ( $block['attrs']['align'] === 'wide' ) {
			$classes = ' alignwide';
		}

		return sprintf(
			'<div class="table-responsive%s">%s</div>',
			$classes, $block_content
		);
	}

	return $block_content;
}, 10, 2 );

/**
 * Use filter to create new block categories
 *
 * @param $categories
 * @param $post
 *
 * @return array
 */
function luuptek_wp_base_block_categories( $categories, $post ) {
	return array_merge(
		$categories,
		[
			[
				'slug'  => 'new-luuptek-block-category',
				'title' => __( 'Luuptek blocks', TEXT_DOMAIN ),
			],
		]
	);
}

add_filter( 'block_categories', 'luuptek_wp_base_block_categories', 10, 2 );
