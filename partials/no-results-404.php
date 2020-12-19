<?php

/**
 * The No results found -template
 *
 * @package Luuptek WP-Base
 *
 */

?>

<section>
	<div class="container">
		<article>
			<h1>
				<?php esc_html_e( 'Error 404: Sivua ei löytynyt', 'luuptek_wp_base' ); ?>
			</h1>
			<p>
				<?php esc_html_e( 'Näyttää siltä, että hakemaasi sivua ei ole olemassa. Voit yrittää hakea etsimääsi.', 'luuptek_wp_base' ); ?>
			</p>
			<?php get_search_form(); ?>
		</article>
	</div>
</section>
