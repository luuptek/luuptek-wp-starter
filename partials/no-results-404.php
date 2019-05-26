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
                <?php _e( 'Error 404: Page not found', TEXT_DOMAIN ); ?>
            </h1>
		    <p>
                <?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', TEXT_DOMAIN ); ?>
            </p>
		    <?php get_search_form(); ?>
        </article>
    </div>
</section>
