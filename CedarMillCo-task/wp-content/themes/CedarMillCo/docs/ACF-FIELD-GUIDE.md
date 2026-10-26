# CedarMillCo — Complete ACF Pro Field Guide

The theme registers these two field groups automatically. **You do not need to create the fields manually or import JSON.** Install and activate your own licensed ACF Pro, activate CedarMillCo, then edit Pages → Home. Use the Header & Footer menu for shared options.

**Group 1 — Cedar Mill — Homepage Sections**
- Location rule: Post Type is equal to Page.
- Position: Normal (inside the page edit screen).
- Main field: Flexible Content; label **Homepage Sections**; name **cm_homepage_sections**; key **field_cm_homepage_sections**.
- Eight layouts, no minimum/maximum row limit. Repeaters inside layouts contain their own subfields.

**Group 2 — Cedar Mill — Header & Footer Options**
- Location rule: Options Page is equal to **cedarmillco-options**.
- One shared ACF Options page named **Header & Footer**.
- Brand, Header and Footer tabs. The selected WordPress Primary menu is independent of ACF.

**Defaults and reference content are different.** Defaults below are the actual ACF settings. Most are blank so empty fields render gracefully. “Load Reference Content” imports the supplied homepage text and original images into ACF values on your chosen page and fills only previously unset options. No site-specific attachment IDs are hardcoded. Do not enter an image URL as an Image ID.

**If asked to build fields manually:** use the exact field names and hierarchy below. Every section belongs inside the main Flexible Content field, and card/button/office/image subfields belong inside their respective Repeaters. Do not create eight unrelated page field groups. For easier manual registration, use docs/ACF-IMPORT.json after disabling bundled field registration as explained in README.md; do not import a second copy while automatic registration is enabled.



## Cedar Mill — Homepage Sections

| Field Type | Field Label | Field Name | Default Value |
|---|---|---|---|
| Flexible Content | Homepage Sections | `cm_homepage_sections` | No rows (empty) |

## Cedar Mill — Homepage Sections → 01 · Hero (`hero`)

| Field Type | Field Label | Field Name | Default Value |
|---|---|---|---|
| True False | Hide This Section | `section_hidden` | 0 — visible / not hidden |
| Text | Hero — Eyebrow | `hero_eyebrow` | Empty string (blank) |
| Text | Hero — Heading | `hero_heading` | Empty string (blank) |
| Select | Hero — Heading Level | `hero_heading_tag` | h1 |
| Textarea | Hero — Supporting Text | `hero_body` | Empty string (blank) |
| Image | Hero — Background Image | `hero_image` | No image (empty); return format: Image ID |
| Repeater | Hero — Buttons | `hero_buttons` | No rows (empty) |

## Cedar Mill — Homepage Sections → 01 · Hero (`hero`) → Hero — Buttons (row)

| Field Type | Field Label | Field Name | Default Value |
|---|---|---|---|
| Link | Button — Link | `button_link` | No link (empty); return format: Link Array |
| Select | Button — Style | `button_style` | solid |

## Cedar Mill — Homepage Sections → 01 · Hero (`hero`)

| Field Type | Field Label | Field Name | Default Value |
|---|---|---|---|
| Group | Section — Optional Colors | `section_design` | No independent default — use the subfield defaults below |

## Cedar Mill — Homepage Sections → 01 · Hero (`hero`) → Section — Optional Colors (group)

| Field Type | Field Label | Field Name | Default Value |
|---|---|---|---|
| Color Picker | Section — Background Color | `background_color` | Empty string (blank) |
| Color Picker | Section — Heading Color | `heading_color` | Empty string (blank) |
| Color Picker | Section — Text Color | `text_color` | Empty string (blank) |
| Color Picker | Section — Eyebrow Color | `eyebrow_color` | Empty string (blank) |
| Color Picker | Section — Link Color | `link_color` | Empty string (blank) |
| Color Picker | Buttons — Background Color | `button_background_color` | Empty string (blank) |
| Color Picker | Buttons — Text Color | `button_text_color` | Empty string (blank) |
| Color Picker | Inputs — Background Color | `input_background_color` | Empty string (blank) |
| Color Picker | Inputs — Text Color | `input_text_color` | Empty string (blank) |
| Color Picker | Section — Border Color | `border_color` | Empty string (blank) |
| Color Picker | Hero / Project — Overlay Color | `overlay_color` | Empty string (blank) |
| Range | Hero / Project — Overlay Opacity | `overlay_opacity` | 65 |

