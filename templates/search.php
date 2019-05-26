<?php

/**
 * The main search-wrapper
 *
 * @package Luuptek WP-Base
 */

get_header();

?>

<?php do_action( 'luuptek_wp_base_before_page' ); ?>

<section>
    <div class="container">
		<?php if ( have_posts() ) : ?>
            <h1>
				<?php printf( __( 'Search Results for: %s', TEXT_DOMAIN ), '<span>' . get_search_query() . '</span>' ); ?>
            </h1>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'partials/content', 'search' ); ?>
			<?php endwhile; ?>

		<?php else : ?>
			<?php get_template_part( 'partials/no-results', 'search' ); ?>
		<?php endif; ?>
    </div>
</section>

<?php do_action( 'luuptek_wp_base_after_page' ); ?>

<?php get_footer(); ?>
