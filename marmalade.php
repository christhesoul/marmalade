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

require_once('vendor/autoload.php');

function register_session(){
  if(!session_id())
    session_start();
}
add_action('init','register_session');

function cpts_register() {

	$cpts = array(
    new Marmalade\CPT('products','Product','Products'),
  );

  foreach($cpts as $cpt){
    $cpt->register_thyself();
  }
}

add_action('init', 'cpts_register');

if(function_exists("register_field_group"))
{
  register_field_group(array (
    'id' => 'acf_products',
    'title' => 'Products',
    'fields' => array (
      array (
        'key' => 'field_5441884fa70f7',
        'label' => 'Price',
        'name' => 'price',
        'type' => 'number',
        'required' => 1,
        'default_value' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'min' => '',
        'max' => '',
        'step' => '',
      ),
    ),
    'location' => array (
      array (
        array (
          'param' => 'post_type',
          'operator' => '==',
          'value' => 'products',
          'order_no' => 0,
          'group_no' => 0,
        ),
      ),
    ),
    'options' => array (
      'position' => 'normal',
      'layout' => 'no_box',
      'hide_on_screen' => array (
      ),
    ),
    'menu_order' => 0,
  ));
}

add_action('wp_head','ajaxurl');

function ajaxurl() { ?>
  <script type="text/javascript">
  var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
  </script>
<?php }

add_action('wp_ajax_marmalade_add_to_cart', 'marmalade_add_to_cart');
add_action('wp_ajax_nopriv_marmalade_add_to_cart', 'marmalade_add_to_cart');

function marmalade_add_to_cart(){
  $product_id = intval($_POST['product']);
  $cart = new Marmalade\Cart('cart');
  $cart->add_item($product_id);
  echo json_encode(array(
    'status' => 'ok',
    'message' => get_post($product_id)->post_title . ' added to cart',
    'cart' => array(
      'quantity' => 4,
      'price' => $cart->total_price()
    )
  ));
  die();
}

function marmalade_load_js(){
  wp_enqueue_script('marmalade_js', plugins_url( '/src/assets/js/add_to_cart.js', __FILE__ ), array('jquery') );
}
add_action('wp_enqueue_scripts', 'marmalade_load_js');