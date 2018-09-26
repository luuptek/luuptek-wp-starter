<?php

/**
 * Alter WP-loops
 *
 * @hook pre_get_posts
 */
add_action( 'pre_get_posts', function ( $query ) {

	/**
	 * Some examples...
	 */
	//global $pagenow;

	/**
	 * Sets post order by post_date in admin
	 */
//	if ( is_admin() && ( $pagenow === 'edit.php' ) ) {
//		$query->set( 'orderby', 'post_date' );
//		$query->set( 'order', 'DESC' );
//	}

	/**
	 * In tag and category archive, show posts from all post types..
	 */
//	if ( ( is_tag() || is_category() ) && $query->is_main_query() ) {
//		$query->set( 'post_type', array(
//			'news',
//			'articles',
//			'reviews'
//		) );
//	}
} );
