<?php

  use Carbon_Fields\Field;

  require_once _FNDRY_OB_PATH_ . 'common/util-string-helpers.php';

  /**
   * Scaffold out fields for a feature.
   */
  function field_set_create(
    $field_name, 
    $field_label,
    $default_options = array()
  ) {
    return Field::make( 'complex', $field_name, __($field_label) )
          
      ->add_fields( 'text', array(
        Field::make(
          'select',
          'field-type',
          'Field type'
        )
        ->add_options( array(
          'text' => 'Text', 'email' => 'Email', 'tel' => 'Phone Number', 'number' => 'Number'
        ) ),
        Field::make( 'text', 'name', __('Field Name') ),
        field_options(),
      ) )
      
      ->add_fields( 'textarea', array(
        Field::make( 'text', 'name', __('Field Name') ),
        field_options(),
      ) )
      
      ->add_fields( 'media', array(
        Field::make( 'text', 'name', __('Field Name') ),
        field_options(),
      ) )

      ->add_fields( 'select_field', array(
        Field::make( 'text', 'name', __('Field Name') ),
        field_options(),
        Field::make(
          'textarea',
          'options',
          __('Options')
        )
          ->set_attribute( 'placeholder', 'Item 1' )
          ->set_help_text('Enter an item per line')

      

      

    ) )
    ->set_default_value($default_options);
  }

  /**
   * Returns a set of options relevant to fields.
   */
  function field_options() {
    return Field::make( 'set', 'field-options', 'Field Options' )
      ->add_options( array(
        'is_required' => 'Required Field',
        'is_public' => 'Display on Public Form',
        'is_trackable' => 'Display on tracking form',
      ) 
    );
  }

  /**
   * field
   */
  function generate_post_type_fields() {
    
  }

  /**
   * Builds options for a Select field from newline separated strings
   * @return array
   */
  function generate_select_options($string) {

    $opts = preg_split("/\r\n|\n|\r/", $string);

    return $opts; 
  };
  /**
   * Builds options for a Select field from newline separated strings
   * @return array
   */
  function generate_key_select_options($string) {

    $opts = preg_split("/\r\n|\n|\r/", $string);

    $vals = array();

    foreach( $opts as $item) {
     $vals[str_slugify($item, '-')] = $item;
    }

    return $vals; 
  };


