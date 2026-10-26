<?php
/** Theme entry point. @package CedarMillCo */
defined( 'ABSPATH' ) || exit;

define( 'CEDARMILLCO_VERSION', '2.0.0' );

foreach ( array( 'setup', 'helpers', 'navigation', 'acf', 'colors', 'admin', 'starter' ) as $cm_module ) {
	require_once get_template_directory() . '/inc/' . $cm_module . '.php';
}
