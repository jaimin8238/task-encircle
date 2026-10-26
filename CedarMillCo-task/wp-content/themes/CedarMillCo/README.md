# CedarMillCo 2.0 — ACF Pro theme

This version implements the requested **ACF Pro Flexible Content editor inside Pages → Home**. Header and footer content is stored in one genuine ACF Options page. It does not register Cedar Sections, Cedar Items, subscriber menus or native WordPress content blocks.

You need your supplied **ACF Pro plugin**. The paid plugin is not included in this theme ZIP. Your existing local WordPress installation is sufficient; there is no new WordPress installation, database import, Node build or page builder to install.

## Install in your existing local WordPress

1. Keep a copy of your old `CedarMillCo` folder outside `wp-content/themes/` if you edited its code.
2. Extract the new ZIP. Copy the **CedarMillCo** folder into your existing `wp-content/themes/` folder, replacing the old theme files. The final path must be `wp-content/themes/CedarMillCo/style.css`.
3. In Plugins, deactivate the free ACF plugin and install/activate the ACF Pro ZIP supplied to you. Follow its license activation instructions.
4. Under **Appearance → Themes**, activate **CedarMillCo** if it is not already active. Keeping the folder name unchanged preserves its existing theme menu assignments.
5. Open **Pages → Home → Edit**. You will see **Cedar Mill — Homepage Sections**, containing **Homepage Sections**.
6. To start with the reference design, click **Load Reference Content Into This Page** in the notice above the editor. It imports the original images into Media Library, saves the eight layouts directly on this page, and fills only previously unset header/footer options.
7. If you edited content in version 1, use **Migrate Version 1 Content Into This Page** instead. This copies those section records and nested items into ACF values on this page. Old records are retained in the database but their separate CMS menus are no longer registered.
8. Click **Update** on the page. If Home is not already your front page, choose it under **Settings → Reading → A static page → Homepage**. The importer does not change this setting for you.
9. Under **Appearance → Menus → Manage Locations**, confirm your existing menu is assigned to **Primary Menu**. The theme uses the location key `primary`; it never creates or assigns a replacement menu.
10. Open **Header & Footer** to update shared content and click **Save Header & Footer**.

**Fields are registered automatically. Do not manually recreate or import them for the normal installation.**

## Homepage: eight sections, one after another

The reference loader inserts these actual ACF Flexible Content rows in order:

| Order | ACF layout label | Layout name |
| --- | --- | --- |
| 1 | Hero | `hero` |
| 2 | Intro Statement | `intro_statement` |
| 3 | Product Categories | `product_categories` |
| 4 | Every Detail / Value Propositions | `value_propositions` |
| 5 | Featured Project | `featured_project` |
| 6 | CTA Band | `cta_band` |
| 7 | Newsletter | `newsletter` |
| 8 | Instagram Grid | `instagram_grid` |

Each row contains its own text, images, links and optional colors. Product cards, value propositions, hero buttons and Instagram images use native ACF Repeaters inside their parent layout. Edit them in the page; there is no separate item library.

- **Edit:** expand the row, change fields and Update the page.
- **Reorder:** drag an ACF layout by its header.
- **Add:** click **Add Section** and choose a layout.
- **Duplicate:** use the layout's duplicate control. The copied row has independent text, image selections, nested rows and color settings.
- **Remove:** use the layout's remove control and save the page.
- **Temporarily hide:** switch on **Hide This Section**.

Use the same controls inside a repeater to manage cards, buttons or images. Keep only one Hero using **H1** on a page. Additional Hero rows can use **H2**. Other pages can use the same section field; their normal content editor remains available when they do not have section content. Pages use the classic page-edit screen so the ACF fields are presented directly.

## Images and colors

Use each image field's **Add Image** button to select or upload an image. Image fields return a WordPress attachment ID; no default ID can be shared across different WordPress databases. Set alternative text in Media Library. The optional reference importer supplies the original homepage logo and photos from your provided design.

Every layout includes **Section — Optional Colors**, with background, heading, text, eyebrow, link, button, input, border and image-overlay controls. Empty color fields preserve the supplied design. Overlay color/opacity applies to Hero and Featured Project; input colors apply to Newsletter. Header/top-bar/footer colors are available alongside their shared options.

The supplied `assets/css/styles.css` remains byte-for-byte unchanged. When you choose an optional color, the theme generates a validated, narrowly scoped inline color override. It does not add a second frontend stylesheet or replace the responsive structure. The PHP templates retain the source classes and nesting. Unique section IDs support independent color choices, including duplicated layouts.

## Header and footer

**Field group: Cedar Mill — Header & Footer Options**

**Location:** Options Page = `cedarmillco-options`.

Open **Header & Footer** in the dashboard:

- **Brand:** company name, used when a logo is not selected and as the footer brand text.
- **Header:** logo, top-bar text, optional CTA button rows, and optional header/top-bar/button colors.
- **Footer:** optional logo, tagline, description, contact email/phone, social links, office location rows, copyright, and optional colors.

