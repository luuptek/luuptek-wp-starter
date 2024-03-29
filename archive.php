<?php

/**
 * The main archive-template
 *
 * @package Luuptek WP-Base
 */

get_header();

?>

<?php do_action( 'luuptek_wp_base_before_page' ); ?>

<div class="section">
	<div class="container">
		<h1><?php echo get_the_archive_title(); ?></h1>
		<?php
		if ( have_posts() ) :
			echo '<div class="post-lifts-row">';
			while ( have_posts() ) :
				the_post();
				get_template_part( 'partials/content', 'post-lift' );
			endwhile;
			echo '</div>';
			get_template_part( 'partials/pagination' );
		endif;
		?>
	</div>
</div>

<?php do_action( 'luuptek_wp_base_after_page' ); ?>

<?php get_footer(); ?>
