<?php

/** Original footer structure, entirely from shared ACF options. @package CedarMillCo */
defined('ABSPATH') || exit;
$logo   = cedarmillco_image_id(cedarmillco_option('cm_footer_logo'));
$brand  = cedarmillco_text(cedarmillco_option('cm_brand_name'));
$offices = cedarmillco_option('cm_footer_offices');
$socials = cedarmillco_option('cm_footer_socials');
?>
<footer class="site-footer">
	<div class="footer-top">
		<div>
			<?php if ($logo || $brand) : ?><a class="footer-brand" href="<?php echo esc_url(home_url('/')); ?>"><?php if ($logo) {
																															cedarmillco_image($logo);
																														} else {
																															echo esc_html($brand);
																														} ?></a><?php endif; ?>
			<?php cedarmillco_paragraph(cedarmillco_option('cm_footer_tagline'), 'footer-tag'); ?>
			<?php cedarmillco_paragraph(cedarmillco_option('cm_footer_description')); ?>
			<?php cedarmillco_email(cedarmillco_option('cm_footer_email'));
			cedarmillco_phone(cedarmillco_option('cm_footer_phone')); ?>
			<?php if (is_array($socials) && $socials) : ?><div class="social-link"><?php foreach ($socials as $social) : $link = $social['social_link'] ?? null;
																							if (! cedarmillco_has_link($link)) {
																								continue;
																							} ?>
						<a href="<?php echo esc_url($link['url']); ?>" <?php if ('_blank' === ($link['target'] ?? '')) : ?> target="_blank" rel="noopener noreferrer" <?php endif; ?>><?php if ('instagram' === ($social['social_icon'] ?? '')) : ?><svg width="21" height="21" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
									<rect x="3" y="3" width="18" height="18" rx="5" />
									<circle cx="12" cy="12" r="4" />
									<circle cx="17.5" cy="6.5" r=".7" fill="currentColor" />
								</svg><?php endif; ?><?php echo esc_html($link['title']); ?></a>
					<?php endforeach; ?>
				</div><?php endif; ?>
		</div>
		<?php foreach (is_array($offices) ? $offices : array() as $office) : if (! array_filter($office)) {
				continue;
			} ?>
			<div><?php cedarmillco_heading($office['office_name'] ?? '', 'h3');
					cedarmillco_paragraph($office['office_address'] ?? '');
					cedarmillco_phone($office['office_phone'] ?? '');
					cedarmillco_email($office['office_email'] ?? '');
					cedarmillco_link($office['office_link'] ?? null, 'footer-visit'); ?></div>
		<?php endforeach; ?>
	</div>
	<?php $copyright = cedarmillco_text(cedarmillco_option('cm_footer_copyright'));
	if ($copyright) : ?><div class="footer-bottom"><span><?php echo esc_html(str_replace('{year}', wp_date('Y'), $copyright)); ?></span></div><?php endif; ?>
</footer>
<?php wp_footer(); ?>
</body>

</html>