<?php
require_once 'helpers.php';

class MoneyTest extends PHPUnit_Framework_TestCase
{
  public function test_format() {
    $money = Money::format(8);
    $this->assertEquals('&pound;<span class="marmalade-money">8.00</span>', $money);
  }
}