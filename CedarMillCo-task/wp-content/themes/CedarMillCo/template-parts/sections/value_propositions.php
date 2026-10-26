<?php

/** Every-detail copy and value-proposition repeater. @package CedarMillCo */
defined('ABSPATH') || exit;
$row   = $args['row'] ?? array();
$items = $row['values_items'] ?? array();
if (empty($row['values_eyebrow']) && empty($row['values_heading']) && empty($row['values_body']) && empty($row['values_link']) && ! $items) {
	return;
}
?>
<section id="<?php echo esc_attr($args['section_id']); ?>" class="perspective">
	<div class="wrap">
		<div class="perspective-copy"><?php cedarmillco_eyebrow($row['values_eyebrow'] ?? '');
										cedarmillco_heading($row['values_heading'] ?? '');
										cedarmillco_paragraph($row['values_body'] ?? '');
										cedarmillco_link($row['values_link'] ?? null, 'text-link'); ?></div>
		<?php if ($items) : ?><div class="principles"><?php foreach (is_array($items) ? $items : array() as $item) : if (empty($item['value_heading']) && empty($item['value_body'])) {
																continue;
															} ?><div><?php cedarmillco_heading($item['value_heading'] ?? '', 'h3');
																																																						cedarmillco_paragraph($item['value_body'] ?? ''); ?></div><?php endforeach; ?></div><?php endif; ?>
	</div>
</section>