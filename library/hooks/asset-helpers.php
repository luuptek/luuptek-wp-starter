<?php

namespace AssetHelpers;

function asset_path( $filename ) {

	if ( preg_match( '/\.js$/', $filename ) ) {
		throw new \Error( 'Do not pass JavaScript files to asset_path(). Use enqueue_webpack_entry() instead.' );
	}

	$dist_path = get_template_directory_uri() . '/dist/';
	$directory = dirname( $filename ) . '/';
	$file      = basename( $filename );
	return $dist_path . $directory . $file;
}

function get_webpack_entry_uri( $entry ) {

	if ( preg_match( '/\.js$/', $entry ) ) {
		throw new \Error( "Webpack entries must not have .js extension: $entry" );
	}

	$is_admin_entry = preg_match( '/-admin$/', $entry );

	// Admin scripts are in a different manifest file
	$manifest_filename = $is_admin_entry ? 'manifest-admin.json' : 'manifest.json';
	$manifest_path =  get_template_directory() . '/dist/scripts/' . $manifest_filename;
	$webpack_manifest = json_decode( file_get_contents( $manifest_path ), true );

	$filename = $webpack_manifest[ $entry . '.js' ] ?? null;

	if ( ! $filename ) {
		throw new \Error("Cannot find Webpack entry for '$entry.js'. Have you executed 'sakke build'? Looked from $manifest_path");
	}


	if ( ASSET_DEV ) {
		// Serve js assets from Webpack Dev Server when asset dev mode is enabled
		global $sakke_config;
		$host = $sakke_config->webpack->host;
		$port = $sakke_config->webpack->port;
		return "http://$host:$port/wp-content/themes/" . get_template() . '/dist/scripts/' . $filename;
	}

	$dist_path = get_template_directory_uri() . '/dist/scripts/';
	return $dist_path . $filename;
}

function enqueue_webpack_entry( $entry, $options = [] ) {
	$options = \array_merge(
		[
			'deps' => [],
			'head' => false,
		],
		$options
	);

	wp_enqueue_script(
		"webpack/$entry",
		get_webpack_entry_uri( $entry ),
		$options['deps'],
		null,
		!$options['head']
	);

}

/**
 * Compare two strings
 *
 * @param $haystack
 * @param $needle
 *
 * @return bool
 */
function starts_with( $haystack, $needle ) {
	$length = strlen( $needle );

	return ( substr( $haystack, 0, $length ) === $needle );
}

/**
 * Get full path for a filename inside dist/images
 *
 * @param $filename
 * @param $path
 *
 * @throws \Exception If image path seems dangerous
 * @return bool|string
 */
function get_image_path( $filename, $path ) {
	$image_path = sprintf( '%s/dist/images/', get_template_directory() );
	if ( '' !== $path ) {
		$image_path = sprintf( '%s/%s', get_template_directory(), $path );
	}

	$file_path  = sprintf( '%s%s', $image_path, $filename );

	$real_path = realpath( $file_path );

	if ( ! starts_with( $real_path, $image_path ) ) {
		error_log( $image_path );
		error_log( $real_path );
		throw new \Exception( 'Possible path traversal detected. Check your filename.' );
	}

	return $real_path;
}

