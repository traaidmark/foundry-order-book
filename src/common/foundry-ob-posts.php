<?php 

  /**
   * Save submission to post type
   */
  function save_post($data) {

    $order_prefix = carbon_get_theme_option( _FNDRY_OB_FIELD_PREFIX_ . 'order_prefix' );

    $post_args = [
      'post_type' => _FNDRY_OB_POST_TYPE_,
      'post_status' => 'publish'
    ];

    $post_id = wp_insert_post($post_args);

    $post_data = array(
      'ID'           => $post_id,
      'post_title'   => $order_prefix . $post_id,
    );

    wp_update_post( $post_data );

    // HANDLE CUSTOMER DATA
    
    foreach ($data['customer'] as $key => $value) {

      carbon_set_post_meta( 
        $post_id, 
        _FNDRY_OB_FIELD_PREFIX_ . $key, 
        $value
      );

    }

    // HANDLE LINE ITEMS

    carbon_set_post_meta( 
      $post_id, 
      _FNDRY_OB_FIELD_PREFIX_ . 'line-items', 
      $data['services']
    );

    return $post_id;

  }