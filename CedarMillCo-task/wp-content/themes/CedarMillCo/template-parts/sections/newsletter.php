<?php

/** Source newsletter: honest preview or an explicitly configured provider form. @package CedarMillCo */
defined('ABSPATH') || exit;
$row     = $args['row'] ?? array();
$heading = $row['newsletter_heading'] ?? '';
$body    = $row['newsletter_body'] ?? '';
$label   = cedarmillco_text($row['newsletter_email_label'] ?? '');
$button  = cedarmillco_text($row['newsletter_button_label'] ?? '');
$preview = 'external' !== ($row['newsletter_mode'] ?? 'preview');
$action  = esc_url(cedarmillco_text($row['newsletter_form_action'] ?? ''), array('http', 'https'));
$show_form = $label && $button && ($preview || $action);
if (! $heading && ! $body && ! $show_form) {
	return;
}
$uid = wp_unique_id('newsletter-email-');
$email_name = cedarmillco_text($row['newsletter_email_name'] ?? 'email');
if (! preg_match('/^[A-Za-z0-9_\[\]-]+$/D', $email_name)) {
	$email_name = 'email';
}
?>
<section id="<?php echo esc_attr($args['section_id']); ?>" class="newsletter wrap">
	<div><?php cedarmillco_heading($heading);
			cedarmillco_paragraph($body); ?></div>
	<?php if ($show_form) : ?>
		<form class="newsletter-form" <?php if ($preview) : ?> data-demo="newsletter" data-preview-message="<?php echo esc_attr(cedarmillco_text($row['newsletter_preview_message'] ?? '')); ?>" <?php else : ?> action="<?php echo esc_url($action, array('http', 'https')); ?>" method="post" <?php endif; ?>>
			<label class="visually-hidden" for="<?php echo esc_attr($uid); ?>"><?php echo esc_html($label); ?></label>
			<input id="<?php echo esc_attr($uid); ?>" name="<?php echo esc_attr($email_name); ?>" type="email" placeholder="<?php echo esc_attr($label); ?>" autocomplete="email" required>
			<?php if (! $preview) : foreach (is_array($row['newsletter_hidden_fields'] ?? null) ? $row['newsletter_hidden_fields'] : array() as $hidden) : $name = cedarmillco_text($hidden['hidden_name'] ?? '');
					if (! preg_match('/^[A-Za-z0-9_\[\]-]+$/D', $name)) {
						continue;
					} ?>
					<input type="hidden" name="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr(cedarmillco_text($hidden['hidden_value'] ?? '')); ?>">
			<?php endforeach;
			endif; ?>
			<button class="button" type="submit"><?php echo esc_html($button); ?></button>
			<p class="form-status" aria-live="polite"></p>
		</form>
	<?php endif; ?>
</section>