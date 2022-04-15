<?php

namespace LuuptekWP;

class Initialization {

	/**
	 * Default options to populate wpdb
	 *
	 * @var array
	 */
	private $default_options = [
		'show_avatars'                  => '',
		'blogdescription'               => '',
		'require_name_email'            => '',
		'comments_notify'               => '',
		'default_comment_status'        => 'closed',
		'default_ping_status'           => 'closed',
		'default_pingback_flag'         => '',
		'comment_moderation'            => '1',
		'moderation_notify'             => '',
		'comment_registration'          => '1',
		'thread_comments'               => '1',
		'thread_comments_depth'         => '2',
		'page_comments'                 => '0',
		'comments_per_page'             => '10',
		'default_comments_page'         => 'newest',
		'use_trackback'                 => '0',
		'uploads_use_yearmonth_folders' => '',
		'date_format'                   => 'd.m.Y',
		'default_post_edit_rows'        => 40,
		'permalink_structure'           => '/%postname%/',
		'ping_sites'                    => "http://rpc.pingomatic.com \n http://rpc.twingly.com \n http://api.feedster.com/ping \n http://api.moreover.com/RPC2 \n http://api.moreover.com/ping \n http://www.blogdigger.com/RPC2 \n http://www.blogshares.com/rpc.php \n http://www.blogsnow.com/ping \n http://www.blogstreet.com/xrbin/xmlrpc.cgi \n http://bulkfeeds.net/rpc \n http://www.newsisfree.com/xmlrpctest.php \n http://ping.blo.gs/ \n http://ping.feedburner.com \n http://ping.syndic8.com/xmlrpc.php \n http://ping.weblogalot.com/rpc.php \n http://rpc.blogrolling.com/pinger/ \n http://rpc.technorati.com/rpc/ping \n http://rpc.weblogs.com/RPC2 \n http://www.feedsubmitter.com \n http://blo.gs/ping.php \n http://www.pingerati.net \n http://www.pingmyblog.com \n http://geourl.org/ping \n http://ipings.com \n http://www.weblogalot.com/ping",
	];

	public function __construct() {

		// Add actions
		//add_action( 'after_switch_theme', [ $this, 'set_defaults' ] );
		//add_action( 'init', [ $this, 'disable_emojis' ] );
		//add_filter( 'the_generator', '__return_false' );
		//add_action( 'init', [ $this, 'head_cleanup' ] );
		//add_filter( 'language_attributes', [ $this, 'language_attributes' ] );
		//add_filter( 'style_loader_tag', [ $this, 'clean_style_tag' ] );
		//add_filter( 'body_class', [ $this, 'body_class' ] );
		//add_filter( 'embed_oembed_html', [ $this, 'embed_wrap' ], 10, 4 );
		//add_action( 'admin_init', [ $this, 'remove_dashboard_widgets' ] );
		//add_filter( 'get_avatar', [ $this, 'remove_self_closing_tags' ] );
		//add_filter( 'comment_id_fields', [ $this, 'remove_self_closing_tags' ] );
		//add_filter( 'post_thumbnail_html', [ $this, 'remove_self_closing_tags' ] );
		//add_filter( 'get_bloginfo_rss', [ $this, 'remove_default_description' ] );
		//add_filter( 'request', [ $this, 'request_filter' ] );
		//add_filter( 'wp_headers', [ $this, 'filter_headers' ], 10, 1 );
		//add_filter( 'rewrite_rules_array', [ $this, 'filter_rewrites' ] );
		//add_action( 'template_redirect', [ $this, 'nice_search_redirect' ] );
		//add_filter( 'wp_title', [ $this, 'wp_title' ], 10, 2 );
		//add_filter( 'body_class', [ $this, 'add_body_classes' ] );
		//add_filter( 'wp_page_menu_args', [ $this, 'page_menu_args' ] );
		//add_action( 'admin_init', [ $this, 'is_htaccess_writable' ] );
		//add_action( 'generate_rewrite_rules', [ $this, 'add_h5bp_htaccess' ] );
		//add_filter( 'xmlrpc_enabled', '__return_false' );

		// Remove WP-API link from head if any
		if ( has_action( 'wp_head', 'json_output_link_wp_head' ) ) {
			//remove_action( 'wp_head', 'json_output_link_wp_head' );
		}

		// Enable root relative urls
		$this->enable_root_relative_urls();

	}

	/**
	 * Set default options
	 */
	function set_defaults() {

		// Update options to wpdp
		foreach ( $this->default_options as $name => $value ) {
			update_option( $name, $value );
		}

		// Delete default post & comment
		wp_delete_post( 1, true );
		wp_delete_comment( 1 );

	}

