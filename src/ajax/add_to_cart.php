<?php
add_action('wp_ajax_marmalade_add_to_cart', 'marmalade_add_to_cart');
add_action('wp_ajax_nopriv_marmalade_add_to_cart', 'marmalade_add_to_cart');

function marmalade_add_to_cart(){
  $product_id = intval($_POST['product']);
  $cart = new Marmalade\Cart('cart');
  $cart->add_item($product_id);
  echo json_encode(array(
    'status' => 'ok',
    'message' => get_post($product_id)->post_title . ' added to cart',
    'cart' => array(
      'quantity' => $cart->total_count(),
      'price' => $cart->total_price()
    )
  ));
  die();
}

function marmalade_load_add_to_cart_js(){
  wp_enqueue_script('marmalade_add_to_cart_js', plugins_url( '../../src/assets/js/add_to_cart.js', __FILE__ ), array('jquery') );
}
add_action('wp_enqueue_scripts', 'marmalade_load_add_to_cart_js');