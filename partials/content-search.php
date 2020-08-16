<?php

/**
 * The main template for search-results
 *
 * @package Luuptek WP-Base
 *
 */

?>

<article>
	<h3><?php the_title(); ?></h3>
	<a href="<?php the_permalink(); ?>">
		<?php the_excerpt(); ?>
	</a>
</article>
