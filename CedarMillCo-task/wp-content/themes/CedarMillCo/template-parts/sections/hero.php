<?php

/** Hero, retaining the supplied markup. @package CedarMillCo */
defined('ABSPATH') || exit;
$row     = $args['row'] ?? array();
$image   = cedarmillco_image_id($row['hero_image'] ?? null);
$heading = $row['hero_heading'] ?? '';
$eyebrow = $row['hero_eyebrow'] ?? '';
$body    = $row['hero_body'] ?? '';
$buttons = $row['hero_buttons'] ?? array();
if (! $image && ! $heading && ! $eyebrow && ! $body && ! $buttons) {
	return;
}
$tag = 'h2' === ($row['hero_heading_tag'] ?? '') ? 'h2' : 'h1';
// Reuse the source intro structure when no image is provided, keeping text readable.
if (! $image) : ?>
	<section id="<?php echo esc_attr($args['section_id']); ?>" class="intro wrap">
		<div><?php cedarmillco_eyebrow($eyebrow);
				cedarmillco_heading($heading, $tag); ?></div>
		<div><?php cedarmillco_paragraph($body); ?><div class="actions"><?php foreach (is_array($buttons) ? $buttons : array() as $button) {
																				cedarmillco_link($button['button_link'] ?? null, 'button' . ('outline' === ($button['button_style'] ?? '') ? ' outline' : ''));
																			} ?></div>
		</div>
	</section>
<?php return;
endif; ?>
<section id="<?php echo esc_attr($args['section_id']); ?>" class="hero home-hero">
	<?php cedarmillco_image($image, true); ?>
	<div class="hero-content">
		<?php cedarmillco_eyebrow($eyebrow);
		cedarmillco_heading($heading, $tag);
		cedarmillco_paragraph($body); ?>
		<?php if ($buttons) : ?><div class="actions"><?php foreach (is_array($buttons) ? $buttons : array() as $button) {
															cedarmillco_link($button['button_link'] ?? null, 'button' . ('outline' === ($button['button_style'] ?? '') ? ' outline' : ''));
														} ?></div><?php endif; ?>
	</div>
</section>