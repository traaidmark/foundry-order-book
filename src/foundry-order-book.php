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

require_once _FNDRY_OB_PATH_ . '/vendor/autoload.php';
require_once _FNDRY_OB_PATH_ . 'constants.php';
require_once _FNDRY_OB_PATH_ . 'includes/settings.php';
require_once _FNDRY_OB_PATH_ . 'includes/order-post-type.php';
require_once _FNDRY_OB_PATH_ . 'common/foundry-ob-fields.php';



// MAIN PLUGIN CLASS

if(!class_exists('FoundryOrderBook')) {

  class FoundryOrderBook {

    private $foundry_ob_settings;
    private $foundry_ob_fields;
    private $foundry_ob_orders;


    public function __construct()
    {
      // PHP Composer Autoload

      add_action('after_setup_theme', array($this, 'load_carbon_fields'));

      $this->foundry_ob_settings = new Foundry_OB_Settings;
      $this->foundry_ob_fields = new Foundry_OB_Fields;
      $this->foundry_ob_orders = new Foundry_OB_Orders;
    
    }

    /**
     * Load Carbon Fields
     * 
     * @return void
     */
    public function load_carbon_fields() {
      \Carbon_Fields\Carbon_Fields::boot();
    }

    // INIT
    public function initialize() {
      
      $this->foundry_ob_settings->register();
      $this->foundry_ob_orders->register($this->foundry_ob_fields);

      // SET FIELDS

      $this->foundry_ob_fields->register(
        'customer', 
        _FNDRY_OB_DEFAULT_CUSTOMER_FIELDS_
      );

      // var_dump(carbon_get_theme_option( _FNDRY_OB_FIELD_PREFIX_ . 'customer_fields' ));


      // include_once _FNDRY_OB_PATH_ . '/includes/settings.php';

      // Custom post types
      // include_once _FNDRY_OB_PATH_ . '/includes/custom-post-type-orders.php';

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





