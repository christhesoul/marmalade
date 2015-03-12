<?php
/*
Plugin Name:        Marmalade
Plugin URI:         https://github.com/christhesoul/marmalade
Description:        A simple cart for Wordpress
Version:            1.0.0
Author:             Chris Waters
Author URI:         http://christhesoul.svbtle.com

License:            MIT License
License URI:        http://opensource.org/licenses/MIT
*/

define('MARMALADE_PATH', plugin_dir_path(__FILE__));

require_once(MARMALADE_PATH . 'src/config/session.php');
require_once(MARMALADE_PATH . 'src/config/cpts.php');
require_once(MARMALADE_PATH . 'src/config/ajax.php');

require_once(MARMALADE_PATH . 'src/acf/price.php');
require_once(MARMALADE_PATH . 'src/acf/orders.php');

require_once(MARMALADE_PATH . 'src/ajax/marmalade_cart.php');