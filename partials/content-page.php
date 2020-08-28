<?php

/**
 * The main template for page
 *
 * @package Luuptek WP-Base
 *
 */

?>

<article <?php post_class( 'page-container gutenberg post-' . sanitize_title( get_the_title() ) ); ?>>
	<?php the_content(); ?>
</article>
