<?php
/** Escape at output; preserve the source design's markup. @package CedarMillCo */
defined( 'ABSPATH' ) || exit;

function cedarmillco_has_acf_pro() {
	return function_exists( 'acf_add_options_page' ) && function_exists( 'acf_get_field_type' ) && (bool) acf_get_field_type( 'flexible_content' );
}

function cedarmillco_option( $name ) {
	return function_exists( 'get_field' ) ? get_field( $name, 'option' ) : null;
}

function cedarmillco_value( $array, $key ) {
	return is_array( $array ) && isset( $array[ $key ] ) ? $array[ $key ] : null;
}

function cedarmillco_text( $value ) {
	return is_scalar( $value ) ? (string) $value : '';
}

function cedarmillco_image_id( $image ) {
	$id = is_array( $image ) ? absint( $image['ID'] ?? 0 ) : absint( $image );
	return $id && wp_attachment_is_image( $id ) ? $id : 0;
}

function cedarmillco_image( $image, $eager = false ) {
	$id = cedarmillco_image_id( $image );
	if ( ! $id ) { return; }
	$attributes = array( 'loading' => $eager ? 'eager' : 'lazy', 'decoding' => 'async' );
	if ( $eager ) { $attributes['fetchpriority'] = 'high'; }
	// Core escapes image attributes and supplies responsive srcset/sizes.
	echo wp_get_attachment_image( $id, 'full', false, $attributes ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

function cedarmillco_has_link( $link ) {
	return is_array( $link ) && '' !== trim( cedarmillco_text( $link['title'] ?? '' ) ) && ! empty( $link['url'] ) && (bool) esc_url( $link['url'] );
}

function cedarmillco_link( $link, $class = '' ) {
	if ( ! cedarmillco_has_link( $link ) ) { return; }
	?>
	<a<?php if ( $class ) : ?> class="<?php echo esc_attr( $class ); ?>"<?php endif; ?> href="<?php echo esc_url( $link['url'] ); ?>"<?php if ( '_blank' === ( $link['target'] ?? '' ) ) : ?> target="_blank" rel="noopener noreferrer"<?php endif; ?>><?php echo esc_html( $link['title'] ); ?></a>
	<?php
}

function cedarmillco_eyebrow( $value ) {
	$value = cedarmillco_text( $value );
	if ( '' !== trim( $value ) ) { echo '<span class="eyebrow">' . esc_html( $value ) . '</span>'; }
}

function cedarmillco_heading( $value, $tag = 'h2' ) {
	$value = cedarmillco_text( $value );
	$tag = in_array( $tag, array( 'h1', 'h2', 'h3' ), true ) ? $tag : 'h2';
	if ( '' !== trim( $value ) ) { echo '<' . esc_attr( $tag ) . '>' . esc_html( $value ) . '</' . esc_attr( $tag ) . '>'; }
}

function cedarmillco_paragraph( $value, $class = '' ) {
	$value = cedarmillco_text( $value );
	if ( '' !== trim( $value ) ) {
		echo '<p' . ( $class ? ' class="' . esc_attr( $class ) . '"' : '' ) . '>' . nl2br( esc_html( $value ) ) . '</p>';
	}
}

function cedarmillco_phone( $value ) {
	$value = cedarmillco_text( $value );
	$dial = preg_replace( '/[^0-9+]/', '', $value );
	if ( $value && $dial ) { echo '<a href="' . esc_url( 'tel:' . $dial ) . '">' . esc_html( $value ) . '</a>'; }
}

function cedarmillco_email( $value ) {
	$email = sanitize_email( cedarmillco_text( $value ) );
	if ( $email ) { echo '<a href="' . esc_url( 'mailto:' . $email ) . '">' . esc_html( $email ) . '</a>'; }
}

function cedarmillco_render_sections( $page_id ) {
	$rows = function_exists( 'get_field' ) ? get_field( 'cm_homepage_sections', absint( $page_id ) ) : null;
	$templates = array( 'hero', 'intro_statement', 'product_categories', 'value_propositions', 'featured_project', 'cta_band', 'newsletter', 'instagram_grid' );
	foreach ( is_array( $rows ) ? array_values( $rows ) : array() as $index => $row ) {
		$layout = $row['acf_fc_layout'] ?? '';
		if ( ! in_array( $layout, $templates, true ) || ! empty( $row['section_hidden'] ) ) { continue; }
		// Whitelist layout names before selecting files. No changes to global post state.
		get_template_part( 'template-parts/sections/' . $layout, null, array( 'row' => $row, 'section_id' => 'cm-section-' . absint( $page_id ) . '-' . ( $index + 1 ) ) );
	}
}
