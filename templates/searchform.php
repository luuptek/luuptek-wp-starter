<?php

/**
 * The main search-form wrapper
 *
 * @package Luuptek WP-Base
 */

?>

<form role="search" method="get" id="searchform" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <div class="form-group">
        <label class="show-for-sr" for="s"><?php echo _x( 'Search for:', 'label' ); ?></label>
        <input type="text" class="form-control" value="<?php echo get_search_query(); ?>" name="s" id="s"
               placeholder="<?php _e( 'Input search terms', TEXT_DOMAIN ); ?>"/>
    </div>
    <button type="submit" class="btn btn-primary"><?php echo esc_attr_x( 'Search', 'submit button' ); ?> <i class="fa fa-search"></i></button>
</form>
