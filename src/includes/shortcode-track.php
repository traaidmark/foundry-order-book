<?php

require_once _FNDRY_OB_PATH_ . 'common/foundry-render-template.php';

class Foundry_OB_Shortcode_Track {

  /**
   * Constructor function.
   */
  public function __construct() {}

  /**
   * Registers the class and it's dependencies.
   */
  public function register() {
    add_shortcode( 'ob-order-track', array($this,'init_shortcode'));
  }

  /**
   * Initiates the order form as a Wordpress shortcode
   */
  function init_shortcode() {

    return foundry_render_template(
      _FNDRY_OB_PATH_ . 'templates/ob-form-order-track.php',
      array(
        "endpoint" => get_rest_url(null, _FNDRY_OB_REST_API_ . 'track'),
        "button_label" => 'Track Order',
      ),
    );
  }

}