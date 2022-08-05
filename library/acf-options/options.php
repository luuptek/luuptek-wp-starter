<?php

if ( function_exists( 'acf_add_options_page' ) ) {

	$args = [
		'page_title'      => __( 'Teeman asetukset', 'luuptek_wp_base' ),
		'parent_slug'     => 'options-general.php',
		'update_button'   => __( 'Päivitä asetukset', 'luuptek_wp_base' ),
		'updated_message' => __( 'Asetukset päivitetty', 'luuptek_wp_base' ),
	];

	acf_add_options_page( $args );

}
