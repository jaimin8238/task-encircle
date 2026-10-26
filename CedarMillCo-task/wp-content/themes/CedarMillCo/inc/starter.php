<?php
/** Load values into the chosen existing page; never replace its menu or create content types. @package CedarMillCo */
defined( 'ABSPATH' ) || exit;

function cedarmillco_import_image( $asset ) {
	$key = 'image-' . sanitize_key( $asset['key'] );
	$found = get_posts( array( 'post_type' => 'attachment', 'post_status' => 'inherit', 'meta_key' => '_cm_starter_key', 'meta_value' => $key, 'numberposts' => 1, 'fields' => 'ids' ) );
	if ( $found && wp_attachment_is_image( $found[0] ) && is_readable( get_attached_file( $found[0] ) ) ) { return $found[0]; }
	$file = get_template_directory() . '/assets/images/' . sanitize_file_name( $asset['file'] );
	if ( ! is_readable( $file ) ) { throw new RuntimeException( __( 'A reference image is missing from the theme folder.', 'cedarmillco' ) ); }
	$temp = wp_tempnam( $asset['file'] );
	if ( ! $temp || ! copy( $file, $temp ) ) { throw new RuntimeException( __( 'Cannot copy reference images. Check the local uploads-folder permissions.', 'cedarmillco' ) ); }
	$id = media_handle_sideload( array( 'name' => sanitize_file_name( $asset['file'] ), 'tmp_name' => $temp ), 0, $asset['alt'] );
	if ( is_wp_error( $id ) ) {
		if ( file_exists( $temp ) ) { wp_delete_file( $temp ); }
		throw new RuntimeException( $id->get_error_message() );
	}
	update_post_meta( $id, '_cm_starter_key', $key );
	update_post_meta( $id, '_wp_attachment_image_alt', sanitize_text_field( $asset['alt'] ) );
	return $id;
}

function cedarmillco_resolve_reference( $value, $images ) {
	if ( is_array( $value ) ) {
		foreach ( $value as $key => $child ) { $value[ $key ] = cedarmillco_resolve_reference( $child, $images ); }
		return $value;
	}
	if ( ! is_string( $value ) ) { return $value; }
	if ( 0 === strpos( $value, '@image:' ) ) { return absint( $images[ substr( $value, 7 ) ] ?? 0 ); }
	if ( 0 === strpos( $value, '@url:' ) ) { return home_url( '/' . ltrim( substr( $value, 5 ), '/' ) ); }
	if ( 0 === strpos( $value, '@page:' ) ) {
		$slug = sanitize_title( substr( $value, 6 ) );
		$page = get_page_by_path( $slug );
		return $page && 'publish' === $page->post_status ? get_permalink( $page ) : home_url( '/' . $slug . '/' );
	}
	return $value;
}

function cedarmillco_fill_unset_options( $values ) {
	foreach ( $values as $name => $value ) {
		// Preserve existing values, including values the client deliberately cleared.
		if ( null === get_option( 'options_' . $name, null ) ) { update_field( 'field_' . $name, $value, 'option' ); }
	}
}

