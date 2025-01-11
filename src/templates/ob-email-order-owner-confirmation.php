

<p>A new order has been submitted.</p>

<p><a href="<?php echo get_site_url(); ?>/wp-admin/post.php?post=<?php echo $data['id']; ?>&action=edit" target="_blank">View Submission</a></p>

<h3>Customer Information:</h3>

<table>
  <tbody>
    <tr>
      <td scope="row"><strong>Order Id:</strong></td>
      <td><?php echo $data['id']; ?></td>
    </tr>
  </tbody>
</table>

<h3>Customer Information:</h3>

<table>
  <tbody>
    <?php foreach($data['customer'] as $key => $value) { ?>
    <tr>
      <td scope="row"><strong><?php echo $key; ?></strong></td>
      <td><?php echo $value; ?></td>
    </tr>
    <?php } ?>
  </tbody>
</table>

<hr />

<p><small>Powered by Foundry - Order Book.</small></p>
