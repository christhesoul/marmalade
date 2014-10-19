<?php
class Money {
  
  public static function format($number, $symbol = "&pound;") {
    return $symbol . number_format((float) $number, 2);
  }
  
}