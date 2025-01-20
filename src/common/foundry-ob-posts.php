<?php 

  require_once _FNDRY_OB_PATH_ . 'common/util-string-helpers.php';

  /**
   * Fetch public post information
   */
  function get_public_post($code) {

    if(!$code) {
      return array();
    }

    $args = array(
      'post_type' => _FNDRY_OB_POST_TYPE_,
      'title' => $code,
    ); 
    $data = get_posts($args);

    if(count($data) == 0) {
      return array();
    }

    $post_id = $data[0]->ID;

    // if(!$post_id) {
    //   return [
    //     'msg' => 'No Results',
    //     'data' => null,
    //   ];
    // }

    $order_status = carbon_get_post_meta( $post_id, _FNDRY_OB_FIELD_PREFIX_ . 'status' );
    $line_items = carbon_get_post_meta( $post_id, _FNDRY_OB_FIELD_PREFIX_ . 'line-items' );

    $items = array();

    foreach($line_items as $item) {
      $lines = array();
      foreach($item as $key => $val) {
        if($key !== '_type') {
          array_push($lines, array(
            'label' => str_label_maker($key, '_', _FNDRY_OB_FIELD_PREFIX_),
            'value' => $val,
          ));
        }
      }
      array_push($items, $lines);
    }

    // var_dump($post_id);

    return array( 
      'code' => $code,
      'status' => $order_status,
      'items' => $items
    );

  }


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
        $key, 
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