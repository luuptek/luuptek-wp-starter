<?php

/**
 * The main search-form wrapper
 *
 * @package Luuptek WP-Base
 */

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
			<?php _e( 'Hae', 'luuptek_wp_base' ); ?>
		</button>
	</div>
</form>
