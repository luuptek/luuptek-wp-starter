<?php

/**
 * The main article-list template
 *
 * @package Luuptek WP-Base
 */

get_header();

?>

<?php do_action( 'luuptek_wp_base_before_page' ); ?>

<div class="section">
	<div class="container">
		<?php
		if ( have_posts() ) :
			?>
			<h1><?php echo esc_html( get_the_title( get_option( 'page_for_posts' ) ) ); ?></h1>
			<div class="post-lifts-row">
				<?php
				while ( have_posts() ) :
					the_post();
					get_template_part( 'partials/content', 'post-lift' );
				endwhile;
				?>
			</div>
			<?php
			get_template_part( 'partials/pagination' );
		else :
			get_template_part( 'partials/no-results' );
		endif;
		?>
	</div>
</div>

<?php do_action( 'luuptek_wp_base_after_page' ); ?>

<?php get_footer(); ?>
