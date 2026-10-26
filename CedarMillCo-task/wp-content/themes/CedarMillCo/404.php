<?php

/** Missing-page fallback. @package CedarMillCo */
defined('ABSPATH') || exit;
get_header();
?>
<main id="content" class="wrap page-title">
    <h1><?php esc_html_e('Page not found', 'cedarmillco'); ?></h1><a class="text-link" href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Return home', 'cedarmillco'); ?></a>
</main>
<?php get_footer(); ?>