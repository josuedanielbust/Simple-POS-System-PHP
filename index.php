<?php
  @include_once( './products.php' );
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS</title>
    <link rel="stylesheet" href="./style.css">
  </head>
  <body>
    <section class="products">
      <?php
        foreach ( $products as $key => $product ) { ?>
          <div class="product" data-index="<?php echo $key; ?>" data-name="<?php echo $product['name']; ?>" data-value="<?php echo $product['value']; ?>">
            <img src="./images/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
            <p class="product-name"><?php echo $product['name']; ?></p>
            <p class="product-value"><?php echo $product['value']; ?></p>
          </div>
        <?php
        }
      ?>
    </section>
    <section class="bill">
      <div class="bill-products">
        <h2>Productos</h2>
      </div>
      <div class="bill-client">
        <form method="POST" action="./bill.php">
          <div class="hidden">
            <label for="products">Products</label>
            <input type="text" name="products" id="products" placeholder="Products" value="">
          </div>
          <div>
            <label for="name">Name</label>
            <input type="text" name="name" id="name" placeholder="Client Name">
          </div>
          <div>
            <label for="id">ID</label>
            <input type="text" name="id" id="id" placeholder="Client ID">
          </div>
          <div>
            <input type="submit" value="Print">
          </div>
        </form>
      </div>
    </section>
    <script>
      (function() {
        let products = document.querySelectorAll('section.products > .product');
        let billProducts = document.querySelector('section.bill > .bill-products');
        let productsInput = document.querySelector('section.bill #products');
        let printButton = document.querySelector('section.bill input[type="submit"]');

        productsInput.value = '';
        
        products.forEach( product => {
          product.addEventListener( 'click', function( e ) {
            let index = e.srcElement.dataset.index;
            let name = e.srcElement.dataset.name;
            let value = e.srcElement.dataset.value;

            let p = document.createElement('p');
            p.innerHTML = name + ' - $' + value;
            billProducts.appendChild( p );

            if ( productsInput.value == '' ) {
              productsInput.value += index;
            } else {
              productsInput.value += ',' + index;
            }
          });
        });
      })();
    </script>
  </body>
</html>