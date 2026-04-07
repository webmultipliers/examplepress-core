<?php
/**
 * Plugin Name: ExamplePress Core
 * Plugin URI:  https://examplepress.com
 * Description: An ExamplePress companion plugin.
 * Version:     0.0.3
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

use ExamplePress\MU\Infrastructure\RouteRegistry;

// ── 1. Set the Route Topology (Origin Registration) ───────────────
if ( class_exists( RouteRegistry::class) ) {
	$__ep_config   = json_decode( file_get_contents( __DIR__ . '/examplepress.json' ), true ) ?: [];
	$__ep_priority = (int) ( $__ep_config['routing']['priority'] ?? 10 );

	RouteRegistry::register( 'examplepress-core', [
		'page-404'     => fn() => is_404(),
		'front'        => fn() => is_front_page() || is_home(),
		'page-explore' => fn() => is_page( 'explore' ),
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
