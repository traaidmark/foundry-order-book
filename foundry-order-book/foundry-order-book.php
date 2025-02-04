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
require_once _FNDRY_OB_PATH_ . 'includes/assets.php';
require_once _FNDRY_OB_PATH_ . 'includes/settings.php';
require_once _FNDRY_OB_PATH_ . 'includes/order-post-type.php';
require_once _FNDRY_OB_PATH_ . 'common/foundry-ob-fields.php';
require_once _FNDRY_OB_PATH_ . 'includes/shortcode-create.php';
require_once _FNDRY_OB_PATH_ . 'includes/shortcode-track.php';
require_once _FNDRY_OB_PATH_ . 'includes/rest-api.php';

// MAIN PLUGIN CLASS

if(!class_exists('FoundryOrderBook')) {

  class FoundryOrderBook {

    private $foundry_ob_assets;
    private $foundry_ob_settings;
    private $foundry_ob_fields;
    private $foundry_ob_orders;
    private $foundry_ob_shortcode_create;
    private $foundry_ob_shortcode_track;
    private $foundry_ob_rest_api;


    public function __construct()
    {
      // PHP Composer Autoload

      add_action('after_setup_theme', array($this, 'load_carbon_fields'));

      $this->foundry_ob_assets = new Foundry_OB_Assets;
      $this->foundry_ob_settings = new Foundry_OB_Settings;
      $this->foundry_ob_fields = new Foundry_OB_Fields;
      $this->foundry_ob_orders = new Foundry_OB_Orders;
      $this->foundry_ob_shortcode_create = new Foundry_OB_Shortcode_Create;
      $this->foundry_ob_shortcode_track = new Foundry_OB_Shortcode_Track;
      $this->foundry_ob_rest_api = new Foundry_OB_Rest_Api;

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
      
      $this->foundry_ob_assets->register();
      $this->foundry_ob_settings->register();
      $this->foundry_ob_orders->register($this->foundry_ob_fields);
      $this->foundry_ob_shortcode_create->register($this->foundry_ob_fields);
      $this->foundry_ob_shortcode_track->register();
      $this->foundry_ob_rest_api->register();

      // SET DEFAULT FIELDS

      $this->foundry_ob_fields->register(
        'customer', 
        _FNDRY_OB_DEFAULT_CUSTOMER_FIELDS_
      );

    }

  }

}

$FoundryOrderBook = new FoundryOrderBook;

$FoundryOrderBook->initialize();





