<?php
/** Homepage sections live on the page itself. @package CedarMillCo */
defined( 'ABSPATH' ) || exit;
get_header();
?>
<main id="content">
	<?php if ( have_posts() ) { the_post(); cedarmillco_render_sections( get_the_ID() ); } ?>
</main>
<?php get_footer(); ?>
