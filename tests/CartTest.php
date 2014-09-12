<?php
function get_field($name, $id) {
  return 100;
}

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
    
    //Reduce it
    $cart->remove_item(12);
    $this->assertEquals(1, $cart->items[12]);
    
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
    $cart->add_item(13, 4);
    $this->assertEquals(600, $cart->total_price());
    
    $cart->remove_item(12);
    $this->assertEquals(500, $cart->total_price());
  }
  
}