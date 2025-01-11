<?php

  require_once _FNDRY_OB_PATH_ . 'common/util-string-helpers.php';
  require_once _FNDRY_OB_PATH_ . 'common/util-field-helpers.php';

  $key = str_slugify($data['name'], '_');
  $is_public = in_array("is_public", $data["field-options"]);
  $is_required = in_array("is_required", $data["field-options"]);
  $type = $data['_type'];
  $field_scope = $data['scope'] . $key;

  // var_dump($data);


  if($type == 'select_field') {
    $select_opts_data = generate_select_options($data['options']);
          
    $select_opts = array();

    foreach ($select_opts_data as $item) {

      array_push($select_opts, '<option value="'. str_slugify($item) .'">'. $item .'</option>');
    }
    // var_dump($select_opts);
  }
  
  
?>

<?php if(!!$is_public) { ?>

<div class="a-field">

  <label for="<?php echo _FNDRY_OB_FIELD_PREFIX_ . $key ?>">
    <?php echo $data['name'] ?>
  </label>

  <?php if ($type == 'text') { ?>
    <input 
      type="<?php echo $data['field-type'] ?>"
      name="<?php echo $key ?>" 
      id="<?php echo _FNDRY_OB_FIELD_PREFIX_ . $key ?>" 
      x-model="<?php echo $field_scope; ?>"
    />
  <?php } ?>

  <?php if ($type == 'textarea') { ?>
    <textarea 
      name="<?php echo $key ?>" 
      id="<?php echo _FNDRY_OB_FIELD_PREFIX_ . $key ?>" 
      x-model="<?php echo $field_scope; ?>"
    ></textarea>
  <?php } ?>

  <?php if ($type == 'select_field') { ?>
    
    <select
      name="<?php echo $key ?>" 
      id="<?php echo _FNDRY_OB_FIELD_PREFIX_ . $key ?>" 
      x-model="<?php echo $field_scope; ?>"
    >
    <?php 
      foreach($select_opts as $option) {
        echo $option;
      }
    ?>

  </select>
  <?php } ?>
  
</div>

<?php } ?>