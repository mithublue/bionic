<?php

/**
 * Plugin Name: Bionic
 * Plugin URI:
 * Description: Plugin boilerplate
 * Version: 1.0
 * Author: CyberCraft
 * Author URI:
 * Text Domain: bionic
 * Domain Path: localization
 *
 */

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| our application. We just need to utilize it! We'll simply require it
| into the script here so that we don't have to worry about manual
| loading any of our classes later on. It feels nice to relax.
|
*/


//require_once __DIR__ . '/bootstrap/autoload.php';

/*
|--------------------------------------------------------------------------
| Bootstrap the plugin
|--------------------------------------------------------------------------
|
| We need to bootstrap the plugin.
|
*/

// comodity define for text domain
define( 'BIONIC_TEXTDOMAIN', 'bionic' );
define( 'BIONIC_ASSET', plugins_url('public', __FILE__) );
define( 'BIONIC_ROOT', dirname(__FILE__) );

//include
//include_once SCHOOLER_ROOT.'/includes.php';

//$GLOBALS[ 'Bionic' ] = require_once __DIR__ . '/bootstrap/plugin.php';


class Bionic {

    /**
     * Initializes the class
     *
     * Checks for an existing instance
     * and if it doesn't find one, creates it.
     */
    public static function init() {
        static $instance = false;

        if ( ! $instance ) {
            $instance = new Bionic();
        }

        return $instance;
    }

    public function __construct() {
        register_activation_hook(__FILE__, array( $this, 'activate' ) );
        register_deactivation_hook( __FILE__, array( $this, 'deactivate' ) );
        add_action('admin_menu', array($this, 'add_menu' ) );
        add_action('init', array($this, 'register_post_types' ) );
        add_action('init', array($this, 'register_taxonomies' ) );
    }

    function includes() {
        foreach (glob(BIONIC_ROOT.'/meta/post/*.php') as $filename) {
            include $filename;
        }
        foreach (glob(BIONIC_ROOT.'/meta/taxonomy/*.php') as $filename) {
            include $filename;
        }
    }

    function activate() {
        include_once BIONIC_ROOT.'/activation.php';
    }

    function deactivate() {
        include_once BIONIC_ROOT.'/deactivation.php';
    }

    function add_menu() {
        include_once BIONIC_ROOT.'/config/menus.php';
    }

    function register_post_types() {
        include_once BIONIC_ROOT.'/post-types.php';
    }

    function register_taxonomies() {
        include_once BIONIC_ROOT.'/taxonomies.php';
    }
}

if ( ! function_exists( 'Bionic' ) ) {

    /**
     * Return the instance of plugin.
     *
     * @return Plugin
     */
    function Bionic()
    {
        return Bionic::init();
    }
}

Bionic();