	/**
	 * Disable emojis
	 */
	function disable_emojis() {
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
		remove_action( 'admin_print_styles', 'print_emoji_styles' );
		remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
		remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
		remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	}

	/**
	 * Cleaup WP-head
	 */
	function head_cleanup() {

		// Originally from http://wpengineer.com/1438/wordpress-header/
		remove_action( 'wp_head', 'feed_links', 2 );
		remove_action( 'wp_head', 'feed_links_extra', 3 );
		remove_action( 'wp_head', 'rsd_link' );
		remove_action( 'wp_head', 'wlwmanifest_link' );
		remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10 );
		remove_action( 'wp_head', 'wp_generator' );
		remove_action( 'wp_head', 'wp_shortlink_wp_head', 10 );

		global $wp_widget_factory;

		if ( isset( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'] ) ) {
			remove_action( 'wp_head',
				[ $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ] );
		}

		if ( ! class_exists( 'WPSEO_Frontend' ) ) {
			remove_action( 'wp_head', 'rel_canonical' );
			add_action( 'wp_head', [ $this, 'rel_canonical' ] );
		}
	}

	/**
	 * Fix canonical link
	 */
	function rel_canonical() {
		global $wp_the_query;

		if ( ! is_singular() ) {
			return;
		}

		if ( ! $id = $wp_the_query->get_queried_object_id() ) {
			return;
		}

		$link = get_permalink( $id );
		echo "\t<link rel=\"canonical\" href=\"$link\">\n";
	}

	/**
	 * Alter lang-attributes
	 *
	 * @return mixed|string|void
	 */
	function language_attributes() {
		$attributes = [];
		$output     = '';

		if ( is_rtl() ) {
			$attributes[] = 'dir="rtl"';
		}

		$lang = get_bloginfo( 'language' );

		if ( $lang ) {
			$attributes[] = "lang=\"$lang\"";
		}

		$output = implode( ' ', $attributes );
		$output = apply_filters( 'soil/language_attributes', $output );

		return $output;
	}

	/**
	 * Remove unnecessary things from registered style-tags
	 *
	 * @param $input
	 *
	 * @return string
	 */
	function clean_style_tag( $input ) {
		preg_match_all( "!<link rel='stylesheet'\s?(id='[^']+')?\s+href='(.*)' type='text/css' media='(.*)' />!",
			$input,
			$matches );
		// Only display media if it is meaningful
		$media = $matches[3][0] !== '' && $matches[3][0] !== 'all' ? ' media="' . $matches[3][0] . '"' : '';

		return '<link rel="stylesheet" href="' . $matches[2][0] . '"' . $media . '>' . "\n";
	}

	/**
	 * Add classes to body
	 *
	 * @param $classes
	 *
	 * @return array
	 */
	function body_class( $classes ) {
		// Add post/page slug
		if ( is_single() || is_page() && ! is_front_page() ) {
			$classes[] = basename( get_permalink() );
		}

		// Remove unnecessary classes
		$home_id_class  = 'page-id-' . get_option( 'page_on_front' );
		$remove_classes = [
			'page-template-default',
			$home_id_class
		];
		$classes        = array_diff( $classes, $remove_classes );

		return $classes;
	}

	/**
	 * Wrap embedded media as suggested by Readability
	 *
	 * @link https://gist.github.com/965956
	 * @link http://www.readability.com/publishers/guidelines#publisher
	 */
	function embed_wrap( $cache, $url, $attr = '', $post_ID = '' ) {
		return '<div class="entry-content-asset">' . $cache . '</div>';
	}

