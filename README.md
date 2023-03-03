# Luuptek WP-Starter

## Theme description

Luuptek WP-base is a starter theme to be used with WordPress site.

To have a full advantages of this theme, some core/gutenberg functionality has been moved into own plugin:
https://github.com/luuptek/luuptek-starter-plugins (public)

### Theme json

There is basic theme.json available, but it's recommended to use sass styling in `assets/styles`. If doing Luuptek-project, just remove theme.json and install luuptek-mu-plugins to define color palette.

### Features

- Gutenberg ready, possibility to add any core Gutenberg blocks into your default page template with three different width options (default, wide, full wide)
- ACF blocks ready, two custom blocks (latest posts, page lifts) added by default
- Hero image element possiblity to add to top of your default page template
  - Title, description (optional), button (optional) and background image to be defined
- Theme options with default post image, head/footer scripts and contact channels ready to be inserted
- Automatic JS / CSS building with Webpack (using Valu Digial's Sakke build tools)
  - SCSS and ES6 javascript implementation
  - prettier styled sass/js code
  - you can style with prettier with `sakke gulp prettier`
- Lots of helper-functions available in Utils-class ==> example `Utils()->get_social_media_links()` would output social media icons with links
- Translation strings to be used with Polylang if needed
- Default WP-templates (header, footer, index etc) moved under `templates`-folder
- Custom post type / taxonomy support
- Custom page template support
- PHP codesniffer linted code!


## Installation/developing

1. Clone the repo to WP `themes`-dir, rename the cloned dir, `cd` into and remove `.git`
2. Run `yarn` to install front-end-depencies
3. Run `yarn run config` to setup project

4. Run `sakke watch` to start `Webpack` to watch & rebuild on asset changes
5. To build for production, run `sakke build` && `sakke gulp git-dist-changes-show`
6. You need to execute `sakke gulp git-dist-changes-show`, because dist-folder stuff is hidden by default in sakke build tools


### Available npm-scripts:
* `sakke watch`: When you start developing, enables livereload in your browser so any changes done to files will be live reloaded :)
* `sakke build`: Build assets for production
* `sakke gulp git-dist-changes-show`: Reveal file changes in dist-folder
* `yarn run config`: Run project-config (On a fresh clone of this repo)


### Folder Structure

