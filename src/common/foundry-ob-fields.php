<?php

  use Carbon_Fields\Container;
  use Carbon_Fields\Field;

  class Foundry_OB_Fields {

    protected $fields = array(
      "customer" => array(),
      "service" => array(),
    );

    public function __construct() {}

    public function register($type, $data = array()) {
      if($type  == 'customer' || $type == 'service') {
        $this->fields[$type] = array_merge(
          $this->fields[$type],
          $data,
        );
      }
    }

    public function get() {
      return $this->fields;
    }

    public function generate_backend_fields($context) {

      $fields = array();

      foreach ($this->fields[$context] as $field) {

        if($field['_type'] === 'text') {
          array_push(
            $fields,
            Field::make(
              'text',
              _FNDRY_OB_FIELD_PREFIX_ . str_slugify($field['name'], '_'), 
              __($field['name']) ),
          );
        }
        
        if($field['_type'] === 'textarea') {
          array_push(
            $fields,
            Field::make(
              'textarea', 
              _FNDRY_OB_FIELD_PREFIX_ . str_slugify($field['name'], '_'), 
              __($field['name']) 
            ),
          );
        }
  
        if($field['_type'] === 'select_field') {
          $field_opts = generate_key_select_options(__($field['options']));
          array_push(
            $fields,
            Field::make(
              'select', 
              _FNDRY_OB_FIELD_PREFIX_ . str_slugify($field['name'], '_'),
              __($field['name'])
            )
              ->add_options( $field_opts )
          );
        }
        
      }

      return $fields;

    }

  };
