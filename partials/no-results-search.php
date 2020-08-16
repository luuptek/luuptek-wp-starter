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
		<?php /* translators: %s: search term */ ?>
		<?php printf( esc_html__( 'No results found for %s', 'luuptek_wp_base' ), '<span>' . get_search_query() . '</span>' ); ?>
	</h1>
	<p>
		<?php
		esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'luuptek_wp_base' );
		?>
	</p>
	<?php get_search_form(); ?>
</article>
