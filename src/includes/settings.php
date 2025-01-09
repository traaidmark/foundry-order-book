<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

require_once _FNDRY_OB_PATH_ . 'common/util-field-helpers.php';

class Foundry_OB_Settings {

    public function __construct() {

    }

    public function register() {
      // add_action('after_setup_theme', array($this, 'load_carbon_fields'));
      add_action('carbon_fields_register_fields', array($this, 'init_admin_screen'));
    }

    /**
     * Load Carbon Fields
     * 
     * @return void
     */
    // public function load_carbon_fields() {
    //   \Carbon_Fields\Carbon_Fields::boot();
    // }

    /**
     * Initializes the admin screen
     * 
     * @return array()
     */
    public function init_admin_screen() {
      Container::make( 'theme_options', _FNDRY_OB_NAME_ )
        ->add_tab( __('Order Settings'), $this->init_tab_orders());
    }

    /**
   * Initializes order settings tab on the admin screen.
   * 
   * @return array()
   */
  public function init_tab_orders() {

    return array(

      Field::make( 'html', _FNDRY_OB_FIELD_PREFIX_ . 'customer_text' )
        ->set_html( '<h1>Customer Fields</h1><p>Add fields that relate to the customer below.</p><p>Default fixed fields: <strong>Name</strong>, <strong>Email Address</strong></p>' ),


      field_set_create(
        _FNDRY_OB_FIELD_PREFIX_ . 'customer_fields', 
        __('Fields'),
      ),

      Field::make( 'html', _FNDRY_OB_FIELD_PREFIX_ . 'service_text' )
        ->set_html( '<h1>Service options</h1><p>Add fields that relate to your services or products below.</p>' ),

      field_set_create(
        _FNDRY_OB_FIELD_PREFIX_ . 'service_fields', 
        __('Fields'),
      ),

    );
  }



}