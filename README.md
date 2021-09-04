<p align="center">
  <a href="https://roots.io/sage/">
    <img alt="Sage" src="https://cdn.roots.io/app/uploads/logo-sage.svg" height="100">
  </a>
</p>

<p align="center">
  <a href="LICENSE.md">
    <img alt="MIT License" src="https://img.shields.io/github/license/roots/sage?color=%23525ddc&style=flat-square" />
  </a>

  <a href="https://packagist.org/packages/roots/sage">
    <img alt="Packagist" src="https://img.shields.io/packagist/v/roots/sage.svg?style=flat-square" />
  </a>

  <a href="https://github.com/roots/sage/actions">
    <img alt="Build Status" src="https://img.shields.io/github/workflow/status/roots/sage/Main?style=flat-square" />
  </a>

  <a href="https://twitter.com/rootswp">
    <img alt="Follow Roots" src="https://img.shields.io/twitter/follow/rootswp.svg?style=flat-square&color=1da1f2" />
  </a>
</p>

<p align="center">
  <strong>WordPress starter theme with a modern development workflow</strong>
  <br />
  Built with ❤️
</p>

<p align="center">
  <a href="https://roots.io">Official Website</a> | <a href="https://roots.io/docs/sage/">Documentation</a> | <a href="CHANGELOG.md">Change Log</a>
</p>

## Supporting

**Sage** is an open source project and completely free to use.

However, the amount of effort needed to maintain and develop new features and products within the Roots ecosystem is not sustainable without proper financial backing. If you have the capability, please consider donating using the links below:


## Requirements

Make sure all dependencies have been installed before moving on:

- [WordPress](https://wordpress.org/) >= 5.4
- [PHP](https://secure.php.net/manual/en/install.php) >= 7.3.0 (with [`php-mbstring`](https://secure.php.net/manual/en/book.mbstring.php) enabled)
- [Composer](https://getcomposer.org/download/)
- [Node.js](http://nodejs.org/) >= 12.14.0
- [Yarn](https://yarnpkg.com/en/docs/install)

## Theme installation

Install Sage using Composer from your WordPress themes directory (replace `your-theme-name` below with the name of your theme):

```sh
# @ app/themes/ or wp-content/themes/
$ composer create-project roots/sage your-theme-name
```

To install the latest development version of Sage, add `dev-master` to the end of the command:

```sh
$ composer create-project roots/sage your-theme-name dev-master
```

## Theme structure

```sh
themes/your-theme-name/   # → Root of your Sage based theme
├── app/                  # → Theme PHP
│   ├── View/             # → View models
│   ├── Providers/        # → Service providers
│   ├── admin.php         # → Theme customizer setup
│   ├── filters.php       # → Theme filters
│   ├── helpers.php       # → Helper functions
│   └── setup.php         # → Theme setup
├── bootstrap/            # → Acorn bootstrap
│   ├── cache/            # → Acorn cache location (never edit)
│   └── app.php           # → Acorn application bootloader
├── config/               # → Config files
│   ├── app.php           # → Application configuration
│   ├── assets.php        # → Asset configuration
│   ├── filesystems.php   # → Filesystems configuration
│   ├── logging.php       # → Logging configuration
│   └── view.php          # → View configuration
├── composer.json         # → Autoloading for `app/` files
├── composer.lock         # → Composer lock file (never edit)
├── public/               # → Built theme assets (never edit)
├── functions.php         # → Theme bootloader
├── index.php             # → Theme template wrapper
├── node_modules/         # → Node.js packages (never edit)
├── package.json          # → Node.js dependencies and scripts
├── resources/            # → Theme assets and templates
│   ├── fonts/            # → Theme fonts
│   ├── images/           # → Theme images
│   ├── scripts/               # → Theme javascript
│   ├── styles/              # → Theme stylesheets
│   └── views/            # → Theme templates
│       ├── components/   # → Component templates
│       ├── form/         # → Form templates
│       ├── layouts/      # → Base templates
│       └── partials/     # → Partial templates
├── screenshot.png        # → Theme screenshot for WP admin
├── storage/              # → Storage location for cache (never edit)
├── style.css             # → Theme meta information
├── vendor/               # → Composer packages (never edit)
└── webpack.mix.js        # → Laravel Mix configuration
```

## Theme setup

Edit `app/setup.php` to enable or disable theme features, setup navigation menus, post thumbnail sizes, and sidebars.

## Theme development

- Run `yarn` from the theme directory to install dependencies
- Update `webpack.mix.js` with your local dev URL

### Build commands

- `yarn start` — Compile assets when file changes are made, start Browsersync session
- `yarn build` — Compile and optimize the files in your assets directory
- `yarn build:production` — Compile assets for production

## Documentation

- [Sage documentation](https://roots.io/sage/docs/)

