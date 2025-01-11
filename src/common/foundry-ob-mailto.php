<?php 

  class Foundry_OB_Mailto {
   
    private $config = array();
    private $owner = array();
    private $user = array() ;
    private $submission = array();
    public $output = '<p>There is nothing here!</p>';

    public function debug() {
      return array(
        'config' => $this->config,
        'owner' => $this->owner,
        'user' => $this->user,
        'submission' => $this->submission,
      );
    }

    public function __construct() {

      $this->config = array(
        'from-email' => get_bloginfo('admin_email'),
        'from-name' => get_bloginfo('name'),
      );

      $this->owner = array(
        'notify' => carbon_get_theme_option( 
          _FNDRY_OB_FIELD_PREFIX_ . 'email_notify' 
        ),
        'name' => carbon_get_theme_option(
           _FNDRY_OB_FIELD_PREFIX_ . 'email_name' 
        ),
        'email' => carbon_get_theme_option(
          _FNDRY_OB_FIELD_PREFIX_ . 'email_address'
        ),
        'subject' => carbon_get_theme_option(
          _FNDRY_OB_FIELD_PREFIX_ . 'email_subject'
        ),
      );

      $this->user = array(
        'notify' => carbon_get_theme_option( 
          _FNDRY_OB_FIELD_PREFIX_ . 'email_user_notify'
        ),
        'subject' => carbon_get_theme_option( 
          _FNDRY_OB_FIELD_PREFIX_ . 'email_user_subject'
        ),
        'content' => carbon_get_theme_option( 
          _FNDRY_OB_FIELD_PREFIX_ . 'email_content'
        ),
        'footer' => carbon_get_theme_option( 
          _FNDRY_OB_FIELD_PREFIX_ . 'email_footer'
        ),
      );

    }

    public function push($data) {
      $this->submission = $data;
      
      $this->user['name'] = $data['customer']['name'];
      $this->user['email'] = $data['customer']['email_address'];

      if(!!$this->user['notify']) {
        $this->send(
          _FNDRY_OB_PATH_ . 'templates/ob-email-order-user-confirmation.php',
          $this->user
        );
      }

      if(!!$this->owner['notify']) {
        $this->send(
          _FNDRY_OB_PATH_ . 'templates/ob-email-order-owner-confirmation.php',
          $this->owner
        );
      }

    }

    public function buildTemplate($template, $data) {
      ob_start();
      $output = '';
      include $template;
      $output = ob_get_contents();
      ob_end_clean();

      return $output;
    }

    public function send($template, $data) {

      $mail_headers = [];
      $mail_headers[] = "From: {$this->config['from-name']} <{$this->config['from-email']}>";
      $mail_headers[] = "Reply-to: {$data['name']} <{$data['email_address']}>";
      $mail_headers[] = "Content-Type: text/html";

      $content = $this->buildTemplate($template, $this->submission);

      wp_mail($data['email'], $data['subject'], $content, $mail_headers);
    }

  }