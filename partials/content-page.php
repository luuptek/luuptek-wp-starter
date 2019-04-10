<?php

/**
 * The main template for page
 *
 * @package Luuptek WP-Base
 *
 */

?>

<article <?php post_class( 'post-container gutenberg post-' . sanitize_title( get_the_title() ) ); ?>>
	<?php the_content(); ?>
</article>
