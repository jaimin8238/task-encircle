<?php
/** Standard WordPress fallback. @package CedarMillCo */
defined( 'ABSPATH' ) || exit;
get_header();
?>
<main id="content" class="wrap page-title">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<article><h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2><?php if ( is_singular() ) { the_content(); wp_link_pages(); } else { the_excerpt(); } ?></article>
	<?php endwhile; the_posts_pagination(); else : ?><p><?php esc_html_e( 'No content found.', 'cedarmillco' ); ?></p><?php endif; ?>
</main>
<?php get_footer(); ?>
