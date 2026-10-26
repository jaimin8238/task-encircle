<?php

/** CTA band. @package CedarMillCo */
defined('ABSPATH') || exit;
$row = $args['row'] ?? array();
if (empty($row['cta_eyebrow']) && empty($row['cta_heading']) && empty($row['cta_body']) && empty($row['cta_link'])) {
    return;
}
?>
<section id="<?php echo esc_attr($args['section_id']); ?>" class="cta wrap">
    <div><?php cedarmillco_eyebrow($row['cta_eyebrow'] ?? '');
            cedarmillco_heading($row['cta_heading'] ?? '');
            cedarmillco_paragraph($row['cta_body'] ?? ''); ?></div><?php cedarmillco_link($row['cta_link'] ?? null, 'button'); ?>
</section>