function cedarmillco_import_page( $page_id, $migrate = false ) {
	$page_id = absint( $page_id );
	if ( 'page' !== get_post_type( $page_id ) || ! cedarmillco_has_acf_pro() ) { throw new RuntimeException( __( 'Choose an existing page and activate ACF Pro first.', 'cedarmillco' ) ); }
	if ( get_field( 'cm_homepage_sections', $page_id ) ) { throw new RuntimeException( __( 'Existing page sections were not overwritten.', 'cedarmillco' ) ); }
	$data = json_decode( file_get_contents( get_template_directory() . '/inc/starter-content.json' ), true ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents
	if ( ! is_array( $data ) || empty( $data['sections'] ) ) { throw new RuntimeException( __( 'The reference content file is missing or invalid.', 'cedarmillco' ) ); }
	require_once ABSPATH . 'wp-admin/includes/file.php';
	require_once ABSPATH . 'wp-admin/includes/media.php';
	require_once ABSPATH . 'wp-admin/includes/image.php';
	$images = array();
	foreach ( $data['images'] as $asset ) { $images[ $asset['key'] ] = cedarmillco_import_image( $asset ); }
	$rows = cedarmillco_resolve_reference( $data['sections'], $images );
	if ( $migrate ) {
		$rows = cedarmillco_legacy_rows( $page_id, $rows );
		cedarmillco_migrate_options();
	}
	cedarmillco_fill_unset_options( cedarmillco_resolve_reference( $data['options'], $images ) );
	if ( ! update_field( 'field_cm_homepage_sections', $rows, $page_id ) ) { throw new RuntimeException( __( 'ACF could not save the sections. Check that ACF Pro is active and its Flexible Content field is available.', 'cedarmillco' ) ); }
	update_post_meta( $page_id, '_cm_pro_imported', 1 );
	// No changes to page_on_front, Primary menu assignments, other pages or old data.
	return true;
}

function cedarmillco_legacy_meta( $id, $name ) {
	return get_post_meta( absint( $id ), $name, true );
}

function cedarmillco_legacy_items( $ids, $kind ) {
	$result = array();
	foreach ( is_array( $ids ) ? $ids : array() as $id ) {
		$id = absint( $id );
		if ( 'cm_item' !== get_post_type( $id ) ) { continue; }
		$link = cedarmillco_legacy_meta( $id, 'cm_item_link' );
		switch ( $kind ) {
			case 'buttons':
				$result[] = array( 'button_link' => $link, 'button_style' => $result ? 'outline' : 'solid' );
				break;
			case 'cards':
				$result[] = array( 'card_image' => cedarmillco_legacy_meta( $id, 'cm_item_image' ), 'card_heading' => cedarmillco_legacy_meta( $id, 'cm_item_heading' ), 'card_caption' => cedarmillco_legacy_meta( $id, 'cm_item_description' ), 'card_link' => $link );
				break;
			case 'values':
				$result[] = array( 'value_heading' => cedarmillco_legacy_meta( $id, 'cm_item_heading' ), 'value_body' => cedarmillco_legacy_meta( $id, 'cm_item_description' ) );
				break;
			case 'instagram':
				$result[] = array( 'instagram_image' => cedarmillco_legacy_meta( $id, 'cm_item_image' ), 'instagram_image_link' => $link );
				break;
			case 'socials':
				$result[] = array( 'social_icon' => 'none', 'social_link' => $link );
				break;
			case 'offices':
				$result[] = array( 'office_name' => cedarmillco_legacy_meta( $id, 'cm_item_heading' ), 'office_address' => cedarmillco_legacy_meta( $id, 'cm_item_description' ), 'office_phone' => cedarmillco_legacy_meta( $id, 'cm_item_phone' ), 'office_email' => '', 'office_link' => $link );
				break;
		}
	}
	return $result;
}

function cedarmillco_legacy_rows( $target_page, $reference_rows ) {
	$ids = cedarmillco_legacy_meta( $target_page, 'cm_home_sections' );
	if ( ! is_array( $ids ) || ! $ids ) { $ids = cedarmillco_legacy_meta( get_option( 'cedarmillco_home_id' ), 'cm_home_sections' ); }
	if ( ! is_array( $ids ) || ! $ids ) { throw new RuntimeException( __( 'No version 1 sections were found. Use Load Reference Content instead.', 'cedarmillco' ) ); }
	$map = array( 'hero' => 'hero', 'intro' => 'intro_statement', 'products' => 'product_categories', 'values' => 'value_propositions', 'project' => 'featured_project', 'cta' => 'cta_band', 'newsletter' => 'newsletter', 'instagram' => 'instagram_grid' );
	$defaults = array_column( $reference_rows, null, 'acf_fc_layout' );
	$rows = array();
	foreach ( $ids as $id ) {
		$id = absint( $id );
		$old_layout = cedarmillco_legacy_meta( $id, 'cm_section_layout' );
		if ( 'cm_section' !== get_post_type( $id ) || ! isset( $map[ $old_layout ] ) ) { continue; }
		$row = $defaults[ $map[ $old_layout ] ];
		foreach ( $row as $name => $value ) {
			if ( metadata_exists( 'post', $id, 'cm_' . $name ) ) { $row[ $name ] = cedarmillco_legacy_meta( $id, 'cm_' . $name ); }
		}
		$row['section_hidden'] = (int) cedarmillco_legacy_meta( $id, 'cm_section_hidden' );
		if ( 'hero' === $old_layout ) {
			$row['hero_heading_tag'] = cedarmillco_legacy_meta( $id, 'cm_hero_primary_heading' ) ? 'h1' : 'h2';
			$row['hero_buttons'] = cedarmillco_legacy_items( cedarmillco_legacy_meta( $id, 'cm_hero_buttons' ), 'buttons' );
		}
		if ( 'products' === $old_layout ) { $row['products_cards'] = cedarmillco_legacy_items( cedarmillco_legacy_meta( $id, 'cm_products_cards' ), 'cards' ); }
		if ( 'values' === $old_layout ) { $row['values_items'] = cedarmillco_legacy_items( cedarmillco_legacy_meta( $id, 'cm_values_items' ), 'values' ); }
		if ( 'instagram' === $old_layout ) { $row['instagram_images'] = cedarmillco_legacy_items( cedarmillco_legacy_meta( $id, 'cm_instagram_images' ), 'instagram' ); }
		// Newsletter mode changes to an honest design preview; no legacy subscribers are deleted.
		$rows[] = $row;
	}
	if ( ! $rows ) { throw new RuntimeException( __( 'No compatible version 1 layouts were found.', 'cedarmillco' ) ); }
	return $rows;
}

function cedarmillco_migrate_options() {
	$id = absint( get_option( 'cedarmillco_settings_id' ) );
	if ( 'cm_settings' !== get_post_type( $id ) ) { return; }
	$names = array( 'cm_brand_name', 'cm_header_logo', 'cm_header_topbar', 'cm_footer_logo', 'cm_footer_tagline', 'cm_footer_description', 'cm_footer_email', 'cm_footer_phone', 'cm_footer_copyright' );
	$values = array();
	foreach ( $names as $name ) { if ( metadata_exists( 'post', $id, $name ) ) { $values[ $name ] = cedarmillco_legacy_meta( $id, $name ); } }
	$values['cm_header_buttons'] = cedarmillco_legacy_items( cedarmillco_legacy_meta( $id, 'cm_header_buttons' ), 'buttons' );
	$values['cm_footer_socials'] = cedarmillco_legacy_items( cedarmillco_legacy_meta( $id, 'cm_footer_socials' ), 'socials' );
	$values['cm_footer_offices'] = cedarmillco_legacy_items( cedarmillco_legacy_meta( $id, 'cm_footer_offices' ), 'offices' );
	cedarmillco_fill_unset_options( $values );
}
