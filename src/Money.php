<?php
class Money {

  public static function format($number, $symbol = "&pound;") {
    return $symbol . '<span class="marmalade-money">' . number_format((float) $number, 2) . '</span>';
  }

}