<?php
/**
 * Plugin Name: ExamplePress Core
 * Plugin URI:  https://examplepress.com
 * Description: 
 * Version:     0.0.0
 * Author:      vinnysgreen
 * Author URI:  https://vinnysgreen.com
 * Text Domain: examplepress-core
 * Troy: internal.repo.mustuse.com
 */


defined( 'ABSPATH' ) || exit;

define( 'EP_ABSPATH', plugin_dir_path( __FILE__ ) );
define( 'EP_ENDPOINT_BASE', 'examplepress-core/v1' );

// define plugin direct
define( 'EP_PLUGIN_FILE', __FILE__ );
define( 'EP_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'EP_PLUGIN_URL', plugin_dir_url( __FILE__ ) );


if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
	require_once __DIR__ . '/vendor/autoload.php';
} else {
	error_log( 'Composer autoload file not found. Please run "composer install".' );
}

// check for blockstudio, class
if ( ! class_exists( 'Blockstudio\Build' ) ) {
	add_action( 'admin_notices', function (): void {
		echo '<div class="notice notice-error"><p><strong>ExamplePress Core:</strong> Blockstudio Build class not found. Please ensure the build dependencies are installed correctly.</p></div>';
	} );
} else {
	add_action( 'init', function () {
		Blockstudio\Build::init( [
			'dir' => EP_PLUGIN_DIR . 'app',
		] );
	} );
}

// examplepress_theme_namespace set to examplepress-core

add_filter( 'examplepress_theme_namespace', function ( $namespace ) {
	return 'examplepress-core';
} );

// examplepress_template_prefix

add_filter( 'examplepress_template_prefix', function ( $prefix ) {
	return 'template';
} );

// examplepress_route_context

add_filter( 'examplepress_route_context', function ( $context ) {
	$context = "front";

	if ( is_front_page() || is_home() ) {
		return 'front';
	}

	return $context;

} );