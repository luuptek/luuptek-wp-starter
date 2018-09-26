<?php

/**
 * The No results found -template
 *
 * @package Luuptek WP-Base
 *
 */

?>

<article>
	<?php printf( __( 'No results found for %s', TEXT_DOMAIN ), '<span>' . get_search_query() . '</span>' ); ?>
	<?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.',
		TEXT_DOMAIN ); ?>
	<?php get_search_form(); ?>
</article>