<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

require_once _FNDRY_OB_PATH_ . 'common/util-field-helpers.php';
require_once _FNDRY_OB_PATH_ . 'common/util-string-helpers.php';
require_once _FNDRY_OB_PATH_ . 'common/foundry-ob-fields.php';

class Foundry_OB_Orders {

  private $fields;

  /**
   * Constructor function.
   */
  public function __construct() {}

  /**
   * Registers the class and it's dependencies.
   */
  public function register($fields) {

    $this->fields = $fields;

    add_action('init', array($this,'register_custom_post_type'));
    add_action('carbon_fields_register_fields', array($this,'init_service_block'));
    add_action('carbon_fields_register_fields', array($this,'init_customer_block'));

  }

  /**
   * Registers the orders custom post type
   */
  public function register_custom_post_type() {
    $args = array(
      'public' => true,
      'has_archive' => true,
      'supports' => array('title', 'revisions'),
      'exclude_from_search' => true,
      'publicly_queryable' => false,
      'capability' => 'manage_options',
      'labels' => array(
        'name' => 'My Orders',
        'singular_name' => 'Order',
        'add_new'            => 'Create new order',
        'add_new_item'       => 'Create new order',
        'edit_item'          => 'Edit Order',
        'new_item'           => 'New Order',
        'view_item'          => 'View Order',
        'search_items'       => 'Search Orders',
        'not_found'          => 'Not found',
        'not_found_in_trash' => 'Not found in trash',
      ),
      'menu_icon' => 'dashicons-products',
      'rewrite'       => true,
      'query_var'     => true,
    );

    register_post_type(_FNDRY_OB_POST_TYPE_, $args);

  }

  // /**
  //  * Initializes customer block
  //  */
  public function init_customer_block() {

    $this->fields->register(
      'customer', 
      carbon_get_theme_option( _FNDRY_OB_FIELD_PREFIX_ . 'customer_fields' )
    );

    $fields = $this->fields->generate_backend_fields('customer');

    return Container::make( 'post_meta', 'Customer Information' )
        ->where( 'post_type', '=', _FNDRY_OB_POST_TYPE_ )
        ->set_priority( 'high' )
        ->set_context('normal')
        ->add_fields( $fields );
  }

  // /**
  //  * Initializes order block
  //  */
  public function init_service_block() {

    $this->fields->register(
      'service', 
      carbon_get_theme_option( _FNDRY_OB_FIELD_PREFIX_ . 'service_fields' )
    );

    $fields = $this->fields->generate_backend_fields('service');

    return Container::make( 'post_meta', 'Order Information' )
      ->where( 'post_type', '=', _FNDRY_OB_POST_TYPE_ )
      ->set_context('normal')
      ->set_priority( 'low' )
      ->add_fields( array(
        Field::make(
          'complex', 
          _FNDRY_OB_FIELD_PREFIX_ . 'line-items', 'Line Items' )
          ->add_fields( $fields ),
    ));

  }

}