```
├── assets
│   ├── fonts
│   ├── images
│   │   ├── icons
│   │   │   ├── facebook-square.svg
│   │   │   ├── github-square.svg
│   │   │   ├── instagram-square.svg
│   │   │   ├── linkedin-square.svg
│   │   │   ├── search.svg
│   │   │   ├── twitter-square.svg
│   │   │   └── youtube-square.svg
│   │   ├── logo-favicon.png
│   │   └── logo.svg
│   ├── scripts
│   │   ├── customizer.js
│   │   ├── lib
│   │   │   ├── accessiblity.js
│   │   │   ├── mainSearch.js
│   │   │   ├── navigation.js
│   │   │   └── toggleStates.js
│   │   ├── main-admin.js
│   │   ├── main.js
│   │   ├── polyfills.js
│   │   ├── routes
│   │   │   ├── Common.js
│   │   │   └── Home.js
│   │   └── util
│   │       └── router.js
│   └── styles
│       ├── blocks
│       │   ├── _b-hero.scss
│       │   ├── _b-page-lifts.scss
│       │   ├── _blocks.scss
│       │   ├── acf
│       │   │   ├── _acf-gb-blocks.scss
│       │   │   ├── _acf-gb-latest-posts.scss
│       │   │   └── _acf-gb-page-lifts.scss
│       │   └── wp-core
│       │       ├── _aligns.scss
│       │       ├── _blockquote.scss
│       │       ├── _button.scss
│       │       ├── _colors.scss
│       │       ├── _columns.scss
│       │       ├── _cover.scss
│       │       ├── _embeds.scss
│       │       ├── _gallery.scss
│       │       ├── _group.scss
│       │       ├── _image.scss
│       │       ├── _media_and_text.scss
│       │       ├── _paragraph.scss
│       │       ├── _separator.scss
│       │       ├── _spacer.scss
│       │       ├── _table.scss
│       │       ├── _text-aligns.scss
│       │       ├── _text-sizes.scss
│       │       └── _wp-core-blocks.scss
│       ├── common
│       │   ├── _boot-up.scss
│       │   ├── _fonts.scss
│       │   ├── _global.scss
│       │   └── _variables.scss
│       ├── components
│       │   ├── _all.scss
│       │   ├── _burger.scss
│       │   ├── _buttons.scss
│       │   ├── _code.scss
│       │   ├── _comments.scss
│       │   ├── _dropdown-menu.scss
│       │   ├── _forms.scss
│       │   ├── _image.scss
│       │   ├── _main-nav.scss
│       │   ├── _pagination.scss
│       │   ├── _post-lift.scss
│       │   ├── _search-box.scss
│       │   ├── _skip-to-content.scss
│       │   ├── _some-nav.scss
│       │   ├── _tinymce.scss
│       │   ├── _transition.scss
│       │   └── _wp-classes.scss
│       ├── layouts
│       │   ├── _all.scss
│       │   ├── _footer.scss
│       │   ├── _grid.scss
│       │   ├── _header.scss
│       │   ├── _section.scss
│       │   └── _sidebar.scss
│       ├── main-admin.scss
│       ├── main.scss
│       ├── mixins
│       │   ├── _aligns.scss
│       │   ├── _border-radius.scss
│       │   ├── _box-shadow.scss
│       │   ├── _breakpoints.scss
│       │   ├── _buttons.scss
│       │   ├── _gradient.scss
│       │   ├── _grid.scss
│       │   ├── _hover.scss
│       │   ├── _image.scss
│       │   ├── _list.scss
│       │   ├── _mixins.scss
│       │   ├── _screenreader.scss
│       │   ├── _transition.scss
│       │   ├── _typography.scss
│       │   └── _various.scss
│       ├── utils
│       │   ├── _functions.scss
│       │   ├── _reboot.scss
│       │   ├── _root.scss
│       │   └── _typography.scss
│       └── vendor
│           └── _rfs.scss
├── custom-templates
│   └── template.tpl.php
├── dist
│   ├── fonts
│   ├── images
│   │   ├── icons
│   │   │   ├── facebook-square.svg
│   │   │   ├── github-square.svg
│   │   │   ├── instagram-square.svg
│   │   │   ├── linkedin-square.svg
│   │   │   ├── search.svg
│   │   │   ├── twitter-square.svg
│   │   │   └── youtube-square.svg
│   │   ├── logo-favicon.png
│   │   └── logo.svg
│   ├── scripts
│   │   ├── customizer-99dbc7483adad5939204.js
│   │   ├── load-polyfills.js
│   │   ├── main-admin-119815b6bbe02f8428da.js
│   │   ├── main-cfaacbf80e34bea8e84e.js
│   │   ├── manifest-admin.json
│   │   ├── manifest.json
│   │   └── polyfills-dc72155292e7cfd65df9.js
│   └── styles
│       ├── main-admin.css
│       ├── main-admin.css.map
│       ├── main.css
│       └── main.css.map
├── eslint-config.js
├── functions.php
├── index.php
├── library
│   ├── acf-block-json
│   │   ├── latest-posts
│   │   │   ├── block.json
│   │   │   └── gb-acf-latest-posts.php
│   │   └── page-lifts
│   │       ├── block.json
│   │       └── gb-acf-page-lifts.php
│   ├── acf-blocks
│   │   └── blocks.php
│   ├── acf-data
│   │   ├── group_5d1b27e3284a4.json
│   │   ├── group_5f3a2582544f8.json
│   │   ├── group_5f48b3892988e.json
│   │   ├── group_5ff86e052ec5d.json
│   │   └── group_61446518b4d16.json
│   ├── acf-options
│   │   └── options.php
│   ├── classes
│   │   ├── Bootstrap-navwalker.php
│   │   ├── Initialization.php
│   │   └── Utils.php
│   ├── custom-posts
│   │   └── cpt.php
│   ├── functions
│   │   ├── h5bp-htaccess
│   │   ├── helpers.php
│   │   └── polylang-fallbacks.php
│   ├── hooks
│   │   ├── asset-helpers.php
│   │   ├── assets.php
│   │   ├── blocks.php
│   │   ├── hooks.php
│   │   ├── loop_alter.php
│   │   ├── luuptek-mu-filters.php
│   │   └── translations.php
│   ├── lang
│   │   └── wp-base-theme.pot
│   ├── taxonomies
│   │   └── custom-taxonomy-name.php
│   └── widgets
│       ├── nav-menus.php
│       └── shortcodes.php
├── load-polyfills.js
├── package.json
├── partials
│   ├── blocks
│   │   ├── b-button.php
│   │   ├── b-hero.php
│   │   └── b-page-lift.php
│   ├── components
│   │   ├── lang-selector.php
│   │   ├── main-nav.php
│   │   ├── main-search.php
│   │   └── post-lift.php
│   ├── content-excerpt.php
│   ├── content-page.php
│   ├── content-post-lift.php
│   ├── content-search.php
│   ├── content-single.php
│   ├── content.php
│   ├── no-results-404.php
│   ├── no-results-search.php
│   ├── no-results.php
│   └── pagination.php
├── parts
│   └── footer.html
├── sakke.config.js
├── sakke.json
├── screenshot.png
├── style.css
├── templates
│   ├── 404.php
│   ├── archive.php
│   ├── footer.php
│   ├── header.php
│   ├── index.php
│   ├── page.php
│   ├── search.php
│   ├── searchform.php
│   ├── sidebar.php
│   └── single.php
├── theme.json
└── yarn.lock
```

**1. assets**
Place your images, fonts, styles & javascripts here (they get smushed and build to `dist`-folder)

`styles`-dir is divided into smaller sections, each with it's responsibilities:
* `blocks`: Gutenberg block styling
* `common`: Global functions, settings & fonts
* `mixins`: All mixins
* `utils`: Some utilities that will setup typography etc
* `components`: Single components, e.g. buttons, breadcrumbs, paginations etc.
* `layouts`: General layouts for header, different pages, sidebar(s), footer etc.
* `vendor`: 3rd. party components etc. which are not installed through npm.

**2. custom-templates**
* Place your WordPress [custom-templates](https://developer.wordpress.org/themes/template-files-section/page-template-files/) here.

**3. library**
* `acf-block-json` / `acf-blocks` / `acf-data` / `acf-options`: ACF block registering, using ACF JSON data and creating options
* `classes`: Holds the helper & utility-classes and is autorequired in `functions.php`
* `custom-posts`: Place your custom posts here. See example usage in `cpt.php`
* `taxonomies`: Place your custom taxonomies here. See example usage in `custom-taxonomy-name.php`
* `functions`: The place for misc. helper functions
* `hooks`: The place for WP's `hooks`, `pre_get_posts` etc.
* `lang`: i18n for the theme
* `widgets`: WP-nav menus & widgets

**4. parts**
When using block_template_part()-function ==> Add all relevant files into this directory.

**5. partials**
Partial files used by wrappers. Place additional partial components to `components`-folder

**6. templates**
WordPress required template-files
