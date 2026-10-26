<?php
/**
 * Template Name: Cedar Mill Homepage
 * Template Post Type: page
 * @package CedarMillCo
 */
defined( 'ABSPATH' ) || exit;
get_header();
?>
<main id="content"><?php if ( have_posts() ) { the_post(); cedarmillco_render_sections( get_the_ID() ); } ?></main>
<?php get_footer(); ?>
