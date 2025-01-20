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

    return foundry_render_template(
      _FNDRY_OB_PATH_ . 'templates/ob-form-order-create.php',
      array(
        "endpoint" => get_rest_url(null, _FNDRY_OB_REST_API_ . 'create'),
        "button_label" => 'Create Order',
        "fields" => $this->fields->get()
      ),
    );
  }

}