<?php

/**
 * The No results found -template
 *
 * @package Luuptek WP-Base
 *
 */

?>

<article>
	<h1>
        <?php printf( __( 'No results found for %s', TEXT_DOMAIN ), '<span>' . get_search_query() . '</span>' ); ?>
    </h1>
	<p>
        <?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.',
		TEXT_DOMAIN ); ?>
    </p>
	<?php get_search_form(); ?>
</article>