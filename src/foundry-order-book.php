<?php
/**
* Plugin Name: Foundry: Order Book
* Plugin URI: https://traaidmark.com/projects/foundry/order-book
* Description: The Foundry Order Book is an order taking plugin for people who provide mostly offline services. This is for the makers, the crafters and the people who get things done.
* Text Domain: foundry-order-book
* Version: 0.1.0
* Author: Adrian Kirsten
* Author URI: https://traaidmark.com
**/

if( !defined('ABSPATH') ) {
  die('This is no good.');
}



// DEFINE GLOBAL CONSTANTS

define('_FNDRY_OB_PATH_', plugin_dir_path(__FILE__));
define("_FNDRY_OB_URL_", plugin_dir_url(__FILE__));

require_once _FNDRY_OB_PATH_ . 'constants.php';

define('_FNDRY_OB_FIELD_PREFIX_', 'foundry_ob_field_');
define('_FNDRY_OB_NAME_', 'Order Book');
define('_FNDRY_OB_SLUG_', 'foundry-order-book');

// 2. Templates

define(
  "_FNDRY_OB_TPL_FORM_CREATE_", 
  _FNDRY_OB_PATH_ . 'templates/ob-form-order-create.php'
);


// Global variables -> Assets
define("_FNDRY_BO_ASSETS_URL_", _FNDRY_OB_URL_ . "assets");
define("_FNDRY_BO_ASSETS_V_", "0.1.0");
define("_FNDRY_BO_ASSET_CSS_", _FNDRY_OB_SLUG_ . "-css-");
define("_FNDRY_BO_ASSET_JS_", _FNDRY_OB_SLUG_ . "-js-");

// MAIN PLUGIN CLASS

if(!class_exists('FoundryOrderBook')) {

  class FoundryOrderBook {

    public function __construct()
    {
      // PHP Composer Autoload
      require_once( _FNDRY_OB_PATH_ . '/vendor/autoload.php');
    
    }

    // INIT
    public function initialize() {

      add_action("wp_enqueue_scripts", array($this, "enqueue_assets"));

      // include_once _FNDRY_OB_PATH_ . '/common/utilities.php';
      include_once _FNDRY_OB_PATH_ . '/admin/admin-screen.php';

      // Custom post types
      // include_once _FNDRY_OB_PATH_ . '/custom-post-types/orders.php';

      // Shortcodes
      // include_once _FNDRY_OB_PATH_ . '/shortcodes/quote-form.php';

    }

    /**
     * Enqueue assets
     */
    public function enqueue_assets() {
      wp_enqueue_style(
        _FNDRY_BO_ASSET_CSS_ . "root", 
        _FNDRY_BO_ASSETS_URL_ . "/css/stylesheet.css", 
        array(), 
        _FNDRY_BO_ASSETS_V_
      );

      wp_enqueue_script(
        _FNDRY_BO_ASSET_JS_ . "root", 
        _FNDRY_BO_ASSETS_URL_ . "/js/script.js", 
        array(), 
       ""
      );

      wp_enqueue_script(
        _FNDRY_BO_ASSET_JS_ . "alpinejs", 
        "https://unpkg.com/alpinejs", 
        array(), 
        "wefwef",
        array(
          'strategy' => 'defer'
        )
      );

      wp_enqueue_script(
        _FNDRY_BO_ASSET_JS_ . "htmx", 
        "https://unpkg.com/htmx.org@2.0.4", 
        array(), 
        "2.0.4",
        array(
          'strategy' => 'defer'
        )
      );

      wp_enqueue_script(
        _FNDRY_BO_ASSET_JS_ . "htmx-json-enc", 
        "https://unpkg.com/htmx-ext-json-enc@2.0.1/json-enc.js", 
        array(), 
        "2.0.1",
        array(
          'strategy' => 'defer'
        )
      );

      wp_enqueue_script(
        _FNDRY_BO_ASSET_JS_ . "htmx-client-side-templates", 
        "https://unpkg.com/htmx-ext-client-side-templates@2.0.0/client-side-templates.js", 
        array(), 
        "2.0.0",
        array(
          'strategy' => 'defer'
        )
      );
      
    }

  }

}

$FoundryOrderBook = new FoundryOrderBook;

$FoundryOrderBook->initialize();





