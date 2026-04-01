<?php
/**
 * Plugin Name: ExamplePress Core
 * Plugin URI:  https://examplepress.com
 * Description: 
 * Version:     0.0.0
 * Author:      vinnysgreen
 * Author URI:  https://vinnysgreen.com
 * Theme: examplepress-theme
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

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// ── 1. Set the Route Topology (Origin Registration) ───────────────
// This tells the router to use 'examplepress-core/template-front' 
// ONLY when the request is for the front page. All other routes 
// will safely fall back to their defaults.
if ( function_exists( 'examplepress_register_route_origin' ) ) {
	$__ep_config   = json_decode( file_get_contents( __DIR__ . '/examplepress.json' ), true ) ?: [];
	$__ep_priority = (int) ( $__ep_config['routing']['priority'] ?? 10 );

	examplepress_register_route_origin( 'examplepress-core', [
		'front' => fn() => is_front_page() || is_home(),
	], $__ep_priority );

	unset( $__ep_config, $__ep_priority );
}

// ── 2. Blockstudio Initialization ─────────────────────────────────
add_action( 'init', function () {
	if ( ! class_exists( 'Blockstudio\\Build' ) ) {
		return;
	}

	Blockstudio\Build::init( [
		'dir' => plugin_dir_path( __FILE__ ) . 'app',
	] );
} );