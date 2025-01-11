<?php

require_once _FNDRY_OB_PATH_ . 'common/foundry-render-template.php';

class Foundry_OB_Shortcode_Create {

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
    add_shortcode( 'ob-order-create', array($this,'init_shortcode'));
  }

  /**
   * Initiates the order form as a Wordpress shortcode
   */
  function init_shortcode() {

    $customer_fields = $this->fields->generate_html_fields('customer');
    $service_fields = $this->fields->generate_html_fields('service');

    return foundry_render_template(
      _FNDRY_OB_PATH_ . 'templates/ob-form-order-create.php',
      array(
        "button_label" => 'Create Order',
        "customer-fields" => $customer_fields,
        "service-fields" => $service_fields,
      ),
    );
  }

}