<?php

/**
 * The main archive-template
 *
 * @package Luuptek WP-Base
 */

get_header();

?>

<?php do_action( 'luuptek_wp_base_before_page' ); ?>

	<section>
		<h1><?php echo get_the_archive_title(); ?></h1>
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'partials/content', 'excerpt' ); ?>
		<?php endwhile; endif; ?>
	</section>

	<section class="pagination">
		<?php echo UTILS()->pagination(); ?>
	</section>

<?php get_footer(); ?>
