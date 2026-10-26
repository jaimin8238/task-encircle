<?php
/** Help appears on the page edit screen, not in separate content menus. @package CedarMillCo */
defined( 'ABSPATH' ) || exit;

function cedarmillco_admin_notices() {
	if ( ! current_user_can( 'edit_pages' ) ) { return; }
	if ( ! cedarmillco_has_acf_pro() ) {
		echo '<div class="notice notice-error"><p>' . esc_html__( 'CedarMillCo 2.0 requires ACF Pro. Activate your licensed ACF Pro plugin to display the page Flexible Content fields and Header & Footer options. The free ACF plugin does not include these features.', 'cedarmillco' ) . '</p></div>';
		return;
	}
	$screen = get_current_screen();
	if ( ! $screen || 'page' !== $screen->post_type || 'post' !== $screen->base ) { return; }
	$id = isset( $_GET['post'] ) && is_scalar( $_GET['post'] ) ? absint( $_GET['post'] ) : 0; // phpcs:ignore WordPress.Security.NonceVerification.Recommended
	if ( ! $id || ! current_user_can( 'edit_post', $id ) ) { return; }
	if ( isset( $_GET['cm_imported'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
		echo '<div class="notice notice-success is-dismissible"><p>' . esc_html__( 'Cedar Mill content was loaded into this page. Your existing Primary menu and Reading settings were preserved. Edit the sections below and click Update.', 'cedarmillco' ) . '</p></div>';
	}
	$error = get_transient( 'cedarmillco_import_error_' . get_current_user_id() );
	if ( $error ) {
		echo '<div class="notice notice-error"><p>' . esc_html( $error ) . '</p></div>';
		delete_transient( 'cedarmillco_import_error_' . get_current_user_id() );
	}
	if ( get_field( 'cm_homepage_sections', $id ) ) { return; }
	if ( ! current_user_can( 'manage_options' ) ) { return; }
	$url = wp_nonce_url( admin_url( 'admin-post.php?action=cedarmillco_page_import&post=' . $id . '&mode=reference' ), 'cedarmillco_page_import_' . $id );
	echo '<div class="notice notice-info"><p>' . esc_html__( 'All eight ACF layouts are edited in Homepage Sections below. Start with empty sections, or load the supplied reference content into this empty page.', 'cedarmillco' ) . '</p><p><a class="button button-primary" href="' . esc_url( $url ) . '">' . esc_html__( 'Load Reference Content Into This Page', 'cedarmillco' ) . '</a>';
	if ( get_option( 'cedarmillco_home_id' ) ) {
		$migrate = wp_nonce_url( admin_url( 'admin-post.php?action=cedarmillco_page_import&post=' . $id . '&mode=migrate' ), 'cedarmillco_page_import_' . $id );
		echo ' <a class="button" href="' . esc_url( $migrate ) . '">' . esc_html__( 'Migrate Version 1 Content Into This Page', 'cedarmillco' ) . '</a>';
	}
	echo '</p></div>';
}
add_action( 'admin_notices', 'cedarmillco_admin_notices' );

function cedarmillco_page_import() {
	$id = isset( $_GET['post'] ) && is_scalar( $_GET['post'] ) ? absint( $_GET['post'] ) : 0;
	check_admin_referer( 'cedarmillco_page_import_' . $id );
	if ( 'page' !== get_post_type( $id ) || ! current_user_can( 'edit_post', $id ) || ! current_user_can( 'manage_options' ) ) {
		wp_die( esc_html__( 'Administrator access to this page is required for the reference importer.', 'cedarmillco' ) );
	}
	if ( ! cedarmillco_has_acf_pro() ) { wp_die( esc_html__( 'Activate ACF Pro first.', 'cedarmillco' ) ); }
	if ( get_field( 'cm_homepage_sections', $id ) ) { wp_die( esc_html__( 'This page already has sections. They were not overwritten.', 'cedarmillco' ) ); }
	$lock = 'cedarmillco_page_import_lock_' . $id;
	if ( ! add_option( $lock, time(), '', false ) ) {
		if ( (int) get_option( $lock ) > time() - 300 ) { wp_die( esc_html__( 'This import is already running. Wait a moment and refresh.', 'cedarmillco' ) ); }
		delete_option( $lock );
		if ( ! add_option( $lock, time(), '', false ) ) { wp_die( esc_html__( 'Import is already running.', 'cedarmillco' ) ); }
	}
	$success = false;
	try {
		$mode = isset( $_GET['mode'] ) && is_string( $_GET['mode'] ) ? sanitize_key( wp_unslash( $_GET['mode'] ) ) : '';
		cedarmillco_import_page( $id, 'migrate' === $mode );
		$success = true;
	} catch ( Throwable $error ) {
		set_transient( 'cedarmillco_import_error_' . get_current_user_id(), sanitize_text_field( $error->getMessage() ), MINUTE_IN_SECONDS );
	}
	delete_option( $lock );
	$url = get_edit_post_link( $id, 'raw' );
	wp_safe_redirect( $success ? add_query_arg( 'cm_imported', 1, $url ) : $url );
	exit;
}
add_action( 'admin_post_cedarmillco_page_import', 'cedarmillco_page_import' );