## Cedar Mill — Homepage Sections → 02 · Intro Statement (`intro_statement`)

| Field Type | Field Label | Field Name | Default Value |
|---|---|---|---|
| True False | Hide This Section | `section_hidden` | 0 — visible / not hidden |
| Text | Intro — Eyebrow | `intro_eyebrow` | Empty string (blank) |
| Text | Intro — Heading | `intro_heading` | Empty string (blank) |
| Textarea | Intro — Description | `intro_body` | Empty string (blank) |
| Group | Section — Optional Colors | `section_design` | No independent default — use the subfield defaults below |

## Cedar Mill — Homepage Sections → 02 · Intro Statement (`intro_statement`) → Section — Optional Colors (group)

| Field Type | Field Label | Field Name | Default Value |
|---|---|---|---|
| Color Picker | Section — Background Color | `background_color` | Empty string (blank) |
| Color Picker | Section — Heading Color | `heading_color` | Empty string (blank) |
| Color Picker | Section — Text Color | `text_color` | Empty string (blank) |
| Color Picker | Section — Eyebrow Color | `eyebrow_color` | Empty string (blank) |
| Color Picker | Section — Link Color | `link_color` | Empty string (blank) |
| Color Picker | Buttons — Background Color | `button_background_color` | Empty string (blank) |
| Color Picker | Buttons — Text Color | `button_text_color` | Empty string (blank) |
| Color Picker | Inputs — Background Color | `input_background_color` | Empty string (blank) |
| Color Picker | Inputs — Text Color | `input_text_color` | Empty string (blank) |
| Color Picker | Section — Border Color | `border_color` | Empty string (blank) |
| Color Picker | Hero / Project — Overlay Color | `overlay_color` | Empty string (blank) |
| Range | Hero / Project — Overlay Opacity | `overlay_opacity` | 65 |

## Cedar Mill — Homepage Sections → 03 · Product Categories (`product_categories`)

| Field Type | Field Label | Field Name | Default Value |
|---|---|---|---|
| True False | Hide This Section | `section_hidden` | 0 — visible / not hidden |
| Text | Products — Eyebrow | `products_eyebrow` | Empty string (blank) |
| Text | Products — Heading | `products_heading` | Empty string (blank) |
| Link | Products — View All Link | `products_link` | No link (empty); return format: Link Array |
| Repeater | Products — Cards | `products_cards` | No rows (empty) |

## Cedar Mill — Homepage Sections → 03 · Product Categories (`product_categories`) → Products — Cards (row)

| Field Type | Field Label | Field Name | Default Value |
|---|---|---|---|
| Image | Card — Image | `card_image` | No image (empty); return format: Image ID |
| Text | Card — Heading | `card_heading` | Empty string (blank) |
| Text | Card — Caption | `card_caption` | Empty string (blank) |
| Link | Card — Link | `card_link` | No link (empty); return format: Link Array |

## Cedar Mill — Homepage Sections → 03 · Product Categories (`product_categories`)

| Field Type | Field Label | Field Name | Default Value |
|---|---|---|---|
| Group | Section — Optional Colors | `section_design` | No independent default — use the subfield defaults below |

## Cedar Mill — Homepage Sections → 03 · Product Categories (`product_categories`) → Section — Optional Colors (group)

| Field Type | Field Label | Field Name | Default Value |
|---|---|---|---|
| Color Picker | Section — Background Color | `background_color` | Empty string (blank) |
| Color Picker | Section — Heading Color | `heading_color` | Empty string (blank) |
| Color Picker | Section — Text Color | `text_color` | Empty string (blank) |
| Color Picker | Section — Eyebrow Color | `eyebrow_color` | Empty string (blank) |
| Color Picker | Section — Link Color | `link_color` | Empty string (blank) |
| Color Picker | Buttons — Background Color | `button_background_color` | Empty string (blank) |
| Color Picker | Buttons — Text Color | `button_text_color` | Empty string (blank) |
| Color Picker | Inputs — Background Color | `input_background_color` | Empty string (blank) |
| Color Picker | Inputs — Text Color | `input_text_color` | Empty string (blank) |
| Color Picker | Section — Border Color | `border_color` | Empty string (blank) |
| Color Picker | Hero / Project — Overlay Color | `overlay_color` | Empty string (blank) |
| Range | Hero / Project — Overlay Opacity | `overlay_opacity` | 65 |

