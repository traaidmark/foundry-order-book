<?php

  $table_css = "border: solid 1px #C6CAD2; margin-bottom: 20px; width: 600px;";
  $table_row_css = "border-bottom: solid 1px #C6CAD2; padding: 10px;";

?>

<p>A new order has been submitted.</p>

<p><a href="<?php echo get_site_url(); ?>/wp-admin/post.php?post=<?php echo $data['id']; ?>&action=edit" target="_blank">View Submission</a></p>

<h3>Order Information:</h3>

<table style="<?php echo $table_css; ?>">
  <tbody>
    <tr style="<?php echo $table_row_css; ?>">
      <td scope="row"><strong>Order Id:</strong></td>
      <td><?php echo $data['id']; ?></td>
    </tr>
  </tbody>
</table>

<h3>Customer Information:</h3>

<table style="<?php echo $table_css; ?>">
  <tbody>
    <?php foreach($data['customer'] as $key => $value) { ?>
    <tr style="<?php echo $table_row_css; ?>">
      <td scope="row"><strong><?php echo $key; ?></strong></td>
      <td><?php echo $value; ?></td>
    </tr>
    <?php } ?>
  </tbody>
</table>

<h3>Line Items:</h3>
<?php foreach($data['services'] as $line_item) { ?>
<table style="<?php echo $table_css; ?>">
  <tbody>
    <?php foreach($line_item as $key => $value) { ?>
    <tr style="<?php echo $table_row_css; ?>">
      <td scope="row"><strong><?php echo $key; ?></strong></td>
      <td><?php echo $value; ?></td>
    </tr>
    <?php } ?>
  </tbody>
</table>
<?php } ?>

<hr />

<p><small>Powered by Foundry - Order Book.</small></p>
