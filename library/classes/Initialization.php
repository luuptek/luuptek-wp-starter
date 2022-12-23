<?php

namespace LuuptekWP;

class Initialization {

	public function __construct() {
		// Enable root relative urls
		$this->enable_root_relative_urls();
	}


	/**
	 * Root relative URLs
	 */
	function root_relative_url( $input ) {
		preg_match( '|https?://([^/]+)(/.*)|i', $input, $matches );

		if ( ! isset( $matches[1] ) || ! isset( $matches[2] ) ) {
			return $input;
		} elseif ( ( $matches[1] === $_SERVER['SERVER_NAME'] ) || $matches[1] === $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] ) {
			return wp_make_link_relative( $input );
		} else {
			return $input;
		}
	}

	function enable_root_relative_urls() {
		if ( ! ( is_admin() || in_array( $GLOBALS['pagenow'], [ 'wp-login.php', 'wp-register.php' ] ) ) ) {
			$root_rel_filters = [
				'bloginfo_url',
				'the_permalink',
				'wp_list_pages',
				'wp_list_categories',
				'wp_nav_menu_item',
				'the_content_more_link',
				'the_tags',
				'get_pagenum_link',
				'get_comment_link',
				'month_link',
				'day_link',
				'year_link',
				'tag_link',
				'the_author_posts_link',
				'script_loader_src',
				'style_loader_src',
			];

			$this->add_filters( $root_rel_filters, [ $this, 'root_relative_url' ] );
		};
	}

	/**
	 * Add filters
	 *
	 * @param $tags
	 * @param $function
	 */
	function add_filters( $tags, $function ) {
		foreach ( $tags as $tag ) {
			add_filter( $tag, $function );
		}
	}
}

/**
 * Construct Initialization-Class
 */
//new Initialization;
