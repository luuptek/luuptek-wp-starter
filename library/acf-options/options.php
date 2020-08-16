<?php

if ( function_exists( 'acf_add_options_page' ) ) {

	$args = [
		'page_title'      => __( 'Theme Options', 'luuptek_wp_base' ),
		'parent_slug'     => 'options-general.php',
		'update_button'   => __( 'Update options', 'luuptek_wp_base' ),
		'updated_message' => __( 'Options updated', 'luuptek_wp_base' ),
	];

	acf_add_options_page( $args );

}
