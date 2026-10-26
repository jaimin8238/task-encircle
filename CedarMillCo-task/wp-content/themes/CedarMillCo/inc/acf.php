<?php
/** Real ACF Pro options and Flexible Content; no custom content types. @package CedarMillCo */
defined( 'ABSPATH' ) || exit;

function cedarmillco_json_paths( $paths ) {
	$theme_paths = array( untrailingslashit( get_template_directory() . '/acf-json' ), untrailingslashit( get_stylesheet_directory() . '/acf-json' ) );
	return array_values( array_filter( $paths, static function ( $path ) use ( $theme_paths ) { return ! in_array( untrailingslashit( $path ), $theme_paths, true ); } ) );
}
// Register only the two current groups, even when a user copies over a version 1 folder.
add_filter( 'acf/settings/load_json', 'cedarmillco_json_paths' );

function cedarmillco_register_acf() {
	if ( ! cedarmillco_has_acf_pro() ) { return; }
	acf_add_options_page( array(
		'page_title' => __( 'Cedar Mill Header & Footer', 'cedarmillco' ),
		'menu_title' => __( 'Header & Footer', 'cedarmillco' ),
		'menu_slug' => 'cedarmillco-options', 'capability' => 'manage_options',
		'redirect' => false, 'icon_url' => 'dashicons-admin-settings', 'position' => 59,
		'update_button' => __( 'Save Header & Footer', 'cedarmillco' ),
	) );
	if ( ! apply_filters( 'cedarmillco_load_bundled_fields', true ) ) { return; }
	foreach ( array( 'group_cm_homepage', 'group_cm_options' ) as $group_name ) {
		$file = get_template_directory() . '/acf-json/' . $group_name . '.json';
		if ( ! is_readable( $file ) ) { continue; }
		$group = json_decode( file_get_contents( $file ), true ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents
		if ( is_array( $group ) && isset( $group['fields'], $group['key'] ) ) { acf_add_local_field_group( $group ); }
	}
}
add_action( 'acf/init', 'cedarmillco_register_acf' );
