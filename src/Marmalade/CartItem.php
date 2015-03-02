<?php
namespace Marmalade;

class CartItem {

  public $name;
  public $quantity;
  public $product_id;

  private $valid;

  function __construct($product_id, $quantity) {
    if(get_post($product_id)){
      $this->name = get_post($product_id)->post_title;
      $this->quantity = $quantity;
      $this->product_id = $product_id;
      $this->valid = true;
    } else {
      $this->valid = false;
    }
  }

  public function is_valid() {
    return $this->valid;
  }

  public function single_price() {
    return get_field('price', $this->product_id);
  }

  public function total_price() {
    return $this->single_price() * $this->quantity;
  }

}