## Cedar Mill — Homepage Sections → 04 · Every Detail / Value Propositions (`value_propositions`)

| Field Type | Field Label | Field Name | Default Value |
|---|---|---|---|
| True False | Hide This Section | `section_hidden` | 0 — visible / not hidden |
| Text | Values — Eyebrow | `values_eyebrow` | Empty string (blank) |
| Text | Values — Heading | `values_heading` | Empty string (blank) |
| Textarea | Values — Description | `values_body` | Empty string (blank) |
| Link | Values — Link | `values_link` | No link (empty); return format: Link Array |
| Repeater | Values — Items | `values_items` | No rows (empty) |

## Cedar Mill — Homepage Sections → 04 · Every Detail / Value Propositions (`value_propositions`) → Values — Items (row)

| Field Type | Field Label | Field Name | Default Value |
|---|---|---|---|
| Text | Value — Heading | `value_heading` | Empty string (blank) |
| Textarea | Value — Description | `value_body` | Empty string (blank) |

## Cedar Mill — Homepage Sections → 04 · Every Detail / Value Propositions (`value_propositions`)

| Field Type | Field Label | Field Name | Default Value |
|---|---|---|---|
| Group | Section — Optional Colors | `section_design` | No independent default — use the subfield defaults below |

## Cedar Mill — Homepage Sections → 04 · Every Detail / Value Propositions (`value_propositions`) → Section — Optional Colors (group)

| Field Type | Field Label | Field Name | Default Value |
|---|---|---|---|
| Color Picker | Section — Background Color | `background_color` | Empty string (blank) |
| Color Picker | Section — Heading Color | `heading_color` | Empty string (blank) |
| Color Picker | Section — Text Color | `text_color` | Empty string (blank) |
| Color Picker | Section — Eyebrow Color | `eyebrow_color` | Empty string (blank) |
| Color Picker | Section — Link Color | `link_color` | Empty string (blank) |
| Color Picker | Buttons — Background Color | `button_background_color` | Empty string (blank) |
| Color Picker | Buttons — Text Color | `button_text_color` | Empty string (blank) |
| Color Picker | Inputs — Background Color | `input_background_color` | Empty string (blank) |
| Color Picker | Inputs — Text Color | `input_text_color` | Empty string (blank) |
| Color Picker | Section — Border Color | `border_color` | Empty string (blank) |
| Color Picker | Hero / Project — Overlay Color | `overlay_color` | Empty string (blank) |
| Range | Hero / Project — Overlay Opacity | `overlay_opacity` | 65 |

## Cedar Mill — Homepage Sections → 05 · Featured Project (`featured_project`)

| Field Type | Field Label | Field Name | Default Value |
|---|---|---|---|
| True False | Hide This Section | `section_hidden` | 0 — visible / not hidden |
| Text | Project — Eyebrow | `project_eyebrow` | Empty string (blank) |
| Text | Project — Heading | `project_heading` | Empty string (blank) |
| Textarea | Project — Description | `project_body` | Empty string (blank) |
| Image | Project — Background Image | `project_image` | No image (empty); return format: Image ID |
| Link | Project — Button | `project_link` | No link (empty); return format: Link Array |
| Group | Section — Optional Colors | `section_design` | No independent default — use the subfield defaults below |

## Cedar Mill — Homepage Sections → 05 · Featured Project (`featured_project`) → Section — Optional Colors (group)

| Field Type | Field Label | Field Name | Default Value |
|---|---|---|---|
| Color Picker | Section — Background Color | `background_color` | Empty string (blank) |
| Color Picker | Section — Heading Color | `heading_color` | Empty string (blank) |
| Color Picker | Section — Text Color | `text_color` | Empty string (blank) |
| Color Picker | Section — Eyebrow Color | `eyebrow_color` | Empty string (blank) |
| Color Picker | Section — Link Color | `link_color` | Empty string (blank) |
| Color Picker | Buttons — Background Color | `button_background_color` | Empty string (blank) |
| Color Picker | Buttons — Text Color | `button_text_color` | Empty string (blank) |
| Color Picker | Inputs — Background Color | `input_background_color` | Empty string (blank) |
| Color Picker | Inputs — Text Color | `input_text_color` | Empty string (blank) |
| Color Picker | Section — Border Color | `border_color` | Empty string (blank) |
| Color Picker | Hero / Project — Overlay Color | `overlay_color` | Empty string (blank) |
| Range | Hero / Project — Overlay Opacity | `overlay_opacity` | 65 |

