<?php
require_once 'helpers.php';

class CartTest extends PHPUnit_Framework_TestCase
{
  public function test_construct(){
    // Arrange
    $cart = new \Marmalade\Cart('foo');
    // Assert
    $this->assertEquals('foo', $cart->cart_name);
    $this->assertArrayHasKey('foo', $_SESSION);
  }

  public function test_add_item(){
    $cart = new \Marmalade\Cart('foo');

    //Test new product adds 1 item
    $cart->add_item(12);
    $this->assertEquals(1, $cart->items[12]);

    //Test quantity parameter and increments quantity
    $cart->add_item(12, 2);
    $this->assertEquals(3, $cart->items[12]);

    //Test handling multiple products
    $cart->add_item(14, 2);
    $this->assertEquals(3, $cart->items[12]);
    $this->assertEquals(2, $cart->items[14]);
  }

  public function test_remove_item(){
    $cart = new \Marmalade\Cart('foo');
    $cart->add_item(12, 2);

    //Remove it completely
    $cart->remove_item(12);
    $this->assertArrayNotHasKey(12, $cart->items);
  }

  public function test_quantity_of(){
    $cart = new \Marmalade\Cart('foo');
    $cart->add_item(12, 2);
    $this->assertEquals(2, $cart->quantity_of(12));
  }

  public function test_total_price(){
    $cart = new \Marmalade\Cart('foo');
    $cart->add_item(12, 2);
    $cart->add_item(14, 4);
    $this->assertEquals(600, $cart->total_price());

    $cart->remove_item(12);
    $this->assertEquals(400, $cart->total_price());
  }

  public function test_total_cents(){
    $cart = new \Marmalade\Cart('foo');
    $cart->add_item(12, 2);
    $cart->add_item(14, 4);
    $this->assertEquals(600, $cart->total_price());
    $this->assertEquals(60000, $cart->total_cents());
  }

  public function test_total_count(){
    $cart = new \Marmalade\Cart('foo');
    $cart->add_item(12, 55);
    $cart->add_item(14, 45);
    $this->assertEquals(100, $cart->total_count());
  }

  public function test_shipping(){
    $cart = new \Marmalade\Cart('foo');
    $cart->add_shipping(15);
    $this->assertEquals(15, $cart->shipping());
  }

  public function test_decimal_shipping(){
    $cart = new \Marmalade\Cart('foo');
    $cart->add_shipping(15.1234);
    $this->assertEquals(15.12, $cart->shipping());
  }

  public function test_shipping_amounts(){
    $cart = new \Marmalade\Cart('foo');
    $cart->add_shipping(15);
    $cart->add_item(12, 2);
    $cart->add_item(14, 4);
    $this->assertEquals(615, $cart->total_price());
    $this->assertEquals(61500, $cart->total_cents());
  }
}