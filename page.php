<?php

/**
 * The main page-template wrapper
 *
 * @package Luuptek WP-Base
 */

get_header();

?>

<?php do_action( 'luuptek_wp_base_before_page' ); ?>

<?php
if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
		get_template_part( 'partials/content', 'page' );
	endwhile;
endif;
?>

<?php do_action( 'luuptek_wp_base_after_page' ); ?>

<?php get_footer(); ?>
