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
		<?php printf( pll_esc_html__( 'Ei tuloksia haulla %s' ), '<span>' . get_search_query() . '</span>' ); ?>
	</h1>
	<p>
		<?php
		esc_html_e( 'Pahoittelut, mutta hakusi ei tuottanut tulosta. Voit yrittää jollain toisilla hakusanoilla.', 'luuptek_wp_base' );
		?>
	</p>
	<?php get_search_form(); ?>
</article>
