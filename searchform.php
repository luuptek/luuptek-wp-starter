<?php

/**
 * The main search-form wrapper
 *
 * @package Luuptek WP-Base
 */

$show_close = isset( $args['show_close'] ) ? $args['show_close'] : false;
?>

<form role="search" method="get" id="searchform" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="luuptek-form-field-group">
		<label class="luuptek-form-label"
		       for="s"><?php echo esc_html_x( 'Hae:', 'search label', 'luuptek_wp_base' ); ?></label>
		<input type="text" class="luuptek-form-control" value="<?php echo get_search_query(); ?>" name="s" id="s"
		       placeholder="<?php esc_html_e( 'Syötä hakusanat', 'luuptek_wp_base' ); ?>"/>
	</div>
	<div class="wp-block-button">
		<button type="submit" class="wp-block-button__link">
			<?php esc_html_e( 'Hae', 'luuptek_wp_base' ); ?>
		</button>
		<?php if ( $show_close ) : ?>
			<button class="wp-block-button__link close-main-search">
				<?php esc_html_e( 'Sulje haku', 'luuptek_wp_base' ); ?>
			</button>
		<?php endif; ?>
	</div>
</form>
