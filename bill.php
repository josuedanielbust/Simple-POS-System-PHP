<?php
  @include_once( './products.php' );

  $bill = array(
    'products'  =>  array(),
    'total'     =>  0
  );

  $billProducts = array_map('intval', explode(',', $_POST['products']));
  foreach ( $billProducts as $key => $index ) {
    $bill['products'][] = $products[ $index ];
    $bill['total'] = $bill['total'] + $products[ $index ]['value'];
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS Print</title>
    <link rel="stylesheet" href="./style.css">
  </head>
  <body class="bill">
    <section id="bill-print" class="bill-print">
      <div class="bill-print-header">
        <h1>Fancy Business</h1>
        <p>
          <span>Cra. 49, No. 7 Sur - 50</span>
          <span>Medellín, Antioquia</span>
        </p>
        <p>Telefono: +57 (4) 2619500</p>
        <p><?php echo date('d/m/Y H:i'); ?></p>
      </div>
      <div class="bill-print-user">
        <p class="bill-print-user-name">
          <span>Client:</span>
          <span><?php echo $_POST['name']; ?></span>
        </p>
        <p class="bill-print-user-id">
          <span>ID:</span>
          <span><?php echo $_POST['id']; ?></span>
        </p>
      </div>
      <div class="bill-print-products">
        <p>
          <span>Product</span>
          <span>Value</span>
        </p>
        
        <?php foreach ( $bill['products'] as $key => $product ) { ?>
          <p>
            <span><?php echo $product['name']; ?></span>
            <span><?php echo $product['value']; ?></span>
          </p>
        <?php } ?>
      </div>
      <div class="bill-print-total">
        <p>
          <span>Total:</span>
          <span><?php echo $bill['total']; ?></span>
        </p>
      </div>
    </section>
    <section class="bill-actions">
      <button id="print">Print</button>
      <button id="new">New</button>
    </section>
    <script>
      (function() {
        let printButton = document.querySelector('#print');
        let newButton = document.querySelector('#new');
        
        printButton.addEventListener( 'click', function( e ) {
          window.print();
        });
        newButton.addEventListener( 'click', function( e ) {
          window.location = './index.php';
        });
      })();
    </script>
  </body>
</html>