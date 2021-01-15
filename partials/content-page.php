<?php

/**
 * The main template for page
 *
 * @package Luuptek WP-Base
 *
 */

?>

<?php get_template_part( 'partials/blocks/b-hero' ); ?>
<article <?php post_class( 'page-container gutenberg post-' . sanitize_title( get_the_title() ) ); ?>>
	<?php the_content(); ?>
</article>
