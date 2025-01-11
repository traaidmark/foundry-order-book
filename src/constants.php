<?php

# 1. FIELD CONSTANTS

define('_FNDRY_OB_FIELD_PREFIX_', 'foundry_ob_field_');
define('_FNDRY_OB_DEFAULT_CUSTOMER_FIELDS_', array(
  array(
    "_type" => "text",
    "field-type" => "text",
    "name" => "Name",
    "field-options" => array(
      "is_public",
      "is_required"
    )
  ),
  array(
    "_type" => "text",
    "field-type" => "email",
    "name" => "Email Address",
    "field-options" => array(
      "is_public",
      "is_required"
    )
  ),
));

# 2. CUSTOM POST TYPE CONSTANTS

define('_FNDRY_OB_POST_TYPE_', 'foundry-order-book');
define('_FNDRY_OB_POST_NAME_', 'My Orders');
define('_FNDRY_OB_POST_NAME_SINGULAR_','Order');
define('_FNDRY_OB_POST_ADD_NEW_', 'Create new order');
define('_FNDRY_OB_POST_NEW_ITEM_', 'Create new order');
define('_FNDRY_OB_POST_EDIT_', 'Edit Order');
define('_FNDRY_OB_POST_NEW_', 'New Order');
define('_FNDRY_OB_POST_VIEW_', 'View Order');
define('_FNDRY_OB_POST_SEARCH_', 'Search Orders');
define('_FNDRY_OB_POST_NOT_FOUND_', 'Not found');
define('_FNDRY_OB_POST_NOT_FOUND_TRASH_', 'Not found in trash');

define('_FNDRY_OB_NAME_', 'Order Book');
define('_FNDRY_OB_SLUG_', 'foundry-order-book');

// 2. Templates

define(
  "_FNDRY_OB_TPL_FORM_CREATE_", 
  _FNDRY_OB_PATH_ . 'templates/ob-form-order-create.php'
);

// Global variables -> Assets
define("_FNDRY_BO_ASSETS_URL_", _FNDRY_OB_URL_ . "assets");
define("_FNDRY_BO_ASSETS_V_", "0.1.0");
define("_FNDRY_BO_ASSET_CSS_", _FNDRY_OB_SLUG_ . "-css-");
define("_FNDRY_BO_ASSET_JS_", _FNDRY_OB_SLUG_ . "-js-");


// REST API

define("_FNDRY_OB_REST_API_", "v1/foundry-order-book/");