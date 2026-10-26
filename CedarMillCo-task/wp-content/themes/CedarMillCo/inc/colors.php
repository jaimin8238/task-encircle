<?php
/** Optional ACF colors. The supplied stylesheet stays unchanged. @package CedarMillCo */
defined( 'ABSPATH' ) || exit;

function cedarmillco_color_rule( $selector, $property, $value ) {
	$color = is_string( $value ) ? sanitize_hex_color( $value ) : '';
	return $color ? $selector . '{' . $property . ':' . $color . ';}' : '';
}

function cedarmillco_color_styles() {
	if ( ! function_exists( 'get_field' ) ) { return; }
	$css = '';
	$options = array(
		'cm_header_background_color' => array( '.site-header,.site-header nav', 'background-color' ),
		'cm_header_text_color' => array( '.site-header,#main-nav>.nav-item>a', 'color' ),
		'cm_header_dropdown_background_color' => array( '.site-header .dropdown', 'background-color' ),
		'cm_header_dropdown_text_color' => array( '.site-header .dropdown,.site-header .dropdown a', 'color' ),
		'cm_header_topbar_background_color' => array( '.roofline', 'background-color' ),
		'cm_header_topbar_text_color' => array( '.roofline', 'color' ),
		'cm_header_button_background_color' => array( '.site-header .button', 'background-color' ),
		'cm_header_button_text_color' => array( '.site-header .button', 'color' ),
		'cm_footer_background_color' => array( '.site-footer', 'background-color' ),
		'cm_footer_text_color' => array( '.site-footer,.site-footer h3', 'color' ),
		'cm_footer_muted_text_color' => array( '.site-footer p,.footer-bottom', 'color' ),
		'cm_footer_link_color' => array( '.site-footer a', 'color' ),
	);
	foreach ( $options as $name => $rule ) { $css .= cedarmillco_color_rule( $rule[0], $rule[1], cedarmillco_option( $name ) ); }
	$css .= cedarmillco_color_rule( '.site-header .menu-toggle span', 'background-color', cedarmillco_option( 'cm_header_text_color' ) );
	$page_id = get_queried_object_id();
	$rows = is_singular( 'page' ) ? get_field( 'cm_homepage_sections', $page_id ) : array();
	foreach ( is_array( $rows ) ? array_values( $rows ) : array() as $index => $row ) {
		if ( ! empty( $row['section_hidden'] ) ) { continue; }
		$design = is_array( $row['section_design'] ?? null ) ? $row['section_design'] : array();
		$id = '#cm-section-' . absint( $page_id ) . '-' . ( $index + 1 );
		$rules = array(
			'background_color' => array( $id, 'background-color' ),
			'heading_color' => array( $id . ' h1,' . $id . ' h2,' . $id . ' h3', 'color' ),
			'text_color' => array( $id . ',' . $id . ' p', 'color' ),
			'eyebrow_color' => array( $id . ' .eyebrow', 'color' ),
			'link_color' => array( $id . ' a:not(.button)', 'color' ),
			'button_background_color' => array( $id . ' .button', 'background-color' ),
			'button_text_color' => array( $id . ' .button', 'color' ),
			'input_background_color' => array( $id . ' input:not([type=hidden])', 'background-color' ),
			'input_text_color' => array( $id . ' input:not([type=hidden])', 'color' ),
			'border_color' => array( $id . ',' . $id . ' input,' . $id . ' .button,' . $id . ' .principles,' . $id . ' .principles>div', 'border-color' ),
		);
		foreach ( $rules as $name => $rule ) { $css .= cedarmillco_color_rule( $rule[0], $rule[1], $design[ $name ] ?? '' ); }
		$overlay = is_string( $design['overlay_color'] ?? null ) ? sanitize_hex_color( $design['overlay_color'] ) : '';
		if ( $overlay ) {
			$hex = ltrim( $overlay, '#' );
			if ( 3 === strlen( $hex ) ) { $hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2]; }
			$rgb = implode( ',', array( hexdec( substr( $hex, 0, 2 ) ), hexdec( substr( $hex, 2, 2 ) ), hexdec( substr( $hex, 4, 2 ) ) ) );
			$alpha = max( 0, min( 100, (float) ( $design['overlay_opacity'] ?? 65 ) ) ) / 100;
			$css .= $id . ' .hero-content:before,' . $id . '.featured>div:before{background:linear-gradient(90deg,rgba(' . $rgb . ',' . $alpha . '),rgba(' . $rgb . ',' . ( $alpha * 0.385 ) . ') 80%,transparent);}';
		}
	}
	if ( $css ) {
		// Selectors/properties are fixed above; all inserted values are validated hex or bounded numbers.
		echo '<style id="cedarmillco-acf-colors">' . $css . '</style>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}
add_action( 'wp_head', 'cedarmillco_color_styles', 30 );
