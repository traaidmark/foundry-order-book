

<p>A new order has been submitted.</p>

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


<p><small>Powered by Foundry - Order Book.</small></p>
