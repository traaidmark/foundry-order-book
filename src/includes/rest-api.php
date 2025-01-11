<?php

  require_once _FNDRY_OB_PATH_ . 'common/foundry-ob-mailto.php';

class Foundry_OB_Rest_Api {

  public function register() {
    add_action('rest_api_init', array($this, 'register_routes'));
  }

  /**
   * Registers Wordpress Rest endpoints
   */
  public function register_routes() {
    
    register_rest_route(_FNDRY_OB_REST_API_, 'create', array(
      'methods' => 'POST',
      'callback' => array($this, 'handle_order_submission')
    ));

  }

  /**
   * Handle order submissions
   */
  function handle_order_submission($data) {

    $params = $data->get_params();


    // TODO VERIFY NONCE

    // // SAVE TO POST

    // save_submission_to_post($params);

    // // SEND EMAIL TO ADMIN

    $mail = new Foundry_OB_Mailto;
    $mail->push($params);

    var_dump($mail->debug());

    // SEND EMAIL TO USER

    return new WP_REST_Response('success',200);

  }

}