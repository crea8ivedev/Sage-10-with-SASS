<?php

/**
 * Do not edit anything in this file unless you know what you're doing
 */

use Roots\Sage\Config;
use Roots\Sage\Container;

/**
 * Helper function for prettying up errors
 * @param string $message
 * @param string $subtitle
 * @param string $title
 */
$sage_error = function ($message, $subtitle = '', $title = '') {
    $title = $title ?: __('Sage &rsaquo; Error', 'sage');
    $footer = '<a href="https://roots.io/sage/docs/">roots.io/sage/docs/</a>';
    $message = "<h1>{$title}<br><small>{$subtitle}</small></h1><p>{$message}</p><p>{$footer}</p>";
    wp_die($message, $title);
};

/**
 * Ensure compatible version of PHP is used
 */
if (version_compare('7.1', phpversion(), '>=')) {
    $sage_error(__('You must be using PHP 7.1 or greater.', 'sage'), __('Invalid PHP version', 'sage'));
}

/**
 * Ensure compatible version of WordPress is used
 */
if (version_compare('4.7.0', get_bloginfo('version'), '>=')) {
    $sage_error(__('You must be using WordPress 4.7.0 or greater.', 'sage'), __('Invalid WordPress version', 'sage'));
}

/**
 * Ensure dependencies are loaded
 */
if (!class_exists('Roots\\Sage\\Container')) {
    if (!file_exists($composer = __DIR__.'/../vendor/autoload.php')) {
        $sage_error(
            __('You must run <code>composer install</code> from the Sage directory.', 'sage'),
            __('Autoloader not found.', 'sage')
        );
    }
    require_once $composer;
}

/**
 * Sage required files
 *
 * The mapped array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 */
array_map(function ($file) use ($sage_error) {
    $file = "../app/{$file}.php";
    if (!locate_template($file, true, true)) {
        $sage_error(sprintf(__('Error locating <code>%s</code> for inclusion.', 'sage'), $file), 'File not found');
    }
}, ['helpers', 'setup', 'filters', 'admin']);

/**
 * Here's what's happening with these hooks:
 * 1. WordPress initially detects theme in themes/sage/resources
 * 2. Upon activation, we tell WordPress that the theme is actually in themes/sage/resources/views
 * 3. When we call get_template_directory() or get_template_directory_uri(), we point it back to themes/sage/resources
 *
 * We do this so that the Template Hierarchy will look in themes/sage/resources/views for core WordPress themes
 * But functions.php, style.css, and index.php are all still located in themes/sage/resources
 *
 * This is not compatible with the WordPress Customizer theme preview prior to theme activation
 *
 * get_template_directory()   -> /srv/www/example.com/current/web/app/themes/sage/resources
 * get_stylesheet_directory() -> /srv/www/example.com/current/web/app/themes/sage/resources
 * locate_template()
 * ├── STYLESHEETPATH         -> /srv/www/example.com/current/web/app/themes/sage/resources/views
 * └── TEMPLATEPATH           -> /srv/www/example.com/current/web/app/themes/sage/resources
 */
array_map(
    'add_filter',
    ['theme_file_path', 'theme_file_uri', 'parent_theme_file_path', 'parent_theme_file_uri'],
    array_fill(0, 4, 'dirname')
);
Container::getInstance()
    ->bindIf('config', function () {
        return new Config([
            'assets' => require dirname(__DIR__).'/config/assets.php',
            'theme' => require dirname(__DIR__).'/config/theme.php',
            'view' => require dirname(__DIR__).'/config/view.php',
        ]);
    }, true);


/*** Admin Login ***/
function login_logo(){
    echo '<style type="text/css">
        #login { padding: 10% 0 0; }
        body{background-image: url('.get_bloginfo('template_directory') .'/assets/images/login-bg.jpg) !important;background-size: cover !important; background-position: center; }
        p a{color:#66011B !important;}
        .privacy-policy-page-link a{color:#66011B;}
        h1 a{background-image: url('.get_bloginfo('template_directory') .'/assets/images/logo.png) !important;background-size:200px !important; width:100% !important;margin: 0 auto !important; box-shadow: none !important; height: 74px !important;}
        #nav a{color:#ffffff !important;}
        #backtoblog a{color:#ffffff !important;}
        .wp-core-ui .button-primary {
            background: #66011B;
            border-color: #66011B;
            color: #fff;
            text-decoration: none;
            text-shadow: none;
        }.wp-core-ui .button-secondary {
            color: #66011B;}.wp-core-ui .button-primary:hover {
            background: #66011B;
            border-color: #66011B;
            color: #fff;
        }input[type=password]:focus,input[type=text]:focus,input[type=checkbox]:focus{border-color: #66011B;
            box-shadow: 0 0 0 1px #66011B;
            outline: 2px solid transparent;}
        </style>';
}
add_action('login_head','login_logo');

/* update url for logo */
function my_login_logo_url() {
    return esc_url( home_url( '/' ) );
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

/*Upload svg image*/
function cc_mime_types($mimes) {
 $mimes['svg'] = 'image/svg+xml';
 return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

if( function_exists('acf_add_options_page') ) {
    acf_add_options_page(array(
        'page_title'    => __('Theme Options', 'tetleyinvestment'),
        'capability'    => 'manage_options',
        'position'      => '62'
    ));
}

function override_mce_options($initArray) 
{
    $opts = '*[*]';
    $initArray['valid_elements'] = $opts;
    $initArray['extended_valid_elements'] = $opts;
    return $initArray;
}
add_filter('tiny_mce_before_init', 'override_mce_options');


function custom_excerpt_more($more) {
   global $post;
   return '…';
}
add_filter('excerpt_more', 'custom_excerpt_more');

function custom_excerpt_length( $length ) {
    return 50;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );