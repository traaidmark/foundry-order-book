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
        ->add_tab( __('Order Settings'), $this->init_tab_orders())
        ->add_tab( __('Email Settings'), $this->init_tab_email());
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

  /**
   * Initializes email settings tab on the admin screen.
   * 
   * @return array()
   */
  function init_tab_email() {

    return array(

      Field::make( 'html', _FNDRY_OB_FIELD_PREFIX_ . 'email_owner_text' )
        ->set_html( '<h1>Email Settings</h1><p>Configure whether you want to email a notification of every submission to your inbox.</p>' ),

      Field::make(
        'checkbox',
        _FNDRY_OB_FIELD_PREFIX_ . 'email_notify',
        __('Email submission to your inbox')
      ),

      Field::make(
        'checkbox',
        _FNDRY_OB_FIELD_PREFIX_ . 'email_include_submission',
        __('Include copy of submission')
      ),

      Field::make(
        'text',
        _FNDRY_OB_FIELD_PREFIX_ . 'email_name',
        __('Name')
      ),
      
        Field::make(
        'text',
        _FNDRY_OB_FIELD_PREFIX_ . 'email_address',
        __('Email Address')
      ),
      Field::make(
        'text',
        _FNDRY_OB_FIELD_PREFIX_ . 'email_subject',
        __('Email Subject')
      )
      ->set_default_value('A new order has been created!'),
        // ->set_default_value('fndry-ob-')

      Field::make( 'html', _FNDRY_OB_FIELD_PREFIX_ . 'email_user_text' )
        ->set_html( '<h1>User Notification Settings</h1><p>Configure whether you want to email a notification of every submission to the user.</p>' ),
  
      Field::make(
        'checkbox',
        _FNDRY_OB_FIELD_PREFIX_ . 'email_user_notify',
        __('Send confirmation email to user')
      ),
      Field::make(
        'checkbox',
        _FNDRY_OB_FIELD_PREFIX_ . 'email_user_include_submission',
        __('Include copy of submission')
      ),
      Field::make(
        'text',
        _FNDRY_OB_FIELD_PREFIX_ . 'email_user_subject',
        __('Email Subject')
      )
      ->set_default_value('Your '. get_bloginfo('name') .' order has been submitted!'),
      Field::make(
        'rich_text',
        _FNDRY_OB_FIELD_PREFIX_ . 'email_content',
        __('Custom email content')
      )
      ->set_help_text('Content to display at the start of the email. Useful for marketing purposes.'),
      Field::make(
        'rich_text',
        _FNDRY_OB_FIELD_PREFIX_ . 'email_footer',
        __('Custom footer')
      )
      ->set_help_text('Content to display at the bottom of the email. Useful for contact & support purposes.'),


    );

  }

}