<?php
/**
 * Plugin Name: ExamplePress Core
 * Plugin URI:  https://examplepress.com
 * Description: An ExamplePress companion plugin.
 * Version:     0.0.1
 * Author:      vinnysgreen
 * Author URI:  https://vinnysgreen.com
 * Theme: examplepress-theme
 * Requires at least: 6.9
 * Requires PHP: 8.4
 * Text Domain: examplepress-core
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// ── 1. Set the Route Topology (Origin Registration) ───────────────
// This tells the router to use 'examplepress-core/template-front'
// ONLY when the request is for the front page. All other routes
// will safely fall back to their defaults.
add_action( 'after_setup_theme', function () {
	if ( function_exists( 'examplepress_register_route_origin' ) ) {
		$__ep_config   = json_decode( file_get_contents( __DIR__ . '/examplepress.json' ), true ) ?: [];
		$__ep_priority = (int) ( $__ep_config['routing']['priority'] ?? 10 );

		examplepress_register_route_origin( 'examplepress-core', [
			'front' => fn() => is_front_page() || is_home(),
		], $__ep_priority );
	}
} );


// ── 2. Blockstudio Initialization ─────────────────────────────────
add_action( 'init', function () {
	if ( ! class_exists( 'Blockstudio\\Build' ) ) {
		return;
	}

	Blockstudio\Build::init( [
		'dir' => plugin_dir_path( __FILE__ ) . 'app',
	] );
} );
