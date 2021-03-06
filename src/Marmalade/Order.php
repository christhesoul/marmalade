<?php
namespace Marmalade;

class Order {

  public $email;
  public $reference;
  public $shipping_info;
  public $line_items;
  public $shipping_cost;
  public $total_price;

  function __construct($post) {
    if(array_key_exists('stripeEmail', $post)) {
      $this->email = $post['stripeEmail'];
      $this->shipping_info = $this->process_shipping_info($post);
      $this->reference = uniqid();
      $this->line_items = $this->process_line_items();
      $this->shipping_cost = $this->get_shipping_cost();
      $this->total_price = $this->get_total_price();
      $this->create();
    } else {
      die('Something went wrong processing your payment. You have not been charged.');
    }
  }

  public static function retrieve_line_items($order_id) {
    return json_decode(base64_decode(get_field('line_items', $order_id)), true);
  }

  private function create() {
    $order_id = wp_insert_post(
      array(
        'post_title' => $this->email,
        'post_type' => 'orders',
        'post_name' => $this->reference,
        'post_status' => 'publish'
      )
    );
    update_field('field_54456fc3da99f', $this->shipping_info, $order_id);
    update_field('field_54f45f4fbbcf4', $this->line_items_readable(), $order_id);
    update_field('field_54458bcb82a28', base64_encode(json_encode($this->line_items)), $order_id);
    update_field('field_54458ff12376d', $this->total_price, $order_id);
    update_field('field_54458bcb82a29', $this->shipping_cost, $order_id);
    session_destroy();
    wp_redirect(get_permalink($order_id));
    exit;
  }

  private function process_shipping_info($post) {
    $shipping_address = $post['stripeShippingName'] . ', ';
    $shipping_address.= $post['stripeShippingAddressLine1'] . ', ';
    $shipping_address.= $post['stripeShippingAddressCity'] . ', ';
    $shipping_address.= $post['stripeShippingAddressZip'] . ', ';
    $shipping_address.= $post['stripeShippingAddressCountry'];
    return $shipping_address;
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

  private function line_items_readable() {
    $readable_array = array_map(function($line_item) { return get_post($line_item['product_id'])->post_title . ' (' . $line_item['quantity'] . ')'; }, $this->line_items);
    return implode(', ', $readable_array);
  }

  private function get_shipping_cost() {
    $cart = new Cart();
    return $cart->shipping();
  }

  private function get_total_price() {
    $cart = new Cart();
    return $cart->total_price();
  }

}