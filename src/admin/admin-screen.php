<?php

  use Carbon_Fields\Container;
  use Carbon_Fields\Field;

  require_once _FNDRY_OB_PATH_ . 'common/util-field-helpers.php';

  add_action('after_setup_theme', 'load_carbon_fields');
  add_action('carbon_fields_register_fields', 'init_admin_screen');

  /**
   * Load Carbon Fields
   * 
   * @return void
   */
  function load_carbon_fields() {
    \Carbon_Fields\Carbon_Fields::boot();
  }

  /**
   * Initializes the admin screen
   * 
   * @return array()
   */
  function init_admin_screen() {
    Container::make( 'theme_options', _FNDRY_OB_NAME_ )
      ->add_tab( __('Order Settings'), init_tab_orders());
  }


  /**
   * Initializes General settings tab on the admin screen.
   * 
   * @return array()
   */
  function init_tab_general() {

    return array(
      Field::make(
        'text',
        _FNDRY_OB_FIELD_PREFIX_ . 'order_prefix',
        __('Order prefix')
      )
        ->set_help_text('Prefix to add to order codes'),
        // ->set_default_value('fndry-ob-')
      Field::make(
        'checkbox',
        _FNDRY_OB_FIELD_PREFIX_ . 'has_tracking',
        __('Track order status')
      )
        ->set_help_text('Do you want to enable order tracking?'),
      Field::make(
        'textarea',
        _FNDRY_OB_FIELD_PREFIX_ . 'order_statuses',
        __('Order statuses')
      )
        ->set_attribute( 'placeholder', '[key](value)' ),
      Field::make(
        'checkbox',
        _FNDRY_OB_FIELD_PREFIX_ . 'has_line_item_tracking',
        __('Track line item status')
      )
        ->set_help_text('Do you want to enable order tracking?'),
      Field::make(
        'textarea',
        _FNDRY_OB_FIELD_PREFIX_ . 'line_item_statuses',
        __('Line Item statuses')
      )
        ->set_attribute( 'placeholder', '[key](value)' )
        ->set_help_text('Do you want to enable order tracking?'),

    );
  }

  /**
   * Initializes Email settings tab on the admin screen.
   * 
   * @return array()
   */
  function init_tab_email() {

    return array(
      Field::make(
        'text',
        _FNDRY_OB_FIELD_PREFIX_ . 'name',
        __('Delivery Name')
      )
        ->set_help_text('Prefix to add to order codes'),
        // ->set_default_value('fndry-ob-')
  
      Field::make(
        'checkbox',
        _FNDRY_OB_FIELD_PREFIX_ . 'can_send_user_confirmation',
        __('Send confirmation email to user')
      )
        ->set_help_text('Do you want to enable order tracking?'),

    );
  }

  /**
   * Initializes order settings tab on the admin screen.
   * 
   * @return array()
   */
  function init_tab_orders() {

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