<?php

/** Intro statement. @package CedarMillCo */
defined('ABSPATH') || exit;
$row = $args['row'] ?? array();
if (empty($row['intro_eyebrow']) && empty($row['intro_heading']) && empty($row['intro_body'])) {
	return;
}
?>
<section id="<?php echo esc_attr($args['section_id']); ?>" class="intro wrap">
	<div><?php cedarmillco_eyebrow($row['intro_eyebrow'] ?? '');
			cedarmillco_heading($row['intro_heading'] ?? ''); ?></div>
	<div><?php cedarmillco_paragraph($row['intro_body'] ?? ''); ?></div>
</section>