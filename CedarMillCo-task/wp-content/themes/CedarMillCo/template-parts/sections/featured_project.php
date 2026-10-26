<?php

/** Featured project. @package CedarMillCo */
defined('ABSPATH') || exit;
$row   = $args['row'] ?? array();
$image = cedarmillco_image_id($row['project_image'] ?? null);
if (! $image && empty($row['project_eyebrow']) && empty($row['project_heading']) && empty($row['project_body']) && empty($row['project_link'])) {
	return;
}
if (! $image) : ?>
	<section id="<?php echo esc_attr($args['section_id']); ?>" class="intro wrap">
		<div><?php cedarmillco_eyebrow($row['project_eyebrow'] ?? '');
				cedarmillco_heading($row['project_heading'] ?? ''); ?></div>
		<div><?php cedarmillco_paragraph($row['project_body'] ?? '');
				cedarmillco_link($row['project_link'] ?? null, 'button'); ?></div>
	</section>
<?php return;
endif; ?>
<section id="<?php echo esc_attr($args['section_id']); ?>" class="featured">
	<?php cedarmillco_image($image); ?>
	<div><?php cedarmillco_eyebrow($row['project_eyebrow'] ?? '');
			cedarmillco_heading($row['project_heading'] ?? '');
			cedarmillco_paragraph($row['project_body'] ?? '');
			cedarmillco_link($row['project_link'] ?? null, 'button outline'); ?></div>
</section>