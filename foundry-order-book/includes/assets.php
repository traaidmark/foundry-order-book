<?php

class Foundry_OB_Assets {

  private $version = '0.2.0';

  public function register() {
    add_action("wp_enqueue_scripts", array($this, "enqueue_assets"));
  }

  public function enqueue_assets() {

    wp_enqueue_style(
      _FNDRY_OB_SLUG_ . "-css-root", 
      _FNDRY_OB_URL_ . "assets/css/stylesheet.css", 
      array(), 
      $this->version,
    );

    wp_enqueue_script(
      _FNDRY_OB_SLUG_ . "-js-root", 
      _FNDRY_OB_URL_ . "assets/js/script.js", 
      array(), 
     $this->version,
    );

    wp_enqueue_script(
      _FNDRY_OB_SLUG_ . "js-alpinejs", 
      "https://unpkg.com/alpinejs", 
      array(), 
      $this->version,
      array(
        'strategy' => 'defer'
      )
    );

  }
}