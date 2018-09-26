<?php

/**
 * The No results found -template
 *
 * @package Luuptek WP-Base
 *
 */

?>

<article>
	<?php _e( 'Error 404: Page not found', TEXT_DOMAIN ); ?>
	<?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', TEXT_DOMAIN ); ?>
	<?php get_search_form(); ?>
</article>
