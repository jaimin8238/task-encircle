<?php

/** Static Instagram images, edited as repeater rows on this page. @package CedarMillCo */
defined('ABSPATH') || exit;
$row    = $args['row'] ?? array();
$images = $row['instagram_images'] ?? array();
if (empty($row['instagram_heading']) && empty($row['instagram_link']) && empty($row['instagram_caption']) && ! $images) {
	return;
}
?>
<section id="<?php echo esc_attr($args['section_id']); ?>" class="instagram wrap">
	<div class="section-heading"><?php cedarmillco_heading($row['instagram_heading'] ?? '');
									cedarmillco_link($row['instagram_link'] ?? null, 'text-link'); ?></div>
	<?php if ($images) : ?><div class="instagram-preview">
			<?php foreach (is_array($images) ? $images : array() as $image) : if (empty($image['instagram_image'])) {
					continue;
				}
				$link = $image['instagram_image_link'] ?? null; ?>
				<?php if (cedarmillco_has_link($link)) : ?><a href="<?php echo esc_url($link['url']); ?>" aria-label="<?php echo esc_attr($link['title']); ?>" <?php if ('_blank' === ($link['target'] ?? '')) : ?> target="_blank" rel="noopener noreferrer" <?php endif; ?>><?php cedarmillco_image($image['instagram_image']); ?></a><?php else : ?><div><?php cedarmillco_image($image['instagram_image']); ?></div><?php endif; ?>
			<?php endforeach; ?>
		</div><?php endif; ?>
	<?php cedarmillco_paragraph($row['instagram_caption'] ?? '', 'draft-note'); ?>
</section>