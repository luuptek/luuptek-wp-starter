<?php

/**
 * The main 404-wrapper
 *
 * @package Luuptek WP-Base
 */

get_header();

?>

<?php do_action( 'luuptek_wp_base_before_page' ); ?>
<?php get_template_part( 'partials/no-results', '404' ); ?>
<?php get_footer(); ?>
