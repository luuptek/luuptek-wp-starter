<?php

if ( function_exists( 'acf_add_options_page' ) ) {

	$args = [
		'page_title'      => __( 'Theme Options', TEXT_DOMAIN ),
		'parent_slug'     => 'options-general.php',
		'update_button'   => __( 'Update options', TEXT_DOMAIN ),
		'updated_message' => __( "Options updated", TEXT_DOMAIN ),
	];

	acf_add_options_page( $args );

}