<?php require_once _FNDRY_OB_PATH_ . 'common/util-string-helpers.php'; ?>

<?php include _FNDRY_OB_PATH_ . 'templates/ob-email-head.php'; ?>

  <!-- START CENTERED WHITE CONTAINER -->
  <span class="preheader">This is preheader text. Some clients will show this text as a preview.</span>
  <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="main">
    <!-- START MAIN CONTENT AREA -->
    <tr>
      <td class="wrapper">
        <p>An update has been posted to your order with <a href="<?php echo $data['site-url']; ?>" target="_blank"><?php echo $data['site-name'] ?></a>!</p>
        <p>Your tracking code:</p>
        <h2><?php echo $data['tracking-code']; ?></h2>
        <p>Track the progress of the work you requested by entering the above code into the tracking form:</p>
        <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="btn btn-primary">
          <tbody>
            <tr>
              <td align="left">
                <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                  <tbody>
                    <tr>
                      <td> <a href="<?php echo $data['tracking-url'] ?>" target="_blank">Track Order: <?php echo $data['tracking-code']; ?></a> </td>
                    </tr>
                  </tbody>
                </table>
              </td>
            </tr>
          </tbody>
        </table>
        <!-- -->

        
        <!-- -->
      </td>
    </tr>

    <!-- END MAIN CONTENT AREA -->
    </table>

<?php include _FNDRY_OB_PATH_ . 'templates/ob-email-footer.php'; ?>