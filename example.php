<?php ini_set('display_errors', 1); ?>
<?php session_start(); ?>
<?php require_once('vendor/autoload.php'); ?>
<?php require_once('src/autoload.php'); ?>

<!DOCTYPE HTML>
<html lang="en-US">
<head>
  <meta charset="UTF-8">
  <title>Marmalade Example</title>
  <!-- load Boostrap for styling, useful but not essential -->
  <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
</head>
<body>
  <div class="container">
    <h1>My Shop</h1>
    <?php
    $cart = new \Marmalade\Cart('cart');
    $cart->add_item(13);
    print_r($cart->get_item_ids());
    print_r($cart->items);
    ?>
  </div>
</body>
</html>