<?php

  require_once _FNDRY_OB_PATH_ . 'common/foundry-ob-mailto.php';
  require_once _FNDRY_OB_PATH_ . 'common/foundry-ob-posts.php';

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
    
    register_rest_route(_FNDRY_OB_REST_API_, 'track/(?P<slug>[a-z0-9 .\-]+)', array(
      'methods' => 'GET',
      'callback' => array($this, 'handle_order_track_request')
    ));

  }

  /**
   * Handle order submissions
   */
  function handle_order_submission($data) {

    $order_prefix = carbon_get_theme_option( _FNDRY_OB_FIELD_PREFIX_ . 'order_prefix' );

    $params = $data->get_params();

    // TODO VERIFY NONCE

    // // SAVE TO POST

    $post = save_post($params);

    $params['id'] = $post;
    $params['tracking_code'] = $order_prefix . $post;

    // // SEND CONFIRMATION EMAIL

    $mail = new Foundry_OB_Mailto;
    $mail->push($params);

    var_dump($mail->debug());

    // return new WP_REST_Response('success',200);

  }

  /**
   * Handle order tracking
   */
  function handle_order_track_request($data) {

    

    $order_prefix = carbon_get_theme_option( _FNDRY_OB_FIELD_PREFIX_ . 'order_prefix' );

    $params = $data->get_params();
    $tracking_code = $params['slug'];

    // var_dump($tracking_code);

    // if (!$tracking_code) {
    //   return new WP_REST_Response(array(),200);
    // }

    // TODO VERIFY NONCE

    // FETCH PUBLIC POST

    $post = get_public_post($tracking_code);

    if(count($post ) == 0) {
      return new WP_REST_Response(
        array(
        'msg' => 'No results found',
        'data' => null,
        ),
        200
      );
    }

    return new WP_REST_Response(
      array(
        'msg' => 'No results found',
        'data' => $post,
      ),
      200
    );

  }

}