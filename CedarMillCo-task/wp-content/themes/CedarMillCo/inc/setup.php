<?php
/** Core integrations. @package CedarMillCo */
defined( 'ABSPATH' ) || exit;

function cedarmillco_setup() {
	load_theme_textdomain( 'cedarmillco', get_template_directory() . '/languages' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
	register_nav_menus( array( 'primary' => __( 'Primary Menu', 'cedarmillco' ) ) );
}
add_action( 'after_setup_theme', 'cedarmillco_setup' );

function cedarmillco_assets() {
	// The supplied stylesheet is the only frontend stylesheet. No redesign/adaptation CSS.
	wp_enqueue_style( 'cedarmillco-design', get_theme_file_uri( '/assets/css/styles.css' ), array(), CEDARMILLCO_VERSION );
	wp_enqueue_script( 'cedarmillco-design', get_theme_file_uri( '/assets/js/app.js' ), array(), CEDARMILLCO_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'cedarmillco_assets' );

function cedarmillco_page_editor( $use_block_editor, $post_type ) {
	// ACF's page metaboxes provide the editor; normal posts keep their existing editor.
	return 'page' === $post_type ? false : $use_block_editor;
}
add_filter( 'use_block_editor_for_post_type', 'cedarmillco_page_editor', 10, 2 );

function cedarmillco_hide_home_content_editor() {
	$post_id = isset( $_GET['post'] ) && is_scalar( $_GET['post'] ) ? absint( $_GET['post'] ) : 0; // phpcs:ignore WordPress.Security.NonceVerification.Recommended
	if ( ! $post_id || 'page' !== get_post_type( $post_id ) ) { return; }
	if ( $post_id === (int) get_option( 'page_on_front' ) || 'page-home.php' === get_page_template_slug( $post_id ) || get_post_meta( $post_id, 'cm_homepage_sections', true ) ) {
		remove_post_type_support( 'page', 'editor' );
	}
}
add_action( 'admin_init', 'cedarmillco_hide_home_content_editor' );
