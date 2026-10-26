<?php
/** Convert the selected WordPress menu into the supplied nav-item/dropdown markup. @package CedarMillCo */
defined( 'ABSPATH' ) || exit;

class CedarMillCo_Nav_Walker extends Walker_Nav_Menu {
	public function start_lvl( &$output, $depth = 0, $args = null ) {
		$output .= '<div class="dropdown">';
	}
	public function end_lvl( &$output, $depth = 0, $args = null ) {
		$output .= '</div>';
	}
	public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
		if ( 0 === $depth ) { $output .= '<div class="nav-item">'; }
		$url = esc_url( $item->url );
		if ( ! $url ) { return; }
		$title = apply_filters( 'nav_menu_item_title', $item->title, $item, $args, $depth );
		$output .= '<a href="' . $url . '"';
		if ( $item->current ) { $output .= ' aria-current="page"'; }
		if ( $item->attr_title ) { $output .= ' title="' . esc_attr( $item->attr_title ) . '"'; }
		if ( '_blank' === $item->target ) { $output .= ' target="_blank" rel="noopener noreferrer"'; }
		$output .= '>' . esc_html( $title ) . '</a>';
	}
	public function end_el( &$output, $item, $depth = 0, $args = null ) {
		if ( 0 === $depth ) { $output .= '</div>'; }
	}
}
