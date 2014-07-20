<?php
namespace Marmalade;

class Cart {
  
  public $items;
  public $cart_name;
  
  function __construct($name) {
    $this->cart_name = $name;
    $this->retrieve_or_create_session();
  }
  
  public function add_item($product_id, $quantity = 1) {
    if(array_key_exists($product_id, $this->items)){
      $this->increase_item_quantity($product_id, $quantity);
    } else {
      $_SESSION[$this->cart_name][$product_id] = $quantity;
      $this->sync_session();
    }
  }
  
  public function remove_item($product_id, $quantity = 1) {
    if(array_key_exists($product_id, $this->items)){
      if($this->quantity_of($product_id) > $quantity){
        $this->decrease_item_quantity($product_id, $quantity);
      } else {
        unset($_SESSION[$this->cart_name][$product_id]);
        $this->sync_session();
      }
    }
  }
  
  public function quantity_of($product_id) {
    return $this->items[$product_id];
  }
  
  private function increase_item_quantity($product_id, $quantity) {
    $_SESSION[$this->cart_name][$product_id] += $quantity;
    $this->sync_session();
  }
  
  private function decrease_item_quantity($product_id, $quantity) {
    $_SESSION[$this->cart_name][$product_id] -= $quantity;
    $this->sync_session();
  }
   
  private function retrieve_or_create_session() {
    if(isset($_SESSION[$this->cart_name])){
      $this->sync_session();
    } else {
      $_SESSION[$this->cart_name] = array();
      $this->sync_session();
    }
  }
  
  private function sync_session() {
    $this->items = $_SESSION[$this->cart_name];
  }
}

?>