## Cedar Mill — Homepage Sections → 06 · CTA Band (`cta_band`)

| Field Type | Field Label | Field Name | Default Value |
|---|---|---|---|
| True False | Hide This Section | `section_hidden` | 0 — visible / not hidden |
| Text | CTA — Eyebrow | `cta_eyebrow` | Empty string (blank) |
| Text | CTA — Heading | `cta_heading` | Empty string (blank) |
| Textarea | CTA — Description | `cta_body` | Empty string (blank) |
| Link | CTA — Button | `cta_link` | No link (empty); return format: Link Array |
| Group | Section — Optional Colors | `section_design` | No independent default — use the subfield defaults below |

## Cedar Mill — Homepage Sections → 06 · CTA Band (`cta_band`) → Section — Optional Colors (group)

| Field Type | Field Label | Field Name | Default Value |
|---|---|---|---|
| Color Picker | Section — Background Color | `background_color` | Empty string (blank) |
| Color Picker | Section — Heading Color | `heading_color` | Empty string (blank) |
| Color Picker | Section — Text Color | `text_color` | Empty string (blank) |
| Color Picker | Section — Eyebrow Color | `eyebrow_color` | Empty string (blank) |
| Color Picker | Section — Link Color | `link_color` | Empty string (blank) |
| Color Picker | Buttons — Background Color | `button_background_color` | Empty string (blank) |
| Color Picker | Buttons — Text Color | `button_text_color` | Empty string (blank) |
| Color Picker | Inputs — Background Color | `input_background_color` | Empty string (blank) |
| Color Picker | Inputs — Text Color | `input_text_color` | Empty string (blank) |
| Color Picker | Section — Border Color | `border_color` | Empty string (blank) |
| Color Picker | Hero / Project — Overlay Color | `overlay_color` | Empty string (blank) |
| Range | Hero / Project — Overlay Opacity | `overlay_opacity` | 65 |

## Cedar Mill — Homepage Sections → 07 · Newsletter (`newsletter`)

| Field Type | Field Label | Field Name | Default Value |
|---|---|---|---|
| True False | Hide This Section | `section_hidden` | 0 — visible / not hidden |
| Text | Newsletter — Heading | `newsletter_heading` | Empty string (blank) |
| Textarea | Newsletter — Description | `newsletter_body` | Empty string (blank) |
| Text | Newsletter — Email Label / Placeholder | `newsletter_email_label` | Email address |
| Text | Newsletter — Button Label | `newsletter_button_label` | Sign up |
| Select | Newsletter — Form Mode | `newsletter_mode` | preview |
| Text | Newsletter — Preview Message | `newsletter_preview_message` | Design preview only — your email has not been submitted. |
| Url | Newsletter — Provider Form Action URL | `newsletter_form_action` | Empty string (blank) |
| Text | Newsletter — Provider Email Field Name | `newsletter_email_name` | email |
| Repeater | Newsletter — Provider Hidden Fields | `newsletter_hidden_fields` | No rows (empty) |

## Cedar Mill — Homepage Sections → 07 · Newsletter (`newsletter`) → Newsletter — Provider Hidden Fields (row)

| Field Type | Field Label | Field Name | Default Value |
|---|---|---|---|
| Text | Hidden Field — Name | `hidden_name` | Empty string (blank) |
| Text | Hidden Field — Value | `hidden_value` | Empty string (blank) |

## Cedar Mill — Homepage Sections → 07 · Newsletter (`newsletter`)

| Field Type | Field Label | Field Name | Default Value |
|---|---|---|---|
| Group | Section — Optional Colors | `section_design` | No independent default — use the subfield defaults below |

## Cedar Mill — Homepage Sections → 07 · Newsletter (`newsletter`) → Section — Optional Colors (group)

