<?php
require_once 'helpers.php';

class CartItemTest extends PHPUnit_Framework_TestCase
{
  public function test_construct() {
    $item = new Marmalade\CartItem(8, 2);
    $this->assertEquals(2, $item->quantity);
  }
  
  public function test_is_valid() {
    $invalid_item = new Marmalade\CartItem(13, 2);
    $this->assertFalse($invalid_item->is_valid());
  }
  
  public function test_single_price() {
    $item = new Marmalade\CartItem(8, 2);
    $this->assertEquals(100, $item->single_price());
  }
  
  public function test_total_price() {
    $item = new Marmalade\CartItem(8, 2);
    $this->assertEquals(200, $item->total_price());
  }
}