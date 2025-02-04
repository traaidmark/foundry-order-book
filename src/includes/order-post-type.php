<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

require_once _FNDRY_OB_PATH_ . 'common/util-field-helpers.php';
require_once _FNDRY_OB_PATH_ . 'common/util-string-helpers.php';
require_once _FNDRY_OB_PATH_ . 'common/foundry-ob-fields.php';
require_once _FNDRY_OB_PATH_ . 'common/foundry-ob-mailto.php';

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
    add_action('carbon_fields_register_fields', array($this,'init_status_block'));
    add_action('carbon_fields_register_fields', array($this,'init_service_block'));
    add_action('carbon_fields_register_fields', array($this,'init_customer_block'));
    add_action( 'post_updated', array($this, 'on_post_update'), 10, 3 );

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

  /**
   * Initializes status block
   */
  public function init_status_block() {

    $statuses = carbon_get_theme_option( _FNDRY_OB_FIELD_PREFIX_ . 'status' );
    $field_opts = generate_key_select_options($statuses);

    return Container::make( 'post_meta', 'Order Status' )
        ->where( 'post_type', '=', _FNDRY_OB_POST_TYPE_ )
        ->set_priority( 'high' )
        ->set_context('normal')
        ->add_fields( array(
          Field::make(
            'select', _FNDRY_OB_FIELD_PREFIX_ . 'status',
            __('Order Status') 
          )
            ->add_options( $field_opts )
            ->set_default_value('pending')
        ) );
  }

  /**
   * Initializes customer block
   */
  public function init_customer_block() {

    $this->fields->register(
      'customer', 
      carbon_get_theme_option( _FNDRY_OB_FIELD_PREFIX_ . 'customer_fields' )
    );

    $fields = $this->fields->generate_admin_fields('customer', _FNDRY_OB_FIELD_PREFIX_);

    return Container::make( 'post_meta', 'Customer Information' )
        ->where( 'post_type', '=', _FNDRY_OB_POST_TYPE_ )
        ->set_priority( 'high' )
        ->set_context('normal')
        ->add_fields( $fields );
  }

  /**
   * Initializes order block
   */
  public function init_service_block() {

    $service_fields = carbon_get_theme_option( _FNDRY_OB_FIELD_PREFIX_ . 'service_fields' );
    $line_statuses = carbon_get_theme_option( _FNDRY_OB_FIELD_PREFIX_ . 'line_status' );

    $this->fields->register(
      'service', 
      $service_fields
    );

    $fields = $this->fields->generate_admin_fields('service', _FNDRY_OB_FIELD_PREFIX_);

    if(!!$line_statuses) {
      $field_opts = generate_key_select_options($line_statuses);
      array_unshift(
        $fields,
        Field::make(
          'select', _FNDRY_OB_FIELD_PREFIX_ . 'status',
          __('Item Status') 
        )
          ->add_options( $field_opts )
          ->set_default_value('pending')
      );
    }

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

  /**
   * Actions to run after a post has been updated.
   */
  public function on_post_update($post_ID, $post_after, $post_before){

    $data = array(
      'name' => carbon_get_post_meta( $post_ID, _FNDRY_OB_FIELD_PREFIX_ . 'name' ),
      'email' => carbon_get_post_meta( $post_ID, _FNDRY_OB_FIELD_PREFIX_ . 'email_address' ),
      'subject' => 'An update has been posted on your order!',
      'tracking-code' => $post_after->post_title,
      'site-name' => get_bloginfo('name'),
      'site-url' => get_site_url(),
      'tracking-url' => get_site_url() . '/' . carbon_get_theme_option( _FNDRY_OB_FIELD_PREFIX_ . 'tracking_slug'),
    );

    // echo '<b>Post ID:</b><br />';
    // var_dump($post_ID);

    // echo '<b>NAME:</b><br />';
    // var_dump($data);

    $mail = new Foundry_OB_Mailto;
    $mail->direct_send(
      _FNDRY_OB_PATH_ . 'templates/ob-email-order-user-update.php', 
      $data
    );

    // wp_die();
    
}

}