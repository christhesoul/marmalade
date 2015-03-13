<?php
namespace Marmalade;

class Cart {

  public $items;
  public $cart_name;

  function __construct($name = 'cart') {
    $this->cart_name = $name;
    $this->retrieve_or_create_session();
  }

  public function add_item($product_id, $quantity = 1) {
    if(array_key_exists($product_id, $this->items)){
      $this->increase_item_quantity($product_id, $quantity);
    } else {
      $_SESSION[$this->cart_name]['items'][$product_id] = $quantity;
      $this->sync_session();
    }
  }

  public function remove_item($product_id) {
    if(array_key_exists($product_id, $this->items)){
      unset($_SESSION[$this->cart_name]['items'][$product_id]);
      $this->sync_session();
    }
  }

  public function quantity_of($product_id) {
    return $this->items[$product_id];
  }

  public function get_item_ids() {
    return array_keys($this->items);
  }

  public function total_count() {
    return array_sum(array_map(function($item) { return $item->quantity; }, $this->items()));
  }

  public function total_price() {
    $items = array_sum(array_map(function($item) { return $item->total_price(); }, $this->items()));
    $total = $items + $this->shipping();
    return number_format($total, 2);
  }

  public function total_cents() {
    return intval($this->total_price() * 100);
  }

  public function items() {
    $item_array = $this->items;
    array_walk($item_array, function(&$quantity, $product_id) { $quantity = new CartItem($product_id, $quantity); });
    return array_filter($item_array, function($item) { return $item->is_valid(); });
  }

  public function shipping() {
    return $_SESSION[$this->cart_name]['shipping'];
  }

  public function add_shipping($amount){
    $_SESSION[$this->cart_name]['shipping'] = number_format($amount, 2);
    $this->sync_session();
  }

  public function add_default_shipping($amount){
    if($this->shipping() == 0){
      $this->add_shipping($amount);
    }
  }

  // PRIVATE

  private function increase_item_quantity($product_id, $quantity) {
    $_SESSION[$this->cart_name]['items'][$product_id] += $quantity;
    $this->sync_session();
  }

  private function decrease_item_quantity($product_id, $quantity) {
    $_SESSION[$this->cart_name]['items'][$product_id] -= $quantity;
    $this->sync_session();
  }

  private function retrieve_or_create_session() {
    if(isset($_SESSION[$this->cart_name])){
      $this->sync_session();
    } else {
      $_SESSION[$this->cart_name]['items'] = array();
      $_SESSION[$this->cart_name]['shipping'] = 0;
      $this->sync_session();
    }
  }

  private function sync_session() {
    $this->items = $_SESSION[$this->cart_name]['items'];
    $this->shipping = $_SESSION[$this->cart_name]['shipping'];
  }
}

?>