| Field Type | Field Label | Field Name | Default Value |
|---|---|---|---|
| Color Picker | Section — Background Color | `background_color` | Empty string (blank) |
| Color Picker | Section — Heading Color | `heading_color` | Empty string (blank) |
| Color Picker | Section — Text Color | `text_color` | Empty string (blank) |
| Color Picker | Section — Eyebrow Color | `eyebrow_color` | Empty string (blank) |
| Color Picker | Section — Link Color | `link_color` | Empty string (blank) |
| Color Picker | Buttons — Background Color | `button_background_color` | Empty string (blank) |
| Color Picker | Buttons — Text Color | `button_text_color` | Empty string (blank) |
| Color Picker | Inputs — Background Color | `input_background_color` | Empty string (blank) |
| Color Picker | Inputs — Text Color | `input_text_color` | Empty string (blank) |
| Color Picker | Section — Border Color | `border_color` | Empty string (blank) |
| Color Picker | Hero / Project — Overlay Color | `overlay_color` | Empty string (blank) |
| Range | Hero / Project — Overlay Opacity | `overlay_opacity` | 65 |

## Cedar Mill — Homepage Sections → 08 · Instagram Grid (`instagram_grid`)

| Field Type | Field Label | Field Name | Default Value |
|---|---|---|---|
| True False | Hide This Section | `section_hidden` | 0 — visible / not hidden |
| Text | Instagram — Heading | `instagram_heading` | Empty string (blank) |
| Link | Instagram — Profile Link | `instagram_link` | No link (empty); return format: Link Array |
| Repeater | Instagram — Static Images | `instagram_images` | No rows (empty) |

## Cedar Mill — Homepage Sections → 08 · Instagram Grid (`instagram_grid`) → Instagram — Static Images (row)

| Field Type | Field Label | Field Name | Default Value |
|---|---|---|---|
| Image | Instagram — Image | `instagram_image` | No image (empty); return format: Image ID |
| Link | Instagram — Image Link | `instagram_image_link` | No link (empty); return format: Link Array |

## Cedar Mill — Homepage Sections → 08 · Instagram Grid (`instagram_grid`)

| Field Type | Field Label | Field Name | Default Value |
|---|---|---|---|
| Text | Instagram — Caption | `instagram_caption` | Empty string (blank) |
| Group | Section — Optional Colors | `section_design` | No independent default — use the subfield defaults below |

## Cedar Mill — Homepage Sections → 08 · Instagram Grid (`instagram_grid`) → Section — Optional Colors (group)

| Field Type | Field Label | Field Name | Default Value |
|---|---|---|---|
| Color Picker | Section — Background Color | `background_color` | Empty string (blank) |
| Color Picker | Section — Heading Color | `heading_color` | Empty string (blank) |
| Color Picker | Section — Text Color | `text_color` | Empty string (blank) |
| Color Picker | Section — Eyebrow Color | `eyebrow_color` | Empty string (blank) |
| Color Picker | Section — Link Color | `link_color` | Empty string (blank) |
| Color Picker | Buttons — Background Color | `button_background_color` | Empty string (blank) |
| Color Picker | Buttons — Text Color | `button_text_color` | Empty string (blank) |
| Color Picker | Inputs — Background Color | `input_background_color` | Empty string (blank) |
| Color Picker | Inputs — Text Color | `input_text_color` | Empty string (blank) |
| Color Picker | Section — Border Color | `border_color` | Empty string (blank) |
| Color Picker | Hero / Project — Overlay Color | `overlay_color` | Empty string (blank) |
| Range | Hero / Project — Overlay Opacity | `overlay_opacity` | 65 |

## Cedar Mill — Header & Footer Options

| Field Type | Field Label | Field Name | Default Value |
|---|---|---|---|
| Tab | Brand | `brand_tab` | Not applicable — editor tab only |
| Text | Company Name | `cm_brand_name` | Empty string (blank) |
| Tab | Header | `header_tab` | Not applicable — editor tab only |
| Image | Header — Logo | `cm_header_logo` | No image (empty); return format: Image ID |
| Text | Header — Top Bar Text | `cm_header_topbar` | Empty string (blank) |
| Repeater | Header — CTA Buttons | `cm_header_buttons` | No rows (empty) |

## Cedar Mill — Header & Footer Options → Header — CTA Buttons (row)

| Field Type | Field Label | Field Name | Default Value |
|---|---|---|---|
| Link | Button — Link | `button_link` | No link (empty); return format: Link Array |
| Select | Button — Style | `button_style` | solid |

