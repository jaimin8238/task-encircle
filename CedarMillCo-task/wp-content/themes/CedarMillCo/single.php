<?php
/** Standard post view. @package CedarMillCo */
defined( 'ABSPATH' ) || exit;
get_header();
?>
<main id="content" class="wrap page-title"><?php while ( have_posts() ) : the_post(); ?><article><h1><?php the_title(); ?></h1><?php the_content(); wp_link_pages(); ?></article><?php the_post_navigation(); endwhile; ?></main>
<?php get_footer(); ?>