Use `{year}` in copyright for the current year. Social and office rows are edited here; they do not appear in separate CMS lists. Empty links need no placeholder URL: leave them blank and the theme omits them. Link fields require both URL and Link Text to display a link.

## Primary navigation

The theme renders **the WordPress menu you selected for Primary Menu** using the source `nav-item` and `dropdown` structure. To make Products or Projects dropdowns, indent their child pages one level in Appearance → Menus and Save Menu. The source design supports top-level items and one dropdown level; the walker uses a depth of two to match that structure. The original responsive menu script is reused.

## Newsletter and Instagram

Newsletter starts in **Design preview** mode, matching the source design's preview behavior. It does not save or send an email address in this mode. The feedback message is editable through ACF.

To connect an email provider, choose **Send to an external form provider**, enter that provider's HTML form action URL, set its email field name and add its required hidden fields. This supports a provider's HTML POST signup form; it is not a HubSpot API integration. An empty action URL hides the form in external mode. The external provider handles processing and confirmation. No email campaigns or local subscriber CMS are included.

Instagram is a static image repeater. Edit images and optional image/profile links directly in its layout. It does not fetch a live Instagram feed.

## Complete field list

Open **docs/ACF-FIELD-GUIDE.html** for the readable field reference. Every field is listed under its group, layout or nested repeater/group, with:

1. Field Type
2. Field Label
3. Field Name
4. Default Value

The same guide is provided as Markdown. **docs/REFERENCE-CONTENT.md** separately lists the values inserted by the reference loader. Most actual ACF defaults are blank. Default values and imported reference content are different; blank defaults ensure optional content can be omitted.

**Field group: Cedar Mill — Homepage Sections**

**Location:** Post Type = Page. Main field type: Flexible Content. Label: Homepage Sections. Name: `cm_homepage_sections`. Field key: `field_cm_homepage_sections`.

There are exactly two field groups. The source definitions are `acf-json/group_cm_homepage.json` and `acf-json/group_cm_options.json`. Every child field has a unique field key. Repeated names such as `section_design` belong to separate layout contexts and are intentional.

## Optional manual import — only if required by your interviewer

Normal use requires no manual import. To manage database field definitions instead of the bundled registration:

1. Add `add_filter( 'cedarmillco_load_bundled_fields', '__return_false' );` to `functions.php` after the module-loading loop.
2. In ACF → Tools → Import Field Groups, import **docs/ACF-IMPORT.json** once.
3. Keep the exact field keys, names, layout names and hierarchy. The options-page registration still comes from the theme.
4. Do not import duplicate groups while bundled registration is enabled. To return to bundled definitions, remove the filter and disable the database copies of these two field groups.

The manual importer is provided for portability, not as a required setup step.

## Theme files

- `functions.php`: loads the theme's modules.
- `header.php` / `footer.php`: original shared markup populated by options.
- `front-page.php`: renders the current homepage's ACF layouts.
- `page-home.php`: optional Cedar Mill Homepage template for a page preview.
- `page.php`, `single.php`, `index.php`, `404.php`: standard WordPress fallbacks.
- `template-parts/sections/`: one template per Flexible Content layout.
- `inc/acf.php`: registers the genuine ACF Options page and the two field groups.
- `inc/navigation.php`: renders the selected Primary menu in the source structure.
- `inc/colors.php`: optional validated ACF color overrides.
- `inc/starter.php`: reference loader and version 1 migration, writing values to the selected page.
- `assets/css/styles.css`: your supplied stylesheet, including its original Google Fonts import.
- `assets/js/app.js`: original script; its newsletter preview message is now read from ACF instead of a hardcoded string.
- `assets/images/`: original reference logo and photos for optional import.
- `docs/`: complete field guide, JSON export, reference values and validation notes.

## Troubleshooting

**Only a blank editor appears:** activate ACF Pro, confirm CedarMillCo 2.0 is active, open Pages → Home and enable the **Cedar Mill — Homepage Sections** box under Screen Options if hidden.

**Fields are absent from the ACF Field Groups list:** code-registered groups are not editable database field groups. Their fields appear on the page/options edit screens. No manual import is needed.

**The homepage is blank:** add sections or use the reference loader. Confirm Settings → Reading points to this Home page and that its rows are not hidden.

**No navigation appears:** assign your existing menu to Primary Menu. There are no hardcoded fallback links.

**Images fail to import:** ensure your local WordPress uploads folder is writable and PHP can process images. The importer reports the error and reuses already imported attachments on retry.

**A button is missing:** its Link field needs both URL and Link Text.

**An inner link returns 404:** update that link field to your own existing page. The importer populates homepage links but does not create destination pages or change your existing pages.

**Many duplicated layouts do not all save:** review your local PHP `max_input_vars` limit; large ACF pages may need a higher limit than the host default.

Requirements: WordPress 6.5+, PHP 8.0+, and your licensed ACF Pro. See docs/VALIDATION.md for checks performed and the remaining Pro-editor verification limit.
