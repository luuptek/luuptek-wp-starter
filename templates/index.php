<?php

/**
 * The main article-list template
 *
 * @package Luuptek WP-Base
 */

get_header();

?>

<?php do_action( 'luuptek_wp_base_before_page' ); ?>

<section>
    <div class="container">
        <h1><?php echo get_the_archive_title(); ?></h1>
		<?php
		if ( have_posts() ):
			while ( have_posts() ):
				the_post();
				get_template_part( 'partials/content', 'excerpt' );
			endwhile;
			get_template_part( 'partials/pagination' );
		else :
			get_template_part( 'partials/no-results' );
		endif;
		?>
    </div>
</section>

<?php do_action( 'luuptek_wp_base_after_page' ); ?>

<?php get_footer(); ?>
