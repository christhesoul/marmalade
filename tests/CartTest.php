<?php
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
  
  
  
}