	/**
	 * Remove unnecessary dashboard widgets
	 *
	 * @link http://www.deluxeblogtips.com/2011/01/remove-dashboard-widgets-in-wordpress.html
	 */
	function remove_dashboard_widgets() {
		remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_primary', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_secondary', 'dashboard', 'normal' );
	}

	/**
	 * Remove unnecessary self-closing tags
	 */
	function remove_self_closing_tags( $input ) {
		return str_replace( ' />', '>', $input );
	}

	/**
	 * Don't return the default description in the RSS feed if it hasn't been changed
	 */
	function remove_default_description( $bloginfo ) {
		$default_tagline = 'Just another WordPress site';

		return ( $bloginfo === $default_tagline ) ? '' : $bloginfo;
	}

	/**
	 * Fix for empty search queries redirecting to home page
	 *
	 * @link http://wordpress.org/support/topic/blank-search-sends-you-to-the-homepage#post-1772565
	 * @link http://core.trac.wordpress.org/ticket/11330
	 */
	function request_filter( $query_vars ) {
		if ( isset( $_GET['s'] ) && empty( $_GET['s'] ) && ! is_admin() ) {
			$query_vars['s'] = ' ';
		}

		return $query_vars;
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
				'style_loader_src'
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

	/**
	 * Remove pingback header
	 */
	function filter_headers( $headers ) {
		if ( isset( $headers['X-Pingback'] ) ) {
			unset( $headers['X-Pingback'] );
		}

		return $headers;
	}

	/**
	 * Kill trackback rewrite rule
	 */
	function filter_rewrites( $rules ) {
		foreach ( $rules as $rule => $rewrite ) {
			if ( preg_match( '/trackback\/\?\$$/i', $rule ) ) {
				unset( $rules[ $rule ] );
			}
		}

		return $rules;
	}

	/**
	 * Redirects search results from /?s=query to /search/query/, converts %20 to +
	 */
	function nice_search_redirect() {
		global $wp_rewrite;
		if ( ! isset( $wp_rewrite ) || ! is_object( $wp_rewrite ) || ! $wp_rewrite->using_permalinks() ) {
			return;
		}

		$search_base = $wp_rewrite->search_base;
		if ( is_search() && ! is_admin() && strpos( $_SERVER['REQUEST_URI'], "/{$search_base}/" ) === false ) {
			wp_redirect( home_url( "/{$search_base}/" . urlencode( get_query_var( 's' ) ) ) );
			exit();
		}
	}

	/**
	 * Filters wp_title to print a neat <title> tag based on what is being viewed.
	 */
	function wp_title( $title, $sep ) {
		global $page, $paged;

		if ( is_feed() ) {
			return $title;
		}

		// Add the blog name
		$title .= get_bloginfo( 'name' );

		// Add the blog description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) ) {
			$title .= " $sep $site_description";
		}

		// Add a page number if necessary:
		if ( $paged >= 2 || $page >= 2 ) {
			$title .= " $sep " . sprintf( __( 'Sivu %s', 'luuptek_wp_base' ), max( $paged, $page ) );
		}

		return $title;
	}

	/**
	 * Add classes to body
	 */
	function add_body_classes( $classes ) {
		global $post;
		if ( isset( $post ) ) {
			$classes[] = $post->post_name;
		}
		if ( is_multi_author() ) {
			$classes[] = 'group-blog';
		}

		return $classes;
	}

	/**
	 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
	 */
	function page_menu_args( $args ) {
		$args['show_home'] = false;

		return $args;
	}

	/**
	 * Show an admin notice if .htaccess isn't writable
	 */
	function is_htaccess_writable() {
		if ( ! is_writable( get_home_path() . '.htaccess' ) && strpos( strtolower( $_SERVER['SERVER_SOFTWARE'] ),
				'apache' ) !== false
		) {
			if ( current_user_can( 'administrator' ) ) {
				add_action( 'admin_notices', create_function( '',
					"echo '<div class=\"error\"><p>" . sprintf( __( 'Huomioithan että <a href="%s">.htaccess</a> on kirjoitettavissa ',
						'luuptek_wp_base' ), admin_url( 'options-permalink.php' ) ) . "</p></div>';" ) );
			}
		}
	}

	/**
	 * Add HTML5 Boilerplate's .htaccess via WordPress
	 */
	function add_h5bp_htaccess( $content ) {
		global $wp_rewrite;
		$home_path           = function_exists( 'get_home_path' ) ? get_home_path() : ABSPATH;
		$htaccess_file       = $home_path . '.htaccess';
		$mod_rewrite_enabled = function_exists( 'got_mod_rewrite' ) ? got_mod_rewrite() : false;

		if ( ( ! file_exists( $htaccess_file ) && is_writable( $home_path ) && $wp_rewrite->using_mod_rewrite_permalinks() ) || is_writable( $htaccess_file ) ) {
			if ( $mod_rewrite_enabled ) {
				$h5bp_rules = extract_from_markers( $htaccess_file, 'HTML5 Boilerplate' );
				if ( $h5bp_rules === [] ) {
					$h5bp_file = dirname( __FILE__ ) . '/h5bp-htaccess';

					return insert_with_markers( $htaccess_file, 'HTML5 Boilerplate',
						extract_from_markers( $h5bp_file, 'HTML5 Boilerplate' ) );
				}
			}
		}

		return $content;

	}
}

/**
 * Construct Initialization-Class
 */
new Initialization;
