<?php

/**
 * Customise tags in tinyMCE
 */
add_filter(
	'tiny_mce_before_init',
	function ( $init ) {
		$block_formats         = array(
			'Paragraph=p',
			'Heading 1=h1',
			'Heading 2=h2',
			'Heading 3=h3',
			'Heading 4=h4',
			'Heading 5=h5',
			'Heading 6=h6',
		);
		$init['block_formats'] = implode( ';', $block_formats );

		return $init;
	}
);

/**
 * Hook anything here to output before and after page content
 *
 * @hook luuptek_wp_base_before_page
 */
add_action(
	'luuptek_wp_base_before_page',
	function () {

	}
);

add_action(
	'luuptek_wp_base_after_page',
	function () {

	}
);

/**
 * Add scripts to head
 *
 * @hook wp_head
 */
add_action(
	'wp_head',
	function () {
		$options = get_field( 'luuptek_wp_base_scripts_head', 'option' );

		if ( ! empty( $options ) ) :
			echo $options;
		endif;
	},
	999
);

/**
 * Add scripts to footer
 *
 * @hook wp_head
 */
add_action(
	'wp_footer',
	function () {
		$options = get_field( 'luuptek_wp_base_scripts_footer', 'option' );

		if ( ! empty( $options ) ) :
			echo $options;
		endif;
	},
	999
);

/**
 * Add scripts after opening body
 *
 * @hook luuptek_wp_base_after_body
 */
add_action(
	'luuptek_wp_base_after_body',
	function () {
		$options = get_field( 'luuptek_wp_base_scripts_after_body', 'option' );

		if ( ! empty( $options ) ) :
			echo $options;
		endif;
	}
);

/**
 * Modify excerpt lenght and style
 */
add_filter(
	'excerpt_length',
	function ( $length ) {
		return 12;
	},
	999
);

add_filter(
	'excerpt_more',
	function () {
		return '...';
	}
);

add_filter(
	'get_the_excerpt',
	function ( $excerpt, $post ) {
		if ( has_excerpt( $post ) ) {
			$excerpt_length = apply_filters( 'excerpt_length', 12 );
			$excerpt_more   = apply_filters( 'excerpt_more', '...' );
			$excerpt        = wp_trim_words( $excerpt, $excerpt_length, $excerpt_more );
		}

		return $excerpt;
	},
	10,
	2
);

/*
 * Let polylang to copy post title, content and excerpt when making a new language version
 */
add_filter(
	'default_content',
	function ( $content ) {
		if ( isset( $_GET['from_post'] ) ) {
			$my_post = get_post( sanitize_text_field( wp_unslash( $_GET['from_post'] ) ) );
			if ( $my_post ) {
				return $my_post->post_content;
			}
		}

		return $content;
	}
);

add_filter(
	'default_excerpt',
	function ( $content ) {
		if ( isset( $_GET['from_post'] ) ) {
			$my_post = get_post( sanitize_text_field( wp_unslash( $_GET['from_post'] ) ) );
			if ( $my_post ) {
				return $my_post->post_excerpt;
			}
		}

		return $content;
	}
);

add_filter(
	'default_title',
	function ( $content ) {
		if ( isset( $_GET['from_post'] ) ) {
			$my_post = get_post( sanitize_text_field( wp_unslash( $_GET['from_post'] ) ) );
			if ( $my_post ) {
				return $my_post->post_title;
			}
		}

		return $content;
	}
);

/**
 * Disable users endpoint in api
 */
add_filter(
	'rest_endpoints',
	function ( $endpoints ) {
		if ( ! current_user_can( 'list_users' ) ) {
			if ( isset( $endpoints['/wp/v2/users'] ) ) {
				unset( $endpoints['/wp/v2/users'] );
			}
			if ( isset( $endpoints['/wp/v2/users/(?P<id>[\d]+)'] ) ) {
				unset( $endpoints['/wp/v2/users/(?P<id>[\d]+)'] );
			}
		}

		return $endpoints;
	}
);


/**
 * Block rendering filter
 *
 * You can alter the block rendering by block here
 *
 * Leaving this here as an example..
 */
//add_filter( 'render_block', function ( $block_content, $block ) {
//
//	/**
//	 * Adds table-responsive class prior to table
//	 */
//	if ( $block['blockName'] === 'core/table' ) {
//
//		$classes = '';
//
//		if ( $block['attrs']['align'] === 'full' ) {
//			$classes = ' alignfull';
//		}
//
//		if ( $block['attrs']['align'] === 'wide' ) {
//			$classes = ' alignwide';
//		}
//
//		return sprintf(
//			'<div class="table-responsive%s">%s</div>',
//			$classes, $block_content
//		);
//	}
//
//	return $block_content;
//}, 10, 2 );

/**
 * Use filter to create new block categories
 *
 * @param array $categories Array of the categories
 * @param object $post Post object
 *
 * @return array
 */
function luuptek_wp_base_block_categories( $categories, $post ) {
	return array_merge(
		$categories,
		[
			[
				'slug'  => 'new-luuptek-block-category',
				'title' => __( 'Luuptek lohkot', 'luuptek_wp_base' ),
			],
		]
	);
}

add_filter( 'block_categories_all', 'luuptek_wp_base_block_categories', 10, 2 );

/**
 * Remove jquery-migrate from front end
 *
 * @param object $scripts Scripts object
 */
function dequeue_jquery_migrate( $scripts ) {
	if ( ! is_admin() && ! empty( $scripts->registered['jquery'] ) ) {
		$scripts->registered['jquery']->deps = array_diff(
			$scripts->registered['jquery']->deps,
			[ 'jquery-migrate' ]
		);
	}
}

add_action( 'wp_default_scripts', 'dequeue_jquery_migrate' );

/**
 * Add extra body classes
 */
add_filter(
	'body_class',
	function ( $classes ) {
		global $post;
		if ( is_page() ) {
			$padding_options = get_post_meta( $post->ID, 'page_content_padding', true );

			if ( ! empty( $padding_options ) ) {
				$classes[] = "page-container-has-padding--{$padding_options}";
			}
		}

		return $classes;
	}
);

/**
 * Custom image sizes to gutenberg image size selection into here
 */
add_filter(
	'image_size_names_choose',
	function ( $sizes ) {
		return array_merge(
			$sizes,
			[
				'article_lift' => __( 'Artikkelinosto', 'luuptek_wp_base' ),
				'hero_slide'   => __( 'Hero slide', 'luuptek_wp_base' ),
				'square'       => __( 'Neliö', 'luuptek_wp_base' ),
			]
		);
	}
);

/**
 * Redirect non-logged in users, just uncomment hook to make the effect
 */
function luuptek_redirect_non_logged_in() {
	if ( ! is_user_logged_in() ) {
		wp_redirect( wp_login_url() );
		exit;
	}
}

// add_action( 'template_redirect', 'luuptek_redirect_non_logged_in' );

/**
 * Allow editors to access menus&widgets by default
 *
 * @return void
 */
function luuptek_add_appearance_cap_to_editori() {
	// Gets the simple_role role object.
	$role = get_role( 'editor' );

	// Add a new capability.
	$role->add_cap( 'edit_theme_options', true );
}

// Adding capabilities, priority must be after the initial role definition.
add_action( 'init', 'luuptek_add_appearance_cap_to_editori', 11 );
