<?php

/**
 * The main search-wrapper
 *
 * @package Luuptek WP-Base
 */

get_header();

?>

<?php do_action( 'luuptek_wp_base_before_page' ); ?>

<?php if ( have_posts() ) : ?>
	<?php printf( __( 'Search Results for: %s', TEXT_DOMAIN ), '<span>' . get_search_query() . '</span>' ); ?>
	<?php while ( have_posts() ) : the_post(); ?>
		<?php get_template_part( 'partials/content', 'search' ); ?>
	<?php endwhile; ?>

<?php else : ?>
	<?php get_template_part( 'partials/no-results', 'search' ); ?>
<?php endif; ?>

<?php get_footer(); ?>
