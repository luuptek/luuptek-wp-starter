<?php

/**
 * The main template for basic-content
 *
 * @package Luuptek WP-Base
 *
 */

?>

<article <?php post_class( 'post-container gutenberg post-' . sanitize_title( get_the_title() ) ); ?>>
	<?php
	if ( has_post_thumbnail() ) {
		echo '<figure class="wp-block-image alignwide">';
		the_post_thumbnail( 'large' );
		echo '</figure>';
	}
	?>
	<p><?php the_date(); ?></p>
	<h1><?php the_title(); ?></h1>
	<?php the_content(); ?>
</article>
