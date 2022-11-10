# Luuptek WP-Starter

## Theme description

Luuptek WP-base is a starter theme to be used with WordPress site.

To have a full advantages of this theme, some core/gutenberg functionality has been moved into own plugin:
https://github.com/luuptek/luuptek-mu-plugins (private)

### Theme json

There is basic theme.json available, but it's recommended to use sass styling in `assets/styles`. If doing Luuptek-project, just remove theme.json and install luuptek-mu-plugins to define color palette.

### Features

- Gutenberg ready, possibility to add any core Gutenberg blocks into your default page template with three different width options (default, wide, full wide)
- ACF blocks ready, two custom blocks (latest posts, page lifts) added by default
- Hero image element possiblity to add to top of your default page template
  - Title, description (optional), button (optional) and background image to be defined
- Theme options with default post image, head/footer scripts and contact channels ready to be inserted
- Automatic JS / CSS building with Webpack
  - SCSS and ES6 javascript implementation
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
4. Change `package.json` config-section to suit your needs:
* `proxyUrl`: The default development URL where webpack will be proxied to
* `entries`: Scripts & styles which will be compiled to `/dist`-folder. Each entry will be compiled with the name specified with the objects `key`.

```json
"config": {
  "proxyUrl": "http://playground.test",
  "entries": {
    "main": [
      "./scripts/main.js",
      "./styles/main.scss"
    ],
    "customizer": [
      "./scripts/customizer.js"
    ],
    "admin": [
      "./admin/backend.js",
      "./admin/backend.scss"
    ]
  }
}
```

4. Run `yarn start` to start `Webpack` to watch & rebuild on asset changes in `localhost:3000`
5. To build for production, run `yarn prod` which compresses the scripts & styles, disables sourcemaps, copies images from `assets/images` to `dist/images` and creates most common favicons automatically to `icons`-subfolder.


### Available npm-scripts:
* `yarn start`: Start `webpack` to browsersync `localhost:3000`
* `yarn prod`: Build assets for production
* `yarn test`: Test scripts
* `yarn run config`: Run project-config (On a fresh clone of this repo)


### Folder Structure

```
├── 1. assets
│   ├── admin
│   │   ├── backend.js
│   │   └── backend.scss
│   ├── dist
│   ├── fonts
│   ├── images
│   ├── scripts
│   │   ├── routes
│   │   └── util
│   │       └── main.js
│   ├── styles
│   │   ├── common
│   │   ├── components
│   │   ├── layouts
│   │   ├── vendor
│   │   └── main.scss
│   ├── webpack
│   │   └── development.js
│   │   └── plugins.js
│   │   └── production.js
│   │   └── webpack.base.js
|
├── 2. custom-templates
│   ├── template.tpl.php
|
├── 3. library
│   ├── acf-block-json
│   │   ├── blocks-here
│   ├── acf-blocks
│   │   ├── blocks.php
│   ├── acf-data
│   ├── acf-options
│   ├── classes
│   │   ├── Bootstrap-navwalker.php
│   │   ├── Breadcrumbs.php
│   │   ├── CPT-base.php
│   │   ├── Initalization.php
│   │   └── Utils.php
│   ├── custom-posts
│   ├── taxonomies
│   ├── functions
│   ├── hooks
│   ├── lang
│   └── widgets
|
├── 4. partials
│   ├── blocks
│   │   └── example-block.php
│   ├── components
│   ├── content-excerpt.php
│   ├── content-page.php
│   ├── content-search.php
│   ├── content-single.php
│   ├── content.php
│   ├── no-results-404.php
│   ├── no-results-search.php
│   └── no-results.php
|
├── 5. templates
├── .editorconfig
├── .eslintrc
├── .gitignore
├── .nvmrc
├── functions.php
├── index.php
├── package.json
├── README.md
├── screenshot
└── style.css
└── yarn.lock
```

**1. assets**
Place your images, styles & javascripts here (they get smushed and build to `assets/dist`-folder on WebPack `prod`). Javascripts will be compiled to `admin.min.js` (WP-admin-scripts), `customizer.min.js` (WP Customizer js) and `main.js.min` (the main js-file).

`styles`-dir is divided into smaller sections, each with it's responsibilities:
* `blocks`: Gutenberg block styling
* `common`: Global functions, settings, mixins & fonts
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

**4. partials**
Partial files used by wrappers. Place additional partial components to `components`-folder

**5. templates**
WordPress required template-files
