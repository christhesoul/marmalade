Marmalade
=========

1. Install the bloody thing

```JSON
"repositories": [
  {
    "type": "vcs",
    "url": "https://github.com/christhesoul/marmalade"
  }
]
"require": {
  "christhesoul/marmalade": "dev-master",
}

```

2. Add some products in the backend. (Marmalade creates a Product custom post type.)

3. Create your add to cart button. A bit like this:

```HTML+PHP
<p><a href="#" class="btn btn-success marmalade-add-to-cart" data-product="<? the_id(); ?>">Add to cart</a></p>
```

4. You can display you cart like this:

```HTML+PHP
<? $cart = new \Marmalade\Cart(); ?>
<table class="table">
  <tr>
    <th>Product</th>
    <th>Price Per Unit</th>
    <th>Quantity</th>
    <th>Total Price</th>
  </tr>
  <? foreach($cart->items() as $item): ?>
    <tr>
      <td><?= $item->name; ?></td>
      <td><?= Money::format($item->single_price()) ?></td>
      <td><?= $item->quantity ?></td>
      <td><?= Money::format($item->total_price()) ?></td>
    </tr>
  <? endforeach; ?>
  <tr>
    <th>Total</th>
    <th></th>
    <th></th>
    <th><?= Money::format($cart->total_price()) ?></th>
  </tr>
</table>
```

5. To remove items from the cart, first code a remove button:

```HTML+PHP
<p><a href="#" class="btn btn-danger marmalade-remove-from-cart" data-product="<? the_id(); ?>">&times;</a></p>
```

and then add a `marmalade-remove-<?= $item->id(); ?>` class to your row, leaving you with something like this:

```HTML+PHP
<? foreach($cart->items() as $item): ?>
  <tr class="marmalade-remove-<?= $item->product_id; ?>">
    <td><?= $item->name; ?></td>
    <td><?= Money::format($item->single_price()) ?></td>
    <td><?= $item->quantity ?></td>
    <td><?= Money::format($item->total_price()) ?></td>
    <td><a href="#" class="btn btn-danger btn-xs marmalade-remove-from-cart" data-product="<? the_id(); ?>">&times;</a></td>
  </tr>
<? endforeach; ?>
```


