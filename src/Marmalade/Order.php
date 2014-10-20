<?php
namespace Marmalade;

class Order {
  
  public $reference;
  public $shipping_info;
  public $line_items;
  public $total_price;
  
  function __construct($post) {
    if(!wp_verify_nonce($post['new_order_nonce'], 'create_order')) {
      die('Something suspicious is happening.');
    } else {
      $this->shipping_info = $this->process_shipping_info($post);
      $this->reference = uniqid();
      $this->line_items = $this->process_line_items();
      $this->total_price = $this->get_total_price();
      $this->create();
    }
  }
  
  public static function retrieve_line_items($order_id) {
    return json_decode(base64_decode(get_field('line_items', $order_id)), true);
  }
  
  private function create() {
    $order_id = wp_insert_post(
      array(
        'post_title' => $this->shipping_info['shipping_full_name'],
        'post_type' => 'orders',
        'post_name' => $this->reference,
        'post_status' => 'publish'
      )
    );
    update_field('field_54456fc3da99f', base64_encode(json_encode($this->shipping_info)), $order_id);
    update_field('field_54458bcb82a28', base64_encode(json_encode($this->line_items)), $order_id);
    update_field('field_54458ff12376d', $this->total_price, $order_id);
    wp_redirect(get_permalink($order_id));
    exit;
  }
  
  private function process_shipping_info($post) {
    $shipping_fields = array_filter(array_flip($post), function($key) { return substr($key,0,9) == 'shipping_'; });
    return array_flip($shipping_fields);
  }
  
  private function process_line_items() {
    $cart = new Cart();
    $line_items = array();
    foreach($cart->items() as $item) {
      $line_items[] = array(
        'product_id' => $item->product_id,
        'quantity' => $item->quantity,
        'single_price' => $item->single_price(),
        'total_price' => $item->total_price()
      );
    }
    return $line_items;
  }
  
  private function get_total_price() {
    $cart = new Cart();
    return $cart->total_price();
  }
  
}