<?php

/**
 * The main search-form wrapper
 *
 * @package Luuptek WP-Base
 */

?>

<form role="search" method="get" id="searchform" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="form-group">
		<label class="show-for-sr" for="s"><?php echo esc_html_x( 'Search for:', 'label' ); ?></label>
		<input type="text" class="form-control" value="<?php echo get_search_query(); ?>" name="s" id="s"
		       placeholder="<?php esc_html_e( 'Syötä hakusanat', 'luuptek_wp_base' ); ?>"/>
	</div>
	<button type="submit" class="btn btn-primary">
		<?php _e( 'Hae', 'luuptek_wp_base' ); ?>
	</button>
</form>
