<?php
/** Standard pages may also use the ACF section editor. @package CedarMillCo */
defined( 'ABSPATH' ) || exit;
get_header();
?>
<main id="content">
	<?php while ( have_posts() ) : the_post(); ?>
		<?php if ( function_exists( 'get_field' ) && get_field( 'cm_homepage_sections' ) ) : cedarmillco_render_sections( get_the_ID() ); ?>
		<?php else : ?><article class="wrap page-title"><h1><?php the_title(); ?></h1><?php the_content(); wp_link_pages(); ?></article><?php endif; ?>
	<?php endwhile; ?>
</main>
<?php get_footer(); ?>