## Cedar Mill — Header & Footer Options

| Field Type | Field Label | Field Name | Default Value |
|---|---|---|---|
| Color Picker | Header — Background Color | `cm_header_background_color` | Empty string (blank) |
| Color Picker | Header — Navigation Text Color | `cm_header_text_color` | Empty string (blank) |
| Color Picker | Dropdown — Background Color | `cm_header_dropdown_background_color` | Empty string (blank) |
| Color Picker | Dropdown — Text Color | `cm_header_dropdown_text_color` | Empty string (blank) |
| Color Picker | Top Bar — Background Color | `cm_header_topbar_background_color` | Empty string (blank) |
| Color Picker | Top Bar — Text Color | `cm_header_topbar_text_color` | Empty string (blank) |
| Color Picker | Header Buttons — Background Color | `cm_header_button_background_color` | Empty string (blank) |
| Color Picker | Header Buttons — Text Color | `cm_header_button_text_color` | Empty string (blank) |
| Tab | Footer | `footer_tab` | Not applicable — editor tab only |
| Image | Footer — Logo | `cm_footer_logo` | No image (empty); return format: Image ID |
| Text | Footer — Tagline | `cm_footer_tagline` | Empty string (blank) |
| Textarea | Footer — Description | `cm_footer_description` | Empty string (blank) |
| Email | Footer — Contact Email | `cm_footer_email` | Empty string (blank) |
| Text | Footer — Contact Phone | `cm_footer_phone` | Empty string (blank) |
| Repeater | Footer — Social Links | `cm_footer_socials` | No rows (empty) |

## Cedar Mill — Header & Footer Options → Footer — Social Links (row)

| Field Type | Field Label | Field Name | Default Value |
|---|---|---|---|
| Select | Social — Icon | `social_icon` | none |
| Link | Social — Link | `social_link` | No link (empty); return format: Link Array |

## Cedar Mill — Header & Footer Options

| Field Type | Field Label | Field Name | Default Value |
|---|---|---|---|
| Repeater | Footer — Office Locations | `cm_footer_offices` | No rows (empty) |

## Cedar Mill — Header & Footer Options → Footer — Office Locations (row)

| Field Type | Field Label | Field Name | Default Value |
|---|---|---|---|
| Text | Office — Name | `office_name` | Empty string (blank) |
| Textarea | Office — Address | `office_address` | Empty string (blank) |
| Text | Office — Phone | `office_phone` | Empty string (blank) |
| Email | Office — Email | `office_email` | Empty string (blank) |
| Link | Office — Visit Link | `office_link` | No link (empty); return format: Link Array |

## Cedar Mill — Header & Footer Options

| Field Type | Field Label | Field Name | Default Value |
|---|---|---|---|
| Text | Footer — Copyright | `cm_footer_copyright` | Empty string (blank) |
| Color Picker | Footer — Background Color | `cm_footer_background_color` | Empty string (blank) |
| Color Picker | Footer — Text Color | `cm_footer_text_color` | Empty string (blank) |
| Color Picker | Footer — Description / Copyright Color | `cm_footer_muted_text_color` | Empty string (blank) |
| Color Picker | Footer — Link Color | `cm_footer_link_color` | Empty string (blank) |

## Layout names

| Layout label | Layout name | Template |
|---|---|---|
| 01 · Hero | `hero` | `template-parts/sections/hero.php` |
| 02 · Intro Statement | `intro_statement` | `template-parts/sections/intro_statement.php` |
| 03 · Product Categories | `product_categories` | `template-parts/sections/product_categories.php` |
| 04 · Every Detail / Value Propositions | `value_propositions` | `template-parts/sections/value_propositions.php` |
| 05 · Featured Project | `featured_project` | `template-parts/sections/featured_project.php` |
| 06 · CTA Band | `cta_band` | `template-parts/sections/cta_band.php` |
| 07 · Newsletter | `newsletter` | `template-parts/sections/newsletter.php` |
| 08 · Instagram Grid | `instagram_grid` | `template-parts/sections/instagram_grid.php` |

## Link and image values

A Link field stores URL, Link Text and target. Both URL and Link Text are needed for a button. Image fields return an attachment ID and use Media Library alternative text. Uploaded images and content values remain in your WordPress database when replacing the theme folder.

