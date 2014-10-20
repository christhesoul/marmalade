<?php
class ShippingAddress {
  
  public static function format($order_id) {
    $address_string = '';
    $lines = array_values(json_decode(base64_decode(get_field('shipping_info')), true));
    foreach($lines as $line):
      $address_string.= nl2br($line) . '<br>';
    endforeach;
    return $address_string;
  }
  
}