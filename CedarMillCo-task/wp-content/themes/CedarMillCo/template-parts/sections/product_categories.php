<?php

/** Product categories, including an inline ACF Repeater. @package CedarMillCo */
defined('ABSPATH') || exit;
$row   = $args['row'] ?? array();
$cards = $row['products_cards'] ?? array();
if (empty($row['products_eyebrow']) && empty($row['products_heading']) && empty($row['products_link']) && ! $cards) {
	return;
}
?>
<section id="<?php echo esc_attr($args['section_id']); ?>" class="collection wrap">
	<div class="section-heading">
		<div><?php cedarmillco_eyebrow($row['products_eyebrow'] ?? '');
				cedarmillco_heading($row['products_heading'] ?? ''); ?></div><?php cedarmillco_link($row['products_link'] ?? null, 'text-link'); ?>
	</div>
	<?php if ($cards) : ?><div class="category-grid">
			<?php foreach (is_array($cards) ? $cards : array() as $card) :
				$image = $card['card_image'] ?? null;
				$title = $card['card_heading'] ?? '';
				$caption = $card['card_caption'] ?? '';
				$link = $card['card_link'] ?? null;
				if (! $image && ! $title && ! $caption) {
					continue;
				}
				$linked = cedarmillco_has_link($link);
			?>
				<?php if ($linked) : ?><a class="category" href="<?php echo esc_url($link['url']); ?>" <?php if ('_blank' === ($link['target'] ?? '')) : ?> target="_blank" rel="noopener noreferrer" <?php endif; ?>><?php else : ?><div class="category"><?php endif; ?>
						<?php cedarmillco_image($image);
						cedarmillco_heading($title, 'h3');
						cedarmillco_paragraph($caption); ?>
						<?php if ($linked) : ?></a><?php else : ?></div><?php endif; ?>
<?php endforeach; ?>
</div><?php endif; ?>
</section>