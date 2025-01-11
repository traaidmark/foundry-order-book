<?php

/**
 * Takes a template file, data and renders it to HTML
 */
function foundry_render_template($file_path, $data) {

  ob_start();
  $output = '';
  include $file_path;
  $output = ob_get_contents();
  ob_end_clean();

  return $output;
}