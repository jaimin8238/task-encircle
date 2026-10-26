<?php
/** Source header with ACF options and the existing Primary menu. @package CedarMillCo */
defined( 'ABSPATH' ) || exit;
$logo  = cedarmillco_image_id( cedarmillco_option( 'cm_header_logo' ) );
$brand = cedarmillco_text( cedarmillco_option( 'cm_brand_name' ) );
$top   = cedarmillco_text( cedarmillco_option( 'cm_header_topbar' ) );
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link" href="#content"><?php esc_html_e( 'Skip to content', 'cedarmillco' ); ?></a>
<?php if ( $top ) : ?><div class="roofline"><span><?php echo esc_html( $top ); ?></span></div><?php endif; ?>
<header class="site-header">
	<?php if ( $logo || $brand ) : ?><a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>"<?php if ( $brand ) : ?> aria-label="<?php echo esc_attr( $brand ); ?>"<?php endif; ?>><?php if ( $logo ) { cedarmillco_image( $logo, true ); } else { echo esc_html( $brand ); } ?></a><?php endif; ?>
	<?php if ( has_nav_menu( 'primary' ) ) : ?>
		<button class="menu-toggle" aria-label="<?php esc_attr_e( 'Open navigation', 'cedarmillco' ); ?>" aria-expanded="false" aria-controls="main-nav" type="button"><span></span><span></span></button>
		<nav id="main-nav" aria-label="<?php esc_attr_e( 'Main navigation', 'cedarmillco' ); ?>"><?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => false, 'items_wrap' => '%3$s', 'fallback_cb' => false, 'depth' => 2, 'walker' => new CedarMillCo_Nav_Walker() ) ); ?></nav>
	<?php endif; ?>
	<?php $buttons = cedarmillco_option( 'cm_header_buttons' ); if ( is_array( $buttons ) && $buttons ) : ?><div class="actions"><?php foreach ( $buttons as $button ) { cedarmillco_link( $button['button_link'] ?? null, 'button' . ( 'outline' === ( $button['button_style'] ?? '' ) ? ' outline' : '' ) ); } ?></div><?php endif; ?>
</header>
