<?php require_once _FNDRY_OB_PATH_ . 'common/util-string-helpers.php'; ?>
<?php

  $site_name = get_bloginfo('name');
  $site_url = get_site_url();
  $order_url = get_site_url() .'/wp-admin/post.php?post='. $data['id'] . '&action=edit';

?>

<?php include _FNDRY_OB_PATH_ . 'templates/ob-email-head.php'; ?>


  <!-- START CENTERED WHITE CONTAINER -->
  <span class="preheader">This is preheader text. Some clients will show this text as a preview.</span>
  <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="main">
    <!-- START MAIN CONTENT AREA -->
    <tr>
      <td class="wrapper">
        <p>Hi there!</p>
        <p>A new order has been created on <a href="<?php echo $site_url; ?>" target="_blank"><?php echo $site_name ?></a>.</p>
        <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="btn btn-primary">
          <tbody>
            <tr>
              <td align="left">
                <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                  <tbody>
                    <tr>
                      <td> <a href="<?php echo $order_url ?>" target="_blank">View Order: <?php echo $data['tracking_code']; ?></a> </td>
                    </tr>
                  </tbody>
                </table>
              </td>
            </tr>
          </tbody>
        </table>
        <!-- -->
        
        <h3>Customer Information:</h3>

        <table class="product-table">
          <tbody>
            <?php foreach($data['customer'] as $key => $value) { ?>
            <tr>
              <td scope="row"><strong><?php echo str_label_maker($key, '_', _FNDRY_OB_FIELD_PREFIX_); ?></strong></td>
              <td><?php echo $value; ?></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>

        <hr />

        <h3>Line Items:</h3>
        <?php foreach($data['services'] as $line_item) { ?>
        <table class="product-table">
          <tbody>
            <?php foreach($line_item as $key => $value) { ?>
            <tr>
              <td scope="row"><strong><?php echo str_label_maker($key, '_', _FNDRY_OB_FIELD_PREFIX_); ?></strong></td>
              <td><?php echo $value; ?></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
        <?php } ?>

        
        <!-- -->
      </td>
    </tr>

    <!-- END MAIN CONTENT AREA -->
    </table>

<?php include _FNDRY_OB_PATH_ . 'templates/ob-email-footer.php'; ?>